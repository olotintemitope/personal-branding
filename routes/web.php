<?php

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
