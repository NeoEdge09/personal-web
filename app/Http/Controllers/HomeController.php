<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\MyResume;
use App\Models\MySkill;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('index', [
            'about' => About::first(),
            'services' => Service::all(),
            'mySkills' => MySkill::all(),
            'myResume' => MyResume::first(),
            'portfolios' => Portfolio::where('status', 'published')->latest()->get(),
            'blogs' => Blog::where('status', 'published')->latest()->get(),
            'socialMedia' => SocialMedia::all(),
        ]);
    }

    public function loadMorePortfolios($offset): JsonResponse
    {
        $portfolios = Portfolio::where('status', 'published')
            ->skip($offset)
            ->take(3)
            ->get();

        $view = view('sections.portfolio.items', compact('portfolios'))->render();

        return response()->json([
            'html' => $view,
            'hasMore' => Portfolio::where('status', 'published')->count() > ($offset + 3)
        ]);
    }
    public function loadMoreBlogs($offset): JsonResponse
    {
        $blogs = Blog::where('status', 'published')
            ->latest()
            ->skip($offset)
            ->take(3)
            ->get();

        $view = view('sections.blog.items', compact('blogs'))->render();

        return response()->json([
            'html' => $view,
            'hasMore' => Blog::where('status', 'published')->count() > ($offset + 3)
        ]);
    }
}
