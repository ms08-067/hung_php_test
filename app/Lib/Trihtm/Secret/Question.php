<?php namespace Trihtm\Secret;

class Question
{
	public static $list = array(
		"0"		=> "Vui lòng chọn câu hỏi bí mật.",
		"1" 	=> 'Tên đầy đủ của bạn là gì?',
		"2" 	=> 'Trường cấp 3 bạn học tên là gì?',
		"3" 	=> 'Người bạn bạn quý nhất?',
		"4" 	=> 'Bạn đang dùng điện thoại hiệu gì?',
		"5" 	=> 'Mã chứng khoán bạn đang sở hữu?',
		"6" 	=> 'Con vật bạn yêu thích?',
		"7" 	=> 'Mơ ước của bạn là gì?',
		"8" 	=> 'Món ăn bạn ưa thích nhất?',
		"9" 	=> 'Môn thể thao yêu thích của bạn là gì?',
		"10" 	=> 'Diễn viên nào là thần tượng của bạn?',
		"11" 	=> 'Nơi sinh của bạn ở đâu?',
		"12" 	=> 'Tên công ty đầu tiên bạn làm việc?',
		"13" 	=> 'Tên trường đại học mà bạn đã học?',
		"14" 	=> 'Bạn gặp vợ (chồng) mình ở đâu?',
	);

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
