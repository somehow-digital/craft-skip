<?php

namespace SomehowDigital\Craft\Skip;

use Craft;
use craft\base\Event;
use craft\base\Plugin;
use craft\web\View;

class Skip extends Plugin
{
	public function init(): void
	{
		parent::init();

		if (!Craft::$app->getConfig()->getGeneral()->devMode) {
			Event::on(
				View::class,
				View::EVENT_AFTER_CREATE_TWIG,
				function (Event $event) {
					$event->twig->disableAutoReload();
				}
			);
		}
	}
}
