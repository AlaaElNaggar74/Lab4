
@extends('layouts.app')

@section('content')
    
<div class="container">
  @if ($errors->any())
    <div >
        <ul>
            @foreach ($errors->all() as $error)
                {{-- <li>{{ $error }}</li> --}}
            @endforeach
        </ul>
    </div>
@endif
<div class="ce col-md-10 col-lg-6 m-auto">
    <h1 class="mt-4 mb-5 text-center">Hello Client</h1>

        <div class="my-3 text-center ">
           <a href="{{route('product.index')}}" class="btn btn-link">Back</a>
        </div>
            <form class="form-floating" method="Post" action="{{isset($updateId)?route('product.edit'):route('product.store')}}">
              @csrf
                  <div class="form-floating mb-3 d-none">
                    <input  type="text"   value="{{isset($updateId->id)?$updateId->id:""}}" class="form-control" name="id" id="id" placeholder="id">
                    <label for="name">Product-ID</label>
                   </div>
                   
                  <div class="form-floating mb-3">
                    <input type="text" value="{{isset($updateId->name)?$updateId->name:old('name')}}" class="form-control" name="name" id="name" placeholder="name" >
                    <label for="name">Product Name</label>
                  </div>
                  @error('name') <p class="text-danger">{{$message}}</p> @enderror

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{isset($updateId->price)?$updateId->price:old('price')}}" <?php (isset($updateId))?"readonly":"" ?> name="price" id="price" placeholder="price">
                    <label for="email">Product Price</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{isset($updateId->image)?$updateId->image:old('image')}}" name="image" id="image" placeholder="image">
                    <label for="img">Product Image</label>
                  </div>
                  @error('image') <p class="text-danger">{{$message}}</p> @enderror

                 
                  <div class="form-floating">
                    <input type="text" class="form-control" value="{{isset($updateId->description)?$updateId->description:old('description')}}"  name="description" id="pass" placeholder="Grade">
                    <label for="pass">Product Description</label>

                    <div class="form-floating mb-3">
                      {{-- <input type="text" class="form-control" value="{{isset($updateId->price)?$updateId->price:old('price')}}" <?php (isset($updateId))?"readonly":"" ?> name="price" id="price" placeholder="price"> --}}
                     
                     <select class="form-select" name="category_id" id="cat" aria-label=" default select example">

                      <option selected disabled  value="{{isset($updateIdCat->category_id)?$updateIdCat->category_id:old('category_id')}}">select category</option>
                      @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                     </select>
                     
                      <label for="cat">Category</label>
                    </div>
  
                  </div>
                 <input class="btn btn-success mt-3" type="submit" value="{{isset($updateId)?"Update":"Add"}}">
            </form>
            
</div>
</div>
@endsection
