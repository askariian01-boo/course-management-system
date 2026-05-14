@extends('dashboard.master')
@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Student Fees</h4>

        </div>
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
                        <option value="{{ $key }}" {{ request('month', now()->month) == $key ? 'selected' : '' }}>
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
                @if (Auth::user()->can('student_fees_add'))
                    <a href="{{ route('student_fees_add') }}" class="btn btn-sm btn-primary fw-bold"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem;">
                        <i class="fa fa-add"></i> add fees
                    </a>
                @endif

            </div>


        </form>

        {{-- جدول فیس  --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th>student</th>
                        <th>class</th>
                        <th>Date</th>
                        <th>amount</th>
                        <th>pay date</th>
                        @if (Auth::user()->can('student_fees_delete'))
                            <th class="text-center">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                        <tr>
                            <td>
                                <p>
                                    {{ optional($fee->student)->FirstName }}
                                    {{ optional($fee->student)->LastName }}
                                </p>
                            </td>
                            <td>
                                <p>{{ $fee->student->class->ClassName }}</p>
                            </td>
                            <td>
                                <p>{{ $fee->fees_year }} - {{ $fee->fees_month }}</p>
                            </td>

                            <td>
                                <p>{{ $fee->fees_amount }} AFG</p>
                            </td>
                            <td>
                                <p>{{ $fee->payment_date }}</p>
                            </td>
                            @if (Auth::user()->can('student_fees_delete'))
                                <td>
                                    <p>
                                    <form action="{{ route('student_delete', $fee->student_id) }}" method="POST"
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
