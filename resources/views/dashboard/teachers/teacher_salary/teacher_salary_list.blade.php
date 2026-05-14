@extends('dashboard.master')

@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card-style">

            <h4 class="mb-4">
                Teacher Salary List


            </h4>

            {{-- FILTER --}}
            <form method="GET" class="row g-2 mb-3">


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
                    <select name="year" class="form-select">
                        @for ($y = now()->year; $y >= now()->year - 5; $y--)
                            <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

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

                <div class="col-12 col-md-4 d-flex gap-2">

                    <button type="submit" class="btn btn-success flex-fill fw-bold"
                        style="padding-top: 0.25rem; padding-bottom: 0.25rem;">
                        <i class="fa fa-filter"></i> Filter
                    </button>

                    {{-- ❗ FIXED: اشتباه بود attendance --}}
                    @if (Auth::user()->can('teacher_salary_add'))
                        <a href="{{ route('teacher_salary_add') }}" class="btn btn-sm btn-primary fw-bold float-right pt-2"
                            style="padding-top: 0.25rem; padding-bottom: 0.6rem;">
                            <i class="fa fa-add"></i> culculate salary
                        </a>
                    @endif

                </div>

            </form>

            <hr>

            <table class="table table-bordered text-center align-middle table-striped table-hover tableD" id="myTable">
                <thead class="table-light">
                    <tr>
                        <th style="padding:16px; font-weight:500; font-size:16px;">employee</th>
                        <th style="padding:16px; font-weight:500; font-size:16px;">month</th>
                        <th style="padding:16px; font-weight:500; font-size:16px;">gross_salary</th>
                        <th style="padding:16px; font-weight:500; font-size:16px;">net salary</th>
                        <th style="padding:16px; font-weight:500; font-size:16px;">status</th>
                        <th style="padding:16px; font-weight:500; font-size:16px;">pay_date</th>
                        @if (Auth::user()->can('teacher_salary_delete'))
                            <th style="padding:16px; font-weight:500; font-size:16px;">delete</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse($salaries as $salary)
                        <tr>

                            <td style="padding:10px;  font-weight:500; font-size:12px;">
                                {{ optional($salary->teacher)->FirstName }}
                                {{ optional($salary->teacher)->LastName }}
                            </td>

                            <td style="padding:10px;  font-weight:500; font-size:12px;">
                                {{ $salary->salary_year }} - {{ $salary->salary_month }}
                            </td>

                            <td style="padding:10px; font-weight:500; font-size:12px;">
                                {{ optional($salary->teacher)->GrossSalary ?? 0 }} AFG
                            </td>

                            <td style="padding:10px; font-weight:500; font-size:12px;">
                                {{ $salary->net_salary }} AFG
                            </td>

                            <td style="padding:10px;  font-weight:500; font-size:12px;">
                                <span class="badge badge-sm {{ $salary->status == 'paid' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($salary->status) }}
                                </span>
                            </td>

                            <td style="padding:10px; font-weight:500; font-size:12px;">
                                {{ $salary->pay_date ?? '-' }}
                            </td>
                            @if (Auth::user()->can('teacher_salary_delete'))
                                <td style="padding:10px; font-weight:500; font-size:12px;">
                                    <form
                                        action="{{ route('teacher_salary_delete', [$salary->teacher_id, $salary->salary_year, $salary->salary_month]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-sm btn-danger delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            @endif

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">
                                No salary records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
