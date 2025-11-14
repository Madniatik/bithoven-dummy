# Dummy Extension - Best Practices

**Última Actualización:** 14 de noviembre de 2025  
**Versión:** 1.4.8

---

## 📋 Índice

1. [Single Source of Truth](#single-source-of-truth)
2. [Validación de Datos](#validación-de-datos)
3. [Evitar Hardcoding](#evitar-hardcoding)
4. [Consistencia Base de Datos](#consistencia-base-de-datos)

---

## 🎯 Single Source of Truth

### Problema Resuelto

**Antes:** Valores hardcoded duplicados en múltiples lugares causaban inconsistencias.

```php
// ❌ MAL - Hardcoded en controller
'status' => 'required|in:active,inactive'

// ❌ MAL - Diferentes valores en DB
ENUM('pending', 'in_progress', 'completed', 'cancelled')

// Resultado: ERROR al insertar
```

### Solución Implementada

**Ahora:** El modelo `DummyItem` es la única fuente de verdad.

```php
// ✅ BIEN - Constantes en el modelo
class DummyItem extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELLED,
        ];
    }
}
```

---

## ✅ Validación de Datos

### Controller

Usar métodos del modelo en lugar de hardcoding:

```php
// ✅ CORRECTO
$validated = $request->validate([
    'status' => 'required|in:' . implode(',', DummyItem::getStatuses()),
    'priority' => 'required|in:' . implode(',', DummyItem::getPriorities()),
    'category' => 'required|in:' . implode(',', DummyItem::getCategories()),
]);

// ❌ INCORRECTO
$validated = $request->validate([
    'status' => 'required|in:active,inactive',  // Valores hardcoded
]);
```

**Beneficios:**
- ✅ Un solo lugar para cambiar valores
- ✅ Consistencia automática entre controller y DB
- ✅ Type safety con constantes
- ✅ Refactoring más seguro

---

## 🚫 Evitar Hardcoding

### Vistas Blade

**Antes (Hardcoded):**
```blade
❌ MAL
<select name="status" class="form-select">
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
</select>

@if($item->status === 'active')
    <span class="badge badge-light-success">Active</span>
@else
    <span class="badge badge-light-warning">Inactive</span>
@endif
```

**Ahora (Dinámico):**
```blade
✅ BIEN
@php
    use Bithoven\Dummy\Models\DummyItem;
@endphp

<select name="status" class="form-select">
    @foreach(DummyItem::getStatuses() as $status)
        <option value="{{ $status }}">
            {{ ucfirst(str_replace('_', ' ', $status)) }}
        </option>
    @endforeach
</select>

<span class="badge {{ $item->getStatusBadgeClass() }}">
    {{ $item->getStatusLabel() }}
</span>
```

**Beneficios:**
- ✅ Cambios en el modelo se reflejan automáticamente
- ✅ No duplicar lógica de presentación
- ✅ Badges y labels centralizados

---

## 🗄️ Consistencia Base de Datos

### Defaults en Migraciones

**Regla:** Los defaults de la migración deben coincidir con los del modelo.

```php
// ✅ CORRECTO - Migración
Schema::create('dummy_items', function (Blueprint $table) {
    $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])
          ->default('pending');  // ← Coincide con modelo
});

// ✅ CORRECTO - Modelo
protected $attributes = [
    'status' => self::STATUS_PENDING,  // ← Mismo valor
];
```

### ENUM Values

**Importante:** Los valores ENUM de la base de datos deben estar definidos como constantes en el modelo.

```php
// ✅ CORRECTO - Sincronizados
// Migración:
->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])

// Modelo:
public const STATUS_PENDING = 'pending';
public const STATUS_IN_PROGRESS = 'in_progress';
public const STATUS_COMPLETED = 'completed';
public const STATUS_CANCELLED = 'cancelled';
```

---

## 🔄 Proceso de Cambio

Cuando necesites **agregar/modificar** valores ENUM:

### 1️⃣ Actualizar Modelo
```php
// DummyItem.php
public const STATUS_ON_HOLD = 'on_hold';

public static function getStatuses(): array
{
    return [
        self::STATUS_PENDING,
        self::STATUS_IN_PROGRESS,
        self::STATUS_ON_HOLD,      // ← Nuevo
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];
}
```

### 2️⃣ Crear Migración
```php
// 2025_XX_XX_add_on_hold_status.php
Schema::table('dummy_items', function (Blueprint $table) {
    $table->dropColumn('status');
});

Schema::table('dummy_items', function (Blueprint $table) {
    $table->enum('status', ['pending', 'in_progress', 'on_hold', 'completed', 'cancelled'])
          ->default('pending');
});
```

### 3️⃣ Actualizar Badge Logic (si es necesario)
```php
public function getStatusBadgeClass(): string
{
    return match($this->status) {
        self::STATUS_PENDING => 'badge-light-warning',
        self::STATUS_IN_PROGRESS => 'badge-light-primary',
        self::STATUS_ON_HOLD => 'badge-light-info',  // ← Nuevo
        self::STATUS_COMPLETED => 'badge-light-success',
        self::STATUS_CANCELLED => 'badge-light-danger',
        default => 'badge-light-secondary',
    };
}
```

### 4️⃣ NO tocar
- ❌ NO modificar controller (usa `getStatuses()`)
- ❌ NO modificar vista (usa `@foreach`)
- ✅ Cambios automáticos en todos lados

---

## ⚠️ Problemas Comunes y Soluciones

### Error: "Data truncated for column 'status'"

**Causa:** Valor enviado no está en ENUM de la base de datos.

**Solución:**
1. Verificar constantes del modelo coinciden con migración
2. Verificar controller usa `getStatuses()`
3. Verificar vista usa `@foreach(DummyItem::getStatuses())`

### Error: Validation failed

**Causa:** Valores de validación no coinciden con valores enviados.

**Solución:**
```php
// ✅ Asegúrate de usar esto en el controller
'status' => 'required|in:' . implode(',', DummyItem::getStatuses())

// ❌ Nunca hagas esto
'status' => 'required|in:active,inactive'
```

---

## 📚 Checklist de Validación

Antes de hacer commit, verifica:

- [ ] Constantes definidas en modelo
- [ ] Métodos `get*()` retornan arrays con todas las opciones
- [ ] Migración ENUM coincide con constantes
- [ ] Controller usa `implode(',', Model::get*())`
- [ ] Vista usa `@foreach(Model::get*())`
- [ ] Badges usan métodos del modelo (`getBadgeClass()`)
- [ ] Defaults coinciden entre migración y modelo

---

## 🎓 Lecciones Aprendidas

### Incidente: Status Mismatch (14 Nov 2025)

**Problema:** 
- Controller validaba `in:active,inactive`
- Base de datos tenía ENUM `['pending','in_progress','completed','cancelled']`
- Resultado: Imposible crear items

**Causa Raíz:**
- Valores hardcoded en múltiples lugares
- Migración cambió ENUM sin actualizar controller/vista
- No había "single source of truth"

**Solución Implementada:**
- Constantes en modelo
- Métodos `getStatuses()`, `getPriorities()`, `getCategories()`
- Controller y vistas usan estos métodos
- Métodos helper para badges/labels

**Prevención:**
- Seguir esta documentación
- Code review checklist
- Tests que validen consistencia

---

**Recuerda:** El modelo es la fuente de verdad. Todo lo demás debe consultarlo.
