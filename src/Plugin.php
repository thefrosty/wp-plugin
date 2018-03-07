<?php declare( strict_types=1 );
/**
 * Generic plugin implementation.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

/**
 * Main plugin class.
 *
 * @package TheFrosty\WP\Plugin
 */
class Plugin extends AbstractPlugin {

    use ContainerAwareTrait;
}
