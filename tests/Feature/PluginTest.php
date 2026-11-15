<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
use SomehowDigital\Craft\Skip\Skip;
use SomehowDigital\Craft\Skip\Tests\TestCase;
use Symfony\Component\Process\Process;

uses(TestCase::class);

it('keeps auto-reloading in dev mode', function (): void {
	Assert::assertTrue(Craft::$app->getView()->getTwig()->isAutoReload());
});

it('disables auto-reloading if ephemeral storage is used', function (): void {
	$this->env(['CRAFT_EPHEMERAL' => 'true']);
	$this->createApp();

	Assert::assertFalse(Craft::$app->getView()->getTwig()->isAutoReload());
});

it('disables auto-reloading outside of dev mode', function (): void {
	$process = new Process([PHP_BINARY, dirname(__DIR__) . '/Support/production.php']);
	$process->mustRun();

	Assert::assertSame('disabled', $process->getOutput());
});

it('runs the initialization of Craft', function (): void {
	$plugin = new class ('skip', Craft::$app) extends Skip {
		public bool $hasCpSettings = true;
	};

	Assert::assertTrue($plugin->hasReadOnlyCpSettings);
});
