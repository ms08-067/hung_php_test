<?php namespace Trihtm\SMS;

use DB;
use Exception;
use Pretty;
use Datetime;

/**
 ****
 * Syntax: ADP CODE KIEMDIEP 1
 */
class GetAlphaCode
{
	public $mode = 'alphacode';
	public $code;
	
	
	public function mainRules(\SmsLog $smsLog)
	{
		
		if( (strtotime(date("d-m-Y H:i:s",time())) < strtotime("2014-11-22 00:00:00"))  ){
				
			
			throw new Exception("He thong chi mo trong 2 ngay 22/11/2014 va 23/11/2014. Vui long gui tin nhan vao thoi gian tren de duoc nhan Alpha Code", 600);
		}
		
		elseif((strtotime(date("d-m-Y H:i:s",time())) > strtotime("2014-11-26 00:00:00"))){
			return "He thong alpha code TCPT da dong vao ngay  26.11.2014.";
		}
		
		else {
			
			# Kiểm tra xem SĐT này đã nhận Code game này chưa.
			$count = DB::connection('id_event')->table('list_alphacode')
			->where('misdn', '=', $smsLog->misdn)
			->count();
			
			if($count > 0)
			{
				throw new Exception("Alpha Code da duoc gui ve so dien thoai nay. Vui long kiem tra lai tin nhan.", 600);
			}
				
		}
	}
	
	public function mt_rand_str ($l, $c = '0123456789') {
	
		for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
		return $s;
	}
	
	
	public function mainAction(\SmsLog $smsLog)
	{
		
		//date_default_timezone_set('Asia/Ho_Chi_Minh');
		if( (strtotime(date("d-m-Y H:i:s",time())) < strtotime("2014-11-22 00:00:00")) || (strtotime(date("d-m-Y H:i:s",time())) > strtotime("2014-11-26 00:00:00")) ){
			
			$this->code = "";
		}
		else {
			
			# Lấy Code
			$code = substr($smsLog->misdn,-6,strlen($smsLog->misdn)).time().($this->mt_rand_str(1));
			//$code = implode(".",str_split(trim($code),4));
			
			$this->code = $code;
			
			DB::connection('id_event')->table('list_alphacode')->insert(array(
			'code'        => $code,
			'misdn'		  => $smsLog->misdn,
			'created_at'  => new \Carbon\Carbon
			));
		}
			
	}

	public function getErrorText()
	{
		return "Co loi xay ra trong qua trinh nhan code. Vui long lien he CSKH qua Hotline 0466.860.806";
	}

	public function getSuccessText()
	{
		if( (strtotime(date("d-m-Y H:i:s",time())) < strtotime("2014-11-22 00:00:00")) ){
			
			return "He thong chi mo trong 2 ngay 22/11/2014 va 23/11/2014. Vui long gui tin nhan vao thoi gian tren de duoc nhan Alpha Code";
		}
		//return "He thong alpha code TCPT da dong vao 12h 25.11.2014. Hen gap ban tai Closed beta khong gioi han vao 27.11.2014";
		elseif((strtotime(date("d-m-Y H:i:s",time())) > strtotime("2014-11-26 00:00:00"))){
			
			return "He thong alpha code TCPT da dong vao ngay 26.11.2014.";
		}
	
		else {
			
			return "Alpha Code cua ban la ".implode(".",str_split(trim($this->code),4)).". Xem them tai http://thuongco.vn";
		}
		
	}
	
}