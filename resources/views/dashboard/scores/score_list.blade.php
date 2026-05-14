@extends('dashboard.master')
@section('content')
    <div class="card p-4 bg-white rounded-3 mt-3 ml-3 mr-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">score List</h4>

        </div>
        <form method="GET" action="" class="row g-2 mb-3">

            <!-- صنف -->
            <div class="col-12 col-md-3">
                <select name="class_id" class="form-select" id="class_select">
                    <option value="">select class</option>
                    @foreach ($class as $cla)
                        <option value="{{ $cla->id }}" {{ request('class_id') == $cla->id ? 'selected' : '' }}>
                            {{ $cla->ClassName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- مضمون -->
            <div class="col-12 col-md-3">
                <select name="subject_id" class="form-select" id="subject_select">
                    <option value="">select subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->SubjectName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- سال -->
            <div class="col-12 col-md-2">
                <select name="year" class="form-select">
                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <!-- دکمه -->
            <div class="col-12 col-md-4 d-flex gap-2">

                <!-- Filter Button -->
                <button type="submit" class="btn btn-success flex-fill"
                    style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                    <i class="fa fa-filter"></i> Filter
                </button>

                <!-- Add score -->
                @if (Auth::user()->can('score_add'))
                    <a href="{{ route('score_add') }}" class="btn btn-sm btn-primary"
                        style="padding-top: 0.65rem; padding-bottom: 0.6rem; font-weight: 600;">
                        <i class="fa fa-add"></i> add score
                    </a>
                @endif
            </div>

        </form>

        {{-- جدول فیس  --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped table-hover align-middle tableD" id="myTable">
                <thead class="table-light thead-light">
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">students</th>
                        <th class="text-center">subjects</th>
                        <th class="text-center">first_chance</th>
                        <th class="text-center">second_chance</th>
                        <th class="text-center">result</th>
                        @if (Auth::user()->can('score_edit'))
                            <th class="text-center">edit</th>
                        @endif
                        @if (Auth::user()->can('score_delete'))
                            <th class="text-center">delete</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($scores as $score)
                        <tr>
                            <td class="text-center">
                                <p>
                                    {{ $score->id }}

                                </p>
                            </td>
                            <td class="text-center">
                                <p>{{ $score->student->FirstName }}-{{ $score->student->LastName }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $score->subject->SubjectName }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $score->first_chance }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $score->second_chance }}</p>
                            </td>
                            <td class="text-center">
                                @if (!is_null($score->second_chance))
                                    @if ($score->second_chance >= 60)
                                        <span class="text-success fw-bold">success</span>
                                    @else
                                        <span class="text-danger fw-bold">faild</span>
                                    @endif
                                @else
                                    @if ($score->first_chance >= 60)
                                        <span class="text-success fw-bold">success</span>
                                    @else
                                        <span class="text-danger fw-bold">faild</span>
                                    @endif
                                @endif
                            </td>
                            @if (Auth::user()->can('score_edit'))
                                <td class="text-center">
                                    <a href="{{ route('score_edit', $score->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                </td>
                            @endif
                            @if (Auth::user()->can('score_delete'))
                                <td class="text-center">
                                    <p>
                                    <form action="{{ route('score_delete', $score->id) }}" method="POST" class="d-inline">
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
@section('scripts')
    {{-- // برای گفتن شاگرد و مضمون همان صنف --}}
    <script>
        document.getElementById('class_select').addEventListener('change', function() {
            let classId = this.value;

            let subjectSelect = document.getElementById('subject_select');

            // reset
            subjectSelect.innerHTML = '<option value="">select subject</option>';

            if (classId === "") return;

            fetch(`/get-class-data/${classId}`)
                .then(response => response.json())
                .then(data => {

                    data.subjects.forEach(sub => {
                        subjectSelect.innerHTML += `
                        <option value="${sub.id}">
                            ${sub.SubjectName}
                        </option>
                    `;
                    });

                });
        });
    </script>
@endsection
