<?php

class AnalyzeAvailRes
{
    //
    public static $data;

    public function __construct($data)
    {

        self::$data = $data;
    }
    public function get()
    {

        return self::$data;
    }

    public static function array_flatten($array)
    {
        $return = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, self::array_flatten($value));
            } else {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    public static function getHotels()
    {

        $hotels = [];

        if (  isset(self::$data->HotelStaysType->HotelStays) ) {

            $hotelProperties = self::$data->HotelStaysType->HotelStays;

              foreach ($hotelProperties as $key => $hotelProperty) {
                $hotelProperties[$key] = $hotelProperty->BasicPropertyInfo;
            }

            foreach ($hotelProperties as $key => $hotelProperty) {
                array_push($hotels, array(
                    'HotelName' => $hotelProperty->HotelRef->HotelName,
                    'ChainName' => $hotelProperty->HotelRef->ChainName,
                    'HotelCode' => $hotelProperty->HotelRef->HotelCode,
                    'ChainCode' => $hotelProperty->HotelRef->ChainCode,
                    'Rating' => $hotelProperty->Award->Rating,
                    'Address' => $hotelProperty->Address->AddressLine,
                    'Country' => $hotelProperty->Address->CountryCode,
                    'StateProvCode' => $hotelProperty->Address->StateProvCode,
                    'City' => $hotelProperty->Address->CityCode,
                    'Latitude' => $hotelProperty->Position->Latitude,
                    'Longitude' => $hotelProperty->Position->Longitude,
                    'MaxPartialPaymentParcel' => $hotelProperty->MaxPartialPaymentParcel,
                    'Image' => $hotelProperty->ImageURL
                ));
            }

        }

        foreach ($hotels as $key => $hotel) {
            $hotels[$hotel['HotelCode']] = $hotels[$key];
            unset($hotels[$key]);
        }

        return $hotels;

    }


    public static function getHotelById($hotel_id)
    {
        return self::getHotels()[$hotel_id];
    }

    public static function getAllRoomStays()
    {

        if (self::$data->RoomStaysType == null) {
            return null;
        }

        $stays = self::$data->RoomStaysType->RoomStays;

        foreach ($stays as $key => $stay) {
            // BasicPropertyInfo.HotelRef.HotelCode
            $stays[$stay->BasicPropertyInfo->HotelRef->HotelCode] = $stays[$key];
            unset($stays[$key]);
        }

        return $stays;
    }

    public static function getHotelsRoomStays($hotel_id)
    {
        if (isset(self::getAllRoomStays()[$hotel_id])) {
            $stays = self::getAllRoomStays()[$hotel_id];
        } else {
            $stays = null;
        }
        return $stays;
    }

    public static function getHotelsRoomRates($hotel_id)
    {
        $groupcode_valid=self::GroupCodeValidation();

        if (self::getHotelsRoomStays($hotel_id) != null) {
            $rates = self::getHotelsRoomStays($hotel_id)->RoomRates;

            foreach ($rates as $key => $rate) {
                if ($rate->Availability[0]->WarningRPH == 109) {
                    unset($rates[$key]);
                }
            }

            $rates = array_values($rates);
            return $rates;
        } else {
            return null;
        }
    }

    public function getBestRate($hotel_id)
    {
        $best_rates = self::getHotelsRoomRates($hotel_id);

        $arrayAvailability = ["AvailableForSale", "LOS_Restricted", "ClosedOut", "OnRequest", "OtherAvailable"];

        if ($best_rates == null) {
            return null;
        }

        $AvailableForSaleExsist = false;

        foreach ($best_rates as $key => $best_rate) {
            if (!in_array($best_rate->Availability[0]->AvailabilityStatus, $arrayAvailability)) {
                unset($best_rates[$key]);
                continue;
            }

            if ($best_rate->Availability[0]->AvailabilityStatus == 'LOS_Restricted' || $best_rate->Availability[0]->AvailabilityStatus == 'ClosedOut' || $best_rate->Availability[0]->AvailabilityStatus == 'OtherAvailable') {
                unset($best_rates[$key]);
            }

            if ($best_rate->Availability[0]->AvailabilityStatus == 'AvailableForSale') {
                $AvailableForSaleExsist = true;
            }
        }

        //TODO check with Lazar
        // usort($best_rates, function ($item1, $item2) {
        //     return $item1->Total->AmountBeforeTax <=> $item2->Total->AmountBeforeTax;
        // });


        if (isset($best_rates[0]->Availability) && $best_rates[0]->Availability[0]->AvailabilityStatus == 'OnRequest' && count($best_rates) > 1 && $AvailableForSaleExsist == true) {
            foreach ($best_rates as $key => $best_rate) {
                if ($best_rate->Availability[0]->AvailabilityStatus == 'OnRequest') {
                    unset($best_rates[$key]);
                }
            }
            $best_rates = array_values($best_rates);
        }

        $best_rate = $best_rates[0];

        return $best_rate;
    }

    public function getRoomById($room_id)
    {

        $room = self::getAllRooms()[$room_id];

        return $room;
    }

    public static function getAllRooms()
    {

        $roomStays = self::getAllRoomStays();
        $rooms = [];

        foreach ($roomStays as $key => $roomStay) {
            array_push($rooms, $roomStay->RoomTypes);
        }

        $rooms = self::array_flatten($rooms);
        foreach ($rooms as $key => $room) {
            $rooms[$room->RoomID] = $rooms[$key];
            unset($rooms[$key]);
        }

        return $rooms;
    }

    public function getAllRatePlans()
    {

        if (self::getAllRoomStays() != null) {
            $roomStays = self::getAllRoomStays();
            $rateplans = [];

            foreach ($roomStays as $key => $roomStay) {
                array_push($rateplans, $roomStay->RatePlans);
            }


            $rateplans = self::array_flatten($rateplans);
            foreach ($rateplans as $key => $rateplan) {
                $rateplans[$rateplan->RatePlanID] = $rateplans[$key];
                unset($rateplans[$key]);
            }
        } else {
            $rateplans = [];
        }

        return $rateplans;
    }

    public function getStatusOfHotel($hotel_id)
    {
        if (isset(self::$data->HotelStaysType) && self::$data->HotelStaysType != null) {
            $hotels = self::$data->HotelStaysType->HotelStays;
        } else {
            return null;
        }


        $status = null;

        foreach ($hotels as $hotel) {
            if ($hotel->BasicPropertyInfo->HotelRef->HotelCode == $hotel_id) {
                $status = $hotel->Status;
            }
        }

        return $status;
    }

    public function getAllRoomStayCandidates()
    {
        if (isset(self::$data->Criteria->Criterion)) {
            $canidates = self::$data->Criteria->Criterion->RoomStayCandidatesType->RoomStayCandidates;
        } else {
            $canidates = null;
        }

        return $canidates;
    }

    public function getAvailableHotels()
    {
        $hotels = self::getHotels();
        $availHotels = [];

        $arrayAvailability = ["AvailableForSale", "OnRequest"];

        foreach ($hotels as $avail) {
            foreach (self::getHotelsRoomRates($avail["HotelCode"]) as $roomrate) {
                if (!in_array($roomrate->Availability[0]->AvailabilityStatus, $arrayAvailability)) {
                    continue;
                }
                $availHotels[] = $avail;
            }
        }

        $availHotels = array_unique($availHotels, SORT_REGULAR);

        return $availHotels;
    }

    public function getAllRoomTypes()
    {
        if (self::getAllRoomStays() == null) {
            return null;
        }

        $allRoomStays = self::getAllRoomStays();
        $allRoomStays = self::array_flatten($allRoomStays);

        $room_types = reset($allRoomStays)->RoomTypes;

        return $room_types;
    }

    public function getRoomRatesByRoomAvailability($hotel_id, $room_id, $availability_ids, $sort=null) {
        $groupcode_valid = self::GroupCodeValidation();

        if($sort == null) {
            $data = self::getRoomRatesByRoom($hotel_id, $room_id);
        }
        else {
            $data = self::getRoomRatesByRoom($hotel_id, $room_id, $sort);
        }

        if($data == null) {
            return false;
        }

        foreach($data as $key=>$roomrate) {
            foreach($roomrate->Availability as $avail) {
                if($avail->AvailabilityStatus != $availability_ids[0]) {
                    unset($data[$key]);
                }
                
                if ($roomrate->Availability[0]->WarningRPH == 109) {
                    unset($data[$key]);
                }
                //deleting except Closed To Arrivals and closed To Departure
                if ($roomrate->Availability[0]->AvailabilityStatus == "OtherAvailable") {
                    if($roomrate->Availability[0]->WarningRPH == 427) {
                        unset($data[$key]);
                    }
                    if($roomrate->Availability[0]->WarningRPH == 397) {
                        unset($data[$key]);
                    }
                    if($roomrate->Availability[0]->WarningRPH == 138) {
                        unset($data[$key]);
                    }
                    if($roomrate->Availability[0]->WarningRPH == 142) {
                        unset($data[$key]);
                    }
                }
    
                //SHOW ONLY RATES WITH GROUPCODE IF GROUPCODE IS VALID
                if($groupcode_valid == true && $roomrate->GroupCode == null) {
                    unset($data[$key]);
                }

            }
        }

        return $data;
    }

    public function GroupCodeValidation() {
        //CHECK IF GROUPCODE IS VALID OR NOT WHEN IS INSERTED
        $groupcode_valid = false;
        if(isset(self::get()->Criteria->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->GroupCode)) {
            $groupcode = self::get()->Criteria->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->GroupCode;
        }
        else {
            $groupcode = null;
        }
        if($groupcode != null) {
            $groupcode_valid = true;
            if(isset(self::get()->WarningsType->Warnings) && self::get()->WarningsType->Warnings != null) {
                foreach(self::get()->WarningsType->Warnings as $Warning) {
                    if($Warning->Code == 569) {
                        $groupcode_valid = false;
                    }
                }
            }
        }

        return $groupcode_valid;
    }    

    public function getRoomRatesByRoom($hotel_id, $room_id, $sort = null) {
        $oldRates = $this->getHotelsRoomRates($hotel_id);
        
        $rates = [];


        foreach($oldRates as $key=>$item) {
            $rates[$item->RoomID][$key] = $item;
        }

        // ksort($rates, SORT_NUMERIC);
        $rates = $rates[$room_id];

        if($sort != null) {
            $custom_order = [];
            foreach ($sort as $key => $order) {
                foreach ($rates as $rate) {
                    if($key == $rate->RatePlanID) {
                        $custom_order[] = $rate;
                    }
                }
            }
            $rates = $custom_order;
        }

        return $rates;
    }

    public function getRatePlan($rateplan_id) {
        $rateplan = $this->getAllRatePlans()[$rateplan_id];
        return $rateplan;
    }






    public function getPricesInfoBestRate() {


            $hotels = self::getAvailableHotels();

            $hotels_hotelCodes = [];

            foreach ($hotels as $hotel) { 

                array_push($hotels_hotelCodes, $hotel['HotelCode'] );
            }

            $prices = [];

            foreach  ( $hotels_hotelCodes as $hotel_id ) {

                if (  self::getBestRate($hotel_id) != null  && self::getBestRate($hotel_id)->Total ) {

                    $prices[] = self::getBestRate($hotel_id)->Total->AmountBeforeTax / count(self::getBestRate($hotel_id)->RatesType->Rates);
                }

            }


             $first = floor(max($prices)/3);
             $second = $first*2;
             $max = round( max($prices) ,2);
             $filter_show = (count($prices)-1) > 1;

             asort($prices);

             $no1 = $no2 = $no3 = 0;

             for ( $i = 0 ; $i < count($prices) ; $i++) {

                if ( $prices[$i] < $first ) {
                     $no1++; 
                }  else if ( $prices[$i] >= $first && $prices[$i] < $second ) {
                     $no2++;
                } else {
                     $no3++;
                }
                
             }


            return [
                'prices' => $prices,
                'first' => $first,
                'second' => $second,
                'min' => 0,
                'max' => $max,
                'filter_show' => $filter_show,
                'no1' => $no1,
                'no2' => $no2,
                'no3' => $no3,
            ];

            return;

    }




    //next few methods are used for filters on step 2

    public function getPricesInfo($style, $promotion_id=null) {

        //min price, max price, allshownprices, will be used to generate prices filter

        if (isset($style->Result->ShowUnavailableRates)) {

            $showUnavailableRates = $style->Result->ShowUnavailableRates;

        } else {

            $showUnavailableRates = false;

        }

        if (isset($style->Result->AllowReservationsOnRequest)) {

            $showOnRequestRates = $style->Result->AllowReservationsOnRequest;

        } else {

            $showOnRequestRates = false;

        }

        if ($showUnavailableRates == true) {

            if ($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OnRequest","OtherAvailable"];
            } else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OtherAvailable"];
            }

        } else {

            if ($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OnRequest","OtherAvailable"];
            } else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OtherAvailable"];
            }

        }


        if ( isset($this->data["different_dates"]) ) {

            $hotels = $this->getHotels()->pluck('HotelCode');

            $prices = [];

            foreach ($hotels as $hotel_id) {

                foreach ($this->getHotelsRoomRates($hotel_id) as $rates_for_diff_date) {

                    foreach ($rates_for_diff_date as $rate) {

                        if (!in_array($rate->Availability[0]->AvailabilityStatus,$arrayAvailability) ) {
                            continue;
                        }

                        if ($rate->Total) {
                            $prices[] = round($rate->Total->AmountBeforeTax/count($rate->RatesType->Rates), 2);
                        }

                    }
                } 
            }

            $first = floor($prices->min()+(($prices->max()-$prices->min())/3));
            $second = floor($prices->min()+(($prices->max()-$prices->min())/3*2));
            $max = round($prices->max(),2);
            $filter_show = (count($prices)-1) > 1;
            $no1 = $prices->whereBetween(null, [0, floor($prices->max()/3)])->count();
            $no2 = $prices->whereBetween(null, [floor($prices->max()/3), floor(($prices->max()/3)*2)])->count();
            $no3 = $prices->whereBetween(null, [floor(($prices->max()/3)*2), $prices->max()])->count();

            return [
                'prices' => $prices,
                'first' => $first,
                'second' => $second,
                'min' => 0,
                'max' => $max,
                'filter_show' => $filter_show,
                'no1' => $no1,
                'no2' => $no2,
                'no3' => $no3
            ];

        }


        $hotels = $this->getHotels();

        $hotels_hotelCodes = [];

        foreach ($hotels as $hotel) { 

            array_push( $hotels_hotelCodes, $hotel['HotelCode'] );

        }


       

        $prices = [];

        foreach ( $hotels_hotelCodes as $hotel_id ) {

            
            foreach ( $this->getHotelsRoomRates( $hotel_id ) as $rate ) {

                if (!in_array($rate->Availability[0]->AvailabilityStatus,$arrayAvailability) ) {
                    continue;
                }
                
                if ($promotion_id != null) {
                    if ($rate->Total && $rate->RatePlanID == $promotion_id) {
                        $prices[] = round($rate->Total->AmountBeforeTax/count($rate->RatesType->Rates), 2);
                    }
                } else {
                    if ($rate->Total) {
                        $prices[] = round($rate->Total->AmountBeforeTax/count($rate->RatesType->Rates), 2);
                    }
                }

            }  


        }


        if(!empty($prices)) {
            $first = floor( min($prices) + (  ( max( $prices )  - min( $prices )  )  /  3  )  );
            $second = floor( min($prices) + ( ( max($prices)  - min($prices) )/3*2)  );
            $max = round( max($prices) , 2 );
            $filter_show = ( count($prices)-1 ) > 1;
        }
        else {
            $first = null;
            $second = null;
            $max = null;
            $filter_show = false;
        }

        $no1 = $no2 = $no3 = 0;

        foreach ( $prices as $price ) {

            if ( $price < $first) {
                $no1++;
            } else if ( $price < $second ) {
                $no2++;
            } else {
                $no3++;
            }

        }

        return [
            'prices' => $prices,
            'first' => $first,
            'second' => $second,
            'min' => 0,
            'max' => $max,
            'filter_show' => $filter_show,
            'no1' => $no1,
            'no2' => $no2,
            'no3' => $no3
        ];



    }





     //get policies info
    public function getPoliciesInfo($style) {

        if (isset($style["Result"]->ShowUnavailableRates)) {
            $showUnavailableRates = $style["Result"]->ShowUnavailableRates;
        } else {
            $showUnavailableRates = false;
        }

        if (isset($style["Result"]->AllowReservationsOnRequest)) {
            $showOnRequestRates = $style["Result"]->AllowReservationsOnRequest;
        } else {
            $showOnRequestRates = false;
        }

        // DIFFERENT DATES MISSING CANCALATION POLICIES FILTERS
        if ($showUnavailableRates == true) { 

            if ($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OnRequest","OtherAvailable"];
            } else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OtherAvailable"];
            }

        } else {

            if ($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OnRequest","OtherAvailable"];
            } else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OtherAvailable"];
            }

        }

        $today = new \DateTime('today');

        if ( isset($this->data["different_dates"]) ) {


            $hotels = $this->getHotels();

            $hotels_hotelCodes = [];

            foreach ( $hotels as $hotel ) { 

                array_push( $hotels_hotelCodes, $hotel['HotelCode'] );

            }

            $policies = [];
            $policies_types = [];
            $policies_types["NonRefundable"] = [];
            $policies_types["FreeCancellation"] = [];
            $policies_types["CancellationAllowed"] = [];

            foreach ( $hotels_hotelCodes as $hotel_id ) {

                foreach ($this->getHotelsRoomRates($hotel_id) as $rates_for_diff_date) {

                    foreach ($rates_for_diff_date as $roomrate) {
                       
                        if ( !in_array($roomrate->Availability[0]->AvailabilityStatus, $arrayAvailability ) ) {
                            continue;
                        }

                        $CheckInPolicy = \Carbon\Carbon::parse($roomrate->EffectiveDate);

                        $RatePlanPerDate = $this->getRatePlan($roomrate->RatePlanID);
                        $RatePlanPerDate = collect($RatePlanPerDate)->flatten()->keyBy('RatePlanID');


                        foreach($RatePlanPerDate[$roomrate->RatePlanID]->CancelPenalties as $cancellation) {
                            if($cancellation->NonRefundable == false && ($cancellation->AmountPercent->Amount == 0 && $cancellation->AmountPercent->Percent == 0 && $cancellation->AmountPercent->NmbrOfNights == 0)) {
                                if($cancellation->DeadLine != null && $today->diffInDays($CheckInPolicy) >= $cancellation->DeadLine->OffsetUnitMultiplier) {
                                    $policies_types["FreeCancellation"][] = $cancellation->PenaltyDescription->Name;
                                }
                                elseif($cancellation->DeadLine != null && $today->diffInDays($CheckInPolicy) < $cancellation->DeadLine->OffsetUnitMultiplier) {
                                    $policies_types["NonRefundable"][] = $cancellation->PenaltyDescription->Name;
                                }
                                else {
                                    $policies_types["FreeCancellation"][] = $cancellation->PenaltyDescription->Name;
                                }
                            }
                            elseif($cancellation->NonRefundable == false && ($cancellation->AmountPercent->Amount != 0 || $cancellation->AmountPercent->Percent != 0 || $cancellation->AmountPercent->NmbrOfNights != 0)) {
                                if($cancellation->DeadLine != null && $today->diffInDays($CheckInPolicy) >= $cancellation->DeadLine->OffsetUnitMultiplier) {
                                    $policies_types["CancellationAllowed"][] = $cancellation->PenaltyDescription->Name;
                                }
                                elseif($cancellation->DeadLine != null && $today->diffInDays($CheckInPolicy) <= $cancellation->DeadLine->OffsetUnitMultiplier) {
                                    $policies_types["NonRefundable"][] = $cancellation->PenaltyDescription->Name;
                                }
                                else {
                                    $policies_types["CancellationAllowed"][] = $cancellation->PenaltyDescription->Name;
                                }
                            }
                            elseif($cancellation->NonRefundable == true) {
                                $policies_types["NonRefundable"][] = $cancellation->PenaltyDescription->Name;
                            }

                            $policies[] = $cancellation->PenaltyDescription->Name;
                        }

                    }
                }
            }

            $show = 0;
            $policies_types["NonRefundable_count"] = $policies_types["NonRefundable"]->values()->count();
            if($policies_types["NonRefundable_count"]>0){ $show++; }
            $policies_types["FreeCancellation_count"] = $policies_types["FreeCancellation"]->values()->count();
            if($policies_types["FreeCancellation_count"]>0){ $show++; }
            $policies_types["CancellationAllowed_count"] = $policies_types["CancellationAllowed"]->values()->count();
            if($policies_types["CancellationAllowed_count"]>0){ $show++; }
            $policies_types["Total_count"] = $policies_types["NonRefundable_count"] + $policies_types["FreeCancellation_count"]+ $policies_types["CancellationAllowed_count"];


            $policies_types["NonRefundable"] = $policies_types["NonRefundable"]->unique()->values();
            $policies_types["FreeCancellation"] = $policies_types["FreeCancellation"]->unique()->values();
            $policies_types["CancellationAllowed"] = $policies_types["CancellationAllowed"]->unique()->values();

            return [
            'policies' => $policies_types,
            'filter_show' => $show > 1
            ];

        }


        $hotels = $this->getHotels();

        $hotels_hotelCodes = [];

        foreach ( $hotels as $hotel ) { 

            array_push( $hotels_hotelCodes, $hotel['HotelCode'] );

        }


        $policies = [];
        $policies_types = [];
        $policies_types["NonRefundable"] = [];
        $policies_types["FreeCancellation"] = [];
        $policies_types["CancellationAllowed"] = [];



        foreach ( $hotels_hotelCodes as $hotel_id ) {

            foreach ( $this->getHotelsRoomRates($hotel_id) as $roomrate ) {

                    if ( !in_array( $roomrate->Availability[0]->AvailabilityStatus, $arrayAvailability ) ) {
                        continue;
                    }

                    $CheckInPolicy = $roomrate->EffectiveDate ;

                    $CheckInPolicy = new DateTime($CheckIn);

                    
                    foreach( $this->getAllRatePlans()[$roomrate->RatePlanID]->CancelPenalties as $cancellation ) {

                        if ( $cancellation->NonRefundable == false && ($cancellation->AmountPercent->Amount == 0 && $cancellation->AmountPercent->Percent == 0 && $cancellation->AmountPercent->NmbrOfNights == 0) ) {

                           
                            if ($cancellation->DeadLine != null && $today->diff($CheckInPolicy) >= $cancellation->DeadLine->OffsetUnitMultiplier) {
                                $policies_types["FreeCancellation"][] = $cancellation->PenaltyDescription->Name;
                            }
                            elseif($cancellation->DeadLine != null && $today->diff($CheckInPolicy) < $cancellation->DeadLine->OffsetUnitMultiplier) {
                                $policies_types["NonRefundable"][] = $cancellation->PenaltyDescription->Name;
                            }
                            else {
                                $policies_types["FreeCancellation"][] = $cancellation->PenaltyDescription->Name;
                            }

                        }
                        elseif ($cancellation->NonRefundable == false && ($cancellation->AmountPercent->Amount != 0 || $cancellation->AmountPercent->Percent != 0 || $cancellation->AmountPercent->NmbrOfNights != 0)) {

                            if($cancellation->DeadLine != null && $today->diff($CheckInPolicy) >= $cancellation->DeadLine->OffsetUnitMultiplier) {
                                $policies_types["CancellationAllowed"][] = $cancellation->PenaltyDescription->Name;
                            }
                            elseif($cancellation->DeadLine != null && $today->diff($CheckInPolicy) <= $cancellation->DeadLine->OffsetUnitMultiplier) {
                                $policies_types["NonRefundable"][] = $cancellation->PenaltyDescription->Name;
                            }
                            else {
                                $policies_types["CancellationAllowed"][] = $cancellation->PenaltyDescription->Name;
                            }

                        }
                        elseif($cancellation->NonRefundable == true) {
                            $policies_types["NonRefundable"][] = $cancellation->PenaltyDescription->Name;
                        }

                        $policies[] = $cancellation->PenaltyDescription->Name;
                    }
                
            }
            
        }

        $show = 0;

        $policies_types["NonRefundable_count"] = count($policies_types["NonRefundable"]) ; 

        if ( $policies_types["NonRefundable_count"]>0 ) { $show++; }

        $policies_types["FreeCancellation_count"] = count( $policies_types["FreeCancellation"] );

        if ( $policies_types["FreeCancellation_count"] > 0 ){ $show++; }

        $policies_types["CancellationAllowed_count"] = count( $policies_types["CancellationAllowed"] );

        if ( $policies_types["CancellationAllowed_count"] > 0 ){ $show++; }

        $policies_types["Total_count"] = $policies_types["NonRefundable_count"] + $policies_types["FreeCancellation_count"]+ $policies_types["CancellationAllowed_count"];

        $policies_types["NonRefundable"] = array_unique( $policies_types["NonRefundable"] );
        $policies_types["FreeCancellation"] = array_unique( $policies_types["FreeCancellation"] );
        $policies_types["CancellationAllowed"] = array_unique( $policies_types["CancellationAllowed"] );

        //var_dump($policies_types);

        return [
            'policies' => $policies_types,
            'filter_show' => $show > 1
        ];

    }







    //get policies info
    public function getPoliciesInfoBestRate() {

        //$hotels = collect($this->getAvailableHotels())->pluck('HotelCode');

        $hotels = self::getAvailableHotels();

        $hotels_hotelCodes = [];

        foreach ($hotels as $hotel) { 

            array_push($hotels_hotelCodes, $hotel['HotelCode'] );

        }

        $policies = [];

        $policies_types = [];
        $policies_types["NonRefundable"] = [];
        $policies_types["FreeCancellation"] = [];
        $policies_types["CancellationAllowed"] = [];
        $policies_total_count = 0;

        foreach ( $hotels_hotelCodes as $hotel_id ) {

            if ( self::getBestRate($hotel_id) != null) {

                $policies_total_count++;

                if ( self::getAllRatePlans()[ self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->NonRefundable == true) {
                    $policies_types["NonRefundable"][] =  self::getAllRatePlans()[ self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->PenaltyDescription->Name;
                }

                if (self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->NonRefundable == false && self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->AmountPercent != null && self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->AmountPercent->Amount == 0) {
                    $policies_types["FreeCancellation"][] = self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->PenaltyDescription->Name;
                }
                if (self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->NonRefundable == false && self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->AmountPercent != null && self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->AmountPercent->Amount > 0) {
                    $policies_types["CancellationAllowed"][] = self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->PenaltyDescription->Name;
                }

                $policies[] = self::getAllRatePlans()[self::getBestRate($hotel_id)->RatePlanID]->CancelPenalties[0]->PenaltyDescription->Name;
            }

        }

        $show = 0;
        
        // $policies_types["NonRefundable_count"] = $policies_types["NonRefundable"]->values()->count();
        $policies_types["NonRefundable_count"] = count($policies_types["NonRefundable"]);
        if($policies_types["NonRefundable_count"]>0){ $show++; }

        // $policies_types["FreeCancellation_count"] = $policies_types["FreeCancellation"]->values()->count();
        $policies_types["FreeCancellation_count"] = count($policies_types["FreeCancellation"]);
        if($policies_types["FreeCancellation_count"]>0){ $show++; }

        // $policies_types["CancellationAllowed_count"] = $policies_types["CancellationAllowed"]->values()->count();
        $policies_types["CancellationAllowed_count"] = count($policies_types["CancellationAllowed"]);
        if($policies_types["CancellationAllowed_count"]>0){ $show++; }

        $policies_types["Total_count"] = $policies_types["NonRefundable_count"] + $policies_types["FreeCancellation_count"]+ $policies_types["CancellationAllowed_count"];

        // $policies_types["NonRefundable"] = $policies_types["NonRefundable"]->unique()->values();
        // $policies_types["FreeCancellation"] = $policies_types["FreeCancellation"]->unique()->values();
        // $policies_types["CancellationAllowed"] = $policies_types["CancellationAllowed"]->unique()->values();
        $policies_types["NonRefundable"] = array_unique($policies_types["NonRefundable"]);
        $policies_types["FreeCancellation"] = array_unique($policies_types["FreeCancellation"]);
        $policies_types["CancellationAllowed"] = array_unique($policies_types["CancellationAllowed"]);



        return [
            'policies' => $policies_types,
            'total_count' => $policies_total_count,
            'filter_show' => $show > 1
        ];

    }




    //get board type
    public function getBoardTypesBestRate() {


        $plans_types["breakfast"] =[];
        $plans_types["half_board"] = [];
        $plans_types["full_board"] = [];
        $plans_types["all_inclusive"] = [];

        $boards_total_count = 0;

        $hotels = $this->getAvailableHotels();

        foreach ($hotels as $hotel) {

            $best_rate = $this->getBestRate($hotel['HotelCode']);

            if( $best_rate != null ) {

                $room_info = $this->getRoomById($best_rate->RoomID);

                if(@$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->MealPlanCode == 1){
                    $plans_types["all_inclusive"][] = @$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->Name;
                }
                elseif(@$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->MealPlanCode == 3){
                    $plans_types["breakfast"][] = @$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->Name;
                }
                elseif(@$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->MealPlanCode == 10){
                    $plans_types["full_board"][] = @$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->Name;
                }
                elseif(@$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->MealPlanCode == 12){
                    $plans_types["half_board"][] = @$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->Name;
                }
                $plans[] = @$this->getAllRatePlans()[$best_rate->RatePlanID]->MealsIncluded->Name;

                $boards_total_count++;
            }

        }

        $show = 0;

        $plans_types["breakfast"]["count"] = count( $plans_types["breakfast"] ) ;

        if ( $plans_types["breakfast"]["count"] > 0 ) { $show++;}

        $plans_types["half_board"]["count"] =  count( $plans_types["half_board"] ) ;

        if ( $plans_types["half_board"]["count"] > 0 ) { $show++; }

        $plans_types["full_board"]["count"] =  count( $plans_types["full_board"] );

        if ( $plans_types["full_board"]["count"] > 0 ) { $show++; }

        $plans_types["all_inclusive"]["count"] =  count( $plans_types["all_inclusive"] );

        if ( $plans_types["all_inclusive"]["count"] > 0 ) { $show++; }

        $plans_types["Total_count"] = $plans_types["breakfast"]["count"] + $plans_types["half_board"]["count"] + $plans_types["full_board"]["count"] +  $plans_types["all_inclusive"]["count"];



        return [

            'boards' => $plans_types,
            'boards_total_count' => $boards_total_count,
            'filter_show' => $show > 1

        ];


    }







    //get board type
    public function getBoardTypes($style) {

        if ( isset($style->Result->ShowUnavailableRates) ) {
            $showUnavailableRates = $style->Result->ShowUnavailableRates;
        } else {
            $showUnavailableRates = false;
        }

        if ( isset($style->Result->AllowReservationsOnRequest) ) {
            $showOnRequestRates = $style->Result->AllowReservationsOnRequest;
        } else {
            $showOnRequestRates = false;
        }

        if ( isset(self::$data->different_dates) ) {

            $hotels = self::getHotels()->pluck('HotelCode');

            $plans = [];
            $plans_types = [];
            $plans_types["breakfast"] = [];
            $plans_types["half_board"] = [];
            $plans_types["full_board"] = [];
            $plans_types["all_inclusive"] = [];
            $boards_total_count = 0;

            foreach ($this->getAllDisplayedRatePlans($style) as $rateplansPerDate) {

                foreach ($rateplansPerDate as $rateplan) {

                    if ($rateplan->MealsIncluded != null) {
                        if($rateplan->MealsIncluded->MealPlanCode == 1){
                            $plans_types["all_inclusive"][] = $rateplan->MealsIncluded->Name;
                        }
                        elseif($rateplan->MealsIncluded->MealPlanCode == 3){
                            $plans_types["breakfast"][] = $rateplan->MealsIncluded->Name;
                        }
                        elseif($rateplan->MealsIncluded->MealPlanCode == 10){
                            $plans_types["full_board"][] = $rateplan->MealsIncluded->Name;
                        }
                        elseif($rateplan->MealsIncluded->MealPlanCode == 12){
                            $plans_types["half_board"][] = $rateplan->MealsIncluded->Name;
                        }
                        $plans[] = $rateplan->MealsIncluded->Name;
                        $boards_total_count++;
                    }

                }
            }

            $show = 0;

            $plans_types["breakfast_count"] = $plans_types["breakfast"]->count();
            if($plans_types["breakfast_count"]>0){$show++;}

            $plans_types["half_board_count"] = $plans_types["half_board"]->count();
            if($plans_types["half_board_count"]>0){$show++;}

            $plans_types["full_board_count"] = $plans_types["full_board"]->count();
            if($plans_types["full_board_count"]>0){$show++;}

            $plans_types["all_inclusive_count"] = $plans_types["all_inclusive"]->count();
            if($plans_types["all_inclusive_count"]>0){$show++;}

            $plans_types["Total_count"] = $plans_types["breakfast_count"] + $plans_types["half_board_count"] + $plans_types["full_board_count"] +  $plans_types["all_inclusive_count"];

            $plans_types["breakfast"] = $plans_types["breakfast"]->unique()->values();
            $plans_types["half_board"] = $plans_types["half_board"]->unique()->values();
            $plans_types["full_board"] = $plans_types["full_board"]->unique()->values();
            $plans_types["all_inclusive"] = $plans_types["all_inclusive"]->unique()->values();

            return [
            'boards' => $plans_types,
            'boards_unique' => $plans->unique(),
            'boards_total_count'=>$boards_total_count,
            'filter_show' => $show > 1
            ];
        }

        $plans = [];
        $plans_types = [];
        $plans_types["breakfast"] = [];
        $plans_types["half_board"] = [];
        $plans_types["full_board"] = [];
        $plans_types["all_inclusive"] = [];
        $boards_total_count = 0;



        if ( !empty(self::getAllDisplayedRatePlans($style) ) ) {


            foreach (self::getAllDisplayedRatePlans($style) as $rateplan) {


                if ($rateplan->MealsIncluded != null) {

                    if ($rateplan->MealsIncluded->MealPlanCode == 1) {
                        $plans_types["all_inclusive"][] = $rateplan->MealsIncluded->Name;
                    } elseif ($rateplan->MealsIncluded->MealPlanCode == 3) {
                        $plans_types["breakfast"][] = $rateplan->MealsIncluded->Name; 
                    } elseif ($rateplan->MealsIncluded->MealPlanCode == 10) {
                        $plans_types["full_board"][] = $rateplan->MealsIncluded->Name;
                    } elseif ($rateplan->MealsIncluded->MealPlanCode == 12) {
                        $plans_types["half_board"][] = $rateplan->MealsIncluded->Name;
                    }

                    if ( $rateplan->MealsIncluded->Name != "Pequeno-Almoço") {
                        $plans[] = $rateplan->MealsIncluded->Name;
                    }
                    
                    $boards_total_count++;
                }

            }

        }


        $show = 0;

        $plans_types["breakfast_count"] = count($plans_types["breakfast"]);
        if ($plans_types["breakfast_count"]>0) {$show++;}

        $plans_types["half_board_count"] = count($plans_types["half_board"]);
        if ($plans_types["half_board_count"]>0) {$show++;}

        $plans_types["full_board_count"] = count($plans_types["full_board"]);
        if ($plans_types["full_board_count"]>0) {$show++;}

        $plans_types["all_inclusive_count"] = count($plans_types["all_inclusive"]);
        if ($plans_types["all_inclusive_count"]>0) {$show++;}

        $plans_types["Total_count"] = $plans_types["breakfast_count"] + $plans_types["half_board_count"] + $plans_types["full_board_count"] +  $plans_types["all_inclusive_count"];


        // array_unique

        $plans_types["breakfast"] = array_unique($plans_types["breakfast"]);
        $plans_types["half_board"] = array_unique($plans_types["half_board"]);
        $plans_types["full_board"] = array_unique($plans_types["full_board"]);
        $plans_types["all_inclusive"] = array_unique($plans_types["all_inclusive"]);
        
        return [
            'boards' => $plans_types,
            'boards_unique' => array_unique($plans),
            'boards_total_count'=>$boards_total_count,
            'filter_show' => $show > 1
        ];

    }


    public function getRoomRateByRoomAndRateplan($hotel_id, $roomid, $rateplanid, $rph) {
        
        $all_rates = $this->getHotelsRoomRates($hotel_id);
        foreach ($all_rates as $rate) {
            if ($rate->RatePlanID==$rateplanid and $rate->RoomID==$roomid and $rate->RoomStayCandidateRPH == $rph) {
                return $rate;
            }
        }
        return null;
    }

    public function getServices() {
        $services = @self::$data->Services;


        if(isset($services) && count($services) > 0) {
            foreach($services as $key => $service) {
                $service->Price2 = (int)$service->Price[0]->AmountBeforeTax;
                $services[$service->ID] = $service;
                unset($services[$key]);
            }
        }
        return $services;
    }   

    public function getCountryCodesBestRate() {

        $hotels = $this->getAvailableHotels();

        $countries = [];

        foreach ( $hotels as $hotel ) {

            array_push( $countries ,  $hotel['Country'] );
        }

        return [

            'countries' => $countries,
            'countries_unique' => array_unique( $countries ),
            'filter_show' => ( count(  array_unique( $countries ) ) > 1 )

        ];


    }







    //get info about hotel stars

    public function getRatingInfoBestRate() {

        $hotels = $this->getAvailableHotels();

        $ratings = [];


        foreach ( $hotels as $hotel ) {

            array_push( $ratings ,  $hotel['Rating'] );
        }

        rsort( $ratings );

        $ratings_unique = array_unique( $ratings );

        $ratings_sorted =  $ratings_unique;

        sort( $ratings_sorted );


        return [
            'ratings' => $ratings,
            'ratings_unique' => $ratings_unique ,
            'ratings_sorted' => $ratings_sorted ,
            'filter_show' => ( count(  $ratings_unique ) -1 )  > 1
        ];


    }

    public function getAcceptedPaymentsStep1() {

        $payments = [];

        $payment_total_count = 0;

        $hotels = $this->getAvailableHotels() ;

        $hotels_count = count($hotels);


        foreach ($hotels as $hotel) {

            $best_rate = $this->getBestRate($hotel['HotelCode']);

            if ( $best_rate != null ) {

                $payment_total_count++;

                $rate_plan = $this->getAllRatePlans()[$best_rate->RatePlanID];

                foreach ( $rate_plan->PaymentPolicies->AcceptedPayments as $payment) {

                        $payments[] = $payment->GuaranteeTypeCode;
              
                }
            }
        }

        //go through payments and only save payments that have less than max hotrels (if all hotels support it dont show it)
        $valuesCounter = array_count_values($payments);

        $cleanPayments = [];

        foreach ( $payments as $payment ) { 

            if ( $valuesCounter[$payment] != $hotels_count ) {
                 $cleanPayments[] = $payment;
            }
        }

        return [
            'payments' => $cleanPayments,
            'payments_unique' => array_unique($cleanPayments),
            'payments_total_count' => $payment_total_count,
            'filter_show' => ( count($cleanPayments) -1 ) > 1
        ];

    }






    public function getAllDisplayedRatePlans($style){

        if (isset($style->Result->ShowUnavailableRates)) {
            $showUnavailableRates = $style->Result->ShowUnavailableRates;
        } else{
            $showUnavailableRates = false;
        }

        if (isset($style->Result->AllowReservationsOnRequest)) {
            $showOnRequestRates = $style->Result->AllowReservationsOnRequest;
        }  else {
            $showOnRequestRates = false;
        }

        $room_ids = $this->getAllDisplayedRooms($style);

        if($showUnavailableRates == true) {

            if ($showOnRequestRates == true) {

                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OnRequest","OtherAvailable"];

            }
            else {

                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OtherAvailable"];
            }
        }
        else {
            if($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OnRequest","OtherAvailable"];
            }
            else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OtherAvailable"];
            }
        }
        $OtherAvailableAvailability = 
        $rateplans = [];

        if (isset($this->data["different_dates"]) && $this->data["different_dates"]==true) {

            for ($i=0; $i < count($this->data)-1; $i++) {
                if ($this->get()[$i]["RoomStaysType"] != null) {

                    foreach ($this->get()[$i]["RoomStaysType"]->RoomStays as $RoomStays) {
                        foreach ($RoomStays->RoomRates as $RoomRate) {
                            if(!in_array($RoomRate->Availability[0]->AvailabilityStatus,$arrayAvailability) ) {
                                continue;
                            }
                            foreach($RoomStays->RatePlans as $RatePlan){
                                if($RatePlan->RatePlanID==$RoomRate->RatePlanID){
                                    $rateplans[$i][] = $RatePlan;
                                }
                            }
                                              
                        }
                    }

                }
            }

            return $rateplans;
        }



        if (self::get()->RoomStaysType != null) {
            foreach (self::get()->RoomStaysType->RoomStays as $RoomStays) {
                foreach ($RoomStays->RoomRates as $RoomRate) {
                    if(!in_array($RoomRate->Availability[0]->AvailabilityStatus,$arrayAvailability) ) {
                        continue;
                    }
                    foreach($RoomStays->RatePlans as $RatePlan){

                        if($RatePlan->RatePlanID==$RoomRate->RatePlanID){
                            $rateplans[] = $RatePlan;
                        }
                    }           
                }
            }

        }
        else {
            $rateplans = null;
        }

        return $rateplans;

    }




    public function getAllDisplayedRooms($style) {

        if (isset($style->Result->ShowUnavailableRates)) {
            $showUnavailableRates = $style->Result->ShowUnavailableRates;
        } else {
            $showUnavailableRates = false;
        }


        if (isset($style->Result->AllowReservationsOnRequest)) {
            $showOnRequestRates = $style->Result->AllowReservationsOnRequest;
        } else {
            $showOnRequestRates = false;
        }


        if ($showUnavailableRates == true) {
            if($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OnRequest","OtherAvailable"];
            }
            else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OtherAvailable"];
            }
        }
        else {
            if($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OnRequest","OtherAvailable"];
            }
            else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OtherAvailable"];
            }
        }

       

        $groupcode_valid = self::GroupCodeValidation();
        $promocode_valid = self::PromoCodeValidation();

        $RoomIDs = [];


        if (isset(self::$data->different_dates)) {

            $roomstays = self::getAllRoomStays();
            $roomrates = [];
            foreach ($roomstays as $key => $roomstay_per_hotel) {
                foreach ($roomstay_per_hotel as $roomstay_per_date) {
                    $roomrates[] = $roomstay_per_date->RoomRates;
                }
            }

            $roomrates = new RecursiveIteratorIterator(new RecursiveArrayIterator($roomrates));


            foreach ($roomrates as $key => $roomrate) {
                if ($roomrate->Availability[0]->AvailabilityStatus == "OtherAvailable") {
                    if($roomrate->Availability[0]->WarningRPH == 427) {
                        continue;
                    }
                    if($roomrate->Availability[0]->WarningRPH == 397) {
                        continue;
                    }
                    if($roomrate->Availability[0]->WarningRPH == 138) {
                        continue;
                    }
                    if($roomrate->Availability[0]->WarningRPH == 142) {
                        continue;
                    }
                }
                if($groupcode_valid[$roomrate->RoomStayCandidateRPH] == true && $roomrate->GroupCode == null) {
                    continue;
                }
                if($promocode_valid[$roomrate->RoomStayCandidateRPH] == true && $roomrate->PromotionCode == null) {
                    continue;
                }
                if(in_array($roomrate->Availability[0]->AvailabilityStatus, $arrayAvailability)) {
                    $RoomIDs[] = $roomrate->RoomID;
                }
            }


            $RoomIDs = array_unique($RoomIDs);

            return $RoomIDs;
        }


        if ( !isset($roomrates) && self::getAllRoomStays() != null ) {

            $roomrates = self::getAllRoomStays();

            $roomrates_array = [];

            foreach ($roomrates as $roomrate) { 

                array_push($roomrates_array, $roomrate->RoomRates );

            }

            $roomrates = $roomrates_array;

            $roomrates = self::array_flatten($roomrates);

        } else {
            return [];
        }



        foreach ($roomrates as $key => $roomrate) {

            

            if ($roomrate->Availability[0]->AvailabilityStatus == "OtherAvailable") {
                if($roomrate->Availability[0]->WarningRPH == 427) {
                    continue;
                }
                if($roomrate->Availability[0]->WarningRPH == 397) {
                    continue;
                }
                if($roomrate->Availability[0]->WarningRPH == 138) {
                    continue;
                }
                if($roomrate->Availability[0]->WarningRPH == 142) {
                    continue;
                }
            }
            if($groupcode_valid == true && $roomrate->GroupCode == null) {
                continue;
            }
            if($promocode_valid == true && $roomrate->PromotionCode == null) {
                continue;
            }

            if(in_array($roomrate->Availability[0]->AvailabilityStatus, $arrayAvailability)) {

                $RoomIDs[] = $roomrate->RoomID;
                
            }

        }


        $RoomIDs = array_unique($RoomIDs);

        return $RoomIDs; //only the ids

    }


    // public function GroupCodeValidation() {
    //     //CHECK IF GROUPCODE IS VALID OR NOT WHEN IS INSERTED

    //     if(isset($this->data["different_dates"])) {
    //         $groupcode_valid = [];
    //         for ($i=0; $i < count($this->data)-1; $i++) {
    //             $groupcode_valid[$i] = false;
    //             if(isset($this->data[$i]["Criteria"]->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->GroupCode)) {
    //                 $groupcode = $this->data[$i]["Criteria"]->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->GroupCode;
    //             }
    //             else {
    //                 $groupcode = null;
    //             }
    //             if($groupcode != null) {
    //                 $groupcode_valid[$i] = true;
    //                 if(isset($this->data[$i]["WarningsType"]->Warnings) && $this->data[$i]["WarningsType"]->Warnings != null) {
    //                     foreach($this->data[$i]["WarningsType"]->Warnings as $Warning) {
    //                         if($Warning->Code == 569) {
    //                             $groupcode_valid[$i] = false;
    //                         }
    //                     }
    //                 }
    //             }

    //         }

    //         return $groupcode_valid;
    //     }


    //     $groupcode_valid = false;
    //     if(isset($this->get()["Criteria"]->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->GroupCode)) {
    //         $groupcode = $this->get()["Criteria"]->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->GroupCode;
    //     }
    //     else {
    //         $groupcode = null;
    //     }
    //     if($groupcode != null) {
    //         $groupcode_valid = true;
    //         if(isset($this->get()["WarningsType"]->Warnings) && $this->get()["WarningsType"]->Warnings != null) {
    //             foreach($this->get()["WarningsType"]->Warnings as $Warning) {
    //                 if($Warning->Code == 569) {
    //                     $groupcode_valid = false;
    //                 }
    //             }
    //         }
    //     }

    //     return $groupcode_valid;

    // }





    public function PromoCodeValidation() {
        //CHECK IF PROMOCODE IS VALID OR NOT WHEN IS INSERTED

        // if(isset(self::$data["different_dates"])) {
        //     $promocode_valid = [];
        //     for ($i=0; $i < count(self::$data)-1; $i++) {
        //         $promocode_valid[$i] = false;
        //         if(isset(self::$data[$i]["Criteria"]->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->PromotionCode)) {
        //             $promocode = self::data[$i]["Criteria"]->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->PromotionCode;
        //         }
        //         else {
        //             $promocode = null;
        //         }
        //         if($promocode != null) {
        //             $promocode_valid[$i] = false;
        //             if(isset(self::$data[$i]["RoomStaysType"]->RoomStays[0]->RoomRates)) {
        //                 foreach (self::$data[$i]["RoomStaysType"]->RoomStays[0]->RoomRates as $RoomRate) {
        //                     if(isset($RoomRate->PromotionCode)) {
        //                         $promocode_valid[$i] = true;
        //                         break;
        //                     }
        //                 }
        //             }
        //         }

        //     }

        //     return $promocode_valid;
        // }



        $promocode_valid = false;
        if(isset(self::get()->Criteria->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->PromotionCode)) {
            $promocode = self::get()->Criteria->Criterion->RatePlanCandidatesType->RatePlanCandidates[0]->PromotionCode;
        }
        else {
            $promocode = null;
        }
        if($promocode != null) {
            $promocode_valid = false;
            if(isset(self::get()->RoomStaysType->RoomStays[0]->RoomRates)) {
                foreach (self::get()->RoomStaysType->RoomStays[0]->RoomRates as $RoomRate) {
                    if(isset($RoomRate->PromotionCode)) {
                        $promocode_valid = true;
                        break;
                    }
                }
            }
        }

        return $promocode_valid;

    }


    public function getAcceptedPaymentsStep2($hotel_code) {

        if (isset( self::$data->different_dates )) {
            $payments = [];
            $rateplans_count = 0;
            for ($i=0; $i < count( self::$data )-1; $i++) {
                foreach ($this->data[$i]["RoomStaysType"]->RoomStays[0]->RatePlans as $rateplan) {
                    foreach (@$rateplan->PaymentPolicies->AcceptedPayments as $payment) {
                        $payments[] = @$payment->GuaranteeTypeCode;
                    }
                    $rateplans_count++;
                }
            }

            $valuesCounter = array_count_values($payments->toArray());

            return [
                'payments' => $payments,
                'payments_unique' => $payments->unique(),
                'filter_show' => (count($payments)-1) > 1,
                'rateplans_count' => $rateplans_count
            ];
        }

        $payments = [];
        $rateplans_count = 0;

        if(self::get()->RoomStaysType == null) {
            return null;
        }



        foreach (self::get()->RoomStaysType->RoomStays[0]->RatePlans as $rateplan) {
            foreach ( $rateplan->PaymentPolicies->AcceptedPayments as $payment) {
                $payments[] = $payment->GuaranteeTypeCode;
            }
            $rateplans_count++;
        }


        return [
            'payments' => $payments,
            'payments_unique' => array_unique($payments),
            'filter_show' => (count($payments)-1) > 1,
            'rateplans_count' => $rateplans_count
        ];


    }

    public function getRoomRatesByRate($hotel_id, $rate_id) {
        if (isset($this->data["different_dates"])) {
            $rates = [];
            for ($i=0; $i < count($this->data)-1; $i++) {
                foreach (@$this->getHotelsRoomRates($hotel_id)[$i] as $roomrate) {
                    if ($roomrate->RoomID == $rate_id) {
                        $rates[$i][] = $roomrate;
                    }
                }
                // $rates[] = collect(@$this->getHotelsRoomRates($hotel_id)[$i])->groupBy('RoomID')[$room_id];
            }

            return $rates;
        }

        $rates = @$this->getHotelsRoomRates($hotel_id);
        foreach($rates as $key => $rate) {
            if($rate->RatePlanID != $rate_id) {
                unset($rates[$key]);
            }
        }

        return $rates;
    }
     
    public function getRoomRatesByRoomAvailabilityWithRateId($hotel_id, $rate_id, $availability_ids) {

        $data = $this->getRoomRatesByRate($hotel_id, $rate_id);
        if($data == null) {
            return null;
        }

        foreach($data as $key => $roomrate) {
            if (!in_array($roomrate->Availability[0]->AvailabilityStatus, $availability_ids)) {
                unset($data[$key]);
            }
            if ($roomrate->Availability[0]->WarningRPH == 109) {
                unset($data[$key]);
            }
        }

        return $data;
    }


    public function getHotelsRoomRates2($hotel_id, $style) {

        if(isset($style->Result->ShowUnavailableRates)) {
            $showUnavailableRates = $style->Result->ShowUnavailableRates;
        }
        else{
            $showUnavailableRates = false;
        }

        if(isset($style->Result->AllowReservationsOnRequest)) {
            $showOnRequestRates = $style->Result->AllowReservationsOnRequest;
        }
        else {
            $showOnRequestRates = false;
        }

        if($showUnavailableRates == true) {
            if($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OnRequest","OtherAvailable"];
            }
            else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","ClosedOut","OtherAvailable"];
            }
        }
        else {
            if($showOnRequestRates == true) {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OnRequest","OtherAvailable"];
            }
            else {
                $arrayAvailability = ["AvailableForSale","LOS_Restricted","OtherAvailable"];
            }
        }

        $groupcode_valid = $this->GroupCodeValidation();
        $promocode_valid = $this->PromoCodeValidation();

        if (isset($this->data["different_dates"])) {
            $rates = [];
            for ($i=0; $i < count($this->data)-1; $i++) {
                // foreach (collect($this->getHotelsRoomStays($hotel_id)) as $RoomStay) {
                //     $rates[$i] = $RoomStay->RoomRates;
                // }
                $rates[$i] = $this->getHotelsRoomStays($hotel_id)[$i]->RoomRates;
            }

            foreach ($rates as $key => $rate_per_hotel) {
                foreach ($rate_per_hotel as $key1 => $rate) {
                    if(!in_array($rate->Availability[0]->AvailabilityStatus,$arrayAvailability) ) {
                        // $rates[$key]->forget($key1);
                        unset($rates[$key][$key1]);
                    }
                    if($rate->Availability[0]->WarningRPH == 109){
                        // $rates[$key]->forget($key1);
                        unset($rates[$key][$key1]);
                    }
                    if($groupcode_valid[$key] == true && $rate->GroupCode == null) {
                        // $rates[$key]->forget($key1);
                        unset($rates[$key][$key1]);
                    }
                    if($promocode_valid[$key] == true && $rate->PromotionCode == null) {
                        // $rates[$key]->forget($key1);
                        unset($rates[$key][$key1]);
                    }
                }
            }

            return $rates;
        }
        
        if($this->getHotelsRoomStays($hotel_id) != null) {
            $rates = $this->getHotelsRoomStays($hotel_id)->RoomRates;

            foreach ($rates as $key => $rate) {
                if(!in_array($rate->Availability[0]->AvailabilityStatus,$arrayAvailability) ) {
                    // $rates->forget($key);
                    unset($rates[$key]);
                }
                if($rate->Availability[0]->WarningRPH == 109){
                    // $rates->forget($key);
                    unset($rates[$key]);
                }
                if($groupcode_valid == true && $rate->GroupCode == null) {
                    // $rates->forget($key);
                    unset($rates[$key]);
                }
                if($promocode_valid == true && $rate->PromotionCode == null) {
                    // $rates->forget($key);
                    unset($rates[$key]);
                }
            }
            return $rates;
        }
        else {
            return null;
        }

    }

}
