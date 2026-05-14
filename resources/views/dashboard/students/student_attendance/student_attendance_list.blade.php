@extends('dashboard.master')
@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style mb-30">
            <h4 class="mb-4">student attendance report
            </h4>
            <form method="GET" action="" class="row g-2 mb-3">
                <!-- سال -->
                <div class="col-12 col-md-4">
                    <select name="year" class="form-select">
                        @for ($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- ماه -->
                @php
                    $months = [
                        1 => 'January',
                        2 => 'February',
                        3 => 'March',
                        4 => 'April',
                        5 => 'May',
                        6 => 'June',
                        7 => 'July',
                        8 => 'August',
                        9 => 'September',
                        10 => 'October',
                        11 => 'November',
                        12 => 'December',
                    ];
                @endphp

                <div class="col-12 col-md-4">
                    <select name="month" class="form-select">
                        @foreach ($months as $key => $name)
                            <option value="{{ $key }}"
                                {{ request('month', now()->month) == $key ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- دکمه -->
                <div class="col-12 col-md-4 d-flex align-items-center gap-2">

                    <!-- Filter Button -->
                    <button type="submit" class="btn btn-success flex-fill"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem;">
                        <i class="fa fa-filter"></i> Filter
                    </button>

                    <!-- Add Attendance -->
                    @if (Auth::user()->can('student_attendance_add'))
                        <a href="{{ route('student_attendance_add') }}" class="btn btn-primary flex-fill text-white"
                            style="padding-top: 0.65rem; padding-bottom: 0.6rem;">
                            <i class="fa fa-plus"></i> Take Attendance
                        </a>
                    @endif

                </div>


            </form>
            <hr>
            <table class="table table-bordered text-center table-hover table-striped align-middle tableD" id="myTable">
                <thead class="table-light thead-light text-center">
                    <tr>
                        <th class="text-center">photo</th>
                        <th class="text-center">full name</th>
                        <th class="text-center">father name</th>
                        <th class="text-center">absent days</th>
                        @if (Auth::user()->can('student_attendance_detail'))
                            <th class="text-center">detail</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Student_attendance as $student)
                        <tr>
                            <td>
                                <p><img src="/images/students/{{ $student->Image }}" width="50"></p>
                            </td>

                            <td>
                                <p>{{ $student->FirstName }} {{ $student->LastName }}</p>
                            </td>

                            <td>
                                <p>{{ $student->FatherName }}</p>
                            </td>

                            <td>
                                <p>{{ $student->absent_days }} - Day</p>
                            </td>
                            @if (Auth::user()->can('student_attendance_detail'))
                                <td>
                                    <p><a href="{{ route('student_attendance_detail', $student->id) }}"
                                            class="btn btn-sm btn-primary text-white">
                                            <i class="fa fa-eye"></i>
                                        </a></p>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- صفحه‌بندی --}}
        </div>
        <!-- end card -->
    </div>
@endsection
