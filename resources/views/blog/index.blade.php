<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog — Temitope Olotin</title>
    <meta name="description" content="Insights on software engineering, AI, Laravel, and building products — by Temitope Olotin.">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700|syne:600,700,800|space-mono:400,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .blog-fade-in { animation: blogFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .blog-fade-in-delay-1 { animation-delay: 0.1s; }
        .blog-fade-in-delay-2 { animation-delay: 0.2s; }
        .blog-fade-in-delay-3 { animation-delay: 0.3s; }
        .blog-fade-in-delay-4 { animation-delay: 0.4s; }
        @keyframes blogFadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .featured-glow { box-shadow: 0 0 80px -20px rgba(99, 102, 241, 0.15); }
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
        .noise-overlay {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
        }
        .category-pill { transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .category-pill:hover { transform: translateY(-1px); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="min-h-screen bg-[#060b18] text-slate-200 font-[Plus_Jakarta_Sans] antialiased">

    {{-- Ambient background --}}
    <div class="fixed inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-blue-600/[0.04] rounded-full blur-[128px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-indigo-600/[0.03] rounded-full blur-[128px]"></div>
        <div class="absolute inset-0 noise-overlay opacity-50"></div>
    </div>

    {{-- Navigation --}}
    <nav class="border-b border-white/[0.06] sticky top-0 z-50 backdrop-blur-2xl bg-[#060b18]/70">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 h-[72px] flex items-center justify-between">
            <a href="/" class="font-[Syne] font-extrabold text-xl text-white tracking-tight hover:text-blue-400 transition-colors duration-300">
                Temitope<span class="text-blue-400">.</span>
            </a>
            <div class="flex items-center gap-8">
                <a href="/" class="text-[13px] font-medium text-slate-400 hover:text-white transition-colors duration-300 tracking-wide uppercase">Home</a>
                <a href="/blog" class="text-[13px] font-medium text-white tracking-wide uppercase relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-px after:bg-blue-400">Blog</a>
                @auth
                    <a href="/admin" class="text-xs font-semibold px-4 py-2 rounded-full bg-white/[0.06] text-slate-300 border border-white/[0.08] hover:bg-white/[0.1] hover:text-white transition-all duration-300">
                        Admin
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="relative z-10">

        @if($posts->count())
            @php
                $featured = $posts->first();
                $remaining = $posts->slice(1);
                $readTime = fn($post) => max(1, ceil(str_word_count(strip_tags($post->content)) / 200));
            @endphp

            {{-- Page Header --}}
            <section class="pt-16 pb-8 blog-fade-in">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="font-[Space_Mono] text-xs tracking-[0.3em] uppercase text-blue-400/80 mb-3">/ Journal</p>
                            <h1 class="font-[Syne] text-5xl md:text-6xl font-extrabold text-white leading-[1.05] tracking-tight">
                                Blog
                            </h1>
                        </div>
                        <p class="hidden md:block text-sm text-slate-500 max-w-xs text-right leading-relaxed">
                            Thoughts on engineering, AI,<br>and building products that matter.
                        </p>
                    </div>
                    <div class="mt-8 h-px bg-gradient-to-r from-blue-500/40 via-indigo-500/20 to-transparent"></div>
                </div>
            </section>

            {{-- Category Filter --}}
            @if($categories->count())
                <section class="pb-8 blog-fade-in blog-fade-in-delay-1">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <div class="flex items-center gap-3 overflow-x-auto scrollbar-hide pb-2">
                            <a href="{{ route('blog.index') }}"
                               class="category-pill inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold whitespace-nowrap border transition-all duration-300
                                      {{ !request('category')
                                          ? 'bg-white text-[#060b18] border-white shadow-lg shadow-white/10'
                                          : 'bg-white/[0.04] text-slate-400 border-white/[0.08] hover:bg-white/[0.08] hover:text-white hover:border-white/[0.15]' }}">
                                All Posts
                                <span class="text-xs px-1.5 py-0.5 rounded-full {{ !request('category') ? 'bg-black/10 text-black/60' : 'bg-white/[0.08] text-slate-500' }}">{{ $posts->total() }}</span>
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                   class="category-pill inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold whitespace-nowrap border transition-all duration-300
                                          {{ request('category') === $category->slug
                                              ? 'bg-white text-[#060b18] border-white shadow-lg shadow-white/10'
                                              : 'bg-white/[0.04] text-slate-400 border-white/[0.08] hover:bg-white/[0.08] hover:text-white hover:border-white/[0.15]' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            {{-- Featured Post --}}
            <section class="pb-16 blog-fade-in blog-fade-in-delay-2">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <a href="{{ route('blog.show', $featured->slug) }}"
                       class="group block featured-glow card-shine rounded-3xl overflow-hidden bg-white/[0.02] border border-white/[0.06] hover:border-white/[0.12] transition-all duration-500">
                        <div class="grid md:grid-cols-2 min-h-[420px]">
                            {{-- Image --}}
                            <div class="relative overflow-hidden">
                                @if($featured->getFirstMediaUrl('featured_image'))
                                    <img src="{{ $featured->getFirstMediaUrl('featured_image') }}"
                                         alt="{{ $featured->title }}"
                                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/30 via-indigo-600/20 to-purple-600/10">
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-24 h-24 rounded-3xl bg-white/[0.05] border border-white/[0.08] flex items-center justify-center">
                                                <svg class="w-10 h-10 text-blue-400/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- Featured badge --}}
                                <div class="absolute top-6 left-6 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/[0.12] backdrop-blur-md text-xs font-bold text-white tracking-wider uppercase border border-white/[0.15]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                                        Featured
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="relative flex flex-col justify-center p-10 lg:p-14">
                                <div class="flex items-center gap-3 mb-6">
                                    @if($featured->category)
                                        <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/20 tracking-wide uppercase">
                                            {{ $featured->category->name }}
                                        </span>
                                    @endif
                                    <span class="text-xs text-slate-500 font-[Space_Mono]">{{ $featured->published_at->format('M d, Y') }}</span>
                                    <span class="text-slate-700">&bull;</span>
                                    <span class="text-xs text-slate-500 font-[Space_Mono]">{{ $readTime($featured) }} min read</span>
                                </div>

                                <h2 class="font-[Syne] text-3xl lg:text-4xl font-extrabold text-white leading-[1.15] tracking-tight group-hover:text-blue-400 transition-colors duration-300">
                                    {{ $featured->title }}
                                </h2>

                                @if($featured->excerpt)
                                    <p class="mt-5 text-base text-slate-400 leading-relaxed line-clamp-3">
                                        {{ $featured->excerpt }}
                                    </p>
                                @endif

                                <div class="mt-8 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold">
                                            {{ strtoupper(substr($featured->user->name ?? 'T', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-200">{{ $featured->user->name ?? 'Temitope Olotin' }}</p>
                                            <p class="text-xs text-slate-500">Author</p>
                                        </div>
                                    </div>

                                    <span class="inline-flex items-center gap-2 text-sm font-bold text-blue-400 group-hover:gap-3 transition-all duration-300">
                                        Read article
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            {{-- Remaining Posts Grid --}}
            @if($remaining->count())
                <section class="pb-24 blog-fade-in blog-fade-in-delay-3">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <div class="flex items-center gap-4 mb-10">
                            <h2 class="font-[Syne] text-2xl font-bold text-white tracking-tight">Latest Articles</h2>
                            <div class="flex-1 h-px bg-white/[0.06]"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                            @foreach($remaining as $post)
                                <a href="{{ route('blog.show', $post->slug) }}"
                                   class="group card-shine flex flex-col rounded-2xl overflow-hidden bg-white/[0.02] border border-white/[0.06] hover:border-white/[0.12] transition-all duration-500 hover:-translate-y-1">

                                    {{-- Image --}}
                                    <div class="relative aspect-[16/10] overflow-hidden bg-gradient-to-br from-slate-800/50 to-slate-900/50">
                                        @if($post->getFirstMediaUrl('featured_image'))
                                            <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                                                 alt="{{ $post->title }}"
                                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                        @else
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/15 via-indigo-600/10 to-purple-600/5 flex items-center justify-center">
                                                <div class="w-16 h-16 rounded-2xl bg-white/[0.04] border border-white/[0.06] flex items-center justify-center">
                                                    <svg class="w-7 h-7 text-blue-400/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- Gradient overlay at bottom --}}
                                        <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#060b18] to-transparent pointer-events-none"></div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex flex-col flex-1 p-6 pt-4">
                                        <div class="flex items-center gap-3 mb-4">
                                            @if($post->category)
                                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-blue-500/15 text-blue-400 tracking-wider uppercase">
                                                    {{ $post->category->name }}
                                                </span>
                                            @endif
                                            <span class="text-xs text-slate-600 font-[Space_Mono]">{{ $readTime($post) }} min</span>
                                        </div>

                                        <h3 class="font-[Syne] text-lg font-bold text-white leading-snug group-hover:text-blue-400 transition-colors duration-300 line-clamp-2">
                                            {{ $post->title }}
                                        </h3>

                                        @if($post->excerpt)
                                            <p class="mt-3 text-sm text-slate-400 leading-relaxed line-clamp-2 flex-1">
                                                {{ $post->excerpt }}
                                            </p>
                                        @endif

                                        <div class="mt-5 pt-4 border-t border-white/[0.05] flex items-center justify-between">
                                            <span class="text-xs text-slate-500 font-[Space_Mono]">{{ $post->published_at->format('M d, Y') }}</span>
                                            <span class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-400 group-hover:gap-2.5 transition-all duration-300">
                                                Read
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
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
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <div class="flex items-center justify-center gap-2">
                            @if($posts->onFirstPage())
                                <span class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center text-slate-600 cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </span>
                            @else
                                <a href="{{ $posts->previousPageUrl() }}" class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/[0.08] flex items-center justify-center text-slate-300 hover:bg-white/[0.08] hover:text-white transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </a>
                            @endif

                            @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                @if($page == $posts->currentPage())
                                    <span class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-500/20">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/[0.08] flex items-center justify-center text-sm font-medium text-slate-400 hover:bg-white/[0.08] hover:text-white transition-all duration-300">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if($posts->hasMorePages())
                                <a href="{{ $posts->nextPageUrl() }}" class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/[0.08] flex items-center justify-center text-slate-300 hover:bg-white/[0.08] hover:text-white transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            @else
                                <span class="w-10 h-10 rounded-xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center text-slate-600 cursor-not-allowed">
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
                    <div class="w-20 h-20 mx-auto mb-8 rounded-3xl bg-white/[0.03] border border-white/[0.06] flex items-center justify-center">
                        <svg class="w-9 h-9 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>
                    <h2 class="font-[Syne] text-3xl font-bold text-slate-200 mb-3">No posts yet</h2>
                    <p class="text-slate-500 leading-relaxed">Content is brewing. Check back soon for articles on engineering, AI, and product building.</p>
                </div>
            </section>
        @endif

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

</body>
</html>
