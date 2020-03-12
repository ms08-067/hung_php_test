<?php namespace Extend\Curl;

class Curl
{
	protected $url;
	protected $param;
	protected $agents = 'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1';
	protected $curl;
	protected $referer = '';
	protected $cookie;
	protected $timeout;
	protected $result;

	function config($url,$param = '')
	{
		$this->curl = curl_init();

		$this->set_timeout(30);

		$this->url 	 = $url;
		$this->param = $param;

		return $this;
	}

	function get()
	{
		if(is_array($this->param))
		{
			$this->param = http_build_query($this->param);
		}

		return $this->execute();
	}

	function set_timeout($time)
	{
		$this->timeout = $time;

		return $this;
	}

	function header()
	{
		curl_setopt($this->curl, CURLOPT_HEADER, TRUE);

		return $this;
	}

	function follow()
	{
		curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);

		return $this;
	}

	function cookie($cookie)
	{
		$this->cookie = __DIR__.'\\sessions\\'.$cookie;
	}

	function execute()
    {
    	curl_setopt($this->curl, CURLOPT_USERAGENT, $this->agents);
        curl_setopt($this->curl, CURLOPT_URL,$this->url);

		if($this->param != '')
		{
			curl_setopt($this->curl, CURLOPT_POSTFIELDS,$this->param);
		}

        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl, CURLOPT_COOKIE, '');
        curl_setopt($this->curl, CURLOPT_REFERER, $this->referer);

		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->curl, CURLOPT_BINARYTRANSFER, 1);

        if($this->cookie)
        {
            curl_setopt($this->curl, CURLOPT_COOKIEJAR,  $this->cookie);
            curl_setopt($this->curl, CURLOPT_COOKIEFILE, $this->cookie);
        }

        $this->result = curl_exec($this->curl);

        return $this;
    }

    function authorization()
    {
        curl_setopt($this->curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($this->curl, CURLOPT_USERPWD, "game:game1"); //Your credentials goes here

        return $this;
    }

    function getResult()
    {
    	curl_close($this->curl);

    	return $this->result;
    }
}