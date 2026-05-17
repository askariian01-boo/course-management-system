@extends('dashboard.master')

@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 mr-3 ml-3">
        <!-- Title -->
        <div class="d-flex justify-content-between mb-3">
            <h4 class="">Timetables list</h4>
        </div>

        <!-- Filter -->
        <form method="GET" action="#" class="row g-2 mb-3">

            <div class="col-md-8">
                <select name="class_id" class="form-select">
                    <option>select class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->ClassName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-4 d-flex gap-2">

                <!-- Filter Button -->
                <button type="submit" class="btn btn-success flex-fill"
                    style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                    <i class="fa fa-filter"></i> Show
                </button>

                <!-- Add score -->
                @if (Auth::user()->can('timetable_list'))
                    <a href="{{ route('timetable_add') }}" class="btn btn-sm btn-primary"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                        <i class="fa fa-add"></i> add timetable
                    </a>
                @endif
            </div>

        </form>

        <!-- Table -->
        <div class="table" dir="ltr">
            <table class="table table-hover table-striped text-center align-middle">

                <thead class="table-secondary">
                    <tr>
                        <th style="padding:16px;">Day</th>
                        @for ($i = 1; $i <= 4; $i++)
                            <th style="padding:16px;">period {{ $i }}</th>
                        @endfor
                    </tr>
                </thead>

                <tbody>
                    @php
                        $days = [
                            1 => 'saturday',
                            2 => 'sunday',
                            3 => 'monday',
                            4 => 'tuesday',
                            5 => 'wednesday',
                            6 => 'thursday',
                        ];
                    @endphp

                    @foreach ($days as $dayNum => $dayName)
                        <tr>
                            <td class="bg-light" style="padding:8px;">
                                <p style="margin: 0;">{{ $dayName }}</p>
                            </td>
                            @for ($p = 1; $p <= 4; $p++)
                                <td style="padding:8px;">
                                    <p style="margin: 0;">@php
                                        $item = isset($timetables[$dayNum])
                                            ? $timetables[$dayNum]->firstWhere('period', $p)
                                            : null;
                                    @endphp

                                        @if ($item)
                                            <div>
                                                <strong class="text-success">{{ $item->subject->SubjectName }}</strong><br>

                                                <small class="text-muted d-block mt-1"
                                                    style="color:#28612b; font-weight:600;">
                                                    {{ $item->teacher->FirstName }} - {{ $item->teacher->LastName }}
                                                </small>
                                                <small class="text-muted d-block mt-1 text-primary"
                                                    style="color:#000000;font-weight:500;font-size:10px;line-height:1.2;white-space:nowrap;">
                                                    {{ $item->start_time }} - {{ $item->end_time }}
                                                </small>
                                                <div class="actions mt-1 d-flex justify-content-center gap-1">

                                                    <!-- Edit -->
                                                    @if (Auth::user()->can('timetable_edit'))
                                                        <a href="{{ route('timetable_edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary"
                                                            style="font-size:10px; padding:2px 6px;">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif

                                                    <!-- Delete -->
                                                    @if (Auth::user()->can('timetable_delete'))
                                                        <form action="{{ route('timetable_delete', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-sm btn-danger delete"
                                                                style="font-size:10px; padding:2px 6px;">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif

                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </td>
                            @endfor

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <style>
        .actions {
            opacity: 0;
            visibility: hidden;
            transition: 0.2s ease-in-out;
        }

        td:hover .actions {
            opacity: 1;
            visibility: visible;
        }
    </style>
@endsection
