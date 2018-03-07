<?php declare( strict_types=1 );
/**
 * Common plugin functionality.
 *
 * @package   TheFrosty\WP\Plugin
 * @author    John P. Bloch
 * @author    Brady Vercher
 * @link      https://github.com/johnpbloch/wordpress-dev
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

/**
 * Base plugin class.
 *
 * @package TheFrosty\WP\Plugin
 */
abstract class AbstractPlugin implements PluginInterface {
    /**
     * Plugin basename.
     *
     * Ex: plugin-name/plugin-name.php
     *
     * @var string
     */
    private $basename;

    /**
     * Absolute path to the main plugin directory.
     *
     * @var string
     */
    private $directory;

    /**
     * Absolute path to the main plugin file.
     *
     * @var string
     */
    private $file;

    /**
     * Plugin identifier.
     *
     * @var string
     */
    private $slug;

    /**
     * URL to the main plugin directory.
     *
     * @var string
     */
    private $url;

    /**
     * Retrieve the absolute path for the main plugin file.
     *
     * @return string
     */
    public function get_basename() : string {
        return $this->basename;
    }

    /**
     * Set the plugin basename.
     *
     * @param string $basename Relative path from the main plugin directory.
     * @return $this
     */
    public function set_basename( string $basename ) : PluginInterface {
        $this->basename = $basename;

        return $this;
    }

    /**
     * Retrieve the plugin directory.
     *
     * @return string
     */
    public function get_directory() : string {
        return $this->directory;
    }

    /**
     * Set the plugin's directory.
     *
     * @param string $directory Absolute path to the main plugin directory.
     * @return $this
     */
    public function set_directory( string $directory ) : PluginInterface {
        $this->directory = \rtrim( $directory, '/' ) . '/';

        return $this;
    }

    /**
     * Retrieve the path to a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     * @return string
     */
    public function get_path( string $path = '' ) : string {
        return $this->directory . \ltrim( $path, '/' );
    }

    /**
     * Retrieve the absolute path for the main plugin file.
     *
     * @return string
     */
    public function get_file() : string {
        return $this->file;
    }

    /**
     * Set the path to the main plugin file.
     *
     * @param string $file Absolute path to the main plugin file.
     * @return $this
     */
    public function set_file( string $file ) : PluginInterface {
        $this->file = $file;

        return $this;
    }

    /**
     * Retrieve the plugin identifier.
     *
     * @return string
     */
    public function get_slug() : string {
        return $this->slug;
    }

    /**
     * Set the plugin identifier.
     *
     * @param string $slug Plugin identifier.
     * @return $this
     */
    public function set_slug( string $slug ) : PluginInterface {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Retrieve the URL for a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     * @return string
     */
    public function get_url( string $path = '' ) : string {
        return $this->url . \ltrim( $path, '/' );
    }

    /**
     * Set the URL for plugin directory root.
     *
     * @param string $url URL to the root of the plugin directory.
     * @return $this
     */
    public function set_url( string $url ) : PluginInterface {
        $this->url = \rtrim( $url, '/' ) . '/';

        return $this;
    }

    /**
     * Register a hook provider.
     *
     * @param HookProviderInterface $provider Hook provider.
     * @return $this
     */
    public function register_hooks( HookProviderInterface $provider ) : PluginInterface {
        if ( $provider instanceof PluginAwareInterface ) {
            $provider->set_plugin( $this );
        }

        $provider->register_hooks();

        return $this;
    }
}
