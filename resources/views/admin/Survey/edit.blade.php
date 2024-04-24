@extends('admin/layouts.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Survey</h1>
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
                        <form action="" id="EditSurvey" name="Survey" method="post">
                            @csrf
                           
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Survey Title</label>
                                            <input type="text" value="{{ $survey->survey_title }}" class="form-control" name="survey_title" placeholder="Survey Title">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select a Category</option>
                                                @if($categories->isNotEmpty())
                                                @foreach ($categories as $Category)
                                                <option {{ ($Category->id == $survey->category_id) ? 'selected' : '' }} value="{{ $Category->id}}">{{$Category->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                       
                                       
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" id="Submit" class="btn btn-primary">Update</button>
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
                        $("#EditSurvey").submit(function(event){
                            event.preventDefault();
                            var element = $(this);

                            $("button[type=submit]").prop('disabled',true);

                            $.ajax({
                                url: '{{ route("Survey.update",$survey->id) }}',
                                type: 'put',
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