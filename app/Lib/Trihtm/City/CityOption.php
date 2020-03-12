<?php 
namespace Trihtm\City;

class CityOption
{
	public static $list = array(		
	  0 	=> 	'--Tỉnh/Thành phố--',
	  31 	=> 	'An Giang',
	  37 	=> 	'Bà Rịa Vũng Tàu',
	  33 	=> 	'Bình Dương',
	  35 	=> 	'Bình Phước',
	  28 	=> 	'Bình Thuận',
	  32 	=> 	'Bình Định',
	  34 	=> 	'Bạc Liêu',
	  6 	=> 	'Bắc Cạn',
	  12 	=> 	'Bắc Giang',
	  13 	=> 	'Bắc Ninh',
	  36 	=> 	'Bến Tre',
	  2 	=> 	'Cao Bằng',
	  38 	=> 	'Cà Mau',
	  30 	=> 	'Cần Thơ',
	  40 	=> 	'Đà Nẵng',
	  39 	=> 	'Đăk Lăk',
	  64 	=> 	'Điện Biên',
	  29 	=> 	'Đồng Nai',
	  41 	=> 	'Đồng Tháp',
	  42 	=> 	'Gia Lai',
	  1 	=> 	'Hà Giang',
	  18 	=> 	'Hà Nam',
	  43 	=> 	'Hà Nội',
	  14 	=> 	'Hà Tây',
	  46 	=> 	'Hà Tĩnh',
	  62 	=> 	'Hà Đông',
	  17 	=> 	'Hòa Bình',
	  16 	=> 	'Hưng Yên',
	  63 	=> 	'Hạ Long',
	  15 	=> 	'Hải Dương',
	  45 	=> 	'Hải Phòng',
	  44 	=> 	'Hồ Chí Minh',
	  48 	=> 	'Khánh Hòa',
	  47 	=> 	'Kiên Giang',
	  49 	=> 	'KonTum',
	  3 	=> 	'Lai Châu',
	  50 	=> 	'Long An',
	  4 	=> 	'Lào Cai',
	  51 	=> 	'Lâm Đồng',
	  52 	=> 	'Lạng Sơn',
	  19 	=> 	'Nam Định',
	  53 	=> 	'Nghệ An',
	  21 	=> 	'Ninh Bình',
	  54 	=> 	'Ninh Thuận',
	  10 	=> 	'Phú Thọ',
	  26 	=> 	'Phú Yên',
	  22 	=> 	'Quảng Bình',
	  55 	=> 	'Quảng Nam',
	  25 	=> 	'Quảng Ngãi',
	  56 	=> 	'Quảng Ninh',
	  23 	=> 	'Quảng Trị',
	  57 	=> 	'Sóc Trăng',
	  9 	=> 	'Sơn La',
	  59 	=> 	'Thanh Hóa',
	  20 	=> 	'Thái Bình',
	  7 	=> 	'Thái Nguyên',
	  24 	=> 	'Thừa Thiên Huế',
	  58 	=> 	'Tiền Giang',
	  60 	=> 	'Trà Vinh',
	  5 	=> 	'Tuyên Quang',
	  27 	=> 	'Tây Ninh',
	  61 	=> 	'Vĩnh Long',
	  11 	=> 	'Vĩnh Phúc',
	  8 	=> 	'Yên Bái',
	  65 	=> 	'Nơi khác',
	);

