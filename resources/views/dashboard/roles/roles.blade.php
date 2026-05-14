@extends('dashboard.master')
@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Roles List
            </h4>
            @if (Auth::user()->can('role_add'))
                <a href="{{ route('add_roles') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-plus"></i>add
                    roles</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">role name</th>
                        @if (Auth::user()->can('role_edit'))
                            <th class="text-center">edit</th>
                        @endif
                        @if (Auth::user()->can('role_delete'))
                            <th class="text-center">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $key = 1;
                    @endphp

                    @forelse($data as $role)
                        <tr>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0;">
                                    {{ $key++ }}
                                </p>
                            </td>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0;">{{ $role->name }}</p>
                            </td>
                            @if (Auth::user()->can('role_edit'))
                                <td class="text-center" style="padding: 2px;">
                                    <a style="margin: 0;" href="{{ route('edit_roles', $role->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            @endif
                            @if (Auth::user()->can('role_delete'))
                                <td class="text-center" style="padding: 2px;">
                                    <p style="margin: 0;">
                                    <form action="{{ route('delete_roles', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    </p>
                                </td>
                            @endif
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
