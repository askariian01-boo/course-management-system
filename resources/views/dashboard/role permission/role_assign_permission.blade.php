@extends('dashboard.master')
@section('content')
    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body ml-3 mr-3">
            <h4 class="card-title">add permissions </h4><br>
            <form class="forms-sample" method="post" action="{{ route('permission_roles_save') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="row mb-3 col-md-12">
                    <label class="col-sm-3 col-form-label">roles name</label>
                    <div class="col-sm-9">
                        <select class="form-select orm-select-lg w-100" required name="role_id">
                            <option selected disabled>select role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('role_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="border border-success border-2 opacity-100">

                {{-- ✅ All Permissions --}}
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input ml-1" id="checkAll">
                    <label for="checkAll" class="form-check-label ml-5">All Permissions</label>
                </div>

                <hr class="border border-success border-2 opacity-100">

                @foreach ($permission_Group as $groups)
                    <div class="row mb-2">

                        {{-- ✅ Group --}}
                        <div class="col-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input group-checkbox ml-1" id="group{{ $loop->index }}"
                                    data-group="{{ $groups->group_name }}">

                                <label for="group{{ $loop->index }}" class="form-check-label ml-5">
                                    {{ $groups->group_name }}
                                </label>
                            </div>
                        </div>

                        {{-- ✅ Permissions --}}
                        <div class="col-8">
                            @php
                                $permissions = App\Models\User::getPermissionByGroupName($groups->group_name);
                            @endphp

                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" class="form-check-input permission-checkbox"
                                        id="perm{{ $permission->id }}" data-group="{{ $groups->group_name }}"
                                        value="{{ $permission->id }}">

                                    <label for="perm{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <hr class="border border-success border-2 opacity-100">
                @endforeach

                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="button" class="btn btn-secondary">Cancel</button>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            // ✅ 1. All Permissions
            $('#checkAll').on('click', function() {
                let isChecked = $(this).is(':checked');

                $('.permission-checkbox, .group-checkbox').prop('checked', isChecked);
            });

            // ✅ 2. Group checkbox
            $('.group-checkbox').on('click', function() {
                let group = $(this).data('group');
                let isChecked = $(this).is(':checked');

                $('.permission-checkbox[data-group="' + group + '"]').prop('checked', isChecked);
            });

            // ✅ 3. وقتی permission تغییر کند
            $('.permission-checkbox').on('click', function() {

                let group = $(this).data('group');

                // بررسی وضعیت group
                let total = $('.permission-checkbox[data-group="' + group + '"]').length;
                let checked = $('.permission-checkbox[data-group="' + group + '"]:checked').length;

                $('.group-checkbox[data-group="' + group + '"]').prop('checked', total === checked);

                // بررسی وضعیت all
                let totalAll = $('.permission-checkbox').length;
                let checkedAll = $('.permission-checkbox:checked').length;

                $('#checkAll').prop('checked', totalAll === checkedAll);
            });

        });
    </script>
@endsection
