<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('/img/logo.png')}}">

    <title>{{config('app.name')}} | {{config('app.schoolAlias')}} - Examiner Login</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <style>
        html,
        body {
        height: 100%;
        }

        /* body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        } */

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
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
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

        ul .nav-link:hover {
            border-bottom: solid #e67d23 2px
        }

        ul>.nav-item>.active {
            border-bottom: solid #e67d23 2px
        }

        ul .nav-link {
            padding: 8px;
            margin-left: 12px;
        }
    </style>
  </head>

  <body class="text-center">
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
        <a href="{{route('dashboard')}}">
            <img src="{{asset('/img/logo.png')}}" class="mr-2" height="45" width="45">
        </a>
        <a class="navbar-brand" href="{{route('dashboard')}}">
            {{config('app.name')}} | {{config('app.schoolAlias')}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mx-auto col-md-1 mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
        </div>
    </nav>

    <form class="form-signin mt-5" autocomplete="off" action="{{route('admin-login')}}" method="post">

      <h1 class="h3 mb-3 font-weight-normal mt-5">Examiner Login</h1>

      <hr>

        @csrf

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>{{$error}}</strong><button type="button" class="close" data-dismiss='alert' aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endforeach
        @endif

        <label for="username">Username:</label>
        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required><br>
        <input class="btn btn-lg loginBtn btn-block" type="submit" value="Login">
        <p class="mt-5 mb-3 text-muted">&copy; {{date('Y')}}</p>
    </form>
  </body>
</html>

