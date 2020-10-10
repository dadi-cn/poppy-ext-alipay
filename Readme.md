# Alipay 在 Laravel 5 的封装包

## 安装

```
composer require poppy/ext-alipay 2.0
```

更新你的依赖包 `composer update` 或者全新安装 `composer install`

```
$Aop = new AopCertClient();
$Aop->setSignType('RSA2');
$Aop->setAppId('app-id');
$Aop->setRsaPrivateKey('one-line-private-key');
$Aop->setEnv('production-or-sandbox');
$Aop->setAlipayrsaPublicKey($Aop->getPublicKey($alipayCertPath));//调用getPublicKey从支付宝公钥证书中提取公钥
$Aop->setAppCertSN($Aop->getCertSN($appCertPath));//调用getCertSN获取证书序列号
$Aop->setAlipayRootCertSN($Aop->getRootCertSN($rootCertPath));//调用getRootCertSN获取支付宝根证书序列号
$Aop->setIsCheckAlipayPublicCert(true);
return $Aop;
```