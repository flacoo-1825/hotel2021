<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Storage;

class ProductController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $products = Product::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $products = Product::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $products->total(),
                'current_page' => $products->currentPage(),
                'per_page'       => $products->perPage(),
                'last_page'      => $products->lastPage(),
                'from'              => $products->firstItem(),
                'to'                  => $products->lastItem(),
            ],
            'products' => $products
        ];
        // $products = Room::get();
        // return $products;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');

            $exploded = explode(',', $request->img_product);
            $decoded = base64_decode($exploded[1]);
            $fileName = $request->nombre_img;
            $path = public_path('img/products').'/'.$fileName;
            file_put_contents($path, $decoded);

            $product =  new Product();
            $product->name_product = $request->name_product;
            $product->stock_product = $request->stock_product;
            $product->buy_product = $request->buy_product;
            $product->sale_product = $request->sale_product;
            $product->start_product = $request->start_product;
            $product->category_id = $request->category_id;
            $product->provider_id = $request->provider_id;
            $product->img_product   = $fileName;
            $product->condition_product = '1';
            $product->save();

    }

    

    public function update(Request $request)
    {		
       		
       	if (!$request->ajax()) return redirect('/');

        $content = $request->nombre_img;
        $imagen_old = $request->imagen_old;
        $content_img = $request->nombre_img;
        if($content == null){
            $content_img = $request->img_product;
        }else{
            if($content != $imagen_old){
                $exploded = explode(',', $request->img_product);
                $decoded = base64_decode($exploded[1]);
                $fileName = $request->nombre_img;
                $path = public_path('img/products').'/'.$fileName;
                file_put_contents($path, $decoded);
                $content_img = $fileName;
                $imagen_old = $request->imagen_old;
                $path = public_path('img').'/'.$imagen_old;

                if (@getimagesize($path)) {
                    unlink($path);
                };  
            };
            
        };
        $product =  Product::findOrFail($request->id);
        $product->name_product = $request->name_product;
        $product->stock_product = $request->stock_product;
        $product->buy_product = $request->buy_product;
        $product->sale_product = $request->sale_product;
        $product->start_product = $request->start_product;
        $product->category_id = $request->category_id;
        $product->provider_id = $request->provider_id;
        $product->img_product   = $content_img;
        $product->condition_product = '1';
        $product->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $product =  Product::findOrFail($request->id);
        $product->condition_product = '1';
        $product->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $product =  Product::findOrFail($request->id);
        $product->condition_product = '0';
        $product->save();
    }


      public function listProductActive(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');
        //  $search = $request->search;
        //  $valor = $request->valor;
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search=='') {
            $product = [];
            return [
               
            'products' => $product
        ];
        }else{
            $product = Product::where('condition_product','=','1')
            ->where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(18);
            return [
                    'pagination'      => [
                    'total'              => $product->total(),
                    'current_page' => $product->currentPage(),
                    'per_page'       => $product->perPage(),
                    'last_page'      => $product->lastPage(),
                    'from'              => $product->firstItem(),
                    'to'                  => $product->lastItem(),
                ],
                'products' => $product
            ];
        }
       
  
    }


    public function listProductProvider(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');
        //  $search = $request->search;
        //  $valor = $request->valor;
        $provider_id = $request->provider_id;
        $search = $request->search;
        $valor = $request->valor;
         
        if ($search=='') {
            $product = [];
            return [
               
            'products' => $product
        ];
        }else{
            $product = Product::where('condition_product','=','1')
            ->where('provider_id','=',$provider_id)
            ->where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(8);
            return [
                    'pagination'      => [
                    'total'              => $product->total(),
                    'current_page' => $product->currentPage(),
                    'per_page'       => $product->perPage(),
                    'last_page'      => $product->lastPage(),
                    'from'              => $product->firstItem(),
                    'to'                  => $product->lastItem(),
                ],
                'products' => $product
            ];
        }
       
  
    }
}

