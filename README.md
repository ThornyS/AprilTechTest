# AprilTechTest
Technical Test

Bank details:
<table>
<tr><th>Bank</th><th>Card number</th><th>Expiry date</th></tr>
<tr><td>HSBC Canada</td><td>5601-2345-3446-5678</td><td>Nov-2017</td></tr>
<tr><td>Royal Bank of Canada</td><td>4519-4532-4524-2456</td><td>Oct-2017</td></tr>
<tr><td>American Express</td><td>3786-7334-8965-345</td><td>Dec-2018</td></tr>
</table>

Using the information provided above as a guide, write a program that will output data based on the
criteria provided below:

 1. Sort the data by Expiry date in descending order
 2. Replace card number after the first 4 digits with ‘x’, e.g. 5601-2345-3446-5678 becomes 5601-xxxx-xxxx-xxxx

You should wrap this code into a stand-alone web application that can be run/deployed easily.
The end user should be able to enter the card data manually, one row at a time, or upload a CSV file
with the columns in the order shown above. Inputted data need only be stored for the duration of
the user’s session.
The results should be presented on a web page.

NOTE:
Your code should be shared on a public Git repository such as Github or Bitbucket.
It should include everything necessary to build the application.

### Installation

```
cd /path/to/repo/
composer install
cp .env.example .env
php artisan key:generate
```

Now either run locally on port 8000 with
```
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
