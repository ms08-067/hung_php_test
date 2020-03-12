<?php 
namespace Extend\Validator;
use Validator;
/**
 * BetterValidator
 *
 *
 * Cập nhật ngày 2/1/2014
 * 		Thêm xử lý captcha , sai >= N lần thì hiển thị captcha và cần valid nó
 * Cập nhật ngày 24/04/2017
 * 		Bỏ xử lý captcha ở đây
 */
class BetterValidator
{

	public static $rules = array(
		
		// SIGNUP 
		'checkbox'	   => array('required', 'accepted'),
		'f_name'       => array('required', 'max:100', 'alpha_vn'),
		'l_name'       => array('required', 'max:100', 'alpha_vn'),
		'email'        => array('required', 'email', 'unique:users,email'),
		'password'     => array('required', 'min:6', 'confirmed'),
		'captcha'      => array('required', 'numeric', 'captcha'),

		// cập nhật thông tin
		'gender'	   => array('required',	'in:0,1,2'),
		'birthday'	   => array('required', 'date_format:d-m-Y'),
		'address'	   => array('required', 'max:200',			'alpha_vn'),
		'city'		   => array('required', 'numeric',			'city'),

		'now_password' => array('required', 'min:6',			'match_password'),
		'question'	   => array('required', 'question'),
		'answer'	   => array('required', 'between:4,100',	'alpha_vn'),
		
		'mobile'       => array('required','phone'),

		// CMTND
		'cmtnd'		   => array('required', 'between:7,15', 	'alpha_num'),
		'cmtnd_at'	   => array('required', 'date_format:d-m-Y'),
		'cmtnd_city'   => array('required', 'numeric',			'city'),

		// Nạp thẻ
		'mathe'		   => array('required', 'between:7,15',		'alpha_num'),
		'seri'		   => array('required', 'between:7,15',		'alpha_num'),
		'card'		   => array('required', 'in:1,2,3,4,5,6,7,8'),
		
		'emailE'	   => array('required', 'email',			'exists:users,email'),

		// Support
		'thread_name'	 => array('required', 'between:6,100', 	'alpha_vn'),
		'thread_content' => array('required', 'between:6,4000'),

		'department'	 => array('required', 'numeric', 		'exists:id_support.departments,id'),
		'task'			 => array('required', 'numeric', 		'exists:id_support.tasks,id'),

		'server'         => array('required',	'numeric', 		'min:1'),
		'character'      => array('required',	'between:3,100','alpha_vn'),
	);

	public static $messages = array(
		
		'bad_word'							=> 'Tên không hợp lệ, có chứa nội dung bị cấm.',
		'alpha' 							=> 'Vui lòng chỉ nhập chữ, không nhập số và kí tự đặc biệt.',
		'alpha_num' 						=> 'Vui lòng không nhập kí tự đặc biệt.',
		'alpha_vn' 							=> 'Vui lòng không nhập kí tự đặc biệt.',
		'min'	   							=> 'Độ dài tối thiểu :min kí tự.',
		'max'	   							=> 'Độ dài tối đa :max kí tự.',
		'between'  							=> 'Độ dài cần từ :min kí tự tới :max kí tự.',
		'alpha_dash' 						=> 'Không được nhập kí tự đặc biệt.',
		'numeric'							=> 'Vui lòng nhập số.',
		'date_format' 						=> 'Không đúng định dạng.',
		'email'   							=> 'Vui lòng nhập đúng định dạng email.',
		'phone'								=> 'Vui lòng nhập đúng định dạng số điện thoại.',
		'channeling_name' 					=> 'Tên tài khoản chứa kí tự không được cho phép.',

		'checkbox.required'					=> 'Vui lòng đồng ý điều khoản',
		'checkbox.accepted'					=> 'Vui lòng đồng ý điều khoản',


		'password.required'   				=> 'Please type your password.',
		'password.confirmed'  				=> 'Confirmation password not match',

		'captcha.captcha'					=> 'Mã xác nhận không chính xác.',
		'captcha.required'					=> 'Vui lòng nhập mã xác nhận.',

		'f_name.required' 				    => 'Vui lòng nhập họ.',
		'l_name.required' 				    => 'Vui lòng nhập tên.',

		'gender.required' 					=> 'Hãy chọn giới tính của bạn.',
		'gender.in'		  					=> 'Giới tính không hợp lệ.',

		'birthday.required' 				=> 'Vui lòng chọn ngày sinh',

		'address.required' 					=> 'Vui lòng nhập địa chỉ.',
		'city.city'		   					=> 'Thành phố không chính xác',

		'now_password.required'   			=> 'Vui lòng nhập mật khẩu.',
		'now_password.match_password' 		=> 'Mật khẩu cũ không chính xác.',

		'email.required'   					=> 'Vui lòng nhập email.',
		'email.unique'   					=> 'Email has exists.',
		'email2.unique'   					=> 'Email đã được sử dụng.',

		'question.question' 				=> 'Vui lòng chọn đúng câu hỏi',
		'answer.required' 				    => 'Vui lòng nhập câu trả lời.',
		'answer.confirmed' 				    => 'Câu trả lời không khớp',

		'cmtnd.required'					=> 'Vui lòng nhập số CMT.',
		'cmtnd_at.required'					=> 'Vui lòng nhập ngày cấp.',
		'cmtnd_city.required'				=> 'Vui lòng nhập nơi cấp',
		'cmtnd_city.city'					=> 'Thành phố không chính xác',

		'mathe.required'					=> 'Vui lòng nhập mã thẻ.',
		'seri.required'						=> 'Vui lòng nhập seri.',
		'card.required'						=> 'Vui lòng chọn loại thẻ.',
		'card.in'							=> 'Thẻ mà bạn chọn không hợp lệ.',

		'emailE.required'					=> 'Vui lòng nhập email.',
		'emailE.exists'						=> 'Email không tồn tại.',

		// Support
		'thread_name.required'   				=> 'Vui lòng nhập tên.',
		'thread_name.between'    				=> 'Độ dài tên cần từ :min kí tự đến :max kí tự.',
		'thread_name.alpha_vn'   				=> 'Không được nhập kí tự đặc biệt.',

		'thread_content.required'				=> 'Vui lòng nhập nội dung.',

		'department.required' 					=> 'Vui lòng chọn trò chơi/hệ thống.',
		'department.exists'   					=> 'Trò chơi/hệ thống không tồn tại.',

		'task.required' 						=> 'Vui lòng chọn vấn đề.',
		'task.exists'   						=> 'Vấn đề không tồn tại.',
	);

	public static function make($attributes, $rules = array(), $messages = array())
	{

		foreach($attributes as $attribute => $value)
		{
			if(strpos($attribute,'_confirmation') !== FALSE)
			{
				continue;
			}

			if(isset($rules[$attribute]))
			{
				if(isset(static::$rules[$attribute]))
				{
					$rules[$attribute] = array_merge_recursive($rules[$attribute], static::$rules[$attribute]);
				}else{
					// self = self
				}
			}else{
				if(isset(static::$rules[$attribute]))
				{
					$rules[$attribute] = static::$rules[$attribute];
				}
			}
		}

		$messages 	= array_merge_recursive($messages, static::$messages);

		$validator 	= \Validator::make($attributes, $rules, $messages);


		return $validator;
	}
}