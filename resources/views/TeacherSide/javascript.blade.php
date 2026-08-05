<script>

    const avatar = document.getElementById("avatarToggle");
    const dropdown = document.getElementById("navDropdown");

    avatar.addEventListener("click", () => {
        dropdown.style.display =
            dropdown.style.display === "block" ? "none" : "block";
    });

    // close when clicking outside
    document.addEventListener("click", function(e) {
        if (!avatar.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = "none";
        }
    });



        // const defaultConfig = {
        //     site_title: 'Dashboard',
        //     welcome_heading: 'Welcome back, John',
        //     welcome_text: "Here's what's happening with your projects today.",
        //     footer_text: '© 2025 Dashboard — Built with care.',
        //     background_color: '#edf2f7',
        //     surface_color: '#ffffff',
        //     text_color: '#1e3a5f',
        //     primary_action_color: '#2c6fba',
        //     secondary_action_color: '#7aa3cc',
        //     font_family: 'DM Sans',
        //     font_size: 14
        // };

        function applyConfig(config) {
            const c = key => config[key] || defaultConfig[key];

            document.getElementById('sidebarBrand').textContent = c('site_title');
            // document.getElementById('welcomeHeading').textContent = c('welcome_heading');
            document.getElementById('welcomeText').textContent = c('welcome_text');
            document.getElementById('footerText').textContent = c('footer_text');

            const root = document.documentElement;
            const wrapper = document.querySelector('.app-wrapper');
            wrapper.style.background = c('background_color');

            document.querySelectorAll('.stat-card, .section-card, .top-bar').forEach(el => {
                el.style.background = c('surface_color');
            });

            document.querySelectorAll('.stat-value, .section-card h2, .top-bar-title').forEach(el => {
                el.style.color = c('text_color');
            });

            document.querySelectorAll('.nav-item.active, .activity-dot').forEach(el => {
                el.style.background = c('primary_action_color');
            });
            document.querySelector('.welcome-card').style.background =
                `linear-gradient(135deg, ${c('primary_action_color')} 0%, ${c('text_color')} 100%)`;
            document.querySelector('.avatar').style.background = c('primary_action_color');

            document.querySelectorAll('.sidebar-brand').forEach(el => el.style.borderBottomColor = c('secondary_action_color') + '22');

            const font = c('font_family');
            const baseSize = c('font_size');
            const stack = `${font}, sans-serif`;
            document.body.style.fontFamily = stack;
            document.querySelector('.welcome-card h1').style.fontSize = `${baseSize * 1.7}px`;
            document.querySelector('.welcome-card p').style.fontSize = `${baseSize}px`;
            document.querySelectorAll('.stat-value').forEach(el => el.style.fontSize = `${baseSize * 2}px`);
            document.querySelectorAll('.stat-label').forEach(el => el.style.fontSize = `${baseSize * 0.85}px`);
        }

        if (window.elementSdk && typeof window.elementSdk.init === 'function') {
            window.elementSdk.init({
                defaultConfig,
                onConfigChange: async (config) => applyConfig(config),
                mapToCapabilities: (config) => {
                    const color = (key) => ({
                        get: () => config[key] || defaultConfig[key],
                        set: (v) => { config[key] = v; window.elementSdk.setConfig({ [key]: v }); }
                    });
                    return {
                        recolorables: [
                            color('background_color'),
                            color('surface_color'),
                            color('text_color'),
                            color('primary_action_color'),
                            color('secondary_action_color')
                        ],
                        borderables: [],
                        fontEditable: {
                            get: () => config.font_family || defaultConfig.font_family,
                            set: (v) => { config.font_family = v; window.elementSdk.setConfig({ font_family: v }); }
                        },
                        fontSizeable: {
                            get: () => config.font_size || defaultConfig.font_size,
                            set: (v) => { config.font_size = v; window.elementSdk.setConfig({ font_size: v }); }
                        }
                    };
                },
                mapToEditPanelValues: (config) => new Map([
                    ['site_title', config.site_title || defaultConfig.site_title],
                    ['welcome_heading', config.welcome_heading || defaultConfig.welcome_heading],
                    ['welcome_text', config.welcome_text || defaultConfig.welcome_text],
                    ['footer_text', config.footer_text || defaultConfig.footer_text]
                ])
            });
        } else {
            applyConfig(defaultConfig);
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.querySelector('.sidebar');
        if (mobileMenuBtn && sidebar) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-open');
            });
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', () => {
                    sidebar.classList.remove('mobile-open');
                });
            });
        }

       
    </script>
    <script>(function () { function c() { var b = a.contentDocument || a.contentWindow.document; if (b) { var d = b.createElement('script'); d.innerHTML = "window.__CF$cv$params={r:'9e474077b3f70707',t:'MTc3NDg3NTE1MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"; b.getElementsByTagName('head')[0].appendChild(d) } } if (document.body) { var a = document.createElement('iframe'); a.height = 1; a.width = 1; a.style.position = 'absolute'; a.style.top = 0; a.style.left = 0; a.style.border = 'none'; a.style.visibility = 'hidden'; document.body.appendChild(a); if ('loading' !== document.readyState) c(); else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c); else { var e = document.onreadystatechange || function () { }; document.onreadystatechange = function (b) { e(b); 'loading' !== document.readyState && (document.onreadystatechange = e, c()) } } } })();</script>
