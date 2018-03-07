# WordPress Plugin Library

[![PHP from Packagist](https://img.shields.io/packagist/php-v/thefrosty/wp-plugin.svg)]()
[![Latest Stable Version](https://img.shields.io/packagist/v/thefrosty/wp-plugin.svg)](https://packagist.org/packages/thefrosty/wp-plugin)
[![Total Downloads](https://img.shields.io/packagist/dt/thefrosty/wp-plugin.svg)](https://packagist.org/packages/thefrosty/wp-plugin)
[![License](https://img.shields.io/packagist/l/thefrosty/wp-plugin.svg)](https://packagist.org/packages/thefrosty/wp-plugin)
[![Build Status](https://travis-ci.org/thefrosty/wp-plugin.svg?branch=master)](https://travis-ci.org/thefrosty/wp-plugin)

Adds some structure to your WordPress plugins.

Requires PHP 7.0+.

## Installation

To use this library in your project, add it to `composer.json`:

```sh
composer require thefrosty/wp-plugin
```

## Creating a Plugin

A plugin is a simple object created to help bootstrap functionality by allowing you to easily retrieve plugin
information, reference internal files and URLs, and register hooks.

```php
<?php
/**
 * Plugin Name: Structure
 */

use TheFrosty\WP\Plugin\PluginFactory;

// This shouldn't be necessary if using Composer in your project.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

$structure = PluginFactory::create( 'structure' );
```

`$stucture` is an instance of `Plugin` and implements the `PluginInterface`, which provides a basic API to access
information about the plugin.

## Hook Providers

Related functionality can be encapsulated in a class called a "hook provider" that's registered when bootstrapping
the plugin.

Hook providers allow you to encapsulate related functionality, maintain state without using globals, namespace methods
without prefixing functions, limit access to internal methods, and make unit testing easier.

For an example, the `TheFrosty\WP\Plugin\Provider\I18n` class is a default hook provider that automatically loads the
text domain so the plugin can be translated.

The only requirement for a hook provider is that it should implement the `HookProviderInterface` by defining a
method called `register_hooks()`.

Hook providers are registered with the main plugin instance by calling `Plugin::register_hooks()` like this:

```php
<?php

use Structure\PostType\BookPostType;
use TheFrosty\WP\Plugin\Provider\I18n;
use TheFrosty\WP\Plugin\PluginInterface;

/** @var PluginInterface $structure */
$structure
	->register_hooks( new I18n() )
	->register_hooks( new BookPostType() );
```

The `BookPostType` provider _might_ look something like this:

```php
<?php
namespace Structure\PostType;

use TheFrosty\WP\Plugin\AbstractHookProvider;

class BookPostType extends AbstractHookProvider {
	const POST_TYPE = 'book';

	public function register_hooks() {
		$this->add_action( 'init', [ $this, 'register_post_type' ] );
		$this->add_action( 'init', [ $this, 'register_meta' ] );
	}

	protected function register_post_type() {
		register_post_type( self::POST_TYPE, $this->get_args() );
	}

	protected function register_meta() {
		register_meta( 'post', 'isbn', array(
			'type'              => 'string',
			'single'            => true,
			'sanitize_callback' => 'sanitize_text_field',
			'show_in_rest'      => true,
		) );
	}

	private function get_args() {
		return [
			'hierarchical'      => false,
			'public'            => true,
			'rest_base'         => \rtrim( self::POST_TYPE, 's' ) . 's',
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_nav_menus' => false,
			'show_in_rest'      => true,
		];
	}
}
```

## Protected Hook Callbacks

In WordPress, it's only possible to use public methods of a class as hook callbacks, but in the `BookPostType` hook
provider above, the callbacks are protected methods of the class.

Locking down the API like that is possible using the `HooksTrait`
[developed by John P. Bloch](https://github.com/johnpbloch/wordpress-dev).

## Plugin Awareness

A hook provider may implement the `PluginAwareInterface` to automatically receive a reference to the plugin
when its hooks are registered.

For instance, in this class the `enqueue_assets()` method references the internal `$plugin` property to retrieve the
URL to a JavaScript file in the plugin.

```php
<?php
namespace Structure\Provider;

use TheFrosty\WP\Plugin\AbstractHookProvider;

class Assets extends AbstractHookProvider {
	public function register_hooks() {
		$this->add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
	}

	protected function enqueue_assets() {
		wp_enqueue_script(
			'structure',
			$this->get_plugin()->get_url( 'assets/js/structure.js' )
		);
	}
}
```

Another example is the `I18n` provider mentioned earlier. It receives a reference to the plugin object so that it
can use the plugin's base name and slug to load the text domain.

Classes that extend `AbstractHookProvider` are automatically "plugin aware".

## Dependency Injection Container

When using the `PluginFactory` to create a plugin instance, the plugin will automatically have access to a
dependency injection container for registering and accessing dependencies.

[Pimple](https://pimple.symfony.com/) is used as the default container, but it can be replaced with any container
that implements the [PSR-11 container interface](https://github.com/php-fig/container).

```php
<?php
/**
 * Plugin Name: Structure
 */

use TheFrosty\WP\Plugin\PluginFactory;
use Structure\ServiceProvider;

// This shouldn't be necessary if using Composer in your project.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

$structure = PluginFactory::create( 'structure' );

// Retrieve the container and register a service provider.
$structure
	->get_container()
	->register( new ServiceProvider() );
```

## License

Copyright (c) 2017 Cedaro, LLC

This library is licensed under MIT.

Attribution is appreciated, but not required.
