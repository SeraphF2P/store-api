<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Psy\Output\Theme;

class ThemeController extends Controller
{
    public function addtheme(int $product_id)
    {
      if(!Session::get('admin'))return redirect('/');
       
        return view('pages.addtheme',compact("product_id"));
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      if(!Session::get('admin'))return redirect('/');
        $themes = Themes::get();
        return view("pages.themes", compact("themes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     if(!Session::get('admin'))return redirect('/');
        return view("pages.addtheme");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
       if(!Session::get('admin'))return redirect('/');
 if ($req->file("image")){
        $name =time(). $req->file("image")->getClientOriginalName();
        $path = $req->file("image")->storeAs("products",$name,'public');
        Themes::create([
            "product_id" => $req->product_id,
            "color" => $req->color,
            "image" => $path,
            "in_stock" => $req->in_stock,
            "seller_name"=>$req->seller_name,

        ]);
        $product_id = $req->product_id;
        return redirect("themes/".$product_id);
 };
 return back()->with('error','upload failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
      if(!Session::get('admin'))return redirect('/');
       $product =Products::find($id);
        $themes = Themes::where("product_id", $product["id"])->get();
        $product_id=$id;
        $seller_name=$product->seller_name;
        return view("pages.themes", compact("themes", "product_id","seller_name"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      if(!Session::get('admin'))return redirect('/'); 
            $theme = Themes::find($id);
            return view("pages.edittheme", compact("theme"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {
      if(!Session::get('admin'))return redirect('/');
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
            // }
        }
        $theme->save();
        return redirect('/themes/' . $theme->product_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      if(!Session::get('admin'))return redirect('/');
      /** @var \App\Models\Themes $theme */
        $theme = Themes::find($id);
        $product_id = $theme->product_id;

        $themes = Themes::where('product_id', $product_id);

        if ($themes->count() == 1) {
            Products::find($theme->product_id)->delete();
            return redirect()->route("store.index");
        };
        if(file_exists('assets/' . $theme ->image)){
            File::unlink('assets/' . $theme ->image);
        }
          $theme->delete();
        return redirect()->route("themes.show", $product_id);
    }

}
