<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Themes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Psy\Output\Theme;

class ThemeController extends Controller
{
    public function addtheme(int $products_id)
    {
      /** @var \app\Models\Products */
       $seller_name=Products::query()->find($products_id)->first()->seller_name;
        return view('pages.themes.add',compact("products_id",'seller_name'));
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $themes = Themes::get();
        return view("pages.themes,index", compact("themes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.themes.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {

 if ($req->file("image")){
       $products_id = $req['products_id'];
        $name =time(). $req->file("image")->getClientOriginalName();
        $path = $req->file("image")->storeAs("products",$name,'public');
        /** @var \app\Models\Products $product */
        $product = Products::find($products_id);
         $product->themes()->create(
[
            "products_id" => $products_id,
            "color" => $req->color,
            "image" => $path,
            "in_stock" => $req->in_stock,
            "seller_name"=>$req->seller_name,
            "rating"=>$req->rating,

        ]
);
        
        return redirect("themes/".$products_id);
 };
 return back()->with('error','upload failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $products_id)
    {
      /** @var \App\Models\Products $product */
     $product =Products::with('themes')->find($products_id);
        $themes = $product->themes()->get();
        $seller_name=$product->seller_name;
        return view("pages.themes.index", compact("themes", "products_id",'seller_name'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { 
            $theme = Themes::find($id);
            return view("pages.themes.edit", compact("theme"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
        $theme = Themes::find($id);
        $theme->color = $req->color;
        $theme->image = $req->image;
        $theme->in_stock = $req->in_stock;
        //  if(file_exists('assets/' . $theme ->image) && $theme ->image !=  $req->image){
            // File::unlink('assets/' . $theme ->image);
            if ($req->file("image")){
              $name =time(). $req->file("image")->getClientOriginalName();
              $path = $req->file("image")->storeAs("products",$name,'public');
              $theme->image = $path;
              $theme->rating = $req ->rating;
            // }
        }
        $theme->save();
        return redirect('/themes/' . $theme->products_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      /** @var \App\Models\Themes $theme */
        $theme = Themes::find($id);
        $products_id = $theme->products_id;

        $themes = Themes::where('products_id', $products_id);

        if ($themes->count() == 1) {
            Products::find($theme->products_id)->delete();
            return redirect()->route("store.index");
        };
        if(file_exists('assets/' . $theme ->image)){
            File::unlink('assets/' . $theme ->image);
        }
          $theme->delete();
        return redirect()->route("themes.show", $products_id);
    }

}
