@extends('admin/layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">	
					
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-12">
								<div class="card" style="margin: 0px">
                                    <div class="card-body">
                                        <h1>{{ $surveyTitle }}</h1>
                                    </div>
                                </div>
							
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
                    <div class="container-fluid">
                        <div class="card-header" style="margin: 0px">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-secondary">Add more question??</button>
									<button type="button" class="btn btn-info" onclick="window.location.href='{{ route('admin.Survey.edit', ['id' => $id]) }}'">Edit Survey</button>

                                </div>
                            </div>
                        </div>
                        
                    </div>
					<!-- Default box -->
					<div class="container-fluid" style="margin-top: 10px">
						<div class="row">
							<div class="col-lg-6 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>0</h3>
										<p>TOTAL RSPONSES</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							
							<div class="col-lg-6 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>Draft</h3>
										<p>OVERALL SURVEY STATUS</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a href="{{ route('admin.home.list') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
                        </div>
					</div>					
					<!-- /.card -->
				</section>
				<!-- /.content -->

                @endsection
                @section('customerJs')
                    <script>
                        console.log("Hellow");
                    </script>
                @endsection