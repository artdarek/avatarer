# Avatarer - Social media avatars for Laravel 5

Easy get avatars from social services like Facebook.com and Gravatar.com for Laravel 5

---

- [Installation](#installation)
- [Supported Providers](#supported-providers)
- [Registering the Package](#registering-the-package)
- [Usage](#usage)
- [Output Formating](#output-formating)

## Supported Providers 

A Provider can be a social network service that allows to get it's users avatars.
As for right now we support:

- Gravatar
- Facebook
- Twitter

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
  "artdarek/avatarer": "2.0.*"
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
    'Avatarer'    => Artdarek\Avatarer\Support\Laravel\Facades\Avatarer::class,
],
```

## Usage

#### Initialize

To ninitialize avatarer call make() method and pass provider name (service name like Gravatar/Facebook/Twitter):

```php
<?php

	// create avatarer object using Gravatar driver
 	$gravatarAvatar = Avatarer::make('Gravatar');

	// create avatarer object using Facebook driver
 	$facebookAvatar = Avatarer::make('Facebook');

	// create avatarer object using Twitter driver
 	$twitterAvatar = Avatarer::make('Twitter');
?>
```

#### Setting a user

Generating avatar with default settings is very simple and all you have to do is to call
``user()`` method with user id as a parameter (can be email/id/screenname):

For Gravatar we use Email:

```php
<?php
	// user email
	$email = "example@user.email";

	// create avatarer object
 	$avatar = Avatarer::make('Gravatar');
 	$avatar->user( $email );

	// get url
	$url = $avatar->get();

?>
```

For Facebook we use UserID:

```php
<?php
	// user id
	$userID = "838979896180389";

	// create avatarer object
 	$avatar = Avatarer::make('Facebook');
 	$avatar->user( $userID );

	// get url
	$url = $avatar->get();
?>
```

For Twitter we use user ScreenName:

```php
<?php
	// user id
	$userScreenName = "artdarek";

	// create avatarer object
 	$avatar = Avatarer::make('Twitter');
 	$avatar->user( $userScreenName );

	// get url
	$url = $avatar->get();
?>
```

#### Setting avatar size

If you want to set a size of avatar that should be returned you can use ``size()`` method.
This method can take two parameters ``width`` and ``height`` and both are optional 
(notice that not all providers will require or use both width and height, for example 
Gravatar expects only width).

For Gravatar:

```php
<?php
	// create a gravatar object for specified email
 	$avatar = Avatarer::make('Gravatar');
 	$avatar->user( $email );
 	$avatar->size( 200 );

	// get url
	$url = $avatar->get();
?>
```

For Facebook:

```php
<?php
	// create a gravatar object for specified email
 	$avatar = Avatarer::make('Facebook');
 	$avatar->user( $userID );
 	$avatar->size( 200, 200 );

	// get url
	$url = $avatar->get();
?>
```

#### Setting provider-specific options

If you want to customize avatar a little bit more you can set some additional parameters 
using ``options()`` method.

For Gravatar:

```php
<?php
	// create a gravatar object for specified email
 	$avatar = Avatarer::make('Gravatar');
 	$avatar->user( $email );
 	$avatar->size( 200 );
 	$avatar->options([
		'default' => 'mm', // Url to your default avatar image or [ 404 | mm | identicon | monsterid | wavatar | blank | retro ]
		'forceDefault' => null, // If for some reason you wanted to force the default image to always load [ y ]
		'ratings' => 'g', // Maximum rating (inclusive) [ g | pg | r | x ]
 	]);

	// get url
	$url = $avatar->get();
?>
```

For Facebook:

```php
<?php
	// create a gravatar object for specified email
 	$avatar = Avatarer::make('Facebook');
 	$avatar->user( $userID );
 	$avatar->size( 200, 200 );
 	$avatar->options([
 		'type' => 'square', // Type of avatar [ small, normal, album, large, square ]
 	]);

	// get url
	$url = $avatar->get();
?>
```
#### Methods chaining

If thats more convinient for you you can chain all methods like below:

```php
<?php
 	$url = Avatarer::make('Gravatar')
 		->user( $email )
 		->size(220)
 		->options([
			'default' => 'mm'
			'ratings' => 'g'
 		])->get();
?>
```

## Output Formating 

#### Default string output

With Avatarer by using ``get()`` method you can get url string of user avatar:

```php
<?php
	// create some Avatarer object
 	$avatar = Avatarer::make('Gravatar')->user( $email )->size('200');
	$url = $avatar->get();
?>
```

#### Changing output format

If you wish to get output in different format like Array, Json or even HTML code
you can do that by calling ``get()`` method with Output object that implements 
OutputInterface as a parameter:

To get Array (add ``use \Artdarek\Avatarer\Output\ToArray;`` at the top of your class):

```php
<?php
	// create some Avatarer object
 	$avatar = Avatarer::make('Gravatar')->user( $email )->size('200');
	$url = $avatar->get(new ToArray);
?>
```

To get JSON (add ``use \Artdarek\Avatarer\Output\ToJson;`` at the top of your class):

```php
<?php
	// create some Avatarer object
 	$avatar = Avatarer::make('Gravatar')->user( $email )->size('200');
	$url = $avatar->get(new ToJson);
?>
```

To get Object (add ``use \Artdarek\Avatarer\Output\ToObject;`` at the top of your class):

```php
<?php
	// create some Avatarer object
 	$avatar = Avatarer::make('Gravatar')->user( $email )->size('200');
	$url = $avatar->get(new ToObject);
?>
```

To get HTML (add ``use \Artdarek\Avatarer\Output\ToHtml;`` at the top of your class):

```php
<?php
	// create some Avatarer object
 	$avatar = Avatarer::make('Gravatar')->user( $email )->size('200');
	$url = $avatar->get(new ToHtml);
?>
```

If you want to have more controll over returned HTML code you can pass array with
additional attributes via ``ToHtml()`` constructor, for examle:

```php
<?php
	// create some Avatarer object
 	$avatar = Avatarer::make('Gravatar')->user( $email )->size('200');
	$url = $avatar->get(
		new ToHtml([
			'class' => 'avatar',
			'id' => 'user123' 
		])
	);
?>
```