<?php

namespace Bithoven\Dummy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $info = [
            'name' => 'Dummy Extension',
            'version' => '1.1.0',
            'author' => 'Bithoven Team',
            'license' => 'MIT',
            'repository' => 'https://github.com/Madniatik/bithoven-dummy',
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
        ];

        $features = [
            'CRUD Operations',
            'Dashboard & Statistics',
            'Reports with Charts',
            'Settings Management',
            'Category System',
            'Bulk Operations',
            'CSV Export',
            'Soft Deletes',
        ];

        return view('dummy::about.index', compact('info', 'features'));
    }
}
