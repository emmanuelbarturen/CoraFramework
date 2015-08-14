<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Administrador</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,900,300,700,300italic,400' rel='stylesheet'
          type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body style="padding-top: 70px">
<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                <h2>Login</h2>
            </div>
            <div class="panel panel-body">
                @if(has_msg('msg'))
                    <div class="alert alert-danger">{{get_msg('msg')}} </div>
               @endif
                <form action="{{action('MainController@validate_auth') }}" method="POST">
                    <div class="form-group">
                        <label for="username" class="label label-primary">Usuario</label>
                        <input type="text" class="form-control" placeholder="Ingrese usuario" name="username"
                               id="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="label label-primary">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group"><input type="submit" class="btn btn-primary" value="Logearse"></div>
                </form>
            </div>
        </div>
    </div>
    <hr>
</div>
<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>