<?php

const BEAPI_URL = "https://beapi.omnibees.com/api/BE/";
// const BEAPI_URL = "https://beapi-cert.omnibees.com/api/BE/";



class BeApi
{

  public static function countriesISO3166($alpha2) {
    $countriesISO3166 = [
        [
            'name' => 'Afghanistan',
            'alpha2' => 'AF',
            'alpha3' => 'AFG',
            'numeric' => '004',
            'currency' => [
                'AFN',
            ],
        ],
        [
            'name' => 'Åland Islands',
            'alpha2' => 'AX',
            'alpha3' => 'ALA',
            'numeric' => '248',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Albania',
            'alpha2' => 'AL',
            'alpha3' => 'ALB',
            'numeric' => '008',
            'currency' => [
                'ALL',
            ],
        ],
        [
            'name' => 'Algeria',
            'alpha2' => 'DZ',
            'alpha3' => 'DZA',
            'numeric' => '012',
            'currency' => [
                'DZD',
            ],
        ],
        [
            'name' => 'American Samoa',
            'alpha2' => 'AS',
            'alpha3' => 'ASM',
            'numeric' => '016',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Andorra',
            'alpha2' => 'AD',
            'alpha3' => 'AND',
            'numeric' => '020',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Angola',
            'alpha2' => 'AO',
            'alpha3' => 'AGO',
            'numeric' => '024',
            'currency' => [
                'AOA',
            ],
        ],
        [
            'name' => 'Anguilla',
            'alpha2' => 'AI',
            'alpha3' => 'AIA',
            'numeric' => '660',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Antarctica',
            'alpha2' => 'AQ',
            'alpha3' => 'ATA',
            'numeric' => '010',
            'currency' => [
                'ARS',
                'AUD',
                'BGN',
                'BRL',
                'BYR',
                'CLP',
                'CNY',
                'CZK',
                'EUR',
                'GBP',
                'INR',
                'JPY',
                'KRW',
                'NOK',
                'NZD',
                'PEN',
                'PKR',
                'PLN',
                'RON',
                'RUB',
                'SEK',
                'UAH',
                'USD',
                'UYU',
                'ZAR',
            ],
        ],
        [
            'name' => 'Antigua and Barbuda',
            'alpha2' => 'AG',
            'alpha3' => 'ATG',
            'numeric' => '028',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Argentina',
            'alpha2' => 'AR',
            'alpha3' => 'ARG',
            'numeric' => '032',
            'currency' => [
                'ARS',
            ],
        ],
        [
            'name' => 'Armenia',
            'alpha2' => 'AM',
            'alpha3' => 'ARM',
            'numeric' => '051',
            'currency' => [
                'AMD',
            ],
        ],
        [
            'name' => 'Aruba',
            'alpha2' => 'AW',
            'alpha3' => 'ABW',
            'numeric' => '533',
            'currency' => [
                'AWG',
            ],
        ],
        [
            'name' => 'Australia',
            'alpha2' => 'AU',
            'alpha3' => 'AUS',
            'numeric' => '036',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Austria',
            'alpha2' => 'AT',
            'alpha3' => 'AUT',
            'numeric' => '040',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Azerbaijan',
            'alpha2' => 'AZ',
            'alpha3' => 'AZE',
            'numeric' => '031',
            'currency' => [
                'AZN',
            ],
        ],
        [
            'name' => 'Bahamas',
            'alpha2' => 'BS',
            'alpha3' => 'BHS',
            'numeric' => '044',
            'currency' => [
                'BSD',
            ],
        ],
        [
            'name' => 'Bahrain',
            'alpha2' => 'BH',
            'alpha3' => 'BHR',
            'numeric' => '048',
            'currency' => [
                'BHD',
            ],
        ],
        [
            'name' => 'Bangladesh',
            'alpha2' => 'BD',
            'alpha3' => 'BGD',
            'numeric' => '050',
            'currency' => [
                'BDT',
            ],
        ],
        [
            'name' => 'Barbados',
            'alpha2' => 'BB',
            'alpha3' => 'BRB',
            'numeric' => '052',
            'currency' => [
                'BBD',
            ],
        ],
        [
            'name' => 'Belarus',
            'alpha2' => 'BY',
            'alpha3' => 'BLR',
            'numeric' => '112',
            'currency' => [
                'BYN',
            ],
        ],
        [
            'name' => 'Belgium',
            'alpha2' => 'BE',
            'alpha3' => 'BEL',
            'numeric' => '056',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Belize',
            'alpha2' => 'BZ',
            'alpha3' => 'BLZ',
            'numeric' => '084',
            'currency' => [
                'BZD',
            ],
        ],
        [
            'name' => 'Benin',
            'alpha2' => 'BJ',
            'alpha3' => 'BEN',
            'numeric' => '204',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Bermuda',
            'alpha2' => 'BM',
            'alpha3' => 'BMU',
            'numeric' => '060',
            'currency' => [
                'BMD',
            ],
        ],
        [
            'name' => 'Bhutan',
            'alpha2' => 'BT',
            'alpha3' => 'BTN',
            'numeric' => '064',
            'currency' => [
                'BTN',
            ],
        ],
        [
            'name' => 'Bolivia (Plurinational State of)',
            'alpha2' => 'BO',
            'alpha3' => 'BOL',
            'numeric' => '068',
            'currency' => [
                'BOB',
            ],
        ],
        [
            'name' => 'Bonaire, Sint Eustatius and Saba',
            'alpha2' => 'BQ',
            'alpha3' => 'BES',
            'numeric' => '535',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Bosnia and Herzegovina',
            'alpha2' => 'BA',
            'alpha3' => 'BIH',
            'numeric' => '070',
            'currency' => [
                'BAM',
            ],
        ],
        [
            'name' => 'Botswana',
            'alpha2' => 'BW',
            'alpha3' => 'BWA',
            'numeric' => '072',
            'currency' => [
                'BWP',
            ],
        ],
        [
            'name' => 'Bouvet Island',
            'alpha2' => 'BV',
            'alpha3' => 'BVT',
            'numeric' => '074',
            'currency' => [
                'NOK',
            ],
        ],
        [
            'name' => 'Brazil',
            'alpha2' => 'BR',
            'alpha3' => 'BRA',
            'numeric' => '076',
            'currency' => [
                'BRL',
            ],
        ],
        [
            'name' => 'British Indian Ocean Territory',
            'alpha2' => 'IO',
            'alpha3' => 'IOT',
            'numeric' => '086',
            'currency' => [
                'GBP',
            ],
        ],
        [
            'name' => 'Brunei Darussalam',
            'alpha2' => 'BN',
            'alpha3' => 'BRN',
            'numeric' => '096',
            'currency' => [
                'BND',
                'SGD',
            ],
        ],
        [
            'name' => 'Bulgaria',
            'alpha2' => 'BG',
            'alpha3' => 'BGR',
            'numeric' => '100',
            'currency' => [
                'BGN',
            ],
        ],
        [
            'name' => 'Burkina Faso',
            'alpha2' => 'BF',
            'alpha3' => 'BFA',
            'numeric' => '854',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Burundi',
            'alpha2' => 'BI',
            'alpha3' => 'BDI',
            'numeric' => '108',
            'currency' => [
                'BIF',
            ],
        ],
        [
            'name' => 'Cabo Verde',
            'alpha2' => 'CV',
            'alpha3' => 'CPV',
            'numeric' => '132',
            'currency' => [
                'CVE',
            ],
        ],
        [
            'name' => 'Cambodia',
            'alpha2' => 'KH',
            'alpha3' => 'KHM',
            'numeric' => '116',
            'currency' => [
                'KHR',
            ],
        ],
        [
            'name' => 'Cameroon',
            'alpha2' => 'CM',
            'alpha3' => 'CMR',
            'numeric' => '120',
            'currency' => [
                'XAF',
            ],
        ],
        [
            'name' => 'Canada',
            'alpha2' => 'CA',
            'alpha3' => 'CAN',
            'numeric' => '124',
            'currency' => [
                'CAD',
            ],
        ],
        [
            'name' => 'Cayman Islands',
            'alpha2' => 'KY',
            'alpha3' => 'CYM',
            'numeric' => '136',
            'currency' => [
                'KYD',
            ],
        ],
        [
            'name' => 'Central African Republic',
            'alpha2' => 'CF',
            'alpha3' => 'CAF',
            'numeric' => '140',
            'currency' => [
                'XAF',
            ],
        ],
        [
            'name' => 'Chad',
            'alpha2' => 'TD',
            'alpha3' => 'TCD',
            'numeric' => '148',
            'currency' => [
                'XAF',
            ],
        ],
        [
            'name' => 'Chile',
            'alpha2' => 'CL',
            'alpha3' => 'CHL',
            'numeric' => '152',
            'currency' => [
                'CLP',
            ],
        ],
        [
            'name' => 'China',
            'alpha2' => 'CN',
            'alpha3' => 'CHN',
            'numeric' => '156',
            'currency' => [
                'CNY',
            ],
        ],
        [
            'name' => 'Christmas Island',
            'alpha2' => 'CX',
            'alpha3' => 'CXR',
            'numeric' => '162',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Cocos (Keeling) Islands',
            'alpha2' => 'CC',
            'alpha3' => 'CCK',
            'numeric' => '166',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Colombia',
            'alpha2' => 'CO',
            'alpha3' => 'COL',
            'numeric' => '170',
            'currency' => [
                'COP',
            ],
        ],
        [
            'name' => 'Comoros',
            'alpha2' => 'KM',
            'alpha3' => 'COM',
            'numeric' => '174',
            'currency' => [
                'KMF',
            ],
        ],
        [
            'name' => 'Congo',
            'alpha2' => 'CG',
            'alpha3' => 'COG',
            'numeric' => '178',
            'currency' => [
                'XAF',
            ],
        ],
        [
            'name' => 'Congo (Democratic Republic of the)',
            'alpha2' => 'CD',
            'alpha3' => 'COD',
            'numeric' => '180',
            'currency' => [
                'CDF',
            ],
        ],
        [
            'name' => 'Cook Islands',
            'alpha2' => 'CK',
            'alpha3' => 'COK',
            'numeric' => '184',
            'currency' => [
                'NZD',
            ],
        ],
        [
            'name' => 'Costa Rica',
            'alpha2' => 'CR',
            'alpha3' => 'CRI',
            'numeric' => '188',
            'currency' => [
                'CRC',
            ],
        ],
        [
            'name' => 'Côte d\'Ivoire',
            'alpha2' => 'CI',
            'alpha3' => 'CIV',
            'numeric' => '384',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Croatia',
            'alpha2' => 'HR',
            'alpha3' => 'HRV',
            'numeric' => '191',
            'currency' => [
                'HRK',
            ],
        ],
        [
            'name' => 'Cuba',
            'alpha2' => 'CU',
            'alpha3' => 'CUB',
            'numeric' => '192',
            'currency' => [
                'CUC',
                'CUP',
            ],
        ],
        [
            'name' => 'Curaçao',
            'alpha2' => 'CW',
            'alpha3' => 'CUW',
            'numeric' => '531',
            'currency' => [
                'ANG',
            ],
        ],
        [
            'name' => 'Cyprus',
            'alpha2' => 'CY',
            'alpha3' => 'CYP',
            'numeric' => '196',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Czechia',
            'alpha2' => 'CZ',
            'alpha3' => 'CZE',
            'numeric' => '203',
            'currency' => [
                'CZK',
            ],
        ],
        [
            'name' => 'Denmark',
            'alpha2' => 'DK',
            'alpha3' => 'DNK',
            'numeric' => '208',
            'currency' => [
                'DKK',
            ],
        ],
        [
            'name' => 'Djibouti',
            'alpha2' => 'DJ',
            'alpha3' => 'DJI',
            'numeric' => '262',
            'currency' => [
                'DJF',
            ],
        ],
        [
            'name' => 'Dominica',
            'alpha2' => 'DM',
            'alpha3' => 'DMA',
            'numeric' => '212',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Dominican Republic',
            'alpha2' => 'DO',
            'alpha3' => 'DOM',
            'numeric' => '214',
            'currency' => [
                'DOP',
            ],
        ],
        [
            'name' => 'Ecuador',
            'alpha2' => 'EC',
            'alpha3' => 'ECU',
            'numeric' => '218',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Egypt',
            'alpha2' => 'EG',
            'alpha3' => 'EGY',
            'numeric' => '818',
            'currency' => [
                'EGP',
            ],
        ],
        [
            'name' => 'El Salvador',
            'alpha2' => 'SV',
            'alpha3' => 'SLV',
            'numeric' => '222',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Equatorial Guinea',
            'alpha2' => 'GQ',
            'alpha3' => 'GNQ',
            'numeric' => '226',
            'currency' => [
                'XAF',
            ],
        ],
        [
            'name' => 'Eritrea',
            'alpha2' => 'ER',
            'alpha3' => 'ERI',
            'numeric' => '232',
            'currency' => [
                'ERN',
            ],
        ],
        [
            'name' => 'Estonia',
            'alpha2' => 'EE',
            'alpha3' => 'EST',
            'numeric' => '233',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Ethiopia',
            'alpha2' => 'ET',
            'alpha3' => 'ETH',
            'numeric' => '231',
            'currency' => [
                'ETB',
            ],
        ],
        [
            'name' => 'Eswatini',
            'alpha2' => 'SZ',
            'alpha3' => 'SWZ',
            'numeric' => '748',
            'currency' => [
                'SZL',
                'ZAR',
            ],
        ],
        [
            'name' => 'Falkland Islands (Malvinas)',
            'alpha2' => 'FK',
            'alpha3' => 'FLK',
            'numeric' => '238',
            'currency' => [
                'FKP',
            ],
        ],
        [
            'name' => 'Faroe Islands',
            'alpha2' => 'FO',
            'alpha3' => 'FRO',
            'numeric' => '234',
            'currency' => [
                'DKK',
            ],
        ],
        [
            'name' => 'Fiji',
            'alpha2' => 'FJ',
            'alpha3' => 'FJI',
            'numeric' => '242',
            'currency' => [
                'FJD',
            ],
        ],
        [
            'name' => 'Finland',
            'alpha2' => 'FI',
            'alpha3' => 'FIN',
            'numeric' => '246',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'France',
            'alpha2' => 'FR',
            'alpha3' => 'FRA',
            'numeric' => '250',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'French Guiana',
            'alpha2' => 'GF',
            'alpha3' => 'GUF',
            'numeric' => '254',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'French Polynesia',
            'alpha2' => 'PF',
            'alpha3' => 'PYF',
            'numeric' => '258',
            'currency' => [
                'XPF',
            ],
        ],
        [
            'name' => 'French Southern Territories',
            'alpha2' => 'TF',
            'alpha3' => 'ATF',
            'numeric' => '260',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Gabon',
            'alpha2' => 'GA',
            'alpha3' => 'GAB',
            'numeric' => '266',
            'currency' => [
                'XAF',
            ],
        ],
        [
            'name' => 'Gambia',
            'alpha2' => 'GM',
            'alpha3' => 'GMB',
            'numeric' => '270',
            'currency' => [
                'GMD',
            ],
        ],
        [
            'name' => 'Georgia',
            'alpha2' => 'GE',
            'alpha3' => 'GEO',
            'numeric' => '268',
            'currency' => [
                'GEL',
            ],
        ],
        [
            'name' => 'Germany',
            'alpha2' => 'DE',
            'alpha3' => 'DEU',
            'numeric' => '276',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Ghana',
            'alpha2' => 'GH',
            'alpha3' => 'GHA',
            'numeric' => '288',
            'currency' => [
                'GHS',
            ],
        ],
        [
            'name' => 'Gibraltar',
            'alpha2' => 'GI',
            'alpha3' => 'GIB',
            'numeric' => '292',
            'currency' => [
                'GIP',
            ],
        ],
        [
            'name' => 'Greece',
            'alpha2' => 'GR',
            'alpha3' => 'GRC',
            'numeric' => '300',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Greenland',
            'alpha2' => 'GL',
            'alpha3' => 'GRL',
            'numeric' => '304',
            'currency' => [
                'DKK',
            ],
        ],
        [
            'name' => 'Grenada',
            'alpha2' => 'GD',
            'alpha3' => 'GRD',
            'numeric' => '308',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Guadeloupe',
            'alpha2' => 'GP',
            'alpha3' => 'GLP',
            'numeric' => '312',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Guam',
            'alpha2' => 'GU',
            'alpha3' => 'GUM',
            'numeric' => '316',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Guatemala',
            'alpha2' => 'GT',
            'alpha3' => 'GTM',
            'numeric' => '320',
            'currency' => [
                'GTQ',
            ],
        ],
        [
            'name' => 'Guernsey',
            'alpha2' => 'GG',
            'alpha3' => 'GGY',
            'numeric' => '831',
            'currency' => [
                'GBP',
            ],
        ],
        [
            'name' => 'Guinea',
            'alpha2' => 'GN',
            'alpha3' => 'GIN',
            'numeric' => '324',
            'currency' => [
                'GNF',
            ],
        ],
        [
            'name' => 'Guinea-Bissau',
            'alpha2' => 'GW',
            'alpha3' => 'GNB',
            'numeric' => '624',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Guyana',
            'alpha2' => 'GY',
            'alpha3' => 'GUY',
            'numeric' => '328',
            'currency' => [
                'GYD',
            ],
        ],
        [
            'name' => 'Haiti',
            'alpha2' => 'HT',
            'alpha3' => 'HTI',
            'numeric' => '332',
            'currency' => [
                'HTG',
            ],
        ],
        [
            'name' => 'Heard Island and McDonald Islands',
            'alpha2' => 'HM',
            'alpha3' => 'HMD',
            'numeric' => '334',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Holy See',
            'alpha2' => 'VA',
            'alpha3' => 'VAT',
            'numeric' => '336',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Honduras',
            'alpha2' => 'HN',
            'alpha3' => 'HND',
            'numeric' => '340',
            'currency' => [
                'HNL',
            ],
        ],
        [
            'name' => 'Hong Kong',
            'alpha2' => 'HK',
            'alpha3' => 'HKG',
            'numeric' => '344',
            'currency' => [
                'HKD',
            ],
        ],
        [
            'name' => 'Hungary',
            'alpha2' => 'HU',
            'alpha3' => 'HUN',
            'numeric' => '348',
            'currency' => [
                'HUF',
            ],
        ],
        [
            'name' => 'Iceland',
            'alpha2' => 'IS',
            'alpha3' => 'ISL',
            'numeric' => '352',
            'currency' => [
                'ISK',
            ],
        ],
        [
            'name' => 'India',
            'alpha2' => 'IN',
            'alpha3' => 'IND',
            'numeric' => '356',
            'currency' => [
                'INR',
            ],
        ],
        [
            'name' => 'Indonesia',
            'alpha2' => 'ID',
            'alpha3' => 'IDN',
            'numeric' => '360',
            'currency' => [
                'IDR',
            ],
        ],
        [
            'name' => 'Iran (Islamic Republic of)',
            'alpha2' => 'IR',
            'alpha3' => 'IRN',
            'numeric' => '364',
            'currency' => [
                'IRR',
            ],
        ],
        [
            'name' => 'Iraq',
            'alpha2' => 'IQ',
            'alpha3' => 'IRQ',
            'numeric' => '368',
            'currency' => [
                'IQD',
            ],
        ],
        [
            'name' => 'Ireland',
            'alpha2' => 'IE',
            'alpha3' => 'IRL',
            'numeric' => '372',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Isle of Man',
            'alpha2' => 'IM',
            'alpha3' => 'IMN',
            'numeric' => '833',
            'currency' => [
                'GBP',
            ],
        ],
        [
            'name' => 'Israel',
            'alpha2' => 'IL',
            'alpha3' => 'ISR',
            'numeric' => '376',
            'currency' => [
                'ILS',
            ],
        ],
        [
            'name' => 'Italy',
            'alpha2' => 'IT',
            'alpha3' => 'ITA',
            'numeric' => '380',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Jamaica',
            'alpha2' => 'JM',
            'alpha3' => 'JAM',
            'numeric' => '388',
            'currency' => [
                'JMD',
            ],
        ],
        [
            'name' => 'Japan',
            'alpha2' => 'JP',
            'alpha3' => 'JPN',
            'numeric' => '392',
            'currency' => [
                'JPY',
            ],
        ],
        [
            'name' => 'Jersey',
            'alpha2' => 'JE',
            'alpha3' => 'JEY',
            'numeric' => '832',
            'currency' => [
                'GBP',
            ],
        ],
        [
            'name' => 'Jordan',
            'alpha2' => 'JO',
            'alpha3' => 'JOR',
            'numeric' => '400',
            'currency' => [
                'JOD',
            ],
        ],
        [
            'name' => 'Kazakhstan',
            'alpha2' => 'KZ',
            'alpha3' => 'KAZ',
            'numeric' => '398',
            'currency' => [
                'KZT',
            ],
        ],
        [
            'name' => 'Kenya',
            'alpha2' => 'KE',
            'alpha3' => 'KEN',
            'numeric' => '404',
            'currency' => [
                'KES',
            ],
        ],
        [
            'name' => 'Kiribati',
            'alpha2' => 'KI',
            'alpha3' => 'KIR',
            'numeric' => '296',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Korea (Democratic People\'s Republic of)',
            'alpha2' => 'KP',
            'alpha3' => 'PRK',
            'numeric' => '408',
            'currency' => [
                'KPW',
            ],
        ],
        [
            'name' => 'Korea (Republic of)',
            'alpha2' => 'KR',
            'alpha3' => 'KOR',
            'numeric' => '410',
            'currency' => [
                'KRW',
            ],
        ],
        [
            'name' => 'Kuwait',
            'alpha2' => 'KW',
            'alpha3' => 'KWT',
            'numeric' => '414',
            'currency' => [
                'KWD',
            ],
        ],
        [
            'name' => 'Kyrgyzstan',
            'alpha2' => 'KG',
            'alpha3' => 'KGZ',
            'numeric' => '417',
            'currency' => [
                'KGS',
            ],
        ],
        [
            'name' => 'Lao People\'s Democratic Republic',
            'alpha2' => 'LA',
            'alpha3' => 'LAO',
            'numeric' => '418',
            'currency' => [
                'LAK',
            ],
        ],
        [
            'name' => 'Latvia',
            'alpha2' => 'LV',
            'alpha3' => 'LVA',
            'numeric' => '428',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Lebanon',
            'alpha2' => 'LB',
            'alpha3' => 'LBN',
            'numeric' => '422',
            'currency' => [
                'LBP',
            ],
        ],
        [
            'name' => 'Lesotho',
            'alpha2' => 'LS',
            'alpha3' => 'LSO',
            'numeric' => '426',
            'currency' => [
                'LSL',
                'ZAR',
            ],
        ],
        [
            'name' => 'Liberia',
            'alpha2' => 'LR',
            'alpha3' => 'LBR',
            'numeric' => '430',
            'currency' => [
                'LRD',
            ],
        ],
        [
            'name' => 'Libya',
            'alpha2' => 'LY',
            'alpha3' => 'LBY',
            'numeric' => '434',
            'currency' => [
                'LYD',
            ],
        ],
        [
            'name' => 'Liechtenstein',
            'alpha2' => 'LI',
            'alpha3' => 'LIE',
            'numeric' => '438',
            'currency' => [
                'CHF',
            ],
        ],
        [
            'name' => 'Lithuania',
            'alpha2' => 'LT',
            'alpha3' => 'LTU',
            'numeric' => '440',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Luxembourg',
            'alpha2' => 'LU',
            'alpha3' => 'LUX',
            'numeric' => '442',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Macao',
            'alpha2' => 'MO',
            'alpha3' => 'MAC',
            'numeric' => '446',
            'currency' => [
                'MOP',
            ],
        ],
        [
            'name' => 'North Macedonia',
            'alpha2' => 'MK',
            'alpha3' => 'MKD',
            'numeric' => '807',
            'currency' => [
                'MKD',
            ],
        ],
        [
            'name' => 'Madagascar',
            'alpha2' => 'MG',
            'alpha3' => 'MDG',
            'numeric' => '450',
            'currency' => [
                'MGA',
            ],
        ],
        [
            'name' => 'Malawi',
            'alpha2' => 'MW',
            'alpha3' => 'MWI',
            'numeric' => '454',
            'currency' => [
                'MWK',
            ],
        ],
        [
            'name' => 'Malaysia',
            'alpha2' => 'MY',
            'alpha3' => 'MYS',
            'numeric' => '458',
            'currency' => [
                'MYR',
            ],
        ],
        [
            'name' => 'Maldives',
            'alpha2' => 'MV',
            'alpha3' => 'MDV',
            'numeric' => '462',
            'currency' => [
                'MVR',
            ],
        ],
        [
            'name' => 'Mali',
            'alpha2' => 'ML',
            'alpha3' => 'MLI',
            'numeric' => '466',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Malta',
            'alpha2' => 'MT',
            'alpha3' => 'MLT',
            'numeric' => '470',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Marshall Islands',
            'alpha2' => 'MH',
            'alpha3' => 'MHL',
            'numeric' => '584',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Martinique',
            'alpha2' => 'MQ',
            'alpha3' => 'MTQ',
            'numeric' => '474',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Mauritania',
            'alpha2' => 'MR',
            'alpha3' => 'MRT',
            'numeric' => '478',
            'currency' => [
                'MRO',
            ],
        ],
        [
            'name' => 'Mauritius',
            'alpha2' => 'MU',
            'alpha3' => 'MUS',
            'numeric' => '480',
            'currency' => [
                'MUR',
            ],
        ],
        [
            'name' => 'Mayotte',
            'alpha2' => 'YT',
            'alpha3' => 'MYT',
            'numeric' => '175',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Mexico',
            'alpha2' => 'MX',
            'alpha3' => 'MEX',
            'numeric' => '484',
            'currency' => [
                'MXN',
            ],
        ],
        [
            'name' => 'Micronesia (Federated States of)',
            'alpha2' => 'FM',
            'alpha3' => 'FSM',
            'numeric' => '583',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Moldova (Republic of)',
            'alpha2' => 'MD',
            'alpha3' => 'MDA',
            'numeric' => '498',
            'currency' => [
                'MDL',
            ],
        ],
        [
            'name' => 'Monaco',
            'alpha2' => 'MC',
            'alpha3' => 'MCO',
            'numeric' => '492',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Mongolia',
            'alpha2' => 'MN',
            'alpha3' => 'MNG',
            'numeric' => '496',
            'currency' => [
                'MNT',
            ],
        ],
        [
            'name' => 'Montenegro',
            'alpha2' => 'ME',
            'alpha3' => 'MNE',
            'numeric' => '499',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Montserrat',
            'alpha2' => 'MS',
            'alpha3' => 'MSR',
            'numeric' => '500',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Morocco',
            'alpha2' => 'MA',
            'alpha3' => 'MAR',
            'numeric' => '504',
            'currency' => [
                'MAD',
            ],
        ],
        [
            'name' => 'Mozambique',
            'alpha2' => 'MZ',
            'alpha3' => 'MOZ',
            'numeric' => '508',
            'currency' => [
                'MZN',
            ],
        ],
        [
            'name' => 'Myanmar',
            'alpha2' => 'MM',
            'alpha3' => 'MMR',
            'numeric' => '104',
            'currency' => [
                'MMK',
            ],
        ],
        [
            'name' => 'Namibia',
            'alpha2' => 'NA',
            'alpha3' => 'NAM',
            'numeric' => '516',
            'currency' => [
                'NAD',
                'ZAR',
            ],
        ],
        [
            'name' => 'Nauru',
            'alpha2' => 'NR',
            'alpha3' => 'NRU',
            'numeric' => '520',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Nepal',
            'alpha2' => 'NP',
            'alpha3' => 'NPL',
            'numeric' => '524',
            'currency' => [
                'NPR',
            ],
        ],
        [
            'name' => 'Netherlands',
            'alpha2' => 'NL',
            'alpha3' => 'NLD',
            'numeric' => '528',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'New Caledonia',
            'alpha2' => 'NC',
            'alpha3' => 'NCL',
            'numeric' => '540',
            'currency' => [
                'XPF',
            ],
        ],
        [
            'name' => 'New Zealand',
            'alpha2' => 'NZ',
            'alpha3' => 'NZL',
            'numeric' => '554',
            'currency' => [
                'NZD',
            ],
        ],
        [
            'name' => 'Nicaragua',
            'alpha2' => 'NI',
            'alpha3' => 'NIC',
            'numeric' => '558',
            'currency' => [
                'NIO',
            ],
        ],
        [
            'name' => 'Niger',
            'alpha2' => 'NE',
            'alpha3' => 'NER',
            'numeric' => '562',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Nigeria',
            'alpha2' => 'NG',
            'alpha3' => 'NGA',
            'numeric' => '566',
            'currency' => [
                'NGN',
            ],
        ],
        [
            'name' => 'Niue',
            'alpha2' => 'NU',
            'alpha3' => 'NIU',
            'numeric' => '570',
            'currency' => [
                'NZD',
            ],
        ],
        [
            'name' => 'Norfolk Island',
            'alpha2' => 'NF',
            'alpha3' => 'NFK',
            'numeric' => '574',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Northern Mariana Islands',
            'alpha2' => 'MP',
            'alpha3' => 'MNP',
            'numeric' => '580',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Norway',
            'alpha2' => 'NO',
            'alpha3' => 'NOR',
            'numeric' => '578',
            'currency' => [
                'NOK',
            ],
        ],
        [
            'name' => 'Oman',
            'alpha2' => 'OM',
            'alpha3' => 'OMN',
            'numeric' => '512',
            'currency' => [
                'OMR',
            ],
        ],
        [
            'name' => 'Pakistan',
            'alpha2' => 'PK',
            'alpha3' => 'PAK',
            'numeric' => '586',
            'currency' => [
                'PKR',
            ],
        ],
        [
            'name' => 'Palau',
            'alpha2' => 'PW',
            'alpha3' => 'PLW',
            'numeric' => '585',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Palestine, State of',
            'alpha2' => 'PS',
            'alpha3' => 'PSE',
            'numeric' => '275',
            'currency' => [
                'ILS',
            ],
        ],
        [
            'name' => 'Panama',
            'alpha2' => 'PA',
            'alpha3' => 'PAN',
            'numeric' => '591',
            'currency' => [
                'PAB',
            ],
        ],
        [
            'name' => 'Papua New Guinea',
            'alpha2' => 'PG',
            'alpha3' => 'PNG',
            'numeric' => '598',
            'currency' => [
                'PGK',
            ],
        ],
        [
            'name' => 'Paraguay',
            'alpha2' => 'PY',
            'alpha3' => 'PRY',
            'numeric' => '600',
            'currency' => [
                'PYG',
            ],
        ],
        [
            'name' => 'Peru',
            'alpha2' => 'PE',
            'alpha3' => 'PER',
            'numeric' => '604',
            'currency' => [
                'PEN',
            ],
        ],
        [
            'name' => 'Philippines',
            'alpha2' => 'PH',
            'alpha3' => 'PHL',
            'numeric' => '608',
            'currency' => [
                'PHP',
            ],
        ],
        [
            'name' => 'Pitcairn',
            'alpha2' => 'PN',
            'alpha3' => 'PCN',
            'numeric' => '612',
            'currency' => [
                'NZD',
            ],
        ],
        [
            'name' => 'Poland',
            'alpha2' => 'PL',
            'alpha3' => 'POL',
            'numeric' => '616',
            'currency' => [
                'PLN',
            ],
        ],
        [
            'name' => 'Portugal',
            'alpha2' => 'PT',
            'alpha3' => 'PRT',
            'numeric' => '620',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Puerto Rico',
            'alpha2' => 'PR',
            'alpha3' => 'PRI',
            'numeric' => '630',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Qatar',
            'alpha2' => 'QA',
            'alpha3' => 'QAT',
            'numeric' => '634',
            'currency' => [
                'QAR',
            ],
        ],
        [
            'name' => 'Réunion',
            'alpha2' => 'RE',
            'alpha3' => 'REU',
            'numeric' => '638',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Romania',
            'alpha2' => 'RO',
            'alpha3' => 'ROU',
            'numeric' => '642',
            'currency' => [
                'RON',
            ],
        ],
        [
            'name' => 'Russian Federation',
            'alpha2' => 'RU',
            'alpha3' => 'RUS',
            'numeric' => '643',
            'currency' => [
                'RUB',
            ],
        ],
        [
            'name' => 'Rwanda',
            'alpha2' => 'RW',
            'alpha3' => 'RWA',
            'numeric' => '646',
            'currency' => [
                'RWF',
            ],
        ],
        [
            'name' => 'Saint Barthélemy',
            'alpha2' => 'BL',
            'alpha3' => 'BLM',
            'numeric' => '652',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Saint Helena, Ascension and Tristan da Cunha',
            'alpha2' => 'SH',
            'alpha3' => 'SHN',
            'numeric' => '654',
            'currency' => [
                'SHP',
            ],
        ],
        [
            'name' => 'Saint Kitts and Nevis',
            'alpha2' => 'KN',
            'alpha3' => 'KNA',
            'numeric' => '659',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Saint Lucia',
            'alpha2' => 'LC',
            'alpha3' => 'LCA',
            'numeric' => '662',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Saint Martin (French part)',
            'alpha2' => 'MF',
            'alpha3' => 'MAF',
            'numeric' => '663',
            'currency' => [
                'EUR',
                'USD',
            ],
        ],
        [
            'name' => 'Saint Pierre and Miquelon',
            'alpha2' => 'PM',
            'alpha3' => 'SPM',
            'numeric' => '666',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Saint Vincent and the Grenadines',
            'alpha2' => 'VC',
            'alpha3' => 'VCT',
            'numeric' => '670',
            'currency' => [
                'XCD',
            ],
        ],
        [
            'name' => 'Samoa',
            'alpha2' => 'WS',
            'alpha3' => 'WSM',
            'numeric' => '882',
            'currency' => [
                'WST',
            ],
        ],
        [
            'name' => 'San Marino',
            'alpha2' => 'SM',
            'alpha3' => 'SMR',
            'numeric' => '674',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Sao Tome and Principe',
            'alpha2' => 'ST',
            'alpha3' => 'STP',
            'numeric' => '678',
            'currency' => [
                'STD',
            ],
        ],
        [
            'name' => 'Saudi Arabia',
            'alpha2' => 'SA',
            'alpha3' => 'SAU',
            'numeric' => '682',
            'currency' => [
                'SAR',
            ],
        ],
        [
            'name' => 'Senegal',
            'alpha2' => 'SN',
            'alpha3' => 'SEN',
            'numeric' => '686',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Serbia',
            'alpha2' => 'RS',
            'alpha3' => 'SRB',
            'numeric' => '688',
            'currency' => [
                'RSD',
            ],
        ],
        [
            'name' => 'Seychelles',
            'alpha2' => 'SC',
            'alpha3' => 'SYC',
            'numeric' => '690',
            'currency' => [
                'SCR',
            ],
        ],
        [
            'name' => 'Sierra Leone',
            'alpha2' => 'SL',
            'alpha3' => 'SLE',
            'numeric' => '694',
            'currency' => [
                'SLL',
            ],
        ],
        [
            'name' => 'Singapore',
            'alpha2' => 'SG',
            'alpha3' => 'SGP',
            'numeric' => '702',
            'currency' => [
                'SGD',
            ],
        ],
        [
            'name' => 'Sint Maarten (Dutch part)',
            'alpha2' => 'SX',
            'alpha3' => 'SXM',
            'numeric' => '534',
            'currency' => [
                'ANG',
            ],
        ],
        [
            'name' => 'Slovakia',
            'alpha2' => 'SK',
            'alpha3' => 'SVK',
            'numeric' => '703',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Slovenia',
            'alpha2' => 'SI',
            'alpha3' => 'SVN',
            'numeric' => '705',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Solomon Islands',
            'alpha2' => 'SB',
            'alpha3' => 'SLB',
            'numeric' => '090',
            'currency' => [
                'SBD',
            ],
        ],
        [
            'name' => 'Somalia',
            'alpha2' => 'SO',
            'alpha3' => 'SOM',
            'numeric' => '706',
            'currency' => [
                'SOS',
            ],
        ],
        [
            'name' => 'South Africa',
            'alpha2' => 'ZA',
            'alpha3' => 'ZAF',
            'numeric' => '710',
            'currency' => [
                'ZAR',
            ],
        ],
        [
            'name' => 'South Georgia and the South Sandwich Islands',
            'alpha2' => 'GS',
            'alpha3' => 'SGS',
            'numeric' => '239',
            'currency' => [
                'GBP',
            ],
        ],
        [
            'name' => 'South Sudan',
            'alpha2' => 'SS',
            'alpha3' => 'SSD',
            'numeric' => '728',
            'currency' => [
                'SSP',
            ],
        ],
        [
            'name' => 'Spain',
            'alpha2' => 'ES',
            'alpha3' => 'ESP',
            'numeric' => '724',
            'currency' => [
                'EUR',
            ],
        ],
        [
            'name' => 'Sri Lanka',
            'alpha2' => 'LK',
            'alpha3' => 'LKA',
            'numeric' => '144',
            'currency' => [
                'LKR',
            ],
        ],
        [
            'name' => 'Sudan',
            'alpha2' => 'SD',
            'alpha3' => 'SDN',
            'numeric' => '729',
            'currency' => [
                'SDG',
            ],
        ],
        [
            'name' => 'Suriname',
            'alpha2' => 'SR',
            'alpha3' => 'SUR',
            'numeric' => '740',
            'currency' => [
                'SRD',
            ],
        ],
        [
            'name' => 'Svalbard and Jan Mayen',
            'alpha2' => 'SJ',
            'alpha3' => 'SJM',
            'numeric' => '744',
            'currency' => [
                'NOK',
            ],
        ],
        [
            'name' => 'Sweden',
            'alpha2' => 'SE',
            'alpha3' => 'SWE',
            'numeric' => '752',
            'currency' => [
                'SEK',
            ],
        ],
        [
            'name' => 'Switzerland',
            'alpha2' => 'CH',
            'alpha3' => 'CHE',
            'numeric' => '756',
            'currency' => [
                'CHF',
            ],
        ],
        [
            'name' => 'Syrian Arab Republic',
            'alpha2' => 'SY',
            'alpha3' => 'SYR',
            'numeric' => '760',
            'currency' => [
                'SYP',
            ],
        ],
        [
            'name' => 'Taiwan (Province of China)',
            'alpha2' => 'TW',
            'alpha3' => 'TWN',
            'numeric' => '158',
            'currency' => [
                'TWD',
            ],
        ],
        [
            'name' => 'Tajikistan',
            'alpha2' => 'TJ',
            'alpha3' => 'TJK',
            'numeric' => '762',
            'currency' => [
                'TJS',
            ],
        ],
        [
            'name' => 'Tanzania, United Republic of',
            'alpha2' => 'TZ',
            'alpha3' => 'TZA',
            'numeric' => '834',
            'currency' => [
                'TZS',
            ],
        ],
        [
            'name' => 'Thailand',
            'alpha2' => 'TH',
            'alpha3' => 'THA',
            'numeric' => '764',
            'currency' => [
                'THB',
            ],
        ],
        [
            'name' => 'Timor-Leste',
            'alpha2' => 'TL',
            'alpha3' => 'TLS',
            'numeric' => '626',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Togo',
            'alpha2' => 'TG',
            'alpha3' => 'TGO',
            'numeric' => '768',
            'currency' => [
                'XOF',
            ],
        ],
        [
            'name' => 'Tokelau',
            'alpha2' => 'TK',
            'alpha3' => 'TKL',
            'numeric' => '772',
            'currency' => [
                'NZD',
            ],
        ],
        [
            'name' => 'Tonga',
            'alpha2' => 'TO',
            'alpha3' => 'TON',
            'numeric' => '776',
            'currency' => [
                'TOP',
            ],
        ],
        [
            'name' => 'Trinidad and Tobago',
            'alpha2' => 'TT',
            'alpha3' => 'TTO',
            'numeric' => '780',
            'currency' => [
                'TTD',
            ],
        ],
        [
            'name' => 'Tunisia',
            'alpha2' => 'TN',
            'alpha3' => 'TUN',
            'numeric' => '788',
            'currency' => [
                'TND',
            ],
        ],
        [
            'name' => 'Turkey',
            'alpha2' => 'TR',
            'alpha3' => 'TUR',
            'numeric' => '792',
            'currency' => [
                'TRY',
            ],
        ],
        [
            'name' => 'Turkmenistan',
            'alpha2' => 'TM',
            'alpha3' => 'TKM',
            'numeric' => '795',
            'currency' => [
                'TMT',
            ],
        ],
        [
            'name' => 'Turks and Caicos Islands',
            'alpha2' => 'TC',
            'alpha3' => 'TCA',
            'numeric' => '796',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Tuvalu',
            'alpha2' => 'TV',
            'alpha3' => 'TUV',
            'numeric' => '798',
            'currency' => [
                'AUD',
            ],
        ],
        [
            'name' => 'Uganda',
            'alpha2' => 'UG',
            'alpha3' => 'UGA',
            'numeric' => '800',
            'currency' => [
                'UGX',
            ],
        ],
        [
            'name' => 'Ukraine',
            'alpha2' => 'UA',
            'alpha3' => 'UKR',
            'numeric' => '804',
            'currency' => [
                'UAH',
            ],
        ],
        [
            'name' => 'United Arab Emirates',
            'alpha2' => 'AE',
            'alpha3' => 'ARE',
            'numeric' => '784',
            'currency' => [
                'AED',
            ],
        ],
        [
            'name' => 'United Kingdom of Great Britain and Northern Ireland',
            'alpha2' => 'GB',
            'alpha3' => 'GBR',
            'numeric' => '826',
            'currency' => [
                'GBP',
            ],
        ],
        [
            'name' => 'United States of America',
            'alpha2' => 'US',
            'alpha3' => 'USA',
            'numeric' => '840',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'United States Minor Outlying Islands',
            'alpha2' => 'UM',
            'alpha3' => 'UMI',
            'numeric' => '581',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Uruguay',
            'alpha2' => 'UY',
            'alpha3' => 'URY',
            'numeric' => '858',
            'currency' => [
                'UYU',
            ],
        ],
        [
            'name' => 'Uzbekistan',
            'alpha2' => 'UZ',
            'alpha3' => 'UZB',
            'numeric' => '860',
            'currency' => [
                'UZS',
            ],
        ],
        [
            'name' => 'Vanuatu',
            'alpha2' => 'VU',
            'alpha3' => 'VUT',
            'numeric' => '548',
            'currency' => [
                'VUV',
            ],
        ],
        [
            'name' => 'Venezuela (Bolivarian Republic of)',
            'alpha2' => 'VE',
            'alpha3' => 'VEN',
            'numeric' => '862',
            'currency' => [
                'VEF',
            ],
        ],
        [
            'name' => 'Viet Nam',
            'alpha2' => 'VN',
            'alpha3' => 'VNM',
            'numeric' => '704',
            'currency' => [
                'VND',
            ],
        ],
        [
            'name' => 'Virgin Islands (British)',
            'alpha2' => 'VG',
            'alpha3' => 'VGB',
            'numeric' => '092',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Virgin Islands (U.S.)',
            'alpha2' => 'VI',
            'alpha3' => 'VIR',
            'numeric' => '850',
            'currency' => [
                'USD',
            ],
        ],
        [
            'name' => 'Wallis and Futuna',
            'alpha2' => 'WF',
            'alpha3' => 'WLF',
            'numeric' => '876',
            'currency' => [
                'XPF',
            ],
        ],
        [
            'name' => 'Western Sahara',
            'alpha2' => 'EH',
            'alpha3' => 'ESH',
            'numeric' => '732',
            'currency' => [
                'MAD',
            ],
        ],
        [
            'name' => 'Yemen',
            'alpha2' => 'YE',
            'alpha3' => 'YEM',
            'numeric' => '887',
            'currency' => [
                'YER',
            ],
        ],
        [
            'name' => 'Zambia',
            'alpha2' => 'ZM',
            'alpha3' => 'ZMB',
            'numeric' => '894',
            'currency' => [
                'ZMW',
            ],
        ],
        [
            'name' => 'Zimbabwe',
            'alpha2' => 'ZW',
            'alpha3' => 'ZWE',
            'numeric' => '716',
            'currency' => [
                'BWP',
                'EUR',
                'GBP',
                'USD',
                'ZAR',
            ],
        ],
    ];

    foreach ($countriesISO3166 as $country) {
        if($country["alpha2"] == $alpha2) {
            return $country;
        }
    }

}

  public static $cache_time = [
    'cache_cities' => 86400,
    'cache_countries' => 86400,    
    'BaseInfo' => 1800,
    'languages_chain' => 1800,
    'hotel_search_property' => 1800,
    'default_curr_lang_chain' => 1800,
    'hotel_languages' => 1800,
    'currencies_chain' => 1800,
    'hotel_search_property' => 1800,
    'hotel_search_chain' => 1800,
    'available_packages_4' => 1800,
    'rateplans_array' => 1800,
    'hotel_folders' => 1800,
    'style' => 1800,
    'child_terms' => 1800,
    'available_incentives_4' => 1800,
    'descriptive_infos' => 900,
    'hotel_descriptive_info' => 900,
    'hotel_currencies' => 43200,
    'available_packages_property' => 300
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




  public static function getPropertyStyle($hotel_code, $currency = 34, $language = 1)
  {

    $data =
      '
        {
          "PropertyUID": ' . $hotel_code . ',
          "SelectedCurrencyUID": ' . $currency . ',
          "IsForMobile": false,
          "LanguageUID": '. $language .'
        }
        ';


    $base = self::post("GetPropertyBEStyleDetails", $data);

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

  public static function getAvailablePackages($hotels, $currency = null, $language = 1)
  {

    $language = json_encode($language);

		$HotelCodes = '';
		$counter = 1;

		foreach ($hotels as $key => $hotel) {
			if($counter == count($hotels)) {
				$HotelCodes .= 
				'
				{
				"HotelCode": '. $key .'
				}
				';
			}
			else {
				$HotelCodes .= 
				'
				{
				"HotelCode": '. $key .'
				},
				';
			}
			$counter++;
		}    

    $data =
      '
	    {
	        "EchoToken": "'.self::createGUID().'",
	        "TimeStamp": "'.gmdate(DATE_W3C).'",
	        "Target": 1,
	        "Version": 3.0,
	        "PrimaryLangID": '. $language .',
	        "HotelSearchCriteria": {
	          "AvailableOnlyIndicator": true,
	          "Criterion": {
	            "HotelRefs": ['.$HotelCodes.'],
	            "StayDateRange": {
	              "Start": "'.gmdate(DATE_W3C).'",
	              "End": "'.gmdate(DATE_W3C, strtotime('+6 months')).'"
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
	                        "ResGuestRPH": [0]
	                      }
	                    ]
	                  },
	                  "Quantity": 1,
	                  "RPH": 0
	                }
	              ]
	            },
	            "TPA_Extensions": {
	              "MultimediaObjects": {
	                "SendData": true
	              }
	            }
	          }
	        },
	        "AvailRatesOnly": true,
	        "BestOnly": false,
	        "OnRequestInd": true,
	        "IsModify": true,
	        "RequestedCurrency": '.$currency.'
	    }
    ';

    $base = self::post("GetAvailablePackages", $data);

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

  public static function getHotelDescriptiveInfo($hotel_id, $language = 1) {
    $language = json_encode($language);

    $data =
		'
		{
		  "EchoToken": "'.self::createGUID().'",
		  "TimeStamp": "'.gmdate(DATE_W3C).'",
		  "Target": 1,
		  "Version": 3.0,
		  "PrimaryLangID": '. $language .',
		  "HotelDescriptiveInfosType": {
		    "LangRequested": '. $language .',
		    "HotelDescriptiveInfos": [
		      {
		        "HotelRef": {
		          "HotelCode": ' . $hotel_id . '
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

    $countries = $base->data->Result;
    $countriesChanged = [];

    foreach($countries as $key=>$country) {
      $countriesChanged[$country->UID] = $countries[$key];
    }

    return $countriesChanged;
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

  public static function getHotelDataMultipleRooms($date_from, $date_to, $hotel_code, $availrates = "true", $occupancies, $currency = 1, $language = 1, $promocode = null, $groupcode = null, $mobile = "false") {
    $language = json_encode($language);

    $adults = '';
		$children = '';
		$ResGuest = 0;
		$id = 0;

    $RPH = 0;
		$RoomStayCandidates = '';

		foreach ($occupancies as $occupancy) {

			$GuestCounts = '';
			$ResGuestRPH = '[';

			for ($i=0; $i < $occupancy["adults"]; $i++) {
				$ResGuestRPH .= $id;
				if ($occupancy["adults"] - $i > 1) {
					$ResGuestRPH .= ',';
				}
				$id++;
			}

			$ResGuestRPH .= ']';

			$adults = 
			'{
              "Age": "",
              "AgeQualifyCode": 10,
              "Count": '. $occupancy["adults"] .',
              "ResGuestRPH": '. $ResGuestRPH .'
            }';

            $GuestCounts .= $adults;

            if($occupancy["children"] > 0) {
            	for ($i=0; $i < count($occupancy["ages"]) ; $i++) { 
            		$children = 
            		'
            		{
	                  "Age": "'.$occupancy["ages"][$i].'",
	                  "AgeQualifyCode": 8,
	                  "Count": 1,
	                  "ResGuestRPH": ['.$id.']
	                }
            		';
            		$id++;
            		$GuestCounts .= ',';
            		$GuestCounts .= $children;
            	}
            }

            $RoomStayCandidates .= 
            '
            {
	            "GuestCountsType": {
	              	"GuestCounts": ['.$GuestCounts.']
	            },
	            "Quantity": 1,
	            "RPH": '.$occupancy["rph"].'
          	}
            ';

            if (count($occupancies) - $occupancy["rph"] > 0) {
            	$RoomStayCandidates .= ',';
            }
		}


		if($promocode != "") {
			$PromotionCode = '"PromotionCode": "'.$promocode.'"';
		}

		if($groupcode != "") {
			$GroupCode = '"GroupCode": "'.$groupcode.'"';
		}

		if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
			$country_array = self::countriesISO3166($_SERVER["HTTP_CF_IPCOUNTRY"]);


			$POS = 
			'
	        "POS": {
	          "Sources": [
	            {
	              "ISOCountry": "'.$country_array["alpha3"].'"
	            }
	          ]
	        },
			';
		}
		else {
			$POS = '';
		}

    $data =
		'
		{
		  "MaxResponses": 100,
		  "RequestedCurrency": '.$currency.',
		  "PageNumber": 10,
		  "EchoToken": "'.self::createGUID().'",
		  "TimeStamp": "'.gmdate(DATE_W3C).'",
		  "Target": 1,
		  "Version": 3.0,
		  "PrimaryLangID": '. $language .',
		  "AvailRatesOnly": ' . $availrates . ',
		  "BestOnly": false,
		  '.$POS.'
		  "HotelSearchCriteria": {
		    "Criterion": {
		      "GetPricesPerGuest": true,
		      "TPA_Extensions": {
		      	"IsForMobile": '.$mobile.'
		      },
		      "HotelRefs": [
		        {
		          "HotelCode": ' . $hotel_code . '
		        }
		      ],
		      "StayDateRange": {
		        "Start": "'. date("Y-m-d\TH:i:sP", strtotime($date_from)) .'",
		        "End": "'. date("Y-m-d\TH:i:sP", strtotime($date_to)) .'"
		      },
		      "RoomStayCandidatesType": {
		        "RoomStayCandidates": ['.$RoomStayCandidates.']
		      },
		      "RatePlanCandidatesType": {
				"RatePlanCandidates": [
				{
					'.(isset($PromotionCode) ? $PromotionCode : null).'
					'.(isset($GroupCode) ? $GroupCode : null).'
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
  
  public static function listTripAdvisorConfiguration($property, $language) {
    $data =
		'
		{
		  "PropertyUIDs": ['.$property.'],
		  "LanguageUID": '.$language.'
		}
		';

    $base = self::post("ListTripAdvisorConfiguration", $data);

    return $base->data;
  }




  public static function childrenAllowed ($property, $currency , $language = 1) {

        $data_allowed =
          '
            {
              "PropertyUID": ' . $property . ',
              "SelectedCurrencyUID": ' . $currency . ',
              "IsForMobile": false,
              "LanguageUID": '. $language .'
            }
            ';


        $base = self::post("GetPropertyBEStyleDetails", $data_allowed);

        $allowed = $base->data->Result->AllowChildren;

        $data_max =
            '
            {
                "PropertyUID": ' . $property . '
            }
            ';

        $base_max = self::post("GetChildTerms", $data_max);

        $childrenTerms = $base_max->data->Result;

        if ($childrenTerms != null) {

        $childrenMaxAge = 0;

        //SEARCH FOR CHILDREN LIMIT WITH CODE 1 WHICH MEANS CHILDREN
        foreach($childrenTerms as $childrenTerm) {
            if($childrenTerm->ChargeAs == 1 && $childrenTerm->MaxAge > $childrenMaxAge) {
                $childrenMaxAge = $childrenTerm->MaxAge;
            }
        }

        //IF DON'T EXIST CHILDREN LIMITS WITH CODE 1 THEN SEARCH FOR CHILDREN WITH CODE 3 WHCIH MEANS FREE CHILDREN
        if($childrenMaxAge == 0) {
            foreach($childrenTerms as $childrenTerm) {
                if($childrenTerm->ChargeAs == 3 && $childrenTerm->MaxAge > $childrenMaxAge) {
                    $childrenMaxAge = $childrenTerm->MaxAge;
                } 
            }
        }

        //IF DON'T EXIST ANY INFORMATION ABOUT CHILDREN THAN LIMIT TO THE 17 YEARS
        if($childrenMaxAge == 0) {
            $childrenMaxAge = 17;
        }     


        }  else {
            $childrenMaxAge = 17;
        }


        return array ($allowed,$childrenMaxAge );


    }




  public static function getBEMandatoryFields($property, $language) {
    $data =
    '
    {
      "PropertyUID": '.$property.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetBEMandatoryFields", $data);

    return $base->data;
  }

  public static function getPaymentMethodTypesByRates($rate_plans, $hotel_code, $language) {

    $RateUIDs = '[';
    $counter = 1;
    foreach ($rate_plans as $rate_plan) {
      $RateUIDs.= $rate_plan;

      if ($counter != count($rate_plans)) {
        $RateUIDs.= ',';
      }

      $counter++;
    }
    $RateUIDs .= ']';

    $data = 
    '
    {
      "RateUIDs": '.$RateUIDs.',
      "PropertyUID": '.$hotel_code.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetBEPaymentMethodTypesByRates", $data);

    return $base->data;
  }

  public static function getPaymentMethodTypes($hotel_code, $language) {

    $data = 
    '
    {
      "PropertyUID": '.$hotel_code.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetBEPaymentMethodTypes", $data);

    return $base->data;
  }

  public static function getBEPaymentMethodTypesByTPI($tpi, $property, $language){

    $data = '{
      "TPIUID": '.$tpi.',
      "PropertyUID": '.$property.',
      "LanguageUID": '.$language.'
    }';

    $base = self::post("GetBEPaymentMethodTypesByTPI", $data);

    return $base->data;  
  }

  public static function getPaymentGatewayByProperty($hotel_code, $language) {

    $data = 
    '
    {
      "PropertyUID": '.$hotel_code.',
      "ReturnTotal": true,
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetPaymentGatewayByProperty", $data); 

    return $base->data;
  }

  public static function getPaymentMethods($hotel_code, $language) {

    $data = 
    '
    {
      "PropertyUID": '.$hotel_code.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetBEPaymentMethods", $data);

    return $base->data;
  }

  public static function getPartialPayments($property, $currency, $language = 1) {

    $data = '
    {
    "PropertyUID": '.$property.',
    "SelectedCurrencyUID": '.$currency.',
    "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetBEPartialPayments", $data);

    return $base->data;
  }

  public static function getBankDepositConditions($property, $language = 1) {

    $data = '
    {
      "PropertyUID": '.$property.',
      "LanguageUID": '.$language.'    
    }
    ';

    $base = self::post("GetBankDepositConditions", $data);

    return $base->data; 
  }

  public static function getPropertyTermsAndConditions($property, $language) {


    $data =
    '
    {
      "PropertyUID": '.$property.',
      "ReturnTotal": true,
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetPropertyTermsAndConditions", $data);

    return $base->data;   
  }

  public static function getPaymentGatewayClientProvider($property, $language) {


    $data =
    '
    {
      "PropertyUID": '.$property.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetPaymentGatewayClientProvider", $data);

    return $base->data;   
  }

  public static function getBEAvailableModules($property, $language) {

    $data = '
    {
      "PropertyUID": '.$property.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("GetBEAvailableModules", $data);

    return $base->data;
  }

    public static function getGuestInfo($chain, $email, $language) {

        $data = 
        '
        {
          "Email": "'. $email .'",
          "Client_UID": '.$chain.',
          "LanguageUID": '. $language .',
          "Version": 5.0
        }
        ';

        $base = self::post("GetGuestInfo", $data);

        return $base->data;
    }


  public static function getStateInfo($country_UID, $language) {
    
    $data =
    '
    {
      "Country_UID": '.$country_UID.',
      "LanguageUID": '.$language.'
    }
    ';

    $base = self::post("ListStates", $data);

    return $base->data;

  }

}
