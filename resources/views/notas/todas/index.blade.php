@extends('layouts.app')
@section('content')
@include('notas.todas.modal')
<div class="d-flex flex-wrap justify-content-around">


@foreach($notas as $nota)
@include('notas.todas.modal_delete')
<div class="card border-primary mb-3" style="max-width: 18rem;">
@csrf
  <div class="card-header"><b>{{$nota->titulo}}</b>
  <p class="small float-right ml-2">{{$nota->created_at}}</p>
  </div>
  <div class="card-body text-primary"> 
    <p class="card-text">{{$nota->texto}}</p>
  </div>
  <div class="card-footer">
  <a href="{{URL::action([App\Http\Controllers\NotasController::class, 'edit'], $nota->id)}}">  
      <button type="submit" class="btn btn-info btn-sm float-right ">
    <i class="fas fa-edit"></i> 
  </button>
    </a>
    <button type="button" class="btn btn-danger btn-sm float-right mr-1" data-toggle="modal" data-target="#modalEliminar-{{$nota->id}}">
      <i class="far fa-trash-alt"></i>
      </button>
  </div>
</div>
@endforeach 
</div>
@endsection