
@extends('layouts.app')

@section('content')
    
<div class="container">

<div class="ce col-md-10 col-lg-6 m-auto">
    <h1 class="mt-4 mb-5 text-center">Hello Client</h1>

       
            <form class="form-floating" method="Post" action="{{isset($updateId)?route('category.update',$updateId->id):route('category.store')}}" enctype="multipart/form-data">
              @csrf
             @if (isset($updateId))
             @method("put")
             @endif 
                  <div class="form-floating mb-3 d-none">
                    <input  type="text"   value="{{isset($updateId->id)?$updateId->id:""}}" class="form-control" name="id" id="id" placeholder="id">
                    <label for="name">Category-ID</label>
                   </div>
                   
                  <div class="form-floating mb-3">
                    <input type="text" value="{{isset($updateId->name)?$updateId->name:old('name')}}" class="form-control" name="name" id="name" placeholder="name" >
                    <label for="name">Category Name</label>
                  </div>
                  @error('name') <p class="text-danger">{{$message}}</p> @enderror

            
                  <div class="form-floating mb-3">
                    <input type="file" class="form-control" value="{{isset($updateId->logo)?$updateId->logo:old('logo')}}" name="logo" id="logo" placeholder="logo">
                    <label for="img">Category Logo</label>
                  </div>
                  @error('logo') <p class="text-danger">{{$message}}</p> @enderror
{{--             
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{isset($updateId->logo)?$updateId->logo:old('logo')}}" name="logo" id="logo" placeholder="logo">
                    <label for="img">Category Logo</label>
                  </div>
                  @error('logo') <p class="text-danger">{{$message}}</p> @enderror --}}

                 <input class="btn btn-success mt-3" type="submit" value="{{isset($updateId)?"Update":"Add"}}">
            </form>
            <div class="my-3 text-center ">
              <a href="{{route('category.index')}}" class="btn btn-link">Back</a>
           </div>
</div>
</div>
@endsection

