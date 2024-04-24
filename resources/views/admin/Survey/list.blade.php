@extends('admin/layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Survey List</h1>
                </div>
                <div class="col-sm-4 text-right">

                </div>
                <div class="col-sm-4 text-right">
                    <a href="{{ route('admin.Survey.create') }}" class="btn btn-primary">New Survey</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">

        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route('admin.Survey.list') }}'"
                                class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap" id="surveylist">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Survey Title</th>
                                <th>Category Name</th>
                                <th>Modified Date</th>
                                <th>Updated Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($survey->isNotEmpty())
                                @foreach ($survey as $Survey)
                                    <tr>
                                        <td>{{ $Survey->id }}</td>
                                        <td>

                                            <a href="{{ route('admin.Question.create', ['survey' => $Survey]) }}">
                                                {{ $Survey->survey_title }}
                                            </a>
                                        </td>

                                        <td>{{ $Survey->category->name }}</td>
                                        <td>{{ $Survey->created_at }}</td>
                                        <td>{{ $Survey->updated_at }}</td>

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.Survey.edit', $Survey->id) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.
								w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#" onclick="deleteSurvey({{ $Survey->id }})"
                                                class="text-danger w-4 h-4 mr-1">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
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
                <!-- Add a date input field -->



                <div class="card-footer clearfix">
                    {{ $survey->links() }}

                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $document.ready(function() {
            table = new DataTable('#surveylist');
        })
    </script>
@endsection
