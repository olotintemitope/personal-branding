<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <title>{{ $post->title }} — Temitope Olotin</title>
    <meta name="description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
    <link rel="canonical" href="{{ route('blog.show', $post->slug) }}">

    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
    <meta property="og:image" content="{{ $post->getFirstMediaUrl('featured_image') ?: url('/images/my-logo.png') }}">
    <meta property="og:site_name" content="Temitope Olotin">
    <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() }}">
    <meta property="article:author" content="Temitope Olotin">
    @if($post->category)
    <meta property="article:section" content="{{ $post->category->name }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@laztopaz_">
    <meta name="twitter:creator" content="@laztopaz_">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 160) }}">
    <meta name="twitter:image" content="{{ $post->getFirstMediaUrl('featured_image') ?: url('/images/my-logo.png') }}">

    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,400i,500,600,700|outfit:300,400,500,600,700|jetbrains-mono:400,500|newsreader:400,400i,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php $readingTime = max(1, ceil(str_word_count(strip_tags($post->content)) / 200)); @endphp

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": @json($post->title),
        "description": @json($post->excerpt ?: Str::limit(strip_tags($post->content), 160)),
        "url": "{{ route('blog.show', $post->slug) }}",
        "datePublished": "{{ $post->published_at?->toIso8601String() }}",
        "dateModified": "{{ $post->updated_at->toIso8601String() }}",
        "author": {
            "@type": "Person",
            "name": "{{ $post->user->name ?? 'Temitope Olotin' }}",
            "url": "{{ url('/') }}"
        },
        "publisher": {
            "@type": "Person",
            "name": "Temitope Olotin",
            "url": "{{ url('/') }}"
        },
        "image": "{{ $post->getFirstMediaUrl('featured_image') ?: url('/images/my-logo.png') }}",
        "wordCount": {{ str_word_count(strip_tags($post->content)) }},
        "timeRequired": "PT{{ $readingTime }}M"
        @if($post->category)
        ,"articleSection": @json($post->category->name)
        @endif
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
            { "@type": "ListItem", "position": 2, "name": "Blog", "item": "{{ route('blog.index') }}" }
            @if($post->category)
            ,{ "@type": "ListItem", "position": 3, "name": @json($post->category->name), "item": "{{ route('blog.index', ['category' => $post->category->slug]) }}" }
            ,{ "@type": "ListItem", "position": 4, "name": @json($post->title) }
            @else
            ,{ "@type": "ListItem", "position": 3, "name": @json($post->title) }
            @endif
        ]
    }
    </script>
    <style>
        /* Article prose — editorial quality */
        .article-body { font-family: 'Newsreader', 'Cormorant Garamond', Georgia, serif; }
        .article-body h2 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600; font-size: 1.75rem; line-height: 1.2;
            color: var(--color-cream); margin-top: 3rem; margin-bottom: 1rem;
            padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.06);
            scroll-margin-top: 100px;
        }
        .article-body h3 {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600; font-size: 1.35rem; line-height: 1.3;
            color: var(--color-cream); margin-top: 2.25rem; margin-bottom: 0.75rem;
            scroll-margin-top: 100px;
        }
        .article-body p { font-size: 1.125rem; line-height: 1.85; color: var(--color-cream-muted); margin-bottom: 1.5rem; }
        .article-body p:first-of-type { font-size: 1.2rem; color: var(--color-cream); }
        .article-body a { color: var(--color-amber-brand); border-bottom: 1px solid rgba(212,160,23,0.3); transition: all 0.2s; text-decoration: none; }
        .article-body a:hover { color: var(--color-amber-light); border-bottom-color: var(--color-amber-light); }
        .article-body strong { color: var(--color-cream); font-weight: 600; }
        .article-body em { font-style: italic; }
        .article-body ul, .article-body ol { margin: 1.5rem 0; padding-left: 1.5rem; }
        .article-body li { font-size: 1.1rem; line-height: 1.8; color: var(--color-cream-muted); margin-bottom: 0.5rem; }
        .article-body li::marker { color: var(--color-amber-brand); }
        .article-body blockquote {
            margin: 2rem 0; padding: 1.5rem 2rem;
            border-left: 3px solid var(--color-amber-brand);
            background: rgba(212,160,23,0.04);
        }
        .article-body blockquote p { color: var(--color-cream); margin-bottom: 0; }
        .article-body code {
            font-family: 'JetBrains Mono', monospace; font-size: 0.85em;
            color: var(--color-amber-brand); background: rgba(212,160,23,0.08);
            padding: 0.15em 0.4em; border-radius: 2px;
        }
        .article-body pre {
            margin: 2rem 0; padding: 1.5rem;
            background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.06);
            border-radius: 4px; overflow-x: auto;
        }
        .article-body pre code { background: none; padding: 0; font-size: 0.9rem; color: var(--color-cream-muted); }
        .article-body img { border-radius: 4px; margin: 2rem 0; }
        .article-body hr { border: none; height: 1px; background: rgba(255,255,255,0.06); margin: 3rem 0; }

        .toc-link { transition: all 0.2s ease; }
        .toc-link.active { color: var(--color-amber-brand); transform: translateX(4px); }
        .toc-link.active::before {
            content: ''; position: absolute; left: -17px; top: 50%; transform: translateY(-50%);
            width: 2px; height: 20px; background: var(--color-amber-brand); border-radius: 1px;
        }
    </style>
