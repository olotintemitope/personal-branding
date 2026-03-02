<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} — Temitope Olotin</title>
    <meta name="description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
    @if($post->getFirstMediaUrl('featured_image'))
        <meta property="og:image" content="{{ $post->getFirstMediaUrl('featured_image') }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="@laztopaz_">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700|syne:600,700,800|space-mono:400,700|newsreader:400,400i,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php
        $readingTime = max(1, ceil(str_word_count(strip_tags($post->content)) / 200));
    @endphp
    <style>
        [x-cloak] { display: none !important; }
        .article-fade-in { animation: articleFadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .article-fade-in-d1 { animation-delay: 0.08s; }
        .article-fade-in-d2 { animation-delay: 0.16s; }
        .article-fade-in-d3 { animation-delay: 0.24s; }
        .article-fade-in-d4 { animation-delay: 0.32s; }
        @keyframes articleFadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .noise-overlay {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
        }

        /* Article prose styling — editorial, magazine quality */
        .article-body { font-family: 'Newsreader', 'Plus Jakarta Sans', Georgia, serif; }
        .article-body h2 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            line-height: 1.2;
            color: #f1f5f9;
            margin-top: 3rem;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            scroll-margin-top: 100px;
        }
        .article-body h3 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.35rem;
            line-height: 1.3;
            color: #e2e8f0;
            margin-top: 2.25rem;
            margin-bottom: 0.75rem;
            scroll-margin-top: 100px;
        }
        .article-body p {
            font-size: 1.125rem;
            line-height: 1.85;
            color: #94a3b8;
            margin-bottom: 1.5rem;
        }
        .article-body p:first-of-type { font-size: 1.2rem; color: #cbd5e1; }
        .article-body a { color: #60a5fa; text-decoration: none; border-bottom: 1px solid rgba(96,165,250,0.3); transition: all 0.2s; }
        .article-body a:hover { color: #93c5fd; border-bottom-color: #93c5fd; }
        .article-body strong { color: #e2e8f0; font-weight: 600; }
        .article-body em { font-style: italic; color: #b8c5d6; }
        .article-body ul, .article-body ol { margin: 1.5rem 0; padding-left: 1.5rem; }
        .article-body li { font-size: 1.1rem; line-height: 1.8; color: #94a3b8; margin-bottom: 0.5rem; }
        .article-body li::marker { color: #3b82f6; }
        .article-body blockquote {
            margin: 2rem 0;
            padding: 1.5rem 2rem;
            border-left: 3px solid #3b82f6;
            background: rgba(59,130,246,0.05);
            border-radius: 0 12px 12px 0;
        }
        .article-body blockquote p { color: #cbd5e1; font-style: normal; margin-bottom: 0; }
        .article-body code {
            font-family: 'Space Mono', monospace;
            font-size: 0.85em;
            color: #60a5fa;
            background: rgba(59,130,246,0.1);
            padding: 0.15em 0.4em;
            border-radius: 5px;
        }
        .article-body pre {
            margin: 2rem 0;
            padding: 1.5rem;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            overflow-x: auto;
        }
        .article-body pre code { background: none; padding: 0; font-size: 0.9rem; color: #cbd5e1; }
        .article-body img { border-radius: 16px; margin: 2rem 0; }
        .article-body hr { border: none; height: 1px; background: rgba(255,255,255,0.06); margin: 3rem 0; }

        /* TOC styling */
        .toc-link { transition: all 0.2s ease; }
        .toc-link.active { color: #60a5fa; transform: translateX(4px); }
        .toc-link.active::before {
            content: '';
            position: absolute;
            left: -17px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: #3b82f6;
            border-radius: 2px;
        }

        .share-btn { transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .share-btn:hover { transform: translateY(-2px); }

        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .card-shine { position: relative; overflow: hidden; }
        .card-shine::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.03) 45%, rgba(255,255,255,0.05) 50%, rgba(255,255,255,0.03) 55%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
            z-index: 1;
            pointer-events: none;
        }
        .card-shine:hover::before { transform: translateX(100%); }

        /* Reading progress bar */
        .reading-progress {
            position: fixed;
            top: 72px;
            left: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6);
            z-index: 100;
            transition: width 0.1s linear;
        }
    </style>
</head>
<body class="min-h-screen bg-[#060b18] text-slate-200 font-[Plus_Jakarta_Sans] antialiased">

    {{-- Ambient background --}}
    <div class="fixed inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 left-1/3 w-[600px] h-[600px] bg-blue-600/[0.04] rounded-full blur-[128px]"></div>
        <div class="absolute bottom-1/3 right-1/4 w-[400px] h-[400px] bg-indigo-600/[0.03] rounded-full blur-[128px]"></div>
        <div class="absolute inset-0 noise-overlay opacity-50"></div>
    </div>

    {{-- Reading progress --}}
    <div class="reading-progress" id="readingProgress" style="width: 0%"></div>

    {{-- Navigation --}}
    <nav class="border-b border-white/[0.06] sticky top-0 z-50 backdrop-blur-2xl bg-[#060b18]/70">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 h-[72px] flex items-center justify-between">
            <a href="/" class="font-[Syne] font-extrabold text-xl text-white tracking-tight hover:text-blue-400 transition-colors duration-300">
                Temitope<span class="text-blue-400">.</span>
            </a>
            <div class="flex items-center gap-8">
                <a href="/" class="text-[13px] font-medium text-slate-400 hover:text-white transition-colors duration-300 tracking-wide uppercase">Home</a>
                <a href="/blog" class="text-[13px] font-medium text-white tracking-wide uppercase relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-px after:bg-blue-400">Blog</a>
            </div>
        </div>
    </nav>

    <div class="relative z-10">

        <article>
            {{-- Hero Section --}}
            <header class="relative">
                @if($post->getFirstMediaUrl('featured_image'))
                    {{-- Full-width hero with image --}}
                    <div class="relative h-[50vh] min-h-[400px] max-h-[560px] overflow-hidden">
                        <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                             alt="{{ $post->title }}"
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#060b18] via-[#060b18]/60 to-[#060b18]/30"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-[#060b18]/40 to-transparent"></div>
                    </div>
                    {{-- Content overlaid at bottom --}}
                    <div class="relative -mt-48 pb-12 article-fade-in">
                        <div class="max-w-4xl mx-auto px-6 lg:px-8">
                            {{-- Breadcrumbs --}}
                            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 font-[Space_Mono]">
                                <a href="/" class="hover:text-slate-300 transition-colors">Home</a>
                                <span class="text-slate-700">/</span>
                                <a href="{{ route('blog.index') }}" class="hover:text-slate-300 transition-colors">Blog</a>
                                @if($post->category)
                                    <span class="text-slate-700">/</span>
                                    <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="hover:text-slate-300 transition-colors">{{ $post->category->name }}</a>
                                @endif
                            </nav>

                            {{-- Meta --}}
                            <div class="flex items-center gap-3 mb-5 article-fade-in article-fade-in-d1">
                                @if($post->category)
                                    <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/20 tracking-wider uppercase backdrop-blur-sm">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                <span class="text-xs text-slate-400 font-[Space_Mono]">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                                <span class="text-slate-700">&bull;</span>
                                <span class="text-xs text-slate-400 font-[Space_Mono]">{{ $readingTime }} min read</span>
                            </div>

                            {{-- Title --}}
                            <h1 class="font-[Syne] text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-white leading-[1.1] tracking-tight max-w-3xl article-fade-in article-fade-in-d2">
                                {{ $post->title }}
                            </h1>

                            @if($post->excerpt)
                                <p class="mt-6 text-lg text-slate-300 leading-relaxed max-w-2xl article-fade-in article-fade-in-d3">
                                    {{ $post->excerpt }}
                                </p>
                            @endif

                            {{-- Author + Share --}}
                            <div class="mt-8 flex items-center justify-between article-fade-in article-fade-in-d4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-base font-bold ring-2 ring-[#060b18] ring-offset-2 ring-offset-blue-500/20">
                                        {{ strtoupper(substr($post->user->name ?? 'T', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-white">{{ $post->user->name ?? 'Temitope Olotin' }}</p>
                                        <p class="text-xs text-slate-500">Software Engineer & AI Consultant</p>
                                    </div>
                                </div>
                                <div class="hidden sm:flex items-center gap-2">
                                    <button onclick="copyLink()" class="share-btn p-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-colors" title="Copy link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </button>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="share-btn p-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-colors" title="Share on X">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="share-btn p-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-colors" title="Share on LinkedIn">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- No image — clean text header --}}
                    <div class="pt-16 pb-12 article-fade-in">
                        <div class="max-w-4xl mx-auto px-6 lg:px-8">
                            <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6 font-[Space_Mono]">
                                <a href="/" class="hover:text-slate-300 transition-colors">Home</a>
                                <span class="text-slate-700">/</span>
                                <a href="{{ route('blog.index') }}" class="hover:text-slate-300 transition-colors">Blog</a>
                                @if($post->category)
                                    <span class="text-slate-700">/</span>
                                    <span class="text-slate-400">{{ $post->category->name }}</span>
                                @endif
                            </nav>
                            <div class="flex items-center gap-3 mb-5">
                                @if($post->category)
                                    <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 tracking-wider uppercase">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                <span class="text-xs text-slate-400 font-[Space_Mono]">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                                <span class="text-slate-700">&bull;</span>
                                <span class="text-xs text-slate-400 font-[Space_Mono]">{{ $readingTime }} min read</span>
                            </div>
                            <h1 class="font-[Syne] text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-white leading-[1.1] tracking-tight max-w-3xl">
                                {{ $post->title }}
                            </h1>
                            @if($post->excerpt)
                                <p class="mt-6 text-lg text-slate-400 leading-relaxed max-w-2xl">
                                    {{ $post->excerpt }}
                                </p>
                            @endif
                            <div class="mt-8 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-base font-bold">
                                    {{ strtoupper(substr($post->user->name ?? 'T', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $post->user->name ?? 'Temitope Olotin' }}</p>
                                    <p class="text-xs text-slate-500">Software Engineer & AI Consultant</p>
                                </div>
                            </div>
                            <div class="mt-10 h-px bg-gradient-to-r from-blue-500/30 via-white/[0.06] to-transparent"></div>
                        </div>
                    </div>
                @endif
            </header>

            {{-- Article Body + Sidebar --}}
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-[1fr_280px] lg:gap-16">

                    {{-- Main Content --}}
                    <div class="min-w-0">
                        <div class="max-w-3xl article-body" id="articleContent">
                            {!! $post->content !!}
                        </div>

                        {{-- Tags --}}
                        @if($post->tags->count())
                            <div class="max-w-3xl mt-12 pt-8 border-t border-white/[0.06]">
                                <p class="text-xs font-bold text-slate-500 tracking-wider uppercase mb-4">Tagged</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                        <span class="text-xs font-semibold px-4 py-2 rounded-full bg-white/[0.04] text-slate-300 border border-white/[0.08] hover:bg-white/[0.08] hover:text-white transition-all duration-300 cursor-default">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Author Bio Card --}}
                        <div class="max-w-3xl mt-12 p-8 rounded-2xl bg-white/[0.02] border border-white/[0.06]">
                            <div class="flex items-start gap-5">
                                <div class="shrink-0 w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xl font-bold">
                                    {{ strtoupper(substr($post->user->name ?? 'T', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-[Syne] text-lg font-bold text-white">{{ $post->user->name ?? 'Temitope Olotin' }}</p>
                                    <p class="text-sm text-slate-400 mt-1 leading-relaxed">
                                        Senior Software Engineer & AI Consultant based in Lagos, Nigeria. Helping startups and enterprises ship AI-powered products faster. 10+ years building production-grade web apps, APIs, and intelligent automation.
                                    </p>
                                    <div class="flex items-center gap-4 mt-4">
                                        <a href="https://x.com/laztopaz_" target="_blank" rel="noopener" class="text-slate-500 hover:text-blue-400 transition-colors">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                        </a>
                                        <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" class="text-slate-500 hover:text-blue-400 transition-colors">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                                        </a>
                                        <a href="https://www.linkedin.com/in/olotin-temitope-53b43272/" target="_blank" rel="noopener" class="text-slate-500 hover:text-blue-400 transition-colors">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile share buttons --}}
                        <div class="sm:hidden mt-8 flex items-center gap-3">
                            <button onclick="copyLink()" class="share-btn flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-sm font-medium text-slate-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                Copy link
                            </button>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="share-btn flex-1 flex items-center justify-center gap-2 py-3 rounded-xl bg-white/[0.04] border border-white/[0.08] text-sm font-medium text-slate-400 hover:text-white transition-all">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                Share on X
                            </a>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <aside class="hidden lg:block">
                        <div class="sticky top-[100px]">
                            {{-- Table of Contents --}}
                            <div id="tableOfContents" class="mb-8">
                                <p class="text-xs font-bold text-slate-500 tracking-wider uppercase mb-4">On this page</p>
                                <nav id="tocNav" class="relative pl-4 border-l border-white/[0.06] space-y-1">
                                    {{-- Populated by JS --}}
                                </nav>
                            </div>

                            {{-- Share --}}
                            <div class="pt-6 border-t border-white/[0.06]">
                                <p class="text-xs font-bold text-slate-500 tracking-wider uppercase mb-4">Share</p>
                                <div class="flex items-center gap-2">
                                    <button onclick="copyLink()" class="share-btn p-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-colors" title="Copy link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </button>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="share-btn p-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-colors" title="Share on X">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="share-btn p-2.5 rounded-xl bg-white/[0.04] border border-white/[0.08] text-slate-400 hover:text-white hover:bg-white/[0.08] transition-colors" title="Share on LinkedIn">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                </div>
                            </div>

                            {{-- Back to Blog --}}
                            <div class="pt-6 mt-6 border-t border-white/[0.06]">
                                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-400 hover:text-blue-400 hover:gap-3 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                                    All articles
                                </a>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>

            {{-- Related Posts --}}
            @if(isset($relatedPosts) && $relatedPosts->count())
                <section class="mt-24 pb-24 border-t border-white/[0.06]">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-16">
                        <div class="flex items-center gap-4 mb-10">
                            <h2 class="font-[Syne] text-2xl font-bold text-white tracking-tight">Continue Reading</h2>
                            <div class="flex-1 h-px bg-white/[0.06]"></div>
                            <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors">View all</a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
                            @foreach($relatedPosts as $related)
                                <a href="{{ route('blog.show', $related->slug) }}"
                                   class="group card-shine flex flex-col rounded-2xl overflow-hidden bg-white/[0.02] border border-white/[0.06] hover:border-white/[0.12] transition-all duration-500 hover:-translate-y-1">
                                    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-slate-800/50 to-slate-900/50">
                                        @if($related->getFirstMediaUrl('featured_image'))
                                            <img src="{{ $related->getFirstMediaUrl('featured_image') }}"
                                                 alt="{{ $related->title }}"
                                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                        @else
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/15 via-indigo-600/10 to-purple-600/5 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-blue-400/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-[#060b18] to-transparent pointer-events-none"></div>
                                    </div>
                                    <div class="flex flex-col flex-1 p-6 pt-3">
                                        <div class="flex items-center gap-2 mb-3">
                                            @if($related->category)
                                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-blue-500/15 text-blue-400 tracking-wider uppercase">{{ $related->category->name }}</span>
                                            @endif
                                            <span class="text-xs text-slate-600 font-[Space_Mono]">{{ max(1, ceil(str_word_count(strip_tags($related->content)) / 200)) }} min</span>
                                        </div>
                                        <h3 class="font-[Syne] text-lg font-bold text-white leading-snug group-hover:text-blue-400 transition-colors duration-300 line-clamp-2">
                                            {{ $related->title }}
                                        </h3>
                                        <div class="mt-auto pt-4 flex items-center justify-between">
                                            <span class="text-xs text-slate-500 font-[Space_Mono]">{{ $related->published_at->format('M d, Y') }}</span>
                                            <span class="text-sm font-bold text-blue-400 group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
                {{-- Back to blog (mobile fallback when no related posts) --}}
                <div class="lg:hidden max-w-3xl mx-auto px-6 mt-12 pt-8 border-t border-white/[0.06] pb-24">
                    <a href="{{ route('blog.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-blue-400 hover:text-blue-300 hover:gap-3 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                        Back to all articles
                    </a>
                </div>
            @endif

        </article>

    </div>

    {{-- Footer --}}
    <footer class="relative z-10 border-t border-white/[0.06]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <a href="/" class="font-[Syne] font-extrabold text-lg text-white tracking-tight">
                    Temitope<span class="text-blue-400">.</span>
                </a>
                <p class="text-sm text-slate-600">&copy; {{ date('Y') }} Temitope Olotin. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Reading progress bar
        const progressBar = document.getElementById('readingProgress');
        const articleContent = document.getElementById('articleContent');
        if (progressBar && articleContent) {
            window.addEventListener('scroll', () => {
                const rect = articleContent.getBoundingClientRect();
                const articleTop = rect.top + window.scrollY - 200;
                const articleHeight = rect.height;
                const scrolled = window.scrollY - articleTop;
                const progress = Math.min(Math.max(scrolled / articleHeight, 0), 1);
                progressBar.style.width = (progress * 100) + '%';
            }, { passive: true });
        }

        // Table of Contents generation
        const tocNav = document.getElementById('tocNav');
        const tocContainer = document.getElementById('tableOfContents');
        if (tocNav && articleContent) {
            const headings = articleContent.querySelectorAll('h2, h3');
            if (headings.length === 0 && tocContainer) {
                tocContainer.style.display = 'none';
            } else {
                headings.forEach((heading, i) => {
                    const id = 'heading-' + i;
                    heading.id = id;
                    const link = document.createElement('a');
                    link.href = '#' + id;
                    link.className = 'toc-link relative block text-sm py-1.5 text-slate-500 hover:text-slate-200 transition-all duration-200' +
                        (heading.tagName === 'H3' ? ' pl-4' : '');
                    link.textContent = heading.textContent;
                    tocNav.appendChild(link);
                });

                // Active heading tracking
                const tocLinks = tocNav.querySelectorAll('.toc-link');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            tocLinks.forEach(l => l.classList.remove('active'));
                            const activeLink = tocNav.querySelector(`a[href="#${entry.target.id}"]`);
                            if (activeLink) activeLink.classList.add('active');
                        }
                    });
                }, { rootMargin: '-100px 0px -70% 0px', threshold: 0 });

                headings.forEach(h => observer.observe(h));
            }
        }

        // Copy link to clipboard
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const btn = event.currentTarget;
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                setTimeout(() => { btn.innerHTML = originalHTML; }, 2000);
            });
        }
    </script>

</body>
</html>
