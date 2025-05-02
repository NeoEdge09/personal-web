<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $socialMedia = SocialMedia::getActive();
        $siteSettings = SiteSetting::first();

        return view('blog.index', compact('blogs', 'socialMedia', 'siteSettings'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment view count
        $blog->increment('views');

        // Get approved comments
        $comments = $blog->comments()
            ->where('is_approved', true)
            ->whereNull('parent_id') // Only get top-level comments
            ->with(['replies' => function ($query) {
                $query->where('is_approved', true);
            }])
            ->get();

        // Get related blogs
        $relatedBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $socialMedia = SocialMedia::getActive();
        $siteSettings = SiteSetting::first();

        return view('blog.show', compact('blog', 'comments', 'relatedBlogs', 'socialMedia', 'siteSettings'));
    }

    public function storeComment(Request $request, $blogId): RedirectResponse
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $blog = Blog::findOrFail($blogId);

        $comment = new Comment();
        $comment->blog_id = $blog->id;
        $comment->user_name = $validated['user_name'];
        $comment->email = $validated['email'];
        $comment->content = $validated['content'];
        $comment->parent_id = $validated['parent_id'] ?? null;
        $comment->is_approved = false; // Require approval before displaying
        $comment->save();

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }

    public function byCategory(string $category): View
    {
        $blogs = Blog::where('status', 'published')
            ->where('category', $category)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $socialMedia = SocialMedia::getActive();
        $siteSettings = SiteSetting::first();
        $categoryName = ucfirst(str_replace('-', ' ', $category));

        return view('blog.category', compact('blogs', 'socialMedia', 'siteSettings', 'categoryName', 'category'));
    }

    public function byTag(string $tag): View
    {
        $blogs = Blog::where('status', 'published')
            ->where('tags', 'like', "%$tag%")
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $socialMedia = SocialMedia::getActive();
        $siteSettings = SiteSetting::first();

        return view('blog.tag', compact('blogs', 'socialMedia', 'siteSettings', 'tag'));
    }
}
