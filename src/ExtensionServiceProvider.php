<?php namespace Poppy\Extension\Alipay;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 * @return void
	 */
	public function boot()
	{
		// 加载的时候进行配置项的发布
		$this->publishes([
			__DIR__ . '/../config/alipay.php' => config_path('poppy-alipay.php'),
		], 'sour-lemon');
	}

	/**
	 * Register the service provider.
	 * @return void
	 */
	public function register()
	{
		// 配置文件合并
		$this->mergeConfigFrom(__DIR__ . '/../config/alipay.php', 'poppy-alipay');

		$this->app->singleton('poppy.ext-alipay.web-direct', function ($app) {
			$alipay = new Mapi\WebDirect\SdkPayment();
			/** @type ConfigRepository $config */
			$config = $app->config;
			$alipay->setPartner($config->get('poppy-alipay.partner_id'))
				->setSellerId($config->get('poppy-alipay.seller_id'))
				->setKey($config->get('poppy-alipay.web_direct_key'))
				->setSignType($config->get('poppy-alipay.web_direct_sign_type'))
				->setNotifyUrl($config->get('poppy-alipay.web_direct_notify_url'))
				->setReturnUrl($config->get('poppy-alipay.web_direct_return_url'))
				->setExterInvokeIp($app->request->getClientIp());

			return $alipay;
		});

		$this->app->singleton('poppy.ext-alipay.mobile', function ($app) {
			$alipay = new Mapi\Mobile\SdkPayment();

			$alipay->setPartner($app->config->get('poppy-alipay.partner_id'))
				->setSellerId($app->config->get('poppy-alipay.seller_id'))
				->setSignType($app->config->get('poppy-alipay.mobile_sign_type'))
				->setPrivateKeyPath($app->config->get('poppy-alipay.mobile_private_key_path'))
				->setPublicKeyPath($app->config->get('poppy-alipay.mobile_public_key_path'))
				->setNotifyUrl($app->config->get('poppy-alipay.mobile_notify_url'));

			return $alipay;
		});
	}

	/**
	 * Get the services provided by the provider.
	 * @return array
	 */
	public function provides()
	{
		return [
			'poppy.ext-alipay.web-direct',
			'poppy.ext-alipay.mobile',
		];
	}
}
