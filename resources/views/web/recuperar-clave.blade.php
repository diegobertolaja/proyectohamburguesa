@extends('web.plantilla')
@section('contenido')

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4">
          Recuperar clave
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div>
              <input id="txtMail" name="txtMail" type="email" class="form-control" placeholder="Mail"/>
              </div>
             <div class="btn_box">
                  <button type="submit" id="btnEnviar" name="btnEnviar" href="">Enviar</button>
            </div>   
            </div>
            </form>
          
  </section>
 <!-- end book section -->

@endsection
