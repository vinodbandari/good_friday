@if($products->count() >=1)
   <div class="row">
    @foreach($products as $prod)
    <div class="col-md-3 my-2">
        <div class="card">
            <img src="{{ asset('assets/uploads/products/'.$prod->image) }}" alt="">

            <div class="card-body">
                <h5 class="card-title">{{ $prod->name }}</h5>
                <p class="card-text">{{$prod->description}}</p>
                <h4 class="btn btn-dark">{{ $prod->price }}</h4>
            </div>
        </div>
    </div>
   </div>
   @endforeach
@endif
