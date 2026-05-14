@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10">Teahcers List
                @if (Auth::user()->can('teacher_add'))
                    <a href="{{ route('teacher_add') }}" class="btn btn-primary fw-bold float-right btn-sm"><i
                            class="fa fa-plus"></i>add teacher</a>
                @endif
            </h4><br>
            <div class="table-wrapper table-striped table-bordered table-responsive">
                <table class="table  table-bordered table-striped table-hover tableD" id="myTable">
                    <thead class="thead-light">
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
                                <h6 style="font-weight: bold;">email address</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">reg date</h6>
                            </th>
                            <th>
                                <h6 style="font-weight: bold;">classes</h6>
                            </th>
                            @if (Auth::user()->can('teacher_detail'))
                                <th>
                                    <h6 style="font-weight: bold;" class="text-left">detail</h6>
                                </th>
                            @endif
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>

                                <td class="py-1"> <img style="margin-top:13px;"
                                        src="/images/teachers/{{ $teacher->Image }}"> </td>

                                <td class="min-width">
                                    <p>{{ $teacher->FirstName }} {{ $teacher->LastName }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $teacher->Phone }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $teacher->Email }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $teacher->RegDate }}</p>
                                </td>
                                <td class="min-width">
                                    <p class="text-white">
                                        <a href="#" class="btn btn-sm btn-primary ml-3"><i class="fa fa-eye"></i> </a>
                                    </p>
                                </td>
                                @if (Auth::user()->can('teacher_detail'))
                                    <td class="min-width">
                                        <p class="text-white"><a href="{{ route('teacher_detail', $teacher->id) }}"
                                                class="btn btn-sm btn-primary ml-3"><i class="fa fa-eye"></i> </a></p>
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
    <!-- end col -->
@endsection
