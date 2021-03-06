<?php
require_once(dirname(__FILE__) . '/settingsController.php');

?>
<div class="obpress-contain">
    <div class="obpress-wrap">
        <h1 class="obpress-welcome">Welcome to OBPress Menager!</h1>
        <div class="container content-container">
            <div class="obpress-select-currency">
                <h3>Select Currency</h3>
                <div>
                    <span>Select your country curency:</span>
                    <select class="currency-select" data-selected-currency="<?= get_option('default_currency_id'); ?>">
                        <?php foreach ($currencies as $currency) : ?>
                            <option class="currency-select-option" data-currency-id="<?= $currency->UID; ?>"<?php if(get_option('default_currency_id') == $currency->UID){echo 'selected';} ?>><?= $currency->Name; ?> (<?= $currency->CurrencySymbol; ?>) </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- <div class="obpress-select-language">
                <h3>Select Language</h3>
                <select class="language-select">
                    <?php foreach ($languages as $language) : ?>
                        <option class="language-select-option" data-language-id="<?= $language->UID ?>"<?php if(get_option('default_language_id') == $language->UID){echo 'selected';} ?>><?= $language->Name ?></option>
                    <?php endforeach; ?>
                </select>
            </div> -->

            <div class="obpress-calendar-options">
                <h3>Calendar Options</h3>
                <div class="obpress-select-calendar-adults">
                    <span>Select Number of Adults for Calendar</span>
                    <select class="calendar-adults-select" data-adults-selected="<?= get_option('calendar_adults') ?>">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="obpress-calendar-allow-unavail">
                    <label for="obpress-calendar-allow-checkbox">Allow selecting unavailable dates in calendar</label>
                    <input type="checkbox" id="obpress-calendar-allow-checkbox">
                </div>
            </div>

            <?php if(empty(get_option('hotel_id'))) : ?>
                <div class="obpress-select-list-hotel" data-removed-hotels="<?= get_option('removed_hotels') ?>">
                    <h3>Select which hotels will be visible</h3>
                    <div class="obpress-list-grid">
                        <?php foreach($hotelFromFolder as $key=>$hotel) : ?>
                            <span class="list-hotel-holder">
                                <input type="checkbox" class="list-hotel-checkbox" data-property-id="<?= $hotel->Property_UID ?>" checked="checked" id="list-hotel-checkbox.<?= $key; ?>">
                                <label for="list-hotel-checkbox.<?= $key; ?>" class="list-hotel-label" data-property-id="<?= $hotel->Property_UID ?>"><?= $hotel->Property_Name ?></label>
                            </span> 
                        <?php endforeach; ?>         
                    </div>
                </div>
            <?php endif; ?>


            <?php if ( $available_packages->RoomStaysType != null ) : ?>
                <div class="obpress-select-packages" data-removed-packages="<?= get_option('removed_packages') ?>">
                    <h3>Select which package will be visible</h3>
                    <div class="obpress-list-grid">
                        <?php 
                            foreach ($available_packages->RoomStaysType->RoomStays as $package) {
                                  ?>
                                   <span class="list-packages-span">
                                        <input type="checkbox" class="list-packages" data-property-id="<?php echo $package->RatePlans[0]->RatePlanID ?>" checked="checked" id="<?php echo $package->RatePlans[0]->RatePlanID ?>">
                                        <label for="<?php echo $package->RatePlans[0]->RatePlanID ?>" class="list-package-label" data-property-id="<?php echo $package->RatePlans[0]->RatePlanID ?>">     
                                            <?php echo $package->RatePlans[0]->RatePlanName;  ?> ( ID: <?php echo $package->RatePlans[0]->RatePlanID ?>)     
                                        </label>
                                    </span> 
                                <?php
                            }
                        ?> 
                    </div>
                </div>


                <div class="obpress-order-packages"> 

                    <h3>Select how packages will be ordered</h3>

                    <span class="obpress-order-packages-span">

                        <label for="package-order" class="package-order" >     
                            Select how packages will be ordered   
                        </label>

                        <select id="package-order" date-method="<?= get_option('package_order') ?>">
                            <option value="folder">By folder (default)</option>
                            <option value="date">By date</option>
                            <option value="price">By price</option>
                        </select>

                    
                    </span> 

                </div>


            <?php endif; ?>


            <div class="obpress-select-max-rooms">
                <h3>Select maximum number of rooms</h3>
                <div class="obpress-select-max-rooms-holder">
                    <div>
                        <span class="obpress-hotel-select">
                            <span>Hotel:</span>
                            <select name="" id="obpress-hotel-options">
                            <?php foreach($hotelFromFolder as $hotel) : ?>
                                <option class='obpress-room-option' value="<?= $hotel->Property_UID ?>"><?= $hotel->Property_Name ?></option>
                            <?php endforeach; ?>
                            </select>
                        </span>
                        <span class="obpress-room-select">
                            <span>Max Rooms</span>
                            <select name="" id="obpress-room-options">
                                    <!-- Options are generated through javascript, check line 80 in admin.js -->
                            </select>
                        </span>
                    </div>
                    <span class="obpress-footer-info">
                        <h3>Footer Info</h3>
                        <span class="obpress-footer-info-api">
                            <label for="obpress-footer-api-checkbox">Use footer information from the API</label>
                            <input type="checkbox" id="obpress-footer-api-checkbox" <?php if(get_option('footer_api_option') == 'true'){echo 'checked="checked"';}?>>
                        </span>
                    </span>
                    <span class="obpress-google-maps">
                        <h3>Google Maps Api</h3>
                        <span class="obpress-google-maps-api">
                            <span>Enter your Google Maps API key</span>
                            <input id="obpress-maps-api-input" value="<?= get_option('obpress_google_maps_api_key'); ?>">
                        </span>
                    </span>        
                </div>
            </div>



        </div>
        <div class="obpress-apply-holder">
            <button class="obpress-apply">Apply Changes</button>
        </div>

        <form method="POST" action="">
            <input class="disconnect-button" name="disconnect" value="disconnect" type="submit">
        </form>
    </div>
</div>
