@extends('web.plantilla')
@section('contenido')

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container offset-sm-3">
      <div class="heading_container">
        <h2 class="pb-4">
          Registrarse
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-container">
            <form action="" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div>
                <input id="txtNombre" name="txtNombre" type="text" class="form-control" placeholder="Nombre"/>
              </div>
              <div>
                <input id="txtApellido" name="txtApellido" type="text" class="form-control" placeholder="Apellido"/>
              </div>  
              <div>
                <input id="txtDni" name="txtDni" type="text" class="form-control" placeholder="Dni" />
              </div>
              <div>
                <input id="txtMail" name="txtMail" type="email" class="form-control" placeholder="Mail"/>
              </div>
              <div>
                <input id="txtTelefono" name="txtTelefono" type="telefono" class="form-control" placeholder="Telefono"/>
              </div>
              <div>
                <input id="txtClave" name="txtClave" type="password" class="form-control" placeholder="Password"/>
              </div>
              <div class="btn_box">
                  <button type="submit" id="btnRegistrarse" name="btnRegistrarse" href="/mi-cuenta">Registrarse</button>
            </div>   
            <div class="mt-4">
              <a href="/nuevo-registro">Registrarme</a>    
            </div> 
             </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.2306547292624!2d-58.622603479994076!3d-34.64887741399911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcc7616a26a103%3A0xfb254c4c872ccd15!2sMcDonald&#39;s!5e0!3m2!1ses!2sar!4v1659189460566!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
 <!-- end book section -->

@endsection
