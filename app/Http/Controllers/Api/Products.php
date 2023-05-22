<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products as ModelsProducts;
use App\Models\Themes;
use Illuminate\Http\Request;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,string $category = null)
    {
      $limit = $request->query('limit', 20);
      if(isset($category) ){
        $data = ModelsProducts::query()->limit($limit)->where("category",$category)->get();
      }else{
        $data =ModelsProducts::query()->limit($limit)->get();
      }
      $products =[];
      foreach($data as $p){
          /** @var \App\Models\Products $p */
        $themes = Themes::where('product_id', $p->id)->get();
        foreach($themes as $t){
          $p['color'] =$t['color'];
          $p['in_stock'] =$t['in_stock'];
          $p['product_image_url'] =$t['product_image_url'];
          $p['seller_name'] =$t['seller_name'];
          $p['created_at'] =$t['created_at'];
          $p['theme_id'] =$t['id'];
          array_push($products, $p);
        }
       }
       
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
    public function show(int $product_id,int $theme_id = null)
    {
      $product = ModelsProducts::find($product_id);
      if(isset($theme_id,$product)){
        $theme = Themes::where('id', $theme_id)
        ->where('product_id',$product_id)
        ->first();
        if(isset($theme))
        {
          $product['color'] =$theme['color'];
          $product['in_stock'] =$theme['in_stock'];
          $product['product_image_url'] =$theme['product_image_url'];
          $product['seller_name'] =$theme['seller_name'];
          $product['created_at'] =$theme['created_at'];
          $product['theme_id'] =$theme['id'];
        return response()->json($product);
        }
      }else{
        $themes = Themes::where('product_id',$product_id)
        ->get();
        $product['themes']= $themes;
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
