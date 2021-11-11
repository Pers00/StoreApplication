@extends ('base') 
  @section('content')
    <div class="limiter">
    	<div class="contenedor1">
    		<h1>Products Store</h1>
    	</div>
    	<div class="container-table1000">
    		@if (old('name')==$resource['name'] && old('price')==$resource['price'])
    		<div class="contenedorAlerta">
    			<div class="alert alert-{{ $type ?? 'success' }}" role="alert">
    				You have not applied any changes to the product!
    			</div>
    		</div>
    		@endif
    		<div class="wrap-table100">
    			<div class="botonBack">
    				<button class="botonEnter13" type="button"><a href="{{ url('store') }}">Back to products table</a></button>
    			</div>
    			<!-- Al mandarlo con post y no con get, la url resource te lleva al .store -->
    			<form class="formCreate" action="{{ url('store/' . $resource['id']) }}" method="post">
    				<!-- token de seguridad -->
    				@csrf @method('put')
    				<span>You are editing the selected product</span>
    				<span><black>#ID: {{ $resource['id'] }}</black></span>
    				<input class="inputCreate" value="{{ old('name',$resource['name']) }}" type="text" name="name" placeholder="Product name" minlength="3" maxlength="25" required/>
    				<input class="inputCreate" value="{{ old('price',$resource['price']) }}" type="number" name="price" placeholder="Product price" min="0" step="0.01" required/>
    				<input class="buttonCreate" type="submit" value="Edit" />
    			</form>
    		</div>
    	</div>
    </div>
  @endsection