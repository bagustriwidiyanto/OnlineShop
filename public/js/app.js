// ====================== Modal Show =====================
$('body').on('click','.modal-show',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr("href"),
        method = url.indexOf('edit'),
        title = me.attr("title");
    $('#modal-title').text(title);
    $('#modal-btn-save').show().text(me.hasClass('edit')?'Update Product':'Add Product');
    $.ajax({
        url:url,
        dataType:"html",
        success: function(response){
            $('#modal-body').html(response);
            if(method != -1){
                var src = $('#photo').val();
                $('#uploaded_image').html('<img src="/images/'+src+'" id="image" name="image" width="300" height/>');
            }
        },
        error: function(jqXHR,textStatus,errorThrown){
            if(errorThrown == 'Unauthorized'){
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'You must logged in to do this !'
                })
                $('#modal').modal('hide');
            }
            else{
                swal({
                    icon:'error',
                    title:'Oops...',
                    text:'Something went wrong!'
                })
                $('#modal').modal('hide');
            }
        }
    });
    $('#modal').modal('show');
});

// ====================== Store Item =======================

$('#modal-btn-save').click(function(event){
    event.preventDefault();
    var form = $('#modal-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';
    form.find('.text-danger').remove();
    form.find('.form-group').removeClass('was-validation');
    form.find('#message').css('display','none');
    form.find('#message').removeClass('alert-danger');
    if(url == '/user' && method == 'PUT'){
    }
        $.ajax({
            url: url,
            method: method,
            data : form.serialize(),
            success: function(response){
                form.trigger('reset');
                $('#modal').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                if(response.error == 'newpassword'){
                    swal({
                        icon: 'error',
                        title: 'Oops !',
                        text: 'New password isn\'t same with confirm password !'
                    })
                }
                else if(response.error == 'hash'){
                    swal({
                        icon: 'error',
                        title: 'Oops !',
                        text: 'Old Password is incorrect !'
                    })
                }
                else if(response.error == 'double'){
                    swal({
                        icon: 'error',
                        title: 'Oops !',
                        text: 'Old password and new password is incorrect!'
                    })
                }
                else{
                    swal({
                        icon: 'success',
                        title: 'Success !',
                        text: 'Product Added !'
                    })
                }
            },
            error: function(xhr){
                var res = xhr.responseJSON;
                if($.isEmptyObject(res) == false){
                    $.each(res.errors,function(key,value){
                        if(key == 'photo'){
                            $('#message').css('display','block');
                            $('#message').html('The field photo is required');
                            $('#message').addClass('alert-danger');
                        }
                        else if(key == 'receipt'){
                            $('#message').css('display','block');
                            $('#message').html('The field photo is required');
                            $('#message').addClass('alert-danger');
                        }
                        else if(key == 'status'){
                            $('#message').css('display','block');
                            $('#message').html('Status can\'t be empty , Please select one !');
                            $('#message').addClass('alert-danger');
                        }
                        else{
                        $('#'+ key)
                            .closest('.form-group')
                            .addClass('was-validation')
                            .append('<span class="text-danger">'+value+'</span>');
                        }
                    })
                }
            }
        });
});

// ================ Upload Image Product===================

$(document).on('submit', '#upload_form', function(event){
    event.preventDefault();
        var url = '/product/action';
        $.ajax({
            url:url,
            method: 'POST',
            data : new FormData(this),
            dataType: 'JSON',
            contentType : false,
            cache: false,
            processData : false,
            success: function(data){
                $('#message').css('display','block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                $('#uploaded_image').html(data.upload_image);
                $('#photo').val(data.input);
            }
        })
    });
// ================ Upload Image History===================

$(document).on('submit', '#form-upload', function(event){
    event.preventDefault();
        var url = '/history/action';
        $.ajax({
            url:url,
            method: 'POST',
            data : new FormData(this),
            dataType: 'JSON',
            contentType : false,
            cache: false,
            processData : false,
            success: function(data){
                $('#message').css('display','block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                $('#uploaded_image').html(data.upload_image);
                $('#photo').val(data.input);
            }
        })
    });
// ======================= Delete Item ===================

$('body').on('click','.btn-delete',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: 'Are you sure want to delete '+title+' ?',
        text: 'You won\'t be able to revert this !',
        icon: 'warning',
        buttons : [true,'Yes , delete it !'],
        dangerMode :true,
    }).then((value)=>{
        if(value){
            $.ajax({
                url:url,
                type:'POST',
                data:{
                    '_method':'DELETE',
                    '_token' : csrf_token
                },
                success:function(response){
                    $('#datatable').DataTable().ajax.reload();
                    swal({
                        icon:'success',
                        title:'Success !',
                        text: 'Data has been deleted !'
                    })
                },
                error:function(xhr){
                    swal({
                        icon:'error',
                        title:'Oops...',
                        text:'Something went wrong!'
                    })
                }
            })
        }
    })
})

