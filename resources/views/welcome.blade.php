<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ugarit') }} - The Independent Web Framework</title>

    <style>
        :root {
            --color-mist: #F5F5F5;
            --color-white: #FFFFFF;
            --color-ink: #16211C;
            --color-graphite: #333333;
            --color-muted: #666666;
            --color-green: #14A800;
            --color-green-hover: #118C00;
            --color-green-wash: #EAF6E8;
            --color-border: #E5E7EB;
            --radius-md: 10px;
            --radius-lg: 16px;
            --font-family: 'IBM Plex Sans Arabic', 'IBM Plex Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            --font-mono: 'IBM Plex Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--color-mist);
            color: var(--color-graphite);
            font-family: var(--font-family);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2.5rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background-color: var(--color-green-wash);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-green);
            font-weight: 700;
            font-size: 1.25rem;
            border: 1px solid rgba(20, 168, 0, 0.2);
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-ink);
            letter-spacing: -0.02em;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.75rem;
            background-color: var(--color-green-wash);
            color: var(--color-green);
            border-radius: 9999px;
            font-size: 0.8125rem;
            font-weight: 600;
            border: 1px solid rgba(20, 168, 0, 0.25);
        }

        .hero {
            background: var(--color-white);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-lg);
            padding: 3rem 2.5rem;
            box-shadow: 0 4px 20px -2px rgba(22, 33, 28, 0.05);
            margin-bottom: 2rem;
            text-align: center;
        }

        .hero h1 {
            color: var(--color-ink);
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.25;
        }

        .hero p {
            color: var(--color-graphite);
            font-size: 1.125rem;
            max-width: 680px;
            margin: 0 auto 1.75rem auto;
        }

        .terminal-box {
            background: #111814;
            color: #A3E635;
            font-family: var(--font-mono);
            padding: 0.85rem 1.25rem;
            border-radius: var(--radius-md);
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            direction: ltr;
            font-size: 0.9375rem;
            user-select: all;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.3);
        }

        .terminal-prompt {
            color: #65A30D;
            user-select: none;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .card {
            background: var(--color-white);
            border: 1px solid var(--color-border);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            border-color: var(--color-green);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -4px rgba(20, 168, 0, 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .card-icon {
            width: 36px;
            height: 36px;
            background: var(--color-green-wash);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-green);
            font-weight: 700;
        }

        .card-title {
            color: var(--color-ink);
            font-size: 1.0625rem;
            font-weight: 600;
        }

        .card-desc {
            color: var(--color-muted);
            font-size: 0.875rem;
            line-height: 1.5;
        }

        footer {
            border-top: 1px solid var(--color-border);
            padding: 1.5rem 0;
            text-align: center;
            color: var(--color-muted);
            font-size: 0.875rem;
            background: var(--color-white);
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-badge {
            color: var(--color-graphite);
            font-family: var(--font-mono);
            font-size: 0.8125rem;
        }

        @media (max-width: 640px) {
            .hero {
                padding: 2rem 1.25rem;
            }
            .hero h1 {
                font-size: 1.75rem;
            }
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="/" class="brand">
                <div class="brand-icon">U</div>
                <div class="brand-name">أوغاريت <span style="font-size: 0.875rem; font-weight: 400; color: var(--color-muted);">Ugarit</span></div>
            </a>
            <span class="badge">النواة الرسمية • Core v1.01.00</span>
        </header>

        <main>
            <div class="hero">
                <h1>إطار أوغاريت لتطوير تطبيقات الويب</h1>
                <p>
                    بيئة عمل عربية مستقلة وعالية الأداء مبنية للمطورين المحترفين، بنظام تصميم متزن ومعمارية معتمدة وموجهة بالكامل.
                </p>
                <div class="terminal-box">
                    <span class="terminal-prompt">$</span>
                    <span>php scribe dev</span>
                </div>
            </div>

            <div class="grid">
                <div class="card">
                    <div>
                        <div class="card-header">
                            <div class="card-icon">⚡</div>
                            <div class="card-title">سطر الأوامر Scribe</div>
                        </div>
                        <div class="card-desc">
                            محرك سطر أوامر قوي ومتكامل لإدارة التطبيقات وتوليد المكونات وتشغيل خوادم التطوير.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="card-header">
                            <div class="card-icon">🧪</div>
                            <div class="card-title">اختبارات Pest</div>
                        </div>
                        <div class="card-desc">
                            منظومة اختبارات مدمجة ومجهزة مسبقاً عبر حزمة <code>pest-plugin-ugarit</code> الرسمية.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="card-header">
                            <div class="card-icon">🏛️</div>
                            <div class="card-title">معمارية الأرتيفاكت ADA</div>
                        </div>
                        <div class="card-desc">
                            فصل مجالات الأعمال وسلسلة التدفق المعماري بين القدرات، التدفقات، والمستودعات.
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <div class="container" style="padding-top: 0; padding-bottom: 0;">
            <div class="footer-content">
                <div>
                    رؤية وتطوير: <strong>معاذ أبو عودة (Muath R Abu Ouda)</strong> &copy; {{ date('Y') }}
                </div>
                <div class="footer-badge">
                    PHP v{{ PHP_VERSION }} • Ugarit v{{ Heritage\Foundation\Application::VERSION ?? '1.04.01' }}
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
