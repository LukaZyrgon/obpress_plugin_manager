<?php

const BEAPI_URL = "https://beapi.omnibees.com/api/BE/";
// const BEAPI_URL = "https://beapi-cert.omnibees.com/api/BE/";



class BeApi
{

  public static $cache_time = [
    'BaseInfo' => 1800,
    'languages_chain' => 1800,
    'hotel_search_property' => 1800,
    'default_curr_lang_chain' => 1800,
    'hotel_languages' => 1800,
    'currencies_chain' => 1800,
    'hotel_search_chain' => 1800,
    'available_packages_4' => 1800,
    'rateplans_array' => 1800,
    'hotel_folders' => 1800,
    'style' => 1800,
    'child_terms' => 1800,
    'available_incentives_4' => 1800,

  ];

  public static $token; //beapi token 
  public static $chain_id;
  public static $hotel_id;

  public static function setToken()
  {
    self::$token = get_option('obpress_api_token');
  }

  public static function ApiCache($transient_name, $cache_time_sec, Closure $callback)
  {

    if (get_transient($transient_name) != null) {
      $response = get_transient($transient_name);
    } else {
      $response = $callback();
      set_transient($transient_name, $response, $cache_time_sec);
    }

    return $response;
  }

  public static function setChainId()
  {
    // self::$chain_id = $chain_id;
    self::$chain_id = get_option('chain_id');
  }

  public static function setHotelId()
  {
    // self::$hotel_id = $hotel_id;
    self::$hotel_id = get_option('hotel_id');
  }

