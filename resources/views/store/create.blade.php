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
               <!-- Al mandarlo con post y no con get, la url resource te lleva al .store -->
                <form class="formCreate" action="{{ url('store') }}" method="post">
                    <!-- token de seguridad -->
                    @csrf
                    <!-- funcion old (coge el valor anterior)  -->
                    <span>The product id is generated automatically</span> 
                    <input class="inputCreate" value="{{ old('name') }}" type="text" name="name" placeholder="Product name" minlength="3" maxlength="25" required/>
                    <input class="inputCreate" value="{{ old('price') }}" type="number" name="price" placeholder="Product price" min="0" step="0.01" required/>
                    <input class="buttonCreate" type="submit" value="Create"/>
                </form>
		    </div>
    	</div>
    </div>
@endsection
		
	
