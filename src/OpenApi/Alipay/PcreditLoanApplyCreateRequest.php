<?php namespace Poppy\Extension\Alipay\OpenApi\Alipay;



/**
 * ALIPAY API: alipay.pcredit.loan.apply.create request
 *
 * @author auto create
 * @since 1.0, 2016-08-25 10:32:50
 */
class PcreditLoanApplyCreateRequest
{
	/**
	 * 用户申贷
	 **/
	private $bizContent;

	private $apiParas = [];

	private $terminalType;

	private $terminalInfo;

	private $prodCode;

	private $apiVersion = '1.0';

	private $notifyUrl;

	private $returnUrl;

	private $needEncrypt = false;
	
	public function setBizContent($bizContent)
	{
		$this->bizContent              = $bizContent;
		$this->apiParas['biz_content'] = $bizContent;
	}

	public function getBizContent()
	{
		return $this->bizContent;
	}

	public function getApiMethodName()
	{
		return 'alipay.pcredit.loan.apply.create';
	}

	public function setNotifyUrl($notifyUrl)
	{
		$this->notifyUrl = $notifyUrl;
	}

	public function getNotifyUrl()
	{
		return $this->notifyUrl;
	}

	public function setReturnUrl($returnUrl)
	{
		$this->returnUrl = $returnUrl;
	}

	public function getReturnUrl()
	{
		return $this->returnUrl;
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function getTerminalType()
	{
		return $this->terminalType;
	}

	public function setTerminalType($terminalType)
	{
		$this->terminalType = $terminalType;
	}

	public function getTerminalInfo()
	{
		return $this->terminalInfo;
	}

	public function setTerminalInfo($terminalInfo)
	{
		$this->terminalInfo = $terminalInfo;
	}

	public function getProdCode()
	{
		return $this->prodCode;
	}

	public function setProdCode($prodCode)
	{
		$this->prodCode = $prodCode;
	}

	public function setApiVersion($apiVersion)
	{
		$this->apiVersion = $apiVersion;
	}

	public function getApiVersion()
	{
		return $this->apiVersion;
	}

  public function setNeedEncrypt($needEncrypt)
  {
	 $this->needEncrypt = $needEncrypt;
  }

  public function getNeedEncrypt()
  {
	return $this->needEncrypt;
  }
}