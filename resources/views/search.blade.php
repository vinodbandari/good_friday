@include('layouts.header')
@include('layouts.topbar')
@include('layouts.leftbar')
@if(isset($_GET['key']))
<div id="wrapper">
<div class="content-page">
<div class="content">
    <div class="card">
        <div class="card-body">
    <a id="createcatlog" class="btn btn-success" target="_blank" href="" onclick="getname();"><i class="fe-download"></i> Create Catalogue</a> <a id="createcatlog1" class="btn btn-success" target="_blank" href="" onclick="getname1();"><i class="fe-download"></i> Create Price List</a> <a class="btn btn-danger" href="/resetcatlog" onclick="return confirm('Are you sure you want to Reset?');"><i class="fe-delete"></i> Reset</a>
        </div></div>
<div class="card">
<div class="card-body">

<div style="overflow-x:auto;">
<table id="basic-datatable">
<thead>
    <tr>
        <th>Catlog</th>
        <th>Item Code</th>
        <th>Category</th>
        <th>Size</th>
        <th>Variant</th>
        <th>Price</th>
        <th>Model</th>
        <th>Company</th>
        <th>Dealer</th>
        <th>Finish</th>
        <th>Cart</th>
    </tr>
</thead>

<tbody>

@foreach(search($_GET['key']) as $item)
<tr>
<td> <input type="checkbox" id="catlog[]" name="catlog[]" onclick='handleClick(this);' value={{getItemid($item->item_code,$item->cat_code)}} {{(catlogcheck(getItemid($item->item_code,$item->cat_code)) ? 'checked' : '')}}></td>
<td class="align-middle">  <img style="width:75px; height:75px;" data-original="/Uploads/{{$item->pic}}" class="mr-2" alt="image"> <a href="itemdetail?id={{getItemid($item->item_code,$item->cat_code)}}"> {{$item->item_code}}</a> </td>
<td class="align-middle"> {{getCategoryDetail($item->cat_code)->name}} </td>
<td class="align-middle"> {{$item->size}} </td>
<td class="align-middle"> {{$item->variant}} </td>
<td class="align-middle"> {{$item->sell_price}} </td>
<td class="align-middle"> {{$item->model}} </td>
<td class="align-middle"> {{$item->company}} </td>
<td class="align-middle"> {{$item->dealer}} </td>
<td class="align-middle"> {{$item->finish}} </td>
<td class="align-middle"> <a data-toggle="modal" data-target="#addcart" class="btn btn-info" onclick="modal('{{createcode($item->item_code, $item->cat_code)}}','{{($item->size) ? $item->size : ''}}','{{($item->variant) ? $item->variant : ''}}','{{$item->id}}','{{getsellprice($item->mrp,$item->cost,$item->import,$item->item_code,$item->cat_code)}}');">Add to Cart </a> </td>
</tr>
@endforeach
</tbody>




</table>
</div>
<div class="modal fade" id="addcart" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myCenterModalLabelCart">Add to Cart </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                        <form action = "/addcart"  method="post" class="needs-validation">
                            @csrf
                        <input type="text" class="form-control" id="cart_id" name="cart_id" hidden>
                        <input type="text" class="form-control" id="cart_spl" name="cart_spl" hidden>
                        <input type="text" class="form-control" id="cart_price" name="cart_price" hidden>
                        <label for="exampleInputPassword4">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="cart_qty" name="cart_qty" required placeholder="Quantity">
                        <label for="exampleInputPassword4">Finish <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cart_finish" name="cart_finish" required placeholder="Finish">
                        <label for="exampleInputPassword4">Discount</label>
                        <input type="number" class="form-control" id="cart_disc" name="cart_disc"  placeholder="Discount">
                        <label for="exampleInputPassword4">Remarks</label>
                        <input type="text" class="form-control" id="cart_remark" name="cart_remark" placeholder="Remarks">
                        <button id="btneditcart" type="submit" class="btn btn-danger waves-effect waves-light">Add</button>
</form>
                      </div>
                      </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->


</div> <!-- end card body-->
</div>

</div>
</div>
</div>

@else
<script>window.location = "/home";</script>
@endif

<script>

    function getname()
    {
        var val = prompt("Enter Name: ", "Name");
        var createcatlog= document.getElementById("createcatlog");
        createcatlog.href ="/catlog/price/false/name/"+val;
        //alert(val);
    }

    function getname1()
    {
        var val = prompt("Enter Name: ", "Name");
        var createcatlog= document.getElementById("createcatlog1");
        createcatlog.href ="/catlog/price/true/name/"+val;
        //alert(val);
    }

    function handleClick(cb)
    {
        if(cb.checked)
        {
        $.ajax({
            url: '/addcatlog/id/'+cb.value,
            type: "get",
            data: {
                // data stuff here
            },
            success: function () {

            }
        });
        }
        else{
            $.ajax({
            url: '/deletecatlog/id/'+cb.value,
            type: "get",
            data: {
                // data stuff here
            },
            success: function ()
            {            }
        });
        }
    }
    function modal(code,size,variant,id,price)
{
if(variant=="")
{
    document.getElementById("myCenterModalLabelCart").innerHTML = code + " | "+ size + " | " + price;
}
else
{
	document.getElementById("myCenterModalLabelCart").innerHTML = code + " | "+ size +" |  "+variant +" | " + price;

}
	document.getElementById("cart_qty").focus();
    document.getElementById("cart_id").value = id;
    document.getElementById("cart_price").value = price;
    document.getElementById("cart_spl").value = 0;
}
</script>


@include('layouts.footer')

<script type="text/javascript">
	$("img").lazyload({
	    effect : "fadeIn"
	});
</script>
