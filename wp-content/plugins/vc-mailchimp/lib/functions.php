<?php

add_action( 'wp_ajax_vc_mailchimp_clear_cache', 'vc_mailchimp_clear_cache' );

function vc_mailchimp_clear_cache() {
	delete_transient( 'vc_mailchimp_lists' );
}
