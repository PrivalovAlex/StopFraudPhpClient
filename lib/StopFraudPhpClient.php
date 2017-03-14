<?php

class StopFraudPhpClient
{

	/**
	 *
	 * @var string
	 */
	protected $token;

	/**
	 *
	 * @var string
	 */
	protected $endpoint = 'https://stopfraud.io/api/v1/';

	function __construct($token)
	{
		$this->setToken($token);
	}

	/**
	 * 
	 * @return string
	 */
	function getToken()
	{
		return $this->token;
	}

	/**
	 * 
	 * @param string $token
	 */
	function setToken($token)
	{
		$this->token = $token;
	}

	/**
	 * 
	 * @param string $type
	 * @param array $data
	 * @return array
	 */
	public function checkData($type, array $data)
	{
		return $this->_send('check', array(
					'type' => $type,
					'data' => json_encode($data),
		));
	}

	/**
	 * 
	 * @param array $data
	 * @return array
	 */
	public function addFraudster(array $data)
	{
		return $this->_send('add_fraudster', array(
					'data' => json_encode($data),
		));
	}

	/**
	 * 
	 * @param type $method
	 * @param array $params
	 * @return array
	 */
	protected function _send($method, array $params = array())
	{
		$params['token'] = $this->getToken();
		$ch = curl_init($this->endpoint . $method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result, true);
	}

}
