<?php
/**
 * Plugin interface.
 *
 * @package   Cedaro\WP\Plugin
 * @author    John P. Bloch
 * @author    Brady Vercher
 * @link      https://github.com/johnpbloch/wordpress-dev
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Plugin interface.
 *
 * @package Cedaro\WP\Plugin
 */
interface PluginInterface {
	/**
	 * Retrieve the relative path to the main plugin file from the main plugin
	 * directory.
	 *
	 * @return string
	 */
    public function get_basename(): string;

	/**
	 * Set the plugin basename.
	 *
	 * @param string $basename Relative path from the main plugin directory.
	 * @return $this
	 */
	public function set_basename( string $basename ): self;

	/**
	 * Retrieve the plugin directory.
	 *
	 * @return string
	 */
	public function get_directory(): string;

	/**
	 * Set the plugin's directory.
	 *
	 * @param  string $directory Absolute path to the main plugin directory.
	 * @return $this
	 */
	public function set_directory( string $directory ): self;

	/**
	 * Retrieve the path to a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function get_path( string $path = '' ): string;

	/**
	 * Retrieve the absolute path for the main plugin file.
	 *
	 * @return string
	 */
	public function get_file(): string;

	/**
	 * Set the path to the main plugin file.
	 *
	 * @param  string $file Absolute path to the main plugin file.
	 * @return $this
	 */
	public function set_file( string $file ): self;

	/**
	 * Retrieve the plugin identifier.
	 *
	 * @return string
	 */
	public function get_slug(): string;

	/**
	 * Set the plugin identifier.
	 *
	 * @param  string $slug Plugin identifier.
	 * @return $this
	 */
	public function set_slug( string $slug ): self;

	/**
	 * Retrieve the URL for a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function get_url( string $path = '' ): string;

	/**
	 * Set the URL for plugin directory root.
	 *
	 * @param  string $url URL to the root of the plugin directory.
	 * @return $this
	 */
	public function set_url( string $url ): self;

	/**
	 * Register hooks for the plugin.
	 *
	 * @param HookProviderInterface $provider Hook provider.
     * @return $this
	 */
	public function register_hooks( HookProviderInterface $provider ): self;
}
