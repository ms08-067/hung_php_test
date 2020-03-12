<?php namespace Trihtm\SMS;

interface SMSInterface{

	public function mainRules(\SmsLog $smsLog);

	public function mainAction(\SmsLog $smsLog);

	public function getErrorText();
	public function getSuccessText();

}