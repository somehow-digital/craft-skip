<?php

declare(strict_types=1);

namespace SomehowDigital\Craft\Skip\Tests\Support;

use Craft;
use craft\helpers\ArrayHelper;
use craft\services\Config;
use craft\web\Application;
use SomehowDigital\Craft\Skip\Skip;
use yii\base\Event;
use yii\caching\ArrayCache;
use yii\di\Container;

/**
 * Boots Craft with the plugin, without a database.
 */
class App
{
	public static function create(): Application
	{
		Event::offAll();
		Craft::$container = new Container();

		$src = CRAFT_VENDOR_PATH . '/craftcms/cms/src';

		$configService = new Config();
		$configService->appType = 'web';
		$configService->env = 'test';
		$configService->configDir = Craft::getAlias('@config');
		$configService->appDefaultsDir = "{$src}/config/defaults";

		$config = ArrayHelper::merge(
			['vendorPath' => CRAFT_VENDOR_PATH, 'env' => 'test', 'components' => ['config' => $configService]],
			require "{$src}/config/app.php",
			require "{$src}/config/app.web.php",
			[
				'isInstalled' => false,
				'components' => [
					'log' => ['targets' => []],
					'cache' => ['class' => ArrayCache::class],
				],
			],
		);

		unset($config['class']);
		$app = new Application($config);

		// Tests run on the command line, which requests take for console requests.
		$app->getRequest()->setIsConsoleRequest(false);

		$plugin = new Skip('skip', $app, ['basePath' => dirname(__DIR__, 2) . '/src']);

		Skip::setInstance($plugin);
		$app->setModule('skip', $plugin);

		return $app;
	}
}
