<?php

namespace app\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use app\models\User;

 
class CommonFunction extends Component
{
    /**
    * for getting time deffernce between current time and passed time
    * @param int $old
    * @return difference between $old and current time
    */
    public static function timedifference($old=0)
    {
		$current = time();
		$difference = $current - $old;
		$years = abs(floor($difference / 31536000));
		$days = abs(floor(($difference-($years * 31536000))/86400));
		$hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
		$mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
		$timeString = "";
		if($days > 0)
		{
			$timeString = $days > 1 ? $days . " days " : $days . " day ";
		}
		elseif($hours > 0)
		{
			$timeString = $hours > 1 ? $hours . " hours " : $hours . " hour ";
		}
		elseif($mins > 0)
		{
			$timeString = $mins > 1 ? $mins . " mins " : $mins . " min ";
		}else{
			$timeString = "1 min ";
		}
		return $timeString;
    }
    // login with social
    public function facebookappid()
    {
        return "1224479397578937";
    }

    public  function facebookappsecret()
    {
        return "1d591c627f1ef34fecf6b63cc5847f6f";
    }

    public  function gmailclientid()
    {
        //return "852202690281-hq93j023b2pp30vqpr6qkbukgqp702vu.apps.googleusercontent.com";
		return "437816057011-5loi0iuo7qo6gfch431bh35gaamo2iuc.apps.googleusercontent.com";
    }

    public  function gmailredirecturi()
    {
         return "http://peerdevelopment.com/apps/acenest/site/agent/contact";
        //return "http://192.168.1.100/apps/helpy/";
    }

    public  function gmailsecret()
    {
        //return "uyL-PVb97g1dALaYKdu1ZLI6";
		return "u-V3pxnBl_gIWgel8laLqYG8";
    }
    
