
@extends('layouts.admin')

@section('content')
 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="card">
     <div class="card-header d-flex ">
      Category
      <a href="{{ route('admin.category.create') }}" class="btn btn-outline-primary ml-4">Create</a>
     </div>
     <div class="card-body row">
      @foreach($categories as $category)
       <div class="col-md-4 p-2">
        <div class="border rounded">
         {{$category->name}}
         <div >
          <a href="{{ route('admin.category.edit',$category->id) }}" class="btn btn-outline-warning">Edit</a>
          <a href="{{ route('admin.category.delete',$category->id) }}" class="btn btn-outline-danger">Delete</a>
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