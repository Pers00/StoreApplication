<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index(Request $request)
    {
        // Crear un array vacio
        $resources=[];
        
        // si existe resoruces ( array con ese nombre)
        if($request->session()->exists('resources')){
            // coge el array que tenemos en nuestra sesión
            $resources = $request->session()->get('resources');
        }
        $data = [];
        $data['resources'] = $resources;
         
        if($request->session()->exists('message')){
            $data['message'] =  $request-> session()->get('message');
            
             if($request->session()->exists('type')){
                 $data['type']= $request->session()->get('type');
             }
        } 
        return view('store.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {   
        
        $id=1;
        $name = $request ->input('name');
        $price = $request ->input('price');
  
        $resources=[];
       
        //si existe recursos, haré una cosa,  [estamos utilizando sessión , pero tal vez lo mejor es bbdd]
        if($request->session()->exists('resources')){
            
        // coge el array que tenemos en nuestra sesión
          $resources = $request->session()->get('resources');
          $idMaxima = 0;  
            foreach($resources as $resource) {
                 if($resource['id']>$idMaxima){
                     $idMaxima=$resource['id'];
                 }

            }
            $id= $idMaxima+1;
        }
        
        // array de recursos, meter en el array (acordarse que es un array dinamico), (los hemos declarado)
        $resource = ['id' => $id, 'name'=> $name, 'price'=>$price];
        
        // si hay algun valor en esa posicion en ese array
        if(isset($resources[$id])){
               // funcion que te retorna a la misma pagina ( vuelve, y te manda los valores)
               return back()->withInput(); 
        } else {
               $resources[$id] = $resource;
        }
    
        // meter ese array en tu sesion (meter este array global)
        $request->session()->put('resources', $resources);
             
        return redirect('store')->with('message', 'The product has been inserted correctly!'); // es lo mismo que resource ¿ que hace el redirect)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        if($request->session()->exists('resources') && isset($request-> session()->get('resources')[$id])){
            
            // te esta cogiendo de la posicion $id todo el array en resource
            $resource = $request->session()->get('resources')[$id];
            
            // declaramos el array previamente para quitarnos errores
            $data=[];
            $data['resource'] = $resource;
               
            return view('store.show', $data);
        }     
        
        // redirigir la respuesta hacia otra pagina ( es solo), no se ejecuta todo el codigo de arriba si le das a  F5 
        // si no que solo se ejecuta el index con la misma peticion
        return redirect ('store');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
         // 1º Comprobar que existe el dato de la sesion
         // si existe resources y esta ocupada la posicion id de resources [puede que no este en nuestra vista pero lo puede poner directamente esta ruta
         if($request->session()->exists('resources') && isset($request-> session()->get('resources')[$id])){
            
             // te esta cogiendo de la posicion $id todo el array en resource
             $resource = $request->session()->get('resources')[$id];
             
             // Otra manera de hacerlo
              $data=[];
              $data['resource'] = $resource;
         
              return view('store.edit', $data);     
         }else{
            // enseñar error 404 cuando te pone la ruta directamente y está mal
             return abort(404);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
           // si exxiste la array de recursos
        if ( $request->session()->exists('resources')){
              
              // obtenemos los valores del array de recursos
            $resources = $request->session()->get('resources');
            
            if(isset($resources[$id])){
                
                $resource = $resources[$id];
                
                // Elimina la posicion del array, y se reajusta el array
                ;
                $nameInput=$request->input('name');
                $priceInput=$request->input('price');
                
                // si no has editado nada, vuelve de nuevo
                if($nameInput==$resource['name'] &&  $priceInput==$resource['price']){
                 //   return redirect('store')->with('message', 'You have not applied any changes to the product!');
                     return back()->withInput();
                }
                
                $resource['id']=$id;
                $resource['name']=$nameInput;
                $resource['price']=$priceInput;
              
                $resources[$id]=$resource;    
        
                // meter ese array en tu sesion 
                $request->session()->put('resources', $resources);
        
                 return redirect('store')->with('message', 'The product has been edited successfully!'); // es lo mismo que resource ¿ que hace el redirect)
            }
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $message = 'The product has not been properly erased!';
        $type="danger";
        if($request->session()->exists('resources')){
            $resources = $request->session()->get('resources');
            if(isset($resources[$id])) {
                unset($resources[$id]);
                $request->session()->put('resources', $resources);
                $message = 'Product has been successfully deleted!';
                $type="success";
            }
        }
        $data=[];
        $data['message'] = $message;
        $data['type']=$type;
        
        return redirect('store')->with($data);
    }
    
    function flush(Request $request){ // 
         
         // Borrar los datos de la sesion
        $request->session()->flush();    
        return redirect('store')->with('message', 'You have successfully deleted all products!');

     }
}
