<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogNewsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display the blog index page
     */
    public function index()
    {
        $posts = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $featuredPost = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->first();

        $categories = BlogCategory::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        $popularPosts = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        return view('pages.blog', compact('posts', 'featuredPost', 'categories', 'popularPosts', 'tags'));
    }

    /**
     * Display a single blog post
     */
    public function show($slug)
    {
        $post = BlogPost::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views
        $post->increment('views');

        // Get related posts
        $relatedPosts = BlogPost::with(['author', 'category'])
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->limit(3)
            ->get();

        return view('pages.blog-single', compact('post', 'relatedPosts'));
    }

    /**
     * Search blog posts
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $posts = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%")
                  ->orWhere('excerpt', 'LIKE', "%{$query}%");
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        $categories = BlogCategory::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        $popularPosts = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        return view('pages.blog-search', compact('posts', 'query', 'categories', 'popularPosts', 'tags'));
    }

    /**
     * Display posts by category
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $posts = BlogPost::with(['author', 'category'])
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        $popularPosts = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        return view('pages.blog-category', compact('posts', 'category', 'categories', 'popularPosts', 'tags'));
    }

    /**
     * Display posts by tag
     */
    public function tag($slug)
    {
        $tag = BlogTag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogCategory::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        $popularPosts = BlogPost::with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        $tags = BlogTag::withCount('posts')
            ->whereHas('posts', function($query) {
                $query->where('is_published', true);
            })
            ->get();

        return view('pages.blog-tag', compact('posts', 'tag', 'categories', 'popularPosts', 'tags'));
    }

    /**
     * Handle newsletter subscription
     */
    public function newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:blog_newsletters,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        BlogNewsletter::create([
            'email' => $request->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}