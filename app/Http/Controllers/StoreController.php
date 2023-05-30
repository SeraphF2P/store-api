<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Products;
use App\Models\Themes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::with('themes')->get();
        return view('pages.products.index', compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $sellers=User::where('role','seller')->select('name','id')->get();
        return view("pages.products.add",compact('sellers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $req)
    {
   $req->validated();
      if ($req->file("image")):

        $name =time(). $req->file("image")->getClientOriginalName();
        $path = $req->file("image")->storeAs("products",$name,'public');
        /**  @var \App\Models\User $seller */
        $seller = User::find($req->seller_id);

        $product = Products::create([
            "name" => $req["name"],
            "seller_name" => $seller->name,
            "users_id" => $req->seller_id,
            "price" => $req["price"],
            "category" => $req["category"],
            "description" => $req["description"],
            "rating" => $req["rating"],
        ]);
         /**  @var \App\Models\Products $product */
       $product->themes()->create([
            "products_id" => $product->id,
            "color" => $req["color"],
            "image" =>  $path,
            "in_stock" => $req["in_stock"],
            "seller_name" => $seller->name,
       ]);
       
      endif;

        return redirect('/store')->with('success', 'product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $themes = Themes::where("products_id", $id)->get();

        return view("pages.themes.index", compact("themes", "id"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Products::find($id);
        return view("pages.products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $req, int $id)
    {
        $product = Products::find($id);
        $product->name = $req->name;
        $product->price = $req->price;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->save();

        $products = Products::get();
        $success = "Product updated successfully.";

        return view("pages.products.index", compact("products", "success"));
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(int $id)
{


        $themes = Themes::where("products_id", $id)->get();
        foreach ($themes as $theme) {
        if(file_exists('assets/' . $theme ->image)){
            File::unlink('assets/' . $theme ->image);
        }
            $theme->delete();
        }
        
      
        Products::find($id)->delete();
        return redirect('/store')->with("success", "Product deleted successfully!");
   
}
}
