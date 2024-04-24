@extends('admin/layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Survey</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('admin.home.list') }}" class="btn btn-primary">View List</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
                        <form action="" id="Survey" name="Survey" method="post">
                            @csrf
                           
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Survey Title</label>
                                            <input type="text" id="survey_title" class="form-control" name="survey_title" placeholder="Survey Title">
                                        <p></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if($category->isNotEmpty())
                                            @foreach ($category as $categories)
                                            <option value="{{ $categories->id}}">{{$categories->title}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                        </div>
                                       
                                       
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" id="Submit" class="btn btn-primary">Submit Survey</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            
                            
                        </form>
                    </div>

				</section>
				<!-- /.content -->

                @endsection
            
               

                @section('customJs')

<script>
    $.ajax({
        type: "POST",
        url: '{{ route("Survey.store") }}', // Replace with your actual store route
        data: {
            survey_title: "{{ isset($survey) ? $survey->survey : '' }}",
            category_id: "{{ isset($survey) ? $survey->category_id : '' }}"
        },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                $surveyTitle = response.survey.survey_title;
                // Display survey title in the div
                $(".mb-3").text($surveyTitle);
                dd($surveyTitle);
            } else {
                // Handle errors if any
                console.log("Error:", response.errors);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
</script>


             <script>
                $("#Survey").submit(function(event){
                    event.preventDefault();
                    var element = $(this);

                    $("button[type=submit]").prop('disabled',true);

                    $.ajax({
                        url: '{{ route("Survey.store") }}',
                        type: 'post',
                        data: element.serializeArray(),
                        dataType: 'json',
                        success: function(response){

                            $("button[type=submit]").prop('disabled',false);

                            if (response["status"] == true){
                                
                                console.log("Redirect URL:", "{{ route('admin.home.list') }}");
                                    window.location.href = "{{ route('admin.home.list') }}";
                            
                                $("#survey_title").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");

                                $("#category_id").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");

                            } else{

                                var errors = response['errors'];
                            if (errors['survey_title']) {

                                $("#survey_title").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['survey_title']);
                            } else{

                                $("#survey_title").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                            }

                            if (errors['category_id']) {

                                $("#category_id").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['category_id']);
                            } else{

                                $("#category_id").removeClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                            }
                            }
                            
                            }, error: function(jqXHR, exception){
                            console.log("Something Went Wrong");
                        }
                            
                    });
                });

    </script>
                    
                @endsection