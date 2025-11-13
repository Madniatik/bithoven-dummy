<?php

namespace Bithoven\Dummy\Http\Controllers;

use App\Http\Controllers\Controller;
use Bithoven\Dummy\Models\DummyItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        // Stats
        $stats = [
            'total' => DummyItem::count(),
            'active' => DummyItem::where('status', 'active')->count(),
            'inactive' => DummyItem::where('status', 'inactive')->count(),
        ];

        // Items by category
        $itemsByCategory = DummyItem::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        // Items created last 7 days
        $itemsByDay = DummyItem::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top 10 items by order
        $topItems = DummyItem::orderBy('order', 'desc')
            ->limit(10)
            ->get();

        return view('dummy::reports.index', compact(
            'stats',
            'itemsByCategory',
            'itemsByDay',
            'topItems'
        ));
    }

    public function export()
    {
        $items = DummyItem::all();

        $csv = "ID,Name,Category,Status,Order,Created At\n";
        foreach ($items as $item) {
            $csv .= "{$item->id},{$item->name},{$item->category},{$item->status},{$item->order},{$item->created_at}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="dummy-items-export.csv"');
    }
}
