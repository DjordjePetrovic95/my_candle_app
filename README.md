# INSTRUKCIJE

1. podesiti virtual host i dodati entitet u hosts fajlu
2. proveriti da li je fajl upload podesen u `php.ini`
    - `file_uploads = On`
    - `upload_max_filesize = 50M`
3. napraviti bazu i tabele pomocu skripte `migration/cande_shop.sql`
4. vec postojeci korisnici:
    - `djordje_admin` / `djordje_admin`
    - `djordje_user` / `djordje_user`
5. ako ima potrebe azurirati `config/config.php`