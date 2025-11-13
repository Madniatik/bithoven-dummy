<x-dummy::layouts.main title="Items" breadcrumb="dummy.items.index">
    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack mb-6">
        <h3 class="fw-bold my-2">Manage Items</h3>
        <div class="d-flex align-items-center gap-2 my-2">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createItemModal">
                <i class="ki-duotone ki-plus fs-2"></i>
                Create Item
            </button>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Items table-->
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" class="form-control form-control-solid w-250px ps-13" placeholder="Search items..." />
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            @if($items->isEmpty())
                <div class="text-center py-10">
                    <i class="ki-duotone ki-information-5 fs-5x text-gray-400 mb-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <h3 class="text-gray-600 fw-semibold mb-2">No items yet</h3>
                    <p class="text-gray-500 mb-5">Click "Create Item" to add your first dummy item</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-100px">Category</th>
                                <th class="min-w-125px">Description</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Order</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-40px me-3">
                                                <div class="symbol-label bg-light-primary">
                                                    <i class="ki-duotone ki-abstract-28 fs-2 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="text-gray-900 fw-bold text-hover-primary">{{ $item->name }}</a>
                                                <div class="text-muted fs-7">ID: {{ $item->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ ucfirst($item->category) }}</span>
                                    </td>
                                    <td>{{ Str::limit($item->description, 50) ?: '-' }}</td>
                                    <td>
                                        @if($item->status === 'active')
                                            <span class="badge badge-light-success">Active</span>
                                        @else
                                            <span class="badge badge-light-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->order }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-icon btn-light btn-sm me-1">
                                            <i class="ki-duotone ki-pencil fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                        <button class="btn btn-icon btn-light-danger btn-sm delete-item" data-id="{{ $item->id }}">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!--begin::Pagination-->
                <div class="d-flex justify-content-between align-items-center flex-wrap pt-5">
                    <div class="fs-6 fw-semibold text-gray-700">
                        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} items
                    </div>
                    {{ $items->links() }}
                </div>
                <!--end::Pagination-->
            @endif
        </div>
    </div>
    <!--end::Items table-->

    <!--begin::Create Item Modal-->
    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Create Dummy Item</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form id="createItemForm">
                        <div class="mb-5">
                            <label class="required form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter item name" required />
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="general">General</option>
                                <option value="important">Important</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="0" min="0" required />
                        </div>
                        <div class="text-center pt-5">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Create Item Modal-->

    @push('scripts')
    <script>
        // Create item
        document.getElementById('createItemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            fetch('{{ route('dummy.items.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Delete item
        document.querySelectorAll('.delete-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.dataset.id;
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`{{ route('dummy.items.index') }}/${itemId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            }
                        });
                    }
                });
            });
        });
    </script>
    @endpush
</x-dummy::layouts.main>
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-success">
                                <i class="ki-duotone ki-check-circle fs-2x text-success">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900">{{ $items->where('status', 'active')->count() }}</div>
                            <div class="fs-7 fw-semibold text-gray-500">Active Items</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-warning">
                                <i class="ki-duotone ki-information fs-2x text-warning">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </div>
                        <div>
                            <div class="fs-2 fw-bold text-gray-900">v{{ config('dummy.version', '1.0.0') }}</div>
                            <div class="fs-7 fw-semibold text-gray-500">Extension Version</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stats-->

    <!--begin::Items table-->
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" class="form-control form-control-solid w-250px ps-13" placeholder="Search items..." />
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            @if($items->isEmpty())
                <div class="text-center py-10">
                    <i class="ki-duotone ki-information-5 fs-5x text-gray-400 mb-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <h3 class="text-gray-600 fw-semibold mb-2">No items yet</h3>
                    <p class="text-gray-500 mb-5">Click "Create Item" to add your first dummy item</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-125px">Description</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Order</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-40px me-3">
                                                <div class="symbol-label bg-light-primary">
                                                    <i class="ki-duotone ki-abstract-28 fs-2 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="text-gray-900 fw-bold text-hover-primary">{{ $item->name }}</a>
                                                <div class="text-muted fs-7">ID: {{ $item->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($item->description, 50) ?: '-' }}</td>
                                    <td>
                                        @if($item->status === 'active')
                                            <span class="badge badge-light-success">Active</span>
                                        @else
                                            <span class="badge badge-light-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->order }}</td>
                                    <td class="text-end">
                                        <button class="btn btn-icon btn-light btn-sm me-1">
                                            <i class="ki-duotone ki-pencil fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                        <button class="btn btn-icon btn-light-danger btn-sm">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!--end::Items table-->

    <!--begin::Create Item Modal-->
    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Create Dummy Item</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form id="createItemForm">
                        <div class="mb-5">
                            <label class="required form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter item name" required />
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="required form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="0" min="0" required />
                        </div>
                        <div class="text-center pt-5">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Create Item Modal-->

    @push('scripts')
    <script>
        document.getElementById('createItemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            fetch('{{ route('dummy.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    @endpush
</x-default-layout>
