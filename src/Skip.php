<?php

namespace SomehowDigital\Craft\Skip;

use craft\base\Event;
use craft\base\Plugin;
use craft\events\CreateTwigEvent;
use craft\helpers\App;
use craft\web\View;

class Skip extends Plugin
{
	public function init(): void
	{
		parent::init();

		if (!App::devMode() || App::isEphemeral()) {
			Event::on(
				View::class,
				View::EVENT_AFTER_CREATE_TWIG,
				function (CreateTwigEvent $event) {
					$event->twig->disableAutoReload();
				}
			);
		}
	}
}
