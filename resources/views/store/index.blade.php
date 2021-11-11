@extends ('base') 
  @section('content')
    <!-- Delete solo un producto ventana modal-->
    <div class="modal" id="modalDelete" tabindex="-1">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h3 class="modal-title">Confirm delete</h3>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
    				<p>Are you sure you want to delete "<span id="deleteProduct"> </span>" that has #id:<span id="deleteProductId"> </span>?</p>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    				<form id="modalDeleteResourceForm" action="" method="post">
    					@method('delete') @csrf
    					<input type="submit" class="btn btn-primary cursor" value="Delete product" />
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- fin delete products -->
    
    <!-- Delete todos los productos ventana modal-->
    <div class="modal" id="modalDelete1" tabindex="-1">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h3 class="modal-title">Confirm delete all products</h3>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
    				<p>Are you sure you want to delete all saved products?</p>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    				<form id="modalDeleteResourceForm1" action="" method="post">
    					@method('delete') @csrf
    					<input type="submit" class="btn btn-primary cursor" value="Delete all products" />
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- delete all products fin -->
    
    <div class="limiter">
    	<div class="contenedor1">
    		<h1>Products Store</h1>
    	</div>
    	<div class="container-table1000">
    		@isset ($message)
    		<div class="contenedorAlerta">
    			<div class="alert alert-{{ $type ?? 'success' }}" role="alert">
    
    				{{ $message }}
    			</div>
    		</div>
    		@endisset
    		<div class="wrap-table100">
    			<div class="botonBack">
    				<button class="botonEnter13" type="button"><a href="{{ url('') }}">Back to home</a></button>
    			</div>
    			<div class="table100 ver1">
    				<div class="wrap-table100-nextcols js-pscroll">
    					<div class="table100-nextcols">
    						<table>
    							<thead>
    								<tr class="row100 head">
    									<th class="cell100 column2">#Id</th>
    									<th class="cell100 column3">Name</th>
    									<th class="cell100 column4">Price</th>
    									<th class="cell100 column5">Show</th>
    									<th class="cell100 column6">Edit</th>
    									<th class="cell100 column7">Delete</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach ($resources as $resource)
    								<tr class="row100 body">
    									<td class="cell100 column2 color"> #{{ $resource['id'] }}</td>
    									<td class="cell100 column3"> {{ $resource['name'] }}</td>
    									<td class="cell100 column4"> {{ $resource['price'] }}€</td>
    									<td class="cell100 column5"><a href="{{ url('store/'. $resource['id'] ) }}">Show</a></td>
    									<td class="cell100 column6"><a href="{{ url('store/'. $resource['id']. '/edit') }}">Edit</a> </td>
    									<td class="cell100 column7"><a href="javascript: void(0);"data-name="{{ $resource['name'] }}" data-id="{{ $resource['id'] }}" data-url="{{ url('store/' . $resource['id']) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</a></td>
    								</tr>
    								@endforeach
    							</tbody>
    						</table>
    					</div>
    				</div>
    			</div>
    			<div class="contenedorBotones">
    				<button class="botonEnter1" type="button"><a href="{{ url('store/create' ) }}">Add new product</a></button>
    				<!--<button class="botonEnter12" type="button"><a href="{{ url('store/flush/all' ) }}">Delete all products</a></button> -->
    				@isset ($resource)
    				<button class="botonEnter12" type="button"><a href="javascript: void(0);" data-url="{{ url('store/flush/all' ) }}" data-bs-toggle="modal" data-bs-target="#modalDelete1">Delete all products</a><button></button> @endisset
    			</div>
    		</div>
    	</div>
    </div>
  @endsection 
  
  @section('js')
  <!-- conectarJs delete modal-->
  <script defer src="{{ url('assets/js/delete.js') }}"></script>
  <!-- fin delete.js -->
  @endsection