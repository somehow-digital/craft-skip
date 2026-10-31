<?php

use Symfony\Component\Process\Process;

it('keeps auto-reloading in dev mode', function () {
	expect(Craft::$app->getView()->getTwig()->isAutoReload())->toBeTrue();
});

it('disables auto-reloading if ephemeral storage is used', function () {
	$this->env(['CRAFT_EPHEMERAL' => 'true']);
	$this->createApp();

	expect(Craft::$app->getView()->getTwig()->isAutoReload())->toBeFalse();
});

it('disables auto-reloading outside of dev mode', function () {
	$process = new Process([PHP_BINARY, dirname(__DIR__) . '/Support/production.php']);
	$process->mustRun();

	expect($process->getOutput())->toBe('disabled');
});
