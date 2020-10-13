<?php namespace Poppy\Extension\Alipay\Tests\Aop;

use Poppy\Extension\Alipay\Aop\Request\AlipayTradeAppPayRequest;
use Poppy\Extension\Alipay\Tests\AlipayBaseTest;
use Poppy\Framework\Helper\UtilHelper;

class TradeTest extends AlipayBaseTest
{
	public function testAppPay()
	{
		$aop = $this->client();

		$request = new AlipayTradeAppPayRequest();
		$request->setNotifyUrl('http://www.testdomain.com/abc/123');
		$amount = rand(1, 20) + round(0, 99) * 0.01;

		$data = [
			'out_trade_no'    => $this->genNo('SBAppPay'),
			'subject'         => '电竞 App 充值',
			'timeout_express' => '30m',
			'total_amount'    => UtilHelper::formatDecimal($amount),
			'product_code'    => 'QUICK_MSECURITY_PAY',
		];

		$request->setBizContent(json_encode($data));

		$app = $aop->sdkExecute($request);
		$this->assertIsString($app);
	}
}