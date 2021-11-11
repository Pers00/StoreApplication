@extends ('base') 
    @section('content')
    <div class="limiter">
    	<div class="contenedor1">
    		<h1>Products Store</h1>
    	</div>
    	<div class="container-table1000">
    		<div class="wrap-table100">
    			<div class="botonBack">
    				<button class="botonEnter13" type="button"><a href="{{ url('store') }}">Back to products table</a></button>
    			</div>
    			<form class="formCreate" action="" method="post">
    				<span>Viewing product...</span>
    				<span><black>#ID:</black> {{ $resource['id'] }}</span>
    				<span><black>NAME:</black> {{ $resource['name'] }}</span>
    				<span><black>PRICE:</black> {{ $resource['price'] }}</span>
    				<hr>
    			</form>
    		</div>
    	</div>
    </div>
    @endsection