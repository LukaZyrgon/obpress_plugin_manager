<?php

class OBPress_Deactivator {
    public static function deactivate() {
        delete_option('obpress_api_set');
		delete_option('obpress_api_token');
		delete_option('chain_id');
		delete_option('hotel_id');
        delete_option('default_currency_id');
        delete_option('default_language_id');
        delete_option('default_language');
        delete_option('calendar_adults');
        delete_option('removed_hotels');
        delete_option('changed_max_rooms');
        delete_option('allow_unavail_dates');
        delete_option('footer_api_option');
        delete_option('obpress_google_maps_api_key');
        delete_option('removed_packages');
        delete_option('package_order');
        //delete_option('children_disabled');
        flush_rewrite_rules();
    }
}
