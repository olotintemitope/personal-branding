<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Temitope Olotin — Senior Software Engineer & AI Consultant | Lagos, Nigeria</title>
    <meta name="description" content="Temitope Olotin helps startups and enterprises ship AI-powered products faster. 10+ years building production-grade web apps, APIs, and intelligent automation — from Lagos to the world.">
    <meta name="keywords" content="AI consultant Lagos, hire Laravel developer, AI automation consultant, MVP development, startup CTO, remote software engineer Nigeria, LangChain developer, API architect">
    <meta name="author" content="Temitope Olotin">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Temitope Olotin — Senior Software Engineer & AI Consultant">
    <meta property="og:description" content="Ship your AI-powered product faster. 10+ years of battle-tested engineering for startups and enterprises — from MVP to scale.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="Temitope Olotin">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@@laztopaz_">
    <meta name="twitter:creator" content="@@laztopaz_">
    <meta name="twitter:title" content="Temitope Olotin — Senior Software Engineer & AI Consultant">
    <meta name="twitter:description" content="Ship your AI-powered product faster. 10+ years of battle-tested engineering for startups and enterprises.">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts: Syne (display) + Plus Jakarta Sans (body) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|syne:600,700,800" as="style">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|syne:600,700,800" rel="stylesheet" />

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Person",
        "name": "Temitope Olotin",
        "jobTitle": "Senior Software Engineer & AI Consultant",
        "url": "{{ url('/') }}",
        "sameAs": [
            "https://www.linkedin.com/in/olotin-temitope-53b43272/",
            "https://github.com/olotintemitope",
            "https://x.com/laztopaz_"
        ],
        "knowsAbout": ["Artificial Intelligence", "Machine Learning", "Laravel", "PHP", "Web Development", "API Architecture", "Data Analytics"],
        "alumniOf": [
            {
                "@@type": "EducationalOrganization",
                "name": "Ambrose Alli University, Ekpoma"
            },
            {
                "@@type": "EducationalOrganization",
                "name": "The Federal Polytechnic, Ado-Ekiti"
            }
        ],
        "address": {
            "@@type": "PostalAddress",
            "addressCountry": "NG",
            "addressRegion": "Lagos"
        }
    }
    </script>

    <!-- FAQ Structured Data -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "FAQPage",
        "mainEntity": [
            {
                "@@type": "Question",
                "name": "How quickly can you start on my project?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Most projects kick off within 1-2 weeks of the discovery call. For urgent needs, work can start within 48 hours depending on current availability."
                }
            },
            {
                "@@type": "Question",
                "name": "Do you work with startups or just enterprises?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Both. The sweet spot is founders who need their MVP shipped fast and enterprises scaling existing products. The approach adapts, but the engineering standards don't."
                }
            },
            {
                "@@type": "Question",
                "name": "Do you take equity instead of payment?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "No. Fair, transparent rates are charged for production-grade work. Pricing is startup-friendly — senior-level engineering without the Silicon Valley price tag."
                }
            },
            {
                "@@type": "Question",
                "name": "Can you integrate AI into my existing application?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Yes. Specializing in retrofitting AI into existing systems — intelligent automation with n8n and Zapier, custom AI agents with LangChain, or LLM integration for document processing."
                }
            },
            {
                "@@type": "Question",
                "name": "What happens after the project is delivered?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Every Full Build includes 30 days of post-launch support. After that, many clients move to a monthly retainer. You own 100% of the source code and documentation either way."
                }
            },
            {
                "@@type": "Question",
                "name": "What timezone do you work in?",
                "acceptedAnswer": {
                    "@@type": "Answer",
                    "text": "Based in Lagos, Nigeria (WAT / GMT+1), with over a decade of experience working with teams across Canada, New York, London, and Belgium. Flexible scheduling overlaps with North American and European business hours."
                }
            }
        ]
    }
    </script>

    <style>
        /* ── Reset & Base ────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; line-height: 1.6; }
        a { color: inherit; text-decoration: none; }
        ul, ol { list-style: none; }
        img, svg { display: block; max-width: 100%; }
        button { font: inherit; cursor: pointer; border: none; background: none; }

        /* ── Brand Variables ─────────────────────────────────── */
        :root {
            --brand-50: #eff6ff;
            --brand-100: #dbeafe;
            --brand-200: #bfdbfe;
            --brand-300: #93c5fd;
            --brand-400: #60a5fa;
            --brand-500: #3b82f6;
            --brand-600: #2563eb;
            --brand-700: #1d4ed8;
            --brand-800: #1e40af;
            --brand-900: #1e3a8a;
            --brand-950: #0c1a4a;

            --navy-950: #060b18;
            --navy-900: #0a1128;
            --navy-800: #0f1a3c;
            --navy-700: #162455;
            --navy-600: #1e2f6e;

            --surface-primary: var(--navy-950);
            --surface-secondary: #0d1424;
            --surface-card: rgba(15, 26, 60, 0.5);
            --surface-card-hover: rgba(30, 47, 110, 0.3);

            --text-primary: #f0f4ff;
            --text-secondary: #94a3c8;
            --text-tertiary: #5b6b8a;

            --border-subtle: rgba(59, 130, 246, 0.12);
            --border-accent: rgba(59, 130, 246, 0.3);

            --glow-blue: rgba(59, 130, 246, 0.15);
            --glow-blue-strong: rgba(59, 130, 246, 0.25);
        }

        /* ── Global Background ───────────────────────────────── */
        body {
            background: var(--navy-950);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ── Utility Classes ─────────────────────────────────── */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        @media (min-width: 768px) { .container { padding: 0 2.5rem; } }
        @media (min-width: 1024px) { .container { padding: 0 3rem; } }

        .section-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--brand-400);
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .section-label::before {
            content: '';
            display: block;
            width: 2rem;
            height: 1px;
            background: var(--brand-500);
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 700;
            line-height: 1.15;
            color: var(--text-primary);
            margin-bottom: 1.25rem;
        }

        .section-desc {
            font-size: 1.05rem;
            line-height: 1.7;
            color: var(--text-secondary);
            max-width: 600px;
        }

        /* ── Scroll Animation ────────────────────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* ── Navigation ──────────────────────────────────────── */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 1.25rem 0;
            transition: background 0.35s, backdrop-filter 0.35s, box-shadow 0.35s;
        }
        .site-nav.scrolled {
            background: rgba(6, 11, 24, 0.85);
            backdrop-filter: blur(16px) saturate(1.4);
            -webkit-backdrop-filter: blur(16px) saturate(1.4);
            box-shadow: 0 1px 0 var(--border-subtle);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-logo {
            display: inline-flex;
            align-items: center;
            height: 40px;
        }
        .nav-logo svg {
            height: 38px;
            width: auto;
        }
        .nav-links {
            display: none;
            align-items: center;
            gap: 2rem;
        }
        @media (min-width: 768px) { .nav-links { display: flex; } }
        .nav-links a {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: color 0.2s;
            position: relative;
        }
        .nav-links a:hover { color: var(--text-primary); }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--brand-500);
            transition: width 0.25s ease;
        }
        .nav-links a:hover::after { width: 100%; }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .nav-auth a {
            font-size: 0.8125rem;
            font-weight: 500;
            padding: 0.45rem 1.1rem;
            border-radius: 6px;
            transition: all 0.2s;
            color: var(--text-secondary);
        }
        .nav-auth a:hover { color: var(--text-primary); }
        .nav-auth .nav-cta {
            background: var(--brand-600);
            color: #fff;
            border: 1px solid var(--brand-500);
        }
        .nav-auth .nav-cta:hover {
            background: var(--brand-500);
            box-shadow: 0 0 20px var(--glow-blue);
        }

        /* Mobile menu */
        .mobile-toggle {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 4px;
        }
        .mobile-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--text-secondary);
            transition: all 0.3s;
            border-radius: 1px;
        }
        @media (min-width: 768px) { .mobile-toggle { display: none; } }
        .mobile-menu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 99;
            background: rgba(6, 11, 24, 0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
        }
        .mobile-menu.active { display: flex; }
        .mobile-menu a {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-secondary);
            transition: color 0.2s;
        }
        .mobile-menu a:hover { color: var(--brand-400); }
        .mobile-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.75rem;
            color: var(--text-secondary);
            cursor: pointer;
            background: none;
            border: none;
            font-family: inherit;
        }

        /* ── Hero Section ────────────────────────────────────── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            padding: 8rem 0 6rem;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, var(--glow-blue-strong) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse-glow 6s ease-in-out infinite;
        }
        .hero-bg::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -15%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(30, 64, 175, 0.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse-glow 8s ease-in-out infinite 2s;
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }

        /* Geometric grid pattern */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(var(--border-subtle) 1px, transparent 1px),
                linear-gradient(90deg, var(--border-subtle) 1px, transparent 1px);
            background-size: 80px 80px;
            mask-image: radial-gradient(ellipse 60% 60% at 50% 30%, black 20%, transparent 70%);
            -webkit-mask-image: radial-gradient(ellipse 60% 60% at 50% 30%, black 20%, transparent 70%);
        }

        .hero-layout {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: center;
        }
        @media (min-width: 1024px) {
            .hero-layout { grid-template-columns: 1fr 1.2fr; gap: 2rem; align-items: center; }
        }
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 760px;
        }
        .hero-illustration {
            display: none;
            position: relative;
        }
        @media (min-width: 1024px) {
            .hero-illustration { display: flex; align-items: center; justify-content: center; }
        }
        .hero-illustration svg {
            width: 100%;
            max-width: 620px;
            height: auto;
            filter: drop-shadow(0 0 40px rgba(59, 130, 246, 0.15));
            transform: scale(1.15);
            transform-origin: center center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: var(--surface-card);
            border: 1px solid var(--border-accent);
            border-radius: 100px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--brand-300);
            margin-bottom: 2rem;
            backdrop-filter: blur(8px);
        }
        .hero-badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            animation: blink 2s ease-in-out infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        .hero h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2.5rem, 7vw, 4.5rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
        }
        .hero h1 .gradient-text {
            background: linear-gradient(135deg, var(--brand-300) 0%, var(--brand-500) 50%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-sub {
            font-size: clamp(1.05rem, 2vw, 1.2rem);
            line-height: 1.7;
            color: var(--text-secondary);
            max-width: 560px;
            margin-bottom: 2.5rem;
        }
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 3.5rem;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2rem;
            background: var(--brand-600);
            color: #fff;
            font-weight: 600;
            font-size: 0.9375rem;
            border-radius: 8px;
            border: 1px solid var(--brand-500);
            transition: all 0.25s;
            position: relative;
            overflow: hidden;
        }
        .btn-primary:hover {
            background: var(--brand-500);
            box-shadow: 0 0 30px var(--glow-blue), 0 4px 16px rgba(0,0,0,0.3);
            transform: translateY(-1px);
        }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2rem;
            background: transparent;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 0.9375rem;
            border-radius: 8px;
            border: 1px solid var(--border-accent);
            transition: all 0.25s;
        }
        .btn-secondary:hover {
            background: var(--surface-card);
            border-color: var(--brand-400);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
            flex-wrap: wrap;
        }
        .hero-stat {
            display: flex;
            flex-direction: column;
        }
        .hero-stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
        }
        .hero-stat-label {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
            margin-top: 0.15rem;
        }

        /* ── Services Section ────────────────────────────────── */
        .services {
            padding: 7rem 0;
            position: relative;
        }
        .services::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
            margin-top: 3rem;
        }
        @media (min-width: 640px) { .services-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .services-grid { grid-template-columns: repeat(4, 1fr); } }

        .service-card {
            padding: 2rem 1.75rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--brand-600), var(--brand-400));
            opacity: 0;
            transition: opacity 0.35s;
        }
        .service-card:hover {
            border-color: var(--border-accent);
            background: var(--surface-card-hover);
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.3), 0 0 0 1px var(--border-accent);
        }
        .service-card:hover::before { opacity: 1; }

        .service-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--brand-900), var(--brand-700));
            border: 1px solid var(--border-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            color: var(--brand-300);
        }
        .service-card h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.65rem;
        }
        .service-card p {
            font-size: 0.875rem;
            line-height: 1.65;
            color: var(--text-secondary);
        }

        /* ── Tech Stack ──────────────────────────────────────── */
        .tech-stack {
            padding: 5rem 0 7rem;
        }
        .tech-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 2rem;
        }
        .tech-tag {
            padding: 0.55rem 1.25rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.25s;
        }
        .tech-tag:hover {
            border-color: var(--brand-500);
            color: var(--brand-300);
            background: rgba(59, 130, 246, 0.08);
            box-shadow: 0 0 16px rgba(59, 130, 246, 0.1);
        }
        .tech-tag.featured {
            border-color: var(--brand-600);
            color: var(--brand-300);
            background: rgba(59, 130, 246, 0.08);
        }

        /* ── Projects Section ────────────────────────────────── */
        .projects {
            padding: 7rem 0;
            position: relative;
        }
        .projects::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }
        .projects-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 3rem;
        }
        @media (min-width: 768px) {
            .projects-header {
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
            }
        }
        .projects-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }
        @media (min-width: 640px) { .projects-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .projects-grid { grid-template-columns: repeat(3, 1fr); } }

        .project-card {
            padding: 1.75rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .project-card:hover {
            border-color: var(--border-accent);
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
        }
        .project-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        .project-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--navy-700), var(--navy-600));
            border: 1px solid var(--border-subtle);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-400);
        }
        .project-stars {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.8125rem;
            color: var(--text-tertiary);
        }
        .project-card h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        .project-card p {
            font-size: 0.875rem;
            line-height: 1.6;
            color: var(--text-secondary);
            flex: 1;
            margin-bottom: 1.25rem;
        }
        .project-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .project-lang {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8125rem;
            color: var(--text-tertiary);
        }
        .project-lang-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        .lang-php { background: #777BB4; }
        .lang-js { background: #F7DF1E; }
        .lang-python { background: #3572A5; }
        .lang-jupyter { background: #DA5B0B; }

        .project-link {
            font-size: 0.8125rem;
            color: var(--brand-400);
            font-weight: 500;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .project-link:hover { color: var(--brand-300); }

        /* ── Credentials Section ─────────────────────────────── */
        .credentials {
            padding: 7rem 0;
            position: relative;
        }
        .credentials::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }
        .credentials-columns {
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            margin-top: 3rem;
        }
        @media (min-width: 768px) { .credentials-columns { grid-template-columns: 1fr 1fr; } }

        .credential-item {
            display: flex;
            gap: 1rem;
            padding: 1.25rem 0;
            border-bottom: 1px solid var(--border-subtle);
        }
        .credential-item:last-child { border-bottom: none; }
        .credential-year {
            font-family: 'Syne', sans-serif;
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--brand-400);
            min-width: 3.5rem;
            padding-top: 0.15rem;
        }
        .credential-info h4 {
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
        }
        .credential-info p {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
        }

        .edu-card {
            padding: 2rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        .edu-card h4 {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.35rem;
        }
        .edu-card .edu-degree {
            font-size: 0.9375rem;
            color: var(--text-secondary);
            margin-bottom: 0.35rem;
        }
        .edu-card .edu-period {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
            margin-bottom: 1rem;
        }
        .edu-awards {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .award-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.85rem;
            background: rgba(234, 179, 8, 0.08);
            border: 1px solid rgba(234, 179, 8, 0.2);
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #fbbf24;
        }

        /* Publications */
        .pub-item {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-subtle);
        }
        .pub-item:last-child { border-bottom: none; }
        .pub-bullet {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--brand-500);
            margin-top: 0.55rem;
            flex-shrink: 0;
        }
        .pub-item p {
            font-size: 0.9375rem;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* ── Pricing Section ─────────────────────────────────── */
        .pricing {
            padding: 7rem 0;
            position: relative;
        }
        .pricing::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }
        .pricing-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-top: 3rem;
        }
        @media (min-width: 768px) { .pricing-grid { grid-template-columns: repeat(3, 1fr); } }

        .pricing-card {
            padding: 2.5rem 2rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .pricing-card:hover {
            border-color: var(--border-accent);
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        .pricing-card.featured {
            border-color: var(--brand-500);
            background: linear-gradient(180deg, rgba(37, 99, 235, 0.08) 0%, var(--surface-card) 100%);
        }
        .pricing-card.featured::after {
            content: 'Most Popular';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.3rem 1rem;
            background: var(--brand-600);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 100px;
            white-space: nowrap;
        }
        .pricing-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.8125rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--brand-400);
            margin-bottom: 0.5rem;
        }
        .pricing-card h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }
        .pricing-card .price {
            font-family: 'Syne', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 0.25rem;
        }
        .pricing-card .price-unit {
            font-size: 0.875rem;
            color: var(--text-tertiary);
            margin-bottom: 1.5rem;
        }
        .pricing-card .price-desc {
            font-size: 0.875rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 1.75rem;
        }
        .pricing-features {
            flex: 1;
            margin-bottom: 2rem;
        }
        .pricing-features li {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            padding: 0.5rem 0;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }
        .pricing-features li svg {
            flex-shrink: 0;
            margin-top: 0.15rem;
            color: var(--brand-400);
        }
        .pricing-cta {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.85rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9375rem;
            transition: all 0.25s;
            border: 1px solid var(--border-accent);
            color: var(--text-primary);
            background: transparent;
        }
        .pricing-cta:hover {
            background: var(--surface-card-hover);
            border-color: var(--brand-400);
        }
        .pricing-cta.primary {
            background: var(--brand-600);
            border-color: var(--brand-500);
            color: #fff;
        }
        .pricing-cta.primary:hover {
            background: var(--brand-500);
            box-shadow: 0 0 24px var(--glow-blue);
        }

        /* ── Contact / CTA Section ───────────────────────────── */
        .contact {
            padding: 7rem 0 5rem;
            position: relative;
        }
        .contact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }
        .contact-inner {
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
        }
        .contact-inner .section-label { justify-content: center; }
        .contact-inner .section-label::before { display: none; }
        .contact-inner .section-desc {
            max-width: 500px;
            margin: 0 auto 2.5rem;
        }
        .contact-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-top: 3rem;
        }
        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 1.5rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.25s;
        }
        .contact-link:hover {
            border-color: var(--brand-500);
            color: var(--brand-300);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }
        .contact-link svg { flex-shrink: 0; }

        /* ── Footer ──────────────────────────────────────────── */
        .site-footer {
            padding: 2.5rem 0;
            border-top: 1px solid var(--border-subtle);
        }
        .footer-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            text-align: center;
        }
        @media (min-width: 768px) {
            .footer-inner {
                flex-direction: row;
                justify-content: space-between;
                text-align: left;
            }
        }
        .footer-text {
            font-size: 0.8125rem;
            color: var(--text-tertiary);
        }
        .footer-text a { color: var(--brand-400); transition: color 0.2s; }
        .footer-text a:hover { color: var(--brand-300); }
        .footer-socials {
            display: flex;
            gap: 1rem;
        }
        .footer-socials a {
            color: var(--text-tertiary);
            transition: color 0.2s;
        }
        .footer-socials a:hover { color: var(--brand-400); }

        /* ── Scroll Progress Bar ────────────────────────────── */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--brand-600), var(--brand-400), #818cf8);
            z-index: 200;
            width: 0%;
            transition: width 0.05s linear;
        }

        /* ── Floating CTA ─────────────────────────────────── */
        .floating-cta {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 90;
            opacity: 0;
            transform: translateY(20px) scale(0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }
        .floating-cta.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: all;
        }
        .floating-cta a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 1.5rem;
            background: var(--brand-600);
            color: #fff;
            font-weight: 600;
            font-size: 0.875rem;
            border-radius: 100px;
            border: 1px solid var(--brand-500);
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.3), 0 0 0 1px rgba(37, 99, 235, 0.1);
            transition: all 0.25s;
        }
        .floating-cta a:hover {
            background: var(--brand-500);
            box-shadow: 0 12px 40px rgba(37, 99, 235, 0.45), 0 0 0 1px var(--brand-400);
            transform: translateY(-2px);
        }

        /* ── Gradient Border Cards ───────────────────────── */
        .gradient-border {
            position: relative;
        }
        .gradient-border::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 13px;
            background: linear-gradient(135deg, var(--brand-600), transparent 40%, transparent 60%, #818cf8);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s;
        }
        .gradient-border:hover::after {
            opacity: 1;
        }

        /* ── Trust Bar ──────────────────────────────────── */
        .trust-bar {
            padding: 3rem 0;
            border-bottom: 1px solid var(--border-subtle);
        }
        .trust-bar-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 2rem 3rem;
        }
        .trust-bar-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--text-tertiary);
            white-space: nowrap;
        }
        .trust-bar-logos {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 2rem 2.5rem;
        }
        .trust-logo {
            font-family: 'Syne', sans-serif;
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--text-tertiary);
            opacity: 0.5;
            transition: opacity 0.3s;
            white-space: nowrap;
        }
        .trust-logo:hover { opacity: 0.85; }

        /* ── Testimonials ───────────────────────────────── */
        .testimonials {
            padding: 7rem 0;
            position: relative;
        }
        .testimonials::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }
        .testimonials-stack {
            position: relative;
            max-width: 680px;
            margin: 3rem auto 0;
            perspective: 1200px;
        }
        .testimonial-card {
            padding: 2.25rem 2.5rem;
            background: var(--surface-card);
            border: 1px solid var(--border-subtle);
            border-radius: 14px;
            position: relative;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            margin-bottom: 1.25rem;
        }
        .testimonial-card:nth-child(1) { transform: translateZ(0px); }
        .testimonial-card:nth-child(2) { transform: translateZ(-10px) scale(0.98); opacity: 0.95; }
        .testimonial-card:nth-child(3) { transform: translateZ(-20px) scale(0.96); opacity: 0.9; }
        .testimonial-card:nth-child(4) { transform: translateZ(-30px) scale(0.94); opacity: 0.85; }
        .testimonial-card.parallax-visible {
            transform: translateZ(0px) scale(1) !important;
            opacity: 1 !important;
        }
        .testimonial-card:hover {
            border-color: var(--border-accent);
            transform: translateY(-4px) scale(1.01) !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 0 1px var(--border-accent);
        }
        .testimonial-quote {
            position: absolute;
            top: 1.25rem;
            right: 1.5rem;
            font-family: 'Syne', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--brand-500);
            opacity: 0.15;
            line-height: 1;
        }
        .testimonial-text {
            font-size: 0.9375rem;
            line-height: 1.75;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-style: italic;
            position: relative;
        }
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .testimonial-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brand-800), var(--brand-600));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.875rem;
            color: var(--brand-200);
            flex-shrink: 0;
        }
        .testimonial-name {
            font-weight: 600;
            font-size: 0.9375rem;
            color: var(--text-primary);
        }
        .testimonial-role {
            font-size: 0.75rem;
            color: var(--text-tertiary);
        }
        .testimonial-source {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.6875rem;
            font-weight: 500;
            color: var(--brand-400);
            margin-top: 0.2rem;
        }
        .testimonial-stars {
            display: flex;
            gap: 0.15rem;
            margin-bottom: 0.75rem;
            color: #fbbf24;
        }

        /* ── Section Divider ─────────────────────────────── */
        .section-divider {
            width: 48px;
            height: 3px;
            background: linear-gradient(90deg, var(--brand-500), var(--brand-400));
            border-radius: 2px;
            margin-top: 0.75rem;
        }

        /* ── FAQ Section ─────────────────────────────────────── */
        .faq {
            padding: 7rem 0;
            position: relative;
        }
        .faq::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-accent), transparent);
        }
        .faq-list {
            max-width: 740px;
            margin: 3rem auto 0;
        }
        .faq-item {
            border-bottom: 1px solid var(--border-subtle);
        }
        .faq-question {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            padding: 1.5rem 0;
            text-align: left;
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: color 0.2s;
        }
        .faq-question:hover { color: var(--brand-300); }
        .faq-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid var(--border-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            color: var(--brand-400);
        }
        .faq-item.active .faq-icon {
            background: var(--brand-600);
            border-color: var(--brand-500);
            color: #fff;
            transform: rotate(45deg);
        }
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1), padding 0.3s;
        }
        .faq-item.active .faq-answer {
            max-height: 300px;
        }
        .faq-answer p {
            padding: 0 0 1.5rem;
            font-size: 0.9375rem;
            line-height: 1.75;
            color: var(--text-secondary);
            max-width: 640px;
        }

        /* ── Ambient Noise Texture ────────────────────────────── */
        .noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 9999;
            pointer-events: none;
            opacity: 0.018;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 256px 256px;
        }
    </style>
