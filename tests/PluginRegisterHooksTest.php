<?php

namespace TheFrosty\WP\Plugin\Test;

use TheFrosty\WP\Plugin\AbstractHookProvider;
use TheFrosty\WP\Plugin\HookProviderInterface;
use TheFrosty\WP\Plugin\Plugin;
use TheFrosty\WP\Plugin\Test\Framework\TestCase;

class PluginRegisterHooksTest extends TestCase {
    public function test_register_hooks() {
        $provider = $this->get_mock_provider();

        try {
            $class = new \ReflectionClass( $provider );
            $property = $class->getProperty( 'plugin' );
            $property->setAccessible( true );
        } catch ( \ReflectionException $exception ) {
            $this->assertInstanceOf( \ReflectionException::class, $exception );

            return;
        }

        $provider->expects( $this->exactly( 1 ) )->method( 'register_hooks' );

        $plugin = new Plugin();
        /** @var HookProviderInterface $provider */
        $plugin->register_hooks( $provider );

        $this->assertSame( $plugin, $property->getValue( $provider ) );
    }

    protected function get_mock_provider() {
        return $this->getMockBuilder( AbstractHookProvider::class )
            ->getMockForAbstractClass();
    }
}
