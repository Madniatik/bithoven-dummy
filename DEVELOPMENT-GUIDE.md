# 🎯 Extensión Dummy - Guía de Desarrollo

## ✅ Estado Actual

La extensión **bithoven-dummy** está completamente funcional y lista para desarrollo y testing.

```bash
✅ 8/8 tests pasaron
✅ Instalada y habilitada
✅ Migración ejecutada
✅ Rutas registradas
✅ Vista funcionando
```

## 🚀 Acceso Rápido

**URL:** http://localhost:8000/dummy

**Breadcrumb:** Home > Dashboard > Dummy Extension

## 📋 Casos de Uso

### 1. Testing del Sistema de Backups

```bash
# Ver backups actuales
http://localhost:8000/admin/extensions/dummy/backups

# Simular update (crear backup automático)
# 1. Modifica composer.json: "version": "1.1.0"
# 2. Crea nueva migración
# 3. Ejecuta update desde UI

# Verificar backup creado
ls -lh storage/backups/extensions/dummy/
```

### 2. Testing de Rollback Automático

```bash
# 1. Crear migración con error intencional
cat > database/migrations/2025_11_13_000002_break_dummy.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
return new class extends Migration {
    public function up(): void {
        throw new \Exception('Intentional error for rollback test');
    }
};
EOF

# 2. Intentar update desde UI
# 3. Verificar rollback automático
# 4. Verificar datos restaurados
php tests/quick-test.php
```

### 3. Testing de Uninstall

```bash
# Con eliminación de datos
php artisan bithoven:extension:uninstall dummy --remove-data
# Verificar: tabla dropped, views removidas

# Sin eliminación de datos
php artisan bithoven:extension:uninstall dummy
# Verificar: tabla preservada, solo provider deshabilitado
```

### 4. Desarrollo de Nuevas Features

```bash
# Agregar nueva columna
cat > database/migrations/2025_11_13_000003_add_category_to_dummy.php << 'EOF'
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('dummy_items', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
    }
    
    public function down(): void {
        Schema::table('dummy_items', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
EOF

# Actualizar modelo
# Modificar src/Models/DummyItem.php
# Agregar 'category' a $fillable

# Actualizar vista
# Modificar resources/views/index.blade.php
# Agregar campo en formulario y tabla

# Actualizar controlador
# Modificar validación en src/Http/Controllers/DummyController.php

# Probar
php artisan migrate
php tests/quick-test.php
```

## 🧪 Tests Disponibles

### Test Rápido (8 tests)
```bash
cd /Users/madniatik/CODE/LARAVEL/BITHOVEN/EXTENSIONS/bithoven-dummy
php tests/quick-test.php
```

**Cobertura:**
1. ✅ Tabla existe
2. ✅ Crear item
3. ✅ Leer items
4. ✅ Actualizar item
5. ✅ Soft delete
6. ✅ Restaurar item
7. ✅ Eliminación permanente
8. ✅ Config cargada

## 📦 Estructura de Archivos

```
bithoven-dummy/
├── composer.json              # Metadata y autoload
├── CHANGELOG.md              # Historial de versiones
├── README.md                 # Documentación completa
├── LICENSE                   # MIT License
│
├── config/
│   └── dummy.php             # Configuración
│
├── database/
│   └── migrations/
│       └── *_create_dummy_items_table.php
│
├── resources/
│   └── views/
│       └── index.blade.php   # Vista principal
│
├── routes/
│   └── web.php               # Rutas REST
│
├── src/
│   ├── DummyServiceProvider.php
│   ├── Models/
│   │   └── DummyItem.php
│   └── Http/
│       └── Controllers/
│           └── DummyController.php
│
└── tests/
    └── quick-test.php        # Test suite
```

## 🔄 Workflow de Testing Update/Backup/Rollback

### Escenario 1: Update Exitoso con Backup

