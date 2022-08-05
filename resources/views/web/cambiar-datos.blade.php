@extends('web.plantilla')
@section('contenido')

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4 text-white">
          Cambiar datos
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method="POST">
                  @if(isset($msg))
           <div class="alert alert-{{ $msg['estado'] }}" role="alert">
                  {{ $msg["msg"] }}
           </div>
                  @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input> 
            <div>
                <input id="txtNombre" name="txtNombre" type="text" class="form-control" placeholder="Nombre"/>
              </div>
              <div>
                <input id="txtApellido" name="txtApellido" type="text" class="form-control" placeholder="Apellido"/>
              </div>
              <div>
                <input id="txtDni" name="txtDni" type="text" class="form-control" placeholder="Dni"/>
              </div>
              <div>
                <input id="txtMail" name="txtMail" type="mail" class="form-control" placeholder="Mail"/>
              </div>   
            <input id="txtClave" name="txtClave" type="clave" class="form-control" placeholder="Clave"/>
              </div>
             <div class="btn_box">
                  <button type="submit" id="btnEnviar" name="btnEnviar" href="">Enviar</button>
            </div>   
            </div>
            </form>
          
  </section>
 <!-- end book section -->

@endsection
