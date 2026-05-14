@extends('dashboard.master')
@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Permissions List</h4>
            @if (Auth::user()->can('permission_add'))
                <a href="{{ route('add_permission') }}" class="btn btn-primary fw-bold float-right btn-sm"><i
                        class="fa fa-plus"></i>add permission</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">permission name</th>
                        <th class="text-center">group name</th>
                        @if (Auth::user()->can('permission_edit'))
                            <th class="text-center">edit</th>
                        @endif
                        @if (Auth::user()->can('permission_delete'))
                            <th class="text-center">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $key = 1;
                    @endphp

                    @forelse($data as $permission)
                        <tr>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0;">
                                    {{ $key++ }}
                                </p>
                            </td>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0;">{{ $permission->name }}</p>
                            </td>
                            <td class="text-center" style="padding: 2px;">
                                <p style="margin: 0;">{{ $permission->group_name }}</p>
                            </td>
                            @if (Auth::user()->can('permission_edit'))
                                <td class="text-center" style="padding: 2px;">
                                    <a style="margin: 0;" href="{{ route('edit_permission', $permission->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            @endif
                            @if (Auth::user()->can('permission_delete'))
                                <td class="text-center" style="padding: 2px;">
                                    <p style="margin: 0;">
                                    <form action="{{ route('delete_permission', $permission->id) }}" method="POST"
                                        class="d-inline">
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
        {{-- صفحه‌بندی --}}
    </div>
@endsection
{{-- @section('scripts')
    {{-- // برای گفتن شاگرد و مضمون همان صنف --}}
{{-- <script>
        document.getElementById('class_select').addEventListener('change', function() {
            let classId = this.value;

            let subjectSelect = document.getElementById('subject_select');

            // reset
            subjectSelect.innerHTML = '<option value="">select subject</option>';

            if (classId === "") return;

            fetch(`/get-class-data/${classId}`)
                .then(response => response.json())
                .then(data => {

                    data.subjects.forEach(sub => {
                        subjectSelect.innerHTML += `
                        <option value="${sub.id}">
                            ${sub.SubjectName}
                        </option>
                    `; --}}
{{-- });

                });
        });
    </script> --}}
{{-- @endsection --}}
