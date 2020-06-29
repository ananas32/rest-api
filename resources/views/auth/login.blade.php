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
                        alert('succes auth');
                        console.log(response.message);
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
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/auth/login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                           required autocomplete="current-password">

                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                </div>
                            </div>

                            {{--                            <div class="form-group row">--}}
                            {{--                                <div class="col-md-6 offset-md-4">--}}
                            {{--                                    <div class="form-check">--}}
                            {{--                                        <input class="form-check-input" type="checkbox" name="remember"--}}
                            {{--                                               id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                            {{--                                        <label class="form-check-label" for="remember">--}}
                            {{--                                            {{ __('Remember Me') }}--}}
                            {{--                                        </label>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="save">
                                        {{ __('Login') }}
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