  public static function post($endPoint, $data = null)
  {
    self::setToken();
    $token = self::$token;

    $curl = curl_init(); //start curl and curl options
    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => BEAPI_URL . $endPoint, //endpoint for post
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Authorization: Bearer " . $token),
      )
    );


    $response = curl_exec($curl); //response
    $info = curl_getinfo($curl);  //contains other details about connection
    $code = $info["http_code"]; //200 means http success

    curl_close($curl); //close the connection

    $result = new stdClass(); //result object
    $result->success = false;
    $result->message = "";
    $result->data = null;

    if ($code == 200) {
      $response = json_decode($response);
      $result->success = true;
      $result->data = $response;
    } else {
      if ($code == 401 || $code == 404) {
        $result->message = json_decode($response)->Message;
      }
    }
    return $result;
  }

  public static function getEchoToken()
  {
    return sprintf(
      '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0x0fff) | 0x4000,
      mt_rand(0, 0x3fff) | 0x8000,
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff)
    );
  }

  public static function createGUID()
  {

    // Create a token
    $token      = $_SERVER['HTTP_HOST'];
    $token     .= $_SERVER['REQUEST_URI'];
    $token     .= uniqid(rand(), true);

    // GUID is 128-bit hex
    $hash        = strtoupper(md5($token));

    // Create formatted GUID
    $guid        = '';

    // GUID format is XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX for readability    
    $guid .= substr($hash,  0,  8) .
      '-' .
      substr($hash,  8,  4) .
      '-' .
      substr($hash, 12,  4) .
      '-' .
      substr($hash, 16,  4) .
      '-' .
      substr($hash, 20, 12);

    return $guid;
  }

  public static function baseInfo()
  {
    self::setChainId();


    $data = new stdClass();
    $data->ClientUID = self::$chain_id;


    $base = self::post("ListClientPropertiesBaseInfo", json_encode($data));

    return $base->data;
  }


  public static function getHotelSearchForProperty($property, $avilOnly = "true", $language = 1)
  {

    $data =
      '
        {
            "EchoToken": "' . self::createGUID() . '",
            "TimeStamp": "' . gmdate(DATE_W3C) . '",
            "PrimaryLangID" : ' . $language . ',
            "Criteria": {
                "AvailableOnlyIndicator": ' . $avilOnly . ',
                "Criterion": {
                    "HotelRefs": [{"HotelCode":' . $property . '} ]
                }
            }
        }
        ';

    $base = self::post("HotelSearch", $data);

    return $base->data;
  }

  public static function getClientPropertyFolders($chain)
  {
    $data =
      '
        {
          "ClientUID": ' . $chain . '
        }
        ';

    $base = self::post("GetClientPropertyFolders", $data);

    return $base->data;
  }

  public static function getPropertyStyle($hotel_code, $currency = 34)
  {

    $data =
      '
        {
          "PropertyUID": ' . $hotel_code . ',
          "SelectedCurrencyUID": ' . $currency . ',
          "IsForMobile": false,
          "LanguageUID": 1
        }
        ';

    $base = self::post("GetPropertyBEStyleDetails", $data);

    return $base->data;
  }


  public static function getChildTerms($hotel_code,  $currency = 34)
  {

    $data =
      '
        {
          "PropertyUID": ' . $hotel_code . ',
          "SelectedCurrencyUID": ' . $currency . ',
          "IsForMobile": false,
          "LanguageUID": 1
        }
        ';

    $base = self::post("GetChildTerms", $data);

    return $base->data;
  }





  public static function getClientStyle($chain)
  {

    $data =
      '
    {
      "ClientUID": ' . $chain . ',
      "IsForMobile": false,
      "ReturnTotal": true,
      "LanguageUID": 1
    }
    ';

    $base = self::post("GetClientBEStyleDetails", $data);



    return $base->data;
  }


  public static function getCurrencies($chain)
  {
    $data =
      '
	    {
	      "ClientUIDs": [
	        ' . $chain . '
	      ],
	      "ReturnTotal": true,
	      "LanguageUID": 1
	    }
		';

    $base = self::post("GetBECurrencies", $data);

    return $base->data;
  }

  public static function getLanguages($chain)
  {
    $data =
      '
	    {
	      "ClientUIDs": [
	        ' . $chain . '
	      ]
	    }
		';

    $base = self::post("GetBELanguages", $data);

    return $base->data;
  }

  public static function getHotelAvailCalendar($hotel_id, $date_from, $date_to, $currency = null)
  {

    $adults = get_option('calendar_adults');

    if ($adults == 1) {
      $ResGuestRPH = '0';
    } else {
      $ResGuestRPH = '0,1';
    }

    $data =
      '
		{
            "MaxResponses": 100,
            "RequestedCurrency": ' . $currency . ',
            "PageNumber": 10,
            "EchoToken": "' . self::createGUID() . '",
            "TimeStamp": "' . gmdate(DATE_W3C) . '",
            "Target": 1,
            "Version": 3.0,
            "PrimaryLangID": 1,
            "AvailRatesOnly": true,
            "BestOnly": false,
            "HotelSearchCriteria": {
              "Criterion": {
                "GetPricesPerGuest": true,
                "HotelRefs": [
                  {
                    "HotelCode": ' . $hotel_id . '
                  }
                ],
                "StayDateRange": {
                  "Start": "' . date("Y-m-d\TH:i:sP", strtotime($date_from)) . '",
                  "End": "' . date("Y-m-d\TH:i:sP", strtotime($date_to)) . '"
                },
                "RoomStayCandidatesType": {
                  "RoomStayCandidates": [
                        {
                          "GuestCountsType": {
                            "GuestCounts": [
                              {
                                "Age": "",
                                "AgeQualifyCode": 10,
                                "Count": ' . $adults . ',
                                "ResGuestRPH": [
                                  ' . $ResGuestRPH . '
                                ]
                              }
                            ]
                          },
                          "Quantity": 1,
                          "RPH": 0
                        }
                  ]
                }
              }
            }
          }
		';

    $base = self::post("GetHotelAvailCalendar", $data);

    return $base->data;
  }

  public static function getChainAvailCalendar($chain, $date_from, $date_to, $currency = null)
  {

    $data =
      '
		{
		  "MaxResponses": 100,
		  "RequestedCurrency": ' . $currency . ',
		  "PageNumber": 10,
		  "EchoToken": "' . self::createGUID() . '",
		  "TimeStamp": "' . gmdate(DATE_W3C) . '",
		  "Target": 1,
		  "Version": 3.0,
		  "PrimaryLangID": 1,
		  "AvailRatesOnly": true,
		  "BestOnly": false,
		  "HotelSearchCriteria": {
		    "Criterion": {
		      "GetPricesPerGuest": true,
		      "HotelRefs": [
		        {
		          "ChainCode": ' . $chain . '
		        }
		      ],
		      "StayDateRange": {
		        "Start": "' . date("Y-m-d\TH:i:sP", strtotime($date_from)) . '",
		        "End": "' . date("Y-m-d\TH:i:sP", strtotime($date_to)) . '"
		      },
		      "RoomStayCandidatesType": {
		        "RoomStayCandidates": [
		          	{
			            "GuestCountsType": {
			              "GuestCounts": [
			                {
			                  "Age": "",
			                  "AgeQualifyCode": 10,
			                  "Count": 1,
			                  "ResGuestRPH": [
			                    0
			                  ]
			                }
			              ]
			            },
			            "Quantity": 1,
			            "RPH": 0
		          	}
		        ]
		      }
		    }
		  }
		}
		';

    $base = self::post("GetHotelAvailCalendar", $data);

    return $base->data;
  }
  public static function getClientAvailablePackages($chain, $currency = null, $language = 1, $mobile = false)
  {

    $language = json_encode($language);


    $data =
      '
  {
    "ClientUID": ' . $chain . ',
    "CurrencyUID": ' . $currency . ',
    "SendOriginalImageSize": true,
    "LanguageUID": ' . $language . ',
    "IsForMobile": ' . ($mobile == true ? 'true' : 'false') . ',
    "ImageWidth": 770,
    "ImageHeight": 500,
  }
      ';

    $base = self::post("GetClientAvailablePackages", $data);

    return $base->data;
  }

  public static function getHotelRatePlans($hotel_id, $language = 1)
  {

    $language = json_encode($language);

    $data =
      '
    {
      "EchoToken": "' . self::createGUID() . '",
      "TimeStamp": "' . gmdate(DATE_W3C) . '",
      "Target": 1,
      "Version": 3.0,
      "PrimaryLangID": ' . $language . ',
      "RatePlansType": {
        "RatePlans": [
          {
            "HotelRef": {
              "HotelCode": ' . $hotel_id . '
            },
            "TPA_Extensions": {
              "MultimediaObjects": {
                "SendData": true
              }
            }
          }
        ]
      },
      "TPA_Extensions": {
        "MaxResponses": 100,
        "PageNumber": 10
      }
    }
    ';

    $base = self::post("GetHotelRatePlans", $data);

    return $base->data;
  }

  public static function getHotelSearchForChain($chain, $avilOnly = "true", $language = 1)
  {

    $data =
      '
  {
    "EchoToken": "' . self::createGUID() . '",
    "TimeStamp": "' . gmdate(DATE_W3C) . '",
    "PrimaryLangID" : ' . $language . ',
    "Criteria": {
      "AvailableOnlyIndicator": ' . $avilOnly . ',
      "Criterion": {
        "HotelRefs": [{"ChainCode":' . $chain . '} ],
        "TPA_Extensions": {
              "MultimediaObjects": {
                "SendData": true,
                "SendOriginalImageSize": true
              }
          }
      }
    }
  }
  ';

    $base = self::post("HotelSearch", $data);

    return $base->data;
  }

  public static function getClientAvailableIncentives($chain, $language, $pagesize = null)
  {

    $data =
      '
    {
      "ClientUID": ' . $chain . ',
      "PageSize": ' . $pagesize . ',
      "LanguageUID": ' . $language . '
    }
    ';

    $base = self::post("GetClientAvailableIncentives", $data);

    return $base->data;
  }

  public static function getClientBaseInfo($chain)
  {

    $data =
      '
    {
      "ClientUID": ' . $chain . ',
      "LanguageUID": 1
    }
    ';

    $base = self::post("ListClientPropertiesBaseInfo", $data);

    return $base->data;
  }

  public static function getLanguagesProperty($hotel_code)
  {


    $data =
      '
  {
    "PropertyUIDs": [' . $hotel_code . ']
  }
  ';


    $base = self::post("GetBELanguages", $data);

    return $base->data;
  }

  public static function getCurrenciesProperty($hotel_code)
  {
    $data =
      '
  {
    "PropertyUIDs": [' . $hotel_code . '],
    "ReturnTotal": true,
    "LanguageUID": 1
  }
  ';

    $base = self::post("GetBECurrencies", $data);

    return $base->data;
  }

  public static function getChainData($chain, $date_from, $date_to, $adults = 1, $children = 0, $children_ages = 0, $hotel_code = null, $availrates = "true", $currency = null, $language = 1, $promocode = null, $groupcode = null, $mobile = "false")
  {
    $language = json_encode($language);

    //dd($children_ages);

    $children_ages = explode(';', $children_ages);

    //adults
    $adults_str = "";
    $id = 0;

    $ids = "";
    for ($i = 1; $i <= $adults; $i++) {
      $ids .= $id;
      if ($i != $adults) {
        $ids .= ',';
      }
      $id++;
    }
    $adults_str .= '
    {
      "Age": "",
      "AgeQualifyCode": 10,
      "Count": ' . $adults . ',
      "ResGuestRPH": [
        ' . $ids . '
      ]
        },';


    //children
    $children_str = "";
    for ($i = 1; $i <= $children; $i++) {
      $children_str .= '
      {
                "Age": "' . $children_ages[$i - 1] . '",
                "AgeQualifyCode": 8,
                "Count": 1,
                "ResGuestRPH": [
                  ' . $id . '
                ]
              },';
      $id++;
    }

    if ($promocode != "") {
      $PromotionCode = '"PromotionCode": "' . $promocode . '"';
    }

    if ($groupcode != "") {
      $GroupCode = '"GroupCode": "' . $groupcode . '"';
    }


    if (is_array($hotel_code)) {
      $HotelRefs = "";
      for ($i = 0; $i < count($hotel_code); $i++) {
        $HotelRefs .=
          '
      {
        "ChainCode": "' . $chain . '",
        "HotelCode": "' . $hotel_code[$i] . '"
      }
      ';
        $HotelRefs .= ',';
      }
      $HotelRefs = rtrim($HotelRefs, ",");
    } else {
      $HotelRefs =
        '
    {
      "ChainCode": "' . $chain . '",
      "HotelCode": "' . $hotel_code . '"
    }
    ';
    }

    $adults_children = substr($adults_str . $children_str, 0, -1);
    // $hotel_code = (isset($hotel_code)) ? ', "HotelCode": ' . $hotel_code : "";


    if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
      $country_array = self::countriesISO3166($_SERVER["HTTP_CF_IPCOUNTRY"]);


      $POS =
        '
        "POS": {
          "Sources": [
            {
              "ISOCountry": "' . $country_array["alpha3"] . '"
            }
          ]
        },
    ';
    } else {
      $POS = '';
    }

    $data =
      '
    {
      "MaxResponses": 100,
      "RequestedCurrency": ' . $currency . ',
      "PageNumber": 10,
      "EchoToken": "' . self::createGUID() . '",
      "TimeStamp": "' . gmdate(DATE_W3C) . '",
      "Target": 1,
      "Version": 3.0,
      "PrimaryLangID": ' . $language . ',
      "AvailRatesOnly": ' . $availrates . ',
      "BestOnly": false,
      ' . $POS . '
      "HotelSearchCriteria": {
        "Criterion": {
          "GetPricesPerGuest": true,
          "TPA_Extensions": {
            "IsForMobile": ' . $mobile . '
          },
          "HotelRefs": [' . $HotelRefs . '],
          "StayDateRange": {
            "Start": "' . date("Y-m-d\TH:i:sP", strtotime($date_from)) . '",
            "End": "' . date("Y-m-d\TH:i:sP", strtotime($date_to)) . '"
          },
          "RoomStayCandidatesType": {
            "RoomStayCandidates": [
              {
                "GuestCountsType": {
                  "GuestCounts": [
                    ' . $adults_children . '
                  ]
                },
                "Quantity": 1,
                "RPH": 0
              }
            ]
          },
          "RatePlanCandidatesType": {
        "RatePlanCandidates": [
        {
          ' . (isset($PromotionCode) ? $PromotionCode : null) . '
          ' . (isset($GroupCode) ? $GroupCode : null) . '
        }
        ]
        }
        }
      }
    }
    ';

    $base = self::post("GetHotelAvail", $data);

    return $base->data;
  }

  public static function getHotelDescriptiveInfos($hotels, $language = 1) {
    $language = json_encode($language);

    $HotelDescriptiveInfos = "";

    foreach ($hotels as $hotel) {
      $HotelDescriptiveInfos .= 
      '
      {
            "HotelRef": {
              "HotelCode": ' . $hotel["HotelCode"] . '
            },
            "HotelInfo": {
              "SendData": true
            },
            "FacilityInfo": {
              "SendGuestRooms": true
            },
            "Policies": {
              "SendPolicies": true
            },
            "AreaInfo": {
              "SendRefPoints": true,
              "SendAttractions": true
            },
            "AffiliationInfo": {
              "SendAwards": true
            },
            "ContactInfo": {
              "SendData": true
            },
            "MultimediaObjects": {
              "SendData": true,
              "SendOriginalImageSize": true
            }
        }
      ';
      $HotelDescriptiveInfos .= ",";
    }

    $HotelDescriptiveInfos = rtrim($HotelDescriptiveInfos, ",");

    $data =
    '
    {
      "EchoToken": "'.self::createGUID().'",
      "TimeStamp": "'.gmdate(DATE_W3C).'",
      "Target": 1,
      "Version": 3.0,
      "PrimaryLangID": '. $language .',
      "HotelDescriptiveInfosType": {
        "LangRequested": 1,
        "HotelDescriptiveInfos": [
          '. $HotelDescriptiveInfos .'
        ]
      }
    }
    ';

    $base = self::post("GetHotelDescriptiveInfo", $data);

    return $base->data;
  }

  public static function getCountryInfo($language = 1)
  {
    $data =
    '
    {
      "LanguageUID": '.$language.',
    }
    ';

    $base = self::post("ListCountries", $data);

    return $base->data;
  }

  public static function getCitiesInfo($country_code, $state_code)
  {
    $data =
    '
    {
      "Country_UID": '. $country_code .',
      "State_UID": '. $state_code .'
    }
    ';

    $base = self::post("ListCities", $data);

    $cities = $base->data->Result;

    foreach($cities as $key => $city) {
      $cities[$city->UID] = $cities[$key];
      unset($cities[$key]);
    }

    return $cities;
  }

}
