<x-dummy::layouts.main title="About" breadcrumb="dummy.about">
    <!--begin::Extension Info-->
    <div class="card mb-7">
        <div class="card-header">
            <h3 class="card-title">Extension Information</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-row-bordered gy-5">
                    <tbody>
                        <tr>
                            <td class="fw-bold text-gray-700 w-250px">Name</td>
                            <td class="text-gray-800">{{ $info['name'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-gray-700">Version</td>
                            <td class="text-gray-800"><span class="badge badge-light-primary">{{ $info['version'] }}</span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-gray-700">Author</td>
                            <td class="text-gray-800">{{ $info['author'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-gray-700">License</td>
                            <td class="text-gray-800">{{ $info['license'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-gray-700">Repository</td>
                            <td class="text-gray-800">
                                <a href="{{ $info['repository'] }}" target="_blank" class="text-primary">
                                    {{ $info['repository'] }}
                                    <i class="ki-duotone ki-arrow-up-right fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::Extension Info-->

    <!--begin::Features-->
    <div class="card mb-7">
        <div class="card-header">
            <h3 class="card-title">Features</h3>
        </div>
        <div class="card-body">
            <div class="row g-5">
                @foreach($features as $feature)
                    <div class="col-lg-6">
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-check-circle fs-2x text-success me-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="fw-semibold text-gray-700">{{ $feature }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Features-->

    <!--begin::System Info-->
    <div class="card mb-7">
        <div class="card-header">
            <h3 class="card-title">System Information</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-row-bordered gy-5">
                    <tbody>
                        <tr>
                            <td class="fw-bold text-gray-700 w-250px">PHP Version</td>
                            <td class="text-gray-800">{{ $info['php_version'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-gray-700">Laravel Version</td>
                            <td class="text-gray-800">{{ $info['laravel_version'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-gray-700">Database</td>
                            <td class="text-gray-800">{{ config('database.default') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end::System Info-->

    <!--begin::Links-->
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ $info['repository'] }}" target="_blank" class="btn btn-primary">
                    <i class="ki-duotone ki-code fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    View on GitHub
                </a>
                <a href="{{ $info['repository'] }}/blob/main/README.md" target="_blank" class="btn btn-light-primary">
                    <i class="ki-duotone ki-book fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    Documentation
                </a>
                <a href="{{ $info['repository'] }}/issues" target="_blank" class="btn btn-light-danger">
                    <i class="ki-duotone ki-information-5 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    Report Issue
                </a>
            </div>
        </div>
    </div>
    <!--end::Links-->
</x-dummy::layouts.main>
