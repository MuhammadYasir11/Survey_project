@extends('admin/layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h1>{{ $survey_title }}</h1> --}}
                            {{-- <h2>Edit Question</h12> --}}
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
            <form action="" method="post" id="editQuestionForm" name="editQuestionForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="type">Question:</label>
                                <input type="text" name="question" id="question" class="form-control"
                                    placeholder="Question" value="{{ $question->question }}">

                            </div>
                            <div class="col-md-4">
                                <label for="type">Question Type:</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">--Select Type--</option>
                                    <option {{ $question->question_type == 'mcq' ? 'selected' : '' }} value="mcq">Multiple Choice</option>
                                    <option {{ $question->question_type == 'text-box' ? 'selected' : '' }} value="text-box">Text Box</option>
                                    <option {{ $question->question_type == 'radio' ? 'selected' : '' }} value="radio">Radio Button</option>
                                    <option {{ $question->question_type == 'customRange' ? 'selected' : '' }} value="customRange">Range Slider</option>

                                </select>

                            </div>

                        </div>
                        <br>
                        <div class="form-group" id="options">
                            <div class="container-fluid my-2">
                                <div class="row mb-2">
                                    {{-- Answer Gen --}}
                                    <div class="col-sm-4">
                                        <div class="editor-bottom">
                                            <div bottom-wrapper>
                                                <div id="answerBankSection" class="answer-bank-toolbar"></div>
                                                <div class="answer-bank-label">
                                                    <span class="smf-icon genius-icon"><strong>õ</strong></span>
                                                    <span class="answer-genius-text"><strong> Answer Genius</strong> </span>
                                                    <span class="answer-bank-help">
                                                        <a class="q " data-help="help-answer-genius">
                                                            <span class="notranslate">?</span>
                                                        </a>
                                                    </span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <label for="scale">scale</label>
                                    <div class="col-sm-2">

                                        <select name="scale" id="scale" class="form-control" disabled>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option> 
                                            <option value="5">5</option>
                                            <option value="7">7</option>
                                        </select>

                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <select name="answerSelect" id="answerSelect" class="form-control" disabled>
                                            <option value="">--select type--</option>
                                            <option value="Agree-Disagree">Agree-Disagree</option>
                                            <option value="Satisfied-Dissatisfied">Satisfied-Dissatisfied</option>
                                            <option value="Yes-No">Yes-No</option>
                                            <option value="Likely-Unlikely">Likely-Unlikely</option>
                                            <option value="Familar-Not Familar">Familar-Not Familar</option>
                                            <option value="Always-Never">Always-Never</option>
                                            <option value="True-False">True-False</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            @foreach ($options as $option)
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <div class="input-group">
                                    <input type="text" name="options[]" id="options" placeholder="Multiple choice"
                                        class="form-control" value="{{ $option->option }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-plus addOption" data-target="#optionsContainer"></i>
                                        </span>
                                        <span class="input-group-text">
                                            <i class="fas fa-minus removeOption" data-target="#optionsContainer"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="form-group" id="radiobutton">
                            <div id="radioContainer">
                                @foreach ($options as $option)
                                <div class="form-check form-group">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault1">
                                    <div class="input-group">
                                        <input type="text" name="radiobtn1" id="radiobtn1" class="form-control"
                                            placeholder="Radio button" value="{{ $option->option }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-plus addOption" data-target="#radioContainer"></i>
                                            </span>
                                            <span class="input-group-text">
                                                <i class="fas fa-minus removeOption" data-target="#radioContainer"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                        <div class="form-group" id="textbox" style="display: none;">
                            <div id="textboxContainer">
                                <input type="text" id="add_text" name="add_text" class="form-control mt-2"
                                    placeholder="Add text" value="{{ $question->answer }}">
                            </div>
                        </div>
                        <div class="form-group" id="customRange" style="display: none;">
                            <div id="rangeContainer">
                                <label for="customRange" class="form-label">Select Range</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" id="min" name="min" class="form-control"
                                            placeholder="Enter Min">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="max" name="max" class="form-control"
                                            placeholder="Enter Max">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" id="mid" name="mid" class="form-control"
                                            placeholder="Enter Mid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pb-4">
                    <button type="submit" class="btn btn-primary text-right">Add Question</button>
                   @foreach ($question as $questions)
                        <input type="hidden" name="survey_id" value="{{ $question->survey_id }}">
                        <input type="hidden" name="user_id" value="{{ $question->user_id }}">
                        <!-- Other code related to displaying questions -->
                    @endforeach

                </div>
               
            </form>
            
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')


<script id="help-answer-genius" type="text/html">
    <h5>ANSWER GENIUS</h5>
    <p>Don't worry about wording your answer choices correctly—just choose the answer type that best matches your question, and we'll fill in expert answer choices for you. If your question asks how difficult something was, choose Easy - Difficult from the dropdown. Then choose whether you want people to rate difficulty on a 2, 3, 4, 5, or 7-point scale.</p>
    <a href="https://help.surveymonkey.com/en/surveymonkey/create/answer-genius" class="learn-more-link wds-button wds-button--sm wds-button--text-link" target="_blank" data-help="help-answer-genius">
        Learn more
    </a>
</script>

<script>
$(document).ready(function() {
// Function to add option dynamically
$('#addOption').click(function() {
    // Clone the first option input group
    var newOption = $('#optionsContainer .form-group:first').clone();

    // Clear the input value in the cloned option
    newOption.find('input[type="text"]').val('');
    // Append the cloned option input group to the options container
    $('#optionsContainer').append(newOption);
});

// Function to remove option dynamically
$(document).on('click', '.removeOption', function() {
    // Remove the parent form group of the clicked remove button
    $(this).closest('.form-group').remove();
});

// Function to handle form submission
$('#editQuestionForm').submit(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Serialize the form data including dynamically added inputs
    var formData = $(this).serialize();

    // Send form data via AJAX
    $.ajax({
        type: 'POST',
        url: '{{ route('question.store') }}',
        data: formData,
        success: function(data) {
            // Handle success response
            console.log("Question Added successfully");
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error("An error occurred:", error);
        }
    });
});
});

</script>

<script>
    $(document).ready(function() {
        $('.addOption').click(function() {
            // Clone the form group containing checkbox and text input
            var newOption = $('#optionsContainer .form-group:first').clone();

            // Clear values of cloned input fields
            newOption.find('input[type="text"]').val('');
            newOption.find('input[type="checkbox"]').prop('checked', false);

            $('#optionsContainer').append(newOption);

            // Append the cloned form group to the container
            $(this).closest('.form-group').after(newOption);
        });
        // Functionality for removing option
        $(document).on('click', '.removeOption', function() {
            if ($('#optionsContainer .form-group').length > 1) {
                $(this).closest('.form-group').remove();
            }
        });
    });
</script>
@endsection

