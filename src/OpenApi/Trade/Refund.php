<?php namespace Poppy\Extension\Alipay\OpenApi\Trade;

use Poppy\Extension\Alipay\OpenApi\Alipay\TradeRefundRequest;
use Poppy\Extension\Alipay\OpenApi\Request;

/**
 * ALIPAY API: alipay.trade.refund request
 *
 * @author auto create
 * @since  1.0, 2016-12-06 16:07:23
 * @url https://docs.open.alipay.com/api_1/alipay.trade.refund/
 * @deprecated
 * @see    TradeRefundRequest
 */
class Refund extends Request
{
	/**
	 * 统一收单交易退款接口
	 **/
	private $bizContent;

	protected $apiVersion = '1.0';

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
		return 'alipay.trade.refund';
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
