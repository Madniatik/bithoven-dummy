#!/usr/bin/env php
<?php

/**
 * Quick Test Script for Bithoven Dummy Extension
 * 
 * Tests all basic functionality of the dummy extension
 */

require __DIR__ . '/../../../CPANEL/vendor/autoload.php';

$app = require_once __DIR__ . '/../../../CPANEL/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Bithoven\Dummy\Models\DummyItem;
use Illuminate\Support\Facades\DB;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║     BITHOVEN DUMMY EXTENSION - QUICK TEST SUITE           ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

$tests = [];

// Test 1: Check table exists
echo "🔍 Test 1: Verificando tabla dummy_items...\n";
try {
    $exists = DB::getSchemaBuilder()->hasTable('dummy_items');
    if ($exists) {
        echo "   ✅ Tabla 'dummy_items' existe\n";
        $tests['table_exists'] = true;
    } else {
        echo "   ❌ Tabla 'dummy_items' NO existe\n";
        echo "   💡 Ejecuta: php artisan migrate\n";
        $tests['table_exists'] = false;
    }
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
    $tests['table_exists'] = false;
}
echo "\n";

// Test 2: Create dummy item
echo "🔍 Test 2: Creando dummy item...\n";
try {
    $item = DummyItem::create([
        'name' => 'Test Item ' . time(),
        'description' => 'This is a test item created by the test script',
        'status' => 'active',
        'order' => 1,
    ]);
    
    echo "   ✅ Item creado: ID {$item->id}\n";
    echo "   📝 Nombre: {$item->name}\n";
    echo "   📊 Status: {$item->status}\n";
    $tests['create_item'] = true;
    $testItemId = $item->id;
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
    $tests['create_item'] = false;
    $testItemId = null;
}
echo "\n";

// Test 3: Read items
echo "🔍 Test 3: Leyendo items...\n";
try {
    $count = DummyItem::count();
    $activeCount = DummyItem::where('status', 'active')->count();
    
    echo "   ✅ Total items: {$count}\n";
    echo "   ✅ Items activos: {$activeCount}\n";
    $tests['read_items'] = true;
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
    $tests['read_items'] = false;
}
echo "\n";

// Test 4: Update item
if ($testItemId) {
    echo "🔍 Test 4: Actualizando item...\n";
    try {
        $item = DummyItem::find($testItemId);
        $item->update([
            'description' => 'Updated description',
            'status' => 'inactive',
        ]);
        
        echo "   ✅ Item actualizado: ID {$item->id}\n";
        echo "   📝 Nueva descripción: {$item->description}\n";
        echo "   📊 Nuevo status: {$item->status}\n";
        $tests['update_item'] = true;
    } catch (Exception $e) {
        echo "   ❌ Error: " . $e->getMessage() . "\n";
        $tests['update_item'] = false;
    }
    echo "\n";
}

// Test 5: Soft delete
if ($testItemId) {
    echo "🔍 Test 5: Soft delete...\n";
    try {
        $item = DummyItem::find($testItemId);
        $item->delete();
        
        $deletedItem = DummyItem::withTrashed()->find($testItemId);
        
        echo "   ✅ Item soft deleted: ID {$testItemId}\n";
        echo "   🗑️  Deleted at: {$deletedItem->deleted_at}\n";
        $tests['soft_delete'] = true;
    } catch (Exception $e) {
        echo "   ❌ Error: " . $e->getMessage() . "\n";
        $tests['soft_delete'] = false;
    }
    echo "\n";
}

// Test 6: Restore
if ($testItemId) {
    echo "🔍 Test 6: Restaurando item...\n";
    try {
        $item = DummyItem::withTrashed()->find($testItemId);
        $item->restore();
        
        echo "   ✅ Item restaurado: ID {$testItemId}\n";
        $tests['restore_item'] = true;
    } catch (Exception $e) {
        echo "   ❌ Error: " . $e->getMessage() . "\n";
        $tests['restore_item'] = false;
    }
    echo "\n";
}

// Test 7: Permanent delete
if ($testItemId) {
    echo "🔍 Test 7: Eliminación permanente...\n";
    try {
        $item = DummyItem::find($testItemId);
        $item->forceDelete();
        
        $exists = DummyItem::withTrashed()->find($testItemId);
        
        if (!$exists) {
            echo "   ✅ Item eliminado permanentemente: ID {$testItemId}\n";
            $tests['force_delete'] = true;
        } else {
            echo "   ❌ Item aún existe después de forceDelete\n";
            $tests['force_delete'] = false;
        }
    } catch (Exception $e) {
        echo "   ❌ Error: " . $e->getMessage() . "\n";
        $tests['force_delete'] = false;
    }
    echo "\n";
}

// Test 8: Config check
echo "🔍 Test 8: Verificando configuración...\n";
try {
    $enabled = config('dummy.enabled');
    $testSetting = config('dummy.test_setting');
    $features = config('dummy.features');
    
    echo "   ✅ Configuración cargada\n";
    echo "   📋 Enabled: " . ($enabled ? 'true' : 'false') . "\n";
    echo "   📋 Test setting: {$testSetting}\n";
    echo "   📋 Features: " . count($features) . " configuradas\n";
    $tests['config_loaded'] = true;
} catch (Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
    $tests['config_loaded'] = false;
}
echo "\n";

// Summary
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║                     RESUMEN DE TESTS                       ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

$totalTests = count($tests);
$passedTests = count(array_filter($tests));
$failedTests = $totalTests - $passedTests;

foreach ($tests as $testName => $passed) {
    $icon = $passed ? '✅' : '❌';
    $status = $passed ? 'PASSED' : 'FAILED';
    echo "   {$icon} {$testName}: {$status}\n";
}

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
printf("║  Total: %d tests | ✅ Passed: %d | ❌ Failed: %d          ║\n", 
    $totalTests, $passedTests, $failedTests);
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

if ($failedTests === 0) {
    echo "🎉 ¡Todos los tests pasaron! La extensión dummy está funcionando correctamente.\n";
    exit(0);
} else {
    echo "⚠️  Algunos tests fallaron. Revisa los errores arriba.\n";
    exit(1);
}
