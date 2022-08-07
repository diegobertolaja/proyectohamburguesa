@extends('web.plantilla')
@section('contenido')

  <section class="food_section layout_padding-carrito">
    <div class="container"> 
    <div class="heading_container heading_center">
              <h2>Mi carrito</h2>
            </div>
            @if(isset($msg))
           <div class="alert alert-{{ $msg['estado'] }}" role="alert">{{ $msg['mensaje'] }}</div>
                  {{ $msg["msg"] }}</div>
                  @endif
                  <div class="row">
        <div class="col-12 my-5 ">   
            <table class="table table-hover border">
                  <thead>
                        <tr>
                              <th class="lead">Imagen</th>
                              <th class="lead">Producto</th>
                              <th class="lead">Precio</th>
                              <th class="lead">Cantidad</th>
                              <th class="lead">Total</th>
                              <th></th>
                        </tr>
                  </thead>
       <tbody>
            <?php $total = 0 ?>
            @foreach($aCarrito_productos as $item)
            <?php $subtotal=$item->precioproducto * $item->cantidad; ?>
            <tr>
                  <td><img src="/files/{{ $item->imagenproducto }}" alt="" width="100"></td>   
                  <td>{{ $item->nombreproducto }}</td>     
                  <td>${{ $item->number_format(precioproducto, 2, ",", ".") }}</td>  
                  <td>{{ $item->cantidad }}</td>  
                  <td>{{ $item->number_format($subtotal, 2, ",", ".") }}</td> 
                  <td><i class="fa-solid fa-bnad"></i></td>    
            </tr>
            <?php $total+=$subtotal; ?>
            @endforeach

       </tbody>           
            </table>    
      <div class="float-right lead">
            <h4>TOTAL: ${{$total}}</h4> 
            </div>
       <div class="col-12">
                  <label for="">Sucursal donde retirar el pedido</label>
                    <select name="lstSucursal" id="lstSucursal">  
                  @foreach($aSucursales as $sucursal)
                  <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>  
                  @endforeach
                  </select>  
            </div>
            <div class="col-12">
                  <label for="">Selecciona el medio de pago</label>
                  <select name="lstMedioDePago" id="lstMedioDePago">
                        <option value="mercadopago">Mercadopago</option>
                        <option value="pagoensucursal">Pago en sucursal</option>
             </select>
           </div>  
           <div>
               <a href="/takeaway" class="lead">Agregar más productos</a> 
            </div>
            <div>
               <button type="submit" class="float-right btn btn-primary lead"></button>
            </div>

             </div>  
      </div>                    
</section>