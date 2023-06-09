Laravel-E-commerce
This repository contains an e-commerce project built with Laravel. Follow the instructions below to set up and run the project:

Clone the repository:

Copy code
```php
git clone git@github.com:abdurrahmanekecik/Laravel-E-commerce.git
cd Laravel-E-commerce
Rename the .env.example file to .env.
```
Update the .env file with your database and Iyzico payment gateway information.

Generate an application key:

Copy code
```php
php artisan key:generate
```
Run the database migrations:


Copy code
```php
php artisan migrate
```
Seed the database with sample data:

Copy code
```php
php artisan db:seed
```
Start the Laravel development server:


Copy code
```php
php artisan serve
```
Access the site:

If you are working locally, open your web browser and go to http://127.0.0.1:8000/.
If you are working from the site link you set up or in the local network, use the appropriate URL.
To access the admin panel, use the following credentials:

```php
Email: info@abdurrahmanekecik.com
Password: 123456
```
To view the list of uploaded products, visit http://127.0.0.1:8000/products/.

Feel free to make any additional improvements or customize the instructions further based on your requirements.

Do not forget to set Iyzico, Mail and Google socialite settings. You will make the adjustments by updating the relevant fields in the .env file.

