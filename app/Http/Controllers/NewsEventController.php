<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;

class NewsEventController extends Controller
{
    public function index(Request $request)
    {
        $newsQuery = News::where('is_published', true);
        $eventsQuery = Event::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $newsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
            $eventsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $news = $newsQuery->orderBy('published_at', 'desc')->paginate(6, ['*'], 'news_page');
        $upcomingEvents = (clone $eventsQuery)->where('status', 'open')
            ->orderBy('event_date', 'asc')
            ->get();
        $pastEvents = (clone $eventsQuery)->where('status', '!=', 'open')
            ->orderBy('event_date', 'desc')
            ->get();

        return view('news.index', compact('news', 'upcomingEvents', 'pastEvents'));
    }

    public function showNews($slug)
    {
        $article = News::where('slug', $slug)->firstOrFail();
        $recentNews = News::where('id', '!=', $article->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('news.show', compact('article', 'recentNews'));
    }

    public function showEvent($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $upcomingEvents = Event::where('id', '!=', $event->id)
            ->where('status', 'open')
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        return view('news.event-show', compact('event', 'upcomingEvents'));
    }
}
