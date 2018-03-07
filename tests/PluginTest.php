<?php declare( strict_types=1 );

namespace TheFrosty\WP\Plugin\Test;

use TheFrosty\WP\Plugin\Plugin;
use TheFrosty\WP\Plugin\PluginInterface;
use TheFrosty\WP\Plugin\Test\Framework\TestCase;

class PluginTest extends TestCase {
    public function test_implements_plugin_interface() {
        $plugin = new Plugin();
        $this->assertInstanceOf( PluginInterface::class, $plugin );
    }
}
