@extends('admin/layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Create Category</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('admin.Category.list') }}" class="btn btn-primary">View List</a>
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
            <form action="" method="post" id="categoryForm" name="categoryForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" autocomplete="true">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Category Title</label>
                                    <select name="title" id="title" class="form-control">
                                        <option value="0">--Select Category--</option>
                                        <option value="Customer Feedback">Customer Feedback</option>
                                        <option value="Employee Feedback">Employee Feedback</option>
                                        <option value="Application Feedback">Application Feedback</option>
                                        <option value="Quize">Quize</option>
                                        <option value="Student Feedback">Student Feedback</option>
                                        <option value="Parents Feedback">Parents Feedback</option>
                                        <option value="Teacher Feedback">Teacher Feedback</option>


                                    </select>
                                    <p></p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="#" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $("#categoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);

            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route('categories.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {

                    $("button[type=submit]").prop('disabled', false);

                    if (response["status"] == true) {

                        console.log("Redirect URL:", "{{ route('admin.Category.list') }}");
                        window.location.href = "{{ route('admin.Category.list') }}";

                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                        $("#title").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    } else {

                        var errors = response['errors'];
                        if (errors['name']) {

                            $("#name").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['name']);
                        } else {

                            $("#name").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }

                        if (errors['title']) {

                            $("#title").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['title']);
                        } else {

                            $("#title").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }

                },
                error: function(jqXHR, exception) {
                    console.log("Something Went Wrong");
                }

            });
        });
    </script>
@endsection
