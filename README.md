 # Local Commodity Exchange (ELCX)

Simple PHP + static assets marketplace project for local commodity trading.

## Summary

This repository contains a PHP/HTML website meant to run on a local webserver (XAMPP). It includes frontend assets, admin pages, and simple PHP pages that expect a MySQL database connection via `connection.php`.

## Requirements

- XAMPP (Apache + MySQL) or any PHP webserver
- PHP 7.4+ recommended

## Quick start (local)

1. Place the project in your web server document root. Example with XAMPP:

```bash
# path used in this repo
# copy the folder to Apache htdocs if not already
# (already located at C:/xampp/htdocs/local_commodity)
```

2. Start Apache and MySQL using XAMPP Control Panel.

3. Create a MySQL database and import any SQL dump you have (this repo does not include a DB dump).

4. Update database credentials in `connection.php` (do not commit secrets):

```php
// connection.php
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'your_database_name';
```

5. Open the site in your browser:

```
http://localhost/local_commodity/
```

## Notes

- `.gitignore` exists and excludes common files (IDE folders, uploads, node_modules, vendor, .env).
- Remove any sensitive files before making the repo public.

## Contributing

- Create a feature branch, push to GitHub, and open a Pull Request.
