<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);

        $roles = [
            ['value' => 'super-admin', 'label' => 'Super Administrateur'],
            ['value' => 'editeur', 'label' => 'Éditeur'],
            ['value' => 'redacteur', 'label' => 'Rédacteur'],
        ];

        $roleCounts = [
            'super-admin' => User::where('role', 'super-admin')->count(),
            'editeur' => User::where('role', 'editeur')->count(),
            'redacteur' => User::where('role', 'redacteur')->count(),
        ];

        return view('back-end.utilisateurs.index', compact('users', 'roles', 'roleCounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:super-admin,editeur,redacteur',
        ]);

        $tempPassword = Str::random(12);
        $validated['password'] = Hash::make($tempPassword);
        $validated['must_change_password'] = true;

        User::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur créé. Mot de passe temporaire : ' . $tempPassword,
            ]);
        }

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function update(Request $request, User $utilisateur)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $utilisateur->id,
            'role' => 'required|in:super-admin,editeur,redacteur',
        ]);

        $utilisateur->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur mis à jour avec succès.',
            ]);
        }

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $utilisateur)
    {
        if ($utilisateur->id === auth()->id()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous ne pouvez pas supprimer votre propre compte.',
                ], 403);
            }
            return redirect()->route('admin.utilisateurs.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $utilisateur->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès.',
            ]);
        }

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
