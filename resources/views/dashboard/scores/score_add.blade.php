@extends('dashboard.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">add score </h4><br>
            <form class="form-sample" action="{{ route('score_save') }}" method="POST">
                @csrf
                <div class="row">
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
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">student</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="student_id" id="student_select">
                                    <option>chosse student</option>
                                    @foreach ($students as $stu)
                                        <option value="{{ $stu->id }}">{{ $stu->FirstName }} - {{ $stu->LastName }}
                                            &nbsp; &nbsp;({{ $stu->FatherName }})</option>
                                    @endforeach
                                </select>
                                @error('student_id')
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
                                    <option>chosse subject</option>
                                    @foreach ($subjects as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->SubjectName }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">exam year</label>
                            <div class="col-sm-9">
                                <input type="number" name="exam_year" class="form-control" required
                                    placeholder="enter exam year">
                                @error('exam-year')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" style="font-weight:600;">first chance</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="enter first chance" required
                                    name="first_chance">
                                @error('first_chance')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" style="font-weight:600;">second chance</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" placeholder="enter second chance"
                                    name="second_chance">
                                @error('second_chance')
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
        {{-- // برای گفتن شاگرد و مضمون همان صنف --}}
        <script>
            document.getElementById('class_select').addEventListener('change', function() {
                let classId = this.value;

                fetch(`/get-class-data/${classId}`)
                    .then(response => response.json())
                    .then(data => {

                        let studentSelect = document.getElementById('student_select');
                        studentSelect.innerHTML = '<option>chosse student</option>';

                        data.students.forEach(stu => {
                            studentSelect.innerHTML += `
                    <option value="${stu.id}">
                        ${stu.FirstName} - ${stu.LastName} (${stu.FatherName})
                    </option>`;
                        });

                        let subjectSelect = document.getElementById('subject_select');
                        subjectSelect.innerHTML = '<option>chosse subject</option>';

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
