@extends('dashboard.master')
@section('content')
    <style>
        .permission-box {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;

            max-height: 150px;
            overflow-y: auto;

            overflow-x: hidden;
            /* خیلی مهم */
            align-content: flex-start;
            /* جلوگیری از پخش شدن عجیب */
        }

        .permission-badge {
            background: #bdb89c;
            color: #fff;
            font-size: 12px;
            padding: 5px 8px;
            border-radius: 6px;

            display: inline-block;
        }
    </style>
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">roles in permissions list</h4>
            @if (Auth::user()->can('assign_permissions_roles'))
                <a href="{{ route('roles_assign_permission') }}" class="btn btn-primary float-right btn-sm fw-bold"><i
                        class="fa fa-plus fw-bold"></i>assign_roles_in_permissions</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th class="text-center fw-1">id</th>
                        <th class="text-center fw-1">roles name</th>
                        <th class="text-center fw-1">permissions name</th>
                        @if (Auth::user()->can('edit_permissions_roles'))
                            <th class="text-center fw-1">edit</th>
                        @endif
                        @if (Auth::user()->can('delete_permissions_roles'))
                            <th class="text-center fw-1">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $keys = 1;
                    @endphp

                    @foreach ($roles as $key => $item)
                        <tr>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0;">
                                    {{ $keys++ }}
                                </p>
                            </td>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0">{{ $item->name }}</p>
                            </td>
                            <td style="padding: 8px; width: 500px;">
                                <div class="permission-box">
                                    @foreach ($item->permissions as $permission)
                                        <span class="badge permission-badge">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            @if (Auth::user()->can('edit_permissions_roles'))
                                <td class="text-center text-white" style="padding: 2px;">
                                    <p style="margin: 0;">
                                        <a href="{{ route('permission_roles_edit', $item->id) }}"
                                            class="btn btn-sm btn-info"><i class="text-white fa fa-edit"></i></a>
                                    </p>
                                </td>
                            @endif
                            @if (Auth::user()->can('delete_permissions_roles'))
                                <td class="text-center text-white" style="padding: 2px;">
                                    <p style="margin: 0;">
                                        <a href="{{ route('permission_roles_delete', $item->id) }}"
                                            class="btn btn-sm btn-danger" id="delete"><i
                                                class="text-white fa fa-trash"></i></a>
                                    </p>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- صفحه‌بندی --}}
    </div>
@endsection
