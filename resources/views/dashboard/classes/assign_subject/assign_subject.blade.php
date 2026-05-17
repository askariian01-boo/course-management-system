@extends('dashboard.master')
@section('content')
    <div class="card  m-3">
        <div class="card-body">
            <div class="mb-3">
                <h4 class="fw-500 text-primary mb-1">
                    assign subject to class
                </h4>
                <div class="text-muted small">
                    Select and manage subjects for this class
                </div>
            </div>
            <hr>
            <form class="form-sample" action="{{ route('save_assign') }}" style="margin-top: -5px;" method="POST">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}">
                <div class="mb-4 p-3 rounded bg-light border-start border-4 border-primary d-flex align-items-center gap-2">
                    <span class="text-muted">Class Name:</span>
                    <span class="fw-500 text-muted">
                        {{ $class->ClassName }}
                    </span>
                </div>

                <!-- LABEL -->
                <div class="mb-2">
                    <label class="fw-semibold text-dark">
                        Choose subjects
                    </label>
                    <div class="text-muted small">
                        You can select multiple subjects
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 clo-xs-12">
                                <select name="subject_id[]" class="form-control" multiple size="12">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ in_array($subject->id, $class->subjects->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $subject->SubjectName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ClassFees')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info" value="Save">
            </form>
        </div>
    </div>
    </div>
@endsection
