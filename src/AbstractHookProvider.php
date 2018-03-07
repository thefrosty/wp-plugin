<?php declare( strict_types=1 );
/**
 * Base hook provider.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

/**
 * Base hook provider class.
 *
 * @package TheFrosty\WP\Plugin
 */
abstract class AbstractHookProvider implements HookProviderInterface, PluginAwareInterface {

    use HooksTrait, PluginAwareTrait;

    /**
     * Registers hooks for the plugin.
     */
    abstract public function register_hooks();
}
