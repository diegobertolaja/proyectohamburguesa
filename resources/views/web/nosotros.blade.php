@extends('web.plantilla')
@section('contenido')

  <section class="about_section layout_padding nosotros">
  <form action="" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>  
    <div class="container">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="web/images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>Somos Hamburguejas</h2>
            </div>
            <p>Variedad de hamburguesas a base plantas y legumbres, papas fritas y pizzas sin harinas ni sufrimiento animal</p>
            <a href="">
              Lee más
            </a>
          </div>
        </div>
      </div>
    </div>
</form>
  </section>

  <!-- end about section -->

   <!-- client section -->

   <section class="client_section pt-5">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          Qué dicen nuestros clientes
        </h2>
      </div>
      <div class="carousel-wrap row ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
                <h6>
                  Moana Michell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="web/images/client1.jpg" alt="" class="box-img">
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
                <h6>
                  Mike Hamell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="web/images/client2.jpg" alt="" class="box-img">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>
<!-- end client section -->

<section class="book_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container text-center">
        <h2>
          ¡Trabaja con nosotros!
        </h2>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form_container">
            <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
              <div>
                <input type="text" class="form-control" placeholder="Nombre y apellido" name="txtNombre"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Teléfono" name="txtTelefono"/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Mail" name="txtMail"/>
              </div>
              <div>
                <label for="txtMensaje">Mensaje:</label>
                <textarea name="txtMensaje" id="txtMensaje" cols="30" rows="10"></textarea>
              </div>
              <div>
                <label for="archivo" class="d-block">Adjunta tu CV:</label>
                <input type="file" name="archivo" id="archivo">
              </div>
                <div class="btn_box text-center">
                <button type="submit">
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
       </div>
      </div>
    </div>
  </section>

  
  
@endsection

 