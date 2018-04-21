<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\helpers;
use app\models\Setting;
use app\models\ClientSource;

use app\models\TechnologyMaster;
use app\models\ProjectType;
use app\models\StatusMaster;
use app\models\PaymentSource;
use app\models\LeadPriority;
use yii\helpers\ArrayHelper;

/**
 * Html provides a set of static methods for generating commonly used HTML tags.
 *
 * Nearly all of the methods in this class allow setting additional html attributes for the html
 * tags they generate. You can specify for example. 'class', 'style'  or 'id' for an html element
 * using the `$options` parameter. See the documentation of the [[tag()]] method for more details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Common extends BaseHtml
{
    public static function format_something()
    {
        $abc = array('1'=>"Admin",'2'=>"Sales Manager");
        return ($abc);
    }
    public static function countryArr()
    {
	$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
	return ($countries);
    }
    public static function clientsource()
    {
	//$arr = array(1=>"Elance",2=>"Peerbits",3=>'Client Reference',4=>'Social',5=>'Other');
	$source = ClientSource::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($source,'id','name');
	
	
	return ($arr);
    }
    public static function sourceArr()
    {
	//$arr = array(1=>"Elance",2=>"Peerbits",3=>'Client Reference',4=>'Social',5=>'Other');
	//$arr = array();
	//$setting = Setting::find()->where(['key'=>'source'])->one();
	//if($setting){
	//    $exploded = explode(',', $setting->value);
	//    $arr = array_combine(range(1, count($exploded)), $exploded);
	//}
	
	$source = ClientSource::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($source,'id','name');
	
	return ($arr);
    }
    public static function technologyArr()
    {
	//$arr = array(1=>"Web",2=>"iOS",3=>'Android',4=>'Analysis / QA',5=>'Design');
	//$arr = array();
	//$setting = Setting::find()->where(['key'=>'technology'])->one();
	//if($setting){
	//    $exploded = explode(',', $setting->value);
	//    $arr = array_combine(range(1, count($exploded)), $exploded);
	//}
	//return ($arr);
	
	$tech = TechnologyMaster::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($tech,'id','name');
	
	return ($arr);
	
    }
    public static function technologyimage()
    {
	$arr = array(1=>"web.png",2=>"apple.png",3=>'android.png',4=>'qa.png',5=>'design.png');
	return ($arr);
    }
    public static function projecttype()
    {
	//$arr = array(1=>"Fixed",2=>"Hourly",3=>'Dedicated');
	//return ($arr);
	$type = ProjectType::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($type,'id','name');
	
	return ($arr);
	
    }
    public static function projectstatus()
    {
	//$arr = array(1=>"Pending",2=>"Ongoing",3=>'Completed',4=>'Hold',5=>'Cancelled');
	
	//$arr = array();
	//$setting = Setting::find()->where(['key'=>'projectstatus'])->one();
	//if($setting){
	//    $exploded = explode(',', $setting->value);
	//    $arr = array_combine(range(1, count($exploded)), $exploded);
	//}
	//
	//return ($arr);
	$status = StatusMaster::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($status,'id','name');
	
	return ($arr);
	
	
    }
    public static function paysourceArr()
    {
	//$arr = array(1=>"Elance",2=>"Paypal",3=>'Bank',4=>'Cash',5=>'Other');
	//return ($arr);
	$source = PaymentSource::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($source,'id','name');
	
	return ($arr);
	
    }
    public static function priority()
    {
	//$arr = array(1=>"High",2=>"Medium",3=>'Low');
	//return ($arr);
	
	$p = LeadPriority::find()->where(['is_active'=>'Y','is_deleted'=>'N'])->all();
	$arr = ArrayHelper::map($p,'id','name');
	
	return ($arr);
	
	
    }
    public static function timeDiff1($old = 0)
    {
	$current = time();
	//$old = 1363164299;
	$difference = $current - $old;
	$years = abs(floor($difference / 31536000));
	$months = abs(floor(($difference / 31536000)/12));
	$days = abs(floor(($difference-($years * 31536000))/86400));
	$hours = abs(floor(($difference-($years * 31536000)-($days * 86400))/3600));
	$mins = abs(floor(($difference-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
	$timeString = "";
	if($years > 0)
	{
	    //$timeString = $months > 1 ? $months . " days ago" : $months . " day ago";
	    $timeString = $years . "y";
	}
	elseif($months > 0)
	{
	    //$timeString = $months > 1 ? $months . " days ago" : $months . " day ago";
	    $timeString = $months . "m";
	}
	elseif($days > 0)
	{
	    //$timeString = $days > 1 ? $days . " days ago" : $days . " day ago";
	     $timeString = $days . "d";
	}
	elseif($hours > 0)
	{
	    //$timeString = $hours > 1 ? $hours . " hours ago" : $hours . " hour ago";
	     $timeString = $hours . "h";
	}
	elseif($mins > 0)
	{
	    //$timeString = $mins > 1 ? $mins . " mins ago" : $mins . " min ago";
	    $timeString = $mins . "min";
	}else{
	    $timeString = "now";
	}
	return $timeString;
    }
}
