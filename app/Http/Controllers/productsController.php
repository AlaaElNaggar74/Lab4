<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\category;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;


class productsController extends Controller
{   

    function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth')->only(['store']);
        // $this->middleware('CheckName')->only(['store']);
        $this->middleware('CheckName')->only(['form_input','store']);

    }


    function products(){
      
        // dump(Auth::user());
        // dump(Auth::id());
        $products=products::latest()->paginate(3);
        return view("products",compact("products"));
    }

    function get_product_details($id){
      
        $productID=products::find($id);
        return view("product_details",["productID"=>$productID]);
    }

    function form_input(){
       $cats=category::all();
        return view("formInput",["categories"=>$cats]);
    }
  
    function store(){

        \request()->validate([
            'name' => 'required|min:3',
            'image' => 'required|unique:products',
        ],[
            "name.required"=>"The name Is Required",
            "name.min"=>"The name At Least 3 Char",

            "image.required"=>"The Image Source Is Required",
            "image.unique"=>"The Image Source Used Before",

        ]);

        $request_data=\request()->all();
        $request_data['creator_id']=Auth::id();

       $product = products::create($request_data);
        // $name=\request()->get("name");
        // $price=\request()->get("price");
        // $image=\request()->get("image");
        // $description=\request()->get("description");
        // $category_id=\request()->get("category_id");
 
        // $product=new products();
        // $product->name=$name;
        // $product->price=$price;
        // $product->image=$image;
        // $product->description=$description;
        // $product->category_id=$category_id;
        // $product->save();

        return to_route("product.show",$product->id);

    }

    function form_update($id){
        $user=Auth::user();
        $products=products::findorfail($id);
        $response=Gate::inspect('update',$products);
        if ($response->allowed()) {
        $cats=category::all();
        return view("formInput",["updateId"=>$products,"categories"=>$cats]);
        }
        return abort(403);
    }

    function edit(){

        
        $id=\request()->get("id");
        $productID=products::where("id",$id)->first();
        $name=\request()->get("name");
        $image=\request()->get("image");
        $price=\request()->get("price");
        $description=\request()->get("description");
        $category_id=\request()->get("category_id");

        
        
        $productID->name=$name;
        $productID->price=$price;
        $productID->image=$image;
        $productID->description=$description;
        $productID->category_id=$category_id;
        $productID->save();
        
        return to_route("product.show",$productID->id);
    }

    function destroy($id){

        // if (!Gate::allows('is_admin')) {
        //     abort(403);
        // }
            $user=Auth::user();
            $products=products::findorfail($id);

            $response=Gate::inspect('destroy',$products);

            if ($response->allowed()) {
                $products->delete();
                    return to_route("product.index");
            }
            return abort(403);

            // if ($user->can('destroy')) {
            //     // $products=products::findorfail($id);
            //     $products->delete();
            //     return to_route("product.index");
            // }
       
    }

    function aboutPage()
    {
        return view('about');
    }

    function contactPage()
    {
        return view('contact');
    }
    
    function landingPage()
    {
        return view('landing');
    }
}
