<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        if (!auth()->user()->isSuperAdmin() && $user->id !== auth()->id()) {
            abort(403, 'Accès non autorisé.');
        }

        $threeMonthsAgo = Carbon::now()->subMonths(3);

        // --- Activity stats (last 3 months) ---
        $stats = [
            'articles_created' => AuditLog::where('user_id', $user->id)
                ->where('action', 'created')
                ->where('model_type', 'App\\Models\\Article')
                ->where('created_at', '>=', $threeMonthsAgo)
                ->count(),
            'articles_updated' => AuditLog::where('user_id', $user->id)
                ->where('action', 'updated')
                ->where('model_type', 'App\\Models\\Article')
                ->where('created_at', '>=', $threeMonthsAgo)
                ->count(),
            'evenements' => AuditLog::where('user_id', $user->id)
                ->whereIn('action', ['created', 'updated'])
                ->where('model_type', 'App\\Models\\Evenement')
                ->where('created_at', '>=', $threeMonthsAgo)
                ->count(),
            'dossiers' => AuditLog::where('user_id', $user->id)
                ->whereIn('action', ['created', 'updated'])
                ->where('model_type', 'App\\Models\\Dossier')
                ->where('created_at', '>=', $threeMonthsAgo)
                ->count(),
            'albums' => AuditLog::where('user_id', $user->id)
                ->whereIn('action', ['created', 'updated'])
                ->where('model_type', 'App\\Models\\GalerieAlbum')
                ->where('created_at', '>=', $threeMonthsAgo)
                ->count(),
            'total_actions' => AuditLog::where('user_id', $user->id)
                ->where('created_at', '>=', $threeMonthsAgo)
                ->count(),
        ];

        // --- Chart data: weekly activity over 3 months ---
        $chartRaw = AuditLog::where('user_id', $user->id)
            ->where('created_at', '>=', $threeMonthsAgo)
            ->selectRaw("DATE(created_at) as date, action, COUNT(*) as count")
            ->groupBy('date', 'action')
            ->orderBy('date')
            ->get()
            ->groupBy('date')
            ->map(fn($dayGroup) => [
                'created' => $dayGroup->where('action', 'created')->sum('count'),
                'updated' => $dayGroup->where('action', 'updated')->sum('count'),
                'deleted' => $dayGroup->where('action', 'deleted')->sum('count'),
            ]);

        // Aggregate by week for cleaner chart
        $labels = [];
        $created = [];
        $updated = [];
        $deleted = [];
        $current = $threeMonthsAgo->copy()->startOfWeek();
        $now = Carbon::now();

        while ($current->lte($now)) {
            $weekEnd = $current->copy()->endOfWeek();
            $labels[] = $current->format('d M');

            $weekCreated = 0;
            $weekUpdated = 0;
            $weekDeleted = 0;

            $day = $current->copy();
            while ($day->lte($weekEnd) && $day->lte($now)) {
                $dateStr = $day->format('Y-m-d');
                if ($chartRaw->has($dateStr)) {
                    $weekCreated += $chartRaw[$dateStr]['created'];
                    $weekUpdated += $chartRaw[$dateStr]['updated'];
                    $weekDeleted += $chartRaw[$dateStr]['deleted'];
                }
                $day->addDay();
            }

            $created[] = $weekCreated;
            $updated[] = $weekUpdated;
            $deleted[] = $weekDeleted;
            $current->addWeek();
        }

        // --- Activity timeline (paginated) ---
        $timeline = AuditLog::where('user_id', $user->id)
            ->latest()
            ->paginate(20)
            ->through(function ($log) {
                $log->model_label = class_basename($log->model_type);
                return $log;
            });

        // --- Articles authored ---
        $articles = Article::where('author_id', $user->id)
            ->with('category')
            ->latest()
            ->take(10)
            ->get();

        $articleStats = [
            'total' => Article::where('author_id', $user->id)->count(),
            'publie' => Article::where('author_id', $user->id)->where('status', 'publie')->count(),
            'brouillon' => Article::where('author_id', $user->id)->where('status', 'brouillon')->count(),
            'archive' => Article::where('author_id', $user->id)->where('status', 'archive')->count(),
        ];

        $isOwnProfile = $user->id === auth()->id();

        return view('back-end.profil.show', compact(
            'user', 'stats', 'labels', 'created', 'updated', 'deleted',
            'timeline', 'articles', 'articleStats', 'isOwnProfile'
        ));
    }

    public function timelineMore(User $user, Request $request)
    {
        if (!auth()->user()->isSuperAdmin() && $user->id !== auth()->id()) {
            return response()->json(['success' => false], 403);
        }

        $timeline = AuditLog::where('user_id', $user->id)
            ->latest()
            ->paginate(20)
            ->through(function ($log) {
                $log->model_label = class_basename($log->model_type);
                return $log;
            });

        return response()->json([
            'html' => view('back-end.profil._timeline-items', compact('timeline'))->render(),
            'hasMore' => $timeline->hasMorePages(),
            'nextPage' => $timeline->currentPage() + 1,
        ]);
    }
}
