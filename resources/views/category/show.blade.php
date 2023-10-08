
@extends('layouts.app')

@section('content')
    
<div class="container">
<div class="ce col-md-6 col-lg-10 m-auto">
    <h1 class="mt-4 mb-5 text-center">Category Info</h1>

    <div class="row align-items-center">
        <div class="col-md-6 mb-3 ">
            <div class="card   mb-3 p-2" >
                <h4 class="card-header">Category-{{$category->id}}</h4>
                <div class="imgg">
                    <img src="{{asset('/images/categoryLogo/'.$category->logo)}}" alt="error" srcset="" class="w-100" style="height:250px">
                </div>
                <div class="card-body">
                  <h5 class="card-title">Name : {{$category->name}}</h5>
                  <h5 class="card-title">created at: {{$category->created_at}}</h5>
                  <h5 class="card-title">updated at : {{$category->updated_at}}</h5>
                </div>
              
              </div>
        </div>
        <div class="relat col-md-6 mb-3  ">
         <div class="d border border-1 border-black p-4 w-100">
          <h3 class="text-info">* Products Related Category</h3>
          <ol>
    
            @foreach ($category->products as $product)
               <h3> <li>{{$product->name}}</li></h3>
            @endforeach
          </ol>
          <div class="mt-3 text-center">
            <a href="{{route('category.index')}}" class="btn btn-link p-2 border border-1 border-black">Back</a>
        </div>
         </div>
        </div>
    </div>
   
</div>
</div>
@endsection

