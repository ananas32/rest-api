@extends('layouts.app')
@section('content')

    <script>
        $('body').on('click', '#save', function (e) {
            e.preventDefault();
            var thisForm = $(this).parent();
            thisForm.find('.invalid-feedback').hide().html('');

            $.ajax({
                url: thisForm.attr('action'),
                type: thisForm.attr('method'),
                dataType: "html",
                data: thisForm.serialize(),
                success: function (response) {
                    response = $.parseJSON(response);

                    if (response.errors) {
                        var key, label, errors = response.errors;
                        for (key in errors) {
                            label = thisForm.find('#' + key).closest('div');
                            label.find('.invalid-feedback').show().html(errors[key]);
                        }
                    } else {
                        alert('save success');
                        window.location.replace("/tasks");
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    </script>

    <div class="container">
        <form action="{{ url($path) }}" class="" method="POST">
            @csrf
            <input type="hidden" name="_method" value="{{ $method }}">
            <div class="form-group">
                <label for="uname">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                       value="{{ isset($task) ? $task->title : '' }}" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <div class="form-group">
                <label for="uname">Description:</label>
                <input type="text" class="form-control" id="description" placeholder="Last name" name="description"
                       value="{{ isset($task) ? $task->description : '' }}" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <div class="form-group">
                <label for="uname">User:</label>
                <select class="browser-default custom-select" name="user_id">
                    @foreach($users as $user)
                        @if($task->user_id)
                            <option selected="selected" value="{{ $user->user_id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                        @else
                            <option value="{{ $user->user_id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <div class="form-group">
                <label for="uname">Status:</label>
                <select class="browser-default custom-select" name="status">
                    <option value="Done">Done</option>
                    <option value="View">View</option>
                    <option value="In Progress">In Progress</option>
                </select>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="save">Submit</button>
        </form>
    </div>
@endsection
