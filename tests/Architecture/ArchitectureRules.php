<?php

declare(strict_types=1);

namespace SomehowDigital\Craft\Skip\Tests\Architecture;

use craft\base\Plugin;
use PHPat\Selector\Selector;
use PHPat\Selector\SelectorInterface;
use PHPat\Test\Attributes\TestRule;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

/**
 * What the plugin consists of. Dependencies between layers are in deptrac.yaml.
 */
final class ArchitectureRules
{
	private const PLUGIN = 'SomehowDigital\Craft\Skip';

	#[TestRule]
	public function thePluginIsACraftPlugin(): Rule
	{
		return PHPat::rule()
			->classes(Selector::classname(self::PLUGIN . '\Skip'))
			->should()->extend()
			->classes(Selector::classname(Plugin::class))
			->because('The plugin is the class that Craft loads the plugin through.');
	}

	#[TestRule]
	public function thePluginIsTheOnlyClass(): Rule
	{
		return PHPat::rule()
			->classes($this->plugin())
			->excluding(Selector::classname(self::PLUGIN . '\Skip'))
			->shouldNot()->exist()
			->because('The plugin only registers a handler, so any other class belongs to a layer in deptrac.yaml first.');
	}

	private function plugin(): SelectorInterface
	{
		return Selector::AllOf(
			Selector::inNamespace(self::PLUGIN),
			Selector::Not(Selector::inNamespace(self::PLUGIN . '\Tests')),
		);
	}
}
