<div class="modal" id="addproduct" data-backdrop="static" style="overflow-x: hidden;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modaltittleadditem" class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="container"></div>
            <div class="modal-body">
                <form id="productform" action="/addproduct" method="post" class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" id="id" name="id" hidden placeholder="Finish">


                    {{-- Product Name --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Product Name  </label>
                        <input type="text" class="form-control"  id="name" name="name" placeholder="Product Name" required>
                    </div>



                    {{-- Category --}}
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-select" id="cate_id" name="cate_id" required >
                            <option value="">Select a Category</option>
                            @foreach ($category as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                    </div>


                    {{-- Slug --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Slug  </label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" required>
                    </div>

                     {{-- Gender --}}
                     <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" id="gendstatus" class="form-control" required>
                            <option value="" selected>Select Gender</option>
                            <option value="0">Female</option>
                            <option value="1">Male</option>
                            <option value="2">Unisex</option>
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                    </div>

                     {{-- Stone Name --}}
                     <div class="form-group">
                        <label for="exampleInputPassword4">Stone Name</label>
                        <input type="text" class="form-control" id="stone_name" name="stone_name" placeholder="Optional">
                    </div>

                     {{-- Weight --}}
                     <div class="form-group">
                        <label for="exampleInputPassword4">Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Optional">
                    </div>

                      {{--Small Description --}}
                      <div class="form-group">
                        <label for="exampleInputPassword4"> Small Description</label>
                        <input type="text" class="form-control" id="small_description" name="small_description" placeholder="Small Description" required >
                    </div>

                     {{--Original Price --}}
                     <div class="form-group">
                        <label for="exampleInputPassword4"> Original Price</label>
                        <input type="number" class="form-control" id="original_price" name="original_price" required placeholder="Original Price" >
                    </div>

                    {{--Selling Price --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4"> Selling Price</label>
                        <input type="number" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price" required>
                    </div>



                    {{--Quantity --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Qty</label>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity" required>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="prodstatus" class="form-control" required>
                            <option value="" >Select Status</option>
                            <option value="1"selected>Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </div>

                    {{-- MINI FEAT,FEAT --}}
                    <div class="form-group">
                        <label>Product Belongs To</label>
                        <select name="trending" id="prodtrending" class="form-control" >
                            <option value="" selected >Select Status</option>
                            <option value="0">Mini Featured2 Product</option>
                            <option value="1">Onsale Product</option>
                            <option value="2">Mini Featured1 Product</option>
                        </select>
                    </div>

                     {{-- On Sale --}}
                     <div class="form-group">
                        <label>Onsale Status</label>
                        <select name="onsale_products" id="onsalestatus" class="form-control" required>
                            <option value="" selected>Select Status</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Product Image<span class="text-danger"></span></label>
                        <input class="form-control" type="file" accept="image/*" name="image"
                            id="image" >
                            <span class="">
                                @error('image') <p class="text-danger">{{ $message }} </p> @enderror
                            </span>
                    </div>

                        <button id="itemsubmit" type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal" id="addcompany" data-backdrop="static" >
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content" style="border: red;border-style: solid;">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Company</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword4">Company Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="newcompany" name="newcompany"
                        placeholder="Company">

                </div>
                <a class="btn btn-info" onClick="addnewcompany();" class="close" data-dismiss="modal"
                    aria-hidden="true">Add</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="adddealer" data-backdrop="static" >
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content" style="border: red;border-style: solid;">
            <div class="modal-header">
                <h4 class="modal-title" id="myCenterModalLabel">Add New Dealer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword4">Dealer Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="newdealer" name="newdealer"
                        placeholder="Dealer">

                </div>
                <a class="btn btn-info" onClick="addnewdealer();" class="close" data-dismiss="modal"
                    aria-hidden="true">Add</a>
            </div>
        </div>
    </div>
</div>
