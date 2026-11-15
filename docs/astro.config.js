import { unified } from '@astrojs/markdown-remark';
import starlight from '@astrojs/starlight';
import { defineConfig } from 'astro/config';

export default defineConfig({
	base: '/',
	// The default processor leaves the code blocks of Markdown pages without their highlighting styles.
	markdown: { processor: unified() },
	integrations: [
		starlight({
			components: {
				PageTitle: './src/components/page-title.astro',
				SiteTitle: './src/components/site-title.astro',
				ThemeProvider: './src/components/theme-provider.astro',
				ThemeSelect: './src/components/theme-select.astro',
			},
			customCss: ['./src/styles/custom.css'],
			logo: { alt: 'Skip', src: './src/assets/logo.svg' },
			// Do not set `themes`: a custom theme list also breaks the highlighting of Markdown pages.
			expressiveCode: {
				styleOverrides: {
					borderColor: '#2a2a2a',
					borderRadius: '0.125rem',
					codeBackground: '#141414',
				},
			},
			editLink: {
				baseUrl: 'https://github.com/somehow-digital/craft-skip/edit/main/docs/',
			},
			sidebar: [
				{
					label: 'Guide',
					items: ['guide/installation', 'guide/usage'],
				},
			],
			social: [
				{
					href: 'https://github.com/somehow-digital/craft-skip',
					icon: 'github',
					label: 'GitHub',
				},
			],
			title: 'Skip for Craft CMS',
		}),
	],
	output: 'static',
	prefetch: {
		defaultStrategy: 'tap',
		prefetchAll: true,
	},
	site: 'https://craft-skip.somehow-digital.dev',
	trailingSlash: 'always',
});