```bash
# 1. Crear algunos items de prueba
# http://localhost:8000/dummy

# 2. Modificar version en composer.json
# "version": "1.1.0"

# 3. Crear nueva feature (ej: categorías)
# Ver sección "Desarrollo de Nuevas Features" arriba

# 4. Hacer update desde UI
# http://localhost:8000/admin/extensions

# 5. Verificar backup creado
ls -lh storage/backups/extensions/dummy/

# 6. Verificar datos preservados
php tests/quick-test.php

# 7. Verificar nueva feature funciona
# http://localhost:8000/dummy
```

### Escenario 2: Update Fallido con Rollback

```bash
# 1. Crear backup base
# Update desde UI para crear primer backup

# 2. Crear migración con error
# Ver sección "Testing de Rollback Automático"

# 3. Intentar update
# Debería fallar y hacer rollback automático

# 4. Verificar datos intactos
php tests/quick-test.php

# 5. Ver logs del rollback
tail -f storage/logs/laravel.log
```

## 🎨 Personalización

### Cambiar Tema de Colores

```php
// resources/views/index.blade.php
// Buscar: bg-light-primary, text-primary
// Cambiar a: bg-light-success, text-success
// Opciones: primary, success, warning, danger, info, dark
```

### Agregar Validación Personalizada

```php
// src/Http/Controllers/DummyController.php
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255', 'unique:dummy_items'],
        'description' => ['nullable', 'string', 'max:1000'],
        'status' => ['required', 'in:active,inactive'],
        'order' => ['required', 'integer', 'min:0', 'max:999'],
    ], [
        'name.unique' => 'Ya existe un item con ese nombre',
        'order.max' => 'El orden no puede ser mayor a 999',
    ]);
    
    // ...
}
```

### Agregar Eventos

```php
// src/Models/DummyItem.php
use Illuminate\Database\Eloquent\Model;

class DummyItem extends Model
{
    protected static function booted()
    {
        static::creating(function ($item) {
            \Log::info("Creating dummy item: {$item->name}");
        });
        
        static::updating(function ($item) {
            \Log::info("Updating dummy item: {$item->name}");
        });
        
        static::deleting(function ($item) {
            \Log::info("Deleting dummy item: {$item->name}");
        });
    }
}
```

## 📊 Estadísticas Actuales

```bash
# Ver en UI
http://localhost:8000/dummy

# O via CLI
php -r "
require 'vendor/autoload.php';
\$app = require 'bootstrap/app.php';
\$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
echo 'Total: ' . Bithoven\Dummy\Models\DummyItem::count() . PHP_EOL;
echo 'Active: ' . Bithoven\Dummy\Models\DummyItem::where('status', 'active')->count() . PHP_EOL;
"
```

## 🐛 Debugging

### Ver Logs

```bash
tail -f storage/logs/laravel.log | grep -i dummy
```

### Verificar Rutas

```bash
php artisan route:list | grep dummy
```

### Verificar Config

```bash
php artisan tinker
>>> config('dummy')
```

### Verificar Service Provider

```bash
php artisan package:discover | grep dummy
```

## 🚨 Troubleshooting

### Error: "Table 'dummy_items' doesn't exist"

```bash
php artisan migrate
```

### Error: "View [dummy::index] not found"

```bash
php artisan view:clear
php artisan optimize:clear
```

### Error: "Route [dummy.index] not defined"

```bash
php artisan route:clear
php artisan optimize:clear
```

### Extension no aparece en lista

```bash
php artisan bithoven:extension:list
# Si no aparece:
composer dump-autoload
php artisan optimize:clear
```

## 📚 Recursos Adicionales

- **Documentación completa:** `README.md`
- **Changelog:** `CHANGELOG.md`
- **License:** `LICENSE` (MIT)
- **Tests:** `tests/quick-test.php`

## 🎯 Próximos Pasos Sugeridos

1. ✅ **Testing básico completado**
2. 🔄 Probar update con backup
3. 🔄 Probar rollback automático
4. 🔄 Probar uninstall con/sin datos
5. 🔄 Crear release en GitHub
6. 🔄 Probar update desde GitHub Release

---

**¡La extensión dummy está lista para usarse como sandbox de desarrollo!** 🎉
