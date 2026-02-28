<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\Department;
use App\Models\Document;
use App\Models\FaqItem;
use App\Models\Staff;
use App\Models\Testimonial;

class InstitutionController extends Controller
{
    public function laDgie()
    {
        $dg = Staff::active()->where('type', 'dg')->first();
        $departments = Department::active()->get();
        $documents = Document::active()->get();
        $contactInfo = ContactInfo::first();

        return view('front-end.pages.la-dgie', compact('dg', 'departments', 'documents', 'contactInfo'));
    }

    public function nosServices()
    {
        $faqs = FaqItem::whereNull('faqable_type')->orderBy('order')->get();
        $testimonials = Testimonial::active()->byPage('nos-services')->get();

        return view('front-end.pages.nos-services', compact('faqs', 'testimonials'));
    }

    public function retourReintegration()
    {
        $faqs = FaqItem::whereNull('faqable_type')->orderBy('order')->get();
        $testimonials = Testimonial::active()->byPage('retour-reintegration')->get();

        return view('front-end.pages.retour-reintegration', compact('faqs', 'testimonials'));
    }

    public function investirContribuer()
    {
        $faqs = FaqItem::whereNull('faqable_type')->orderBy('order')->get();
        $testimonials = Testimonial::active()->byPage('investir-contribuer')->get();

        return view('front-end.pages.investir-contribuer', compact('faqs', 'testimonials'));
    }

    public function mentionsLegales()
    {
        $contactInfo = ContactInfo::first();
        $dg = Staff::active()->where('type', 'dg')->first();

        return view('front-end.pages.mentions-legales', compact('contactInfo', 'dg'));
    }

    public function politiqueConfidentialite()
    {
        $contactInfo = ContactInfo::first();

        return view('front-end.pages.politique-confidentialite', compact('contactInfo'));
    }
}
