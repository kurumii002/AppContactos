@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/contacto') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('contacto.form', ['modo'=>'Crear'])
    </form>
</div>
@endsection