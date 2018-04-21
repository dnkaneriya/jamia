<?php

// set default timezone in index.php
$array = array();
return array_merge(
            array(
                'apptitle' => 'Jamiah',//APP TITLE Fibromialgia
                'appName' => 'Jamiah',
                'appcookiename' => 'jamiah',
                'adminEmail' => 'admin@jamiah.com',
                'msg_success' =>'<div class="alert alert-dismissable alert-success fade in" style="float:left; width:100%;">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <strong>Success!</strong> ',
                'msg_error' =>  '<div class="alert alert-dismissable alert-block alert-danger fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="fa fa-times"></i>
                                  </button>
                                  <strong>Error!</strong> ',
                'msg_end' => '</div>',
                'userimage' => 'img/uploads/users',
                'homebanner' => 'img/uploads/homebanner',
                /*'indian_all_states' => array (
                                                'AP' => 'Andhra Pradesh', 'AR' => 'Arunachal Pradesh', 'AS' => 'Assam', 'BR' => 'Bihar', 'CT' => 'Chhattisgarh',
                                                'GA' => 'Goa', 'GJ' => 'Gujarat', 'HR' => 'Haryana', 'HP' => 'Himachal Pradesh', 'JK' => 'Jammu & Kashmir',
                                                'JH' => 'Jharkhand', 'KA' => 'Karnataka', 'KL' => 'Kerala', 'MP' => 'Madhya Pradesh', 'MH' => 'Maharashtra',
                                                'MN' => 'Manipur', 'ML' => 'Meghalaya', 'MZ' => 'Mizoram', 'NL' => 'Nagaland', 'OR' => 'Odisha', 'PB' => 'Punjab',
                                                'RJ' => 'Rajasthan', 'SK' => 'Sikkim', 'TN' => 'Tamil Nadu', 'TR' => 'Tripura', 'UK' => 'Uttarakhand',
                                                'UP' => 'Uttar Pradesh', 'WB' => 'West Bengal', 'AN' => 'Andaman & Nicobar', 'CH' => 'Chandigarh',
                                                'DN' => 'Dadra and Nagar Haveli', 'DD' => 'Daman & Diu', 'DL' => 'Delhi', 'LD' => 'Lakshadweep',
                                                'PY' => 'Puducherry'
                                            )*/
                'indian_all_states' => array (
                                                '1' => 'Andhra Pradesh', '2' => 'Arunachal Pradesh', '3' => 'Assam', '4' => 'Bihar', '5' => 'Chhattisgarh',
                                                '6' => 'Goa', '7' => 'Gujarat', '8' => 'Haryana', '9' => 'Himachal Pradesh', '10' => 'Jammu & Kashmir',
                                                '11' => 'Jharkhand', '12' => 'Karnataka', '13' => 'Kerala', '14' => 'Madhya Pradesh', '15' => 'Maharashtra',
                                                '16' => 'Manipur', '17' => 'Meghalaya', '18' => 'Mizoram', '19' => 'Nagaland', '20' => 'Odisha', '21' => 'Punjab',
                                                '22' => 'Rajasthan', '23' => 'Sikkim', '24' => 'Tamil Nadu', '25' => 'Tripura', '26' => 'Uttarakhand',
                                                '27' => 'Uttar Pradesh', '28' => 'West Bengal', '29' => 'Andaman & Nicobar', '30' => 'Chandigarh',
                                                '31' => 'Dadra and Nagar Haveli', '32' => 'Daman & Diu', '33' => 'Delhi', '34' => 'Lakshadweep',
                                                '35' => 'Puducherry'
                                            ),
                'indian_all_district' => array(
                                                '1' => array(
                                                    'Adilabad', 'Anantapur', 'Chittoor', 'East Godavari', 'Guntur', 'Hyderabad', 'Kadapa', 'Karimnagar',
                                                    'Khammam', 'Krishna', 'Kurnool', 'Mahbubnagar', 'Medak', 'Nalgonda', 'Nellore', 'Nizamabad', 'Prakasam',
                                                    'Rangareddi', 'Srikakulam', 'Vishakhapatnam', 'Vizianagaram', 'Warangal', 'West Godavari'
                                                ),
                                                '2' => array(
                                                    'Anjaw', 'Changlang', 'East Kameng', 'Lohit', 'Lower Subansiri', 'Papum Pare', 'Tirap', 'Dibang Valley',
                                                    'Upper Subansiri', 'West Kameng'
                                                ),
                                                '3' => array(
                                                    'Barpeta', 'Bongaigaon', 'Cachar', 'Darrang', 'Dhemaji', 'Dhubri', 'Dibrugarh', 'Goalpara', 'Golaghat',
                                                    'Hailakandi', 'Jorhat', 'Karbi Anglong', 'Karimganj', 'Kokrajhar', 'Lakhimpur', 'Marigaon', 'Nagaon',
                                                    'Nalbari', 'North Cachar Hills', 'Sibsagar', 'Sonitpur', 'Tinsukia'
                                                ),
                                                '4' => array(
                                                    'Araria', 'Aurangabad', 'Banka', 'Begusarai', 'Bhagalpur', 'Bhojpur', 'Buxar', 'Darbhanga',
                                                    'Purba Champaran', 'Gaya', 'Gopalganj', 'Jamui', 'Jehanabad', 'Khagaria', 'Kishanganj', 'Kaimur', 'Katihar',
                                                    'Lakhisarai', 'Madhubani', 'Munger', 'Madhepura', 'Muzaffarpur', 'Nalanda', 'Nawada', 'Patna', 'Purnia',
                                                    'Rohtas', 'Saharsa', 'Samastipur', 'Sheohar', 'Sheikhpura', 'Saran', 'Sitamarhi', 'Supaul', 'Siwan',
                                                    'Vaishali', 'Pashchim Champaran'
                                                ),
                                                '5' => array(
                                                    'Bastar', 'Bilaspur', 'Dantewada', 'Dhamtari', 'Durg', 'Jashpur', 'Janjgir-Champa', 'Korba', 'Koriya',
                                                    'Kanker', 'Kawardha', 'Mahasamund', 'Raigarh', 'Rajnandgaon', 'Raipur', 'Surguja'
                                                ),
                                                '6' => array(
                                                    'North Goa', 'South Goa'
                                                ),
                                                '7' => array(
                                                    'Ahmedabad', 'Amreli District', 'Anand','Aravalli', 'Banaskantha', 'Bharuch', 'Bhavnagar','Botad','Chhota Udaipur', 'Dahod', 'Dang','Devbhoomi Dwarka',
                                                    'Gandhinagar','Gir Somnath', 'Jamnagar', 'Junagadh', 'Kutch', 'Kheda', 'Mehsana','Morbi', 'Narmada', 'Navsari', 'Patan',
                                                    'Panchmahal','Patan', 'Porbandar', 'Rajkot', 'Sabarkantha', 'Surat', 'Surendranagar','Tapi', 'Vadodara', 'Valsad'
                                                ),
                                                '8' => array(
                                                    'Ambala', 'Bhiwani', 'Faridabad', 'Fatehabad', 'Gurgaon', 'Hissar', 'Jhajjar', 'Jind', 'Karnal', 'Kaithal',
                                                    'Kurukshetra', 'Mahendragarh', 'Mewat', 'Panchkula', 'Panipat', 'Rewari', 'Rohtak', 'Sirsa', 'Sonepat',
                                                    'Yamuna Nagar', 'Palwal'
                                                ),
                                                '9' => array(
                                                    'Bilaspur', 'Chamba', 'Hamirpur', 'Kangra', 'Kinnaur', 'Kulu', 'Lahaul and Spiti', 'Mandi', 'Shimla',
                                                    'Sirmaur', 'Solan', 'Una'
                                                ),
                                                '10' => array(
                                                    'Anantnag', 'Badgam', 'Bandipore', 'Baramula', 'Doda', 'Jammu', 'Kargil', 'Kathua', 'Kupwara', 'Leh',
                                                    'Poonch', 'Pulwama', 'Rajauri', 'Srinagar', 'Samba', 'Udhampur'
                                                ),
                                                '11' => array(
                                                    'Bokaro', 'Chatra', 'Deoghar', 'Dhanbad', 'Dumka', 'Purba Singhbhum', 'Garhwa', 'Giridih', 'Godda', 'Gumla',
                                                    'Hazaribagh', 'Koderma', 'Lohardaga', 'Pakur', 'Palamu', 'Ranchi', 'Sahibganj', 'Seraikela and Kharsawan',
                                                    'Pashchim Singhbhum', 'Ramgarh'
                                                ),
                                                '12' => array(
                                                    'Bidar', 'Belgaum', 'Bijapur', 'Bagalkot', 'Bellary', 'Bangalore Rural District', 'Bangalore Urban District',
                                                    'Chamarajnagar', 'Chikmagalur', 'Chitradurga', 'Davanagere', 'Dharwad', 'Dakshina Kannada', 'Gadag',
                                                    'Gulbarga', 'Hassan', 'Haveri District', 'Kodagu', 'Kolar', 'Koppal', 'Mandya', 'Mysore', 'Raichur',
                                                    'Shimoga', 'Tumkur', 'Udupi', 'Uttara Kannada', 'Ramanagara', 'Chikballapur', 'Yadagiri'
                                                ),
                                                '13' => array(
                                                    'Alappuzha', 'Ernakulam', 'Idukki', 'Kollam', 'Kannur', 'Kasaragod', 'Kottayam', 'Kozhikode', 'Malappuram',
                                                    'Palakkad', 'Pathanamthitta', 'Thrissur', 'Thiruvananthapuram', 'Wayanad'
                                                ),
                                                '14' => array(
                                                    'Alirajpur', 'Anuppur', 'Ashok Nagar', 'Balaghat', 'Barwani', 'Betul', 'Bhind', 'Bhopal', 'Burhanpur',
                                                    'Chhatarpur', 'Chhindwara', 'Damoh', 'Datia', 'Dewas', 'Dhar', 'Dindori', 'Guna', 'Gwalior', 'Harda',
                                                    'Hoshangabad', 'Indore', 'Jabalpur', 'Jhabua', 'Katni', 'Khandwa', 'Khargone', 'Mandla', 'Mandsaur',
                                                    'Morena', 'Narsinghpur', 'Neemuch', 'Panna', 'Rewa', 'Rajgarh', 'Ratlam', 'Raisen', 'Sagar', 'Satna',
                                                    'Sehore', 'Seoni', 'Shahdol', 'Shajapur', 'Sheopur', 'Shivpuri', 'Sidhi', 'Singrauli', 'Tikamgarh',
                                                    'Ujjain', 'Umaria', 'Vidisha'
                                                ),
                                                '15' => array(
                                                    'Ahmednagar', 'Akola', 'Amrawati', 'Aurangabad', 'Bhandara', 'Beed', 'Buldhana', 'Chandrapur', 'Dhule',
                                                    'Gadchiroli', 'Gondiya', 'Hingoli', 'Jalgaon', 'Jalna', 'Kolhapur', 'Latur', 'Mumbai City',
                                                    'Mumbai suburban', 'Nandurbar', 'Nanded', 'Nagpur', 'Nashik', 'Osmanabad', 'Parbhani', 'Pune', 'Raigad',
                                                    'Ratnagiri', 'Sindhudurg', 'Sangli', 'Solapur', 'Satara', 'Thane', 'Wardha', 'Washim', 'Yavatmal'
                                                ),
                                                '16' => array(
                                                    'Bishnupur', 'Churachandpur', 'Chandel', 'Imphal East', 'Senapati', 'Tamenglong', 'Thoubal', 'Ukhrul',
                                                    'Imphal West'
                                                ),
                                                '17' => array(
                                                    'East Garo Hills', 'East Khasi Hills', 'Jaintia Hills', 'Ri-Bhoi', 'South Garo Hills', 'West Garo Hills',
                                                    'West Khasi Hills'
                                                ),
                                                '18' => array(
                                                    'Aizawl', 'Champhai', 'Kolasib', 'Lawngtlai', 'Lunglei', 'Mamit', 'Saiha', 'Serchhip'
                                                ),
                                                '19' => array(
                                                    'Dimapur', 'Kohima', 'Mokokchung', 'Mon', 'Phek', 'Tuensang', 'Wokha', 'Zunheboto'
                                                ),
                                                '20' => array(
                                                    'Angul', 'Boudh', 'Bhadrak', 'Bolangir', 'Bargarh', 'Baleswar', 'Cuttack', 'Debagarh', 'Dhenkanal', 'Ganjam',
                                                    'Gajapati', 'Jharsuguda', 'Jajapur', 'Jagatsinghpur', 'Khordha', 'Kendujhar', 'Kalahandi', 'Kandhamal',
                                                    'Koraput', 'Kendrapara', 'Malkangiri', 'Mayurbhanj', 'Nabarangpur', 'Nuapada', 'Nayagarh', 'Puri',
                                                    'Rayagada', 'Sambalpur', 'Subarnapur', 'Sundargarh'
                                                ),
                                                '21' => array(
                                                    'Amritsar', 'Bathinda', 'Firozpur', 'Faridkot', 'Fatehgarh Sahib', 'Gurdaspur', 'Hoshiarpur', 'Jalandhar',
                                                    'Kapurthala', 'Ludhiana', 'Mansa', 'Moga', 'Mukatsar', 'Nawan Shehar', 'Patiala', 'Rupnagar', 'Sangrur'
                                                ),
                                                '22' => array(
                                                    'Ajmer', 'Alwar', 'Bikaner', 'Barmer', 'Banswara', 'Bharatpur', 'Baran', 'Bundi', 'Bhilwara', 'Churu',
                                                    'Chittorgarh', 'Dausa', 'Dholpur', 'Dungapur', 'Ganganagar', 'Hanumangarh', 'Juhnjhunun', 'Jalore',
                                                    'Jodhpur', 'Jaipur', 'Jaisalmer', 'Jhalawar', 'Karauli', 'Kota', 'Nagaur', 'Pali', 'Pratapgarh', 'Rajsamand',
                                                    'Sikar', 'Sawai Madhopur', 'Sirohi', 'Tonk', 'Udaipur'
                                                ),
                                                '23' => array(
                                                    'East Sikkim', 'North Sikkim', 'South Sikkim', 'West Sikkim'
                                                ),
                                                '24' => array(
                                                    'Ariyalur', 'Chennai', 'Coimbatore', 'Cuddalore', 'Dharmapuri', 'Dindigul', 'Erode', 'Kanchipuram',
                                                    'Kanyakumari', 'Karur', 'Madurai', 'Nagapattinam', 'The Nilgiris', 'Namakkal', 'Perambalur', 'Pudukkottai',
                                                    'Ramanathapuram', 'Salem', 'Sivagangai', 'Tiruppur', 'Tiruchirappalli', 'Theni', 'Tirunelveli', 'Thanjavur',
                                                    'Thoothukudi', 'Thiruvallur', 'Thiruvarur', 'Tiruvannamalai', 'Vellore', 'Villupuram'
                                                ),
                                                '25' => array(
                                                    'Dhalai', 'North Tripura', 'South Tripura', 'West Tripura'
                                                ),
                                                '26' => array(
                                                    'Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal',
                                                    'Pithoragharh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'
                                                ),
                                                '27' => array(
                                                    'Agra', 'Allahabad', 'Aligarh', 'Ambedkar Nagar', 'Auraiya', 'Azamgarh', 'Barabanki', 'Badaun', 'Bagpat',
                                                    'Bahraich', 'Bijnor', 'Ballia', 'Banda', 'Balrampur', 'Bareilly', 'Basti', 'Bulandshahr', 'Chandauli',
                                                    'Chitrakoot', 'Deoria', 'Etah', 'Kanshiram Nagar', 'Etawah', 'Firozabad', 'Farrukhabad', 'Fatehpur',
                                                    'Faizabad', 'Gautam Buddha Nagar', 'Gonda', 'Ghazipur', 'Gorkakhpur', 'Ghaziabad', 'Hamirpur', 'Hardoi',
                                                    'Mahamaya Nagar', 'Jhansi', 'Jalaun', 'Jyotiba Phule Nagar', 'Jaunpur District', 'Kanpur Dehat', 'Kannauj',
                                                    'Kanpur Nagar', 'Kaushambi', 'Kushinagar', 'Lalitpur', 'Lakhimpur Kheri', 'Lucknow', 'Mau', 'Meerut',
                                                    'Maharajganj', 'Mahoba', 'Mirzapur', 'Moradabad', 'Mainpuri', 'Mathura', 'Muzaffarnagar', 'Pilibhit',
                                                    'Pratapgarh', 'Rampur', 'Rae Bareli', 'Saharanpur', 'Sitapur', 'Shahjahanpur', 'Sant Kabir Nagar',
                                                    'Siddharthnagar', 'Sonbhadra', 'Sant Ravidas Nagar', 'Sultanpur', 'Shravasti', 'Unnao', 'Varanasi'
                                                ),
                                                '28' => array(
                                                    'Birbhum', 'Bankura', 'Bardhaman', 'Darjeeling', 'Dakshin Dinajpur', 'Hooghly', 'Howrah', 'Jalpaiguri',
                                                    'Cooch Behar', 'Kolkata', 'Malda', 'Midnapore', 'Murshidabad', 'Nadia', 'North 24 Parganas',
                                                    'South 24 Parganas', 'Purulia', 'Uttar Dinajpur'
                                                ),
                                                '29' => array(
                                                    'North and Middle Andaman', 'South Andaman', 'Nicobar'
                                                ),
                                                '30' => array( 'Chandigarh' ),
                                                '31' => array( 'Dadra and Nagar Haveli' ),
                                                '32' => array(
                                                    'Diu', 'Daman'
                                                ),
                                                '33' => array(
                                                    'Central Delhi', 'East Delhi', 'New Delhi', 'North Delhi', 'North East Delhi', 'North West Delhi',
                                                    'South Delhi', 'South West Delhi', 'West Delhi'
                                                ),
                                                '34' => array( 'Lakshadweep' ),
                                                '35' => array(
                                                    'Karaikal', 'Mahe', 'Puducherry', 'Yanam'
                                                ),
                                        )
            ),$array);
?>