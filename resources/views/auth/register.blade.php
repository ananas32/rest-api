@extends('layouts.app')

@section('content')
    <script>
        $('body').on('click', '#save', function (e) {
            e.preventDefault();
            var thisForm = $(this).closest('form');
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
                        alert('succes register');
                        window.location.replace("/login");
                    }
                },
                error: function (response) {
                    if (response.message) {
                        alert(response.message);
                    }
                }
            });
        });
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('auth/signup') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           value="" required autocomplete="first_name" autofocus>

                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="" required autocomplete="last_name" autofocus>

                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control" name="email"
                                           value="" required autocomplete="email">

                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control" name="password"
                                           required autocomplete="new-password">

                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="save">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
