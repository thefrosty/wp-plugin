<?php

namespace TheFrosty\WP\Plugin\Test;

use TheFrosty\WP\Plugin\AbstractHookProvider;
use TheFrosty\WP\Plugin\HookProviderInterface;
use TheFrosty\WP\Plugin\PluginAwareInterface;
use TheFrosty\WP\Plugin\Test\Framework\TestCase;

class AbstractHookProviderTest extends TestCase {
    public function test_implements_interfaces() {
        $provider = $this->get_mock_provider();
        $this->assertInstanceOf( HookProviderInterface::class, $provider );
        $this->assertInstanceOf( PluginAwareInterface::class, $provider );
    }

    protected function get_mock_provider() {
        return $this->getMockBuilder( AbstractHookProvider::class )->getMockForAbstractClass();
    }
}
