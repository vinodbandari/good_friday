/*
 * Custom code goes here.
 * A template should always ship with an empty custom.js
 *
 *
 *
 */

$(document).ready(function(){



    $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
       });

























});










function novBtBuyNow(){
    $('.nov-bt-buynow').each(function () {
        if (!$(this).hasClass("nov-enable")) {
            $(this).addClass('nov-enable');
            $(this).click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).find(".loading").show();
                var orderlink = $(this).attr('data-orderlink');
                var object_button_container = $(this).parents(".product-miniature");
                var $element = $(this);
                var $form = $element.closest("form");
                var query = $form.serialize() + "&add=1&action=update";
                var actionURL = $form.attr("action");
                $.ajax({
                    type: "POST",
                    headers: {"cache-control": "no-cache"},
                    url: actionURL,
                    async: !0,
                    cache: !1,
                    data: query,
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                          window.location.href = orderlink;
                        }
                    }
                })
            })
        }
    })
}
function showModalPopupCart(modal) {
    if ($("#blockcart-modal").length) {
        $("#blockcart-modal").remove();
    }
    $("body").append(modal);
    $("#blockcart-modal").modal("show");
}

function ajaxLoadVariant($self, formData) {
    $.ajax({
        url: baseDir + 'modules/novelementor/ajax_variants.php',
        data: formData,
        async: !0,
        cache: !1,
        dataType: "json",
        headers: { "cache-control": "no-cache" },
        success: function(res) {
            if (res.success) {
                var groups = res.groups;
                var product = res.product;
                $self.parents('.product-miniature').find('.product-title a').attr('href', product.url);
                $self.parents('.product-miniature').find('.product-price-and-shipping span.price').html(product.price);
                if (product.has_discount) {
                    $self.parents('.product-miniature').find('.product-price-and-shipping span.regular-price').html(product.regular_price);
                    if (product.discount_type == 'percentage') {
                        $self.parents('.product-miniature').find('.product-price-and-shipping span.discount-percentage').html(product.discount_percentage);
                    }
                    else {
                        $self.parents('.product-miniature').find('.product-price-and-shipping span.discount-percentage').html(product.discount_amount_to_display);
                    }
                }
                $self.parents('.product-miniature').find('.image-cover').attr('src', product.images[0].large.url);
                $self.parents('.product-miniature').find('.image-cover').attr('data-full-size-image-url', product.images[0].large.url);
                if (product.images[1] != undefined) {
                    $self.parents('.product-miniature').find('.image-secondary').attr('src', product.images[1].large.url);
                    $self.parents('.product-miniature').find('.image-secondary').attr('data-full-size-image-url', product.images[1].large.url);
                }
                else {
                    $self.parents('.product-miniature').find('.image-secondary').attr('src', product.images[0].large.url);
                    $self.parents('.product-miniature').find('.image-secondary').attr('data-full-size-image-url', product.images[0].large.url);
                }
                if (product.available_for_order == '0') {
                    $self.parents('.product-miniature').find('.nov-bt-cart').attr('disabled', 'disabled');
                    $self.parents('.product-miniature').find('.nov-bt-buynow').attr('disabled', 'disabled');
                }
                else {
                    $self.parents('.product-miniature').find('.nov-bt-cart').removeAttr('disabled');
                    $self.parents('.product-miniature').find('.nov-bt-buynow').removeAttr('disabled');
                }
                if (product.availability == 'unavailable' || product.quantity <= 0) {
                    $self.parents('.product-miniature').find('.nov-bt-cart').attr('disabled', 'disabled');
                    $self.parents('.product-miniature').find('.nov-bt-buynow').attr('disabled', 'disabled');
                }
                if (Object.keys(groups).length > 0) {
                    var product_variants = '';
                    product_variants += '<div class="variants-product in_border">';

                    $.each(groups, function (id_attribute_group, group) {
                        if (Object.keys(group.attributes).length > 0) {
                            product_variants += '<div class="product-variants-item">';
                            if (res.showLabel == 'true') {
                                product_variants += '<span class="control-label">' + group.name + ' : </span>';
                            }
                            if (group.group_type == 'select') {
                                product_variants += '<ul class="group_' + id_attribute_group + '">';
                                $.each(group.attributes, function (id_attribute, group_attribute) {
                                    $.each(group.attributes_quantity, function (id_quantity, group_quantity) {
                                        if (id_attribute == id_quantity) {
                                            if (group_quantity > 0) {
                                                product_variants += '<li class="input-container pull-xs-left ">';
                                                if (group_attribute.selected) {
                                                    product_variants += '<input class="input-radio" type="radio" data-product-attribute="' + id_attribute_group + '" name="group[' + id_attribute_group + ']" value="' + id_attribute + '" checked="checked" />';
                                                } else {
                                                    product_variants += '<input class="input-radio" type="radio" data-product-attribute="' + id_attribute_group + group_attribute + '" name="group[' + id_attribute_group + ']" value="' + id_attribute + '" />';
                                                }
                                                product_variants += '<span class="radio-label">' + group_attribute.name + '</span>';
                                                product_variants += '</li>';
                                            } else {
                                                product_variants += '<li class="input-container pull-xs-left li_email" data-toggle="modal" data-target="#popup_newletter">';
                                                product_variants += '<span class="radio-label">' + group_attribute.name + '<i class="zmdi zmdi-email"></i></span>';
                                                product_variants += '</li>';
                                            }
                                        }
                                    })
                                })
                                product_variants += '</ul>';
                            }
                            else if (group.group_type == 'color') {
                                product_variants += '<ul class="group_'+id_attribute_group+'">';
                                $.each(group.attributes, function (id_attribute, group_attribute) {
                                    product_variants += '<li class="pull-xs-left input-container ">';
                                    if (group_attribute.selected) {
                                        product_variants += '<input class="input-color" type="radio" data-product-attribute="' + id_attribute_group + '" name="group[' + id_attribute_group + ']" value="' + id_attribute + '" checked="checked">';
                                        if (group_attribute.html_color_code) {
                                            if (group_attribute.html_color_code == 'ffffff') {
                                                product_variants += '<span class="color white" style="background-color: ' + group_attribute.html_color_code + '"><span class="sr-only">' + group_attribute.name + '</span></span>';
                                            } else {
                                                product_variants += '<span class="color" style="background-color: ' + group_attribute.html_color_code + '"><span class="sr-only">' + group_attribute.name + '</span></span>';
                                            }
                                        } else {
                                            product_variants += '<span><span class="sr-only">' + group_attribute.name + '</span></span>';
                                        }
                                        if (group_attribute.texture) {
                                            product_variants += '<span class="color texture" style="background-image: url(' + group_attribute.texture + ')><span class="sr-only">' + group_attribute.name + '</span></span>';
                                        }
                                        product_variants += '</li>';
                                    } else {
                                        product_variants += '<input class="input-color" type="radio" data-product-attribute="' + id_attribute_group + '" name="group[' + id_attribute_group + ']" value="' + id_attribute + '">';
                                        if (group_attribute.html_color_code) {
                                            if (group_attribute.html_color_code == 'ffffff') {
                                                product_variants += '<span class="color white" style="background-color: ' + group_attribute.html_color_code + '"><span class="sr-only">' + group_attribute.name + '</span></span>';
                                            } else {
                                                product_variants += '<span class="color" style="background-color: ' + group_attribute.html_color_code + '"><span class="sr-only">' + group_attribute.name + '</span></span>';
                                            }
                                        } else {
                                            product_variants += '<span><span class="sr-only">' + group_attribute.name + '</span></span>';
                                        }
                                        if (group_attribute.texture) {
                                            product_variants += '<span class="color texture" style="background-image: url(' + group_attribute.texture + ')><span class="sr-only">' + group_attribute.name + '</span></span>';
                                        }
                                        product_variants += '</li>';
                                    }
                                });
                                product_variants += '</ul>';
                            }
                            else if (group.group_type == 'radio') {
                                product_variants += '<ul class="group_'+id_attribute_group+'">';
                                $.each(group.attributes, function (id_attribute, group_attribute) {
                                    $.each(group.attributes_quantity, function (id_quantity, group_quantity) {
                                        if(id_attribute == id_quantity){
                                            if (group_quantity > 0){
                                                product_variants += '<li class="input-container pull-xs-left ">';
                                                if (group_attribute.selected) {
                                                    product_variants += '<input class="input-radio" type="radio" data-product-attribute="'+id_attribute_group+'" name="group['+id_attribute_group+']" value="'+id_attribute+'" checked="checked" />';
                                                }
                                                else {
                                                    product_variants += '<input class="input-radio" type="radio" data-product-attribute="'+id_attribute_group+group_attribute+'" name="group['+id_attribute_group+']" value="'+id_attribute+'" />';
                                                }
                                                product_variants += '<span class="radio-label">'+group_attribute.name+'</span>';
                                                product_variants += '</li>';
                                            }
                                            else{
                                                product_variants += '<li class="input-container pull-xs-left li_email" data-toggle="modal" data-target="#popup_newletter">';
                                                product_variants += '<span class="radio-label">'+group_attribute.name+'<i class="zmdi zmdi-email"></i></span>';
                                                product_variants += '</li>';
                                            }
                                        }
                                })})
                                product_variants += '</ul>';
                            }
                            product_variants += '</div>';
                        }
                    })
                    product_variants += '</div>';

                    $self.parents('form').find('.product-variants-wrap').html(product_variants);
                }
            }
        }
    });
}



