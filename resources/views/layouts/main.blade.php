<x-default-layout>
    @section('title', $title ?? 'Dummy Extension')
    @section('breadcrumbs')
        {{ Breadcrumbs::render($breadcrumb ?? 'dummy.dashboard') }}
    @endsection

    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 mb-lg-0">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h2 class="mb-0">Dummy Extension</h2>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('dummy.dashboard') ? 'active' : '' }}" href="{{ route('dummy.dashboard') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('dummy.items.*') ? 'active' : '' }}" href="{{ route('dummy.items.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-document fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Items</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('dummy.reports') ? 'active' : '' }}" href="{{ route('dummy.reports') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-chart-simple fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Reports</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('dummy.settings') ? 'active' : '' }}" href="{{ route('dummy.settings') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-gear fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Settings</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('dummy.about') ? 'active' : '' }}" href="{{ route('dummy.about') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-information-5 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="menu-title">About</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Sidebar-->

        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-10">
            {{ $slot }}
        </div>
        <!--end::Content-->
    </div>

    @stack('scripts')
</x-default-layout>
