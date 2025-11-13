<?php

namespace Bithoven\Dummy\Http\Controllers;

use App\Http\Controllers\Controller;
use Bithoven\Dummy\Models\DummyItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => DummyItem::count(),
            'active' => DummyItem::where('status', 'active')->count(),
            'inactive' => DummyItem::where('status', 'inactive')->count(),
            'today' => DummyItem::whereDate('created_at', today())->count(),
        ];

        $recentItems = DummyItem::latest()
            ->limit(5)
            ->get();

        return view('dummy::dashboard.index', compact('stats', 'recentItems'));
    }
}