</head>
<body>
    <!-- Scroll progress bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Noise texture overlay -->
    <div class="noise-overlay"></div>

    <!-- ─── Navigation ───────────────────────────────────────── -->
    <nav class="site-nav" id="siteNav">
        <div class="container">
            <div class="nav-inner">
                <a href="#" class="nav-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 950 100" role="img" aria-label="Temitope Olotin logo">
                        <title>Temitope Olotin</title>
                        <text x="0" y="55%" dominant-baseline="middle" fill="#FFFFFF" font-family="Syne, sans-serif" font-size="64" font-weight="800" letter-spacing="2">Temitope Olotin</text>
                    </svg>
                </a>

                <div class="nav-links">
                    <a href="#services">Services</a>
                    <a href="#projects">Projects</a>
                    <a href="#pricing">Pricing</a>
                    <a href="#credentials">Credentials</a>
                    <a href="#contact">Contact</a>
                </div>

                <div class="nav-auth">
                    <a href="#contact" class="nav-cta">Book a Call</a>
                    <button class="mobile-toggle" onclick="document.getElementById('mobileMenu').classList.add('active')" aria-label="Open menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-close" onclick="this.parentElement.classList.remove('active')" aria-label="Close menu">&times;</button>
        <a href="#services" onclick="this.parentElement.classList.remove('active')">Services</a>
        <a href="#projects" onclick="this.parentElement.classList.remove('active')">Projects</a>
        <a href="#pricing" onclick="this.parentElement.classList.remove('active')">Pricing</a>
        <a href="#credentials" onclick="this.parentElement.classList.remove('active')">Credentials</a>
        <a href="#contact" onclick="this.parentElement.classList.remove('active')">Contact</a>
        <a href="#contact" onclick="this.parentElement.classList.remove('active')" style="color: var(--brand-400);">Book a Call</a>
    </div>

    <!-- ─── Hero ─────────────────────────────────────────────── -->
    <section class="hero" id="hero">
        <div class="hero-bg">
            <div class="hero-grid"></div>
        </div>
        <div class="container">
            <div class="hero-layout">
                <div class="hero-content">
                    <div class="hero-badge reveal">
                        <span class="hero-badge-dot"></span>
                         Accepting new clients · Lagos · New York · London · Canada
                    </div>
                    <h1 class="reveal reveal-delay-1">
                        Your Next Product<br>
                        <span class="gradient-text">Deserves AI-First</span><br>
                        Engineering
                    </h1>
                    <p class="hero-sub reveal reveal-delay-2">
                        I'm <strong style="color: var(--text-primary);">Temitope Olotin</strong> — I help founders go from idea to shipped product in weeks, not months. 10+ years of production-grade software engineering, now with AI at the core. No equity, no middlemen — just clean architecture and real results at startup-friendly rates.
                    </p>
                    <div class="hero-actions reveal reveal-delay-3">
                        <a href="#contact" class="btn-primary">
                            Book a Free Discovery Call
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7M5 5h7v7"/></svg>
                        </a>
                        <a href="#projects" class="btn-secondary">
                            See My Work
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 4 6 6-6 6"/></svg>
                        </a>
                    </div>
                    <div class="hero-stats reveal reveal-delay-4">
                        <div class="hero-stat">
                            <span class="hero-stat-value" data-count="10">0</span>
                            <span class="hero-stat-label">Years Shipping Code</span>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-value" data-count="120">0</span>
                            <span class="hero-stat-label">Products Delivered</span>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-value" data-count="9">0</span>
                            <span class="hero-stat-label">Years Mentoring Devs</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Illustration -->
                <div class="hero-illustration reveal reveal-delay-2">
                    <svg viewBox="0 0 480 480" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Background circle glow -->
                        <circle cx="240" cy="240" r="200" fill="url(#heroGlow)" opacity="0.3"/>

                        <!-- Neural network nodes and connections -->
                        <g opacity="0.4" stroke="var(--brand-500)" stroke-width="1">
                            <line x1="120" y1="100" x2="200" y2="160" opacity="0.6"/>
                            <line x1="200" y1="160" x2="300" y2="120" opacity="0.5"/>
                            <line x1="300" y1="120" x2="360" y2="180" opacity="0.4"/>
                            <line x1="200" y1="160" x2="240" y2="240" opacity="0.6"/>
                            <line x1="300" y1="120" x2="240" y2="240" opacity="0.5"/>
                            <line x1="360" y1="180" x2="340" y2="280" opacity="0.4"/>
                            <line x1="240" y1="240" x2="340" y2="280" opacity="0.5"/>
                            <line x1="240" y1="240" x2="160" y2="320" opacity="0.6"/>
                            <line x1="340" y1="280" x2="280" y2="370" opacity="0.4"/>
                            <line x1="160" y1="320" x2="280" y2="370" opacity="0.5"/>
                        </g>
                        <g fill="var(--brand-400)">
                            <circle cx="120" cy="100" r="4" opacity="0.5"><animate attributeName="opacity" values="0.3;0.8;0.3" dur="3s" repeatCount="indefinite"/></circle>
                            <circle cx="200" cy="160" r="5" opacity="0.6"><animate attributeName="opacity" values="0.4;0.9;0.4" dur="2.5s" repeatCount="indefinite"/></circle>
                            <circle cx="300" cy="120" r="4" opacity="0.5"><animate attributeName="opacity" values="0.3;0.7;0.3" dur="4s" repeatCount="indefinite"/></circle>
                            <circle cx="360" cy="180" r="3.5" opacity="0.4"><animate attributeName="opacity" values="0.2;0.7;0.2" dur="3.5s" repeatCount="indefinite"/></circle>
                            <circle cx="340" cy="280" r="4" opacity="0.5"><animate attributeName="opacity" values="0.3;0.8;0.3" dur="2.8s" repeatCount="indefinite"/></circle>
                            <circle cx="160" cy="320" r="4.5" opacity="0.5"><animate attributeName="opacity" values="0.4;0.8;0.4" dur="3.2s" repeatCount="indefinite"/></circle>
                            <circle cx="280" cy="370" r="3.5" opacity="0.4"><animate attributeName="opacity" values="0.2;0.6;0.2" dur="4.2s" repeatCount="indefinite"/></circle>
                        </g>

                        <!-- Central AI brain / chip -->
                        <g transform="translate(240, 240)">
                            <circle r="8" fill="var(--brand-500)" opacity="0.9">
                                <animate attributeName="r" values="8;11;8" dur="3s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values="0.9;0.5;0.9" dur="3s" repeatCount="indefinite"/>
                            </circle>
                            <circle r="20" fill="none" stroke="var(--brand-400)" stroke-width="1" stroke-dasharray="4 4" opacity="0.4">
                                <animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="20s" repeatCount="indefinite"/>
                            </circle>
                            <circle r="35" fill="none" stroke="var(--brand-500)" stroke-width="0.5" stroke-dasharray="2 6" opacity="0.25">
                                <animateTransform attributeName="transform" type="rotate" from="360" to="0" dur="30s" repeatCount="indefinite"/>
                            </circle>
                        </g>

                        <!-- Code editor window -->
                        <g transform="translate(140, 170)">
                            <rect width="200" height="140" rx="8" fill="rgba(6, 11, 24, 0.9)" stroke="var(--border-accent)" stroke-width="1"/>
                            <!-- Title bar -->
                            <rect width="200" height="24" rx="8" fill="rgba(15, 26, 60, 0.8)"/>
                            <rect y="16" width="200" height="8" fill="rgba(15, 26, 60, 0.8)"/>
                            <circle cx="14" cy="12" r="3.5" fill="#ef4444" opacity="0.7"/>
                            <circle cx="26" cy="12" r="3.5" fill="#eab308" opacity="0.7"/>
                            <circle cx="38" cy="12" r="3.5" fill="#22c55e" opacity="0.7"/>
                            <text x="70" y="15" fill="var(--text-tertiary)" font-size="8" font-family="monospace">app.py</text>
                            <!-- Code lines -->
                            <text x="12" y="44" fill="#818cf8" font-size="9" font-family="monospace">from</text>
                            <text x="40" y="44" fill="var(--text-secondary)" font-size="9" font-family="monospace">langchain</text>
                            <text x="100" y="44" fill="#818cf8" font-size="9" font-family="monospace">import</text>
                            <text x="140" y="44" fill="#93c5fd" font-size="9" font-family="monospace">Agent</text>

                            <text x="12" y="60" fill="#818cf8" font-size="9" font-family="monospace">from</text>
                            <text x="40" y="60" fill="var(--text-secondary)" font-size="9" font-family="monospace">llama_index</text>
                            <text x="112" y="60" fill="#818cf8" font-size="9" font-family="monospace">import</text>
                            <text x="152" y="60" fill="#93c5fd" font-size="9" font-family="monospace">VectorDB</text>

                            <text x="12" y="80" fill="var(--text-tertiary)" font-size="9" font-family="monospace"></text>
                            <text x="12" y="96" fill="#fbbf24" font-size="9" font-family="monospace">class</text>
                            <text x="42" y="96" fill="#93c5fd" font-size="9" font-family="monospace">AIConsultant</text>
                            <text x="125" y="96" fill="var(--text-secondary)" font-size="9" font-family="monospace">(Agent):</text>

                            <text x="24" y="112" fill="#818cf8" font-size="9" font-family="monospace">def</text>
                            <text x="46" y="112" fill="#93c5fd" font-size="9" font-family="monospace">solve</text>
                            <text x="80" y="112" fill="var(--text-secondary)" font-size="9" font-family="monospace">(self, problem):</text>

                            <text x="36" y="128" fill="#22c55e" font-size="9" font-family="monospace">return</text>
                            <text x="74" y="128" fill="var(--text-secondary)" font-size="9" font-family="monospace">self.ship(</text>
                            <text x="140" y="128" fill="#fbbf24" font-size="9" font-family="monospace">fast</text>
                            <text x="162" y="128" fill="var(--text-secondary)" font-size="9" font-family="monospace">)</text>

                            <!-- Typing cursor blink -->
                            <rect x="170" y="120" width="7" height="12" fill="var(--brand-400)" opacity="0.8">
                                <animate attributeName="opacity" values="0.8;0;0.8" dur="1.2s" repeatCount="indefinite"/>
                            </rect>
                        </g>

                        <!-- Floating tech badges -->
                        <g>
                            <g transform="translate(80, 220)">
                                <rect width="52" height="22" rx="11" fill="rgba(15, 26, 60, 0.85)" stroke="var(--border-accent)" stroke-width="0.5"/>
                                <text x="10" y="15" fill="var(--brand-300)" font-size="9" font-weight="600" font-family="system-ui">Laravel</text>
                                <animateTransform attributeName="transform" type="translate" values="80,220;80,215;80,220" dur="4s" repeatCount="indefinite"/>
                            </g>
                            <g transform="translate(360, 320)">
                                <rect width="40" height="22" rx="11" fill="rgba(15, 26, 60, 0.85)" stroke="var(--border-accent)" stroke-width="0.5"/>
                                <text x="10" y="15" fill="var(--brand-300)" font-size="9" font-weight="600" font-family="system-ui">n8n</text>
                                <animateTransform attributeName="transform" type="translate" values="360,320;360,325;360,320" dur="3.5s" repeatCount="indefinite"/>
                            </g>
                            <g transform="translate(330, 90)">
                                <rect width="52" height="22" rx="11" fill="rgba(15, 26, 60, 0.85)" stroke="rgba(129, 140, 248, 0.3)" stroke-width="0.5"/>
                                <text x="8" y="15" fill="#a5b4fc" font-size="9" font-weight="600" font-family="system-ui">GPT-4o</text>
                                <animateTransform attributeName="transform" type="translate" values="330,90;330,85;330,90" dur="5s" repeatCount="indefinite"/>
                            </g>
                            <g transform="translate(90, 360)">
                                <rect width="56" height="22" rx="11" fill="rgba(15, 26, 60, 0.85)" stroke="rgba(34, 197, 94, 0.3)" stroke-width="0.5"/>
                                <text x="8" y="15" fill="#86efac" font-size="9" font-weight="600" font-family="system-ui">Python</text>
                                <animateTransform attributeName="transform" type="translate" values="90,360;90,365;90,360" dur="4.5s" repeatCount="indefinite"/>
                            </g>
                        </g>

                        <!-- Gradient definitions -->
                        <defs>
                            <radialGradient id="heroGlow" cx="0.5" cy="0.5" r="0.5">
                                <stop offset="0%" stop-color="var(--brand-600)" stop-opacity="0.2"/>
                                <stop offset="100%" stop-color="transparent" stop-opacity="0"/>
                            </radialGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Trust Bar ──────────────────────────────────────────── -->
    <div class="trust-bar reveal">
        <div class="container">
            <div class="trust-bar-inner">
                <span class="trust-bar-label">Trusted by teams at</span>
                <div class="trust-bar-logos">
                    <span class="trust-logo">Andela</span>
                    <span class="trust-logo">Cause Strategy</span>
                    <span class="trust-logo">Waldo</span>
                    <span class="trust-logo">Accounteer</span>
                    <span class="trust-logo">BeautySpace</span>
                    <span class="trust-logo">LearnKast</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Services ─────────────────────────────────────────── -->
    <section class="services" id="services">
        <div class="container">
            <div class="reveal">
                <span class="section-label">What I Do</span>
                <h2 class="section-title">Four Ways I Help You Win</h2>
                <p class="section-desc">Every engagement is structured around one goal: shipping software that moves the needle for your business.</p>
                <div class="section-divider"></div>
            </div>

            <div class="services-grid">
                <div class="service-card reveal reveal-delay-1">
                    <div class="service-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a4 4 0 0 1 4 4c0 1.5-.8 2.8-2 3.5v1L12 12l-2-1.5v-1A4 4 0 0 1 12 2Z"/><path d="M8 14s-4 2-4 6h16c0-4-4-6-4-6"/><circle cx="12" cy="6" r="1"/></svg>
                    </div>
                    <h3>AI Solutions & Automation</h3>
                    <p>Custom AI agents and intelligent workflows that replace 40+ hours of manual work per week — built with LangChain, LlamaIndex, GPT-4o, n8n, and Zapier.</p>
                </div>

                <div class="service-card reveal reveal-delay-2">
                    <div class="service-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/><path d="M7 8h2m-2 4h4"/></svg>
                    </div>
                    <h3>Web Application Development</h3>
                    <p>From first commit to production in weeks. Full-stack Laravel, Livewire, and Vue.js apps — battle-tested architecture that scales with your user base.</p>
                </div>

                <div class="service-card reveal reveal-delay-3">
                    <div class="service-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                    </div>
                    <h3>API Design & Architecture</h3>
                    <p>REST APIs designed for 99.9% uptime and effortless third-party integrations. Your systems talk to each other without the pain.</p>
                </div>

                <div class="service-card reveal reveal-delay-4">
                    <div class="service-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m7 16 4-8 4 5 5-9"/></svg>
                    </div>
                    <h3>Data Analytics & Insights</h3>
                    <p>Turn your messy data into clear decisions. Analytics pipelines, real-time dashboards, and predictive models your investors will love.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Tech Stack ───────────────────────────────────────── -->
    <section class="tech-stack" id="stack">
        <div class="container">
            <div class="reveal">
                <span class="section-label">Tools & Technologies</span>
                <h2 class="section-title">Built With What Ships Fast</h2>
            </div>
            <div class="tech-grid reveal reveal-delay-1">
                <span class="tech-tag featured">PHP</span>
                <span class="tech-tag featured">Laravel</span>
                <span class="tech-tag featured">Livewire</span>
                <span class="tech-tag">Vue.js</span>
                <span class="tech-tag">JavaScript</span>
                <span class="tech-tag featured">Python</span>
                <span class="tech-tag featured">AI / ML</span>
                <span class="tech-tag featured">AI Agents</span>
                <span class="tech-tag featured">LangChain</span>
                <span class="tech-tag featured">LlamaIndex</span>
                <span class="tech-tag">AWS</span>
                <span class="tech-tag">Data Analytics</span>
                <span class="tech-tag">REST APIs</span>
                <span class="tech-tag">Testing / TDD</span>
                <span class="tech-tag">MySQL / PostgreSQL</span>
                <span class="tech-tag">Docker</span>
                <span class="tech-tag">Filament</span>
                <span class="tech-tag">Git / CI-CD</span>
                <span class="tech-tag featured">n8n</span>
                <span class="tech-tag featured">Zapier</span>
            </div>
        </div>
    </section>

    <!-- ─── Projects ─────────────────────────────────────────── -->
    <section class="projects" id="projects">
        <div class="container">
            <div class="projects-header reveal">
                <div>
                    <span class="section-label">Selected Work</span>
                    <h2 class="section-title">Products That Went Live — and Stayed There</h2>
                    <p class="section-desc">Real software running in production across four continents. From beauty marketplaces to cloud accounting — every project shipped on time with clean, maintainable code.</p>
                    <div class="section-divider"></div>
                </div>
                <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" class="btn-secondary" style="white-space: nowrap; align-self: flex-start;">
                    View GitHub (120+ repos)
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7M5 5h7v7"/></svg>
                </a>
            </div>

            <!-- Client / Commercial Projects -->
            <h3 style="font-family: 'Syne', sans-serif; font-size: 0.8125rem; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--brand-400); margin-bottom: 1.25rem;" class="reveal">Client & Commercial Projects</h3>

            <div class="projects-grid" style="margin-bottom: 3rem;">
                <div class="project-card reveal reveal-delay-1">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #4a1942, #8b2fc9);">
                            <svg width="20" height="20" fill="none" stroke="#e9b5ff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="7" r="3"/><path d="M2 20c0-4 3.5-7 8-7s8 3 8 7"/><path d="M15 4a3 3 0 0 1 0 6"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: #22c55e; background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Founder</span>
                    </div>
                    <h3>BeautySpace</h3>
                    <p>Nigeria's premier beauty services marketplace. Connects customers with trusted professionals for makeup, spa treatments, and wellness — featuring real-time booking, location-based search, and business management tools.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot" style="background: #F05340;"></span> Laravel / Livewire</span>
                        <span class="project-link" style="color: var(--text-tertiary);">beautyspaceng.com</span>
                    </div>
                </div>

                <div class="project-card reveal reveal-delay-2">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #0c3547, #1a6985);">
                            <svg width="20" height="20" fill="none" stroke="#7dd3fc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: #22c55e; background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Founder</span>
                    </div>
                    <h3>LearnKast</h3>
                    <p>An e-learning platform that makes education accessible and available 24/7. Built with video streaming, progress tracking, and interactive assessments for learners everywhere.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-js"></span> JavaScript / Laravel</span>
                        <span class="project-link" style="color: var(--text-tertiary);">Live Platform</span>
                    </div>
                </div>

                <div class="project-card reveal reveal-delay-3">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #14381a, #166534);">
                            <svg width="20" height="20" fill="none" stroke="#86efac" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: var(--brand-300); background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Sr. Engineer</span>
                    </div>
                    <h3>Cause Strategy Partners</h3>
                    <p>Technology platform for a NYC-based Certified B Corp connecting 3,000+ professionals with nonprofit boards. Built systems serving partners like JPMorgan Chase, Adobe, and BDO.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> PHP / Laravel</span>
                        <span class="project-link" style="color: var(--text-tertiary);">New York, USA</span>
                    </div>
                </div>

                <div class="project-card reveal reveal-delay-1">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #1e3a5f, #2563eb);">
                            <svg width="20" height="20" fill="none" stroke="#93c5fd" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="3"/><path d="M14 2v3M6 2v3M2 8h16"/><rect x="2" y="4" width="16" height="14" rx="2"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: var(--brand-300); background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Contract</span>
                    </div>
                    <h3>Parking Lot Management</h3>
                    <p>Full-stack parking management system with real-time space availability, automated billing, license plate tracking, and analytics dashboard for multi-location operators.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> Laravel / Vue.js</span>
                        <span class="project-link" style="color: var(--text-tertiary);">Enterprise SaaS</span>
                    </div>
                </div>

                <div class="project-card reveal reveal-delay-2">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #3b1a0a, #9a3412);">
                            <svg width="20" height="20" fill="none" stroke="#fdba74" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="8" r="6"/><path d="M2 20h16"/><path d="M10 14v6"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: var(--brand-300); background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Engineer</span>
                    </div>
                    <h3>Waldo Contacts</h3>
                    <p>DTC e-commerce platform for the UK's first direct-to-consumer contact lens brand. Shipped 50M+ lenses with subscription management, prescription handling, and payment systems.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> PHP / Full-Stack</span>
                        <span class="project-link" style="color: var(--text-tertiary);">London, UK</span>
                    </div>
                </div>

                <div class="project-card reveal reveal-delay-3">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #1a1a4e, #4338ca);">
                            <svg width="20" height="20" fill="none" stroke="#a5b4fc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="16" height="14" rx="2"/><path d="M6 7h8M6 11h5"/><path d="M13 11l2 2 4-4"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: var(--brand-300); background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Engineer</span>
                    </div>
                    <h3>Accounteer</h3>
                    <p>Cloud accounting platform for Belgian SMEs. Built invoicing, bank reconciliation, reporting, and third-party integrations connecting businesses with their accountants.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> PHP / Laravel</span>
                        <span class="project-link" style="color: var(--text-tertiary);">Leuven, Belgium</span>
                    </div>
                </div>

                <div class="project-card reveal reveal-delay-1">
                    <div class="project-card-header">
                        <div class="project-icon" style="background: linear-gradient(135deg, #1a3c1a, #3b7d3b);">
                            <svg width="20" height="20" fill="none" stroke="#86efac" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <span style="font-size: 0.6875rem; font-weight: 600; color: var(--brand-300); background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); border-radius: 100px; padding: 0.2rem 0.6rem;">Engineer</span>
                    </div>
                    <h3>Andela</h3>
                    <p>Contributed to Andela's engineering team building platforms that connect Africa's top developers with global companies. Served as mentor since 2016, guiding 9+ years of engineering talent.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> PHP / Full-Stack</span>
                        <span class="project-link" style="color: var(--text-tertiary);">Lagos, Nigeria</span>
                    </div>
                </div>
            </div>

            <!-- Open Source -->
            <h3 style="font-family: 'Syne', sans-serif; font-size: 0.8125rem; font-weight: 700; letter-spacing: 0.15em; text-transform: uppercase; color: var(--brand-400); margin-bottom: 1.25rem;" class="reveal">Open Source & AI Projects</h3>

            <div class="projects-grid">
                <a href="https://github.com/olotintemitope/locator" target="_blank" rel="noopener" class="project-card reveal reveal-delay-1">
                    <div class="project-card-header">
                        <div class="project-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="10" r="8"/><path d="M2 10h16M10 2a12 12 0 0 1 0 16M10 2a12 12 0 0 0 0 16"/></svg>
                        </div>
                        <div class="project-stars">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            19
                        </div>
                    </div>
                    <h3>Locator</h3>
                    <p>API for developers to access geographical data — countries, states, and counties worldwide.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> PHP</span>
                        <span class="project-link">View on GitHub <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 4-4M4 4h4v4"/></svg></span>
                    </div>
                </a>

                <a href="https://github.com/olotintemitope/Invoice-AI" target="_blank" rel="noopener" class="project-card reveal reveal-delay-2">
                    <div class="project-card-header">
                        <div class="project-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a4 4 0 0 1 4 4c0 1.5-.8 2.8-2 3.5v1L12 12l-2-1.5v-1A4 4 0 0 1 12 2Z"/><circle cx="12" cy="6" r="1"/><path d="M5 18h14"/></svg>
                        </div>
                        <div class="project-stars">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            4
                        </div>
                    </div>
                    <h3>Invoice-AI</h3>
                    <p>Autonomous invoice assistant built with GPT-4o, LlamaIndex, and Python for intelligent document processing.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-jupyter"></span> Python / AI</span>
                        <span class="project-link">View on GitHub <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 4-4M4 4h4v4"/></svg></span>
                    </div>
                </a>

                <a href="https://github.com/olotintemitope/publicholiday" target="_blank" rel="noopener" class="project-card reveal reveal-delay-3">
                    <div class="project-card-header">
                        <div class="project-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        </div>
                        <div class="project-stars">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            6
                        </div>
                    </div>
                    <h3>PublicHoliday</h3>
                    <p>PHP package integrating Google Calendar API to provide global public holiday information for any country.</p>
                    <div class="project-meta">
                        <span class="project-lang"><span class="project-lang-dot lang-php"></span> PHP</span>
                        <span class="project-link">View on GitHub <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 4-4M4 4h4v4"/></svg></span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ─── Credentials ──────────────────────────────────────── -->
    <section class="credentials" id="credentials">
        <div class="container">
            <div class="reveal">
                <span class="section-label">Background</span>
                <h2 class="section-title">The Experience Behind the Code</h2>
                <div class="section-divider"></div>
            </div>

            <div class="credentials-columns">
                <!-- Left Column: Certs & Education -->
                <div>
                    <div class="edu-card reveal">
                        <h4>Ambrose Alli University, Ekpoma</h4>
                        <p class="edu-degree">Computer Science — Bachelor's Degree</p>
                        <p class="edu-period">2016 — 2021</p>
                    </div>

                    <div class="edu-card reveal">
                        <h4>Federal Polytechnic, Ado-Ekiti</h4>
                        <p class="edu-degree">Computer Science — Upper Credit</p>
                        <p class="edu-period">2007 — 2012</p>
                        <div class="edu-awards">
                            <span class="award-badge">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                Best Programmer of the Year
                            </span>
                            <span class="award-badge">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                Best Graduating Student
                            </span>
                        </div>
                    </div>

                    <h3 style="font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text-primary); margin: 2rem 0 0.5rem;" class="reveal">Certifications</h3>

                    <div class="credential-item reveal">
                        <span class="credential-year">2025</span>
                        <div class="credential-info">
                            <h4>AI Agents Fundamentals</h4>
                            <p>Hugging Face</p>
                        </div>
                    </div>
                    <div class="credential-item reveal">
                        <span class="credential-year">2024</span>
                        <div class="credential-info">
                            <h4>Introduction to Data Science</h4>
                            <p>Cisco</p>
                        </div>
                    </div>
                    <div class="credential-item reveal">
                        <span class="credential-year">2024</span>
                        <div class="credential-info">
                            <h4>Data Analytics Essentials</h4>
                            <p>Cisco</p>
                        </div>
                    </div>
                    <div class="credential-item reveal">
                        <span class="credential-year">2024</span>
                        <div class="credential-info">
                            <h4>Verified International Academic Qualifications</h4>
                            <p>World Education Services (WES)</p>
                        </div>
                    </div>
                    <div class="credential-item reveal">
                        <span class="credential-year">2018</span>
                        <div class="credential-info">
                            <h4>Mobile Web Specialist</h4>
                            <p>Udacity</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Publications & Mentoring -->
                <div>
                    <h3 style="font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;" class="reveal">
                        Published on
                        <a href="https://olotintemitope.medium.com" target="_blank" rel="noopener" style="color: var(--brand-400); text-decoration: underline; text-underline-offset: 3px;">Medium</a> &amp;
                        <a href="https://www.codementor.io/@@olotintemitope" target="_blank" rel="noopener" style="color: var(--brand-400); text-decoration: underline; text-underline-offset: 3px;">Codementor</a>
                    </h3>

                    <a href="https://olotintemitope.medium.com/how-to-generate-your-api-documentation-in-20-minutes-4e0072f08b94" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>How to Generate Your API Documentation with Postman in 20 Minutes</p>
                    </a>
                    <a href="https://olotintemitope.medium.com/automating-invoice-creation-with-ai-d0b9b29e539c" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>Automating Invoice Creation with AI — GPT-4o & LlamaIndex</p>
                    </a>
                    <a href="https://olotintemitope.medium.com/how-to-impersonate-a-user-using-laravel-framework-d563d049b0de" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>How to Impersonate a User Using Laravel Framework</p>
                    </a>
                    <a href="https://olotintemitope.medium.com/how-to-debug-like-a-pro-using-xdebug-phpstorm-and-docker-d2d66630a9df" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>How to Debug Like a Pro Using Xdebug, PHPStorm, and Docker</p>
                    </a>
                    <a href="https://olotintemitope.medium.com/using-snappy-wkhtmltopdf-on-laravel-cloud-a-complete-guide-1973e280e25d" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>Using Snappy (wkhtmltopdf) on Laravel Cloud: A Complete Guide</p>
                    </a>
                    <a href="https://olotintemitope.medium.com/eating-end-to-end-testing-in-laravel-like-noodles-5848a3cf941c" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>Eating End to End Testing in Laravel Like Noodles</p>
                    </a>
                    <a href="https://olotintemitope.medium.com/laravel-translations-in-baby-steps-b23b7494a61c" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>Laravel Translations in Baby Steps</p>
                    </a>
                    <a href="https://www.codementor.io/@olotintemitope/dependency-injection-explained-in-plain-english-b24hippx7" target="_blank" rel="noopener" class="pub-item reveal" style="transition: opacity 0.2s; cursor: pointer;">
                        <span class="pub-bullet"></span>
                        <p>Dependency Injection Explained in Plain English</p>
                    </a>

                    <!-- Speaking & Events -->
                    <h3 style="font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem; margin-top: 2.5rem;" class="reveal">
                        Speaking & Events
                    </h3>
                    <a href="https://blog.beautyspaceng.com/beautyspace-pitch-at-the-african-technology-expo-2024-in-lagos" target="_blank" rel="noopener" class="edu-card reveal" style="display: block; text-decoration: none; cursor: pointer; margin-bottom: 0;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                            <div style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, #1e3a5f, #2563eb); border: 1px solid rgba(59, 130, 246, 0.3); display: flex; align-items: center; justify-content: center;">
                                <svg width="20" height="20" fill="none" stroke="#60a5fa" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            </div>
                            <div>
                                <h4 style="font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text-primary);">Africa Technology Expo 2024</h4>
                                <p style="font-size: 0.8125rem; color: var(--text-tertiary);">Lagos, Nigeria — June 2024</p>
                            </div>
                        </div>
                        <p style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.65;">Pitched BeautySpace's booking and client-management platform at ATE 2024, headline-sponsored by MTN Nigeria and Fidelity Bank. Connected with investors and tech innovators across Africa.</p>
                    </a>

                    <!-- Mentoring -->
                    <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 2.5rem;">
                        <div class="edu-card reveal" style="margin-bottom: 0;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, #0a3d0a, #166534); border: 1px solid rgba(34, 197, 94, 0.2); display: flex; align-items: center; justify-content: center;">
                                    <svg width="20" height="20" fill="none" stroke="#22c55e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </div>
                                <div>
                                    <h4 style="font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text-primary);">Andela Mentor</h4>
                                    <p style="font-size: 0.8125rem; color: var(--text-tertiary);">Since November 2016 — 9+ years</p>
                                </div>
                            </div>
                            <p style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.65;">Nurturing the next generation of African software engineers through mentorship, code reviews, and technical guidance.</p>
                        </div>

                        <div class="edu-card reveal" style="margin-bottom: 0;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, #1a1a4e, #4338ca); border: 1px solid rgba(99, 102, 241, 0.2); display: flex; align-items: center; justify-content: center;">
                                    <svg width="20" height="20" fill="none" stroke="#a5b4fc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                </div>
                                <div>
                                    <h4 style="font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--text-primary);">Codementor Expert</h4>
                                    <p style="font-size: 0.8125rem; color: var(--text-tertiary);">PHP & Laravel Mentor</p>
                                </div>
                            </div>
                            <p style="font-size: 0.875rem; color: var(--text-secondary); line-height: 1.65;">Available for 1-on-1 mentoring sessions on PHP, Laravel, debugging, and web development best practices.</p>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; display: flex; gap: 0.75rem; flex-wrap: wrap;" class="reveal">
                        <span style="padding: 0.4rem 0.85rem; background: var(--surface-card); border: 1px solid var(--border-subtle); border-radius: 100px; font-size: 0.8125rem; color: var(--text-secondary);">
                            English — Native
                        </span>
                        <span style="padding: 0.4rem 0.85rem; background: var(--surface-card); border: 1px solid var(--border-subtle); border-radius: 100px; font-size: 0.8125rem; color: var(--text-secondary);">
                            French — Elementary
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Pricing ──────────────────────────────────────────── -->
    <section class="pricing" id="pricing">
        <div class="container">
            <div class="reveal" style="text-align: center; max-width: 600px; margin: 0 auto;">
                <span class="section-label" style="justify-content: center;">
                    Investment
                </span>
                <h2 class="section-title">Simple Pricing.<br>Zero Surprises.</h2>
                <p class="section-desc" style="margin: 0 auto;">No hourly padding. No scope creep. Pick the model that fits your stage — every engagement starts with a free 30-minute discovery call.</p>
            </div>

            <div class="pricing-grid">
                <!-- Consultation -->
                <div class="pricing-card reveal reveal-delay-1">
                    <span class="pricing-label">Consultation</span>
                    <h3>Strategy Session</h3>
                    <div class="price">$150</div>
                    <div class="price-unit">per hour</div>
                    <p class="price-desc">Unstick a hard problem in 60 minutes. Walk away with a clear architecture plan, AI feasibility verdict, and concrete next steps.</p>
                    <ul class="pricing-features">
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            1-on-1 technical consultation
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Architecture review & recommendations
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            AI feasibility assessment
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Written summary & action items
                        </li>
                    </ul>
                    <a href="#contact" class="pricing-cta">Book a Session</a>
                </div>

                <!-- Project-Based -->
                <div class="pricing-card featured reveal reveal-delay-2">
                    <span class="pricing-label">Project-Based</span>
                    <h3>Full Build</h3>
                    <div class="price">$5,000+</div>
                    <div class="price-unit">per project</div>
                    <p class="price-desc">You describe the product. I ship it. Complete end-to-end build — architecture, development, testing, deployment, and 30 days of post-launch support.</p>
                    <ul class="pricing-features">
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Full project scoping & planning
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Design, development & testing
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Deployment & CI/CD setup
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            30-day post-launch support
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Source code & documentation
                        </li>
                    </ul>
                    <a href="#contact" class="pricing-cta primary">Start a Project</a>
                </div>

                <!-- Retainer -->
                <div class="pricing-card reveal reveal-delay-3">
                    <span class="pricing-label">Retainer</span>
                    <h3>Ongoing Partnership</h3>
                    <div class="price">$3,000</div>
                    <div class="price-unit">per month · 20 hrs</div>
                    <p class="price-desc">Like having a senior engineer on your team — without the overhead. Dedicated hours, priority scheduling, and unused hours roll over.</p>
                    <ul class="pricing-features">
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            20 hours of dedicated dev time
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Priority response & scheduling
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Weekly progress updates
                        </li>
                        <li>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="m4 8 3 3 5-6"/></svg>
                            Rollover unused hours
                        </li>
                    </ul>
                    <a href="#contact" class="pricing-cta">Get Started</a>
                </div>
            </div>

            <p style="text-align: center; margin-top: 2rem; font-size: 0.875rem; color: var(--text-tertiary);" class="reveal">
                Not sure which is right? <strong style="color: var(--text-secondary);">Book a free 30-minute discovery call</strong> and I'll recommend the best fit for your budget and timeline.
            </p>
        </div>
    </section>

    <!-- ─── Testimonials ────────────────────────────────────── -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="reveal" style="text-align: center; max-width: 600px; margin: 0 auto;">
                <span class="section-label" style="justify-content: center;">What People Say</span>
                <h2 class="section-title">Words From Colleagues &amp; Clients</h2>
                <div class="section-divider" style="margin: 0.75rem auto 0;"></div>
            </div>

            <div class="testimonials-stack">
                <div class="testimonial-card reveal reveal-delay-1">
                    <span class="testimonial-quote">&ldquo;</span>
                    <div class="testimonial-stars">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <p class="testimonial-text">Olotin is a very smart Software Engineer with great problem-solving skills. He has great soft skills and has demonstrated this while working together at Andela. He is also a good mentor. I would recommend him to any tech company.</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">RA</div>
                        <div>
                            <div class="testimonial-name">Raimi Ademola</div>
                            <div class="testimonial-role">Software Engineer, Andela</div>
                            <div class="testimonial-source">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal-delay-2">
                    <span class="testimonial-quote">&ldquo;</span>
                    <div class="testimonial-stars">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <p class="testimonial-text">Olotin is a focused, organized, well-detailed person who would produce an excellent result for any company. His attention to quality and commitment to delivery is consistently outstanding.</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">AD</div>
                        <div>
                            <div class="testimonial-name">Ayo Daramola</div>
                            <div class="testimonial-role">Technology Professional</div>
                            <div class="testimonial-source">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal reveal-delay-3">
                    <span class="testimonial-quote">&ldquo;</span>
                    <div class="testimonial-stars">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <p class="testimonial-text">Temitope has vast experience developing robust REST APIs and building backend applications using PHP with test-driven development. He also has strong knowledge converting designs to pixel-perfect webpages and building offline-first web applications.</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar" style="background: linear-gradient(135deg, #1a1a4e, #4338ca);">
                            <svg width="16" height="16" fill="#a5b4fc" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5" fill="none" stroke="#a5b4fc" stroke-width="1.5"/></svg>
                        </div>
                        <div>
                            <div class="testimonial-name">Codementor</div>
                            <div class="testimonial-role">PHP & Laravel Expert Profile</div>
                            <div class="testimonial-source">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="5"/><path d="m4 8 1.5 1.5L9 5"/></svg>
                                Verified Profile
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── FAQ ──────────────────────────────────────────────── -->
    <section class="faq" id="faq">
        <div class="container">
            <div class="reveal" style="text-align: center; max-width: 600px; margin: 0 auto;">
                <span class="section-label" style="justify-content: center;">FAQ</span>
                <h2 class="section-title">Questions I Get Asked a Lot</h2>
                <div class="section-divider" style="margin: 0.75rem auto 0;"></div>
            </div>

            <div class="faq-list">
                <div class="faq-item reveal active">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        How quickly can you start on my project?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Most projects kick off within 1-2 weeks of our discovery call. For urgent needs, I can start within 48 hours depending on current availability. The "Accepting new clients" badge at the top of this page reflects my real-time capacity.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        Do you work with startups or just enterprises?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Both. My sweet spot is founders who need their MVP shipped fast and enterprises scaling existing products. I've built for pre-revenue startups and companies serving millions of users. The approach adapts, but the engineering standards don't.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        Do you take equity instead of payment?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>No. I charge fair, transparent rates because I deliver production-grade work and I have a family to feed. That said, my pricing is startup-friendly — you get senior-level engineering without the Silicon Valley price tag.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        What does your typical development process look like?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Discovery call, scope & architecture plan, milestone-based development with weekly updates, testing, deployment, and 30 days of post-launch support. You'll never be left guessing where things stand — I over-communicate on purpose.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        Can you integrate AI into my existing application?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Absolutely. I specialize in retrofitting AI into existing systems — whether that's adding intelligent automation with n8n and Zapier, building custom AI agents with LangChain, or integrating LLMs for document processing. We'll start with a feasibility assessment in our strategy session.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        What happens after the project is delivered?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>Every Full Build includes 30 days of post-launch support. After that, many clients move to a monthly retainer for ongoing feature work and maintenance. You own 100% of the source code and documentation either way.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <button class="faq-question" onclick="this.parentElement.classList.toggle('active')">
                        What timezone do you work in?
                        <span class="faq-icon">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M7 1v12M1 7h12"/></svg>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <p>I'm based in Lagos, Nigeria (WAT / GMT+1), but I've worked with teams across Canada, New York, London, and Belgium for over a decade. I'm flexible with scheduling and overlap with North American and European business hours daily.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Contact / CTA ────────────────────────────────────── -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="contact-inner">
                <div class="reveal">
                    <span class="section-label">Next Step</span>
                    <h2 class="section-title">Ready to Ship?<br>Let's Talk.</h2>
                    <p class="section-desc">
                        Tell me what you're building. I'll tell you honestly if I'm the right fit — and if I am, we'll have a plan before the call ends.
                    </p>
                </div>

                <div class="reveal reveal-delay-1">
                    <a href="mailto:temitope@olotin.dev" class="btn-primary" style="font-size: 1rem; padding: 1rem 2.5rem;">
                        Book a Free 30-Min Call
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7M5 5h7v7"/></svg>
                    </a>
                    <p style="font-size: 0.8125rem; color: var(--text-tertiary); margin-top: 1rem;">No commitment. No pitch deck required. Just a conversation.</p>
                </div>

                <div class="contact-links reveal reveal-delay-2">
                    <a href="https://www.linkedin.com/in/olotin-temitope-53b43272/" target="_blank" rel="noopener" class="contact-link">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                    <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" class="contact-link">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        GitHub
                    </a>
                    <a href="https://x.com/laztopaz_" target="_blank" rel="noopener" class="contact-link">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        @@laztopaz_
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Floating CTA ──────────────────────────────────────── -->
    <div class="floating-cta" id="floatingCta">
        <a href="#contact">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7M5 5h7v7"/></svg>
            Book a Call
        </a>
    </div>

    <!-- ─── Footer ───────────────────────────────────────────── -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <p class="footer-text">
                    &copy; {{ date('Y') }} Temitope Olotin. Built with <a href="https://laravel.com" target="_blank" rel="noopener">Laravel</a>.
                </p>
                <div class="footer-socials">
                    <a href="https://www.linkedin.com/in/olotin-temitope-53b43272/" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" aria-label="GitHub">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                    </a>
                    <a href="https://x.com/laztopaz_" target="_blank" rel="noopener" aria-label="X / Twitter">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ─── Scripts ───────────────────────────────────────────── -->
    <script>
        // Navbar scroll effect
        const nav = document.getElementById('siteNav');
        const scrollProgress = document.getElementById('scrollProgress');
        const floatingCta = document.getElementById('floatingCta');

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            nav.classList.toggle('scrolled', scrollY > 40);

            // Scroll progress bar
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = Math.min((scrollY / docHeight) * 100, 100);
            scrollProgress.style.width = progress + '%';

            // Floating CTA appears after hero
            floatingCta.classList.toggle('visible', scrollY > window.innerHeight * 0.8);
        });

        // Animated counter
        function animateCounters() {
            document.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.dataset.count);
                const duration = 1800;
                const start = performance.now();
                const suffix = '+';

                function tick(now) {
                    const elapsed = now - start;
                    const progress = Math.min(elapsed / duration, 1);
                    // Ease out cubic
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = Math.round(eased * target);
                    el.textContent = current + suffix;
                    if (progress < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });
        }

        // Scroll reveal with IntersectionObserver
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(el => observer.observe(el));

        // Counter animation trigger
        const statsSection = document.querySelector('.hero-stats');
        if (statsSection) {
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            counterObserver.observe(statsSection);
        }

        // Stacked parallax testimonials
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        const testimonialObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    const delay = i * 150;
                    setTimeout(() => {
                        entry.target.classList.add('parallax-visible');
                    }, delay);
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -60px 0px' });
        testimonialCards.forEach(card => testimonialObserver.observe(card));

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

            });
        });
    </script>

