@extends('dashboard.master')

@section('content')
    <div class="card-body mt-3 ml-4 mr-4 p-4 bg-white rounded">

        <h4 class="mb-4 fw-bold text-primary">
            Attendance Calendar - {{ $Student->FirstName }} {{ $Student->LastName }}
        </h4>

        {{-- Filter --}}
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
                <a href="{{ route('student_attendance_list') }}" class="btn btn-info flex-fill text-white"
                    style="padding-top: 0.65rem; padding-bottom: 0.6rem;">
                    <i class="fa fa-arrow-left"></i> back
                </a>
            </div>
        </form>

        @php
            $start = \Carbon\Carbon::create($year, $month, 1);
            $daysInMonth = $start->daysInMonth;
        @endphp

        {{-- Calendar --}}
        <div class="calendar-grid">

            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                    $attendance = $attendances[$date] ?? null;

                    $status = $attendance->status ?? null;
                    $remark = $attendance->remark ?? null;
                @endphp

                <div
                    class="calendar-cell 
                @if ($status == 'absent') absent
                @elseif($status == 'present') present @endif">

                    <div class="day-number">{{ $day }}</div>

                    {{-- Status --}}
                    @if ($status == 'absent')
                        <div class="icon">❌</div>
                        <div class="remark" title="{{ $remark }}">
                            {{ \Illuminate\Support\Str::limit($remark, 10) }}
                        </div>
                    @elseif($status == 'present')
                        <div class="icon">✔️</div>
                    @else
                        <div class="no-data">-</div>
                    @endif

                    {{-- Hover Actions --}}
                    <div class="calendar-actions">

                        @if ($status == 'absent')
                            {{-- Edit --}}
                            @if (Auth::user()->can('student_attendance_edit'))
                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endif
                            @if (Auth::user()->can('student_attendance_delete'))
                                {{-- Delete --}}
                                <form action="{{ route('student_attendance_delete', [$Student->id, $date]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endif

                    </div>

                </div>
            @endfor

        </div>
    </div>

    {{-- 🎨 STYLE --}}
    <style>
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }

        .calendar-cell {
            height: 60px;
            border-radius: 6px;
            background: #f1f3f5;
            position: relative;
            text-align: center;
            font-size: 11px;
            padding: 4px;
            transition: 0.2s;
            overflow: hidden;
        }

        .calendar-cell:hover {
            transform: scale(1.05);
        }

        .day-number {
            position: absolute;
            top: 3px;
            left: 6px;
            font-size: 11px;
            font-weight: bold;
        }

        .icon {
            font-size: 15px;
            margin-top: 15px;
        }

        .remark {
            font-size: 9px;
            margin-top: 2px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
            padding: 1px 3px;
        }

        .no-data {
            color: #aaa;
            margin-top: 18px;
        }

        /* colors */
        .absent {
            background: #f8d7da;
        }

        .present {
            background: #d4edda;
        }

        /* hover actions */
        .calendar-actions {
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 3px;

            opacity: 0;
            transition: 0.2s;
        }

        .calendar-cell:hover .calendar-actions {
            opacity: 1;
        }

        .calendar-actions .btn {
            padding: 2px 5px;
            font-size: 16px;
        }

        .calendar-actions form {
            margin: 0;
        }

        /* mobile */
        @media (max-width: 768px) {
            .calendar-cell {
                height: 55px;
            }

            .remark {
                display: none;
            }
        }
    </style>
@endsection
