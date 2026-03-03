<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmailChange;
use App\Models\AuditLog;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        // --- Super-admin global overview (own profile only) ---
        $isSuperAdminOwnProfile = $isOwnProfile && $user->isSuperAdmin();
        $globalStats = null;
        $leaderboard = null;
        $globalTimeline = null;

        if ($isSuperAdminOwnProfile) {
            $thisMonth = Carbon::now()->startOfMonth();

            $globalStats = [
                'total_actions_month' => AuditLog::where('created_at', '>=', $thisMonth)->count(),
                'total_created_month' => AuditLog::where('action', 'created')
                    ->where('created_at', '>=', $thisMonth)->count(),
                'total_updated_month' => AuditLog::where('action', 'updated')
                    ->where('created_at', '>=', $thisMonth)->count(),
                'total_deleted_month' => AuditLog::where('action', 'deleted')
                    ->where('created_at', '>=', $thisMonth)->count(),
                'active_users_month' => AuditLog::where('created_at', '>=', $thisMonth)
                    ->distinct('user_id')->count('user_id'),
                'most_active_model' => AuditLog::where('created_at', '>=', $thisMonth)
                    ->selectRaw('model_type, COUNT(*) as cnt')
                    ->groupBy('model_type')
                    ->orderByDesc('cnt')
                    ->first(),
            ];

            $leaderboard = User::select('users.*')
                ->selectRaw('(SELECT COUNT(*) FROM audit_logs WHERE audit_logs.user_id = users.id AND audit_logs.created_at >= ?) as total_actions', [$thisMonth])
                ->selectRaw('(SELECT COUNT(*) FROM audit_logs WHERE audit_logs.user_id = users.id AND audit_logs.action = "created" AND audit_logs.model_type = "App\\\\Models\\\\Article" AND audit_logs.created_at >= ?) as articles_created', [$thisMonth])
                ->selectRaw('(SELECT MAX(audit_logs.created_at) FROM audit_logs WHERE audit_logs.user_id = users.id) as last_action_at')
                ->orderByDesc('total_actions')
                ->get();

            $globalTimeline = AuditLog::with('user')
                ->latest()
                ->paginate(20, ['*'], 'global_page')
                ->through(function ($log) {
                    $log->model_label = class_basename($log->model_type);
                    return $log;
                });
        }

        return view('back-end.profil.show', compact(
            'user', 'stats', 'labels', 'created', 'updated', 'deleted',
            'timeline', 'articles', 'articleStats', 'isOwnProfile',
            'isSuperAdminOwnProfile', 'globalStats', 'leaderboard', 'globalTimeline'
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

    public function globalTimelineMore(User $user, Request $request)
    {
        if (!auth()->user()->isSuperAdmin() || $user->id !== auth()->id()) {
            return response()->json(['success' => false], 403);
        }

        $globalTimeline = AuditLog::with('user')
            ->latest()
            ->paginate(20)
            ->through(function ($log) {
                $log->model_label = class_basename($log->model_type);
                return $log;
            });

        return response()->json([
            'html' => view('back-end.profil._global-timeline-items', compact('globalTimeline'))->render(),
            'hasMore' => $globalTimeline->hasMorePages(),
            'nextPage' => $globalTimeline->currentPage() + 1,
        ]);
    }

    public function updateProfile(User $user, Request $request)
    {
        if (!auth()->user()->isSuperAdmin() && $user->id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Accès non autorisé.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $messages = [];
        $nameChanged = false;
        $emailChangeRequested = false;

        // Name change (immediate)
        if ($validated['name'] !== $user->name) {
            $user->update(['name' => $validated['name']]);
            $nameChanged = true;
            $messages[] = 'Nom mis à jour avec succès.';
        }

        // Email change (requires verification)
        if ($validated['email'] !== $user->email) {
            // Check uniqueness
            $exists = User::where('email', $validated['email'])
                ->where('id', '!=', $user->id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette adresse email est déjà utilisée par un autre compte.',
                ], 422);
            }

            $token = Str::random(64);
            $user->update([
                'pending_email' => $validated['email'],
                'email_verification_token' => $token,
            ]);

            $verificationUrl = url('/verify-email/' . $token);
            Mail::to($validated['email'])->send(new VerifyEmailChange($user, $verificationUrl));

            $emailChangeRequested = true;
            $messages[] = 'Un email de vérification a été envoyé à ' . $validated['email'] . '.';
        }

        if (!$nameChanged && !$emailChangeRequested) {
            return response()->json(['success' => true, 'message' => 'Aucune modification détectée.']);
        }

        return response()->json([
            'success' => true,
            'message' => implode(' ', $messages),
            'nameChanged' => $nameChanged,
            'emailChangeRequested' => $emailChangeRequested,
            'newName' => $nameChanged ? $validated['name'] : null,
        ]);
    }

    public function verifyEmail(string $token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect('/admin/login')->with('error', 'Lien de vérification invalide ou expiré.');
        }

        // Check token expiry (24 hours)
        if ($user->updated_at->diffInHours(now()) > 24) {
            $user->update([
                'pending_email' => null,
                'email_verification_token' => null,
            ]);
            return redirect('/admin/login')->with('error', 'Ce lien de vérification a expiré. Veuillez refaire la demande.');
        }

        $user->update([
            'email' => $user->pending_email,
            'pending_email' => null,
            'email_verification_token' => null,
            'email_verified_at' => now(),
        ]);

        return redirect('/admin/login')->with('success', 'Votre adresse email a été mise à jour avec succès. Connectez-vous avec votre nouvelle adresse.');
    }
}