	public static $listStateUS = array(		
	 	"0" 	=> 	'-- State/Provience --',
	  	"AL" 	=> 	'Alabama',
	  	"AK"    => 	'Alaska',
	 	"AZ"    =>  'Arizona',
		"AR"    =>  'Arkansas',
		"CA"    =>  'California',
		"CO"    =>	'Colorado',
		"CT"	=>	'Connecticut',
		"DE"    =>  'Delaware',
		"DC"	=>	'District of Columbia',
		"FL"	=>	'Florida',
		"GA"	=>	'Georgia',
		"HI"	=>	'Hawaii',
		"ID"	=>	'Idaho',
		"IL"	=>	'Illinois',
		"IN"	=> 	'Indiana',
		"IA"	=> 	'Iowa',
		"KS"	=>	'Kansas',
		"KY"	=>	'Kentucky',
		"LA"	=> 	'Louisiana',
		"ME"	=>	'Maine',
		"MD"	=>	'Maryland',
		"MA"	=>	'Massachusetts',
		"MI"	=>	'Michigan',
		"MN"	=>	'Minnesota',
		"MS"	=>	'Mississippi',
		"MO"	=>	'Missouri',
		"MT"	=>	'Montana',
		"NE"	=>	'Nebraska',
		"NV"	=>	'Nevada',
		"NH"	=> 	'New Hampshire',
		"NJ"	=>	'New Jersey',
		"NM"	=>	'New Mexico',
		"NY"	=>	'New York',
		"NC"	=>	'North Carolina',
		"ND"	=>	'North Dakota',
		"OH"	=>	'Ohio',
		"OK"	=>	'Oklahoma',
		"OR"	=>	'Oregon',
		"PA"	=>	'Pennsylvania',
		"PR"	=>	'Puerto Rico',
		"RI"	=>	'Rhode Island',
		"SC"	=>	'South Carolina',
		"SD"	=>	'South Dakota',
		"TN"	=>	'Tennessee',
		"TX"	=>	'Texas',
		"UT"	=>	'Utah',
		"VT"	=>	'Vermont',
		"VA"	=>	'Virginia',
		"WA"	=>	'Washington',
		"WV"	=>	'West Virginia',
		"WI"	=> 	'Wisconsin',
		"WY"	=>	'Wyoming',
	  	"other" => 	'Other'
);

	public static $listCountry = array(
			"0" 	=> 	'-- Select Country --',
			"GB"	=>	'United Kingdom',
			"US"	=>	'United States',
			"AU"	=>	'Australia',
			"AT"	=>	'Austria',
			"BE"	=>	'Belgium',
			"CA"	=>	'Canada',
			"DK"	=>	'Denmark',
			"FI"	=>	'Finland',
			"FR"	=>	'France',
			"DE"	=>	'Germany',
			"HK"	=>	'Hong Kong SAR China',
			"IE"	=>	'Ireland',
			"IT"	=>	'Italy',
			"JP"	=>	'Japan',
			"LU"	=>	'Luxembourg',
			"NL"	=>	'Netherlands',
			"NZ"	=>	'New Zealand',
			"NO"	=>	'Norway',
			"PT"	=>	'Portugal',
			"SG"	=>	'Singapore',
			"ES"	=>	'Spain',
			"SE"	=>	'Sweden',
			"CH"	=>	'Switzerland',
			"other" => 'Other'
	);	

	public static function renderUS($defaultValue = '')
	{
		$html = '';

		foreach(static::$listStateUS as $option => $name)
		{
			$selected = ($option == $defaultValue) ? 'selected="selected"' : '';

			$html .= '<option value="'.$option.'" '.$selected.'>'.$name.'</option>';
		}

		return $html;
	}

	public static function renderCountry($defaultValue = '')
	{
		$html = '';

		foreach(static::$listCountry as $option => $name)
		{
			$selected = ($option == $defaultValue) ? 'selected="selected"' : '';

			$html .= '<option value="'.$option.'" '.$selected.'>'.$name.'</option>';
		}

		return $html;
	}

	public static function render($defaultValue = '')
	{
		$html = '';

		foreach(static::$list as $option => $name)
		{
			$selected = ($option == $defaultValue) ? 'selected="selected"' : '';

			$html .= '<option value="'.$option.'" '.$selected.'>'.$name.'</option>';
		}

		return $html;
	}

	public static function getName($index)
	{
		return static::$list[$index];
	}

	public static function check($index)
	{
		return (isset(static::$list[$index])) ? true : false;
	}
}