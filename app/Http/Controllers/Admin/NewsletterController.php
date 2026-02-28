<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest()->paginate(20)->withQueryString();
        $activeCount = NewsletterSubscriber::where('is_active', true)->count();
        $totalCount = NewsletterSubscriber::count();

        return view('back-end.newsletter.index', compact('subscribers', 'activeCount', 'totalCount'));
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Abonné supprimé.');
    }
}