</head>
<body class="min-h-screen bg-brand text-cream font-body antialiased">

    {{-- Grain --}}
    <div class="grain-overlay fixed inset-0 z-[9999] pointer-events-none opacity-[0.025] bg-repeat"></div>

    {{-- Reading progress --}}
    <div id="readingProgress" class="fixed top-16 left-0 h-0.5 bg-gradient-to-r from-amber-brand to-amber-light z-[100] transition-[width] duration-100 linear" style="width: 0%"></div>

    {{-- Navigation --}}
    <nav class="border-b border-white/[0.06] sticky top-0 z-50 backdrop-blur-2xl bg-brand/80">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12 h-16 flex items-center justify-between">
            <a href="/" class="inline-flex items-center h-10">
                <img src="/images/my-logo.png" alt="Temitope Olotin" class="h-10 w-auto invert">
            </a>
            <div class="flex items-center gap-6 sm:gap-8">
                <a href="/" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Home</a>
                <a href="/blog" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-amber-brand relative after:absolute after:-bottom-0.5 after:left-0 after:w-full after:h-px after:bg-amber-brand">Blog</a>
            </div>
        </div>
    </nav>

    <main class="relative z-10">
        <article>
            {{-- Header --}}
            <header class="pt-12 sm:pt-16 pb-10">
                <div class="max-w-3xl mx-auto px-6 md:px-12 lg:px-0">
                    {{-- Breadcrumbs --}}
                    <nav class="flex items-center gap-2 font-mono text-[0.625rem] text-cream-dim mb-6">
                        <a href="/" class="hover:text-amber-brand transition-colors">Home</a>
                        <span class="text-cream-faint">/</span>
                        <a href="{{ route('blog.index') }}" class="hover:text-amber-brand transition-colors">Blog</a>
                        @if($post->category)
                            <span class="text-cream-faint">/</span>
                            <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="hover:text-amber-brand transition-colors">{{ $post->category->name }}</a>
                        @endif
                    </nav>

                    {{-- Meta --}}
                    <div class="flex items-center gap-3 mb-5">
                        @if($post->category)
                            <span class="font-mono text-[0.625rem] font-medium px-2.5 py-1 rounded-sm bg-amber-brand/10 text-amber-brand border border-amber-brand/25 tracking-wider uppercase">
                                {{ $post->category->name }}
                            </span>
                        @endif
                        <span class="font-mono text-[0.6875rem] text-cream-dim">{{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                        <span class="text-cream-faint">&bull;</span>
                        <span class="font-mono text-[0.6875rem] text-cream-dim">{{ $readingTime }} min read</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-semibold text-cream leading-tight tracking-tight">
                        {{ $post->title }}
                    </h1>

                    @if($post->excerpt)
                        <p class="mt-5 text-lg text-cream-muted leading-relaxed font-light max-w-2xl">{{ $post->excerpt }}</p>
                    @endif

                    {{-- Author + Share --}}
                    <div class="mt-8 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-amber-brand/10 border border-amber-brand/25 flex items-center justify-center font-mono text-[0.6875rem] font-medium text-amber-brand">
                                {{ strtoupper(substr($post->user->name ?? 'T', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-cream">{{ $post->user->name ?? 'Temitope Olotin' }}</p>
                                <p class="text-xs text-cream-dim">Software Engineer & AI Consultant</p>
                            </div>
                        </div>
                        <div class="hidden sm:flex items-center gap-2">
                            <button onclick="copyLink()" class="p-2 border border-white/[0.08] rounded-sm text-cream-dim hover:text-amber-brand hover:border-amber-brand/25 transition-all" title="Copy link">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </button>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="p-2 border border-white/[0.08] rounded-sm text-cream-dim hover:text-amber-brand hover:border-amber-brand/25 transition-all" title="Share on X">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="p-2 border border-white/[0.08] rounded-sm text-cream-dim hover:text-amber-brand hover:border-amber-brand/25 transition-all" title="Share on LinkedIn">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                        </div>
                    </div>

                    <hr class="mt-10 h-px border-0 bg-gradient-to-r from-amber-brand/30 via-white/[0.06] to-transparent">
                </div>

                {{-- Featured Image --}}
                <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-0 mt-10">
                    <div class="relative aspect-[2/1] overflow-hidden rounded bg-brand-elevated">
                        <img src="{{ $post->getFirstMediaUrl('featured_image') ?: '/images/my-logo.png' }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full {{ $post->getFirstMediaUrl('featured_image') ? 'object-cover' : 'object-contain p-20 invert opacity-10' }}">
                    </div>
                </div>
            </header>

            {{-- Article Body + Sidebar --}}
            <div class="max-w-[1240px] mx-auto px-6 md:px-12">
                <div class="lg:grid lg:grid-cols-[1fr_240px] lg:gap-16">
                    {{-- Main Content --}}
                    <div class="min-w-0">
                        <div class="max-w-3xl article-body" id="articleContent">
                            {!! $post->content !!}
                        </div>

                        {{-- Tags --}}
                        @if($post->tags->count())
                            <div class="max-w-3xl mt-12 pt-8 border-t border-white/[0.06]">
                                <p class="font-mono text-[0.625rem] font-medium tracking-[0.15em] uppercase text-cream-dim mb-4">Tagged</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                        <span class="font-mono text-[0.6875rem] px-3 py-1.5 border border-white/[0.08] rounded-sm text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand transition-all">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Author Bio --}}
                        <div class="max-w-3xl mt-12 p-8 border border-white/[0.06] rounded hover:border-amber-brand/25 transition-colors">
                            <div class="flex items-start gap-4">
                                <div class="shrink-0 w-14 h-14 rounded-full bg-amber-brand/10 border border-amber-brand/25 flex items-center justify-center font-mono text-lg font-medium text-amber-brand">
                                    {{ strtoupper(substr($post->user->name ?? 'T', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-display text-lg font-semibold text-cream">{{ $post->user->name ?? 'Temitope Olotin' }}</p>
                                    <p class="text-sm text-cream-muted mt-1 leading-relaxed font-light">
                                        Senior Software Engineer & AI Consultant based in Lagos, Nigeria. Helping startups and enterprises ship AI-powered products faster.
                                    </p>
                                    <div class="flex items-center gap-4 mt-3">
                                        <a href="https://x.com/laztopaz_" target="_blank" rel="noopener" class="text-cream-faint hover:text-amber-brand transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                                        <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" class="text-cream-faint hover:text-amber-brand transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg></a>
                                        <a href="https://www.linkedin.com/in/olotin-temitope-53b43272/" target="_blank" rel="noopener" class="text-cream-faint hover:text-amber-brand transition-colors"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <aside class="hidden lg:block">
                        <div class="sticky top-[84px]">
                            <div id="tableOfContents" class="mb-8">
                                <p class="font-mono text-[0.625rem] font-medium tracking-[0.15em] uppercase text-cream-dim mb-4">On this page</p>
                                <nav id="tocNav" class="relative pl-4 border-l border-white/[0.06] space-y-1"></nav>
                            </div>
                            <div class="pt-6 border-t border-white/[0.06]">
                                <a href="{{ route('blog.index') }}" class="font-mono text-[0.6875rem] font-medium text-cream-dim hover:text-amber-brand inline-flex items-center gap-2 hover:gap-3 transition-all">
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
                <section class="mt-20 pb-20 border-t border-white/[0.06]">
                    <div class="max-w-[1240px] mx-auto px-6 md:px-12 pt-12">
                        <div class="flex items-center gap-4 mb-10">
                            <h2 class="font-display text-2xl font-semibold text-cream">Continue Reading</h2>
                            <div class="flex-1 h-px bg-white/[0.06]"></div>
                            <a href="{{ route('blog.index') }}" class="font-mono text-[0.6875rem] font-medium text-amber-brand hover:opacity-70 transition-opacity">View all</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-white/[0.06]">
                            @foreach($relatedPosts as $related)
                                <a href="{{ route('blog.show', $related->slug) }}" class="group flex flex-col bg-brand hover:bg-brand-elevated transition-all">
                                    <div class="relative aspect-[16/10] overflow-hidden bg-brand-elevated">
                                        <img src="{{ $related->getFirstMediaUrl('featured_image') ?: '/images/my-logo.png' }}"
                                             alt="{{ $related->title }}"
                                             class="w-full h-full {{ $related->getFirstMediaUrl('featured_image') ? 'object-cover' : 'object-contain p-10 invert opacity-10' }} transition-transform duration-700 group-hover:scale-105">
                                    </div>
                                    <div class="flex flex-col flex-1 p-6">
                                        @if($related->category)
                                            <span class="font-mono text-[0.5625rem] font-medium text-amber-brand tracking-wider uppercase mb-2">{{ $related->category->name }}</span>
                                        @endif
                                        <h3 class="font-display text-lg font-semibold text-cream leading-snug group-hover:text-amber-brand transition-colors line-clamp-2">{{ $related->title }}</h3>
                                        <div class="mt-auto pt-4 flex items-center justify-between">
                                            <span class="font-mono text-[0.625rem] text-cream-dim">{{ $related->published_at->format('M d, Y') }}</span>
                                            <span class="font-mono text-sm text-amber-brand group-hover:translate-x-1 transition-transform">&rarr;</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
                <div class="lg:hidden max-w-3xl mx-auto px-6 mt-12 pt-8 border-t border-white/[0.06] pb-20">
                    <a href="{{ route('blog.index') }}" class="font-mono text-[0.6875rem] font-medium text-amber-brand inline-flex items-center gap-2 hover:gap-3 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                        Back to all articles
                    </a>
                </div>
            @endif
        </article>
    </main>

    {{-- Footer --}}
    <footer class="relative z-10 border-t border-white/[0.06] py-8">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="/" class="inline-flex items-center h-8">
                    <img src="/images/my-logo.png" alt="Temitope Olotin" class="h-8 w-auto invert">
                </a>
                <p class="font-mono text-[0.6875rem] text-cream-faint">&copy; {{ date('Y') }} Temitope Olotin. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Reading progress
        const bar = document.getElementById('readingProgress');
        const content = document.getElementById('articleContent');
        if (bar && content) {
            window.addEventListener('scroll', () => {
                const r = content.getBoundingClientRect();
                const top = r.top + window.scrollY - 200;
                const p = Math.min(Math.max((window.scrollY - top) / r.height, 0), 1);
                bar.style.width = (p * 100) + '%';
            }, { passive: true });
        }

        // TOC
        const tocNav = document.getElementById('tocNav');
        const tocBox = document.getElementById('tableOfContents');
        if (tocNav && content) {
            const headings = content.querySelectorAll('h2, h3');
            if (!headings.length && tocBox) { tocBox.style.display = 'none'; }
            else {
                headings.forEach((h, i) => {
                    h.id = 'h-' + i;
                    const a = document.createElement('a');
                    a.href = '#h-' + i;
                    a.className = 'toc-link relative block text-sm py-1.5 text-cream-dim hover:text-cream transition-all' + (h.tagName === 'H3' ? ' pl-4' : '');
                    a.textContent = h.textContent;
                    tocNav.appendChild(a);
                });
                const links = tocNav.querySelectorAll('.toc-link');
                new IntersectionObserver(entries => {
                    entries.forEach(e => {
                        if (e.isIntersecting) {
                            links.forEach(l => l.classList.remove('active'));
                            tocNav.querySelector(`a[href="#${e.target.id}"]`)?.classList.add('active');
                        }
                    });
                }, { rootMargin: '-100px 0px -70% 0px' }).observe(...headings);
                headings.forEach(h => new IntersectionObserver(entries => {
                    entries.forEach(e => {
                        if (e.isIntersecting) {
                            links.forEach(l => l.classList.remove('active'));
                            tocNav.querySelector(`a[href="#${e.target.id}"]`)?.classList.add('active');
                        }
                    });
                }, { rootMargin: '-100px 0px -70% 0px' }).observe(h));
            }
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const btn = event.currentTarget;
                const orig = btn.innerHTML;
                btn.innerHTML = '<svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                setTimeout(() => { btn.innerHTML = orig; }, 2000);
            });
        }
    </script>
</body>
</html>
