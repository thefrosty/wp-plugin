<?php

namespace TheFrosty\WP\Plugin\Test;

use TheFrosty\WP\Plugin\Test\Framework\Mock\HookProvider;
use TheFrosty\WP\Plugin\Test\Framework\TestCase;

class HooksTraitTest extends TestCase {
    public function test_filters_added() {
        $provider = $this->get_mock_provider();

        $provider->expects( $this->exactly( 1 ) )
            ->method( 'add_filter' )
            ->will( $this->returnCallback( function ( $hook, $method, $priority, $arg_count ) {
                TestCase::assertSame( 'the_title', $hook );
                TestCase::assertSame( 10, $priority );
                TestCase::assertSame( 1, $arg_count );
            } ) )
            ->willReturn( true );

        /** @var HookProvider $provider */
        $provider->register_filters();
    }

    public function test_actions_added() {
        $provider = $this->get_mock_provider();

        $provider->expects( $this->exactly( 1 ) )
            ->method( 'add_filter' )
            ->will( $this->returnCallback( function ( $hook, $method, $priority, $arg_count ) {
                TestCase::assertSame( 'template_redirect', $hook );
                TestCase::assertSame( 10, $priority );
                TestCase::assertSame( 1, $arg_count );
            } ) )
            ->willReturn( true );

        /** @var HookProvider $provider */
        $provider->register_actions();
    }

    protected function get_mock_provider() {
        return $this->getMockBuilder( HookProvider::class )
            ->setMethods( [ 'add_filter' ] )
            ->getMock();
    }
}
