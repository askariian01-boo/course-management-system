@extends('dashboard.master')

@section('content')
    <style>
        .card-body {
            overflow-x: auto;
            overflow-y: visible;
        }

        .tableD {
            width: 100% !important;
            margin-bottom: 0 !important;
            border-collapse: collapse;
        }

        .tableD tbody tr td {
            padding: 12px !important;
            vertical-align: middle;
        }
    </style>


    <div class="container mt-4">
        <div class="row g-4">

            <!-- LEFT COLUMN -->
            <div class="col-lg-4 col-md-5 col-12">

                <!-- Class Card -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <img src="{{ $class->image ? '/images/classes/' . $class->image : '' }}"
                            class="rounded-circle p-1 bg-primary mb-3" width="140" height="140">

                        <h5 class="mb-2"> Name : {{ $class->ClassName }}</h5>
                        <h6 class="mb-2"> Fees : {{ $class->ClassFees }} AFG</h6>
                        <p class="mb-3">Capacity : {{ $class->capacity }} students</p>

                        @if (Auth::user()->can('class_edit'))
                            <a href="{{ route('class_edit', $class->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif

                        @if (Auth::user()->can('class_delete'))
                            <form action="{{ route('class_delete', $class->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete">
                                    Delete
                                </button>
                            </form>
                        @endif

                    </div>
                </div>

                <!-- CLASS INFO -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Class Information</h5>

                        <table class="table table-striped">
                            <tr>
                                <td>Name</td>
                                <td>{{ $class->ClassName }}</td>
                            </tr>

                            <tr>
                                <td>Fees</td>
                                <td>{{ $class->ClassFees }} AFG</td>
                            </tr>

                            <tr>
                                <td>Capacity</td>
                                <td>{{ $class->capacity }} students</td>
                            </tr>
                            <tr></tr>
                        </table>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-8 col-md-7 col-12">

                <!-- DESCRIPTION -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Description</h5>
                        <p>{{ $class->description ?? 'No description available' }}</p>
                    </div>
                </div>

                <!-- STUDENTS -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <h5 class="mb-3">students list</h5>
                        <hr>

                        <table class="table table-striped tableD mb-0">
                            <thead>
                                <tr>
                                    <th style="padding:16px; font-weight:500; font-size:16px;" class="text-center">id</th>
                                    <th style="padding:16px; font-weight:500; font-size:16px;">full_name</th>
                                    <th style="padding:16px; font-weight:500; font-size:16px;" class="text-center">
                                        phone_number</th>
                                    <th style="padding:16px; font-weight:500; font-size:16px;">nic_cart</th>
                                </tr>
                            </thead>
                            @php
                                $key = 1;
                            @endphp
                            <tbody>
                                @forelse($class->students as $student)
                                    <tr>
                                        <td style="padding:10px;  font-weight:500; font-size:12px;">{{ $key++ }}
                                        </td>
                                        <td style="padding:10px;  font-weight:500; font-size:12px;">
                                            {{ $student->FirstName }} {{ $student->LastName }}</td>
                                        <td style="padding:10px;  font-weight:500; font-size:12px;">{{ $student->Phone }}
                                        </td>
                                        <td style="padding:10px;  font-weight:500; font-size:12px;">{{ $student->NIC }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="padding: 16px; text-align:center;">
                                            No students found
                                        </td>
                                    </tr>
                                @endempty
                        </tbody>

                    </table>

                </div>
            </div>

            <!-- SUBJECTS -->
            <div class="card shadow">
                <div class="card-body">

                    <h5 class="mb-3">subjects list
                        @if (Auth::user()->can('assign_subject_class'))
                            <a href="{{ route('assign_subject', $class->id) }}"
                                class="btn btn-sm btn-primary float-right">
                                <i class="fa fa-add"></i>
                                assign_subject</a>
                        @endif
                    </h5>
                    <hr>

                    <table class="table table-striped tableD" id="myTable">
                        <thead>
                            <tr>
                                <th style="padding:16px; font-weight:500; font-size:16px;" class="text-center">id</th>
                                <th style="padding:16px; font-weight:500; font-size:16px;">name</th>
                                <th style="padding:16px; font-weight:500; font-size:16px;">author</th>
                                @if (Auth::user()->can('subject_class_delete'))
                                    <th style="padding:16px; font-weight:500; font-size:16px;">delete</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $keys = 1;
                        @endphp
                        <tbody>
                            @forelse($class->subjects as $subject)
                                <tr>
                                    <td>{{ $keys++ }}</td>
                                    <td>{{ $subject->SubjectName }}</td>
                                    <td>{{ $subject->Author }}</td>

                                    @if (Auth::user()->can('subject_class_delete'))
                                        <td>
                                            <form
                                                action="{{ route('class_subject_delete', [$class->id, $subject->id]) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>
                                        </td>
                                    @endif
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No subjects found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
