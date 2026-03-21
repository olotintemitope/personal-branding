<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <title>Blog — Temitope Olotin | Software Engineering, AI & Laravel</title>
    <meta name="description" content="Insights on software engineering, AI, Laravel, and building products — by Temitope Olotin.">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Blog — Temitope Olotin">
    <meta property="og:description" content="Insights on software engineering, AI, Laravel, and building products — by Temitope Olotin.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ url('/images/my-logo.png') }}">
    <meta property="og:site_name" content="Temitope Olotin">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{{ '@laztopaz_' }}">
    <meta name="twitter:title" content="Blog — Temitope Olotin">
    <meta name="twitter:description" content="Insights on software engineering, AI, Laravel, and building products.">
    <meta name="twitter:image" content="{{ url('/images/my-logo.png') }}">

    @if($posts->currentPage() > 1)
        <link rel="prev" href="{{ $posts->previousPageUrl() }}">
    @endif
    @if($posts->hasMorePages())
        <link rel="next" href="{{ $posts->nextPageUrl() }}">
    @endif

    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|outfit:300,400,500,600,700|jetbrains-mono:400,500" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $blogSchema = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Blog — Temitope Olotin',
            'description' => 'Insights on software engineering, AI, Laravel, and building products.',
            'url' => url()->current(),
            'author' => [
                '@type' => 'Person',
                'name' => 'Temitope Olotin',
                'url' => url('/'),
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    <script type="application/ld+json">{!! $blogSchema !!}</script>
</head>
<body class="min-h-screen bg-brand text-cream font-body antialiased">

    {{-- Grain --}}
    <div class="grain-overlay fixed inset-0 z-[9999] pointer-events-none opacity-[0.025] bg-repeat"></div>

    {{-- Navigation --}}
    <nav class="border-b border-white/[0.06] sticky top-0 z-50 backdrop-blur-2xl bg-brand/80">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12 h-16 flex items-center justify-between">
            <a href="/" class="inline-flex items-center h-10">
                <img src="/images/my-logo.png" alt="Temitope Olotin" class="h-10 w-auto invert">
            </a>
            <div class="flex items-center gap-6 sm:gap-8">
                <a href="/" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Home</a>
                <a href="/blog" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-amber-brand relative after:absolute after:-bottom-0.5 after:left-0 after:w-full after:h-px after:bg-amber-brand">Blog</a>
                @auth
                    <a href="/admin" class="font-mono text-[0.625rem] font-medium tracking-wide uppercase px-3 py-1.5 border border-white/10 text-cream-dim hover:text-amber-brand hover:border-amber-brand/25 rounded-sm transition-all">Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="relative z-10">

        @if($posts->count())
            @php
                $featured = $posts->first();
                $remaining = $posts->slice(1);
                $readTime = fn($post) => max(1, ceil(str_word_count(strip_tags($post->content)) / 200));
            @endphp

            {{-- Page Header --}}
            <section class="pt-12 sm:pt-16 pb-8 rv">
                <div class="max-w-[1240px] mx-auto px-6 md:px-12">
                    <div class="flex items-end justify-between">
                        <div>
                            <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-4">/ Journal <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                            <h1 class="font-display text-5xl sm:text-6xl font-semibold text-cream leading-none tracking-tight">Blog</h1>
                        </div>
                        <p class="hidden md:block text-sm text-cream-dim max-w-xs text-right leading-relaxed font-light">
                            Thoughts on engineering, AI,<br>and building products that matter.
                        </p>
                    </div>
                    <hr class="mt-8 h-px border-0 bg-gradient-to-r from-amber-brand/40 via-amber-brand/10 to-transparent">
                </div>
            </section>

            {{-- Category Filter --}}
            @if($categories->count())
                <section class="pb-8 rv rv-d1">
                    <div class="max-w-[1240px] mx-auto px-6 md:px-12">
                        <div class="flex items-center gap-2 sm:gap-3 overflow-x-auto pb-2 scrollbar-hide">
                            <a href="{{ route('blog.index') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-sm text-xs font-mono font-medium whitespace-nowrap border transition-all
                                      {{ !request('category')
                                          ? 'bg-amber-brand text-brand border-amber-brand'
                                          : 'bg-transparent text-cream-dim border-white/[0.08] hover:border-amber-brand/25 hover:text-amber-brand' }}">
                                All Posts
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-sm text-xs font-mono font-medium whitespace-nowrap border transition-all
                                          {{ request('category') === $category->slug
                                              ? 'bg-amber-brand text-brand border-amber-brand'
                                              : 'bg-transparent text-cream-dim border-white/[0.08] hover:border-amber-brand/25 hover:text-amber-brand' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- Featured Post --}}
            <section class="pb-12 sm:pb-16 rv rv-d2">
                <div class="max-w-[1240px] mx-auto px-6 md:px-12">
                    <a href="{{ route('blog.show', $featured->slug) }}"
                       class="group block border border-white/[0.06] hover:border-amber-brand/25 rounded overflow-hidden transition-all duration-500">
                        <div class="grid md:grid-cols-2 min-h-[380px]">
                            {{-- Image --}}
                            <div class="relative overflow-hidden bg-brand-elevated">
                                <img src="{{ $featured->getFirstMediaUrl('featured_image') ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1200&h=600&fit=crop&q=80' }}"
                                     alt="{{ $featured->title }}"
                                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute top-5 left-5 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-sm bg-amber-brand text-brand font-mono text-[0.5625rem] font-semibold tracking-[0.1em] uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-brand/40 animate-pulse-dot"></span>
                                        Featured
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="relative flex flex-col justify-center p-8 sm:p-10 lg:p-14 bg-brand">
                                <div class="flex items-center gap-3 mb-5">
                                    @if($featured->category)
                                        <span class="font-mono text-[0.625rem] font-medium px-2.5 py-1 rounded-sm bg-amber-brand/10 text-amber-brand border border-amber-brand/25 tracking-wider uppercase">
                                            {{ $featured->category->name }}
                                        </span>
                                    @endif
                                    <span class="font-mono text-[0.6875rem] text-cream-dim">{{ $featured->published_at->format('M d, Y') }}</span>
                                    <span class="text-cream-faint">&bull;</span>
                                    <span class="font-mono text-[0.6875rem] text-cream-dim">{{ $readTime($featured) }} min</span>
                                </div>

                                <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-semibold text-cream leading-tight group-hover:text-amber-brand transition-colors duration-300">
                                    {{ $featured->title }}
                                </h2>

                                @if($featured->excerpt)
                                    <p class="mt-4 text-sm text-cream-muted leading-relaxed font-light line-clamp-3">{{ $featured->excerpt }}</p>
                                @endif

                                <div class="mt-8 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-amber-brand/10 border border-amber-brand/25 flex items-center justify-center font-mono text-[0.6875rem] font-medium text-amber-brand">
                                            {{ strtoupper(substr($featured->user->name ?? 'T', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-cream">{{ $featured->user->name ?? 'Temitope Olotin' }}</p>
                                            <p class="text-xs text-cream-dim">Author</p>
                                        </div>
                                    </div>
                                    <span class="font-mono text-[0.6875rem] font-medium text-amber-brand inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                                        Read article
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            {{-- Remaining Posts Grid --}}
            @if($remaining->count())
                <section class="pb-16 sm:pb-24 rv rv-d3">
                    <div class="max-w-[1240px] mx-auto px-6 md:px-12">
                        <div class="flex items-center gap-4 mb-10">
                            <h2 class="font-display text-2xl font-semibold text-cream">Latest Articles</h2>
                            <div class="flex-1 h-px bg-white/[0.06]"></div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-white/[0.06]">
                            @foreach($remaining as $post)
                                <a href="{{ route('blog.show', $post->slug) }}"
                                   class="group flex flex-col bg-brand hover:bg-brand-elevated transition-all duration-400">

                                    {{-- Image --}}
                                    <div class="relative aspect-[16/10] overflow-hidden bg-brand-elevated">
                                        <img src="{{ $post->getFirstMediaUrl('featured_image') ?: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&h=500&fit=crop&q=80' }}"
                                             alt="{{ $post->title }}"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex flex-col flex-1 p-6">
                                        <div class="flex items-center gap-3 mb-3">
                                            @if($post->category)
                                                <span class="font-mono text-[0.5625rem] font-medium px-2 py-0.5 rounded-sm bg-amber-brand/10 text-amber-brand border border-amber-brand/25 tracking-wider uppercase">
                                                    {{ $post->category->name }}
                                                </span>
                                            @endif
                                            <span class="font-mono text-[0.625rem] text-cream-faint">{{ $readTime($post) }} min</span>
                                        </div>

                                        <h3 class="font-display text-lg font-semibold text-cream leading-snug group-hover:text-amber-brand transition-colors duration-300 line-clamp-2">
                                            {{ $post->title }}
                                        </h3>

                                        @if($post->excerpt)
                                            <p class="mt-2.5 text-sm text-cream-muted leading-relaxed font-light line-clamp-2 flex-1">{{ $post->excerpt }}</p>
                                        @endif

                                        <div class="mt-5 pt-4 border-t border-white/[0.06] flex items-center justify-between">
                                            <span class="font-mono text-[0.625rem] text-cream-dim">{{ $post->published_at->format('M d, Y') }}</span>
                                            <span class="font-mono text-[0.6875rem] font-medium text-amber-brand inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
                                                Read
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- Pagination --}}
            @if($posts->hasPages())
                <section class="pb-16">
                    <div class="max-w-[1240px] mx-auto px-6 md:px-12">
                        <div class="flex items-center justify-center gap-2">
                            @if($posts->onFirstPage())
                                <span class="w-10 h-10 border border-white/[0.06] rounded-sm flex items-center justify-center text-cream-faint cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </span>
                            @else
                                <a href="{{ $posts->previousPageUrl() }}" class="w-10 h-10 border border-white/[0.08] rounded-sm flex items-center justify-center text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </a>
                            @endif

                            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                @if($page == $posts->currentPage())
                                    <span class="w-10 h-10 bg-amber-brand text-brand rounded-sm flex items-center justify-center font-mono text-sm font-semibold">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="w-10 h-10 border border-white/[0.08] rounded-sm flex items-center justify-center font-mono text-sm text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand transition-all">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($posts->hasMorePages())
                                <a href="{{ $posts->nextPageUrl() }}" class="w-10 h-10 border border-white/[0.08] rounded-sm flex items-center justify-center text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @else
                                <span class="w-10 h-10 border border-white/[0.06] rounded-sm flex items-center justify-center text-cream-faint cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            @endif
                        </div>
                    </div>
                </section>
            @endif

        @else
            {{-- Empty State --}}
            <section class="py-32">
                <div class="max-w-md mx-auto text-center px-6">
                    <div class="w-16 h-16 mx-auto mb-6 border border-white/[0.06] rounded flex items-center justify-center">
                        <svg class="w-7 h-7 text-cream-faint" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-semibold text-cream mb-3">No posts yet</h2>
                    <p class="text-cream-dim leading-relaxed font-light">Content is brewing. Check back soon for articles on engineering, AI, and product building.</p>
                </div>
            </section>
        @endif

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
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('vis'); observer.unobserve(e.target); } });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.rv').forEach(el => observer.observe(el));
    </script>
</body>
</html>
