<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth')->only(['store', 'update', 'destroy']);
        $this->middleware('CheckName')->only(['store']);

    }


    public function index()
    {
        $cat = category::all();
        // return $cat;

        return view("category.index", ["categories" => $cat]);
        // return "ggggggggggg";

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $logo = null;
        $request_data = $request->all();
        if ($request->hasFile("logo")) {
            # code...
            $logo = $request_data['logo'];
            // $name=$logo->getClientOriginalName();
            // $extension=$logo->getClientOriginalExtension();

            // $logo_name=time().".{$extension}";

            $path = $logo->store("catLogo", "category_upl");
            $request_data['logo'] = $path;
        }

        // dd($logo);


        category::create($request_data);
        // category::create(["name"=>$request->get("name"),"logo"=>$request->get("logo")]);
        return to_route("category.index");
    }


    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        // dd($category);
        return view("category.show", ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view("category.create", ["updateId" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, category $category)
    {


        // $user=Auth::user();
        // $products=products::findorfail($id);

        $allowed = Gate::inspect('update', $category);

        if ($allowed->allowed()) {
       
            if ($request->hasFile("logo")) {
                try {
                    unlink("images/categoryLogo/{$category->logo}");
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $request_data = $request->all();

                # code...
                $logo = $request_data['logo'];
                $path = $logo->store("catLogo", "category_upl");
                $request_data['logo'] = $path;

                $category->update($request_data);
                return to_route("category.show", $category->id);
            } else {
                $request_data = $request->all();


                $logo = $request_data['logo'];
                $path = $logo->store("catLogo", "category_upl");
                $request_data['logo'] = $path;

                $category->update($request_data);
                return to_route("category.show", $category->id);
            }
        }
        return abort(403);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        if ($category->logo) {
            try {
                unlink("images/categoryLogo/{$category->logo}");
            } catch (\Throwable $th) {
                //throw $th;
            }
            # code...
        }
        $category->delete();
        return to_route("category.index");
    }
}
