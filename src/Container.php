<?php declare( strict_types=1 );
/**
 * Container.
 *
 * @package   TheFrosty\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

use Psr\Container\ContainerInterface;
use Pimple\Container as Pimple;

/**
 * Container class.
 *
 * Extends Pimple to satisfy the ContainerInterface.
 *
 * @package TheFrosty\WP\Plugin
 */
class Container extends Pimple implements ContainerInterface {
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     * @return mixed Entry.
     */
    public function get( $id ) {
        return $this->offsetGet( $id );
    }

    /**
     * Whether the container has an entry for the given identifier.
     *
     * @param string $id Identifier of the entry to look for.
     * @return bool
     */
    public function has( $id ) : bool {
        return $this->offsetExists( $id );
    }
}
