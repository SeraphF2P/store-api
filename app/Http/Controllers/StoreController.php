<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Products;
use App\Models\Themes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
  // public function __construct()
  // {
  //   return $this->middleware('auth');
  // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      if(!Session::get('admin'))return redirect('/');
        $products = Products::get();
        $user = Auth::user();
        return view('pages.products', compact("products", "user"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      if(!Session::get('admin'))return redirect('/');
        return view("pages.addproduct");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $req)
    {
      if(!Session::get('admin'))return redirect('/');
      $validatedData = $req->validated();
      if ($req->file("image")):
        $name =time(). $req->file("image")->getClientOriginalName();
        $path = $req->file("image")->storeAs("products",$name,'public');
        $product = Products::create([
            "name" => $req["name"],
            "seller_name" => $req["seller_name"],
            "price" => $req["price"],
            "category" => $req["category"],
            "description" => $req["description"],
        ]);
        Themes::create([
            "product_id" => $product->id,
            "color" => $req["color"],
            "image" => $path,
            "in_stock" => $req["in_stock"],
            "seller_name" => $req["seller_name"],
        ]);
      endif;

        return view('pages.dashboard')->with('success', 'product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
      if(!Session::get('admin'))return redirect('/');
        $themes = Themes::where("product_id", $id)->get();

        return view("pages.themes", compact("themes", "id"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
      if(!Session::get('admin'))return redirect('/');
        $product = Products::find($id);
        return view("pages.editproduct", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $req, int $id)
    {
      if(!Session::get('admin'))return redirect('/');
        $product = Products::find($id);
        $product->name = $req->name;
        $product->price = $req->price;
        $product->category = $req->category;
        $product->description = $req->description;
        $product->save();

        $products = Products::get();
        $success = "Product updated successfully.";

        return view("pages.products", compact("products", "success"));
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(int $id)
{
       if(!Session::get('admin'))return redirect('/');

        $themes = Themes::where("product_id", $id)->get();
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
