@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
   <div class="col-md-8">
    <div class="card">
     <div class="card-header d-flex ">
      Product Edit
    </div>
    <div class="card-body">
      <form action="{{ route('user.product.update',$product->id) }}" method="post" enctype="multipart/form-data">
       @csrf
       {{--laravelum post forman aranc csrf-i chi ashxatum--}}
       <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
        <div class="col-md-6">
         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')?old('name'):$product->name }}" required autocomplete="name" autofocus>
         @error('name')
         <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>
      <div class="col-md-6">
       <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
        <option value="">Category</option>
        @foreach($categories as $category)
        @if(old('category'))
          <option value="{{$category->id}}" {{old('category') == $category->id ?'selected':''}}>{{$category->name}}</option>
        @else
          <option value="{{$category->id}}" {{ $product->category_id == $category->id ?'selected':''}}>{{$category->name}}</option>
        @endif
        @endforeach
      </select>
      @error('category')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
    <div class="col-md-6">
      <img src="{{asset('storage/'.$product->img)}}" class="w-100 mb-2" style="height: 200px; object-fit: contain;">
     <input id="image" type="file" class="form-control @error('image') is-invalid @enderror p-1" name="image" required autofocus>
     @error('image')
     <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
</div>
<div class="form-group row">
  <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>
  <div class="col-md-6">
   <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity')?old('quantity'): $product->quantity }}" min="1" required autofocus>
   @error('quantity')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
</div>
<div class="form-group row">
  <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
  <div class="col-md-6">
   <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price')?old('price'):$product->price}}" min="1" required autofocus>
   @error('price')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
</div>
<div class="form-group row">
  <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
  <div class="col-md-6">
   <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description')?old('description'):$product->description}}</textarea>
   @error('description')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
</div>
<div class="form-group row mb-0">
  <div class="col-md-8 offset-md-4">
   <button type="submit" class="btn btn-primary">
    Submit
  </button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection