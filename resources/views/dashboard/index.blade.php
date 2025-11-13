<x-dummy::layouts.main title="Dashboard" breadcrumb="dummy.dashboard">
    <!--begin::Welcome Card-->
    <div class="card mb-7">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60px me-5">
                    <span class="symbol-label bg-light-primary">
                        <i class="ki-duotone ki-element-11 fs-2x text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </span>
                </div>
                <div class="flex-grow-1">
                    <h1 class="text-gray-900 fw-bold mb-1">Welcome to Dummy Extension</h1>
                    <div class="text-muted fw-semibold fs-6">Version 1.1.0 - Development & Testing Tool</div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Welcome Card-->

    <!--begin::Stats-->
    <div class="row g-6 g-xl-9 mb-7">
        <div class="col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-primary">
                                <i class="ki-duotone ki-element-11 fs-2x text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900">{{ $stats['total'] }}</div>
                            <div class="fs-7 fw-semibold text-gray-500">Total Items</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-success">
                                <i class="ki-duotone ki-check-circle fs-2x text-success">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900">{{ $stats['active'] }}</div>
                            <div class="fs-7 fw-semibold text-gray-500">Active Items</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-warning">
                                <i class="ki-duotone ki-cross-circle fs-2x text-warning">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900">{{ $stats['inactive'] }}</div>
                            <div class="fs-7 fw-semibold text-gray-500">Inactive Items</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-duotone ki-calendar-add fs-2x text-info">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900">{{ $stats['today'] }}</div>
                            <div class="fs-7 fw-semibold text-gray-500">Created Today</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stats-->

    <!--begin::Quick Actions-->
    <div class="card mb-7">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('dummy.items.index') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Create New Item
                </a>
                <a href="{{ route('dummy.items.index') }}" class="btn btn-light-primary">
                    <i class="ki-duotone ki-eye fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    View All Items
                </a>
                <a href="{{ route('dummy.settings') }}" class="btn btn-light-primary">
                    <i class="ki-duotone ki-gear fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Settings
                </a>
            </div>
        </div>
    </div>
    <!--end::Quick Actions-->

    <!--begin::Recent Activity-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Activity</h3>
        </div>
        <div class="card-body">
            @if($recentItems->isEmpty())
                <div class="text-center py-10">
                    <i class="ki-duotone ki-information-5 fs-5x text-gray-400 mb-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <h3 class="text-gray-600 fw-semibold mb-2">No recent activity</h3>
                    <p class="text-gray-500">Create your first item to see activity here</p>
                </div>
            @else
                <div class="timeline">
                    @foreach($recentItems as $item)
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px">
                                <div class="symbol-label bg-light-primary">
                                    <i class="ki-duotone ki-abstract-28 fs-2 text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <div class="timeline-content mb-10 mt-n1">
                                <div class="pe-3 mb-5">
                                    <div class="fs-5 fw-bold mb-2">{{ $item->name }}</div>
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <div class="text-muted me-2 fs-7">{{ $item->created_at->diffForHumans() }}</div>
                                        @if($item->status === 'active')
                                            <span class="badge badge-light-success">Active</span>
                                        @else
                                            <span class="badge badge-light-warning">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!--end::Recent Activity-->
</x-dummy::layouts.main>
