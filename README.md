# RP ONLINE - projektni zadatak

Ovo je funkcionalno web sjedište prema zadanim referencama iz mape `RP Online`.

## Pokretanje

1. Kopirati mapu `rp-online-projekt` u XAMPP `htdocs`.
2. Pokrenuti Apache u XAMPP-u.
3. Otvoriti `http://localhost/rp-online-projekt/index.php`.

Stranica radi i bez baze pomoću početnih podataka iz PHP-a.

## MySQL baza

Za dio zadatka s bazom:

1. Pokrenuti MySQL u XAMPP-u.
2. Otvoriti phpMyAdmin.
3. Uvesti datoteku `database/rp_online.sql`.
4. Provjeriti podatke za spajanje u `config/config.php`.

Početna admin prijava:

- korisničko ime: `admin`
- lozinka: `admin123`

## Sadržaj projekta

- `index.php` - naslovnica s kategorijama Sport i Politik
- `article.php` - prikaz pojedinačnog članka
- `category.php` - filtriranje po kategoriji
- `login.php`, `register.php`, `logout.php` - korisnički dio
- `admin/index.php` - administracijski pregled članaka
- `admin/new_article.php` - unos novog članka
- `database/rp_online.sql` - export baze
- `assets/css/style.css` - izgled stranice
- `assets/img` - lokalne slike članaka i referentne slike
