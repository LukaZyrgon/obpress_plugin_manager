<?php

class OBPress_Activator {
    public static function activate() {
        add_option('obpress_api_set', false);
		add_option('obpress_api_token', null);
		add_option('chain_id', null);
		add_option('hotel_id', null);
        add_option('default_currency_id', null);
        // add_option('default_language_id', null);
        add_option('default_language', null);
        add_option('calendar_adults', 1);
        add_option('removed_hotels', null);
        add_option('changed_max_rooms', null);
        add_option('allow_unavail_dates', false);
        add_option('footer_api_option', true);
        add_option('obpress_google_maps_api_key', null);
        add_option('removed_packages', null);
        add_option('package_order', null);
        //add_option('children_disabled', false);
        flush_rewrite_rules();
    }
}