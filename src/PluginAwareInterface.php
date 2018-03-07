<?php declare( strict_types=1 );
/**
 * Plugin aware interface.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

/**
 * Plugin aware interface.
 *
 * @package TheFrosty\WP\Plugin
 */
interface PluginAwareInterface {
    /**
     * Set the main plugin instance.
     *
     * @param  PluginInterface $plugin Main plugin instance.
     * @return PluginInterface
     */
    public function set_plugin( PluginInterface $plugin ) : PluginInterface;
}
