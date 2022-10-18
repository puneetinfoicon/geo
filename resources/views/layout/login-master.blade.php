<!DOCTYPE html>
<html lang="en">

<head>
    <title>Geoteam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</head>

<body>


@yield('content')


<style>
    p.forget_pass a {
        font-size: 12px;
        color: #1b4f83;
    }

    .login-page {
        width: 360px;
        padding: 12% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #1b4f83;
        width: 100%;
        margin-top: 10px;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
        background: #1b4f83;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #1b4f83;
        text-decoration: none;
    }

    .form .register-form {
        display: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before,
    .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    body {
        background: #76b852;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #76b852, #8DC26F);
        background: -moz-linear-gradient(right, #76b852, #8DC26F);
        background: -o-linear-gradient(right, #76b852, #8DC26F);
        background: linear-gradient(to left, #1b4f83, #b5d7f9);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }


    .foo.text-center {
        padding: 10px 0px 20px;
    }


    div#myModal11 {
        background: #00000073;
    }
</style>


<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    $('.message a').click(function () {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });
</script>


<!-- Forget Password Model Start-->
<div class="modal fade" id="myModal11">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <form class="login-form" action="{{route('submitForgetPassword')}}" method="post">

                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Forget Password</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Email:</label>
                        <input type="email" name="email" class="form-control" id="usr">
                    </div>
                </div>

                <div class="foo text-center">
                    <input type="submit" class="btn btn-primary">
                </div>

            </form>
        </div>

    </div>

</div>
<!-- Forget Password Model END-->


@if(Session::has('message'))
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body text-center">
                    <p class="mb-0"><strong>{{htmlspecialchars_decode(Session::get('message')) }}</strong></p>
                </div>

            </div>

        </div>
    </div>
@endif



<!-- <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body text-center">
        <h1>Full screen Transparent Bootstrap Modal</h1>
        <p>FEEL FRREE TO GET YOUR MODAL CODE HERE FOLKS.</p>
        <a class="pre-order-btn" href="#">GET THE MODAL CODE</a>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div> -->


<style>
    .modal-body h1 {
        font-weight: 900;
        font-size: 2.3em;
        text-transform: uppercase;
    }

    .modal-body a.pre-order-btn {
        color: #000;
        background-color: gold;
        border-radius: 1em;
        padding: 1em;
        display: block;
        margin: 2em auto;
        width: 50%;
        font-size: 1.25em;
        font-weight: 6600;
    }

    .modal-body a.pre-order-btn:hover {
        background-color: #000;
        text-decoration: none;
        color: gold;
    }
</style>


<script>
    $(document).ready(function () {
        $('#myModal').modal('show');
    });
</script>


</body>

</html>
