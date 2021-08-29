<h1>{{$modo}} contacto</h1><hr></br>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    
@endif


<div class="form-row">
    <div class="col-md-6 mb-3">
        <input type="text" class="form-control" placeholder="Nombres" name="Nombre" value="{{isset($contacto->Nombre)?$contacto->Nombre:old('Nombre')}}" id="Nombre">
    </div>
    <div class="col-md-6 mb-3">
        <input type="text" class="form-control" placeholder="Apellidos" name="Apellido" value="{{isset($contacto->Apellido)?$contacto->Apellido:old('Apellido')}}" id="Apellido">
    </div>
</div>

<div class="form-row">
    <div class="col-md-6 mb-3">
        <input type="email" class="form-control" placeholder="Correo" name="Correo" value="{{isset($contacto->Correo)?$contacto->Correo:old('Correo')}}" id="Correo">
    </div>
    <div class="col-md-3 mb-3">
        <input type="number" class="form-control" placeholder="Teléfono" name="Telefono" value="{{isset($contacto->Telefono)?$contacto->Telefono:old('Telefono')}}" id="Telefono">
    </div>

    <div class="col-md-3 mb-3">
        @if(isset($contacto->Foto))
            <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$contacto->Foto}}" width="100"> 
        @endif
        
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="Foto">
            <label class="custom-file-label" data-browse="Elegir archivo" >Foto</label>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col text-center">
            @if($modo=='Editar')
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-user-edit"></i> {{$modo}} contacto
                </button>
            @endif
            @if($modo=='Crear')
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> {{$modo}} contacto
                </button>
            @endif
            <a class="btn btn-primary" href="{{url('contacto/')}}"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
        </div>
    </div>
</div>




<br>