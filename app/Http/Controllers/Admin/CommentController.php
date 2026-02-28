<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with('article');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'approuve') $query->where('is_approved', true);
            if ($request->status === 'en_attente') $query->where('is_approved', false);
        }

        $comments = $query->latest()->paginate(20)->withQueryString();
        $pendingCount = Comment::where('is_approved', false)->count();

        return view('back-end.comments.index', compact('comments', 'pendingCount'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Commentaire approuvé.');
    }

    public function reject(Comment $comment)
    {
        $comment->update(['is_approved' => false]);
        return redirect()->back()->with('success', 'Commentaire rejeté.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Commentaire supprimé.');
    }
}
