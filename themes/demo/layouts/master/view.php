<?php
$pathInfo = \Request::getPathInfo();
if (!empty(getCookie('produktkategori')) && (getCookie('produktkategori') == 1 || getCookie('produktkategori') == 2) && ($pathInfo == '/' || $pathInfo == '/home')) {
    header("Location: produktkategori/" . getCookie('produktkategori'));
}
$meta = getMetaDetails($page->get('id'));
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <title><?= $meta->title ?></title>
    <link rel="shortcut icon"
          href="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/favicon.png"
          type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?= $meta->meta_keyword ?>">
    <meta name="description" content="<?= $meta->meta_description ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= phpb_theme_asset('css/style.css') ?>"/>
    <link rel="stylesheet"
          href="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet"
          href="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/css/custom-select.css">
    <link rel="stylesheet"
          href="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/css/style.css">
    <link rel="stylesheet"
          href="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/css/ma5-menu.min.css">
    <link rel="stylesheet"
          href="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/css/responsive.css">
    <!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<?= $body ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/js/custom-select.js"></script>
<script src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/js/ma5-menu.min.js"></script>
<script src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function () {
        var str = window.location.href;
        var test = str.split("/service-support/");
        // if (test[1] != undefined){
        $.ajax({
            type: "GET",
            // url: "http://geoteamdemo.info/trimble?page="+test[1],
            // url: "http://geoteamdemo.info/trimble?page="+test[1],
            url: "<?= url('/trimble?page=')?>",

            success: function (data) {
                $('#trimble_menu').html(data);
            }
        })
        // }
        setTimeout(function () {
            $('.ig1').attr('src', "<?= asset('assets/img/icon/Arrow-left.svg')?>")
        }, 100);

        $('.mail-btn').click(function () {
            if ($("#html").prop('checked') == false && $("#css").prop('checked') == false) {
                toastMixin.fire({
                    title: 'Please select at list one area',
                    icon: 'error'
                });
            } else if ($("#javascript").prop('checked') == false && $("#css").prop('checked') == false) {
                toastMixin.fire({
                    title: 'Please select privacy policy.',
                    icon: 'error'
                });
            } else if ($("#newsEmail").val() === '') {
                toastMixin.fire({
                    title: 'Please enter your email-id',
                    icon: 'error'
                });
            } else {
                if ($("#html").prop('checked') == true) {
                    var landmailing = $('#html').val();
                } else {
                    var landmailing = "";
                }
                if ($("#css").prop('checked') == true) {
                    var landburg = $('#css').val();
                } else {
                    var landburg = "";
                }
                $.ajax({
                    type: "GET",
                    url: "<?= route('mailchimp')?>",
                    data: "landmailing=" + landmailing + '&_token=<?= csrf_token()?>' + '&landburg=' + landburg + '&email=' + $("#newsEmail").val(),
                    success: function (data) {
                        console.log(data)
                        if (data.status == 1) {
                            toastMixin.fire({
                                title: data.message,
                                icon: 'error'
                            });
                        } else if (data.status == 0) {
                            toastMixin.fire({
                                title: data.message,
                                icon: 'error'
                            });
                        } else {
                            toastMixin.fire({
                                title: 'You have successfully subscribed to our newsletter.',
                                icon: 'success'
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                        }
                    }
                })
            }
        })

    })

</script>

<script>
    function checkCounting(data) {
        if (data <= 3 && data >= 0) {
            return data;
        } else if (data > 3) {
            return 3;
        }
    }

    $(document).ready(function () {
        $('.searchright').on('keyup', function () {
            var keyword = $(this).val();
            var imgUrl = "<?= asset('')?>";

            if (keyword.length > 2) {
                $('.search-overlay').removeClass('d-none');
                $.ajax({
                    type: "GET",
                    url: "<?= url('getProdukt_Result')?>",
                    data: "name=" + keyword + '&_token=<?= csrf_token() ?>' + '&sort=1&headerSearchToken=1',
                    success: function (data) {
                        // console.log(data);
                        var y = 0;
                        var x = 0;
                        var z = 0;

                        var resultData = '';
                        var resultDoc = '';
                        var resultPage = '';
                        var baseUrl = "<?= url('/public')?>";
                        data.products.data.forEach(function (item) {
                            y++;
                            if (y <= 3) {

                                if (item.hide_amount == 0 && item.priceApi) {
                                    // if (item.hide_amount == 0 && item.priceApi.basePrice != undefined){
                                    var color = item.priceApi.availability.color;
                                    var apiText = item.priceApi.availability.text;
                                    let number = item.priceApi.basePrice;
                                    number = number.toLocaleString();
                                    var apiPrice = parseFloat(number.replace(/,/gi, ".")) + '  kr. ekskl. moms';
                                    var optCss = "style='background-color:" + color + "'";
                                } else {
                                    var color = '';
                                    var apiText = '';
                                    var apiPrice = 'Ring for en pris';
                                    var optCss = "style='background-color:white'";
                                }


                                productImg = "assets/img/no-product.png";
                                if (item.url != '' || item.url !='null') {
                                    // console.log(data.products.data[y])
                                    productImg = item.url;
                                }
                                console.log(productImg)
                                var productName = item.api_name;
                                var pproductName = productName.replace(/\//gi, "-");

                                var route = "<?= url('/produkt/null/')?>/" + item.id + "/" + pproductName.replace(/ /g, "-");
                                if (item.is_subscription == '1') {
                                    var delCart = ' d-none';
                                } else {
                                    var delCart = '';
                                }

                                resultData += '<div class="media-custom"> <div class="media-left"> <a href="' + route + '"><img src="' + imgUrl + productImg + '" alt="' + item.alt_image + '" class="img-fluid"></a> </div><div class="media-body"> <a href="' + route + '"> <h3>' + item.api_name + '</h3> </a> <p>' + item.api_id + '</p><p>' + item.short_text + '</p><ul> <li><strong>' + apiPrice + '</strong></li><li><span ' + optCss + '></span> ' + apiText + '</li></ul> </div><div class="media-right"> <a href="#" id="' + item.api_id + '" onclick="searchaddCart(' + item.id + ')" class="add-basket ' + item.id + delCart + '">Læg i kurv</a> </div></div>';
                            }
                        });
                        data.content.contents.data.forEach(function (item) {
                            x++;
                            var pName = item.name;
                            var ppName = pName.replace(/\//gi, "-");
                            var routes = "<?= url('/produkt/null/')?>/" + item.id + "/" + ppName.replace(/ /g, "-");
                            console.log(routes);
                            if (x <= 3) {
                                // console.log(item)
                                if (item.type == "guide" || item.type == "video" || item.type == "file") {
                                    //console.log(item.contextType)
                                    var fileUrl = "#";
                                    if (item.file_url != null) {
                                        var fileUrl = "<?= asset('') . '/'?>" + item.file_url;
                                    }


                                    resultDoc += ' <div class="media-custom"> <div class="media-left"> <a href="' + fileUrl + '" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png" alt="' + item.alt_image + '" class="img-fluid"></a> </div><div class="media-body"> <a href="' + fileUrl + '" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> <a href="' + fileUrl + '" class="add-basket" target="_blank">Hent</a> </div></div>';
                                } else {
                                    resultDoc += ' <div class="media-custom"> <div class="media-left"> <a href="' + fileUrl + '" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png" alt="' + item.alt_image + '" class="img-fluid"></a> </div><div class="media-body"> <a href="' + fileUrl + '" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div></div>';
                                }
                            }
                        });

                        data.page.contents.data.forEach(function (item) {
                            z++;
                            if (x <= 3) {
                                resultPage += ' <div class="media-custom"> <div class="media-left"> <a href="' + item.link + '" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png"  alt="' + item.alt_image + '" class="img-fluid"></a> </div><div class="media-body"> <a href="' + item.link + '" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> </div></div>';
                            }
                        });

                        $('#searchPage').html(resultPage);
                        $('#searchDoc').html(resultDoc);
                        $('#checkCounting').html(checkCounting(data.totalProducts))
                        $('#contentCounting').html(checkCounting(data.totalProducts))
                        $('#checkPageCounting').html(checkCounting(data.page.totalCount))
                        $('#searchData').html(resultData);
                        $('#modelResultCount').html(data.totalProducts)
                        $('#modelContentResultCount').html(data.content.totalCount)
                        $('#modelPageResultCount').html(data.page.totalCount)
                    }
                });
            }
        });

    })

    $('.alle-resultater').click(function () {
        var route = "<?= url('/search-produkt')?>?name=" + $('.search').val();
        window.location.href = route;
    })
</script>

<script>
    $(document).ready(function () {
        $('.bestil button').html();
        $('#searchButton').click(function () {
            var searchData = $('#search').val();
            if (searchData.length > 0) {
                window.location.href = "<?= url('/search-produkt?name=')?>" + searchData;
            }
        });

        $('.seeAll').click(function () {
            console.log($('#searchright').val())
            //window.location.href = "<?= url('/search-produkt?name=')?>" + $('#searchright').val();
        })
    })
</script>

<script>
    function searchaddCart(data) {
        var api_id = $('.' + data).attr('id');
        var simNumber = null

        $.ajax({
            type: "POST",
            url: "<?= route('cart_add_subscription')?>",
            // data: "api_id=" + api_id + '&_token=<?= csrf_token()?>'+'&qty='+$('#antal').val()+'&unitPrice='+$('.unitPrice').html()+'&sellPrice='+$('.sellPrice').html(), // For Static Code
            data: 'phy_productId=' + data + '&_token=<?= csrf_token()?>' + '&qty=1&simNumber=' + simNumber,
            beforeSend: function () {
                $("#pre-loader").removeClass('d-none');
            },
            success: function (data) {
                if (data == 200) {
                    toastMixin.fire({
                        title: 'Product has been successfully added to your basket',
                        icon: 'success'
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);
                }

                if (data.status == 3) {
                    toastMixin.fire({
                        title: data.message,
                        icon: 'error'
                    });
                    setTimeout(function () {
                        window.location.href = "<?= url('') . '/login-register'?>";
                    }, 4000);
                } else {
                    window.location.reload();
                }
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $("#landmailingForm").validate({
        rules: {
            email: {
                required: true,
            },
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "<?= url('landmailing-mailchimp')?>",
                data: "email=" + $('#landmailingForm input').val() + '&_token=<?= csrf_token()?>',
                success: function (data) {
                    if (data.status == 200) {
                        $('.mod-status').html(data.message);
                        $('#successModal').modal('show');
                    } else {
                        $('.mod-status').html(data.message);
                        $('#failedModal').modal('show');
                    }
                    $('#landmailingForm').trigger("reset");
                }
            });
            return false;
        }
    });
</script>

<script>

    $("#forgotPass").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "<?= url('forgotPass')?>",
                data: "email=" + $('#forgotEmail').val() + '&_token=<?= csrf_token()?>',
                success: function (data) {
                  location.reload();
                }
            });
            return false;
        }
    });
</script>

<script>
    $("#landburgForm").validate({
        rules: {
            email: {
                required: true,
            },
        }, errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "<?= url('landburg-mailchimp')?>",
                data: "email=" + $('#landburgForm input').val() + '&_token=<?= csrf_token()?>',
                success: function (data) {
                    if (data.status == 200) {
                        $('.mod-status').html(data.message);
                        $('#successModal').modal('show');
                    } else {
                        $('.mod-status').html(data.message);
                        $('#failedModal').modal('show');
                    }

                    $('#landburgForm').trigger("reset");
                }
            });
            return false;
        }
    });
