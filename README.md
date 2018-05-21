# LegalZoomTechTest

### Installation

```bash
cd /path/to/repo/
composer install
cp .env.example .env
php artisan key:generate
```
Now either run locally on port 8000 with
```bash
php artisan serve
```
or configure a web serve to point its document root to /path/to/repo/public e.g. for Apache2

```
<VirtualHost *:80>
    ServerName bankcards.localhost.com
    DocumentRoot /path/to/repo/public
    <Directory /path/to/repo/public >
        AllowOverride all
    </Directory>
</VirtualHost>
```
### Testing
```bash
cd /path/to/repo
./vendor/bin/phpunit
```
