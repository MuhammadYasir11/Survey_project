@extends('admin/layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ $surveyTitle }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-secondary mr-2"
                        onclick="window.location.href='{{ route('admin.Question.create', ['survey' => $id]) }}'">Edit
                        Design</button>
                    <button type="button" class="btn btn-secondary mr-2">Add More Questions</button>
                    <button type="button" class="btn btn-info"
                        onclick="window.location.href='{{ route('admin.Survey.edit', ['id' => $id]) }}'">Edit
                        Survey</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="inner">
                                <h3>0</h3>
                                <p>TOTAL RESPONSES</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer text-dark">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="inner">
                                <h3>Draft</h3>
                                <p>OVERALL SURVEY STATUS</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.home.list') }}" class="small-box-footer text-dark">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($questions as $question)
                                <div class="mb-4">
                                    <strong>Q{{ $loop->iteration }}: {{ $question->question }}</strong>
                                    <div class="float-right">
                                        <a href="{{ route('admin.home.edit', ['id' => $question->id]) }}" class="mr-2"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                    @if ($question->question_type === 'mcq')
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach ($options->where('question_id', $question->id) as $option)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="option{{ $option->id }}" name="options[]"
                                                                    value="{{ $option->id }}">
                                                                <label class="form-check-label option-label option-font"
                                                                    for="option{{ $option->id }}">{{ $option->option }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($question->question_type === 'text-box')
                                        @php
                                            $answer = $question->where('id', $question->id)->first();
                                        @endphp
                                        <input type="text" class="form-control" name="textbox_question_{{ $question->id }}"
                                            value="{{ $answer ? $answer->answer : '' }}" readonly>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customerCss')
    <style>
        .option-font {
            font-family: 'National2', sans-serif;
        }
    </style>
@endsection

@section('customerJs')
    <script>
        console.log("Hello");
    </script>
@endsection