	/**
    * for display pagination dropdown on index page
    * @return array
    */
	public function paginationarray()
    {
        $pagination=['1'=>'1','5'=>'5','10'=>'10','20'=>'20','30'=>'30','50'=>'50','100'=>'100','-1'=>'All'];
        return $pagination;
    }
	/**
    * function to check user is deleted or not before calling any api
    * @param $id
    * @return status
    */
	public function checkuser($id = null)
    {
        if(isset($_POST['userid']) && $_POST['userid'] != '')
        {
            $data = Users::find()->where(['user_type'=>'U','is_deleted'=>'N','id'=>$_POST['userid']])->one();
            if($data != array())
            {
                return 'Y';    
            }
            else
            {
                return 'N';
            }
        }else{
            return 'Y';
        }
    }
    /**
    * function to check user is deleted or not before calling any api
    * @param float $lat1
    * @param float $lat1 [latitude1]
    * @param float $lon1 [longitude1]
    * @param float $lat2 [latitude2]
    * @param float $lon2 [longitude2]
    * @param float $unit [K = 'Kilometere' , 'M' = Miles]
    * @return distance as per unit
    */
	public function distance($lat1=0, $lon1=0, $lat2=0, $lon2=0, $unit="M")
    {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$miles = $dist * 3959; //convert distance into miles
		$unit = strtoupper($unit);
		if ($unit == "K") {
			return ($dist * 6371); //convert distance into kilometers
		} else {
			return $miles;
		}
    }
	public function country()
    {
			$country_array = array(
			"Afghanistan"=>"Afghanistan",
			"Aland Islands"=>"Aland Islands",
			"Albania"=>"Albania",
			"Algeria"=>"Algeria",
			"American Samoa"=>"American Samoa",
			"Andorra"=>"Andorra",
			"Angola"=>"Angola",
			"Anguilla"=>"Anguilla",
			"Antarctica"=>"Antarctica",
			"Antigua and Barbuda"=>"Antigua and Barbuda",
			"Argentina"=>"Argentina",
			"Armenia"=>"Armenia",
			"Aruba"=>"Aruba",
			"Australia"=>"Australia",
			"Austria"=>"Austria",
			"Azerbaijan"=>"Azerbaijan",
			"Bahamas the"=>"Bahamas the",
			"Bahrain"=>"Bahrain",
			"Bangladesh"=>"Bangladesh",
			"Barbados"=>"Barbados",
			"Belarus"=>"Belarus",
			"Belgium"=>"Belgium",
			"Belize"=>"Belize",
			"Benin"=>"Benin",
			"Bermuda"=>"Bermuda",
			"Bhutan"=>"Bhutan",
			"Bolivia"=>"Bolivia",
			"Bosnia and Herzegovina"=>"Bosnia and Herzegovina",
			"Botswana"=>"Botswana",
			"Bouvet Island (Bouvetoya)"=>"Bouvet Island (Bouvetoya)",
			"Brazil"=>"Brazil",
			"British Indian Ocean Territory (Chagos Archipelago)"=>"British Indian Ocean Territory (Chagos Archipelago)",
			"British Virgin Islands"=>"British Virgin Islands",
			"Brunei Darussalam"=>"Brunei Darussalam",
			"Bulgaria"=>"Bulgaria",
			"Burkina Faso"=>"Burkina Faso",
			"Burundi"=>"Burundi",
			"Cambodia"=>"Cambodia",
			"Cameroon"=>"Cameroon",
			"Canada"=>"Canada",
			"Cape Verde"=>"Cape Verde",
			"Cayman Islands"=>"Cayman Islands",
			"Central African Republic"=>"Central African Republic",
			"Chad"=>"Chad",
			"Chile"=>"Chile",
			"China"=>"China",
			"Christmas Island"=>"Christmas Island",
			"Cocos (Keeling) Islands"=>"Cocos (Keeling) Islands",
			"Colombia"=>"Colombia",
			"Comoros the"=>"Comoros the",
			"Congo"=>"Congo",
			"Congo the"=>"Congo the",
			"Cook Islands"=>"Cook Islands",
			"Costa Rica"=>"Costa Rica",
			"Cote d'Ivoire"=>"Cote d'Ivoire",
			"Croatia"=>"Croatia",
			"Cuba"=>"Cuba",
			"Cyprus"=>"Cyprus",
			"Czech Republic"=>"Czech Republic",
			"Denmark"=>"Denmark",
			"Djibouti"=>"Djibouti",
			"Dominica"=>"Dominica",
			"Dominican Republic"=>"Dominican Republic",
			"Ecuador"=>"Ecuador",
			"Egypt"=>"Egypt",
			"El Salvador"=>"El Salvador",
			"Equatorial Guinea"=>"Equatorial Guinea",
			"Eritrea"=>"Eritrea",
			"Estonia"=>"Estonia",
			"Ethiopia"=>"Ethiopia",
			"Faroe Islands"=>"Faroe Islands",
			"Falkland Islands (Malvinas)"=>"Falkland Islands (Malvinas)",
			"Fiji the Fiji Islands"=>"Fiji the Fiji Islands",
			"Finland"=>"Finland",
			"France, French Republic"=>"France, French Republic",
			"French Guiana"=>"French Guiana",
			"French Polynesia"=>"French Polynesia",
			"French Southern Territories"=>"French Southern Territories",
			"Gabon"=>"Gabon",
			"Gambia the"=>"Gambia the",
			"Georgia"=>"Georgia",
			"Germany"=>"Germany",
			"Ghana"=>"Ghana",
			"Gibraltar"=>"Gibraltar",
			"Greece"=>"Greece",
			"Greenland"=>"Greenland",
			"Grenada"=>"Grenada",
			"Guadeloupe"=>"Guadeloupe",
			"Guam"=>"Guam",
			"Guatemala"=>"Guatemala",
			"Guernsey"=>"Guernsey",
			"Guinea"=>"Guinea",
			"Guinea-Bissau"=>"Guinea-Bissau",
			"Guyana"=>"Guyana",
			"Haiti"=>"Haiti",
			"Heard Island and McDonald Islands"=>"Heard Island and McDonald Islands",
			"Holy See (Vatican City State)"=>"Holy See (Vatican City State)",
			"Honduras"=>"Honduras",
			"Hong Kong"=>"Hong Kong",
			"Hungary"=>"Hungary",
			"Iceland"=>"Iceland",
			"India"=>"India",
			"Indonesia"=>"Indonesia",
			"Iran"=>"Iran",
			"Iraq"=>"Iraq",
			"Ireland"=>"Ireland",
			"Isle of Man"=>"Isle of Man",
			"Israel"=>"Israel",
			"Italy"=>"Italy",
			"Jamaica"=>"Jamaica",
			"Japan"=>"Japan",
			"Jersey"=>"Jersey",
			"Jordan"=>"Jordan",
			"Kazakhstan"=>"Kazakhstan",
			"Kenya"=>"Kenya",
			"Kiribati"=>"Kiribati",
			"North Korea"=>"North Korea",
			"South Korea"=>"South Korea",
			"Kuwait"=>"Kuwait",
			"Kyrgyz Republic"=>"Kyrgyz Republic",
			"Lao"=>"Lao",
			"Latvia"=>"Latvia",
			"Lebanon"=>"Lebanon",
			"Lesotho"=>"Lesotho",
			"Liberia"=>"Liberia",
			"Libyan Arab Jamahiriya"=>"Libyan Arab Jamahiriya",
			"Liechtenstein"=>"Liechtenstein",
			"Lithuania"=>"Lithuania",
			"Luxembourg"=>"Luxembourg",
			"Macao"=>"Macao",
			"Macedonia"=>"Macedonia",
			"Madagascar"=>"Madagascar",
			"Malawi"=>"Malawi",
			"Malaysia"=>"Malaysia",
			"Maldives"=>"Maldives",
			"Mali"=>"Mali",
			"Malta"=>"Malta",
			"Marshall Islands"=>"Marshall Islands",
			"Martinique"=>"Martinique",
			"Mauritania"=>"Mauritania",
			"Mauritius"=>"Mauritius",
			"Mayotte"=>"Mayotte",
			"Mexico"=>"Mexico",
			"Micronesia"=>"Micronesia",
			"Moldova"=>"Moldova",
			"Monaco"=>"Monaco",
			"Mongolia"=>"Mongolia",
			"Montenegro"=>"Montenegro",
			"Montserrat"=>"Montserrat",
			"Morocco"=>"Morocco",
			"Mozambique"=>"Mozambique",
			"Myanmar"=>"Myanmar",
			"Namibia"=>"Namibia",
			"Nauru"=>"Nauru",
			"Nepal"=>"Nepal",
			"Netherlands Antilles"=>"Netherlands Antilles",
			"Netherlands the"=>"Netherlands the",
			"New Caledonia"=>"New Caledonia",
			"New Zealand"=>"New Zealand",
			"Nicaragua"=>"Nicaragua",
			"Niger"=>"Niger",
			"Nigeria"=>"Nigeria",
			"Niue"=>"Niue",
			"Norfolk Island"=>"Norfolk Island",
			"Northern Mariana Islands"=>"Northern Mariana Islands",
			"Norway"=>"Norway",
			"Oman"=>"Oman",
			"Pakistan"=>"Pakistan",
			"Palau"=>"Palau",
			"Palestinian Territory"=>"Palestinian Territory",
			"Panama"=>"Panama",
			"Papua New Guinea"=>"Papua New Guinea",
			"Paraguay"=>"Paraguay",
			"Peru"=>"Peru",
			"Philippines"=>"Philippines",
			"Pitcairn Islands"=>"Pitcairn Islands",
			"Poland"=>"Poland",
			"Portugal, Portuguese Republic"=>"Portugal, Portuguese Republic",
			"Puerto Rico"=>"Puerto Rico",
			"Qatar"=>"Qatar",
			"Reunion"=>"Reunion",
			"Romania"=>"Romania",
			"Russian Federation"=>"Russian Federation",
			"Rwanda"=>"Rwanda",
			"Saint Barthelemy"=>"Saint Barthelemy",
			"Saint Helena"=>"Saint Helena",
			"Saint Kitts and Nevis"=>"Saint Kitts and Nevis",
			"Saint Lucia"=>"Saint Lucia",
			"Saint Martin"=>"Saint Martin",
			"Saint Pierre and Miquelon"=>"Saint Pierre and Miquelon",
			"Saint Vincent and the Grenadines"=>"Saint Vincent and the Grenadines",
			"Samoa"=>"Samoa",
			"San Marino"=>"San Marino",
			"Sao Tome and Principe"=>"Sao Tome and Principe",
			"Saudi Arabia"=>"Saudi Arabia",
			"Senegal"=>"Senegal",
			"Serbia"=>"Serbia",
			"Seychelles"=>"Seychelles",
			"Sierra Leone"=>"Sierra Leone",
			"Singapore"=>"Singapore",
			"Slovakia (Slovak Republic)"=>"Slovakia (Slovak Republic)",
			"Slovenia"=>"Slovenia",
			"Solomon Islands"=>"Solomon Islands",
			"Somalia, Somali Republic"=>"Somalia, Somali Republic",
			"South Africa"=>"South Africa",
			"South Georgia and the South Sandwich Islands"=>"South Georgia and the South Sandwich Islands",
			"Spain"=>"Spain",
			"Sri Lanka"=>"Sri Lanka",
			"Sudan"=>"Sudan",
			"Suriname"=>"Suriname",
			"Svalbard & Jan Mayen Islands"=>"Svalbard & Jan Mayen Islands",
			"Swaziland"=>"Swaziland",
			"Sweden"=>"Sweden",
			"Switzerland, Swiss Confederation"=>"Switzerland, Swiss Confederation",
			"Syrian Arab Republic"=>"Syrian Arab Republic",
			"Taiwan"=>"Taiwan",
			"Tajikistan"=>"Tajikistan",
			"Tanzania"=>"Tanzania",
			"Thailand"=>"Thailand",
			"Timor-Leste"=>"Timor-Leste",
			"Togo"=>"Togo",
			"Tokelau"=>"Tokelau",
			"Tonga"=>"Tonga",
			"Trinidad and Tobago"=>"Trinidad and Tobago",
			"Tunisia"=>"Tunisia",
			"Turkey"=>"Turkey",
			"Turkmenistan"=>"Turkmenistan",
			"Turks and Caicos Islands"=>"Turks and Caicos Islands",
			"Tuvalu"=>"Tuvalu",
			"Uganda"=>"Uganda",
			"Ukraine"=>"Ukraine",
			"United Arab Emirates"=>"United Arab Emirates",
			"United Kingdom"=>"United Kingdom",
			"United States of America"=>"United States of America",
			"United States Minor Outlying Islands"=>"United States Minor Outlying Islands",
			"United States Virgin Islands"=>"United States Virgin Islands",
			"Uruguay, Eastern Republic of"=>"Uruguay, Eastern Republic of",
			"Uzbekistan"=>"Uzbekistan",
			"Vanuatu"=>"Vanuatu",
			"Venezuela"=>"Venezuela",
			"Vietnam"=>"Vietnam",
			"Wallis and Futuna"=>"Wallis and Futuna",
			"Western Sahara"=>"Western Sahara",
			"Yemen"=>"Yemen",
			"Zambia"=>"Zambia",
			"Zimbabwe"=>"Zimbabwe",
		);
		return $country_array;
	}

    
}
?>