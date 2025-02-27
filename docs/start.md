

# Installation
1. Install latest version of laravel
```sh
    larevl new app-name
    laravel starter kits
    cd app-name
    composer run dev
    php artisan install:api
```

# configuration
2. configure laravel application [routes/api/auth.php]
```sh
    php artisan make:controller Api/AuthController
```

# Other library dependencies
3. Install laravel permission, cloudinary and scrable api docs
```sh
     composer require spatie/laravel-permission
     * composer require cloudinary-labs/cloudinary-laravel
     composer require thomasvantuycom/flysystem-cloudinary
```