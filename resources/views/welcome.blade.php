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

    <meta property="og:type" content="website">
    <meta property="og:title" content="Temitope Olotin — Senior Software Engineer & AI Consultant">
    <meta property="og:description" content="Ship your AI-powered product faster. 10+ years of battle-tested engineering for startups and enterprises — from MVP to scale.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:site_name" content="Temitope Olotin">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="{{ url('/images/my-logo.png') }}">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@@laztopaz_">
    <meta name="twitter:creator" content="@@laztopaz_">
    <meta name="twitter:title" content="Temitope Olotin — Senior Software Engineer & AI Consultant">
    <meta name="twitter:description" content="Ship your AI-powered product faster. 10+ years of battle-tested engineering for startups and enterprises.">
    <meta name="twitter:image" content="{{ url('/images/my-logo.png') }}">

    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|outfit:300,400,500,600,700|jetbrains-mono:400,500" as="style">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|outfit:300,400,500,600,700|jetbrains-mono:400,500" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Structured Data -->
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
            { "@@type": "EducationalOrganization", "name": "Ambrose Alli University, Ekpoma" },
            { "@@type": "EducationalOrganization", "name": "The Federal Polytechnic, Ado-Ekiti" }
        ],
        "address": { "@@type": "PostalAddress", "addressCountry": "NG", "addressRegion": "Lagos" }
    }
    </script>
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "FAQPage",
        "mainEntity": [
            { "@@type": "Question", "name": "How quickly can you start on my project?", "acceptedAnswer": { "@@type": "Answer", "text": "Most projects kick off within 1-2 weeks of the discovery call. For urgent needs, work can start within 48 hours depending on current availability." } },
            { "@@type": "Question", "name": "Do you work with startups or just enterprises?", "acceptedAnswer": { "@@type": "Answer", "text": "Both. The sweet spot is founders who need their MVP shipped fast and enterprises scaling existing products. The approach adapts, but the engineering standards don't." } },
            { "@@type": "Question", "name": "Do you take equity instead of payment?", "acceptedAnswer": { "@@type": "Answer", "text": "No. Fair, transparent rates are charged for production-grade work. Pricing is startup-friendly — senior-level engineering without the Silicon Valley price tag." } },
            { "@@type": "Question", "name": "Can you integrate AI into my existing application?", "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Specializing in retrofitting AI into existing systems — intelligent automation with n8n and Zapier, custom AI agents with LangChain, or LLM integration for document processing." } },
            { "@@type": "Question", "name": "What happens after the project is delivered?", "acceptedAnswer": { "@@type": "Answer", "text": "Every Full Build includes 30 days of post-launch support. After that, many clients move to a monthly retainer. You own 100% of the source code and documentation either way." } },
            { "@@type": "Question", "name": "What timezone do you work in?", "acceptedAnswer": { "@@type": "Answer", "text": "Based in Lagos, Nigeria (WAT / GMT+1), with over a decade of experience working with teams across Canada, New York, London, and Belgium. Flexible scheduling overlaps with North American and European business hours." } }
        ]
    }
    </script>
