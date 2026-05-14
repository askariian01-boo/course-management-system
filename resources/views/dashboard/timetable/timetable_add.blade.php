@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">add timetable </h4><br>
            <form class="form-sample" action="{{ route('timetable_save') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">weekday</label>
                            <div class="col-sm-9">
                                <select name="weekday" id="" class="form-control form-select">
                                    <option value="1">saturday</option>
                                    <option value="2">sunday</option>
                                    <option value="3">monday</option>
                                    <option value="4">tuesday</option>
                                    <option value="5">wednesday</option>
                                    <option value="6">thursday</option>
                                </select>
                                @error('weekday')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">period</label>
                            <div class="col-sm-9">
                                <select name="period" id="" class="form-control form-select">
                                    <option value="1">period 1</option>
                                    <option value="2">period 2</option>
                                    <option value="3">period 3</option>
                                    <option value="4">period 4</option>
                                </select>
                                @error('period')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">class</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="class_id" id="class_select">
                                    <option>chosse class</option>
                                    @foreach ($class as $cla)
                                        <option value="{{ $cla->id }}">{{ $cla->ClassName }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">subject</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="subject_id" id="subject_select">
                                    <option value="">chosse subject</option>
                                </select>
                                @error('subject_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">teachers</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="teacher_id" id="subject_select">
                                    <option>chosse teachers</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->FirstName }} -
                                            {{ $teacher->LastName }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info" value="Save">
            </form>
        </div>
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {

                $('#class_select').on('change', function() {
                    let class_id = $(this).val();

                    if (class_id) {
                        $.ajax({
                            url: '/get-subjects/' + class_id,
                            type: 'GET',
                            dataType: 'json',

                            success: function(data) {

                                $('#subject_select').empty();
                                $('#subject_select').append(
                                    '<option value="">choose subject</option>');

                                $.each(data, function(key, value) {
                                    $('#subject_select').append(
                                        '<option value="' + value.id + '">' + value
                                        .SubjectName + '</option>'
                                    );
                                });
                            },

                            error: function() {
                                alert('');
                            }
                        });

                    } else {
                        $('#subject_select').empty();
                        $('#subject_select').append('<option value="">choose subject</option>');
                    }
                });

            });
        </script>
    @endsection
