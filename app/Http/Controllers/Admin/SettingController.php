<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $footerSettings = Setting::getGroup('footer');
        $socialSettings = Setting::getGroup('social');
        $generalSettings = Setting::getGroup('general');

        return view('back-end.settings.index', compact('footerSettings', 'socialSettings', 'generalSettings'));
    }

    public function update(Request $request)
    {
        $fields = $request->except(['_token']);

        foreach ($fields as $key => $value) {
            $group = $this->resolveGroup($key);
            Setting::set($key, $value, $group);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Paramètres enregistrés avec succès.',
            ]);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }

    private function resolveGroup(string $key): string
    {
        if (str_starts_with($key, 'footer_')) return 'footer';
        if (str_starts_with($key, 'social_')) return 'social';
        if (str_starts_with($key, 'seo_')) return 'seo';
        if (str_starts_with($key, 'contact_')) return 'contact';
        if (str_starts_with($key, 'stat_')) return 'stats';
        return 'general';
    }
}
