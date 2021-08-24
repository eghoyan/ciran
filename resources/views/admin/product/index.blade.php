@extends('layouts.admin')

@section('content')
 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="card">
     <div class="card-header d-flex ">
      Products
     </div>
     <div class="card-body row">
      @foreach($products as $product)
       <div class="col-md-4 p-2">
        <div class="border rounded">
         {{$product->name}}
         <div >
          @if($product->status == \App\Models\Product::INACTIVE)
           <a href="{{ route('admin.product.active',$product->id) }}" class="btn btn-outline-success">Active</a>
          @elseif($product->status == \App\Models\Product::BLOCK)
           <a href="{{ route('admin.product.unblock',$product->id) }}" class="btn btn-outline-success">UnBlock</a>
          @else
           <a href="{{ route('admin.product.block',$product->id) }}" class="btn btn-outline-danger">Block</a>
          @endif
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