# Avatarer - Social media avatars for Laravel 5

Easy get avatars from social services like Facebook.com and Gravatar.com for Laravel 5

---

- [Installation](#installation)
- [Registering the Package](#registering-the-package)
- [Usage](#usage)

## Installation 

#### Via composer require command

Use [composer](http://getcomposer.org) require command to install this package.

``` bash
$ composer require artdarek/avatarer
```

#### Adding package to composer.json file manually

Add package to your composer.json file:

```
"require": {
  "artdarek/avatarer": "dev-master"
}
```

Use [composer](http://getcomposer.org) update command to install this package.

``` bash
$ composer update
```

### Registering the Package

Add the Avatarer alias into your config file ``config/app.php``:

```php
'aliases' => [
    'Avatarer'    => Artdarek\Avatarer\Facades\Avatarer::class,
],
```

## Usage

#### Initialize

To ninitialize avatarer call driver() method:

```php
<?php

	// create avatarer object using Gravatar driver
 	$gravatarAvatar = Avatarer::driver('Gravatar');

	// create avatarer object using Facebook driver
 	$facebookAvatar = Avatarer::driver('Facebook');
?>
```

#### Generating avatar url by user() method

Generating avatar with default settings is very simple and all you have to do is to call
``user()`` method with user email as a paramterer:

```php
<?php
	// user email
	$email = "example@user.email";

	// create a gravatar object for specified email
 	$avatar = Avatarer::driver('Gravatar')->user( $email );

	 // get gravatar url as a string
	$url = $avatar->url();

?>
```

and similar for Facebook avatar:

```php
<?php
	// user id
	$userID = "838979896180389";

	// create a gravatar object for specified email
 	$avatar = Avatarer::driver('Facebook')->user( $userID );

	 // get gravatar url as a string
	$url = $avatar->url();
?>
```


If you want to customize avatar a little bit you can set some more parameters using additional methods
like ``size()``, ``rating()``, ``defaultImage()``.

```php
<?php
	// user email
	$email = "example@user.email";

	// create a gravatar object for specified email with additional settings
 	$avatar = Avatarer::driver('Gravatar')->user( $email );

 	// Size in pixels, defaults to 80px [ 1 - 2048 ]
	$avatar->size('220');

	// Maximum rating (inclusive) [ g | pg | r | x ]
	// defaults to 'g'
	$avatar->rating('g');

	// Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	// You can also specify url to your own default avatar image
	// defaults to 'mm'
	$avatar->defaultImage('mm');

    // set Avatarer to build urls with https [true = use https, false = ise http]
    // defaults to 'false'
    $avatar->secured( true );

	// get gravatar url as a string
	$url = $avatar->url();

?>
```

U can also chain all methods:

```php
<?php
 	$url = Avatarer::driver('Gravatar')->user( $email )->size('220')->rating('g')->defaultImage('mm')->url();
?>
```


#### Generating avatar url by make() method

Basic way to generate avatar url is just to call ``make()`` method with
user email address as a parameter (all other parameters will be loaded from defaults).

```php
<?php
	// user email
	$email = "example@user.email";

	// create a gravatar object for specified email
 	$avatar = Avatarer::driver('Gravatar')->make( $email );

	 // get gravatar url as a string
	$url = $avatar->url();

?>
```

U can aslo chain methods:

```php
<?php
	// to get url string
	$url = Avatarer::driver('Gravatar')->make( $email )->url();
?>
```

If you want specify size of avatar or some other additional parameters you can do this
by passing array with parameters to ``make()`` method:

```php
<?php
	// user email
	$email = "example@user.email";

	// create a gravatar object in specified size
 	$url = Avatarer::driver('Gravatar')->make( ['email' => $email, 'size' => 220] )->url();

	// create a gravatar object with some other additional parameters
 	$url = Avatarer::driver('Gravatar')->make( [
 		'email' => $email,
 		'size' => 220,
 		'defaultImage' => 'mm',
 		'rating' => 'g',
 	    'secured' => true
 	])->url();
?>
```


#### Generating HTM avatar code

With Avatarer you can get url string of user avatar by calling ``url()`` method
but also you can generate full html <img> code by calling ``html()`` method instead of ``url()``.

```php
<?php
	// user email
	$email = "example@user.email";

	// create some Avatarer object
 	$avatar = Avatarer::driver('Gravatar')->user( $email )->size('120');

	 // get gravatar <img> html code
	$html = $avatar->html();
?>
```

If you want to have more controll over
the returned html code you can pass some additional html attributes to html() method, for examle:

```php
<?php
	$html = Avatarer::driver('Gravatar')->user( $email )->html( ['class' => 'avatar', 'id' => 'user123' ] );
?>
```
