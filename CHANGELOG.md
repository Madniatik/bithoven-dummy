# Changelog

All notable changes to the Bithoven Dummy extension will be documented in this file.

## [1.1.0] - 2025-11-13

### Added
- 🎨 Complete sidebar navigation menu with 5 sections
- 📊 Dashboard page with statistics and quick actions
- 📈 Reports page with Chart.js visualizations (pie and bar charts)
- ⚙️ Settings page with configurable options
- ℹ️ About page with extension and system information
- 🏷️ Category field for items (general, important, archived)
- 📦 Bulk delete operations for items
- 💾 CSV export functionality for reports
- 📄 Pagination support (15 items per page)
- 🎯 Recent activity timeline in dashboard

### Improved
- Enhanced items page with better UX and layout
- Better validation messages with category field
- Responsive design improvements across all pages
- Performance optimizations with indexed category column

### Technical
- New migration: `add_category_to_dummy_items`
- 4 new controllers (Dashboard, Reports, Settings, About)
- Layout system with reusable sidebar component
- Chart.js integration for data visualization
- Cache-based settings management
- Proper route organization with grouped prefixes

## [1.0.0] - 2025-11-13

### Added
- Initial release
- Basic CRUD operations for dummy items
- Database migration for `dummy_items` table
- RESTful API endpoints
- Blade views with Metronic theme
- Configuration file
- Service provider with auto-discovery
- Soft deletes support
- Development and testing documentation

### Features
- Create, read, update, delete dummy items
- Status tracking (active/inactive)
- Order management
- Statistics dashboard
- Publishable views and config

## Future Versions

### [1.1.0] - Planned
- Add categories for dummy items
- Implement search functionality
- Add bulk operations
- Export/import features

### [1.2.0] - Planned
- API authentication
- Rate limiting
- Advanced filtering
- Sorting options

### [2.0.0] - Planned
- Complete UI redesign
- Multi-language support
- Advanced permissions
- Audit logging
