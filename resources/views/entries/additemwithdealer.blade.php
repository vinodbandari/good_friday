<div class="modal" id="addcategory" data-backdrop="static" style="overflow-x: hidden;
overflow-y: auto;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modaltittleadditem" class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="container"></div>


            <div class="modal-body">
                <form id="categoryform" action="/addcategory" method="post" class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" id="id" name="id" hidden placeholder="Finish">



                    {{-- Category --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Category  Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required>

                    </div>

                    {{-- Slug --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Slug  </label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" required>

                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="exampleInputPassword4">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>

                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="catstatus" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="0">InActive</option>
                            <option value="1" >Active</option>
                        </select>

                    </div>


                    {{-- Image --}}
                    <div class="form-group">
                        <label for="exampleInputEmail3">Product Image<span class="text-danger"></span></label>
                        <input class="form-control" type="file" accept="image/*" name="image"
                            id="image">

                    </div>



                        <button id="itemsubmit" type="submit" class="btn btn-danger waves-effect waves-light">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
