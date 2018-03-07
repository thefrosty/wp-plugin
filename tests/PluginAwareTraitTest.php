<?php

namespace TheFrosty\WP\Plugin\Test;

use TheFrosty\WP\Plugin\Plugin;
use TheFrosty\WP\Plugin\PluginAwareTrait;
use TheFrosty\WP\Plugin\Test\Framework\TestCase;

class PluginAwareTraitTest extends TestCase {
    public function test_set_plugin() {
        $provider = $this->getMockForTrait( PluginAwareTrait::class );

        try {
            $class = new \ReflectionClass( $provider );
            $property = $class->getProperty( 'plugin' );
            $property->setAccessible( true );
        } catch ( \ReflectionException $exception ) {
            $this->assertInstanceOf( \ReflectionException::class, $exception );

            return;
        }

        $plugin = new Plugin();
        /** @var PluginAwareTrait $provider */
        $provider->set_plugin( $plugin );

        $this->assertSame( $plugin, $property->getValue( $provider ) );
    }
}
