@extends('templates.admin')
@section('titulo')
    Configuracion
@endsection
@section('area')
    Cambiar Password
@endsection
@section('content')
    <div style="height: 50px"></div>
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                Cambiar Password
            </div>
            <div class="panel panel-body">
                @if(has_msg('msg'))
                    <div style="color: red">{{get_msg('msg')}}</div>
                @endif
                <form action="{{action('AdminController@update_password')}}" method="POST">
                    <div class="form-group">
                        <label for="password1" >Nuevo Password</label>
                        <input type="password" class="form-control"  name="p1" id="password1" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirmar Password</label>
                        <input type="password" class="form-control" name="p2" id="password2" required>
                    </div>
                    <div class="form-group"><input type="submit" class="btn btn-primary" value="Cambiar Password"></div>
                </form>
            </div>
        </div>
    </div>
@endsection