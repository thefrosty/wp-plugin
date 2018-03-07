<?php declare( strict_types=1 );
/**
 * Container aware trait.
 *
 * Container implementation courtesy of Slim 3.
 *
 * @package   TheFrosty\WP\Plugin
 * @link      https://github.com/slimphp/Slim/blob/e80b0f8b4d23e165783e8bf241b31c35272b0e28/Slim/App.php
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace TheFrosty\WP\Plugin;

use Psr\Container\ContainerInterface;

/**
 * Container aware trait.
 *
 * @package TheFrosty\WP\Plugin
 */
trait ContainerAwareTrait {
    /**
     * Container.
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Proxy access to container services.
     *
     * @param  string $name Service name.
     * @return mixed
     * @inheritdoc
     */
    public function __get( string $name ) {
        return $this->get_container()->get( $name );
    }

    /**
     * Whether a container service exists.
     *
     * @param  string $name Service name.
     * @return bool
     */
    public function __isset( $name ) : bool {
        return $this->get_container()->has( $name );
    }

    /**
     * Calling a non-existant method on the class checks to see if there's an
     * item in the container that is callable and if so, calls it.
     *
     * @param  string $method Method name.
     * @param  array $args Method arguments.
     * @return mixed
     * @inheritdoc
     */
    public function __call( string $method, array $args ) {
        if ( $this->get_container()->has( $method ) ) {
            $object = $this->container->get( $method );
            if ( \is_callable( $object ) ) {
                return \call_user_func_array( $object, $args );
            }
        }

        return false;
    }

    /**
     * Enable access to the DI container by plugin consumers.
     *
     * @return ContainerInterface
     */
    public function get_container() : ContainerInterface {
        return $this->container;
    }

    /**
     * Set the container.
     *
     * @param  ContainerInterface $container Dependency injection container.
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function set_container( ContainerInterface $container ) : parent {
        if ( ! ( $container instanceof ContainerInterface ) ) {
            throw new \InvalidArgumentException( 'Expected a . ' . ContainerInterface::class );
        }

        $this->container = $container;

        return $this;
    }
}
