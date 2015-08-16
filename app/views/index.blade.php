@extends('templates.web')
@section('content')
Bienvenido!
<form action="{{action('MainController@save')}}" method="post" enctype="multipart/form-data">
    <input type="file" name="archivo" >
    <button type="submit">Enviar</button>
</form>
    @endsection

