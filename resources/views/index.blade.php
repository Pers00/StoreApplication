@extends('base')

 @section('content')
      <div class="contenedor">
            <h1>Products Store</h1>
            <div class="botonEnter" >
                <a href="{{ url('store/') }}">Enter in the products table</a>
            </div>
        </div>
        <div class="containerImg">
            <img src="{{ url('assets/images/Dibujo-tienda-navegacion-facetada-investifacion-min.png') }}" alt="">
        </div>        
 @endsection
 