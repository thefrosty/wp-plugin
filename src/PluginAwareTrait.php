<?php declare( strict_types=1 );
/**
 * Basic implementation of PluginAwareInterface.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

/**
 * Plugin aware trait.
 *
 * @package TheFrosty\WP\Plugin
 */
trait PluginAwareTrait {
    /**
     * Main plugin instance.
     *
     * @var PluginInterface
     */
    private $plugin;

    /**
     * Set the main plugin instance.
     *
     * @param  PluginInterface $plugin Main plugin instance.
     * @return PluginInterface
     */
    public function set_plugin( PluginInterface $plugin ) : PluginInterface {
        $this->plugin = $plugin;

        return $plugin;
    }

    /**
     * Get the main plugin instance.
     *
     * @return PluginInterface
     */
    public function get_plugin() : PluginInterface {
        return $this->plugin;
    }
}
