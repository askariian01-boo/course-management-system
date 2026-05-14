@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style">
            <h4 class="mb-10">Employee List
                @if (Auth::user()->can('employee_add'))
                <a href="{{ route('staff_add') }}" class="btn btn-primary fw-bold float-right btn-sm"><i
                        class="fa fa-plus"></i>add employee</a>
            @endif
            </h4>
            <div class="table-wrapper table-striped table-bordered table-responsive ">
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
                                <h6 style="font-weight: bold;">position</h6>
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
                            @if (Auth::user()->can('employee_detail'))
                                <th>
                                    <h6 style="font-weight: bold;">detail</h6>
                                </th>
                            @endif
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff)
                            <tr>

                                <td class="py-1">
                                    <p><img style="margin-top:2px;" src="/images/staff/{{ $staff->Image }}"></p>
                                </td>

                                <td class="min-width">
                                    <p>{{ $staff->FirstName }} {{ $staff->LastName }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $staff->Position }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $staff->phone }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $staff->Email }}</p>
                                </td>
                                <td class="min-width">
                                    <p>{{ $staff->RegDate }}</p>
                                </td>
                                @if (Auth::user()->can('employee_detail'))
                                    <td class="min-width">
                                        <p class="text-white"><a href="{{ route('staff_detail', $staff->id) }}"
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
    </div>
@endsection
