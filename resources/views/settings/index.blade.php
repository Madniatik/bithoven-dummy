<x-dummy::layouts.main title="Settings" breadcrumb="dummy.settings">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Extension Settings</h3>
        </div>
        <div class="card-body">
            <form id="settingsForm">
                @csrf
                
                <!--begin::General Settings-->
                <div class="mb-10">
                    <h4 class="mb-5">General Settings</h4>
                    
                    <div class="row mb-5">
                        <label class="col-lg-3 col-form-label fw-semibold">Items per page</label>
                        <div class="col-lg-9">
                            <select name="items_per_page" class="form-select">
                                <option value="10" {{ $settings['items_per_page'] == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ $settings['items_per_page'] == 15 ? 'selected' : '' }}>15</option>
                                <option value="25" {{ $settings['items_per_page'] == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $settings['items_per_page'] == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <label class="col-lg-3 col-form-label fw-semibold">Default status</label>
                        <div class="col-lg-9">
                            <div class="form-check form-check-custom form-check-solid mb-3">
                                <input class="form-check-input" type="radio" name="default_status" value="active" {{ $settings['default_status'] == 'active' ? 'checked' : '' }} />
                                <label class="form-check-label">Active</label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="default_status" value="inactive" {{ $settings['default_status'] == 'inactive' ? 'checked' : '' }} />
                                <label class="form-check-label">Inactive</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-lg-3 col-form-label fw-semibold">Enable notifications</label>
                        <div class="col-lg-9">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="enable_notifications" value="1" {{ $settings['enable_notifications'] ? 'checked' : '' }} />
                                <label class="form-check-label">Send notifications for new items</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::General Settings-->

                <div class="separator my-10"></div>

                <!--begin::Display Settings-->
                <div class="mb-10">
                    <h4 class="mb-5">Display Settings</h4>
                    
                    <div class="row mb-5">
                        <label class="col-lg-3 col-form-label fw-semibold">Show timestamps</label>
                        <div class="col-lg-9">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="show_timestamps" value="1" {{ $settings['show_timestamps'] ? 'checked' : '' }} />
                                <label class="form-check-label">Display creation and update timestamps</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-lg-3 col-form-label fw-semibold">Show descriptions</label>
                        <div class="col-lg-9">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="show_descriptions" value="1" {{ $settings['show_descriptions'] ? 'checked' : '' }} />
                                <label class="form-check-label">Show descriptions in item lists</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Display Settings-->

                <div class="separator my-10"></div>

                <!--begin::Actions-->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Save Settings
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('settingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {};
            
            formData.forEach((value, key) => {
                if (key.includes('enable_') || key.includes('show_')) {
                    data[key] = value === '1';
                } else {
                    data[key] = value;
                }
            });
            
            // Set unchecked checkboxes to false
            ['enable_notifications', 'show_timestamps', 'show_descriptions'].forEach(field => {
                if (!(field in data)) {
                    data[field] = false;
                }
            });
            
            fetch('{{ route('dummy.settings.update') }}', {
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved!',
                        text: data.message,
                        timer: 2000
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to save settings'
                });
            });
        });
    </script>
    @endpush
</x-dummy::layouts.main>