// ====================== Button Show =================

$('body').on('click','.btn-show',function(event){
    event.preventDefault();

    var me=$(this),
        url=me.attr('href'),
        title=me.attr('title');

        $('#modal-title').text(title);
        $('#modal-btn-save').hide();

        $.ajax({
            url:url,
            dataType:'html',
            success:function(response){
                $('#modal-body').html(response);
            }
        })
        $('#modal').modal('show');
});

// ======================= Prevent Default Form =========================

$('body').on('submit','#form-show',function(event){
    event.preventDefault();
});

// ======================= Open Cart =================

$('body').on('click','.cartz',function(event){
    event.preventDefault();
    var me =$(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#modal-title').text(title);
    $('#modal-btn-save').show().text('Submit');
    $.ajax({
        url:url,
        dataType:'html',
        success:function(response){
            $('#cart-form-load').load();
            $('#modal-body').html(response);
        },
        error: function(jqXHR,textStatus,errorThrown){
                if(errorThrown == 'Unauthorized'){
                    swal({
                        icon:'error',
                        title:'Oops...',
                        text:'You must logged in to do this !'
                    })
                    $('#modal').modal('hide');
                }
                else if(errorThrown == 'Internal Server Error'){
                    swal({
                        icon:'error',
                        title:'Oops...',
                        text:'Your cart is empty !'
                    })
                    $('#modal').modal('hide');
                }
                else{
                    swal({
                        icon:'error',
                        title:'Oops...',
                        text:'Something went wrong!'
                    })
                    $('#modal').modal('hide');
                }
        }
    })
    $('#modal').modal('show');
})

// =============== Delete Cart ===========================

$('body').on('click','.btn-delete-cart',function(event){
    event.preventDefault();
    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: 'Are you sure want to delete '+title+' ?',
        text: 'You won\'t be able to revert this !',
        icon: 'warning',
        buttons : [true,'Yes , delete it !'],
        dangerMode :true,
    }).then((value)=>{
        if(value){
            $.ajax({
                url:url,
                type:'POST',
                data:{
                    '_method':'DELETE',
                    '_token' : csrf_token
                },
                success:function(response){
                    swal({
                        icon:'success',
                        title:'Success !',
                        text: 'Data has been deleted !'
                    })
                    $('#trigger-click').trigger('click');
                    $('#modal').modal('show');
                },
                error:function(xhr){
                    swal({
                        icon:'error',
                        title:'Oops...',
                        text:'Something went wrong!'
                    })
                }
            })
        }
    })
})
// =================== Check Diskon ===============
$('body').on('change','#discountcode',function(event){
    event.preventDefault();
    var form = $('#modal-body form');
        diskon =  atob($('#___token').val());
        code = form.find('#discountcode').val();
        besar = $('#discount').val();
        $( "#besardiskon" ).remove();
        if(diskon == code){
            if($('#total').val() == 0){
                $('#tempat').append('<input type="hidden" id="besardiskon" value="'+(100-besar)/100+'" > ');
            }
            else{
                $('#total').val($('#total').val()*(100-besar)/100);
            }
        form.find('#discountcode').append('<span class="text-success"> Berhasil di discount! </span>');
    }
});

// =============== Price =========================

$('body').on('change','#amount',function(event){
    event.preventDefault();
    var form = $('#modal-body form'),
    amount = form.find('#amount').val();
    price = form.find('#products_price').val();
    total = form.find('#total').val();
    besardiskon = form.find('#besardiskon');
    max = parseInt(form.find('#stock').val())-parseInt(form.find('#cart-amount').val())-parseInt(form.find('#history-amount').val());
    if(amount < 1){
        form.find('#amount').val(1);
        amount = form.find('#amount').val();
        if(besardiskon.length != 0){
            total = form.find('#total').val(amount*price*besardiskon);
        }
        else{
            total = form.find('#total').val(amount*price);
        }
    }
    else if(amount > max){
        form.find('#amount').val(max);
        amount = form.find('#amount').val();
        if(besardiskon.length != 0){
            total = form.find('#total').val(amount*price*besardiskon);
        }
        else{
            total = form.find('#total').val(amount*price);
        }
    }
    else{
        if(besardiskon.length != 0){
            total = form.find('#total').val(amount*price*besardiskon);
        }
        else{
            total = form.find('#total').val(amount*price);
        }
    }
})
// ================ Discount On Key Up =============
$('body').on('change','#discount',function(event){
    event.preventDefault();
    var form = $('#modal-body form'),
    discount = form.find('#discount').val();
    if(discount < 0){
        form.find('#discount').val(0);
    }
    else if(discount == null){
        form.find('#amount').val(0);
    }
    else if(discount > 100){
        form.find('#amount').val(100);
    }
})
