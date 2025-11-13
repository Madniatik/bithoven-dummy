<x-dummy::layouts.main title="Reports" breadcrumb="dummy.reports">
    <!--begin::Stats-->
    <div class="row g-6 g-xl-9 mb-7">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="fs-2hx fw-bold text-gray-900 mb-2">{{ $stats['total'] }}</div>
                    <div class="fs-6 fw-semibold text-gray-500">Total Items</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="fs-2hx fw-bold text-success mb-2">{{ $stats['active'] }}</div>
                    <div class="fs-6 fw-semibold text-gray-500">Active Items</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="fs-2hx fw-bold text-warning mb-2">{{ $stats['inactive'] }}</div>
                    <div class="fs-6 fw-semibold text-gray-500">Inactive Items</div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stats-->

    <!--begin::Charts-->
    <div class="row g-6 g-xl-9 mb-7">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title">Items by Category</h3>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title">Items Created (Last 7 Days)</h3>
                </div>
                <div class="card-body">
                    <canvas id="dailyChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!--end::Charts-->

    <!--begin::Top Items-->
    <div class="card mb-7">
        <div class="card-header">
            <h3 class="card-title">Top 10 Items by Order</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-row-dashed align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted">
                            <th class="min-w-50px">Rank</th>
                            <th class="min-w-200px">Name</th>
                            <th class="min-w-100px">Category</th>
                            <th class="min-w-100px">Order</th>
                            <th class="min-w-100px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topItems as $index => $item)
                            <tr>
                                <td><span class="badge badge-light-primary">#{{ $index + 1 }}</span></td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="badge badge-light">{{ ucfirst($item->category) }}</span>
                                </td>
                                <td><span class="fw-bold">{{ $item->order }}</span></td>
                                <td>
                                    @if($item->status === 'active')
                                        <span class="badge badge-light-success">Active</span>
                                    @else
                                        <span class="badge badge-light-warning">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10">
                                    <div class="text-gray-500">No items found</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Top Items-->

    <!--begin::Export-->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-2">Export Data</h3>
                    <p class="text-gray-500 mb-0">Download all items as CSV file</p>
                </div>
                <a href="{{ route('dummy.reports.export') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-file-down fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Export to CSV
                </a>
            </div>
        </div>
    </div>
    <!--end::Export-->

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Category Chart
        const categoryData = @json($itemsByCategory);
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: categoryData.map(item => item.category),
                datasets: [{
                    data: categoryData.map(item => item.total),
                    backgroundColor: ['#3E97FF', '#50CD89', '#F1416C', '#FFC700', '#7239EA'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Daily Chart
        const dailyData = @json($itemsByDay);
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: dailyData.map(item => item.date),
                datasets: [{
                    label: 'Items Created',
                    data: dailyData.map(item => item.total),
                    backgroundColor: '#3E97FF',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    @endpush
</x-dummy::layouts.main>
