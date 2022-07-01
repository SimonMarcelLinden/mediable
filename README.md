# Mediable for Laravel/Lumen

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

Laravel-Mediable is a package for easily uploading and attaching media files to models with Laravel/Lumen.

## Installation

Via Composer

``` bash
$ composer require simonmarcellinden/mediable
```

Register the package's service provider in config/app.php. In Laravel versions 5.5 and beyond, this step can be skipped if package auto-discovery is enabled.

Open and add the service provider to `bootstrap/app.php`
```php
	$app->register(\SimonMarcelLinden\Mediable\MediableServiceProvider::class);
```

### Publish the configurations
~~Run this on the command line from the root of your project:~~
```
$ no config needed
```

Run the migrations to add the required tables to your database.
```php 
$ php artisan migrate
```

## Example Usage 
### Example if you upload need a model for Images

Create a eloquent Model and Controller
```php
    php artisan make:model Image -c
```

Extend your eloquent model with the model from this package.

```php
<?php

namespace App\Models;

use SimonMarcelLinden\Mediable\Models\Media;

class Image extends Media {
	/**
	* If you want to use a different table than media , please specify it here.
	*
	* @var string
	*/
	protected $table = 'images';

	/**
	 * If you want your media to be stored in a specific file folder, then specify it here.
	 *
	 * @var array
	 */
	protected $basePath = 'images';
}
```
Extend your controller with the package controller and specify the eloquent model to be used in the controller. 

```php
<?php

namespace App\Http\Controllers;

use App\Models\Image;
use SimonMarcelLinden\Mediable\Http\Controllers\MediaController;

class ImageController extends MediaController {
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $model = Image::class;
}
```

Configure the default routes

```php
	$router->group(['prefix' => 'image'], function () use ($router) {
		$router->get('/{id}', 'ImageController@show');
		$router->post('/upload', 'ImageController@upload');
		$router->delete('/delete/{id}', 'ImageController@delete');
	});
```

If you need a many to many relation add the follow code to your media model.
```php
use SimonMarcelLinden\Mediable\Models\Media;

class Image extends Media {
	/**
     * Get all of the user that are assigned this model.
     */
    public function users() {
        return $this->morphedByMany(Drink::class, 'mediable');
    }

	/**
     * Get all of the products that are assigned this model.
     */
    public function products() {
        return $this->morphedByMany(Product::class, 'mediable');
	}
}
```
And add the follow code to your Elequent model

```php
class Product extends Model {
	use Uuids;

	public function media() {
        return $this->morphToMany(Image::class, 'mediable', 'mediables', 'mediable_id', "media_id");
    }
}

class User extends Model {
	use Uuids;

	public function media() {
        return $this->morphToMany(Image::class, 'mediable', 'mediables', 'mediable_id', "media_id");
    }
}
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email info@snerve.de instead of using the issue tracker.


[ico-version]: https://img.shields.io/packagist/v/simonmarcellinden/mediable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/simonmarcellinden/mediable.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/simonmarcellinden/mediable/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/simonmarcellinden/mediable
[link-downloads]: https://packagist.org/packages/simonmarcellinden/mediable
[link-travis]: https://travis-ci.org/simonmarcellinden/mediable
[link-author]: https://github.com/simonmarcellinden
[link-contributors]: ../../contributors
