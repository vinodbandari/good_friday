@include('layouts.voila.header')
@include('layouts.voila.topbar')
@include('layouts.voila.homecss')


<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>All Categories</h3>
                <div class="row">
                    @foreach ($category as $cate)
                        <div class="col-md-4">
                            <a href="{{ url('category/'.$cate->slug) }}">
                                <div class="card">
                                    <img src="{{ asset('assets/uploads/category/'.$cate->image) }}" style="height:200px;width:200px;" alt="Category Image">
                                    <div class="card-body">
                                        <h5>{{ $cate->name }}</h5>
                                        <h5>{{ $cate->description }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>






<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
@include('layouts.voila.footer')

