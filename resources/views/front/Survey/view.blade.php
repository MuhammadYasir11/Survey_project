<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Student Surveys</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background: #fff;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .list-group-item {
            border: none;
            border-top: 1px solid #ddd;
            padding: 10px 0;
            font-size: 16px;
            color: #333;
        }

        .question {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($surveys as $survey)
            <div class="card">
                <div class="card-header">{{ $survey->survey_title }}</div>
                <div class="card-body">
                    <h5 class="card-title">Questions:</h5>
                    <ul class="list-group">
                        @foreach ($survey->questions as $question)
                            <li class="list-group-item"><strong class="question">Q:{{ $question->question }}</strong></li>
                            @if ($question->question_type == 'text-box')
                                <li class="list-group-item">
                                    <input type="text" value="{{ $question->answer }}" class="form-control">
                                </li>
                            @else
                                <ul>
                                    @foreach ($question->options as $option)
                                        <li class="list-group-item">
                                            @if ($question->question_type == 'mcq')
                                                <input type="checkbox" class="mr-2 form-check-input">{{ $option->option }}
                                            @elseif ($question->question_type == 'radio')
                                                <input type="radio" class="mr-2 form-check-input">{{ $option->option }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
