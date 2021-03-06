
@extends('layouts.app')

@section('content')
 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-md-10">
    <div class="card">
     <div class="card-header d-flex ">
       Products
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
         <div>
            <button class="buy_now btn btn-success" data-id="{{$product->id}}">Buy Now</button>
         </div>
        </div>
       </div>
      @endforeach
     </div>
    </div>
   </div>
  </div>
 </div>
<script src="https://js.stripe.com/v3/"></script>
 <script type="text/javascript">
      $('.buy_now').click(function() {
        let id= $(this).data('id');
        var stripe = Stripe('pk_test_51JSh2LCaZQzoYooM6XTVlPq7OZBUCvXQZsAwcAmVqG3vhevtbAeW2GRYOwJO0NBY1xNXrwf8Xs9Uw2kxR22t4hLO00vTrOPZTI');
        $.ajax({
            url: "{{route('user.payment')}}",
            type: 'post',
            data:{id:id},
            headers: {
              "X-CSRF-Token": $('meta[name=csrf-token]').attr('content')
            },
            success:function (r) {
              if (r.status) {
                return stripe.redirectToCheckout({ sessionId: r.id });
              } else {
                alert(r.data.id[0])
              }
            }
          })
      })
 </script>
@endsection