# INSTRUKCIJE

1. podesiti virtual host i dodati entitet u hosts fajlu (nije obavezno)
2. proveriti da li je fajl upload podesen u `php.ini`
    - `file_uploads = On`
    - `upload_max_filesize = 50M`
3. napraviti bazu i tabele pomocu skripte `migration/candle_shop.sql`
4. ako ima potrebe azurirati `config/config.php` i konekciju sa bazom i url parametre
5. potrebno je generisati composer autoload pomocu `composer dump-autoload`
6. vec postojeci korisnici:
   - `djordje_admin` / `djordje_admin`
   - `djordje_user` / `djordje_user`