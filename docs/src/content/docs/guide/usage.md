---
title: Usage
description: When the plugin disables Twig auto-reloading.
---

The plugin has no settings. Auto-reloading of Twig templates is disabled when at least one of these conditions is met:

- [`devMode`](https://craftcms.com/knowledge-base/what-dev-mode-does) is disabled.
- [`CRAFT_EPHEMERAL`](https://craftcms.com/docs/5.x/reference/config/bootstrap.html#craft-ephemeral) is enabled.

This sets Twig's [`auto_reload`](https://symfony.com/doc/current/reference/configuration/twig.html#auto-reload) option to `false`. With it disabled, Twig no longer checks template files for changes on every request, which saves filesystem lookups. Clear the compiled templates on deploy so changes are picked up.
