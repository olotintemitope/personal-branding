<?php

use App\Enums\Currency;
use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        $services = Service::active()->ordered()->get();
    } catch (\Exception $e) {
        $services = collect();
    }

    $currency = Currency::USD;
    $timezone = request()->header('X-Timezone');
    $locale = request()->getPreferredLanguage();
    $country = request()->header('CF-IPCountry')
        ?? request()->header('X-Country-Code')
        ?? null;

    if ($country) {
        $currency = match (strtoupper($country)) {
            'NG' => Currency::NGN,
            'GB' => Currency::GBP,
            'DE', 'FR', 'NL', 'BE', 'IT', 'ES', 'AT', 'IE', 'PT', 'FI' => Currency::EUR,
            'CA' => Currency::CAD,
            'AU' => Currency::AUD,
            'ZA' => Currency::ZAR,
            'GH' => Currency::GHS,
            'KE' => Currency::KES,
            default => Currency::USD,
        };
    } elseif ($locale) {
        $currency = match (true) {
            str_contains($locale, 'en-GB') || str_contains($locale, 'en_GB') => Currency::GBP,
            str_contains($locale, 'en-CA') || str_contains($locale, 'en_CA') => Currency::CAD,
            str_contains($locale, 'en-AU') || str_contains($locale, 'en_AU') => Currency::AUD,
            str_contains($locale, 'de') || str_contains($locale, 'fr') || str_contains($locale, 'nl') => Currency::EUR,
            default => Currency::USD,
        };
    }

    return view('welcome', compact('services', 'currency'));
})->name('home');

Route::get('/blog', function () {
    $query = Post::where('status', PostStatus::Published)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->with(['category', 'user']);

    if ($categorySlug = request('category')) {
        $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
    }

    $posts = $query->latest('published_at')->paginate(12)->withQueryString();

    $categories = Category::whereHas('posts', function ($q) {
        $q->where('status', PostStatus::Published)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    })->orderBy('name')->get();

    return view('blog.index', compact('posts', 'categories'));
})->name('blog.index');

Route::get('/blog/{post:slug}', function (Post $post) {
    abort_unless($post->status === PostStatus::Published, 404);
    $post->load(['category', 'tags', 'user']);

    $relatedPosts = Post::where('status', PostStatus::Published)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->where('id', '!=', $post->id)
        ->when($post->category_id, fn ($q) => $q->where('category_id', $post->category_id))
        ->with(['category'])
        ->latest('published_at')
        ->limit(3)
        ->get();

    return view('blog.show', compact('post', 'relatedPosts'));
})->name('blog.show');

Route::get('/sitemap.xml', function () {
    $posts = Post::where('status', PostStatus::Published)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->get();

    return response()->view('sitemap', compact('posts'))
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
