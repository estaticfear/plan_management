**INSTALLATION**

Install package using composer:
```php
composer require ixosoftware/laravel-plan-management "^1.0.2"
```

Publish the configs, routes, migrations, views and translations
```
php artisan vendor:publish --provider="IXOSoftware\UserPermission\PlanManagementServiceProvider"
```

Setup `.env` file to use a database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acl4
DB_USERNAME=root
DB_PASSWORD=
```

```
php artisan migrate
php artisan db:seed
```
