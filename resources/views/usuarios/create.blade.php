@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
    <div class="col-sm-6">
      <h2>Crear nuevo usuario</h2>
        @if($errors->any())
          <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                  </ul>
          </div>
        @endif
    </div>
</div>
<form action="/usuarios" method="POST"lt enctype="multipart/form-data">
@csrf
  <div class="row">
    <div class="form-group col-md-6">
      <label>Nombre</label>
      <input type="text" name="name" class="form-control" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label >Email</label>
      <input type="pemail" name="email" class="form-control" placeholder="Email">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label>Contrasena</label>
      <input type="password" name="password" class="form-control" placeholder="Contrasena">
    </div>
    <div class="form-group col-md-6">
      <label >Confirmas contrasena</label>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme contrasena">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
      <label>Rol</label>
        <select name = "rol" class="form-control">
          <option selected disabled>Elige un rol para este usuario..</option>
          @foreach ($roles as $role)
              <option value="{{$role->id}}">{{$role->name}}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
      <label >Imagen</label>
      <input type="file" name="imagen" class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Registrar</button>
    <button type="reset" class="btn btn-danger">Cancelar</button>
    </div>
  </div>
</form>
</div>
@endsection