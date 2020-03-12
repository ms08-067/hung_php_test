<?php
use PHPMailer\PHPMailer\PHPMailer;

if (!function_exists('permission')) {
    function permission($perm)
    {
        
        if(!Auth::guard("admin")->check())
			redirect(route('admin.login'));
		$admin = Auth::guard("admin")->user();
		$permission = unserialize($admin->permission);
		if(!isset($permission[$perm]))
			return false;
		return true;
    }
}

if (!function_exists('checkGoogleCaptcha')) {
    function checkGoogleCaptcha($url, $param = '')
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_COOKIE, '');
        curl_setopt($ch, CURLOPT_REFERER, '');   
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
            
        $kq = curl_exec($ch); 
        curl_close($ch);
        return $kq;
    }
}

if (!function_exists('parserString')) {
    function parserString($content, array $data)
    {
        
        if (!empty($content)) {
               foreach ( $data as $k=>$v ) {
                    $content = str_replace("{{".$k."}}", $v, $content);
               }   
          }
          return $content;
    }
}

function slug($str){
    $str = trim(strtolower($str));
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',                         
        '-'=>' |%|,|=|;|!',     
    );
    foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }

    $str = str_replace('?','',$str);
    $str = str_replace('+','-',$str);
    $str = str_replace('`','',$str);
    $str = str_replace('~','',$str);
    $str = str_replace('’','',$str);
    $str = str_replace(':','',$str);
    $str = str_replace('.','-',$str);
    $str = str_replace('&','',$str);
    $str = str_replace('(','',$str);
    $str = str_replace(')','',$str);
    $str = str_replace('{','',$str);
    $str = str_replace('}','',$str);
    $str = str_replace('[','',$str);
    $str = str_replace(']','',$str);
    $str = str_replace("'",'',$str);
    $str = str_replace('"','',$str);
    $str = str_replace('“','',$str);
    $str = str_replace('”','',$str);
    $str = str_replace("'",'',$str);
    $str = str_replace("---",'-',$str);
    $str = str_replace("--",'-',$str);
    $str = str_replace("/",'-',$str);
    $str = str_replace(".",'-',$str);

    $str = mb_convert_encoding($str, "UTF-8");
    return $str;
}

if (!function_exists('country')) {
    function country($country_id)
    {
        return \Lib\Option\IndexOption::getName($country_id);
    }
}

if (!function_exists('user')) {
    function user($user_id)
    {
        return \Nova\User\Models\User::find($user_id);
    }
}


if (!function_exists('generateRandom')) {
    function generateRandom($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }
}

if (!function_exists('sendMail')) {
    function sendMail($to, $subject, $body, $cc = [], $bcc = [], $attach_file = [],$mail_from = 'adminjobs@ezweb.company', $from_name = 'Emo Seeker', $to_name='')
    {
        
        $mail = new PHPMailer; 
		
	    $mail->SMTPDebug = 0;                                 
	    $mail->isSMTP();
	    $mail->Host = env('MAIL_HOST', "smtp.gmail.com");  
	    $mail->SMTPAuth = true;                          
	    $mail->Username = env('MAIL_USERNAME', "hung56344@gmail.com");
	    $mail->Password = env('MAIL_PASSWORD', "Pro12345678");
	    $mail->SMTPSecure = env('MAIL_ENCRYPTION', "tls");
	    $mail->Port = env('MAIL_PORT', "587");

        $mail->From = $mail_from;
        $mail->FromName = $from_name;
        $mail->addAddress($to, $to_name);
        $mail->isHTML(true);

	    //Recipients
	   
	    //$mail->addReplyTo('hunguit@yahoo.com', '');
	    if(!empty($cc)){
	    	foreach ($cc as $k => $ccEmail) {
	    		$mail->addCC($ccEmail);
	    	}
	    }

	    if(!empty($bcc)){
	    	foreach ($bcc as $k => $bccEmail) {
	    		$mail->addBCC($bccEmail);
	    	}
	    }

	    if(!empty($attach_file)){
	    	foreach ($attach_file as $k => $file) {
	    		$mail->addAttachment($file);    
	    		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
	    	}
	    }

	    $mail->CharSet = 'UTF-8';
	    $mail->Subject = $subject;
	    $mail->Body    = $body;
	    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    $result = $mail->send();

        if(!$result){
            
            echo $mail->ErrorInfo;exit;
        }	
    }
}


if (!function_exists('mt_rand_str')) {
    function mt_rand_str ($l, $c = '0123456789') {
    
        for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
        return $s;
    }
}


?>
