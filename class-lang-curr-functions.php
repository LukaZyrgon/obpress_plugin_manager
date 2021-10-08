<?php

require_once(WP_PLUGIN_DIR . '/obpress_plugin_manager/BeApi/BeApi.php');

if ( ! class_exists( 'Lang_Curr_Functions' )) {
    Class Lang_Curr_Functions extends BeApi{
        private static $chain;
        private static $property;
        private static $loadLanguages;
        private static $hotel_search;
        private static $language_path;
        private static $languages;
        private static $language;
        private static $default_currency;
        private static $currencies;
        private static $currency;
        private static $language_object;        
        public static $browserLanguagesList = [
            "ca-ES" => [
                "name" => "Catalan (Spain)",
                "code" => 3
            ],
            "cy-GB" => [
                "name" => "Welsh (United Kingdom)",
                "code" => 1
            ],
            "da" => [
                "name" => "Danish",
                "code" => 5
            ],
            "da-DK" => [
                "name" => "Danish (Denmark)", 
                "code" => 5
            ],
            "de" => [
                "name" => "German",
                "code" => 7
            ],
            "de-AT" => [
                "name" => "German (Austria)",
                "code" => 7
            ],
            "de-CH" => [
                "name" => "German (Switzerland)",
                "code" => 7
            ],
            "de-DE" => [
                "name" => "German (Germany)",
                "code" => 7
            ],
            "de-LI" => [
                "name" => "German (Liechtenstein)",
                "code" => 7
            ],
            "de-LU" => [
                "name" => "German (Luxembourg)",
                "code" => 7
            ],
            "en" => [
                "name" => "English",
                "code" => 1
            ],
            "en-AU" => [
                "name" => "English (Australia)",
                "code" => 1
            ],
            "en-BZ" => [
                "name" => "English (Belize)",
                "code" => 1
            ],
            "en-CA" => [
                "name" => "English (Canada)",
                "code" => 1
            ],
            "en-CB" => [
                "name" => "English (Caribbean)",
                "code" => 1
            ],
            "en-GB" => [
                "name" => "English (United Kingdom)",
                "code" => 1
            ],
            "en-IE" => [
                "name" => "English (Ireland)",
                "code" => 1
            ],
            "en-JM" => [
                "name" => "English (Jamaica)",
                "code" => 1
            ],
            "en-NZ" => [
                "name" => "English (New Zealand)",
                "code" => 1
            ],
            "en-PH" => [
                "name" => "English (Republic of the Philippines)",
                "code" => 1
            ],
            "en-TT" => [
                "name" => "English (Trinidad and Tobago)",
                "code" => 1
            ],
            "en-US" => [
                "name" => "English (United States)",
                "code" => 1
            ],
            "en-ZA" => [
                "name" => "English (South Africa)",
                "code" => 1
            ],
            "en-ZW" => [
                "name" => "English (Zimbabwe)",
                "code" => 1
            ],
            "es" => [
                "name" => "Spanish",
                "code" => 3
            ],
            "es-AR" => [
                "name" => "Spanish (Argentina)",
                "code" => 3
            ],
            "es-BO" => [
                "name" => "Spanish (Bolivia)",
                "code" => 3
            ],
            "es-CL" => [
                "name" => "Spanish (Chile)",
                "code" => 3
            ],
            "es-CO" => [
                "name" => "Spanish (Colombia)",
                "code" => 3
            ],
            "es-CR" => [
                "name" => "Spanish (Costa Rica)",
                "code" => 3
            ],
            "es-DO" => [
                "name" => "Spanish (Dominican Republic)",
                "code" => 3
            ],
            "es-EC" => [
                "name" => "Spanish (Ecuador)",
                "code" => 3
            ],
            "es-ES" => [
                "name" => "Spanish (Castilian)",
                "code" => 3
            ],
            "es-ES" => [
                "name" => "Spanish (Spain)",
                "code" => 3
            ],
            "es-GT" => [
                "name" => "Spanish (Guatemala)",
                "code" => 3
            ],
            "es-HN" => [
                "name" => "Spanish (Honduras)",
                "code" => 3
            ],
            "es-MX" => [
                "name" => "Spanish (Mexico)",
                "code" => 3
            ],
            "es-NI" => [
                "name" => "Spanish (Nicaragua)",
                "code" => 3
            ],
            "es-PA" => [
                "name" => "Spanish (Panama)",
                "code" => 3
            ],
            "es-PE" => [
                "name" => "Spanish (Peru)",
                "code" => 3
            ],
            "es-PR" => [
                "name" => "Spanish (Puerto Rico)",
                "code" => 3
            ],
            "es-PY" => [
                "name" => "Spanish (Paraguay)",
                "code" => 3
            ],
            "es-SV" => [
                "name" => "Spanish (El Salvador)",
                "code" => 3
            ],
            "es-UY" => [
                "name" => "Spanish (Uruguay)",
                "code" => 3
            ],
            "es-VE" => [
                "name" => "Spanish (Venezuela)",
                "code" => 3
            ],
            "fr" => [
                "name" => "French",
                "code" => 2
            ],
            "fr-BE" => [
                "name" => "French (Belgium)",
                "code" => 2
            ],
            "fr-CA" => [
                "name" => "French (Canada)",
                "code" => 2
            ],
            "fr-CH" => [
                "name" => "French (Switzerland)",
                "code" => 2
            ],
            "fr-FR" => [
                "name" => "French (France)",
                "code" => 2
            ],
            "fr-LU" => [
                "name" => "French (Luxembourg)",
                "code" => 2
            ],
            "fr-MC" => [
                "name" => "French (Principality of Monoco)",
                "code" => 2
            ],
            "gl-ES" => [
                "name" => "Galician (Spain)",
                "code" => 3
            ],
            "pt-BR" => [
                "name" => "Portugeese (Brasil)",
                "code" => 8
            ],
            "pt-PT" => [
                "name" => "Portugeese (Portugal)",
                "code" => 4
            ],
            "it-IT" => [
                "name" => "Italian",
                "code" => 6
            ]
        ];


        public static function addLanguagePath($languages){
            
            foreach ($languages as $language) {
                if ($language->UID == 1) {
                    $language->Path = "en_US";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_American.svg';
                }
                if ($language->UID == 2) {
                    $language->Path = "fr_FR";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_French.svg';
                }
                if ($language->UID == 3) {
                    $language->Path = "es_ES";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_Spanish.svg';
                }
                if ($language->UID == 4) {
                    $language->Path = "pt_PT";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_PortuguesePT.svg';
                }
                if ($language->UID == 5) {
                    $language->Path = "da_DA";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_Dansk.svg';
                }
                if ($language->UID == 6) {
                    $language->Path = "it_IT";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_Italiano.svg';
                }
                if ($language->UID == 7) {
                    $language->Path = "de_DE";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_Deutch.svg';
                }
                if ($language->UID == 8) {
                    $language->Path = "pt_BR";
                    $language->Icon = get_template_directory_uri() . '/assets/icons/lang/icon_Lang_PortugueseBR.svg';
                }
            }
    
            return $languages;        
        }

        public static function ChainOrHotel() {
            if(get_option('chain_id') != null) {
                $chain = get_option('chain_id');
                $property = false;
                $loadLanguages = self::getLanguagesForChain($chain);
                $hotel_search = false;
                self::getCurrenciesForChain($chain);
            }
            elseif(get_option('hotel_id')) {
                $chain = get_option('chain_id');
                $property = get_option('hotel_id');
    
                // $hotel_search = self::ApiCache(BeApi::getHotelSearchForProperty($property, "true"), 'hotel_search_property_'.$property.'_true', self::$cache_time["hotel_search_property"]);
                $hotel_search = self::ApiCache('hotel_search_property_'.$property.'_true', self::$cache_time["hotel_search_property"], function() use ($property){
                    return BeApi::getHotelSearchForProperty($property, "true");
                });
    
                if($hotel_search == false) {
                    return false;
                }
                if ($hotel_search->PropertiesType == null) {
                    return false;
                }
    
                $chain = $hotel_search->PropertiesType->Properties[0]->HotelRef->ChainCode;
                $loadLanguages = self::getLanguagesForProperty($chain, $property);

                self::getCurrenciesForProperty($chain, $property);
            }
            else {
                $chain = false;
                $property  = false;
                $hotel_search = false;
                $loadLanguages = false;
            }
    
            self::$chain = $chain;
            self::$property = $property;
            self::$loadLanguages = $loadLanguages;
            self::$hotel_search = $hotel_search;
        }        

        public static function getLanguagesForChain($chain){
            $languageFromBrowser = ($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $languageFromBrowser = explode(',', $languageFromBrowser, 2);
            $languageFromBrowser = $languageFromBrowser[0];
    
            // $languages = self::ApiCache(BeApi::getLanguages($chain), 'languages_chain_'.$chain, self::$cache_time["languages_chain"]);
            $languages = self::ApiCache('languages_chain_'.$chain, self::$cache_time["languages_chain"], function() use ($chain) {
                return BeApi::getLanguages($chain);
            });
    
            if($languages == null) {
                return false;
            }
    
            if($languages->Status == 2 || $languages->Result == null){
                return false;
            }
    
            $languages = self::addLanguagePath($languages->Result);
    
            $comparing = false;
            $comparingBrowserList = false;

    
            if(isset($_GET["lang"])) {
                foreach (self::$browserLanguagesList as $key => $browserLanguage) {
                    if ($key == $_GET["lang"]) {
                        $language = $browserLanguage["code"];
                        $comparingBrowserList = true;
                        break;
                    }
                }
                if ($comparingBrowserList == false) {
                    $language = $languages[0]->UID;
                }
                foreach ($languages as $lang) {
                    if ($lang->UID == $language) {
                        $language_object = clone $lang;
                        $comparing = true;
                        $langPrefix = $lang->Path;
                        break;
                    }
                }
                if($comparing == false) {
                    $language = $languages[0]->UID;
                    $language_object = clone $languages[0];
                }
            }
            elseif(!empty(get_option('default_language_id')) && get_option('default_language_id') != null){
                $language = (int)get_option('default_language_id');
                foreach ($languages as $lang) {
                    if($lang->UID == $language) {
                        $language_object = clone $lang;
                        $comparing = true;
                        $langPrefix = $lang->Path;
                        break;                        
                    }
                }
                if($comparing == false) {
                    $language = $languages[0]->UID;
                    $language_object = clone $languages[0];
                }                
            }
            elseif(isset($languageFromBrowser)) {
                foreach (self::$browserLanguagesList as $key => $browserLanguage) {
                    if($key == $languageFromBrowser) {
                        $language = $browserLanguage["code"];
                        $comparingBrowserList = true;
                        break;
                    }
                }
                if($comparingBrowserList == false) {
                    $language = $languages[0]->UID;
                }
    
                foreach ($languages as $lang) {
                    if($lang->UID == $language) {
                        $language_object = clone $lang;
                        $comparing = true;
                        $langPrefix = $lang->Path;
                        break;
                    }
                }
                if($comparing == false) {
                    $language = $languages[0]->UID;
                    $language_object = clone $languages[0];
                }
            }
            else {
                $language = $languages[0]->UID;
                $language_object = clone $languages[0];
            }
    
            if ($comparing == false) {
                self::$language_path = $languages[0]->Path;
            }
    
            if ($comparing == true) {
                self::$language_path = $langPrefix;
            }
    
            $_GET["lang"] = $language_object->Code;
            
            self::$languages = $languages;
            self::$language = $language;
            self::$language_object = $language_object;
    
            return true;
        }
 
        public static function getLanguagesForProperty($chain, $property) {

            $default_curr_lang = self::getClientBaseInfo($chain);

    
            if($default_curr_lang == null) {
                return false;
            }
    
            $default_curr_lang = $default_curr_lang->Result;
    
            foreach ($default_curr_lang as $key => $default_curr_lang_part) {
                $default_curr_lang[$default_curr_lang_part->UID] = $default_curr_lang_part;
                unset($default_curr_lang[$key]);
            }
    
            $hotel_languages = self::getLanguagesProperty($property);
    
            if($hotel_languages == null) {
                return false;
            }
    
            if($hotel_languages->Status == 2 || $hotel_languages->Result == null){
                return false;
            }
    
            $hotel_languages = self::addLanguagePath($hotel_languages->Result);  
    
    
    
            $comparing = false;
            $comparingBrowserList = false;
            if (isset($_GET["lang"])) {
    
                foreach (self::$browserLanguagesList as $key => $browserLanguage) {
                    if ($key == $_GET["lang"]) {
                        $language = $browserLanguage["code"];
                        $comparingBrowserList = true;
                        break;
                    }
                }
                if ($comparingBrowserList == false) {
                    $language = $default_curr_lang[$property]->BaseLanguageUID;
                }
    
                foreach ($hotel_languages as $lang) {
                    if ($lang->UID == $language) {
    
                        $language_object = clone $lang;
                        $comparing = true;
                        $langPrefix = $lang->Path;
                        break;
                    }
                }
                if ($comparing == false) {
                    foreach ($hotel_languages as $lang) {
                        if ($lang->UID == $default_curr_lang[$property]->BaseLanguageUID) {
    
                            $language = $lang->UID;
                            $language_object = clone $lang;
                            $defaultLangPrefix = $lang->Path;
                            break;
                        }
                    }
                }
            }
            else {
                foreach ($hotel_languages as $lang) {
                    if ($lang->UID == $default_curr_lang[$property]->BaseLanguageUID) {
    
                        $language = $lang->UID;
                        $language_object = clone $lang;
                        $defaultLangPrefix = $lang->Path;
                        break;
                    }
                }
            }
    
            if (!isset($language)) {
                $language = $hotel_languages[0]->UID;
                $language_object = clone $hotel_languages[0];
                $defaultLangPrefix = $hotel_languages[0]->Path;
            }
    
    
            $_GET["lang"] = $language_object->Code;
    
            if ($comparing == false) {
                $language = $default_curr_lang[$property]->BaseLanguageUID;                
                self::$language_path = $defaultLangPrefix;
            }
    
            if ($comparing == true) {
                self::$language_path = $langPrefix;
            }

            self::$languages = $hotel_languages;
            self::$language = $language;
            self::$language_object = $language_object;

            return true;
        }

        public static function getCurrenciesForChain($chain) {
            // $currencies = self::ApiCache(BeApi::getCurrencies($chain), 'currencies_chain_'.$chain, $cache_time['currencies_chain']);
            $currencies = self::ApiCache('currencies_chain_'.$chain, self::$cache_time['currencies_chain'], function() use ($chain){
                return BeApi::getCurrencies($chain);
            }); 

            

            $currencies = $currencies->Result;
            if (isset($_GET["currencyId"])) {
                foreach($currencies as $chain_currency) {
                    if ($chain_currency->UID == $_GET["currencyId"]) {
                        $currency = $_GET["currencyId"];
                        break;
                    }
                    else {
                        $currency = $currencies[0]->UID;
                    }
                }
            }
            else {
                $currency = $currencies[0]->UID;
            }

            self::$currencies = $currencies;
            self::$currency = $currency;

        }
        
        public static function getCurrenciesForProperty($chain, $property) {
            $default_curr_lang = self::ApiCache('default_curr_lang_chain_'.$chain, self::$cache_time["default_curr_lang_chain"], function() use ($chain){
                return BeApi::getClientBaseInfo($chain);
            });

            $default_curr_lang = $default_curr_lang->Result;
    
            foreach ($default_curr_lang as $key => $default_curr_lang_part) {
                $default_curr_lang[$default_curr_lang_part->UID] = $default_curr_lang_part;
                unset($default_curr_lang[$key]);
            }

            $hotel_currencies = BeApi::getCurrenciesProperty($property);
            $hotel_currencies = $hotel_currencies->Result;

    
    
            if(isset($_GET["currencyId"]) && $hotel_currencies != null) {
                foreach ($hotel_currencies as $hotel_currency) {
                    if ($_GET["currencyId"] == $hotel_currency->UID) {
                        $currency = $_GET["currencyId"];
                    }
                }
            }
    
            if(!isset($currency)) {
                $currency = $default_curr_lang[$property]->BaseCurrencyUID;
            }
    
            $_GET["currencyId"] = $currency;
    
    
            self::$currencies = $hotel_currencies;
            self::$currency = $currency;
            self::$default_currency = $default_curr_lang[$property]->BaseCurrencyUID;
    

        }        

        public static function ValueAndCurrencyCulture($value, $currencies, $currency_id, $language) {

            foreach ($currencies as $currency_from_api) {
                if($currency_from_api->UID == $currency_id) {
                    $currency_symbol = $currency_from_api->CurrencySymbol;
                    break;
                }
            }
            
    
            if ($language == 1) {
                $value = number_format($value, 2, '.', ',');
                $string = $currency_symbol." ".$value;
            }
            elseif($language == 8) {
                $value = number_format($value, 2, ',', '.');
                $string = $currency_symbol." ".$value;
            }
            elseif($language == 3) {
                $value = number_format($value, 2, ',', '.');
                $string = $value." ".$currency_symbol;
            }
            elseif ($language == 2 || $language == 4) {
                $value = number_format($value, 2, ',', ' ');
                $string = $value." ".$currency_symbol;
            }
            else {
                $value = number_format($value, 2, ',', '.');
                $string = $value." ".$currency_symbol;
            }
    
            return $string;
    
        }

        public static function getLanguageObject() {
            return self::$language_object;
        }        
        public static function getLanguagesArray() {
            return self::$languages;
        }
        public static function getLanguage() {
            return self::$language;
        }
        public static function getCurrenciesArray() {
            return self::$currencies;
        }
        public static function getCurrency() {
            return self::$currency;
        }
        public static function getDefaultCurrency() {
            return self::$default_currency;
        }


    }
}