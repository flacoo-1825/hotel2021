<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $categories = Category::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $categories = Category::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $categories->total(),
                'current_page' => $categories->currentPage(),
                'per_page'       => $categories->perPage(),
                'last_page'      => $categories->lastPage(),
                'from'              => $categories->firstItem(),
                'to'                  => $categories->lastItem(),
            ],
            'categories' => $categories
        ];
        // $categories = category::get();
        // return $categories;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $category=Category::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $category =  Category::findOrFail($request->id);

            $category->name_category = $request->name_category;
            $category->description_category = $request->description_category;
            $category->condition_category = '1';
            $category->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $category =  Category::findOrFail($request->id);
        $category->condition_category = '1';
        $category->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $category =  Category::findOrFail($request->id);
        $category->condition_category = '0';
        $category->save();
    }



      public function listCategoryActive(Request $request)
    {   
        
       if (!$request->ajax()) return redirect('/');
        
        $category = Category::where('condition_category','=','1')
                        ->select('id','name_category')
                        ->orderBy('id', 'desc')->get();
        return [
            'category' => $category
        ];
    }
}

