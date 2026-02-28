<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\FaqItem;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::first();
        $faqs = FaqItem::whereNull('faqable_type')->orderBy('order')->get();

        return view('front-end.pages.contact', compact('contactInfo', 'faqs'));
    }
}
