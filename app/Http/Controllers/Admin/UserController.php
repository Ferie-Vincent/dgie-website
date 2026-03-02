<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Mail\UserInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        $user = User::create($validated);

        // Envoyer l'invitation par email
        try {
            Mail::to($user->email)->send(new UserInvitation($user, $tempPassword));
            $mailSent = true;
        } catch (\Exception $e) {
            $mailSent = false;
        }

        $message = $mailSent
            ? 'Invitation envoyée par email à ' . $user->email . '.'
            : 'Utilisateur créé mais l\'email n\'a pas pu être envoyé.';

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'password' => $tempPassword,
                'mail_sent' => $mailSent,
            ]);
        }

        return redirect()->route('admin.utilisateurs.index')
            ->with('success', $message);
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

    public function resetPassword(User $utilisateur)
    {
        $tempPassword = Str::random(12);
        $utilisateur->update([
            'password' => Hash::make($tempPassword),
            'must_change_password' => true,
        ]);

        try {
            Mail::to($utilisateur->email)->send(new PasswordReset($utilisateur, $tempPassword));
            $mailSent = true;
        } catch (\Exception $e) {
            $mailSent = false;
        }

        $message = $mailSent
            ? 'Nouveau mot de passe envoyé par email à ' . $utilisateur->email . '.'
            : 'Mot de passe réinitialisé mais l\'email n\'a pas pu être envoyé.';

        return response()->json([
            'success' => true,
            'message' => $message,
            'password' => $tempPassword,
            'mail_sent' => $mailSent,
        ]);
    }
}
