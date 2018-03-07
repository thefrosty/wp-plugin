<?php declare( strict_types=1 );
/**
 * Hook provider interface.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

/**
 * Hook provider interface.
 *
 * @package TheFrosty\WP\Plugin
 */
interface HookProviderInterface {
    /**
     * Registers hooks for the plugin.
     */
    public function register_hooks();
}
