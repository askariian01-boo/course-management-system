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
            <div class="col-lg-4 col-md-4 col-12">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="mb-4">Subject Information</h5>

                        <table class="table">
                            <tr>
                                <td style="padding:16px; font-weight:500; font-size:16px;">Name</td>
                                <td>{{ $subject->SubjectName }}</td>
                            </tr>

                            <tr>
                                <td>Author</td>
                                <td>{{ $subject->Author }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-8 col-md-8 col-12">
                <div class="card shadow h-100">
                    <div class="card-body">

                        <h5 class="mb-3">
                            teacher list

                            @if (Auth::user()->can('subject_list'))
                            <a href="{{ route('assign_teacher', $subject->id) }}"
                                class="btn btn-sm btn-primary float-right">
                                <i class="fa fa-plus"></i>
                                assign_teacher
                            </a>
                            @endif
                            <a href="{{ route('subjects') }}" class="btn btn-secondary btn-sm float-right"> <i class="fa fa-arrow-left"></i> back </a>
                        </h5>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped tableD" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="padding:16px; font-weight:500; font-size:16px;">id</th>
                                        <th style="padding:16px; font-weight:500; font-size:16px;">name</th>
                                        <th style="padding:16px; font-weight:500; font-size:16px;">email</th>
                                        <th style="padding:16px; font-weight:500; font-size:16px;">edu_degree</th>
                                        <th style="padding:16px; font-weight:500; font-size:16px;">delete</th>
                                    </tr>
                                </thead>
                                @php
                                    $key = 1;
                                @endphp
                                <tbody>
                                    @forelse($subject->teachers as $teacher)
                                        <tr>
                                            <td style="padding:10px;  font-weight:500; font-size:12px;">{{ $key++ }}</td>

                                            <td style="padding:10px;  font-weight:500; font-size:12px;">
                                                {{ $teacher->FirstName }} -
                                                {{ $teacher->LastName }}
                                            </td>
                                            <td style="padding:10px;  font-weight:500; font-size:12px;">{{ $teacher->Email }}</td>

                                            <td style="padding:10px;  font-weight:500; font-size:12px;">{{ $teacher->EducationDegree }}</td>
                                            <td style="padding:10px;  font-weight:500; font-size:12px;">
                                                <form action="{{ route('subject_teacher_delete', [$subject->id, $teacher->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td colspan="4"
                                                class="text-center">
                                                No teachers found
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
    </div>
@endsection
