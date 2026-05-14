@extends('dashboard.master')
@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Outcome List</h4>

        </div>
        <form method="GET" action="" class="row g-2 mb-3">
            <!-- سال -->
            <div class="col-12 col-md-3">
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

            <div class="col-12 col-md-3">
                <select name="month" class="form-select">
                    @foreach ($months as $key => $name)
                        <option value="{{ $key }}" {{ request('month', now()->month) == $key ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- دکمه -->
            <div class="col-12 col-md-6 d-flex align-items-center gap-2">

                <!-- Filter Button -->
                <button type="submit" class="btn btn-success flex-fill"
                    style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                    <i class="fa fa-filter"></i> Filter
                </button>

                <!-- Add Attendance -->
                @if (Auth::user()->can('outcome_add'))
                    <a href="{{ route('outcome_add') }}" class="btn btn-sm btn-primary"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                        <i class="fa fa-add"></i> add outcome
                    </a>
                @endif
                @if (Auth::user()->can('outcome_source_list'))
                    <a href="{{ route('outcome_source_list') }}" class="btn btn-sm btn-primary"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                        <i class="fa fa-eye"></i> outcome source
                    </a>
                @endif
            </div>
        </form>

        {{-- جدول فیس  --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th>id</th>
                        <th>Source_name</th>
                        <th>Outcome_amount</th>
                        <th>Outcome_date</th>
                        <th>remark</th>
                        @if (Auth::user()->can('outcome_edit'))
                            <th class="text-center">edit</th>
                        @endif
                        @if (Auth::user()->can('outcome_delete'))
                            <th class="text-center">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($outcomes as $outcome)
                        <tr>
                            <td>
                                <p>
                                    {{ $outcome->id }}

                                </p>
                            </td>
                            <td>
                                <p>{{ $outcome->source->source_name }}</p>
                            </td>
                            <td>
                                <p>{{ $outcome->outcome_amount }} AFG</p>
                            </td>
                            <td>
                                <p>{{ $outcome->outcome_date }}</p>
                            </td>

                            <td>
                                <p>{{ $outcome->remark }}</p>
                            </td>
                            @if (Auth::user()->can('outcome_edit'))
                                <td>
                                    <a href="{{ route('outcome_edit', $outcome->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fa fa-edit"></i></a>
                                </td>
                            @endif
                            @if (Auth::user()->can('outcome_delete'))
                                <td>
                                    <p>
                                    <form action="{{ route('outcome_delete', $outcome->id) }}" method="POST"
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