</script>
<script>
    var toastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: false,
        position: 'center-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    document.querySelector(".first").addEventListener('click', function () {
        Swal.fire({
            toast: true,
            icon: 'success',
            title: 'Posted successfully',
            animation: false,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    });

    document.querySelector(".second").addEventListener('click', function () {
        toastMixin.fire({
            animation: true,
            title: 'Signed in Successfully'
        });
    });

    document.querySelector(".third").addEventListener('click', function () {
        toastMixin.fire({
            title: 'Wrong Password',
            icon: 'error'
        });
    });

</script>
<script>
    $("#blivForm").validate({
        rules: {
            password: "required",
            email: {
                required: true,
            },
            phoneNumber: {
                required: true,
                number: true,
            },
        },
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "<?= route('sendEmail_kontakt')?>",
                data: new FormData($("#blivForm")[0]),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastMixin.fire({
                            title: data.message,
                            icon: 'success'
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                    } else {
                        toastMixin.fire({
                            title: data.message,
                            icon: 'error'
                        });
                    }
                }
            });
            return false;
        }
    });
</script>

<script>
    $("#konkatForm").validate({
        rules: {
            password: "required",
            email: {
                required: true,
            },
            phoneNumber: {
                required: true,
                number: true,
            },
        },
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "<?= route('sendEmail_kontakt')?>",
                data: new FormData($("#konkatForm")[0]),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastMixin.fire({
                            title: data.message,
                            icon: 'success'
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 4000);
                    } else {
                        toastMixin.fire({
                            title: data.message,
                            icon: 'error'
                        });
                    }
                }
            });
            return false;
        }
    });
</script>

</body>
</html>
