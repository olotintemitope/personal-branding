<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=syne:600,700,800" rel="stylesheet" />
<style>
    /* ═══════════════════════════════════════════════════
       TEMITOPE ADMIN — Custom Filament Theme
       Aesthetic: "Midnight Executive" — refined, premium
       ═══════════════════════════════════════════════════ */

    /* ── Root Overrides ──────────────────────────── */
    :root {
        --admin-accent: #6366f1;
        --admin-accent-light: #818cf8;
        --admin-accent-dark: #4f46e5;
        --admin-surface: #f8fafc;
        --admin-card: #ffffff;
        --admin-sidebar-bg: #0f172a;
        --admin-sidebar-hover: rgba(99, 102, 241, 0.08);
        --admin-sidebar-active: rgba(99, 102, 241, 0.15);
        --admin-border: #e2e8f0;
        --admin-text-primary: #0f172a;
        --admin-text-secondary: #64748b;
        --admin-gradient: linear-gradient(135deg, #4f46e5, #6366f1, #818cf8);
    }

    /* ── Sidebar — Dark Navy Executive ──────────── */
    .fi-sidebar {
        background: var(--admin-sidebar-bg) !important;
        border-right: 1px solid rgba(99, 102, 241, 0.1) !important;
    }

    /* Sidebar gradient accent strip */
    .fi-sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: var(--admin-gradient);
        z-index: 10;
    }

    /* Sidebar header area */
    .fi-sidebar-header {
        border-bottom: 1px solid rgba(99, 102, 241, 0.08) !important;
    }

    /* Brand logo text color on dark sidebar */
    .fi-sidebar .fi-logo,
    .fi-sidebar .fi-logo * {
        color: #e2e8f0 !important;
    }

    /* ── Sidebar Items — Correct Filament v5 selectors ── */
    .fi-sidebar .fi-sidebar-item-btn {
        color: #94a3b8 !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 0.5rem !important;
    }

    .fi-sidebar .fi-sidebar-item-btn:hover {
        color: #e2e8f0 !important;
        background: var(--admin-sidebar-hover) !important;
    }

    /* Active sidebar item */
    .fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-btn {
        color: #ffffff !important;
        background: var(--admin-sidebar-active) !important;
        position: relative;
    }

    /* Active item accent bar */
    .fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-btn::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 1.25rem;
        background: var(--admin-accent);
        border-radius: 0 2px 2px 0;
    }

    /* Sidebar item labels */
    .fi-sidebar .fi-sidebar-item-label {
        color: inherit !important;
    }

    /* Sidebar icons */
    .fi-sidebar .fi-sidebar-item-icon {
        color: #475569 !important;
        transition: color 0.2s !important;
    }

    .fi-sidebar .fi-sidebar-item-btn:hover .fi-sidebar-item-icon {
        color: var(--admin-accent-light) !important;
    }

    .fi-sidebar .fi-sidebar-item.fi-active .fi-sidebar-item-icon {
        color: var(--admin-accent-light) !important;
    }

    /* Sidebar group — the collapsible group headers */
    .fi-sidebar .fi-sidebar-group > .fi-sidebar-item-btn {
        color: rgba(148, 163, 184, 0.8) !important;
    }

    .fi-sidebar .fi-sidebar-group > .fi-sidebar-item-btn:hover {
        color: #e2e8f0 !important;
        background: rgba(99, 102, 241, 0.05) !important;
    }

    .fi-sidebar .fi-sidebar-group > .fi-sidebar-item-btn .fi-sidebar-item-label {
        font-size: 0.6875rem !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        font-weight: 700 !important;
    }

    .fi-sidebar .fi-sidebar-group > .fi-sidebar-item-btn svg {
        color: #475569 !important;
    }

    .fi-sidebar .fi-sidebar-group > .fi-sidebar-item-btn:hover svg {
        color: #94a3b8 !important;
    }

    /* Sidebar collapse toggle buttons in topbar */
    .fi-topbar-collapse-sidebar-btn-ctn .fi-icon-btn {
        color: #64748b !important;
    }
    .fi-topbar-collapse-sidebar-btn-ctn .fi-icon-btn:hover {
        color: var(--admin-accent) !important;
    }

    /* ── Topbar ────────────────────────────────── */
    .fi-topbar {
        border-bottom: 1px solid var(--admin-border) !important;
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px) saturate(1.4) !important;
        -webkit-backdrop-filter: blur(12px) saturate(1.4) !important;
    }

    /* Topbar brand logo */
    .fi-topbar .fi-logo {
        color: var(--admin-text-primary) !important;
    }

    /* ── Main Content Area ─────────────────────── */
    .fi-main {
        background: var(--admin-surface) !important;
    }

    /* ── Page Headers ──────────────────────────── */
    .fi-header-heading {
        font-family: 'Syne', 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 800 !important;
        letter-spacing: -0.025em !important;
        color: var(--admin-text-primary) !important;
    }

    /* ── Breadcrumbs ───────────────────────────── */
    .fi-breadcrumbs li a {
        transition: color 0.15s !important;
    }
    .fi-breadcrumbs li a:hover {
        color: var(--admin-accent) !important;
    }

    /* ── Cards / Sections ──────────────────────── */
    .fi-section {
        border-radius: 1rem !important;
        border: 1px solid var(--admin-border) !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.02) !important;
        overflow: hidden;
    }

    /* ── Stat Cards — Premium with Hover Effect ─── */
    .fi-wi-stats-overview-stat {
        border-radius: 1rem !important;
        border: 1px solid var(--admin-border) !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        position: relative;
        overflow: hidden;
    }

    .fi-wi-stats-overview-stat:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04) !important;
        transform: translateY(-2px);
        border-color: rgba(99, 102, 241, 0.2) !important;
    }

    /* Stat card top accent bar on hover */
    .fi-wi-stats-overview-stat::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--admin-gradient);
        opacity: 0;
        transition: opacity 0.3s;
    }
    .fi-wi-stats-overview-stat:hover::before {
        opacity: 1;
    }

    /* Stat card value — bigger, bolder, Syne font */
    .fi-wi-stats-overview-stat-value {
        font-family: 'Syne', 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 800 !important;
        font-size: 1.75rem !important;
        letter-spacing: -0.03em !important;
        color: var(--admin-text-primary) !important;
    }

    /* Stat card label — refined uppercase */
    .fi-wi-stats-overview-stat-label {
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.04em !important;
        font-size: 0.6875rem !important;
        color: var(--admin-text-secondary) !important;
    }

    /* ── Table Widgets ─────────────────────────── */
    .fi-ta-header-cell {
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.04em !important;
        font-size: 0.6875rem !important;
        color: var(--admin-text-secondary) !important;
    }

    .fi-ta-row {
        transition: background 0.15s !important;
    }

    .fi-ta-row:hover {
        background: rgba(99, 102, 241, 0.03) !important;
    }

    /* ── Widget Section Headings ────────────────── */
    .fi-section-header-heading {
        font-family: 'Syne', 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 700 !important;
        letter-spacing: -0.01em !important;
    }

    /* ── Buttons ───────────────────────────────── */
    .fi-btn-primary {
        box-shadow: 0 1px 2px rgba(79,70,229,0.15), 0 1px 3px rgba(0,0,0,0.05) !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .fi-btn-primary:hover {
        box-shadow: 0 4px 12px rgba(79,70,229,0.25), 0 1px 3px rgba(0,0,0,0.05) !important;
        transform: translateY(-1px);
    }

    /* ── Form Fields ───────────────────────────── */
    .fi-input-wrp:focus-within {
        border-color: var(--admin-accent-light) !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
    }

    /* ── Badges ────────────────────────────────── */
    .fi-badge {
        font-weight: 700 !important;
        font-size: 0.6875rem !important;
        letter-spacing: 0.02em !important;
        border-radius: 0.375rem !important;
    }

    /* ── Tabs ──────────────────────────────────── */
    .fi-tabs-tab-active {
        border-color: var(--admin-accent) !important;
        color: var(--admin-accent) !important;
    }

    /* ── Notifications ─────────────────────────── */
    .fi-notification {
        border-radius: 0.75rem !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1), 0 4px 10px rgba(0,0,0,0.05) !important;
    }

    /* ── Loading States ────────────────────────── */
    .fi-loading-indicator {
        background: var(--admin-gradient) !important;
    }

    /* ── Modal ─────────────────────────────────── */
    .fi-modal-window {
        border-radius: 1.25rem !important;
        box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
    }

    /* ── Pagination ────────────────────────────── */
    .fi-pagination-item-active {
        background: var(--admin-accent-dark) !important;
        border-color: var(--admin-accent) !important;
    }

    /* ── Relation Manager ──────────────────────── */
    .fi-relation-manager {
        border-radius: 1rem !important;
    }

    /* ── Smooth page transitions ───────────────── */
    .fi-main > * {
        animation: adminFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes adminFadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ── Scrollbar styling ─────────────────────── */
    .fi-sidebar ::-webkit-scrollbar {
        width: 4px;
    }
    .fi-sidebar ::-webkit-scrollbar-track {
        background: transparent;
    }
    .fi-sidebar ::-webkit-scrollbar-thumb {
        background: rgba(99, 102, 241, 0.2);
        border-radius: 2px;
    }
    .fi-sidebar ::-webkit-scrollbar-thumb:hover {
        background: rgba(99, 102, 241, 0.4);
    }

    /* ── Dark Mode Overrides ───────────────────── */
    .dark {
        --admin-surface: #0f172a;
        --admin-card: #1e293b;
        --admin-border: rgba(99, 102, 241, 0.12);
        --admin-text-primary: #f1f5f9;
        --admin-text-secondary: #94a3b8;
    }

    .dark .fi-topbar {
        background: rgba(15, 23, 42, 0.85) !important;
        border-color: rgba(99, 102, 241, 0.1) !important;
    }

    .dark .fi-main {
        background: #0c1222 !important;
    }

    .dark .fi-wi-stats-overview-stat {
        background: var(--admin-card) !important;
        border-color: rgba(99, 102, 241, 0.12) !important;
    }

    .dark .fi-wi-stats-overview-stat-value {
        color: var(--admin-text-primary) !important;
    }

    .dark .fi-section {
        border-color: rgba(99, 102, 241, 0.1) !important;
        background: var(--admin-card) !important;
    }

    .dark .fi-ta-row:hover {
        background: rgba(99, 102, 241, 0.06) !important;
    }

    /* ═══════════════════════════════════════════════════
       LOGIN PAGE — Midnight Executive Login
       ═══════════════════════════════════════════════════ */

    /* Full-page dark background with animated gradient mesh */
    .fi-simple-layout {
        background: #0a0e1a !important;
        position: relative;
        overflow: hidden;
        min-height: 100vh;
    }

    /* Animated gradient orbs */
    .fi-simple-layout::before {
        content: '';
        position: fixed;
        top: -40%;
        left: -20%;
        width: 80%;
        height: 80%;
        background: radial-gradient(ellipse at center, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
        animation: loginOrb1 15s ease-in-out infinite;
        pointer-events: none;
    }

    .fi-simple-layout::after {
        content: '';
        position: fixed;
        bottom: -30%;
        right: -15%;
        width: 70%;
        height: 70%;
        background: radial-gradient(ellipse at center, rgba(79, 70, 229, 0.12) 0%, transparent 70%);
        animation: loginOrb2 18s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes loginOrb1 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(10%, 10%) scale(1.1); }
        66% { transform: translate(-5%, 5%) scale(0.95); }
    }

    @keyframes loginOrb2 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(-8%, -5%) scale(1.05); }
        66% { transform: translate(5%, -8%) scale(0.9); }
    }

    /* Grid pattern overlay */
    .fi-simple-main {
        position: relative;
        z-index: 1;
    }

    .fi-simple-main::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(99, 102, 241, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.03) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none;
        z-index: 0;
    }

    /* Remove default white wrapper from fi-simple-main (login/auth pages only) */
    .fi-simple-layout .fi-simple-main {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
    }

    /* Login card container — glassmorphic */
    .fi-simple-main-ctn {
        position: relative;
        z-index: 2;
        animation: loginCardReveal 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes loginCardReveal {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.97);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .fi-simple-page {
        background: rgba(15, 23, 42, 0.75) !important;
        backdrop-filter: blur(20px) saturate(1.5) !important;
        -webkit-backdrop-filter: blur(20px) saturate(1.5) !important;
        border: 1px solid rgba(99, 102, 241, 0.15) !important;
        border-radius: 1.5rem !important;
        box-shadow:
            0 25px 60px rgba(0, 0, 0, 0.4),
            0 0 0 1px rgba(99, 102, 241, 0.08),
            inset 0 1px 0 rgba(255, 255, 255, 0.05) !important;
        padding: 2.5rem 2rem !important;
        position: relative;
        overflow: hidden;
    }

    /* Login card top accent line */
    .fi-simple-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 2px;
        background: var(--admin-gradient);
        border-radius: 0 0 2px 2px;
        z-index: 1;
    }

    /* Logo on login page — light text + spacing from accent line */
    .fi-simple-layout .fi-logo,
    .fi-simple-layout .fi-logo * {
        color: #e2e8f0 !important;
    }

    .fi-simple-header {
        padding-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    /* "Sign in" heading */
    .fi-simple-header-heading {
        font-family: 'Syne', 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 700 !important;
        color: #f1f5f9 !important;
        letter-spacing: -0.02em !important;
        font-size: 1.375rem !important;
    }

    /* Form labels on dark login */
    .fi-simple-layout .fi-fo-field-label-content {
        color: #94a3b8 !important;
    }

    /* Required asterisk */
    .fi-simple-layout .fi-fo-field-label-required-mark {
        color: var(--admin-accent-light) !important;
    }

    /* Input fields — dark glass style */
    .fi-simple-layout .fi-input-wrp {
        background: rgba(15, 23, 42, 0.6) !important;
        border-color: rgba(99, 102, 241, 0.15) !important;
        border-radius: 0.75rem !important;
        transition: all 0.2s ease !important;
    }

    .fi-simple-layout .fi-input-wrp:focus-within {
        border-color: var(--admin-accent) !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15), 0 0 20px rgba(99, 102, 241, 0.05) !important;
        background: rgba(15, 23, 42, 0.8) !important;
    }

    .fi-simple-layout .fi-input {
        color: #e2e8f0 !important;
    }

    .fi-simple-layout .fi-input::placeholder {
        color: #475569 !important;
    }

    /* Password reveal icon */
    .fi-simple-layout .fi-input-wrp .fi-icon-btn {
        color: #475569 !important;
    }
    .fi-simple-layout .fi-input-wrp .fi-icon-btn:hover {
        color: var(--admin-accent-light) !important;
    }

    /* Remember me checkbox */
    .fi-simple-layout .fi-checkbox-input {
        border-color: rgba(99, 102, 241, 0.3) !important;
        background: rgba(15, 23, 42, 0.6) !important;
    }
    .fi-simple-layout .fi-checkbox-input:checked {
        background: var(--admin-accent) !important;
        border-color: var(--admin-accent) !important;
    }

    /* "Remember me" label text */
    .fi-simple-layout label span {
        color: #94a3b8 !important;
    }

    /* Sign in button — premium glow */
    .fi-simple-layout .fi-btn {
        border-radius: 0.75rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.02em !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3), 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    }

    .fi-simple-layout .fi-btn:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4), 0 2px 6px rgba(0, 0, 0, 0.2) !important;
    }

    .fi-simple-layout .fi-btn:active {
        transform: translateY(0) !important;
    }

    /* Subtle noise texture on login background */
    .fi-simple-layout .fi-simple-main::after {
        content: '';
        position: fixed;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 0;
    }
</style>
