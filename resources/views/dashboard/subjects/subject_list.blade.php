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
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10"> subjects list
                @if (Auth::user()->can('subject_add'))
                    <a href="{{ route('subject_add') }}" class="btn btn-primary fw-bold float-right btn-sm"><i
                            class="fa fa-plus"></i>add subject</a>
                @endif
            </h4><br>
            <div class="table-wrapper table-bordered table-responsive">
                <table class="table text-center table-striped table-bordered  table-hover tableD" id="myTable">
                    <thead class="thead-light">
                        <tr>
                            <th> ID </th>
                            <th class="text-center"> subject name </th>
                            <th class="text-center"> author </th>
                            <th class="text-center"> teacher </th>
                            @if (Auth::user()->can('subject_edit'))
                                <th class="text-center"> edit </th>
                            @endif
                            @if (Auth::user()->can('subject_delete'))
                                <th class="text-center"> delete </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->SubjectName }}</td>
                                <td> {{ $subject->Author }}</td>
                                @if (Auth::user()->can('subject_list'))
                                    <td>
                                        <a href="{{ route('subject_detail', $subject->id) }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                @endif
                                @if (Auth::user()->can('subject_edit'))
                                    <td>
                                        <a href="{{ route('subject_edit', $subject->id) }}"
                                            class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    </td>
                                @endif
                                @if (Auth::user()->can('subject_delete'))
                                    <td>
                                        <form action="{{ route('subject_delete', $subject->id) }}" style="display: inline;"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete"> <i
                                                    class="fa fa-trash"></i> </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <!-- end table row -->
                    </tbody>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card -->
    </div>
@endsection
