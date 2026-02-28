<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PollQuestion;
use App\Models\PollOption;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = PollQuestion::withCount('options')->with('options')->latest()->paginate(15);
        return view('back-end.polls.index', compact('polls'));
    }

    public function create()
    {
        return view('back-end.polls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'is_active' => 'boolean',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = PollQuestion::create([
            'question' => $validated['question'],
            'is_active' => $request->has('is_active'),
        ]);

        foreach ($validated['options'] as $i => $label) {
            if (trim($label)) {
                PollOption::create([
                    'poll_question_id' => $poll->id,
                    'label' => $label,
                    'order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.polls.index')->with('success', 'Sondage créé avec succès.');
    }

    public function edit(PollQuestion $poll)
    {
        $poll->load('options');
        return view('back-end.polls.edit', compact('poll'));
    }

    public function update(Request $request, PollQuestion $poll)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'is_active' => 'boolean',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll->update([
            'question' => $validated['question'],
            'is_active' => $request->has('is_active'),
        ]);

        // Remove old options and recreate
        $poll->options()->delete();
        foreach ($validated['options'] as $i => $label) {
            if (trim($label)) {
                PollOption::create([
                    'poll_question_id' => $poll->id,
                    'label' => $label,
                    'order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.polls.index')->with('success', 'Sondage mis à jour.');
    }

    public function destroy(PollQuestion $poll)
    {
        $poll->delete();
        return redirect()->route('admin.polls.index')->with('success', 'Sondage supprimé.');
    }
}
