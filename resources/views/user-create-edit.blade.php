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
                        window.location.replace("/users");
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
                <label for="uname">Username:</label>
                <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name" value="{{ isset($user) ? $user->first_name : '' }}" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <div class="form-group">
                <label for="uname">Last name:</label>
                <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name" value="{{ isset($user) ? $user->last_name : '' }}" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <div class="form-group">
                <label for="uname">Email:</label>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ isset($user) ? $user->email : ''}}" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback" style="display:none;"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="save">Submit</button>
        </form>
    </div>
@endsection
