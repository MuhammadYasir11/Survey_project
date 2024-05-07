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
                    <form id="surveyForm" action="{{ route('response.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="survey_id" id="survey_id" value="{{ $survey->id }}">
                        <h5 class="card-title">Questions:</h5>
                        <ul class="list-group">
                            @foreach ($survey->questions as $question)
                                <li class="list-group-item"><strong class="question">Q:{{ $question->question }}</strong></li>
                                @if ($question->question_type == 'text-box')
                                    <li class="list-group-item">
                                        <input type="text" name="text_response[{{ $question->id }}]" class="form-control">
                                        <input type="hidden" name="question_id" id="question_id" value="{{ $question->id }}">
                                        <input type="hidden" name="option_id" id="option_id" value="">
                                    </li>
                                @else
                                    <ul>
                                        @foreach ($question->options as $option)
                                        <li class="list-group-item">
                                            @if ($question->question_type == 'mcq')
                                                <input type="checkbox" name="option_id[{{ $question->id }}][]" id="option_id_{{ $question->id }}_{{ $option->id }}" value="{{ $option->id }}" class="mr-2 form-check-input">{{ $option->option }}
                                            @elseif ($question->question_type == 'radio')
                                                <input type="radio" name="option_id[{{ $question->id }}][]" id="option_id_{{ $question->id }}_{{ $option->id }}" value="{{ $option->id }}" class="mr-2 form-check-input">{{ $option->option }}
                                            @endif
                                            <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                        </li>
                                    @endforeach
                                    
                                    </ul>
                                @endif
                            @endforeach
                        </ul>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- JavaScript to update hidden input fields dynamically -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('surveyForm');
            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            const radios = form.querySelectorAll('input[type="radio"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateHiddenInputFields(this);
                });
            });
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    updateHiddenInputFields(this);
                });
            });

            function updateHiddenInputFields(input) {
    const hiddenQuestionIds = form.querySelectorAll('input[name="question_id"]');
    hiddenQuestionIds.forEach(hiddenQuestionId => {
        if (hiddenQuestionId.value === '') {
            const parentListItem = input.closest('.list-group-item');
            const questionIdInput = parentListItem.querySelector('input[name="question_id"]');
            if (questionIdInput) {
                hiddenQuestionId.value = questionIdInput.value;
            }
        }
    });
}


        });
    </script>

<script>
    $("#surveyForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);

        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);

                if (response.hasOwnProperty('errors')) {
                    $.each(response.errors, function(field, errorMessage) {
                        $("#" + field).addClass('is-invalid').siblings('p')
                            .addClass('invalid-feedback').html(errorMessage);
                    });
                } else {
                    // Handle success
                    console.log("Response submitted successfully!");
                    window.location.href = "{{ route('admin.home.list') }}";
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something Went Wrong");
            }
        });
    });
</script>

</body>

</html>