</head>
<body class="font-body bg-brand text-cream antialiased overflow-x-hidden leading-relaxed">

    <!-- Scroll progress -->
    <div id="scrollBar" class="fixed top-0 left-0 h-0.5 bg-gradient-to-r from-amber-brand to-amber-light z-[200] w-0 transition-[width] duration-[50ms] linear"></div>

    <!-- Grain -->
    <div class="grain-overlay fixed inset-0 z-[9999] pointer-events-none opacity-[0.025] bg-repeat"></div>

    <!-- ─── Nav ──────────────────────────────────────────────── -->
    <nav id="mainNav" class="fixed top-0 inset-x-0 z-100 py-3 sm:py-4 transition-all duration-400">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <div class="flex items-center justify-between">
                <a href="#" class="inline-flex items-center h-12 sm:h-16 lg:h-20">
                    <img src="/images/my-logo.png" alt="Temitope Olotin logo" class="h-10 sm:h-14 lg:h-[76px] w-auto invert">
                </a>

                <div class="hidden md:flex items-center gap-9">
                    <a href="#services" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Services</a>
                    <a href="#projects" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Projects</a>
                    <a href="#pricing" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Pricing</a>
                    <a href="#credentials" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Credentials</a>
                    <a href="#contact" class="font-mono text-[0.6875rem] font-medium tracking-wider uppercase text-cream-dim hover:text-amber-brand transition-colors">Contact</a>
                </div>

                <div class="flex items-center gap-3">
                    <a href="#contact" class="font-mono text-[0.6rem] sm:text-[0.6875rem] font-medium tracking-wide uppercase px-3 sm:px-5 py-2 sm:py-2.5 border border-amber-brand/25 text-amber-brand rounded-sm hover:bg-amber-brand hover:text-brand hover:shadow-[0_0_24px_rgba(212,160,23,0.15)] transition-all">Book a Call</a>
                    <button class="md:hidden flex flex-col gap-[5px] p-1" onclick="document.getElementById('mobMenu').classList.add('open')" aria-label="Open menu">
                        <span class="block w-[22px] h-[1.5px] bg-cream-dim"></span>
                        <span class="block w-[22px] h-[1.5px] bg-cream-dim"></span>
                        <span class="block w-[22px] h-[1.5px] bg-cream-dim"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobMenu" class="hidden fixed inset-0 z-[99] bg-brand/[0.97] backdrop-blur-3xl flex-col items-center justify-center gap-10 [&.open]:flex">
        <button class="absolute top-7 right-7 text-2xl text-cream-dim" onclick="this.parentElement.classList.remove('open')" aria-label="Close menu">&times;</button>
        <a href="#services" onclick="this.parentElement.classList.remove('open')" class="font-display text-3xl font-medium text-cream-muted hover:text-amber-brand transition-colors">Services</a>
        <a href="#projects" onclick="this.parentElement.classList.remove('open')" class="font-display text-3xl font-medium text-cream-muted hover:text-amber-brand transition-colors">Projects</a>
        <a href="#pricing" onclick="this.parentElement.classList.remove('open')" class="font-display text-3xl font-medium text-cream-muted hover:text-amber-brand transition-colors">Pricing</a>
        <a href="#credentials" onclick="this.parentElement.classList.remove('open')" class="font-display text-3xl font-medium text-cream-muted hover:text-amber-brand transition-colors">Credentials</a>
        <a href="#contact" onclick="this.parentElement.classList.remove('open')" class="font-display text-3xl font-medium text-cream-muted hover:text-amber-brand transition-colors">Contact</a>
        <a href="#contact" onclick="this.parentElement.classList.remove('open')" class="font-display text-3xl font-medium text-amber-brand transition-colors">Book a Call</a>
    </div>

    <!-- ─── Hero ─────────────────────────────────────────────── -->
    <section id="hero" class="min-h-screen flex items-center relative pt-28 pb-16 sm:pt-36 sm:pb-24">
        <!-- Glows -->
        <div class="absolute -top-[15%] -right-[10%] w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(212,160,23,0.15)_0%,transparent_65%)] animate-breathe pointer-events-none"></div>
        <div class="absolute -bottom-[20%] -left-[15%] w-[500px] h-[500px] rounded-full bg-[radial-gradient(circle,rgba(212,160,23,0.06)_0%,transparent_70%)] animate-breathe-slow pointer-events-none"></div>
        <!-- Diagonal lines -->
        <div class="hero-diag-lines absolute inset-0 pointer-events-none"></div>

        <div class="max-w-[1240px] mx-auto px-6 md:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_1fr] gap-8 lg:gap-16 items-center">
                <!-- Content -->
                <div class="rv">
                    <div class="rv inline-flex items-center gap-2 sm:gap-2.5 px-3 sm:px-4 py-1.5 border border-amber-brand/25 rounded-sm font-mono text-[0.6rem] sm:text-[0.6875rem] font-medium text-amber-brand mb-6 sm:mb-10 bg-amber-brand/[0.04]">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse-dot shrink-0"></span>
                        <span class="hidden sm:inline">Accepting new clients &middot; Lagos &middot; New York &middot; London &middot; Canada</span>
                        <span class="sm:hidden">Accepting clients &middot; Global</span>
                    </div>

                    <h1 class="rv rv-d1 font-display text-[2.5rem] sm:text-[3rem] md:text-[3.5rem] lg:text-[5rem] xl:text-[5.5rem] font-semibold leading-none tracking-tight mb-6 sm:mb-8">
                        Your Next Product<br>
                        Deserves <em class="italic text-amber-brand">AI-First</em><br>
                        Engineering
                    </h1>

                    <p class="rv rv-d2 text-base sm:text-lg text-cream-muted max-w-[520px] mb-8 sm:mb-12 font-light leading-relaxed">
                        I'm <strong class="text-cream font-medium">Temitope Olotin</strong> &mdash; I help founders go from idea to shipped product in weeks, not months. 10+ years of production-grade software engineering, now with AI at the core. No equity, no middlemen &mdash; just clean architecture and real results at startup-friendly rates.
                    </p>

                    <div class="rv rv-d3 flex flex-col sm:flex-row flex-wrap gap-4 mb-12 sm:mb-16">
                        <a href="#contact" class="inline-flex items-center justify-center gap-2.5 px-8 py-3.5 bg-amber-brand text-brand font-mono text-xs font-semibold tracking-wider uppercase rounded-sm hover:bg-amber-light hover:shadow-[0_0_40px_rgba(212,160,23,0.15),0_4px_20px_rgba(0,0,0,0.4)] hover:-translate-y-0.5 transition-all">
                            Book a Free Discovery Call
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 10 5-5M5 5h5v5"/></svg>
                        </a>
                        <a href="#projects" class="inline-flex items-center justify-center gap-2.5 px-8 py-3.5 border border-white/10 text-cream-muted font-mono text-xs font-medium tracking-wider uppercase rounded-sm hover:border-amber-brand/25 hover:text-amber-brand transition-all">
                            See My Work
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 4 5 5-5 5"/></svg>
                        </a>
                    </div>

                    <div class="rv rv-d4 flex flex-wrap gap-8 sm:gap-14">
                        <div>
                            <div class="font-display text-3xl sm:text-4xl font-semibold text-cream leading-none" data-count="10">0+</div>
                            <div class="font-mono text-[0.625rem] tracking-wider uppercase text-cream-dim mt-1.5">Years Shipping Code</div>
                        </div>
                        <div>
                            <div class="font-display text-3xl sm:text-4xl font-semibold text-cream leading-none" data-count="120">0+</div>
                            <div class="font-mono text-[0.625rem] tracking-wider uppercase text-cream-dim mt-1.5">Products Delivered</div>
                        </div>
                        <div>
                            <div class="font-display text-3xl sm:text-4xl font-semibold text-cream leading-none" data-count="9">0+</div>
                            <div class="font-mono text-[0.625rem] tracking-wider uppercase text-cream-dim mt-1.5">Years Mentoring Devs</div>
                        </div>
                    </div>
                </div>

                <!-- Terminal Illustration -->
                <div class="hidden lg:block rv rv-d3 relative">
                    <div class="bg-brand-elevated/90 border border-white/10 rounded-md overflow-hidden shadow-[0_24px_80px_rgba(0,0,0,0.5)] max-w-[480px] ml-auto">
                        <div class="flex items-center gap-1.5 px-4 py-3 bg-[#231e1a]/80 border-b border-white/[0.06]">
                            <span class="w-2 h-2 rounded-full bg-red-500 opacity-70"></span>
                            <span class="w-2 h-2 rounded-full bg-yellow-500 opacity-70"></span>
                            <span class="w-2 h-2 rounded-full bg-green-500 opacity-70"></span>
                            <span class="font-mono text-[0.6875rem] text-cream-dim ml-2">consultant.py</span>
                        </div>
                        <div class="px-6 py-5 font-mono text-[0.8125rem] leading-8">
                            <span class="block"><span class="text-amber-brand">from</span> <span class="text-cream-muted">langchain</span> <span class="text-amber-brand">import</span> <span class="text-amber-light">Agent</span></span>
                            <span class="block"><span class="text-amber-brand">from</span> <span class="text-cream-muted">llama_index</span> <span class="text-amber-brand">import</span> <span class="text-amber-light">VectorDB</span></span>
                            <span class="block">&nbsp;</span>
                            <span class="block"><span class="text-cream-dim italic"># ship fast, ship right</span></span>
                            <span class="block"><span class="text-amber-brand">class</span> <span class="text-amber-light">AIConsultant</span><span class="text-cream-faint">(</span><span class="text-cream-muted">Agent</span><span class="text-cream-faint">):</span></span>
                            <span class="block">&nbsp;&nbsp;<span class="text-amber-brand">def</span> <span class="text-amber-light">solve</span><span class="text-cream-faint">(</span><span class="text-cream-muted">self</span><span class="text-cream-faint">,</span> <span class="text-cream-muted">problem</span><span class="text-cream-faint">):</span></span>
                            <span class="block">&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-amber-brand">return</span> <span class="text-cream-muted">self</span><span class="text-cream-faint">.</span><span class="text-amber-light">ship</span><span class="text-cream-faint">(</span><span class="text-green-300">"production"</span><span class="text-cream-faint">)</span><span class="inline-block w-2 h-3.5 bg-amber-brand animate-blink align-text-bottom ml-0.5"></span></span>
                        </div>
                    </div>

                    <span class="absolute -top-2.5 right-5 px-3 py-1 border border-white/10 rounded-sm font-mono text-[0.625rem] font-medium uppercase bg-brand-elevated/85 backdrop-blur-sm text-amber-brand animate-float" style="animation-delay:0s">Laravel</span>
                    <span class="absolute bottom-[60px] -left-[30px] px-3 py-1 border border-green-400/20 rounded-sm font-mono text-[0.625rem] font-medium uppercase bg-brand-elevated/85 backdrop-blur-sm text-green-300 animate-float" style="animation-delay:1.5s">Python</span>
                    <span class="absolute top-[40%] -right-[40px] px-3 py-1 border border-indigo-300/20 rounded-sm font-mono text-[0.625rem] font-medium uppercase bg-brand-elevated/85 backdrop-blur-sm text-indigo-300 animate-float" style="animation-delay:3s">GPT-4o</span>
                    <span class="absolute -bottom-2.5 right-20 px-3 py-1 border border-white/10 rounded-sm font-mono text-[0.625rem] font-medium uppercase bg-brand-elevated/85 backdrop-blur-sm text-cream-dim animate-float" style="animation-delay:2s">n8n</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Trust Bar ────────────────────────────────────────── -->
    <div class="rv border-y border-white/[0.06] py-8">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4 sm:gap-x-12 sm:gap-y-4">
                <span class="font-mono text-[0.625rem] font-medium tracking-[0.15em] uppercase text-cream-faint whitespace-nowrap">Trusted by teams at</span>
                <div class="flex flex-wrap items-center justify-center gap-x-10 gap-y-4">
                    <span class="font-display text-lg font-semibold text-cream-faint opacity-50 hover:opacity-90 hover:text-amber-brand transition-all whitespace-nowrap">Andela</span>
                    <span class="font-display text-lg font-semibold text-cream-faint opacity-50 hover:opacity-90 hover:text-amber-brand transition-all whitespace-nowrap">Cause Strategy</span>
                    <span class="font-display text-lg font-semibold text-cream-faint opacity-50 hover:opacity-90 hover:text-amber-brand transition-all whitespace-nowrap">Waldo</span>
                    <span class="font-display text-lg font-semibold text-cream-faint opacity-50 hover:opacity-90 hover:text-amber-brand transition-all whitespace-nowrap">Accounteer</span>
                    <span class="font-display text-lg font-semibold text-cream-faint opacity-50 hover:opacity-90 hover:text-amber-brand transition-all whitespace-nowrap">BeautySpace</span>
                    <span class="font-display text-lg font-semibold text-cream-faint opacity-50 hover:opacity-90 hover:text-amber-brand transition-all whitespace-nowrap">LearnKast</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Services ─────────────────────────────────────────── -->
    <section id="services" class="py-16 sm:py-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <div class="rv">
                <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">01 &mdash; What I Do <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Four Ways I Help<br>You Win</h2>
                <p class="text-base text-cream-muted max-w-[560px] font-light leading-relaxed">Every engagement is structured around one goal: shipping software that moves the needle for your business.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-px bg-white/[0.06] mt-12">
                <div class="rv rv-d1 bg-brand p-8 sm:p-10 hover:bg-brand-elevated transition-colors group">
                    <div class="font-display text-5xl font-semibold text-cream-faint/30 leading-none mb-5 group-hover:text-amber-brand/50 transition-colors">I</div>
                    <h3 class="font-display text-xl font-semibold text-cream mb-3">AI Solutions & Automation</h3>
                    <p class="text-sm text-cream-muted font-light leading-relaxed">Custom AI agents and intelligent workflows that replace 40+ hours of manual work per week &mdash; built with LangChain, LlamaIndex, GPT-4o, n8n, and Zapier.</p>
                </div>
                <div class="rv rv-d2 bg-brand p-8 sm:p-10 hover:bg-brand-elevated transition-colors group">
                    <div class="font-display text-5xl font-semibold text-cream-faint/30 leading-none mb-5 group-hover:text-amber-brand/50 transition-colors">II</div>
                    <h3 class="font-display text-xl font-semibold text-cream mb-3">Web Application Development</h3>
                    <p class="text-sm text-cream-muted font-light leading-relaxed">From first commit to production in weeks. Full-stack Laravel, Livewire, and Vue.js apps &mdash; battle-tested architecture that scales with your user base.</p>
                </div>
                <div class="rv rv-d3 bg-brand p-8 sm:p-10 hover:bg-brand-elevated transition-colors group">
                    <div class="font-display text-5xl font-semibold text-cream-faint/30 leading-none mb-5 group-hover:text-amber-brand/50 transition-colors">III</div>
                    <h3 class="font-display text-xl font-semibold text-cream mb-3">API Design & Architecture</h3>
                    <p class="text-sm text-cream-muted font-light leading-relaxed">REST APIs designed for 99.9% uptime and effortless third-party integrations. Your systems talk to each other without the pain.</p>
                </div>
                <div class="rv rv-d4 bg-brand p-8 sm:p-10 hover:bg-brand-elevated transition-colors group">
                    <div class="font-display text-5xl font-semibold text-cream-faint/30 leading-none mb-5 group-hover:text-amber-brand/50 transition-colors">IV</div>
                    <h3 class="font-display text-xl font-semibold text-cream mb-3">Data Analytics & Insights</h3>
                    <p class="text-sm text-cream-muted font-light leading-relaxed">Turn your messy data into clear decisions. Analytics pipelines, real-time dashboards, and predictive models your investors will love.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Tech Stack ───────────────────────────────────────── -->
    <section id="stack" class="pb-16 sm:pb-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="pt-12">
                <div class="rv">
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">02 &mdash; Tools <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Built With What Ships Fast</h2>
                </div>
                <div class="rv rv-d1 flex flex-wrap gap-2 mt-8">
                    @foreach(['PHP' => true, 'Laravel' => true, 'Livewire' => true, 'Vue.js' => false, 'JavaScript' => false, 'Python' => true, 'AI / ML' => true, 'AI Agents' => true, 'LangChain' => true, 'LlamaIndex' => true, 'AWS' => false, 'Data Analytics' => false, 'REST APIs' => false, 'Testing / TDD' => false, 'MySQL / PostgreSQL' => false, 'Docker' => false, 'Filament' => false, 'Git / CI-CD' => false, 'n8n' => true, 'Zapier' => true] as $tech => $hot)
                        <span class="px-4 py-2 border rounded-sm font-mono text-xs font-medium tracking-wide transition-all hover:border-amber-brand/25 hover:text-amber-brand hover:bg-amber-brand/[0.08] {{ $hot ? 'border-amber-brand/25 text-amber-brand bg-amber-brand/[0.04]' : 'border-white/[0.06] text-cream-dim' }}">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Projects ─────────────────────────────────────────── -->
    <section id="projects" class="py-16 sm:py-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="rv flex flex-col md:flex-row md:items-end md:justify-between gap-4 pt-12 mb-12">
                <div>
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">03 &mdash; Selected Work <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Products That Went Live<br>&mdash; and Stayed There</h2>
                    <p class="text-base text-cream-muted max-w-[560px] font-light leading-relaxed">Real software running in production across four continents. From beauty marketplaces to cloud accounting &mdash; every project shipped on time with clean, maintainable code.</p>
                </div>
                <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" class="inline-flex items-center gap-2.5 px-6 py-3 border border-white/10 text-cream-muted font-mono text-xs font-medium tracking-wider uppercase rounded-sm hover:border-amber-brand/25 hover:text-amber-brand transition-all whitespace-nowrap self-start">
                    View GitHub (120+ repos)
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 10 5-5M5 5h5v5"/></svg>
                </a>
            </div>

            <!-- Client Projects -->
            <div class="rv font-mono text-[0.625rem] font-medium tracking-[0.15em] uppercase text-amber-brand mb-5 pb-3 border-b border-amber-brand/25 inline-block">Client & Commercial Projects</div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-white/[0.06] mb-16">
                @php
                    $clients = [
                        ['name' => 'BeautySpace', 'role' => 'Founder', 'roleClass' => 'text-green-500 border-green-500/30', 'desc' => "Nigeria's premier beauty services marketplace. Connects customers with trusted professionals for makeup, spa treatments, and wellness — featuring real-time booking, location-based search, and business management tools.", 'lang' => 'Laravel / Livewire', 'dotColor' => '#F05340', 'where' => 'beautyspaceng.com'],
                        ['name' => 'LearnKast', 'role' => 'Founder', 'roleClass' => 'text-green-500 border-green-500/30', 'desc' => 'An e-learning platform that makes education accessible and available 24/7. Built with video streaming, progress tracking, and interactive assessments for learners everywhere.', 'lang' => 'JavaScript / Laravel', 'dotColor' => '#F7DF1E', 'where' => 'Live Platform'],
                        ['name' => 'Cause Strategy Partners', 'role' => 'Sr. Engineer', 'roleClass' => 'text-amber-brand border-amber-brand/25', 'desc' => "Technology platform for a NYC-based Certified B Corp connecting 3,000+ professionals with nonprofit boards. Built systems serving partners like JPMorgan Chase, Adobe, and BDO.", 'lang' => 'PHP / Laravel', 'dotColor' => '#777BB4', 'where' => 'New York, USA'],
                        ['name' => 'Parking Lot Management', 'role' => 'Contract', 'roleClass' => 'text-indigo-300 border-indigo-300/30', 'desc' => 'Full-stack parking management system with real-time space availability, automated billing, license plate tracking, and analytics dashboard for multi-location operators.', 'lang' => 'Laravel / Vue.js', 'dotColor' => '#777BB4', 'where' => 'Enterprise SaaS'],
                        ['name' => 'Waldo Contacts', 'role' => 'Engineer', 'roleClass' => 'text-amber-brand border-amber-brand/25', 'desc' => "DTC e-commerce platform for the UK's first direct-to-consumer contact lens brand. Shipped 50M+ lenses with subscription management, prescription handling, and payment systems.", 'lang' => 'PHP / Full-Stack', 'dotColor' => '#777BB4', 'where' => 'London, UK'],
                        ['name' => 'Accounteer', 'role' => 'Engineer', 'roleClass' => 'text-amber-brand border-amber-brand/25', 'desc' => 'Cloud accounting platform for Belgian SMEs. Built invoicing, bank reconciliation, reporting, and third-party integrations connecting businesses with their accountants.', 'lang' => 'PHP / Laravel', 'dotColor' => '#777BB4', 'where' => 'Leuven, Belgium'],
                        ['name' => 'Andela', 'role' => 'Engineer', 'roleClass' => 'text-amber-brand border-amber-brand/25', 'desc' => "Contributed to Andela's engineering team building platforms that connect Africa's top developers with global companies. Served as mentor since 2016, guiding 9+ years of engineering talent.", 'lang' => 'PHP / Full-Stack', 'dotColor' => '#777BB4', 'where' => 'Lagos, Nigeria'],
                    ];
                @endphp

                @foreach($clients as $i => $project)
                    <div class="rv rv-d{{ ($i % 3) + 1 }} bg-brand p-6 sm:p-8 hover:bg-brand-elevated transition-colors flex flex-col group">
                        <div class="flex items-start justify-between mb-3">
                            <span></span>
                            <span class="font-mono text-[0.5625rem] font-medium tracking-wider uppercase px-2 py-0.5 border rounded-sm {{ $project['roleClass'] }}">{{ $project['role'] }}</span>
                        </div>
                        <h3 class="font-display text-xl font-semibold text-cream mb-2 group-hover:text-amber-brand transition-colors">{{ $project['name'] }}</h3>
                        <p class="text-sm text-cream-muted font-light leading-relaxed flex-1 mb-5">{{ $project['desc'] }}</p>
                        <div class="flex items-center justify-between pt-3 border-t border-white/[0.06]">
                            <span class="font-mono text-[0.6875rem] text-cream-dim flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full" style="background: {{ $project['dotColor'] }}"></span>
                                {{ $project['lang'] }}
                            </span>
                            <span class="font-mono text-[0.625rem] text-cream-faint tracking-wide">{{ $project['where'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Open Source -->
            <div class="rv font-mono text-[0.625rem] font-medium tracking-[0.15em] uppercase text-amber-brand mb-5 pb-3 border-b border-amber-brand/25 inline-block">Open Source & AI Projects</div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-white/[0.06]">
                @php
                    $oss = [
                        ['name' => 'Locator', 'stars' => 19, 'desc' => 'API for developers to access geographical data — countries, states, and counties worldwide.', 'lang' => 'PHP', 'dot' => '#777BB4', 'url' => 'https://github.com/olotintemitope/locator'],
                        ['name' => 'Invoice-AI', 'stars' => 4, 'desc' => 'Autonomous invoice assistant built with GPT-4o, LlamaIndex, and Python for intelligent document processing.', 'lang' => 'Python / AI', 'dot' => '#DA5B0B', 'url' => 'https://github.com/olotintemitope/Invoice-AI'],
                        ['name' => 'PublicHoliday', 'stars' => 6, 'desc' => 'PHP package integrating Google Calendar API to provide global public holiday information for any country.', 'lang' => 'PHP', 'dot' => '#777BB4', 'url' => 'https://github.com/olotintemitope/publicholiday'],
                    ];
                @endphp

                @foreach($oss as $i => $repo)
                    <a href="{{ $repo['url'] }}" target="_blank" rel="noopener" class="rv rv-d{{ $i + 1 }} bg-brand p-6 sm:p-8 hover:bg-brand-elevated transition-colors flex flex-col group">
                        <div class="flex items-start justify-between mb-3">
                            <span class="font-mono text-[0.6875rem] text-cream-dim flex items-center gap-1.5">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                {{ $repo['stars'] }}
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-semibold text-cream mb-2 group-hover:text-amber-brand transition-colors">{{ $repo['name'] }}</h3>
                        <p class="text-sm text-cream-muted font-light leading-relaxed flex-1 mb-5">{{ $repo['desc'] }}</p>
                        <div class="flex items-center justify-between pt-3 border-t border-white/[0.06]">
                            <span class="font-mono text-[0.6875rem] text-cream-dim flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full" style="background: {{ $repo['dot'] }}"></span>
                                {{ $repo['lang'] }}
                            </span>
                            <span class="font-mono text-[0.6875rem] text-amber-brand font-medium inline-flex items-center gap-1 group-hover:opacity-70 transition-opacity">
                                View on GitHub <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 7 4-4M3 3h4v4"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ─── Credentials ──────────────────────────────────────── -->
    <section id="credentials" class="py-16 sm:py-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="pt-12">
                <div class="rv">
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">04 &mdash; Background <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">The Experience Behind the Code</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 mt-12">
                    <!-- Left: Education & Certs -->
                    <div>
                        <div class="rv border border-white/[0.06] rounded p-8 mb-6 hover:border-amber-brand/25 transition-colors">
                            <h4 class="font-display text-xl font-semibold text-cream mb-1">Ambrose Alli University, Ekpoma</h4>
                            <p class="text-[0.9375rem] text-cream-muted mb-1">Computer Science &mdash; Bachelor's Degree</p>
                            <p class="font-mono text-[0.6875rem] text-cream-dim tracking-wide">2016 &mdash; 2021</p>
                        </div>

                        <div class="rv border border-white/[0.06] rounded p-8 mb-6 hover:border-amber-brand/25 transition-colors">
                            <h4 class="font-display text-xl font-semibold text-cream mb-1">Federal Polytechnic, Ado-Ekiti</h4>
                            <p class="text-[0.9375rem] text-cream-muted mb-1">Computer Science &mdash; Upper Credit</p>
                            <p class="font-mono text-[0.6875rem] text-cream-dim tracking-wide mb-4">2007 &mdash; 2012</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-brand/[0.06] border border-amber-brand/25 rounded-sm font-mono text-[0.625rem] font-medium text-amber-brand">Best Programmer of the Year</span>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-brand/[0.06] border border-amber-brand/25 rounded-sm font-mono text-[0.625rem] font-medium text-amber-brand">Best Graduating Student</span>
                            </div>
                        </div>

                        <h3 class="rv font-display text-lg font-semibold text-cream mt-8 mb-2">Certifications</h3>

                        @php
                            $certs = [
                                ['year' => '2025', 'name' => 'AI Agents Fundamentals', 'org' => 'Hugging Face'],
                                ['year' => '2024', 'name' => 'Introduction to Data Science', 'org' => 'Cisco'],
                                ['year' => '2024', 'name' => 'Data Analytics Essentials', 'org' => 'Cisco'],
                                ['year' => '2024', 'name' => 'Verified International Academic Qualifications', 'org' => 'World Education Services (WES)'],
                                ['year' => '2018', 'name' => 'Mobile Web Specialist', 'org' => 'Udacity'],
                            ];
                        @endphp
                        @foreach($certs as $cert)
                            <div class="rv flex gap-4 py-4 border-b border-white/[0.06] last:border-b-0">
                                <span class="font-mono text-[0.6875rem] font-medium text-amber-brand min-w-12 pt-0.5">{{ $cert['year'] }}</span>
                                <div>
                                    <div class="text-[0.9375rem] font-medium text-cream mb-0.5">{{ $cert['name'] }}</div>
                                    <div class="text-[0.8125rem] text-cream-dim">{{ $cert['org'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Right: Publications, Speaking, Mentoring -->
                    <div>
                        <h3 class="rv font-display text-lg font-semibold text-cream mb-2">
                            Published on
                            <a href="https://olotintemitope.medium.com" target="_blank" rel="noopener" class="text-amber-brand underline underline-offset-4">Medium</a> &amp;
                            <a href="https://www.codementor.io/@@olotintemitope" target="_blank" rel="noopener" class="text-amber-brand underline underline-offset-4">Codementor</a>
                        </h3>

                        @php
                            $pubs = [
                                ['title' => 'How to Generate Your API Documentation with Postman in 20 Minutes', 'url' => 'https://olotintemitope.medium.com/how-to-generate-your-api-documentation-in-20-minutes-4e0072f08b94'],
                                ['title' => 'Automating Invoice Creation with AI — GPT-4o & LlamaIndex', 'url' => 'https://olotintemitope.medium.com/automating-invoice-creation-with-ai-d0b9b29e539c'],
                                ['title' => 'How to Impersonate a User Using Laravel Framework', 'url' => 'https://olotintemitope.medium.com/how-to-impersonate-a-user-using-laravel-framework-d563d049b0de'],
                                ['title' => 'How to Debug Like a Pro Using Xdebug, PHPStorm, and Docker', 'url' => 'https://olotintemitope.medium.com/how-to-debug-like-a-pro-using-xdebug-phpstorm-and-docker-d2d66630a9df'],
                                ['title' => 'Using Snappy (wkhtmltopdf) on Laravel Cloud: A Complete Guide', 'url' => 'https://olotintemitope.medium.com/using-snappy-wkhtmltopdf-on-laravel-cloud-a-complete-guide-1973e280e25d'],
                                ['title' => 'Eating End to End Testing in Laravel Like Noodles', 'url' => 'https://olotintemitope.medium.com/eating-end-to-end-testing-in-laravel-like-noodles-5848a3cf941c'],
                                ['title' => 'Laravel Translations in Baby Steps', 'url' => 'https://olotintemitope.medium.com/laravel-translations-in-baby-steps-b23b7494a61c'],
                                ['title' => 'Dependency Injection Explained in Plain English', 'url' => 'https://www.codementor.io/@olotintemitope/dependency-injection-explained-in-plain-english-b24hippx7'],
                            ];
                        @endphp
                        @foreach($pubs as $pub)
                            <a href="{{ $pub['url'] }}" target="_blank" rel="noopener" class="rv flex items-start gap-3 py-3 border-b border-white/[0.06] last:border-b-0 hover:opacity-70 transition-opacity">
                                <span class="w-1 h-1 rounded-full bg-amber-brand mt-2.5 shrink-0"></span>
                                <p class="text-sm text-cream-muted leading-relaxed font-light">{{ $pub['title'] }}</p>
                            </a>
                        @endforeach

                        <h3 class="rv font-display text-lg font-semibold text-cream mt-10 mb-4">Speaking & Events</h3>

                        <a href="https://blog.beautyspaceng.com/beautyspace-pitch-at-the-african-technology-expo-2024-in-lagos" target="_blank" rel="noopener" class="rv block border border-white/[0.06] rounded p-6 hover:border-amber-brand/25 transition-colors mb-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-9 h-9 rounded bg-amber-brand/10 border border-amber-brand/25 flex items-center justify-center shrink-0">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" class="text-amber-brand"><path d="M2 3h5a3 3 0 0 1 3 3v10a2 2 0 0 0-2-2H2z"/><path d="M16 3h-5a3 3 0 0 0-3 3v10a2 2 0 0 1 2-2h6z"/></svg>
                                </div>
                                <div>
                                    <div class="font-display text-base font-semibold text-cream">Africa Technology Expo 2024</div>
                                    <div class="font-mono text-[0.625rem] text-cream-dim tracking-wide">Lagos, Nigeria &mdash; June 2024</div>
                                </div>
                            </div>
                            <p class="text-sm text-cream-muted leading-relaxed font-light">Pitched BeautySpace's booking and client-management platform at ATE 2024, headline-sponsored by MTN Nigeria and Fidelity Bank.</p>
                        </a>

                        <h3 class="rv font-display text-lg font-semibold text-cream mt-8 mb-4">Mentoring</h3>

                        <div class="rv border border-white/[0.06] rounded p-6 hover:border-amber-brand/25 transition-colors mb-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-9 h-9 rounded bg-green-500/10 border border-green-500/20 flex items-center justify-center shrink-0">
                                    <svg width="16" height="16" fill="none" stroke="#22c55e" stroke-width="1.5"><path d="M13 15v-2a3 3 0 0 0-3-3H5a3 3 0 0 0-3 3v2"/><circle cx="7.5" cy="5.5" r="2.5"/><path d="M15 6v3M16.5 7.5h-3"/></svg>
                                </div>
                                <div>
                                    <div class="font-display text-base font-semibold text-cream">Andela Mentor</div>
                                    <div class="font-mono text-[0.625rem] text-cream-dim tracking-wide">Since November 2016 &mdash; 9+ years</div>
                                </div>
                            </div>
                            <p class="text-sm text-cream-muted leading-relaxed font-light">Nurturing the next generation of African software engineers through mentorship, code reviews, and technical guidance.</p>
                        </div>

                        <div class="rv border border-white/[0.06] rounded p-6 hover:border-amber-brand/25 transition-colors mb-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-9 h-9 rounded bg-indigo-400/10 border border-indigo-400/20 flex items-center justify-center shrink-0">
                                    <svg width="16" height="16" fill="none" stroke="#a5b4fc" stroke-width="1.5"><path d="M8 2L2 5l6 3 6-3-6-3z"/><path d="M2 11l6 3 6-3M2 8l6 3 6-3"/></svg>
                                </div>
                                <div>
                                    <div class="font-display text-base font-semibold text-cream">Codementor Expert</div>
                                    <div class="font-mono text-[0.625rem] text-cream-dim tracking-wide">PHP & Laravel Mentor</div>
                                </div>
                            </div>
                            <p class="text-sm text-cream-muted leading-relaxed font-light">Available for 1-on-1 mentoring sessions on PHP, Laravel, debugging, and web development best practices.</p>
                        </div>

                        <div class="rv flex gap-2 flex-wrap">
                            <span class="px-3 py-1.5 border border-white/[0.06] rounded-sm font-mono text-[0.6875rem] text-cream-dim">English &mdash; Native</span>
                            <span class="px-3 py-1.5 border border-white/[0.06] rounded-sm font-mono text-[0.6875rem] text-cream-dim">French &mdash; Elementary</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Pricing ──────────────────────────────────────────── -->
    <section id="pricing" class="py-16 sm:py-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="pt-12 max-w-[560px]">
                <div class="rv">
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">05 &mdash; Investment <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Simple Pricing.<br>Zero Surprises.</h2>
                    <p class="text-base text-cream-muted max-w-[560px] font-light leading-relaxed">No hourly padding. No scope creep. Pick the model that fits your stage &mdash; every engagement starts with a free 30-minute discovery call.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-white/[0.06] mt-12">
                @php
                    $plans = [
                        ['tier' => 'Consultation', 'name' => 'Strategy Session', 'price' => '$150', 'unit' => 'per hour', 'desc' => 'Unstick a hard problem in 60 minutes. Walk away with a clear architecture plan, AI feasibility verdict, and concrete next steps.', 'features' => ['1-on-1 technical consultation', 'Architecture review & recommendations', 'AI feasibility assessment', 'Written summary & action items'], 'cta' => 'Book a Session', 'featured' => false],
                        ['tier' => 'Project-Based', 'name' => 'Full Build', 'price' => '$5,000+', 'unit' => 'per project', 'desc' => 'You describe the product. I ship it. Complete end-to-end build — architecture, development, testing, deployment, and 30 days of post-launch support.', 'features' => ['Full project scoping & planning', 'Design, development & testing', 'Deployment & CI/CD setup', '30-day post-launch support', 'Source code & documentation'], 'cta' => 'Start a Project', 'featured' => true],
                        ['tier' => 'Retainer', 'name' => 'Ongoing Partnership', 'price' => '$3,000', 'unit' => 'per month · 20 hrs', 'desc' => "Like having a senior engineer on your team — without the overhead. Dedicated hours, priority scheduling, and unused hours roll over.", 'features' => ['20 hours of dedicated dev time', 'Priority response & scheduling', 'Weekly progress updates', 'Rollover unused hours'], 'cta' => 'Get Started', 'featured' => false],
                    ];
                @endphp

                @foreach($plans as $plan)
                    <div class="rv rv-d{{ $loop->iteration }} bg-brand flex flex-col relative hover:bg-brand-elevated transition-colors {{ $plan['featured'] ? 'bg-brand-elevated' : '' }} {{ $plan['featured'] ? 'pt-12' : 'p-8 sm:p-10' }} {{ $plan['featured'] ? 'px-8 sm:px-10 pb-8 sm:pb-10' : '' }}">
                        @if($plan['featured'])
                            <div class="absolute top-0 inset-x-0 py-1.5 bg-amber-brand text-brand font-mono text-[0.5625rem] font-semibold tracking-[0.15em] uppercase text-center">Most Popular</div>
                        @endif
                        <span class="font-mono text-[0.625rem] font-medium tracking-[0.15em] uppercase text-amber-brand mb-2">{{ $plan['tier'] }}</span>
                        <h3 class="font-display text-xl font-semibold text-cream mb-4">{{ $plan['name'] }}</h3>
                        <div class="font-display text-4xl font-semibold text-cream leading-none mb-1">{{ $plan['price'] }}</div>
                        <div class="font-mono text-[0.6875rem] text-cream-dim mb-6">{{ $plan['unit'] }}</div>
                        <p class="text-sm text-cream-muted leading-relaxed font-light mb-6">{{ $plan['desc'] }}</p>
                        <ul class="flex-1 mb-8 space-y-2">
                            @foreach($plan['features'] as $feature)
                                <li class="flex items-start gap-2.5 text-sm text-cream-muted font-light">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 mt-0.5 text-amber-brand"><path d="m3 7 3 3 5-6"/></svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="#contact" class="block w-full text-center py-3.5 font-mono text-[0.6875rem] font-semibold tracking-wider uppercase rounded-sm transition-all {{ $plan['featured'] ? 'bg-amber-brand text-brand border border-amber-brand hover:bg-amber-light hover:shadow-[0_0_24px_rgba(212,160,23,0.15)]' : 'border border-white/10 text-cream-muted hover:border-amber-brand/25 hover:text-amber-brand' }}">{{ $plan['cta'] }}</a>
                    </div>
                @endforeach
            </div>

            <p class="rv text-center mt-8 text-sm text-cream-dim font-light">
                Not sure which is right? <strong class="text-cream-muted font-medium">Book a free 30-minute discovery call</strong> and I'll recommend the best fit for your budget and timeline.
            </p>
        </div>
    </section>

    <!-- ─── Testimonials ─────────────────────────────────────── -->
    <section id="testimonials" class="py-16 sm:py-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="pt-12">
                <div class="rv">
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">06 &mdash; What People Say <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Words From Colleagues<br>&amp; Clients</h2>
                </div>

                <div class="grid grid-cols-1 gap-5 mt-12 max-w-3xl">
                    @php
                        $testimonials = [
                            ['text' => 'Olotin is a very smart Software Engineer with great problem-solving skills. He has great soft skills and has demonstrated this while working together at Andela. He is also a good mentor. I would recommend him to any tech company.', 'initials' => 'RA', 'name' => 'Raimi Ademola', 'role' => 'Software Engineer, Andela', 'src' => 'LinkedIn'],
                            ['text' => 'Olotin is a focused, organized, well-detailed person who would produce an excellent result for any company. His attention to quality and commitment to delivery is consistently outstanding.', 'initials' => 'AD', 'name' => 'Ayo Daramola', 'role' => 'Technology Professional', 'src' => 'LinkedIn'],
                            ['text' => 'Temitope has vast experience developing robust REST APIs and building backend applications using PHP with test-driven development. He also has strong knowledge converting designs to pixel-perfect webpages and building offline-first web applications.', 'initials' => 'CM', 'name' => 'Codementor', 'role' => 'PHP & Laravel Expert Profile', 'src' => 'Verified Profile'],
                        ];
                    @endphp

                    @foreach($testimonials as $t)
                        <div class="rv rv-d{{ $loop->iteration }} border border-white/[0.06] rounded p-8 sm:p-10 relative hover:border-amber-brand/25 transition-colors">
                            <span class="absolute top-4 right-6 font-display text-5xl font-semibold text-amber-brand/10 leading-none">&ldquo;</span>
                            <div class="flex gap-0.5 mb-3 text-amber-brand">
                                @for($s = 0; $s < 5; $s++)
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @endfor
                            </div>
                            <p class="font-display text-base leading-relaxed text-cream-muted italic mb-5">{{ $t['text'] }}</p>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-amber-brand/10 border border-amber-brand/25 flex items-center justify-center font-mono text-[0.6875rem] font-medium text-amber-brand shrink-0">{{ $t['initials'] }}</div>
                                <div>
                                    <div class="font-medium text-sm text-cream">{{ $t['name'] }}</div>
                                    <div class="text-xs text-cream-dim">{{ $t['role'] }}</div>
                                    <div class="font-mono text-[0.5625rem] font-medium text-amber-brand tracking-wide mt-0.5">{{ $t['src'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ─── FAQ ──────────────────────────────────────────────── -->
    <section id="faq" class="py-16 sm:py-28">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="pt-12">
                <div class="rv">
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">07 &mdash; FAQ <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Questions I Get<br>Asked a Lot</h2>
                </div>

                <div class="max-w-[740px] mt-12">
                    @php
                        $faqs = [
                            ['q' => 'How quickly can you start on my project?', 'a' => 'Most projects kick off within 1-2 weeks of our discovery call. For urgent needs, I can start within 48 hours depending on current availability. The "Accepting new clients" badge at the top of this page reflects my real-time capacity.', 'open' => true],
                            ['q' => 'Do you work with startups or just enterprises?', 'a' => "Both. My sweet spot is founders who need their MVP shipped fast and enterprises scaling existing products. I've built for pre-revenue startups and companies serving millions of users. The approach adapts, but the engineering standards don't."],
                            ['q' => 'Do you take equity instead of payment?', 'a' => "No. I charge fair, transparent rates because I deliver production-grade work and I have a family to feed. That said, my pricing is startup-friendly — you get senior-level engineering without the Silicon Valley price tag."],
                            ['q' => 'What does your typical development process look like?', 'a' => "Discovery call, scope & architecture plan, milestone-based development with weekly updates, testing, deployment, and 30 days of post-launch support. You'll never be left guessing where things stand — I over-communicate on purpose."],
                            ['q' => 'Can you integrate AI into my existing application?', 'a' => "Absolutely. I specialize in retrofitting AI into existing systems — whether that's adding intelligent automation with n8n and Zapier, building custom AI agents with LangChain, or integrating LLMs for document processing. We'll start with a feasibility assessment in our strategy session."],
                            ['q' => 'What happens after the project is delivered?', 'a' => 'Every Full Build includes 30 days of post-launch support. After that, many clients move to a monthly retainer for ongoing feature work and maintenance. You own 100% of the source code and documentation either way.'],
                            ['q' => 'What timezone do you work in?', 'a' => "I'm based in Lagos, Nigeria (WAT / GMT+1), but I've worked with teams across Canada, New York, London, and Belgium for over a decade. I'm flexible with scheduling and overlap with North American and European business hours daily."],
                        ];
                    @endphp

                    @foreach($faqs as $faq)
                        <div class="rv border-b border-white/[0.06] {{ isset($faq['open']) && $faq['open'] ? 'faq-item-open' : '' }}" data-faq>
                            <button class="w-full flex items-center justify-between gap-6 py-5 sm:py-6 text-left font-display text-lg font-semibold text-cream hover:text-amber-brand transition-colors cursor-pointer" onclick="this.parentElement.classList.toggle('faq-item-open')">
                                {{ $faq['q'] }}
                                <span class="faq-plus-icon w-6 h-6 border border-amber-brand/25 rounded-full flex items-center justify-center shrink-0 transition-all duration-350 text-amber-brand">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 1v10M1 6h10"/></svg>
                                </span>
                            </button>
                            <div class="faq-answer-wrap">
                                <p class="pb-6 text-[0.9375rem] leading-relaxed text-cream-muted max-w-[640px] font-light">{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Contact ──────────────────────────────────────────── -->
    <section id="contact" class="py-16 sm:py-28 pb-12 sm:pb-20">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <hr class="h-px border-0 bg-gradient-to-r from-amber-brand/25 via-white/[0.06] to-transparent">
            <div class="max-w-[650px] pt-12">
                <div class="rv">
                    <span class="font-mono text-[0.6875rem] font-medium tracking-[0.15em] uppercase text-amber-brand flex items-center gap-4 mb-5">08 &mdash; Next Step <span class="flex-1 max-w-16 h-px bg-amber-brand/25"></span></span>
                    <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight mb-4">Ready to Ship?<br>Let's Talk.</h2>
                    <p class="text-base text-cream-muted max-w-[560px] font-light leading-relaxed">Tell me what you're building. I'll tell you honestly if I'm the right fit &mdash; and if I am, we'll have a plan before the call ends.</p>
                </div>

                <div class="rv rv-d1 mt-10">
                    <a href="mailto:temitope@olotin.dev" class="inline-flex items-center gap-2.5 px-10 py-4 bg-amber-brand text-brand font-mono text-sm font-semibold tracking-wider uppercase rounded-sm hover:bg-amber-light hover:shadow-[0_0_40px_rgba(212,160,23,0.15),0_4px_20px_rgba(0,0,0,0.4)] hover:-translate-y-0.5 transition-all">
                        Book a Free 30-Min Call
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 10 5-5M5 5h5v5"/></svg>
                    </a>
                    <p class="text-[0.8rem] text-cream-faint mt-4 font-light">No commitment. No pitch deck required. Just a conversation.</p>
                </div>

                <div class="rv rv-d2 flex flex-col sm:flex-row flex-wrap gap-3 mt-10">
                    <a href="https://www.linkedin.com/in/olotin-temitope-53b43272/" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-white/[0.06] rounded-sm font-mono text-[0.6875rem] font-medium text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand hover:-translate-y-0.5 transition-all">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        LinkedIn
                    </a>
                    <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-white/[0.06] rounded-sm font-mono text-[0.6875rem] font-medium text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand hover:-translate-y-0.5 transition-all">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                        GitHub
                    </a>
                    <a href="https://x.com/laztopaz_" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-white/[0.06] rounded-sm font-mono text-[0.6875rem] font-medium text-cream-dim hover:border-amber-brand/25 hover:text-amber-brand hover:-translate-y-0.5 transition-all">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        @@laztopaz_
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── Floating CTA ─────────────────────────────────────── -->
    <div id="floatCta" class="fixed bottom-4 right-4 sm:bottom-8 sm:right-8 z-90 opacity-0 translate-y-4 transition-all duration-400 pointer-events-none [&.show]:opacity-100 [&.show]:translate-y-0 [&.show]:pointer-events-auto">
        <a href="#contact" class="flex items-center gap-1.5 sm:gap-2 px-3.5 py-2.5 sm:px-5 sm:py-3 bg-amber-brand text-brand font-mono text-[0.625rem] sm:text-[0.6875rem] font-semibold tracking-wide uppercase rounded-sm shadow-[0_8px_32px_rgba(212,160,23,0.25)] hover:bg-amber-light hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgba(212,160,23,0.35)] transition-all">
            <svg width="12" height="12" class="sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 10 5-5M5 5h5v5"/></svg>
            Book a Call
        </a>
    </div>

    <!-- ─── Footer ───────────────────────────────────────────── -->
    <footer class="border-t border-white/[0.06] py-8 sm:py-10 pb-20 sm:pb-10">
        <div class="max-w-[1240px] mx-auto px-6 md:px-12">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <p class="font-mono text-[0.6875rem] text-cream-faint tracking-wide">
                    &copy; {{ date('Y') }} Temitope Olotin. Built with <a href="https://laravel.com" target="_blank" rel="noopener" class="text-amber-brand hover:opacity-70 transition-opacity">Laravel</a>.
                </p>
                <div class="flex gap-5">
                    <a href="https://www.linkedin.com/in/olotin-temitope-53b43272/" target="_blank" rel="noopener" aria-label="LinkedIn" class="text-cream-faint hover:text-amber-brand transition-colors">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="https://github.com/olotintemitope" target="_blank" rel="noopener" aria-label="GitHub" class="text-cream-faint hover:text-amber-brand transition-colors">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                    </a>
                    <a href="https://x.com/laztopaz_" target="_blank" rel="noopener" aria-label="X / Twitter" class="text-cream-faint hover:text-amber-brand transition-colors">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ─── Scripts ───────────────────────────────────────────── -->
    <script>
        const nav = document.getElementById('mainNav');
        const scrollBar = document.getElementById('scrollBar');
        const floatCta = document.getElementById('floatCta');

        window.addEventListener('scroll', () => {
            const y = window.scrollY;
            nav.classList.toggle('stuck', y > 50);
            if (y > 50) {
                nav.style.background = 'rgba(12,10,9,0.88)';
                nav.style.backdropFilter = 'blur(20px) saturate(1.5)';
                nav.style.webkitBackdropFilter = 'blur(20px) saturate(1.5)';
                nav.style.padding = window.innerWidth < 640 ? '0.35rem 0' : '0.5rem 0';
                nav.style.boxShadow = '0 1px 0 rgba(255,255,255,0.06)';
            } else {
                nav.style.background = '';
                nav.style.backdropFilter = '';
                nav.style.webkitBackdropFilter = '';
                nav.style.padding = '';
                nav.style.boxShadow = '';
            }
            const docH = document.documentElement.scrollHeight - window.innerHeight;
            scrollBar.style.width = Math.min((y / docH) * 100, 100) + '%';
            floatCta.classList.toggle('show', y > window.innerHeight * 0.8);
        });

        function animateCounters() {
            document.querySelectorAll('[data-count]').forEach(el => {
                const target = parseInt(el.dataset.count);
                const start = performance.now();
                function tick(now) {
                    const t = Math.min((now - start) / 1800, 1);
                    el.textContent = Math.round((1 - Math.pow(1 - t, 3)) * target) + '+';
                    if (t < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('vis'); observer.unobserve(e.target); } });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.rv').forEach(el => observer.observe(el));

        const statsEl = document.querySelector('[data-count]')?.closest('div')?.parentElement;
        if (statsEl) {
            new IntersectionObserver((entries) => {
                entries.forEach(e => { if (e.isIntersecting) { animateCounters(); e.target.remove; } });
            }, { threshold: 0.5 }).observe(statsEl);
        }

        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function(e) {
                const t = document.querySelector(this.getAttribute('href'));
                if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
            });
        });
    </script>
</body>
</html>
