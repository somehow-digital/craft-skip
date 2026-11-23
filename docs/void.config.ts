import { defineConfig } from 'void/config';

export default defineConfig({
	cloudflare: {
		compatibility_date: '2026-11-01',
		name: 'craft-skip',
		routes: [
			{ custom_domain: true, pattern: 'craft-skip.somehow-digital.dev' },
		],
	},
});
