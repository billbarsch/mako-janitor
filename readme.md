# Mako Janitor

This is a simple system administrator package for Mako Framework 4.5.

This package provides an easy way to run migrations without CLI and manage system logs.

## Install

Use composer to install. Simply add package to your project.

```php
composer require softr/mako-janitor:*
```

So now you can update your project with a single command.

```php
composer update
```


### Register Service

After installing you'll have to register the package in your ``app/config/application.php`` file.

```
'packages' =>
[
    ...
    'web' =>
    [
        ...
        // Register the package for web app
        'softr\MakoJanitor\MakoJanitorPackage',
    ]
],
```

## Settings

The package comes with a few predefined settings like route prefix and password login. You are able to change default settings editing ``vendor/softr/mako-janitor/config/config.php`` file or you can override package settings creating a new file at ``app/config/packages/mako-janitor/config.php``.

## Done

The package is now ready to use. The default prefix is ``system-janitor``. So you can access it by typing ``http://yoursite.com/system-janitor``. Default password is ``admin``.