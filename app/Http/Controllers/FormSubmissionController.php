<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\NewsletterRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PollVoteRequest;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use App\Models\Comment;
use App\Models\PollOption;
use Illuminate\Support\Facades\DB;

class FormSubmissionController extends Controller
{
    public function submitContact(ContactFormRequest $request)
    {
        ContactMessage::create($request->validated());

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }

    public function subscribeNewsletter(NewsletterRequest $request)
    {
        NewsletterSubscriber::updateOrCreate(
            ['email' => $request->email],
            ['is_active' => true, 'subscribed_at' => now()]
        );

        return back()->with('newsletter_success', 'Merci pour votre inscription à notre newsletter !');
    }

    public function submitComment(CommentRequest $request)
    {
        Comment::create([
            ...$request->validated(),
            'is_admin'    => false,
            'is_approved' => false,
        ]);

        return back()->with('comment_success', 'Votre commentaire a été soumis et sera publié après modération.');
    }

    public function votePoll(PollVoteRequest $request)
    {
        $option = PollOption::findOrFail($request->poll_option_id);

        DB::transaction(function () use ($option) {
            $option->increment('votes_count');
            $option->question->increment('total_votes');
        });

        session()->put('poll_voted_' . $option->question->id, true);

        return back()->with('poll_success', 'Merci pour votre vote !');
    }
}
