@extends('dashboard.master')
@section('content')
<div class="card mt-3 ml-3 mr-3">
            <div class="card-style">
                <h3>students of {{$class->ClassName}} class
                </h3><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover tableD"  id="myTable">
                        <thead class="thead-light">
                            <tr>
                                <th> photo </th>
                                <th> full name </th>
                                <th> father name </th>
                                <th> nic cart </th>
                                <th> phone </th>
                                <th> reg date </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="py-1"><img src="/images/students/{{ $student->Image }}"></td>
                                    <td><p class="min-width" style="margin-top:-15px;">{{ $student->FirstName }} {{ $student->LastName }}</p></td>
                                    <td><p class="min-width" style="margin-top:-15px;">{{ $student->FatherName }}</p></td>
                                    <td><p class="min-width" style="margin-top:-15px;">{{ $student->NIC }}</p></td>
                                    <td><p class="min-width" style="margin-top:-15px;">{{ $student->Phone }}</p></td>
                                    <td><p class="min-width" style="margin-top:-15px;">{{ $student->RegDate }}</p></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
