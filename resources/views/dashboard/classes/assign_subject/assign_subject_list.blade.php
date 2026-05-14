@extends('dashboard.master')
@section('content')

    <div class="card  mt-4 ml-3 mr-3">
        <div class="card-style">
            <h4>subjects of {{ $class->ClassName }} class
                @if (Auth::user()->can('assign_subject_class'))
                    <a href="{{ route('assign_subject', $class->id) }}" class="btn btn-sm btn-info float-right">Add New
                        subjects</a>
                @endif
            </h4><br>
            @if ($subjects->isEmpty())
                <p>No subjects assigned to this class yet.</p>
            @else
                <div class="table-bordered table-responsive table-striped table-hover">
                    <table class="table table-striped table-hover table-bordered tableD" id="myTable">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Class Name</th> <!-- اضافه شد -->
                                <th>Subject Name</th>
                                <th>Author</th>
                                @if (Auth::user()->can('subject_class_delete'))
                                    <th>Delete</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $class->ClassName }}</td> <!-- نام صنف در هر ردیف -->
                                    <td>{{ $subject->SubjectName }}</td>
                                    <td>{{ $subject->Author ?? 'N/A' }}</td>
                                    @if (Auth::user()->can('subject_class_delete'))
                                        <td class="min-width">
                                            <form action="{{ route('class_subject_delete', $subject->id) }}"
                                                style="display: inline;" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete"> <i
                                                        class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
