<?php

namespace App\Controllers;

use App\Models\User;
use App\Repository\UserRepository;

class IndexController
{
    private readonly UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index(): void
    {
        view('index/index');
    }

    public function register(): void
    {
        if (getRequestMethod() !== 'POST') {
            view('index/register');

            return;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $error = match (true) {
            empty($username) => addFlash('Username cannot be empty', 'danger'),
            strlen($username) < 8 => addFlash('Username must be at least 8 characters', 'danger'),
            ! empty($this->userRepository->findOneBy([
                'username' => $username,
            ])) => addFlash('Username already taken', 'danger'),
            default => null,
        };

        if ($error) {
            view('index/register');

            return;
        }

        $error = match (true) {
            empty($password) => addFlash('Password cannot be empty', 'danger'),
            strlen($password) < 8 => addFlash('Password must be at least 8 characters', 'danger'),
            default => null,
        };

        if ($error) {
            view('index/register');

            return;
        }

        $user = new User();
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->create($user);

        redirect(ROUTE_LOGIN);
    }

    public function login(): void
    {
        if (getRequestMethod() !== 'POST') {
            view('index/login');

            return;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            addFlash('Username or password is empty', 'danger');
            view('index/login');

            return;
        }

        $user = $this->userRepository->findOneBy([
            'username' => $username,
        ]);

        if (empty($user) || ! password_verify($password, $user->password)) {
            addFlash('Invalid credentials', 'danger');
            view('index/login');

            return;
        }

        login($user);
        redirect(ROUTE_INDEX);
    }

    public function logout(): void
    {
        logout();
        redirect(ROUTE_INDEX);
    }
}
