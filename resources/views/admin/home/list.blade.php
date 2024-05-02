@extends('admin/layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Home</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('admin.Survey.create') }}" class="btn btn-primary">Create Survey</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card" style="width: 100%; margin-right: 2%">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="surveylist">
                        <thead>
                            <tr>
                                <th width="60">Status</th>
                                <th>Survey Title</th>
                                <th>Modified Date</th>
                                <th>Edit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($surveys->isNotEmpty())
                                @foreach ($surveys as $survey)
                                    <tr>
                                        <td>Draft</td>
                                        <td>
                                            <a href="{{ route('admin.home.Surveydashboard', ['id' => $survey->id]) }}">{{ $survey->survey_title }}</a>

                                               
                                        </td>
                                        <td>{{ $survey->created_at }}</td>
                                        <td>
                                            <button type="submit"
                                                onclick="window.location.href='{{ route('admin.Survey.edit', ['id' => $survey->id]) }}'"
                                                class="btn btn-outline-secondary">
                                                Edit Survey
                                            </button>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="modal" data-target="#publishModal">
                                            Publish
                                        </button>


                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Student</a>
                                                    <a class="dropdown-item" href="#">Teacher</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"> Record Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>




        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('#surveylist').DataTable();
        })
    </script>

    <script>
        $(document).ready(function() {
            // Handle dropdown toggle on click of the icon
            $('.dropdown-toggle').on('click', function(e) {
                $(this).next('.dropdown-menu').toggle();
            });

            // Close dropdown when clicked outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                }
            });
        });
    </script>

<script>
    // JavaScript to handle the confirmation and publishing
    document.getElementById('confirmPublish').addEventListener('click', function () {
        alert('Survey published successfully!');
        window.location.href = "{{ route('student.page') }}";
    });
</script>
@endsection
