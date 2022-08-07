@extends('web.plantilla')
@section('contenido')

  <section class="food_section layout_padding-carrito">
    <div class="container"> 
    <div class="heading_container heading_center">
              <h2>Mi carrito</h2>
            </div>
            @if(isset($msg))
           <div class="alert alert-{{ $msg['estado'] }}" role="alert">
                  {{ $msg["msg"] }}
           </div>
                  @endif      