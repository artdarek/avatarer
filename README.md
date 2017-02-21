# Avatarer - Social media avatars for Laravel 5

Easy get avatars from social services like Facebook.com and Gravatar.com 
- initially package was build for Laravel 5 but it can work as standalone library too.

---

- [Supported Providers](#supported-providers)
- [Installation](#installation)
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
    'Avatarer' => Artdarek\Avatarer\Support\Laravel\Facades\Avatarer::class,
],
```

## Usage

#### Initialize

To ininitialize Avatarer call make() method and pass Provider name (service name like Gravatar/Facebook/Twitter):

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
	...

	// create avatarer object using Gravatar provider
 	$avatar = Avatarer::make(Gravatar::class);
?>
```

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Facebook;
	...

	// create avatarer object using Facebook provider
 	$avatar = Avatarer::make(Facebook::class);
?>
```

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Twitter;
	...

	// create avatarer object using Gravatar provider
 	$avatar = Avatarer::make(Twitter::class);
?>
```

If you want to use Avatarer library outside of Laravel framework or you 
don't want to use ``Avatarer Facade`` in your Laravel application, you can do this:

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
	...

	// create avatarer object
 	$avatar = new \Artdarek\Avatarer\Avatarer;
 	$avatar->make(Gravatar::class);
?>
```

or

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
	...

	// create avatarer object
 	$avatar = (new \Artdarek\Avatarer\Avatarer)->make(Gravatar::class);
?>
```

or 

```php
<?php
	use \Artdarek\Avatarer\Avatarer;
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
	...

	// create avatarer object
 	$avatar = (new Avatarer)->make(Gravatar::class);
?>
```

#### Setting a user

Generating avatar with default settings is very simple and all you have to do is to call
``user()`` method with user id as a parameter (each Provider can identify user differently 
via email/id/screenname etc.):

For Gravatar we use Email:

```php
<?php

	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
	...

	// user email
	$email = "example@user.email";

	// create avatarer object
 	$avatar = Avatarer::make(Gravatar::class);
 	$avatar->user( $email );

	// get url
	$url = $avatar->get();

?>
```

For Facebook we use UserID:

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Facebook;
	...

	// user id
	$userID = "838979896180389";

	// create avatarer object
 	$avatar = Avatarer::make(Facebook::class);
 	$avatar->user( $userID );

	// get url
	$url = $avatar->get();
?>
```

For Twitter we use user ScreenName:

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Twitter;
	...

	// user id
	$userScreenName = "artdarek";

	// create avatarer object
 	$avatar = Avatarer::make(Twitter::class);
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
	// create avatarer object
 	$avatar = Avatarer::make(Gravatar::class);
 	$avatar->user( $email );
 	$avatar->size( 200 );

	// get url
	$url = $avatar->get();
?>
```

For Facebook:

```php
<?php
	// create avatarer object
 	$avatar = Avatarer::make(Facebook::class);
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
	// create avatarer object
 	$avatar = Avatarer::make(Gravatar::class);
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
 	$avatar = Avatarer::make(Facebook::class);
 	$avatar->user( $userID );
 	$avatar->size( 200, 200 );
 	$avatar->options([
 		'type' => 'square', // Type of avatar [ small, normal, album, large, square ]
 	]);
	$url = $avatar->get();
?>
```
#### Methods chaining

If thats more convinient for you you can chain all methods like below:

```php
<?php
 	$url = Avatarer::make(Gravatar::class)
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
 	$avatar = Avatarer::make(Gravatar::class)->user( $email )->size('200');
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
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
    use \Artdarek\Avatarer\Output\ToArray;
    ...

 	$avatar = Avatarer::make(Gravatar::cass)->user( $email )->size('200');
	$url = $avatar->get(new ToArray);
?>
```

To get JSON (add ``use \Artdarek\Avatarer\Output\ToJson;`` at the top of your class):

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
    use \Artdarek\Avatarer\Output\ToJson;
    ...

 	$avatar = Avatarer::make(Gravatar::cass)->user( $email )->size('200');
	$url = $avatar->get(new ToJson);
?>
```

To get Object (add ``use \Artdarek\Avatarer\Output\ToObject;`` at the top of your class):

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
    use \Artdarek\Avatarer\Output\ToObject;
    ...

 	$avatar = Avatarer::make(Gravatar::cass)->user( $email )->size('200');
	$url = $avatar->get(new ToObject);
?>
```

To get HTML (add ``use \Artdarek\Avatarer\Output\ToHtml;`` at the top of your class):

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
    use \Artdarek\Avatarer\Output\ToHtml;
    ...

 	$avatar = Avatarer::make(Gravatar::cass)->user( $email )->size('200');
	$url = $avatar->get(new ToHtml);
?>
```

If you want to have more controll over returned HTML code you can pass array with
additional attributes via ``ToHtml()`` constructor, for examle:

```php
<?php
	use \Artdarek\Avatarer\Avatar\Provider\Gravatar;
    use \Artdarek\Avatarer\Output\ToHtml;
    ...

 	$avatar = Avatarer::make(Gravatar::cass)->user( $email )->size('200');
	$url = $avatar->get(
		new ToHtml([
			'class' => 'avatar',
			'id' => 'user123' 
		])
	);
?>
```