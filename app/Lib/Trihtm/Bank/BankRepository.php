<?php 
namespace Trihtm\Bank;

use URL;
use Nova\User\Models\User;
use DB;
use App;
use Exception;
use Nova\Payment\Models\BankLog;
use Input;

class BankRepository
{
	protected static $instance;

	public static $ListCurrency = array(100000,200000,500000,1000000,2000000,5000000);

	protected $config;

	function __construct()
	{
		$this->config = array(
			'Merchant_ID'           => 'CHAMHOC',
	        'Merchant_AccessCode'   => 'SXSNZZPJ',
	        'Merchant_Secret'       => '2FA160E103114BE405767F4DD9A9EA48',
	        'ReturnURL'             => URL::route('bank.action'), // Url nhận kết quả trả về sau khi giao dịch hoàn thành.
	        'vpcUrl'                => 'https://onepay.vn/onecomm-pay/vpc.op',
	        'Locale'                => 'vn',
	        'Currency'              => 'VND',
		);
	}

	public static function getInstance()
	{
		if(!isset(static::$instance))
		{
			static::$instance = new self;
		}

		return static::$instance;
	}

	public function render(User $user, $amount)
	{
		$hash = array(
            'vpc_AccessCode'        => $this->config['Merchant_AccessCode'], // local && fixed
            'vpc_Merchant'          => $this->config['Merchant_ID'], // local & fixed
            'vpc_Currency'          => $this->config['Currency'], // local && fixed
            'vpc_Locale'            => $this->config['Locale'], // local & fixed
            'vpc_ReturnURL'         => $this->config['ReturnURL'], // local & fixed
            'vpc_Command'           => 'pay', // fixed
            'vpc_Customer_Email'    => '', // null
            'vpc_Customer_Id'       => '', // null
            'vpc_Customer_Phone'    => '', // null
            'vpc_SHIP_City'         => '',// null
            'vpc_SHIP_Country'      => '',// null
            'vpc_SHIP_Provice'      => '',// null
            'vpc_SHIP_Street01'     => '',// null
            'vpc_Version'           => 2, // fixed
            'vpc_TicketNo'          => $_SERVER['REMOTE_ADDR'],// ip khach hang

            'vpc_Amount'            => $amount * 100, // Số tiền cần thanh toán,Đã được nhân với 100. VD: 100=1VND
            'vpc_MerchTxnRef'       => md5(date('dmyhisu').rand().rand().'Amo.Vn'),
            //'vpc_OrderInfo'         => 'AMO_'.$user->id.'_'.$amount,
            'vpc_OrderInfo'         => 'BCCH_'.$user->id.'_'.$amount,
            'fgame_amount'          => $amount,
        );

		ksort($hash);

		$stringHashData = '';
        $vpcURL         = $this->config['vpcUrl'].'?';
        $appendAmp      = 0;

        foreach($hash as $key => $value)
        {
            if (strlen($value) > 0)
            {
                if ($appendAmp == 0)
                {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }

                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }

        $stringHashData = rtrim($stringHashData, "&");

        if (strlen($this->config['Merchant_Secret']) > 0)
        {
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$this->config['Merchant_Secret'])));
        }

        try{
            DB::connection()->getPdo()->beginTransaction();

        	BankLog::pre_insert($user, $hash);

        	DB::connection()->getPdo()->commit();
        }catch(Exception $e) {
            
            DB::connection()->getPdo()->rollBack();

            App::abort("Tiến hành nạp tiền qua ATM thất bại. Vui lòng thử lại.", 600);
        }

        return $vpcURL;
	}

	public function action()
	{
		$hash = array(
            'vpc_AdditionData'      => Request()->input('vpc_AdditionData'),
            'vpc_Amount'            => Request()->input('vpc_Amount'),
            'vpc_Command'           => Request()->input('vpc_Command'),
            'vpc_CurrencyCode'      => Request()->input('vpc_CurrencyCode'),
            'vpc_Locale'            => Request()->input('vpc_Locale'),
            'vpc_MerchTxnRef'       => Request()->input('vpc_MerchTxnRef'),
            'vpc_Merchant'          => Request()->input('vpc_Merchant'),
            'vpc_Message'           => Request()->input('vpc_Message'),
            'vpc_OrderInfo'         => Request()->input('vpc_OrderInfo'),
            'vpc_TransactionNo'     => Request()->input('vpc_TransactionNo'),
            'vpc_TxnResponseCode'   => Request()->input('vpc_TxnResponseCode'),
            'vpc_Version'           => Request()->input('vpc_Version'),
            'vpc_SecureHash'        => Request()->input('vpc_SecureHash'),
        );

        $hashValidated = '';

        if (strlen ( $this->config['Merchant_Secret'] ) > 0 && $hash['vpc_TxnResponseCode'] != "7" && $hash['vpc_TxnResponseCode'] != "No Value Returned")
        {
            $stringHashData = "";

            foreach ( $hash as $key => $value )
            {
                if (
                    $key != "vpc_SecureHash" &&
                    (strlen($value) > 0) &&
                    ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))
                )
                {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }

            $stringHashData = rtrim($stringHashData, "&");

            if (strtoupper ( $hash['vpc_SecureHash'] ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$this->config['Merchant_Secret']))))
            {
                $hashValidated = "SUCCESS";
            }else{
                $hashValidated = "FAILED"; // invalid hash
            }
        }else{
            $hashValidated = "FAILED"; // invalid hash
        }

        switch($hashValidated)
        {
            default:
                throw new Exception('Giao dịch thất bại. Vui lòng thử lại.', 600);
            break;

            case 'SUCCESS': // hash thanh cong
                $hash['vpc_TxnResponseCode'] = intval($hash['vpc_TxnResponseCode']);

                # Kiểm tra transaction có hợp lệ hay không ?
                $logs = BankLog::where('transaction_id', '=', $hash['vpc_MerchTxnRef'])->where('status', '=', 0)->select('id', 'user_id', 'amount')->get();

				if(count($logs) == 0)
				{
					throw new Exception("Không tồn tại mã giao dịch này.", 600);
				}

				$log = $logs[0];

				$amount = floor($hash['vpc_Amount'] / 100);

		        if($amount != $log->amount)
		        {
		            throw new Exception("Giá trị tiền nạp vào không chính xác.", 600);
		        }

		        $user_id = $log->user_id;
		        $user 	 = User::find($user_id);

                switch($hash['vpc_TxnResponseCode'])
                {
                    case '0':
			        	# Chuẩn bị trước khi thành công.
			        	try{
				            DB::connection()->getPdo()->beginTransaction();

				        	BankLog::pre_success($log, $user, $hash, $amount);

                        	BankLog::on_success($log, $user, $hash);

				        	DB::connection()->getPdo()->commit();
				        }catch(Exception $e) {
				            DB::connection()->getPdo()->rollBack();

			            	throw new Exception("Nạp tiền thất bại ở khâu nhận kết quả. Vui lòng thử lại.", 600);
				        }

                        return true;
                    break;

                    case '1':
                        throw new Exception('Ngân hàng từ chối giao dịch', 600);
                    break;

                    case '3':
                        throw new Exception('Mã đơn vị không tồn tại', 600);
                    break;

                    case '4':
                        throw new Exception('Không đúng access code', 600);
                    break;

                    case '5':
                        throw new Exception('Số tiền không hợp lệ', 600);
                    break;

                    case '6':
                        throw new Exception('Mã tiền tệ không tồn tại', 600);
                    break;

                    case '7':
                        throw new Exception('Lỗi không xác định', 600);
                    break;

                    case '8':
                        throw new Exception('Số thẻ không đúng', 600);
                    break;

                    case '9':
                        throw new Exception('Tên chủ thẻ không chính xác', 600);
                    break;

                    case '10':
                        throw new Exception('Thẻ hết hạn hoặc đã bị khóa', 600);
                    break;

                    case '11':
                        throw new Exception('Thẻ chưa đăng ký dịch vụ', 600);
                    break;

                    case '12':
                        throw new Exception('Ngày phát hành hoặc ngày hết hạn không đúng', 600);
                    break;

                    case '13':
                        throw new Exception('Vượt quá hạn mức thanh toán', 600);
                    break;

                    case '99':
                        throw new Exception('Hủy giao dịch thành công', 600);
                    break;

                    case '21':
                        throw new Exception('Không đủ tiền trong tài khoản để thanh toán', 600);
                    break;

                    default:
                        throw new Exception('Có lỗi xảy ra. Mã lỗi '.$hash['vpc_TxnResponseCode'], 600);
                    break;
                }
            break;

            case 'FAILED': //pending
                switch($hash['vpc_TxnResponseCode'])
                {
                    case 99:
                        throw new Exception('Giao dịch hủy bỏ.', 600);
                    break;

                    default:
                        throw new Exception('Hệ thống có sự cố. Xin vui lòng liên hệ CSKH của aMO Platform.', 600);
                    break;
                }
            break;
        }

        return false;
	}
}