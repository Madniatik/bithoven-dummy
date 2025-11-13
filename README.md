# Bithoven Dummy Extension

A development and testing extension for the Bithoven Laravel platform.

## Purpose

This extension serves as:
- **Development Template**: Example structure for creating new extensions
- **Testing Tool**: Safe environment for testing extension system features
- **Documentation**: Reference implementation of extension best practices

## Features

- ✅ Complete CRUD operations
- ✅ Database migrations with rollback
- ✅ Publishable views and config
- ✅ RESTful routes
- ✅ Model with soft deletes
- ✅ Controller with validation
- ✅ Blade components using Metronic theme

## Installation

```bash
# Add to composer.json repositories
{
    "type": "path",
    "url": "../EXTENSIONS/bithoven-dummy"
}

# Install via composer
composer require bithoven/dummy:@dev

# Install via Bithoven Extension Manager
php artisan bithoven:extension:install dummy
```

## Usage

After installation:

1. Enable the extension:
```bash
php artisan bithoven:extension:enable dummy
```

2. Visit `/dummy` to see the interface

3. Test CRUD operations:
   - Create dummy items
   - Update items
   - Delete items
   - View stats

## Development

### Testing Updates

To test the update system:

1. Modify `composer.json` version
2. Create a git tag
3. Test update via Extension Manager UI

### Testing Backups

1. Create some dummy items
2. Trigger an update
3. Verify backup created in `storage/backups/extensions/dummy/`
4. Test restore functionality

### Testing Uninstall

```bash
# Uninstall with data removal
php artisan bithoven:extension:uninstall dummy --remove-data

# Uninstall keeping data
php artisan bithoven:extension:uninstall dummy
```

## Structure

```
bithoven-dummy/
├── config/
│   └── dummy.php           # Configuration file
├── database/
│   └── migrations/         # Database migrations
├── resources/
│   └── views/              # Blade views
├── routes/
│   └── web.php             # Routes
├── src/
│   ├── Http/
│   │   └── Controllers/    # Controllers
│   ├── Models/             # Eloquent models
│   └── DummyServiceProvider.php
└── composer.json
```

## Configuration

Publish and edit config:

```bash
php artisan vendor:publish --tag=dummy-config
```

Edit `config/dummy.php`:

```php
return [
    'enabled' => true,
    'test_setting' => 'your value',
    'features' => [
        'feature_one' => true,
    ],
];
```

## Database

The extension creates a `dummy_items` table with:
- `id`: Primary key
- `name`: Item name
- `description`: Optional description
- `status`: active/inactive
- `order`: Display order
- `timestamps`: Created/updated dates
- `deleted_at`: Soft delete timestamp

## Routes

- `GET /dummy` - List items
- `POST /dummy` - Create item
- `PUT /dummy/{item}` - Update item
- `DELETE /dummy/{item}` - Delete item

## Testing Scenarios

### Scenario 1: Basic CRUD
1. Install extension
2. Create items
3. Update items
4. Delete items

### Scenario 2: Update with Migration
1. Add new migration (e.g., add column)
2. Bump version
3. Test update flow
4. Verify migration executed
5. Verify backup created

### Scenario 3: Rollback
1. Create faulty migration
2. Attempt update
3. Verify automatic rollback
4. Verify data restored

### Scenario 4: Uninstall
1. Create data
2. Uninstall with `--remove-data`
3. Verify table dropped
4. Reinstall
5. Uninstall without flag
6. Verify table preserved

## License

MIT License - See LICENSE file for details

## Support

For issues or questions:
- GitHub: https://github.com/Madniatik/bithoven-dummy
- Email: dev@bithoven.com
