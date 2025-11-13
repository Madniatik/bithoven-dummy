<?php

namespace Bithoven\Dummy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = $this->getSettings();
        
        return view('dummy::settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'items_per_page' => 'required|integer|in:10,15,25,50',
            'default_status' => 'required|in:active,inactive',
            'enable_notifications' => 'boolean',
            'show_timestamps' => 'boolean',
            'show_descriptions' => 'boolean',
        ]);

        // Save to cache
        Cache::put('dummy_settings', $validated, now()->addYear());

        return response()->json([
            'success' => true,
            'message' => 'Settings saved successfully',
        ]);
    }

    private function getSettings()
    {
        return Cache::get('dummy_settings', [
            'items_per_page' => 15,
            'default_status' => 'active',
            'enable_notifications' => true,
            'show_timestamps' => true,
            'show_descriptions' => true,
        ]);
    }
}
