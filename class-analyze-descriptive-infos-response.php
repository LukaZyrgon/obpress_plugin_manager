<?php

class AnalyzeDescriptiveInfosRes {
    public static $data;

    public static function array_flatten($array) {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)){
                $return = array_merge($return, self::array_flatten($value));
            } else {
                $return[$key] = $value;
            }
        }
    
        return $return;
    }

    public $hotelIconAmenities = [
        101 => [
            "name"=>"Wheelchairs available",
            "url"=>"/icons/icons_GreyDarkest/Weelchair.svg"
        ],
        68 => [
            "name"=>"Parking",
            "url"=>"/icons/icons_GreyDarkest/Parking.svg"
        ],
        42 => [
            "name"=>"Parking Free",
            "url"=>"/icons/icons_GreyDarkest/ParkingFree.svg"       
        ],
        84 => [
            "name"=>"SPA",
            "url"=>"/icons/icons_GreyDarkest/SPA.svg"
        ],
        71 => [
            "name"=>"Swimming-Pool",
            "url"=>"/icons/icons_GreyDarkest/iconGreyDarkest_View_Pool.svg"
        ],
        66 => [
            "name"=>"Outdoor Swimming-Pool",
            "url"=>"/icons/icons_GreyDarkest/PoolOutdoor.svg"
        ],  
        54 => [
            "name"=>"Indoor Swimming-Pool",
            "url"=>"/icons/icons_GreyDarkest/PoolIndoor.svg"
        ],
        259 => [
            "name"=>"High Speed Internet Access",
            "url"=>"/icons/icons_GreyDarkest/iconGreyDarkest_Amenity_Wifi.svg"
        ],
        23 => [
            "name"=>"Fitness center",
            "url"=>"/icons/icons_GreyDarkest/Gym.svg"
        ]
    ];


    public function __construct($data)
    {

        self::$data = $data;
    }
    public function get()
    {

        return self::$data;
    }  

    public function getAmenitiesByRoom($room_id) {
        $hotelDescriptiveContents = self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents;
        $guestRooms = [];    
        foreach($hotelDescriptiveContents as $hotelDescriptiveContent) {
            array_push($guestRooms, $hotelDescriptiveContent->FacilityInfo->GuestRoomsType->GuestRooms);
        }

        $guestRooms = self::array_flatten($guestRooms);

        foreach($guestRooms as $key=>$guestRoom) {
            $guestRooms[$guestRoom->ID] = $guestRooms[$key];
            unset($guestRooms[$key]);
        }
        $amenities = $guestRooms[$room_id]->AmenitiesType->RoomAmenities;

        $amenities_with_images = [];

        foreach($amenities as $amenity) {
            $amenity->Image = $this->getImageForAmenitie($amenity->Code);
        }

        return$amenities;
    }

    public function getAmenitiesByRoomV4($room_id) {
        $hotelDescriptiveContents = self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents;
        $guestRooms = [];    
        foreach($hotelDescriptiveContents as $hotelDescriptiveContent) {
            array_push($guestRooms, $hotelDescriptiveContent->FacilityInfo->GuestRoomsType->GuestRooms);
        }

        $guestRooms = self::array_flatten($guestRooms);

        foreach($guestRooms as $key=>$guestRoom) {
            $guestRooms[$guestRoom->ID] = $guestRooms[$key];
            unset($guestRooms[$key]);
        }
        $amenities = $guestRooms[$room_id]->AmenitiesType->RoomAmenities;

        $amenities_with_images = [];

        if(!empty($amenities)) {
            foreach($amenities as $amenity) {
                $amenity->Image = $this->getImageForAmenitieV4($amenity->Code);
            }
        }

        return$amenities;
    }

    public function getImageForAmenitie($amenitie_id) {
        
        $amenities_images = [
            123 => 'iconHotel_WiFiFree.svg',
            88 => 'iconRoom_Fridge.svg',
            107 => 'iconRoom_Telephone.svg',
            123 => 'iconHotel_Wifi.svg',
            2 => 'iconRoom_AirCon.svg',
            92 => 'iconRoom_Safe.svg',
            74 => 'iconRoom_NonSmoking.svg',
            251 => 'iconRoom__TV.svg',
            54 => 'iconRoom_Internet.svg',
            69 => 'iconRoom_MiniBar.svg',
            85 => 'iconRoom_WC.svg'
        ];

        return @$amenities_images[$amenitie_id];

    }

    public function getImageForAmenitieV4($amenitie_id) {
        
        $amenities_images = [
            123 => 'Wifi_room_v4.svg',
            88 => 'Fridge_v4.svg',
            107 => 'Telephone_v4.svg',
            2 => 'Ac_v4.svg',
            92 => 'Safe_box_v4.svg',
            74 => 'Non_smoking_room_v4.svg',
            251 => 'Tv_v4.svg',
            54 => 'Internet_access_v4.svg',
            69 => 'Mini_bar_v4.svg',
            85 => 'Bathroom_v4.svg'

        ];

        return @$amenities_images[$amenitie_id];

    }

    public function getRoom($hotel_code, $roomID) {
        $room = null;
        
        foreach (self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $HotelDescriptiveContent) {
            if($HotelDescriptiveContent->HotelRef->HotelCode == $hotel_code) {
                foreach ($HotelDescriptiveContent->FacilityInfo->GuestRoomsType->GuestRooms as $GuestRoom) {
                    if($GuestRoom->ID == $roomID) {
                        $room = $GuestRoom;
                    }
                }
            }
        }
        return $room;
    }    


    
    public function getHotelAmanities($avail) {
        if (self::get()->HotelDescriptiveContentsType == null) {
            return null;
        }
        
        // var_dump(self::get()->HotelDescriptiveContentsType);

        $amenities = [];
        $amenities_array = [];

        $hotels = count(self::get()->HotelDescriptiveContentsType->HotelDescriptiveContents); 

        // var_dump($hotels);

        // $availableHotels = collect($avail->getAvailableHotels())->pluck("HotelCode")->values()->toArray();
        $availableHotels = $avail->getAvailableHotels();
        $availableHotelsCodes = [];

        foreach($availableHotels as $availableHotel) {
            array_push($availableHotelsCodes, $availableHotel['HotelCode']);
        }


        foreach (self::get()->HotelDescriptiveContentsType->HotelDescriptiveContents as $HotelDescriptiveContent) {   

            // var_dump($HotelDescriptiveContent->HotelRef->HotelCode);


            $code = $HotelDescriptiveContent->HotelRef->HotelCode;
            // var_dump($availableHotelsCodes);

            if($code==null || !in_array($code,$availableHotelsCodes)) { continue; }
       

            if($HotelDescriptiveContent->HotelInfo->HotelAmenities != null) {
                
                $allAmenitiesCount = [];
                foreach($HotelDescriptiveContent->HotelInfo->HotelAmenities as $hotelAmenity) {
                    array_push($allAmenitiesCount, $hotelAmenity->Code);
                }

                $allAmenitiesCount = array_count_values($allAmenitiesCount);


                foreach ($HotelDescriptiveContent->HotelInfo->HotelAmenities as $HotelAmenity) {
                    // var_dump( $HotelAmenity->Code);

                    //add hotels to array, just so that it doesnt cause a bug
                    if(!array_key_exists($HotelDescriptiveContent->HotelRef->HotelCode,$amenities_array)){
                        $amenities_array[$HotelDescriptiveContent->HotelRef->HotelCode] = [];
                    }
                    //fill the hotels with amenities
                    if(array_key_exists($HotelAmenity->Code,$this->hotelIconAmenities) && $hotels!=$allAmenitiesCount[$HotelAmenity->Code]){
                        $amenities_array[$HotelDescriptiveContent->HotelRef->HotelCode][] = $HotelAmenity->HotelAmenity;
                        $amenities[] = $HotelAmenity->HotelAmenity;    
                    }                    
                }
            }
            else {
                return null;
            }
        }

        $amenitiesUnique = array_unique($amenities);
        
        return [
            'amenities' => $amenities,
            'amenities_unique' => $amenitiesUnique,
            'filter_show' => (count($amenities)-1) > 0,
            'amenities_array' => $amenities_array,
            'hotels_count' => $hotels
        ];
    }

    public function getImagesForRoom($room_id) {
        $guestRooms = [];
        $HotelDescriptiveContents = self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents;
        $images = [];

        foreach($HotelDescriptiveContents as $key=>$HotelDescriptiveContent) {
            array_push($guestRooms, $HotelDescriptiveContent->FacilityInfo->GuestRoomsType->GuestRooms);
        }

        $guestRooms = self::array_flatten($guestRooms);
        
        foreach($guestRooms as $key=>$guestRoom) {
            $guestRooms[$guestRoom->ID] = $guestRooms[$key];
            unset($guestRooms[$key]);
        }

        foreach($guestRooms[$room_id]->MultimediaDescriptionsType->MultimediaDescriptions[1]->ImageItemsType->ImageItems as $image) {
            array_push($images, $image->URL->Address);
        }

        return $images;
    }

    public function getImagesForHotel($hotel_id){

        $results = []; //empty array to store images and alternative text
        //array will contain [src,alt] values

        //going through each hotel
        foreach(self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $hotel){

            //get only a certain hotel with the id
            if($hotel->HotelRef->HotelCode==$hotel_id) { 

                //go through hotel images
                foreach($hotel->HotelInfo->Descriptions->MultimediaDescriptionsType->MultimediaDescriptions as $multimedia){
                    if($multimedia->ImageItemsType!=null){
                        foreach($multimedia->ImageItemsType as $imageInfo){
                            foreach($imageInfo as $image){
                                array_push($results,[ "src" => $image->URL->Address , "alt" => $image->Name]);
                            }
                        }
                    }
                }
                
                //go through room images
                if ($hotel->FacilityInfo != null) {
                    foreach($hotel->FacilityInfo->GuestRoomsType->GuestRooms as $room){                    
                        foreach($room->MultimediaDescriptionsType->MultimediaDescriptions as $multimedia){                    
                            if($multimedia->ImageItemsType!=null){
                                foreach($multimedia->ImageItemsType as $imageInfo){
                                    foreach($imageInfo as $image){
                                        array_push($results,[ "src" => $image->URL->Address , "alt" => $image->Name]);  
                                    }                        
                                }
                            }
                        }
                    }
                }
                /* only return when hotel id is found */
                return $results;
            }

        }        
        return $results; /* if not found return empty array */            
        
    }

    public function getRoomArea($hotel_code, $roomID, $language) {
        foreach (self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $HotelDescriptiveContent) {
            if($HotelDescriptiveContent->HotelRef->HotelCode == $hotel_code) {
                foreach ($HotelDescriptiveContent->FacilityInfo->GuestRoomsType->GuestRooms as $GuestRoom) {
                    if($GuestRoom->ID == $roomID) {
                        $room = $GuestRoom;
                    }
                }
            }
        }
        if(!isset($room)) {
            return null;
        }
        if($room->TypeRoom == null) {
            return null;
        }
        $value = $room->TypeRoom->Size;

        $unit = $room->TypeRoom->SizeMeasurement;

        $area_string = '';

        // 0 => ft2, 1 => m2
        if($unit == 0) {
            if($language == 1) {
                $area_string = $value . ' ft2';
            }
            else {
                $value = $value * 0.092903;
                $value = round($value, 1);
                $area_string = $value . ' m2';
            }
        }
        else {
            if($language == 1) {
                $value = $value * 10.764;
                $value = round($value, 1);
                $area_string = $value . ' ft2';
            }
            else {
                $area_string = $value . ' m2';
            }
        }

        if($value != 0) {
            return $area_string;
        }
        else {
            return null;
        }
    }

    public function getRoomsViewTypes() {
        $roomsViewTypes = [];
        //going through each hotel
        foreach(self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $hotel){
            if (isset($hotel->FacilityInfo->GuestRoomsType)) {
                foreach ($hotel->FacilityInfo->GuestRoomsType->GuestRooms as $room) {
                    if ( $room->AmenitiesType != null ) {
                        $viewTypes = [];
                        foreach($room->AmenitiesType->RoomAmenities as $key => $RoomAmenity) {
                            if($RoomAmenity->RoomAmenityCategory == 'Room Type View') {
                                $viewTypes[] = $RoomAmenity;
                            }
                        }
                        foreach ($viewTypes as $key1 => $viewType) {
                            foreach ($this->roomViewIcons as $key2 => $roomViewIcon) {
                                if($viewType->Code == $key2) {
                                    $viewTypes[$key1]->URL = $roomViewIcon;
                                }
                            }
                        }

                        $roomsViewTypes[$hotel->HotelRef->HotelCode][$room->ID] = $viewTypes;
                    }
                }
            }
        }

        return $roomsViewTypes;
    }

    public $roomViewIcons = [
        152 => "iconGreyDarkest_View_City.svg",
        153 => "iconGreyDarkest_View_Courtyard.svg",
        154 => "iconGreyDarkest_View_Golf.svg",
        155 => "iconGreyDarkest_View_Harbor.svg",
        156 => "iconGreyDarkest_View_Lake.svg",
        157 => "iconGreyDarkest_View_Marina.svg",
        158 => "iconGreyDarkest_View_Mountain.svg",
        159 => "iconGreyDarkest_View_Ocean.svg",
        160 => "iconGreyDarkest_View_Pool.svg",
        161 => "iconGreyDarkest_View_River.svg",
        162 => "iconGreyDarkest_View_Beach.svg",
        163 => "iconGreyDarkest_View_Garden.svg",
        164 => "iconGreyDarkest_View_Park.svg",
        165 => "iconGreyDarkest_View_Forest.svg",
        166 => "iconGreyDarkest_View_Various.svg",
        167 => "iconGreyDarkest_View_Countryside.svg",
        168 => "iconGreyDarkest_View_Ocean.svg"
    ];

    public function getImagesOnlyForHotel($hotel_id){

        $results = []; //empty array to store images and alternative text
        //array will contain [src,alt] values

        //going through each hotel
        foreach(self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $hotel){

            //get only a certain hotel with the id
            if($hotel->HotelRef->HotelCode==$hotel_id) { 

                //go through hotel images
                foreach($hotel->HotelInfo->Descriptions->MultimediaDescriptionsType->MultimediaDescriptions as $multimedia){
                    if($multimedia->ImageItemsType!=null){
                        foreach($multimedia->ImageItemsType as $imageInfo){
                            foreach($imageInfo as $image){
                                array_push($results,[ "src" => $image->URL->Address , "alt" => $image->Name]);
                            }
                        }
                    }
                }
                /* only return when hotel id is found */
                return $results;
            }

        }        
        return $results; /* if not found return empty array */            
        
    }

    public function getAddressHotel() {
        if (isset(self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents[0]->ContactInfosType->ContactInfos[0]->AddressesType->Addresses[0])) {
            $Addresses = self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents[0]->ContactInfosType->ContactInfos[0]->AddressesType->Addresses[0];
            $Address = [];
            $Address['AddressLine'] = $Addresses->AddressLine;
            $Address['CityName'] = $Addresses->CityName;
            $Address['CountryName'] = $Addresses->CountryName;
            $Address['PostalCode'] = $Addresses->PostalCode;


            return $Address;
        }
        else {
            return null;
        }
    }


    public function getRoomsAmenitiesList() {

        $amenityTypes = [];

        //going through each hotel
        foreach(self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $hotel){
            foreach ($hotel->FacilityInfo->GuestRoomsType->GuestRooms as $room) {

                // if amenities are set, put them in  $types, else put empty array
                if (isset($room->AmenitiesType->RoomAmenities) ) {
                    $types = $room->AmenitiesType->RoomAmenities;
                } else {
                    $types = [];
                }

                if(!isset($amenityTypes[$hotel->HotelRef->HotelCode])){
                    $amenityTypes[$hotel->HotelRef->HotelCode] = [];
                }

                $amenityTypes[$hotel->HotelRef->HotelCode][$room->ID] = $types ;
            }
        }

        return $amenityTypes;
    }  





    public function getRoomsAmenitiesFilter($property,$roomKeys){

        $allAmenities = self::getRoomsAmenitiesList()[$property];

        $stuff = [];

        if ( $allAmenities != null && count($roomKeys) > 0 ){
            foreach($allAmenities as $key => $value){
                if(in_array($key,$roomKeys)){
                    $stuff[$key] = $value;    
                }            
            }
        } else {
            return [
                    'list' => [],
                    'unique' => [],
                    'show' => false,
                    'counters' => [],
                    'count' => 0
                ];
        }

        $allAmenities = $stuff;

        $allowed = [88,107,123,2,92,74,251,54,69,85];
        $list = [];
        $counters = [];
        $counters['amenitie_total'] = 0;
        $counters['room_total'] = 0;
        $counters['total_rooms'] = 0;
        $counters['amenitie'] = []; //number of each views by id
        $counters['room'] = []; //number of views in each room id

        foreach ($allAmenities as $room => $views) {

            foreach ($views as $view) {

                if ( in_array($view->Code,$allowed) ) {
                    $counters['amenitie'][$view->Code] = (isset($counters['amenitie'][$view->Code])) ? $counters['amenitie'][$view->Code]+1 : 1;
                    $counters['room'][$room] = (isset($counters['room'][$room])) ? $counters['room'][$room]+1 : 1;
                    $counters['amenitie_total']++;
                    $counters['room_total']++;
                    array_push($list, $view);
                }

            }

            $counters['total_rooms']++;

        }



        $show = true; //show filter
        foreach($counters['room'] as $id => $count){
            if($count==$counters['amenitie_total'] && $counters['total_rooms']==$count){
                //one room contains all 
                $show = false;
            }
        }


        $hidenum = 0;
        $hidelist = [];
        foreach($counters['amenitie'] as $id => $count){ //hide amenitiy if it exists in all rooms
            if($count==$counters['total_rooms']){
                $hidenum++;
                $hidelist[] = $id;
            }
        }


        if ( $hidenum == count ( array_unique($list, SORT_REGULAR) ) ) { // if all amenities are in the same room
            $show = false;
        }

        if (count($list) == 0){ //there is 0 views;
             $show = false;
        }

        return [
            'list' => $list,
            'unique' => array_unique($list, SORT_REGULAR),
            'show' => $show,
            'counters' => $counters,
            'count' => count($list)
        ];
    
    }





    public function getRoomsViewTypesFilter($property,$roomKeys){


        $allviews = self::getRoomsViewTypes()[$property];

        $stuff = [];

        if ($allviews != null && count($roomKeys) > 0 ) {
            foreach($allviews as $key => $value){
                if(in_array($key,$roomKeys)){
                    $stuff[$key] = $value;    
                }            
            }
        } else {
            return [
                    'list' => [],
                    'unique' => [],
                    'show' => false,
                    'counters' => [],
                    'count' => 0
                ];
        }

        $allviews = $stuff;
        $allowedViews = [160,154,158,156,157,162]; //Pool View 160 , Golf View 154, Mountain 158, Lake 156, Marina 157,  Beach 162
        $viewsList = [];
        $counters = [];
        $counters['view_total'] = 0;
        $counters['room_total'] = 0; //number of views in rooms all
        $counters['total_rooms'] = 0; //number of rooms
        $counters['view'] = []; //number of each views by id
        $counters['room'] = []; //number of views in each room id

        foreach($allviews as $room => $views){
            foreach($views as $view){

                if ( in_array($view->Code,$allowedViews ) ) {
                    $counters['view'][$view->Code] = ( isset($counters['view'][$view->Code])) ? $counters['view'][$view->Code]+1 : 1;
                    $counters['room'][$room] = ( isset($counters['room'][$room])) ? $counters['room'][$room]+1 : 1;
                    $counters['view_total']++;
                    $counters['room_total']++;

                    array_push($viewsList, $view);
                }
            }
            $counters['total_rooms']++;
        }

        $show = true; //show filter
        //if all filters 


        foreach($counters['room'] as $id => $count){
            if($count==$counters['view_total'] && $counters['total_rooms']==$count){
                //one room contains all 
                $show = false;
            }
        }


        $hidenum = 0;

        foreach($counters['view'] as $id => $count){ //hide amenitiy if it exists in all rooms
            if($count==$counters['total_rooms']){
                $hidenum++;
            }
        }
        if ( $hidenum == count(array_unique( $viewsList , SORT_REGULAR )  ) ) { // if all amenities are in the same room
            $show = false;
        }
        

        if (count($viewsList) == 0){ //there is 0 views;
             $show = false;
        }

        return [
            'list' => $viewsList,
            'unique' => array_unique($viewsList, SORT_REGULAR),
            'show' => $show,
            'counters' => $counters,
            'count' => count($viewsList)
        ];
    }








    public function getRoomsBedsTypesFilter($property,$roomKeys){

        $allbeds = self::getRoomsBedTypes()[$property];

        $stuff = [];

        if ( $allbeds != null && count($roomKeys ) > 0 ) {
            foreach($allbeds as $key => $value){
                if(in_array($key,$roomKeys)){
                    $stuff[$key] = $value;    
                }            
            }
        } else {
            return [
                'list' => [],
                'unique' => [],
                'show' => false,
                'counters' => [],
                'count' => 0
            ];
        }

        $allbeds = $stuff;

        $allowed = [144,145,148,149]; //Double, King, Twin Single
        $list = [];
        $counters = [];
        $counters['bed_total'] = 0;
        $counters['room_total'] = 0;
        $counters['total_rooms'] = 0;
        $counters['bed'] = []; //number of each views by id
        $counters['room'] = []; //number of views in each room id

        foreach($allbeds as $room => $views){
            foreach($views as $view){
                if(in_array($view->Code,$allowed)) {
                    $counters['bed'][$view->Code] = (isset($counters['bed'][$view->Code])) ? $counters['bed'][$view->Code]+1 : 1;
                    $counters['room'][$room] = (isset($counters['room'][$room])) ? $counters['room'][$room]+1 : 1;
                    $counters['bed_total']++;
                    $counters['room_total']++;

                    array_push($list, $view);
                }
            }
            $counters['total_rooms']++;
        }

        $show = true; //show filter
        foreach($counters['room'] as $id => $count){
            if($count==$counters['bed_total'] && $counters['total_rooms']==$count){
                //one room contains all 
                $show = false;
            }
        }


        //$list = collect($list);

        $hidenum = 0;
        foreach($counters['bed'] as $id => $count){ //hide amenitiy if it exists in all rooms
            if($count==$counters['total_rooms']){
                $hidenum++;
            }
        }

        if ( $hidenum == count( array_unique($list, SORT_REGULAR) ) ){ // if all amenities are in the same room
            $show = false;
        }

        if (count($list) == 0) { //there is 0 views;
             $show = false;
        }

        return [
            'list' => $list,
            'unique' => array_unique( $list, SORT_REGULAR ),
            'show' => $show,
            'counters' => $counters,
            'count' => count($list)
        ];
    
    }

    public function getRoomsBedTypes() {

        $roomsBedTypes = [];

        //going through each hotel
        foreach(self::$data->HotelDescriptiveContentsType->HotelDescriptiveContents as $hotel){
            if (isset($hotel->FacilityInfo->GuestRoomsType)) {
                foreach ($hotel->FacilityInfo->GuestRoomsType->GuestRooms as $room) {
                    if ( $room->AmenitiesType != null ) {
                        $bedTypes = [];

                        foreach($room->AmenitiesType->RoomAmenities as $key => $RoomAmenity) {
                            if($RoomAmenity->RoomAmenityCategory == 'Bed Type') {
                                $bedTypes[] = $RoomAmenity;
                            }
                        }
                        foreach ($bedTypes as $key1 => $viewType) {
                            foreach ($this->roomBedIcons as $key2 => $roomBedIcon) {
                                if($viewType->Code == $key2) {
                                    $bedTypes[$key1]->URL = $roomBedIcon;
                                }
                            }
                        }

                        $roomsBedTypes[$hotel->HotelRef->HotelCode][$room->ID] = $bedTypes;
                    }
                }
            }
        }

        return $roomsBedTypes;
    }

    public $roomBedIcons = [
        144 => "Double.svg",
        145 => "King.svg",
        146 => "Queen.svg",
        147 => "Sofa.svg",
        148 => "Twin.svg",
        149 => "Single.svg",
        150 => "Runhouse.svg",
        151 => "Dormbed.svg",
    ];

    public function getRoomsBedTypesCodes($hotel_code, $room_id) {
        if(isset($this->getRoomsBedTypes()[$hotel_code][$room_id])){
            $roomBeds = $this->getRoomsBedTypes()[$hotel_code][$room_id];
            $bedCodes = [];
            foreach ($roomBeds as $roomBed) {
                $bedCodes[] = $roomBed->Code;
            }

            return $bedCodes;    
        }else{
            return [];
        }
        
    }



    public function getRoomsViewTypesCodes($hotel_code, $room_id) {

        if(isset($this->getRoomsViewTypes()[$hotel_code][$room_id])){
            $roomViews = $this->getRoomsViewTypes()[$hotel_code][$room_id];
            $viewCodes = [];
            foreach ($roomViews as $roomView) {
                $viewCodes[] = $roomView->Code;
            }

            return $viewCodes;
        }else{
            return [];
        }

    }


}

