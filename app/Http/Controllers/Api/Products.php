<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products as ModelsProducts;
use App\Models\Themes;
use Illuminate\Http\Request;

class Products extends Controller
{
  public function categorys(){
    return response()->json(
      ['shoes', 
      'accessories', 
      'electronics', 
      'jewelrys', 
      "men's clothing",
      "women's clothing"]);
  }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $limit = $request->query('limit', 20);
      $search = $request->query('search');
      $category = $request->query('category');
      
    $data = ModelsProducts::query()->with('themes')
        ->limit($limit);
      if($category){
        $data = $data->where("category",$category);
      }
      if ($search ) {
        $products = $data->where("name", "LIKE", "%$search%")->get();
        return response()->json($products);
    }

      $products =$data->get();
    
     
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $products_id,int $theme_id = null)
    {
      
      $product = ModelsProducts::find($products_id);
      if(isset($theme_id,$product)){
        $theme = Themes::where('id', $theme_id)
        ->where('products_id',$products_id)
        ->first();
        if($theme)
        {
          $product['color'] =$theme['color'];
          $product['in_stock'] =$theme['in_stock'];
          $product['image'] =$theme['image'];
          $product['seller_name'] =$theme['seller_name'];
          $product['created_at'] =$theme['created_at'];
          $product['theme_id'] =$theme['id'];
        
        return response()->json($product);
        }
      }else{
        /** @var \app\Models\Products $product */
       $product=  $product->with('themes')->find($products_id);
        return response()->json($product);
      }

    return response()->json(['msg'=>'product not found'],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
