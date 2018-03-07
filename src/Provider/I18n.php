<?php declare( strict_types=1 );
/**
 * Internationalization provider.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin\Provider;

use TheFrosty\WP\Plugin\HookProviderInterface;
use TheFrosty\WP\Plugin\HooksTrait;
use TheFrosty\WP\Plugin\PluginAwareInterface;
use TheFrosty\WP\Plugin\PluginAwareTrait;

/**
 * Internationalization class.
 *
 * @package TheFrosty\WP\Plugin
 */
class I18n implements PluginAwareInterface, HookProviderInterface {

    use HooksTrait, PluginAwareTrait;

    /**
     * Register hooks.
     *
     * Loads the text domain during the `plugins_loaded` action.
     */
    public function register_hooks() {
        if ( \did_action( 'plugins_loaded' ) ) {
            $this->load_textdomain();
        } else {
            $this->add_action( 'plugins_loaded', [ $this, 'load_textdomain' ] );
        }
    }

    /**
     * Load the text domain to localize the plugin.
     */
    protected function load_textdomain() {
        load_plugin_textdomain(
            $this->get_plugin()->get_slug(),
            false,
            dirname( $this->get_plugin()->get_basename() ) . '/languages'
        );
    }
}
