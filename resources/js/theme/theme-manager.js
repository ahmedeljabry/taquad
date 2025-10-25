const THEME_STORAGE_KEY = 'taquad-theme-preference';
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
const rootElement = document.documentElement;

const themeLabels = {
    light: rootElement.dataset.themeLabelLight || 'Light mode',
    dark: rootElement.dataset.themeLabelDark || 'Dark mode',
    system: rootElement.dataset.themeLabelSystem || 'Match system',
    toggle: rootElement.dataset.themeLabelToggle || 'Toggle theme',
};

const ThemeManager = {
    preference: rootElement.dataset.themePreference || localStorage.getItem(THEME_STORAGE_KEY) || 'system',
    get effectiveTheme() {
        if (this.preference === 'system') {
            return prefersDark.matches ? 'dark' : 'light';
        }

        return this.preference;
    },
    apply(theme, persist = true) {
        this.preference = theme;
        const root = document.documentElement;

        const effective = this.effectiveTheme;

        root.dataset.themePreference = theme;
        root.dataset.theme = effective;

        root.classList.toggle('dark', effective === 'dark');

        if (persist) {
            try {
                localStorage.setItem(THEME_STORAGE_KEY, theme);
            } catch (_) {
            }
        }

        document.dispatchEvent(new CustomEvent('theme:changed', {
            detail: {
                preference: theme,
                effective,
            },
        }));
    },
    init() {
        this.apply(this.preference, false);

        prefersDark.addEventListener('change', () => {
            if (this.preference === 'system') {
                this.apply('system', false);
            }
        });
    },
};

ThemeManager.init();

window.ThemeManager = ThemeManager;

window.themeToggle = function themeToggle() {
    return {
        open: false,
        preference: ThemeManager.preference,
        effective: ThemeManager.effectiveTheme,
        options: [
            { value: 'light', label: themeLabels.light, icon: 'ph-sun-dim' },
            { value: 'dark', label: themeLabels.dark, icon: 'ph-moon-stars' },
            { value: 'system', label: themeLabels.system, icon: 'ph-monitor' },
        ],
        init() {
            document.addEventListener('theme:changed', (event) => {
                this.preference = event.detail.preference;
                this.effective = event.detail.effective;
            });
        },
        setTheme(theme) {
            ThemeManager.apply(theme);
            this.open = false;
        },
        currentIcon() {
            const current = this.options.find((option) => option.value === this.preference);
            if (current) {
                return current.icon;
            }

            return this.options[0].icon;
        },
        currentLabel() {
            const current = this.options.find((option) => option.value === this.preference);
            return current ? current.label : themeLabels.toggle;
        },
    };
};
