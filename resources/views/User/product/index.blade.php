
@extends('layouts.app')

@section('content')
 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="card">
     <div class="card-header d-flex ">
      My Products
      <a href="{{ route('user.product.create') }}" class="btn btn-outline-primary ml-4">Create</a>
     </div>
     <div class="card-body row">
      @foreach($products as $product)
       <div class="col-md-3 p-2">
        <div class="border rounded p-2" >
         <div class="text-center">
          <img class="m-2 w-100" src="{{asset('storage/'.$product->img)}}" alt="" >
         </div>
         <h3 class="text-center">{{$product->name}}</h3>
         <p >Price {{$product->price}} AMD</p>
         <p >Quantity {{$product->quantity}}</p>
         <p >{{$product->description}}</p>
         <p>
          @if($product->status == \App\Models\Product::ACTIVE)
           <span class="badge badge-success">Active</span>
          @elseif($product->status == \App\Models\Product::BLOCK)
           <span class="badge badge-danger">Block</span>
          @else
           <span class="badge badge-warning">Inactive</span>
          @endif
         </p>
         <div >
          <a href="{{ route('user.product.edit',$product->id) }}" class="btn btn-outline-warning">Edit</a>
         </div>
        </div>
       </div>
      @endforeach
     </div>
    </div>
   </div>
  </div>
 </div>
@endsection