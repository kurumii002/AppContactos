@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{url('/contacto/'.$contacto->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    @include('contacto.form', ['modo'=>'Editar'])
    </form>
</div>
@endsection

    