# `Skip` for Craft CMS
> Disables auto-reloading of [Twig](https://twig.symfony.com/) templates in production for [Craft CMS](https://craftcms.com/).

## Requirements

* Craft CMS 5.8.0 or later.
* PHP 8.2 or later.

## Installation

Install this plugin from the Plugin Store or via Composer.

#### Plugin Store

Go to the “Plugin Store” in your project’s Control Panel, search for
“skip” and click on the “Install” button in its modal window.

#### Composer

```sh
composer require somehow-digital/craft-skip
./craft plugin/install skip
```

## Configuration

Configuration is not available.

## Usage

Auto-reloading of Twig templates is disabled if at least one of the following conditions is met:

* [`Dev Mode`](https://craftcms.com/knowledge-base/what-dev-mode-does) is disabled.
* [`Ephemeral`](https://craftcms.com/docs/5.x/reference/config/bootstrap.html#craft-ephemeral) is enabled.
