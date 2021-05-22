<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/img/logo.png')}}">

    <title>{{config('app.name')}} | {{config('app.schoolAlias')}} - Student Login</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <style>
        html,
        body {
        height: 100%;
        }

        body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        }

        .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        }
        .form-signin .checkbox {
        font-weight: 400;
        }
        .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="text"] {
        margin-bottom: -1px;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }

        .loginBtn:hover {
            color: black;
            border: solid #e67d23 1.5px;
            background-color: transparent
        }

        .loginBtn {
            background-color: #e67d23;
            color: black;

        }
    </style>
  </head>

  <body class="text-center">
    <form class="form-signin" autocomplete="off" method="POST" action="{{ route('login') }}">

            <h1>Student Login</h1>
            @csrf

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$error}}</strong><button type="button" class="close" data-dismiss='alert' aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @endforeach
            @endif

            <label for="lastname" class="mt-3">{{ __('Surname') }}</label>
            <input id="lastname" type="text" class="form-control" name="lastname" required>

            <label for="firstname" class="mt-3">{{ __('First Name') }}</label>
            <input id="firstname" type="text" class="form-control" name="firstname" required>

            <label for="code" class="mt-3">{{ __('Examination Number') }}</label>
            <input id="code" type="text" class="form-control" name="code" required>

            <div >
                <button type="submit" class="btn loginBtn btn-block mt-4">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0">

                        </div>
                    </form>
  </body>
</html>
