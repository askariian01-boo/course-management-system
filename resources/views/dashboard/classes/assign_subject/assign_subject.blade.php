@extends('dashboard.master')
@section('content')
        <div class="card  m-3">
            <div class="card-body">
                <h4 class="card-title">Assign Subjects To Class </h4>
                <form class="form-sample" action="{{ route('save_assign') }}" style="margin-top: -5px;" method="POST">
                    @csrf
                    <input type="hidden" name="class_id" value="{{ $class->id }}">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="font-weight:600;" style="margin-bottom: -20px;">Choose Subjects</label>
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
