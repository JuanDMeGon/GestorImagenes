@extends('app')

@section('content')

@if(Session::has('editada'))
	<div class="alert alert-success">
	<p>La foto fue editada</p>
</div>
@endif
<div class="container-fluid">
<p><a href="/validado/fotos/crear-foto?id={{$id}}" class="btn btn-primary" role="button">Crear Foto</a></p>
@if(sizeof($fotos) > 0)
	@foreach($fotos as $foto)
		<div class="row">
		  <div class="col-sm-6 col-md-12">
		    <div class="thumbnail">
		    	<img src="{{$foto->ruta}}">
		      <div class="caption">
		        <h3>{{$foto->nombre}}</h3>
		        <p>{{$foto->descripcion}}</p>
		      </div>
		      <p><a href="/validado/fotos/actualizar-foto/{{$foto->id}}" class="btn btn-primary" role="button">Editar Foto</a></p>
		    </div>
		  </div>
		</div>
	@endforeach
@else
<div class="alert alert-danger">
	<p>Al parecer este album no tiene fotos. Crea una.</p>
</div>
@endif
</div>
@endsection
