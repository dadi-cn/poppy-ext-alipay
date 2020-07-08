<?php namespace Poppy\Extension\Alipay\Tests\OpenApi;

use Exception;
use Poppy\Extension\Alipay\Aop\AopClient;
use Poppy\Extension\Alipay\OpenApi\Refund\Refund;
use Poppy\Framework\Application\TestCase;

class RefundTest extends TestCase
{
	private $env = 'sandbox';

	/**
	 * SandBox AppId
	 * @var string
	 */
	private $appId = '2016082100303692';

	private $rsaPrivateKey = 'MIIEoAIBAAKCAQEAqVzjJia99zbPJe6HSXQbusv3fmhPz8/jPDkXtE41ApexbMLNBkklLhMecm9p3NWuThV5We8qpdNfjfavLt+x1nreQJWolhlCVSnUzlSI72pgOtMH6mgfu71NFJz3wj6KHZ7MRPA7viJl55Mk8SCAHxkJZyz9s/fBMzmQeuMQ5PX/IDpJMUKMxwRm64O5SZ5Hbfi4y50En8cc+quDa9s7MuXGn3pAnD8UKh5Q6oktRFUvaQg4Gyed2FWol3eKRSitOxEzWpOwzRIbsjkVz0SheI513pIzKVF9oB51qIhW+SkiPEqPNwUiEul7bECWo8ut3LpQmXVkofGbVLei0MbkSQIDAQABAoIBADCbWRHlApZF47PWPnulWCQHT/O2illxJ51sIVJ9M5eX47L8QY1xRrtvf0iGk1Ju/USpwxc9nfbTsFP1HZgNWWPeBZVxnl3dx/zbMZk6B8b2t8GKOXZcBeeCz/F/j1fvTQJtReDvNaY/BxIsV+jgVAUY0WsMLZAOJiPGfKHYM0wSmlN0XfPsO4NyBDvfALNtzjIRbeqRouHf9d/4s3rXvBRSGCWNML50w0cix5S2EAMiG2y3Asu6zwZemFgw2b/zh40tqBhwIyS7JigHotGcqT7CntX5tzAOINWPNfP4bxYi0OwAdCQCh9IlyGT3g5JtdJRzBqqmuFNEMLmJRaPOAfUCgYEA2Qmbeha9KhOxSAIxM0KhSIACPazoYS5GLCc6l9cIKaMmE23XdYrsPUuM7kD/aqouhj4WM/ITZAS0k69A9kY4CMXc5NGB38pKUhon8CjGBtOW8oY6Ky13EKd92VkNeHpjvh/uLhslqeouvdBtX7OM5khRx0i6NU+Obg4kWv7qe7cCgYEAx8RLaXFagas0ozh9z48ZnDbaKF47YFYtCQ22pAYFKASiLCREC+Y50DAiiByXs3psXcEeJe6BON8bqWoKiQrHAEPBKH4mmvqcMc6l3wIrGwbNDcT5tUob/S3DHq7ba9idhmzjnIMuXyyyDL5bLRzKw3h8JcXDPhpfh4Rd9z6Zn/8CgYApoLgbcKUTnvdP0mvRYyRAHZ1QawufKBr5eQS5/tpn8gzpiRXcS6sIDqeXQww6Ty3hPaNQj0u80VI5SVHyaoFw3VKC6NQ6MjiTCsVCQO/Ke2bmWWxqv6uonBd9SqFUzFS5MLKkUTymHG6epY1036FUweY9jOt6MiolXb0HXwFmfQJ/G0+6/69/sDq395jBmp714WWebeZ0N7eQcKxvS/2GtvHrOh27L+VKAiySjAlctC0Io8jDVmxFPoFCRuc4iYPvsRmSTvbwUD/zGtwl0Vd6jTdg0YEcoqx/Jx4ajxdY6GW1I6u/cqZ8sIZr0VI1JPXKwu62CnP/PX5dkSmHr0XfuwKBgE8SCvkFT+gVTMg3mxe7XpcX+Fmy2Wo0wtCnkUsose4vqh2DmyiN7AUB2+TE2Le8f3Hjj+ru6yXUK0z31o+3yLua1XzVdaVKjTl5uvsvzqNwi33CCfK91dnx9I7Ap8nRdYW6181aoU3JCL4b24+h985L1/dZRf7zwyoxNLjN4vPm';

