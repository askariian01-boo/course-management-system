@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">add timetable </h4><br>
            <form class="form-sample" action="{{ route('timetable_update', $timetables->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">weekday</label>
                            <div class="col-sm-9">
                                <select name="weekday" class="form-control form-select">
                                    <option value="1" {{ $timetables->weekday == 1 ? 'selected' : '' }}>saturday
                                    </option>
                                    <option value="2" {{ $timetables->weekday == 2 ? 'selected' : '' }}>sunday</option>
                                    <option value="3" {{ $timetables->weekday == 3 ? 'selected' : '' }}>monday</option>
                                    <option value="4" {{ $timetables->weekday == 4 ? 'selected' : '' }}>tuesday
                                    </option>
                                    <option value="5" {{ $timetables->weekday == 5 ? 'selected' : '' }}>wednesday
                                    </option>
                                    <option value="6" {{ $timetables->weekday == 6 ? 'selected' : '' }}>thursday
                                    </option>
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
                                    <option value="1" {{ $timetables->period == 1 ? 'selected' : '' }}>period 1
                                    </option>
                                    <option value="2" {{ $timetables->period == 2 ? 'selected' : '' }}>period 2
                                    </option>
                                    <option value="3" {{ $timetables->period == 3 ? 'selected' : '' }}>period 3
                                    </option>
                                    <option value="4" {{ $timetables->period == 4 ? 'selected' : '' }}>period 4
                                    </option>
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
                                <select name="class_id" class="form-control form-select" id="class_select">
                                    <option value="">choose class</option>

                                    @foreach ($class as $cla)
                                        <option value="{{ $cla->id }}"
                                            {{ $timetables->class_id == $cla->id ? 'selected' : '' }}>
                                            {{ $cla->ClassName }}
                                        </option>
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
                                <select name="teacher_id" class="form-control form-select" id="teacher_select">
                                    <option value="">choose teacher</option>

                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ $timetables->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->FirstName }} - {{ $teacher->LastName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-info btn-sm" value="Save">
                <a href="{{ route('timetable_list') }}" class="btn btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>back</a>
            </form>
        </div>
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {

                let selectedSubject = "{{ $timetables->subject_id }}";

                function loadSubjects(class_id) {

                    if (class_id) {
                        $.ajax({
                            url: '/get-subjects/' + class_id,
                            type: 'GET',
                            dataType: 'json',

                            success: function(data) {

                                $('#subject_select').empty();
                                $('#subject_select').append('<option value="">choose subject</option>');

                                $.each(data, function(key, value) {

                                    let selected = (value.id == selectedSubject) ? "selected" : "";

                                    $('#subject_select').append(
                                        '<option value="' + value.id + '" ' + selected + '>' +
                                        value.SubjectName +
                                        '</option>'
                                    );
                                });
                            },

                            error: function(xhr) {
                                console.log(xhr.responseText);
                                alert('error in loading subjects');
                            }
                        });

                    } else {
                        $('#subject_select').empty();
                        $('#subject_select').append('<option value="">choose subject</option>');
                    }
                }

                // وقتی صفحه edit لود می‌شود
                let class_id = $('#class_select').val();
                if (class_id) {
                    loadSubjects(class_id);
                }

                // وقتی class تغییر کند
                $('#class_select').on('change', function() {
                    selectedSubject = ""; // reset selected وقتی class تغییر کند
                    loadSubjects($(this).val());
                });

            });
        </script>
    @endsection
