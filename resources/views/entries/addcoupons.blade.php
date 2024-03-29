<div class="modal" id="addcoupon" data-backdrop="static" style="overflow-x: hidden;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modaltittleadditem" class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="container"></div>


            <div class="modal-body">
                <form id="couponform" action="/addcoupon" method="post" class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" id="id" name="id" hidden placeholder="Finish">



                    {{-- Offer Name --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Offer  Name</label>
                        <input type="text" class="form-control" id="offer_name" name="offer_name" placeholder="Offer Name" required>

                    </div>

                    {{-- Products --}}
                    <div class="form-group">
                        <label>Products (Optional)</label>
                        <select name="product_id" id="product_id" class="form-control select2-products" >
                            <option value="">Select Product</option>
                            @foreach ($products as $proditem)
                            <option value="{{ $proditem->id }}">{{ $proditem->name }}</option>
                            @endforeach
                        </select>

                    </div>


                    {{-- Coupon Code --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Coupon Code</label>
                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code" required>

                    </div>

                    {{-- Coupon Limit --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Coupon Limit</label>
                        <input type="number" class="form-control" id="coupon_limit" name="coupon_limit" placeholder="Coupon Limit" required>

                    </div>

                     {{-- Status --}}
                     <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="coup_status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="0">InActive</option>
                            <option value="1" >Active</option>
                        </select>

                    </div>



                    {{-- Coupon Price --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Coupon Price</label>
                        <input type="text" class="form-control" id="coupon_price" name="coupon_price" placeholder="Coupon Price" required>

                    </div>

                    {{-- Coupon Type --}}
                    <div class="form-group">
                        <label>Coupon Type</label>
                        <select name="coupon_type" id="coupon_type" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="1">Percentage</option>
                            <option value="2" >Amount</option>
                        </select>

                    </div>

                    {{-- Start Date --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Start Date</label>
                        <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" placeholder="Start Date Time" required>

                    </div>

                    {{-- End Date --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">End Date</label>
                        <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" placeholder="End Date Time" required>

                    </div>





                    {{-- Visibility --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Visibility</label>
                        {{-- <input type="checkbox"  id="visibility_status" name="visibility_status" {{ $coupons->contains('visibility_status') ? 'checked' : '' }}`/> (0=show,1=Hide) --}}
                        <input type="checkbox"  id="visibility_status" name="visibility_status" /> (0=show,1=Hide)


                    </div>



                        <button id="itemsubmit" type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function(){
      $('select2-products').select2();
    });
</script>
