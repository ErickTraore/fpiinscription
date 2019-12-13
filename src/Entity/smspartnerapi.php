<?php

class SMSPartnerAPI
{
	const BASE_URL = 'http://api.smspartner.fr/v1/';
	public $debug;

	public function __construct($debug = false)
	{
		$this->setDebug($debug);
	}

	/**
	 * @param mixed $debug
	 */
	public function setDebug($debug)
	{
		$this->debug = $debug;
	}

	/**
	 * @return mixed
	 */
	public function getDebug()
	{
		return $this->debug;
	}

	public function checkCredits($params)
	{
		if (empty($params))
			return false;

		$result = $this->postRequest(self::BASE_URL.'me?'.$params);

		return $this->returnJson($result);
	}


	public function checkStatusByNumber($params)
	{
		if (empty($params))
			return false;

		$result = $this->postRequest(self::BASE_URL.'message-status?'.$params);
		return json_decode($result);
	}
	
	
	public function listStopNumber($params)
	{
		if (empty($params))
			return false;

		$result = $this->postRequest(self::BASE_URL.'stop-sms/list?'.$params);
		return $this->returnJson($result);
	}

	public function deleteStopNumber($params)
	{
		if (empty($params))
			return false;

		$result = $this->postRequest(self::BASE_URL.'stop-sms/delete?'.$params);
		return $this->returnJson($result);
	}
	
	public function addStopNumber($fields)
	{
		if (empty($fields))
			return false;

		$result = $this->postRequest(self::BASE_URL.'stop-sms/add', $fields);
		return $this->returnJson($result);
			
	}
	
	public function sendSms($fields)
	{
		if (empty($fields))
			return false;

		$result = $this->postRequest(self::BASE_URL.'send', $fields);
		return $this->returnJson($result);
	}

	/**
	 * Requête cURL - Vous n'êtes pas sensé appeler cette méthode
	 * @access private
	 *
	 */
	private function postRequest($url, $fields = array())
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		if (!empty($fields))
		{

			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
		}

		$result = curl_exec($curl);

		if ($result === false)
		{
			if ($this->debug)
				echo curl_error($curl);
			else
				$result = curl_error($curl);
		}
		else
			curl_close($curl);
		return $result;
	}

	private function returnJson($string)
	{
		$json_array = json_decode($string);
		if (is_null($json_array))
			return $string;
		else
			return $json_array;
	}
}
