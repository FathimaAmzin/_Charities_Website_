/**
 * SDC International Charity - Theme & Multi-Language Translation Manager
 * - Dark Mode / Light Mode Toggle with Persistence
 * - Multi-Language (English, Tamil, Sinhala) Dynamic Instant Translator
 */

(function () {
    'use strict';

    // =========================================================================
    // 1. THEME MANAGER (Dark Mode / Light Mode)
    // =========================================================================
    const ThemeManager = {
        STORAGE_KEY: 'sdc_theme',

        init: function () {
            const savedTheme = localStorage.getItem(this.STORAGE_KEY) || 
                (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            this.applyTheme(savedTheme, false);
            this.bindEvents();
        },

        applyTheme: function (theme, animate) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem(this.STORAGE_KEY, theme);

            // Update all toggle buttons across header, topbar, mobile nav, admin topbar
            const toggleBtns = document.querySelectorAll('.theme-toggle-btn');
            toggleBtns.forEach(btn => {
                const moonIcon = btn.querySelector('.theme-icon-moon');
                const sunIcon = btn.querySelector('.theme-icon-sun');

                if (theme === 'dark') {
                    if (moonIcon) moonIcon.classList.add('d-none');
                    if (sunIcon) sunIcon.classList.remove('d-none');
                    btn.setAttribute('title', 'Switch to Light Mode');
                    btn.setAttribute('aria-label', 'Switch to Light Mode');
                } else {
                    if (moonIcon) moonIcon.classList.remove('d-none');
                    if (sunIcon) sunIcon.classList.add('d-none');
                    btn.setAttribute('title', 'Switch to Dark Mode');
                    btn.setAttribute('aria-label', 'Switch to Dark Mode');
                }
            });

            // Dispatch event for any other custom component
            window.dispatchEvent(new CustomEvent('sdcThemeChanged', { detail: { theme: theme } }));
        },

        toggle: function () {
            const current = document.documentElement.getAttribute('data-theme') || 'light';
            const next = current === 'dark' ? 'light' : 'dark';
            this.applyTheme(next, true);
        },

        bindEvents: function () {
            document.addEventListener('click', function (e) {
                const btn = e.target.closest('.theme-toggle-btn');
                if (btn) {
                    e.preventDefault();
                    ThemeManager.toggle();
                }
            });

            // Listen for OS theme changes if user has not explicitly chosen
            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    if (!localStorage.getItem(ThemeManager.STORAGE_KEY)) {
                        ThemeManager.applyTheme(e.matches ? 'dark' : 'light', true);
                    }
                });
            }
        }
    };

    // =========================================================================
    // 2. MULTI-LANGUAGE MANAGER (English, Tamil, Sinhala)
    // =========================================================================
    const LangManager = {
        STORAGE_KEY_CODE: 'sdc_lang',
        STORAGE_KEY_FLAG: 'sdc_lang_flag',
        STORAGE_KEY_NAME: 'sdc_lang_name',

        LANGUAGES: {
            'en': { flag: '🇬🇧', name: 'English', native: 'English' },
            'ta': { flag: '🇱🇰', name: 'தமிழ்', native: 'Tamil' },
            'si': { flag: '🇱🇰', name: 'සිංහල', native: 'Sinhala' }
        },

        init: function () {
            // Check cookie or localStorage
            let currentLang = localStorage.getItem(this.STORAGE_KEY_CODE);
            if (!currentLang) {
                const cookieMatch = document.cookie.match(/googtrans=\/en\/([a-z]{2})/i);
                currentLang = (cookieMatch && cookieMatch[1]) ? cookieMatch[1].toLowerCase() : 'en';
            }

            if (!this.LANGUAGES[currentLang]) {
                currentLang = 'en';
            }

            const langMeta = this.LANGUAGES[currentLang];
            this.updateUI(currentLang, langMeta.flag, langMeta.name);

            // Setup Google Translate element
            this.setupGoogleTranslate();
        },

        setupGoogleTranslate: function () {
            // Ensure container exists
            let container = document.getElementById('google_translate_element');
            if (!container) {
                container = document.createElement('div');
                container.id = 'google_translate_element';
                container.style.display = 'none';
                document.body.appendChild(container);
            }

            // Expose global initializer
            window.googleTranslateElementInit = function () {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'en,ta,si',
                    autoDisplay: false
                }, 'google_translate_element');
            };

            // Load Google Translate script if not already loaded
            if (!document.getElementById('google-translate-script')) {
                const script = document.createElement('script');
                script.id = 'google-translate-script';
                script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
                script.async = true;
                document.body.appendChild(script);
            }
        },

        updateUI: function (code, flag, name) {
            // Update all flag and name indicators across the page
            document.querySelectorAll('.current-lang-flag').forEach(el => el.textContent = flag);
            document.querySelectorAll('.current-lang-name').forEach(el => el.textContent = name);

            // Update active checkmarks in dropdowns
            document.querySelectorAll('.lang-check').forEach(icon => {
                if (icon.getAttribute('data-lang') === code) {
                    icon.classList.remove('d-none');
                } else {
                    icon.classList.add('d-none');
                }
            });

            // Update dropdown item active class
            document.querySelectorAll('[data-lang-select]').forEach(btn => {
                if (btn.getAttribute('data-lang-select') === code) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        },

        setLanguage: function (code) {
            if (!this.LANGUAGES[code]) return;
            const lang = this.LANGUAGES[code];

            localStorage.setItem(this.STORAGE_KEY_CODE, code);
            localStorage.setItem(this.STORAGE_KEY_FLAG, lang.flag);
            localStorage.setItem(this.STORAGE_KEY_NAME, lang.name);

            this.updateUI(code, lang.flag, lang.name);

            // Set cookie for Google Translate
            const hostname = window.location.hostname;
            const cookieVal = code === 'en' ? '/en/en' : `/en/${code}`;

            document.cookie = `googtrans=${cookieVal}; path=/;`;
            document.cookie = `googtrans=${cookieVal}; path=/; domain=${hostname};`;
            if (hostname.split('.').length > 1) {
                const rootDomain = '.' + hostname.split('.').slice(-2).join('.');
                document.cookie = `googtrans=${cookieVal}; path=/; domain=${rootDomain};`;
            }

            // Trigger Google Translate dropdown change
            const selectEl = document.querySelector('.goog-te-combo');
            if (selectEl) {
                selectEl.value = code;
                selectEl.dispatchEvent(new Event('change'));
            } else {
                window.location.reload();
            }
        }
    };

    // Global helper for HTML buttons
    window.sdcChangeLanguage = function (code) {
        LangManager.setLanguage(code);
    };

    // =========================================================================
    // 3. INITIALIZATION ON DOM READY
    // =========================================================================
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            ThemeManager.init();
            LangManager.init();
        });
    } else {
        ThemeManager.init();
        LangManager.init();
    }
})();

