@extends('web.plantilla')
@section('contenido')

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">

      <div class="card border-light mb-3 col-6">
            <div class="card-body">
                  <h2 class="card-tittle">{{ $cliente->nombre . " " . $cliente->apellido }}</h2>
                        <p class="card-text">Teléfono: {{ $cliente->telefono }}</p>
                        <p class="card-text">Mail: {{ $cliente->mail }}</p>
            </div>
      </div>

      <div class="form_container">
        <div class="btn_box">
            <a href="/cambiar-datos">Cambiar datos</a>
            <div class="btn_box">
            <a href="/cambiar-clave">Cambiar clave</a>

        </div>
        </div>