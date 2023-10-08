<!DOCTYPE html>
<html>
    <head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 

@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="by my-3 text-center">
        <a href="{{route('product.input')}}" class="btn btn-link p-2 border border-1 border-black">Add products</a>

    </div>
<div class="ce col-md-6 col-lg-10 m-auto">
    <h1 class="mt-4 mb-5 text-center">Products</h1>

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card  mb-3 p-2" >
                <h4 class="card-header">Product-{{$product->id}}</h4>
                <div class="imgg">
                    <img src="{{asset('/images/'.$product->image)}}" alt="error" srcset="" class="w-100" style="height:250px">
                </div>
                <div class="card-body">
                  <h5 class="card-title"> <span class="fw-bold">Name :</span> <span class="text-primary">{{$product->name}}</span></h5>
                  <p class="card-text"><span class="fw-bold">Description :</span>  <span class="text-primary">{{$product->description}}</span></p>
                  {{-- <p class="card-text">Category : <a href="{{route('category.show',$productID->category->id)}}">{{$productID->category->name}}</p> --}}
                  @if ($product->category)
                  <p class="card-text " ><span class="fw-bold">Category : </span>  <img src="{{asset('/images/categoryLogo/'.$product->category->logo)}}" alt="error" srcset="" class="ms-2"  style="height:50px;width:50px;padding:3px; border:1px solid black ;border-radius:5px "> </p>
                  {{-- <p class="card-text " ><span class="fw-bold">Category : </span>  <img src="{{asset('/images/'.$product->category->logo)}}" alt="error" srcset="" class="ms-2"  style="height:50px;width:50px; border-radius:50%; "> </p> --}}
                    
                      @else
                          <p><span class="fw-b">Category : </span> None</p>
                      @endif
              
                 
                  <p class="card-text"><span class="fw-bold">Price : </span> <span class="text-primary">{{$product->price}}</span>$</p>
                </div>
                <div class="b d-flex justify-content-center ">
                    <a href="{{route('product.show',$product->id)}}" class="btn btn-link p-2 border border-1 border-black ">View</a>
                    <a href="{{route('product.destroy',$product->id)}}" class="btn btn-link p-2 border border-1 border-black mx-1" onclick="confirmation(event)">Delete</a>
                    <a href="{{route('product.update',$product->id)}}" class="btn btn-link p-2 border border-1 border-black">Update</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
      <div class="d-flex justify-content-center mt-4">
        {!! $products->links("pagination::bootstrap-4") !!}

      </div>
</div>
</div>

@endsection

<script type="text/javascript" >
      function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to Delete this post",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,

        })
        .then((willCancel) => {
            if (willCancel) {
                window.location.href = urlToRedirect;
            }  
        });
    }
</script>



</head>
</html>