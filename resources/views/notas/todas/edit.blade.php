@extends('layouts.app')

@section('content')
{!!Form::open(['action' => ['App\Http\Controllers\NotasController@update', $notas->id], 'method'=>'PATCH'])!!}
{{Form::token()}}
<div class="card text-center mx-auto" style="width: 250px;">
  <div class="card-header">
    <input type="text" name="titulo" class="form-control"  value="{{$notas->titulo}}">
  </div>
  <div class="card-body">
    <textarea name="texto" class="form-control" id="" cols="30" rows="6">{{$notas->texto}} </textarea>
  <div class="card-footer text-muted small">
    {{$notas->update_at}}
    <a href="{{URL::action([App\Http\Controllers\NotasController::class, 'edit'], $notas->id)}}">  
      <button type="submit" class="btn btn-info btn-sm float-right">
      <i class="fas fa-save"></i>
      </button>
    </a>

    <a href="{{URL::action([App\Http\Controllers\NotasController::class, 'index'])}}">  
      <button type="button" class="btn btn-danger btn-sm float-right mr-1">
      <i class="far fa-window-close"></i>
      </button>
    </a>
  </div>
</div>
{!! Form::close() !!}
@endsection