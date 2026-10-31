<?php

namespace SomehowDigital\Craft\Skip\Tests;

use Craft;
use craft\web\Application;
use PHPUnit\Framework\TestCase as BaseTestCase;
use SomehowDigital\Craft\Skip\Tests\Support\App;
use yii\base\Event;
use yii\di\Container;

/**
 * Boots a fresh Craft app with the plugin for each test, without a database.
 */
abstract class TestCase extends BaseTestCase
{
	/** @var string[] names of the environment variables set by the test */
	private array $variables = [];

	protected function setUp(): void
	{
		parent::setUp();

		$this->createApp();
	}

	protected function tearDown(): void
	{
		foreach ($this->variables as $name) {
			unset($_SERVER[$name]);
		}

		Event::offAll();
		Craft::$app = null;
		Craft::$container = new Container();

		parent::tearDown();
	}

	/**
	 * Boots Craft, which the plugin reads the environment from when it initializes.
	 */
	protected function createApp(): Application
	{
		return App::create();
	}

	/**
	 * Sets environment variables, which are removed again after the test.
	 *
	 * @param array<string,string> $variables
	 */
	protected function env(array $variables): void
	{
		foreach ($variables as $name => $value) {
			$_SERVER[$name] = $value;
			$this->variables[] = $name;
		}
	}
}
