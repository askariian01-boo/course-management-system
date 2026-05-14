@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10">Students List
                @if (Auth::user()->can('student_add'))
                <a href="{{ route('student_add') }}" class="btn btn-primary fw-bold float-right btn-sm"><i
                        class="fa fa-plus"></i>add student</a>
            @endif
        </h4><br>
            <div class="table-wrapper table-striped table-bordered table-responsive">
                <table class="table table-striped table-hover table-bordered tableD" id="myTable">
                    <thead class="thead-light thead-light">
                        <tr>
                            <th>
                                <h6 style="font-weight: bold;">photo</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">full name</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">phone</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">address</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">reg date</h6>
                            </th>
                            @if (Auth::user()->can('student_detail'))
                                <th>
                                    <h6 style="font-weight: bold;" class="text-left">detail</h6>
                                </th>
                            @endif
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>

                                <td class="py-1"> <img style="margin-top:13px;"
                                        src="/images/students/{{ $student->Image }}"> </td>

                                <td class="min-width">
                                    <p>{{ $student->FirstName }} {{ $student->LastName }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $student->Phone }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $student->Address }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $student->RegDate }}</p>
                                </td>
                                @if (Auth::user()->can('student_detail'))
                                    <td class="min-width">
                                        <p class="text-white"><a href="{{ route('student_detail', $student->id) }}"
                                                class="btn btn-sm btn-info ml-3"><i class="fa fa-eye"></i> </a></p>
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
