@extends('dashboard.master')
@section('content')
    <div class="card m-3 shadow-sm border-0">
        <div class="card-body">

            <!-- TITLE -->
            <div class="mb-3">
                <h4 class="fw-500 text-primary mb-1">
                    assign teachers to subject
                </h4>
                <div class="text-muted small">
                    Select and manage teachers for this subject
                </div>
            </div>

            <hr>

            <form action="{{ route('save_assign_teacher') }}" method="POST">
                @csrf

                <input type="hidden" name="subject_id" value="{{ $subject->id }}">

                <!-- SUBJECT NAME -->
                <div class="mb-4 p-3 rounded bg-light border-start border-4 border-primary d-flex align-items-center gap-2">
                    <span class="text-muted">Subject Name:</span>
                    <span class="fw-bold text-dark">
                        {{ $subject->SubjectName }}
                    </span>
                </div>

                <!-- LABEL -->
                <div class="mb-2">
                    <label class="fw-semibold text-dark">
                        Choose Teachers
                    </label>
                    <div class="text-muted small">
                        You can select multiple teachers
                    </div>
                </div>

                <!-- SELECT -->
                <div class="mb-3">
                    <select name="teacher_id[]" class="form-control shadow-sm" multiple size="12">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ in_array($teacher->id, $subject->teachers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $teacher->FirstName }} {{ $teacher->LastName }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  --- ( {{ $teacher->EducationDegree }} ) --- 
                            </option>
                        @endforeach
                    </select>

                    @error('teacher_id')
                        <div class="text-danger mt-2 small">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary btn-sm px-4">
                    Save
                </button>
                <a href="{{ route('subject_detail' , $subject->id) }}" class="btn btn-secondary btn-sm px-4"><i class="arrow-left"></i>
                    Cancel
                </a>

            </form>

        </div>
    </div>
@endsection
