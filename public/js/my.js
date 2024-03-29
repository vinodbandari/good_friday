$(document).ready(function () {
    loadcart();
    loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // --------------C A R T    C O U N T   L O A D I N G-----------------------------------------------------------------

    function loadcart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);

            }
        });
    }
    // -----------------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------


    // --------------W I S H L I S T    C O U N T    L O A D I N G-----------------------------------------------------------------

    function loadwishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-count",
            success: function (response) {
                // alert(response.count);
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
                // console.log(response.count)
            }
        });
    }

    // function minicartrefresh() {
    //     $('#thekingtest').load("/testload")
    // }
    //------------------------------------------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------------------------------



    // --------------I N C R E M E N T   A N D    D E C R E M E N T    Q U A N T I T Y-----------------------------------------------------------------

    // $('.increase-btn').click(function (e) {
    $(document).on('click', '.increase-btn', function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data_qty_update').find('.prod_id_qty_update').val();
        //alert(prod_id);
        var inc_value = $(this).closest('.product_data_qty_update').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        var test = $(this).closest('.product_data_qty_update').find('.qty-input');
        $.ajax({
            async: false,
            method: "GET",
            url: "/live_stock",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                var res = parseInt(response, 10);

                if (value < res) {

                    value++;
                    // $('.qty-input').val(value);
                    test.val(value);

                    //return false;
                }
                else {
                    // alert("no stock");
                    swal("", "No Stock Available", "No Stock");
                }


            },
            error(jqXHR, exception) {
                console.log(jqXHR);
                swal("", response.status, "success")
            }
        });

        //  var inc_value = $('.qty-input').val();

        // alert(prod_id);
        // var inc_value = $(this).closest('.product_data_qty_update').find('.qty-input').val();
        // var value = parseInt(inc_value, 10);
        // value = isNaN(value) ? 0 : value;
        // if (value < 10) {
        //     value++;
        //     // $('.qty-input').val(value);
        //     $(this).closest('.product_data_qty_update').find('.qty-input').val(value);
        // }
        // return false;
    });

    //

    // $('.decrease-btn').click(function (e) {

    $(document).on('click', '.decrease-btn', function (e) {
        e.preventDefault();
        //alert('hi');
        var dec_value = $(this).closest('.product_data_qty_update').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data_qty_update').find('.qty-input').val(value);
        }
        return false;
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // -----------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------

    // --------------D E L E T E   C A R T I T E M S-----------------------------------------------------------------


    $('.delete-cart-item').click(function (e) {
        // $(document).on('click', '.delete-cart-item', function (e) {


        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // alert('hi');

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        // alert(prod_id);
        $.ajax({
            method: "POST",
            url: "/delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // loadcart();
                // window.location.reload();
                loadcart();
                window.location.reload();
                // $('.cartitems').load(location.href + " .cartitems");
                // $('.mini_cart_load').load(location.href + " .mini_cart_load");


                // $('#featured_products_load').location.load();

                swal("", response.status, "success")
            },
            error(jqXHR, exception) {
                console.log(jqXHR);
            }
        });
    });
    // --------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------


    // demo
    $('.delete-cart').click(function (e) {
        // $(document).on('click', '.delete-cart', function (e) {


        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //  alert('hi');

        var prod_id = $(this).closest('.cart_data').find('.prod_id').val();



        $.ajax({
            method: "POST",
            url: "delete-cart",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                // alert('hi33');
                loadcart();
                // window.location.reload();
                // loadcart();
                window.location.reload();
                // $('.checkout_cart').load(location.href + " .checkout_cart");
                // $('#new_price_update').load(location.href + " #new_price_update");


                // $('#featured_products_load').location.load();

                // swal("", response.status, "success")
            }
        });
    });




    // --------------C H A N G E   Q U A N T I T Y-----------------------------------------------------------------

    // $('.changeQuantity').click(function (e) {
    $(document).on('click', '.changeQuantity', function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data_qty_update').find('.prod_id_qty_update').val();
        var qty = $(this).closest('.product_data_qty_update').find('.qty-input').val();

        data = {
            'prod_id': prod_id,
            'prod_qty': qty,

        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: data,
            success: function (response) {
                // window.location.reload() loadincrement;
                $('.cartitems').load(location.href + " .cartitems");
                $('.total_amt').load(location.href + " .total_amt");
                // $('.loadincrement').load(location.href + " .loadincrement");


            }
        });
        return false;
    });

    // -----------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------



    // --------------A D D    T O   C A R T-----------------------------------------------------------------


    $('.addToCartBtn').click(function (e) {
        // $(document).on('click', '.addToCartBtn', function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        var cate_id = $(this).closest('.product_data').find('.cate_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // alert(product_id);
        // alert(product_qty);

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
                'cate_id': cate_id,
            },
            success: function (response) {
                swal(response.status);
                if (response.statuscode === 200) {
                    // alert(response.statuscode);
                    loadcart();
                    window.location.reload();
                    $('.cartitems').load(location.href + " .cartitems");
                    // $('.minicartitems').load(location.href + " .minicartitems")
                    // if(document.getElementById('buynow').click()){
                    //     window.location.href="/checkout";
                    // }

                }
                //alert(response.statuscode);
                if (response.statuscode === 500) {
                    // alert(response.statuscode);

                    swal(response.status)

                        .then((value) => {
                            window.location.href = "/login";
                        });
                }
            }
        });

        // success: function (response) {
        //     swal(response.status)

        //     .then((value)=>{
        //        window.location.reload();
        //     //    window.location.href="/login";
        //     });

        // }


    });




    // --------------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------------
    // Buy now
    $('.buynow').click(function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        var cate_id = $(this).closest('.product_data').find('.cate_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //  alert(product_id);
        // alert(product_qty);
        // return false();



        $.ajax({
            method: "POST",
            url: "/buy-now",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
                'cate_id': cate_id,
            },
            success: function (response) {
                // swal(response.status);
                if (product_id) {
                    window.location.href = '/checkout';
                }
                if (response.statuscode === 200) {
                    // alert(response.statuscode);
                    loadcart();
                    // trend_prod
                    // window.location.reload();
                    $('.cartitems').load(location.href + " .cartitems");
                    $('.trend_prod').load(location.href + " .trend_prod");
                    $('.list_view').load(location.href + " .list_view");
                    $('.prodwrtcat').load(location.href + " .prodwrtcat");

                    // $('.minicartitems').load(location.href + " .minicartitems")
                    // if(document.getElementById('buynow').click()){
                    window.location.href = "/checkout";
                    // window.location.reload();
                    // }

                }
                //alert(response.statuscode);
                if (response.statuscode === 500) {
                    // alert(response.statuscode);

                    swal(response.status)

                        .then((value) => {
                            window.location.href = "/login";
                        });
                }
            }
        });

        // success: function (response) {
        //     swal(response.status)

        //     .then((value)=>{
        //        window.location.reload();
        //     //    window.location.href="/login";
        //     });

        // }


    });





    // --------------A D D    T O   W I S H L I S T-----------------------------------------------------------------

    // $('.addToWishlist').click(function (e) {
    $(document).on('click', '.addToWishlist', function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var category_id = $(this).closest('.product_data').find('.cate_id').val();

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id': product_id,
                'category_id': category_id,
            },
            success: function (response) {
                swal(response.status);
                if (response.statuscode === 200) {
                    // alert(response.statuscode);
                    loadwishlist();
                    window.location.reload();
                    // $('.wishlistitems').load(location.href + " .wishlistitems")

                }
                if (response.statuscode === 500) {
                    swal(response.status)

                        .then((value) => {
                            window.location.href = "/login";
                        });
                }
                //loadcart();
                // loadwishlist();
            }
        });
    });

    // ---------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------




    //-------------------- R E M O V E    W I S H L I S T-----------------------------------------


    // $('.remove-wishlist-item').click(function (e) {
    $(document).on('click', '.remove-wishlist-item', function (e) {

        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            method: "POST",
            url: "delete-wishlist-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                window.location.reload();

                loadwishlist();
                $('.wishlistitems').load(location.href + " .wishlistitems")

                swal("", response.status, "success")
            }
        });
    });

    // --------------------------------------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------------------------------




    // S O R T   B Y   P R I C E S    I N    G R I D   P R O D U C T S     V I E W



    jQuery('#categoryform').validate({
        rules: {
            name: "required",
        }, messages: {

        }
    });
});


// jQuery('#categoryform').validate({
//     rules:{
//         name:"required",
//     },messages:{

//     }
// });
