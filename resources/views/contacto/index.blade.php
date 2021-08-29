@extends('layouts.app')
@section('content')
<div class="container">

    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        

    <div class="container">
        <div class="row">
            <div class="col text-center">
            <a href="{{url('contacto/create')}}" class="btn btn-success"><i class="fas fa-user-plus"></i> Registrar contacto</a>
            </div>
        </div>
    </div>

    
    <br/>
    <table class="table" >
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($contactos as $contacto)
            <tr>
                <td>{{$contacto->id}}</td>
                <td><img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$contacto->Foto}}" width="100"></td>
                <td>{{$contacto->Nombre}}</td>
                <td>{{$contacto->Apellido}}</td>
                <td>{{$contacto->Correo}}</td>
                <td>{{$contacto->Telefono}}</td>
                <td>
                    <a href="{{url('/contacto/'.$contacto->id.'/edit')}}" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
                     
                    <form action="{{url('/contacto/'.$contacto->id)}}" class="d-inline" method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!$contactos->links()!!}
</div>
@endsection