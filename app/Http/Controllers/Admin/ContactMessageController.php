<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total_month' => ContactMessage::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)->count(),
            'unread' => ContactMessage::where('status', 'unread')->count(),
            'avg_response_time' => $this->getAverageResponseTime(),
        ];

        $contactInfo = ContactInfo::first();

        return view('back-end.contact-messages.index', compact('messages', 'stats', 'contactInfo'));
    }

    public function markAsRead(ContactMessage $contact_message)
    {
        $contact_message->update(['status' => 'read']);

        return response()->json(['success' => true, 'status' => 'read']);
    }

    public function reply(Request $request, ContactMessage $contact_message)
    {
        $request->validate(['reply_message' => 'required|string']);

        $contact_message->update([
            'reply_message' => $request->reply_message,
            'status' => 'replied',
            'replied_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Réponse enregistrée avec succès.',
        ]);
    }

    public function updateContactInfo(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone_1' => 'required|string',
            'phone_2' => 'nullable|string',
            'email' => 'required|email',
        ]);

        ContactInfo::updateOrCreate(
            ['id' => 1],
            $request->only('address', 'phone_1', 'phone_2', 'email')
        );

        return response()->json([
            'success' => true,
            'message' => 'Coordonnées mises à jour avec succès.',
        ]);
    }

    public function destroy(ContactMessage $contact_message)
    {
        $contact_message->delete();
        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message supprimé.');
    }

    private function getAverageResponseTime(): string
    {
        $replied = ContactMessage::whereNotNull('replied_at')
            ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, replied_at)) as avg_minutes')
            ->first();

        if (!$replied || !$replied->avg_minutes) {
            return '--';
        }

        $minutes = (int) $replied->avg_minutes;
        $hours = intdiv($minutes, 60);
        $mins = $minutes % 60;

        return $hours > 0 ? "{$hours}h {$mins}m" : "{$mins}m";
    }
}
