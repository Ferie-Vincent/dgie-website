<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\FlashInfo;
use App\Models\Banner;
use App\Models\ContactInfo;
use App\Models\Partner;

class FrontendComposer
{
    public function compose(View $view): void
    {
        $view->with([
            'flashInfos'      => FlashInfo::active()->get(),
            'bannerTop'       => Banner::active()->position('top')->first(),
            'contactInfo'     => ContactInfo::first(),
            'footerPartners'  => Partner::active()->take(10)->get(),
        ]);
    }
}