	private $rsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA3LqVQEmw38EBpZLFwaT2RFmziS3klluT7ekHfdda4t7q87MueVN2I+VBoE/XDTYZ67HZEHmOAFTxFYwAXWuWKczxo54Bg+SaWw+qWhWxrIz2dmbDCEsTfWVIncBnHGaMK9ZkAvs+waMap77WXTFsw9Ak3eSoeLkLkxfhzjEvk/elLyLThngfkfoKHegw5W5tcfjh5eWGHmRxTk5qVHTB6f9DEyBUqaLpu2kjX4TNoSTgDgnEBAeGE4SxY3FfYTj/Zo5blZxQ3H+IkjCDuV2C9y70CvtP8T8uPjddGq5mqV0XYSwv10rsyNW5VEiJSha4i4ESmsg2H2QUP/dT8J7Q0wIDAQAB';

	/**
	 * @throws Exception
	 */
	public function testRefund()
	{
		$aop = new AopClient();
		$aop->setEnv($this->env);
		// sandbox id : 2016082100303692
		$aop->setAppId($this->appId);

		// 私钥字串
		$aop->setRsaPrivateKey($this->rsaPrivateKey);
		// 请填写支付宝公钥，一行字符串
		$aop->setRsaPublicKey($this->rsaPublicKey);
		$request = new Refund();
		$data    = [
			'out_trade_no'    => 'CHARGE201802071553392532739',       // 商户订单号
			'trade_no'        => '2018020721001004370200326677',      // 支付宝交易号
			'refund_amount'   => 0.12,                               // 退款金额
			'refund_reason'   => '正常退款',                           // 退款原因
			'out_request_no'  => 'HZ01RF001',                         // 标识退款请求
			'operator_id'     => 'OP001',                             // 商户操作员编号
			'store_id'        => 'NJ_S_001',                          // 门店编号
			'terminal_id'     => 'NJ_T_001',                          // 终端编号
			'goods_detail'    => [                                    // 退款商品列表信息
				'goods_id'        => 'apple-01',                      //商品编号
				'alipay_goods_id' => '20010001',                      //支付宝定义的统一商品编号
				'goods_name'      => 'ipad',                          //商品名称
				'quantity'        => 1,                               //商品数量
				'price'           => 2000,                            // 商品单价
				'goods_category'  => '34543238',                      //商品类目
				'body'            => '特价手机',                       //商品描述信息
				'show_url'        => 'http://www.alipay.com/xxx.jpg', //商品的展示地址
			],
		];
		$request->setBizContent(json_encode($data));
		$result     = $aop->execute($request);

		dd($result);
		$resultCode = data_get($result, 'alipay_trade_refund_response.code');

		/**
		 *"alipay_trade_refund_response": {#648
		 *    "code": "10000"
		 *	 "msg": "Success"
		 *	 "buyer_logon_id": "rna***@sandbox.com"
		 *	 "buyer_user_id": "2088102175461375"
		 *	 "fund_change": "Y"
		 *	 "gmt_refund_pay": "2018-02-07 21:43:33"
		 *	 "out_trade_no": "CHARGE201802071553392532739"
		 *	 "refund_fee": "0.12"
		 *	 "send_back_fee": "0.00"
		 *	 "trade_no": "2018020721001004370200326677"
		 *    }
		 *+"sign": "xKIbVMuX45+zkF5hmPaWvbjG91M4cXSv7sg6mfr3u+LeYgVvEtrpGTiKzaisVxEXvIkw4fXtOBPc2b4ss6riVM9dfu3lHV2haLmmBHARQLdVG916xmSmAe/PmVTMs8S7ZPcyRZj3SBC/W9b/h1RtouJEHteuLIfahr6wuiADIyxpVGDzFPkaTg/VIjMytXGANdtbstsTykqgHXqPCaOqCGaol9F5Wc1Io9bb+50iGZzGU0Mm6ekIAe+BI2hutnfaOYc+I+96D2lcFTZo7ysBzhp07zV1gxha5D52ulAbXMDXheG15KgSaISal+918G4iewsml0Ral4tgXj3+Dvvf3g=="
		 */
		$this->assertEquals($resultCode, '10000');
	}
}