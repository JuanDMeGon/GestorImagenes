@extends('app')

@section('content')
<div class="container-fluid">
	<form class="form-horizontal" role="form" method="POST" action="/validado/fotos/actualizar-foto" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" required>
		<input type="hidden" name="id" value="{{$foto->id }}" required>
		<div class="form-group required required">
			<label class="col-md-4 control-label">Nombre</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="nombre" value="{{$foto->nombre}}" required>
			</div>
		</div>
		<div class="form-group required">
			<label class="col-md-4 control-label">Descripción</label>
			<div class="col-md-6">
				<textarea type="text" class="form-control" name="descripcion" rows="3" required>{{$foto->descripcion}}</textarea>
				</div>
		</div>
		<div class="form-group required">
			<label class="col-md-4 control-label">Imagen max: 20MB</label>
			<div class="col-md-6">
				<input type="file" class="form-control" name="imagen">
			</div>
		</div>
			<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					Actualizar imagen
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
