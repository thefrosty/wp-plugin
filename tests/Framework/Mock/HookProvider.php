<?php

namespace TheFrosty\WP\Plugin\Test\Framework\Mock;

use TheFrosty\WP\Plugin\AbstractHookProvider;

class HookProvider extends AbstractHookProvider {
    public function register_hooks() {
    }

    public function register_actions() {
        return $this->add_action( 'template_redirect', [ $this, 'template_redirect' ] );
    }

    public function template_redirect() {
    }

    public function register_filters() {
        return $this->add_filter( 'the_title', [ $this, 'get_title' ] );
    }

    public function get_title() {
        return 'Title';
    }
}
