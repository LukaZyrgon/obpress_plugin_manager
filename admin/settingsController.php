<?php
$chain = get_option('chain_id');

$currencies = BeApi::getCurrencies($chain)->Result;
$languages = BeApi::getLanguages($chain)->Result;

$hotelFolders = BeApi::getClientPropertyFolders($chain)->Result;
$hotelFromFolder = [];

foreach($hotelFolders as $hotelFolder) {
    if($hotelFolder->IsPropertyFolder == false) {
        array_push($hotelFromFolder, $hotelFolder);
    }
}

$currency = "1";

$language = "1";

$mobile = "false";

$available_packages = BeApi::ApiCache('available_packages_'.$chain.'_'.$currency.'_'.$language.'_'.$mobile, BeApi::$cache_time['available_packages'], function() use ($chain, $currency, $language, $mobile){
            return BeApi::getClientAvailablePackages($chain, $currency, $language, null, $mobile);
        });