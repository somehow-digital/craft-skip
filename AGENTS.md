# AGENTS.md

Twig template auto-reload plugin for Craft CMS 5 (PHP 8.2+).

## Code

- Design for real Craft behavior. Adapt tests to the architecture, not the other way around.
- Use code comments sparingly. Comment only what the code can't say, and keep the wording precise and concise.

## Checks

- Iterate with focused checks, e.g. `composer test -- --filter=…` or `composer phpstan`.
- Run `composer check` before finishing. It covers style, static analysis and tests.
- Auto-fix with `composer ecs-fix`.
- Never weaken a check to make it pass: no new ignores, baselines or lowered thresholds. Fix the cause.

## Git

- Commit only when asked.
- Use Conventional Commits, e.g. `fix: respect devMode when disabling auto-reload`.
- Don't add AI attribution such as co-author trailers or generated-by footers.
