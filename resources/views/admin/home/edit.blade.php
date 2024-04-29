@extends('admin/layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Survey</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.home.update', ['id' => $survey->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="survey_title">Survey Title</label>
                                <input id="survey_title" type="text" class="form-control" name="survey_title" value="{{ old('survey_title', $survey->survey_title) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" class="form-control" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $survey->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description" rows="3" required>{{ old('description', $survey->description) }}</textarea>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">Update Survey</button>
                                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
