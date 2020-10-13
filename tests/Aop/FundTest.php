<?php namespace Poppy\Extension\Alipay\Tests\Aop;

use Exception;
use Poppy\Extension\Alipay\Aop\Request\AlipayFundTransToaccountTransferRequest;
use Poppy\Extension\Alipay\Tests\AlipayBaseTest;

class FundTest extends AlipayBaseTest
{
	/**
	 * @throws Exception
	 */
	public function testTransToAccountTransfer()
	{
		$aop     = $this->client();
		$request = new AlipayFundTransToaccountTransferRequest();
		$data    = [
			'out_biz_no'      => $this->genNo('SandboxFundTrans'),
			'payee_type'      => 'ALIPAY_LOGONID',
			'payee_account'   => $this->userAccount,
			'amount'          => rand(1, 20) / 10,
			'payer_show_name' => '商户转账',
			'payee_real_name' => $this->userName,
			'remark'          => '转账备注',
		];
		$request->setBizContent(json_encode($data));
		$result = $aop->execute($request);

		$resp       = data_get($result, 'alipay_fund_trans_toaccount_transfer_response');
		$resultCode = data_get($resp, 'code');

		/**
		 * "alipay_fund_trans_toaccount_transfer_response": {#469 ▼
		 *     "code": "10000"
		 *     "msg": "Success"
		 *     "order_id": "20180101110070001502280000078438"
		 *     "out_biz_no": "3142321423432"
		 *     "pay_date": "2018-01-01 16:08:04"
		 * }
		 */
		if ($resultCode === '10000') {
			$msg = data_get($resp, 'msg');
		}
		else {
			$msg = data_get($resp, 'sub_msg');
		}
		$this->assertEquals('10000', $resultCode, $msg);
	}
}