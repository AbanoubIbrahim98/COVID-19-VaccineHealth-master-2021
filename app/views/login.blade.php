<!DOCTYPE html>
<html class="bg-cover">
<head>
    <meta charset="UTF-8">
    <title>Vaccine | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    {{HTML::style("css/bootstrap.min.css") }}
    <!-- font Awesome -->
    {{HTML::style("css/font-awesome.min.css") }}
    <!-- Ionicons -->
    {{HTML::style("css/ionicons.min.css") }}
    <!-- Theme style -->
    {{HTML::style("css/AdminLTE.css") }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{HTML::script("js/html5shiv.js")}}
    {{HTML::script("js/respond.min.js")}}
    <![endif]-->
    <style>
        #login-box{
            border: solid 2px #8FB0BD;
            padding: 15px;
            padding-bottom: 15px;
            padding-top: 15px;
            border-radius: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<!-- Kizito's the body bg-cover was bg-gray before -->
<body class="bg-cover">
<div class="row"><div class="col-md-6 col-md-offset-4 img-responsive text-title text-left" id="" style="padding-top:120px">
        <h2 class="lead" style="font-size:32px ">Vaccine Tracking Management System</h2></div></div>
<div class="col-md-6 col-md-offset-3" id="login-box">
    <div class="col-xs-6" style="margin-top: 10px">


        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="border-radius: 18px">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{ asset('img/login-bg-1.jpg') }}" class="img-rounded img-responsive" style="width: 295px;height: 240px "/>
                </div>
                <div class="item">
                    <img src="{{ asset('img/front-bg.png') }}" class="img-rounded img-responsive" style="width: 295px;height: 240px "/>
                </div>
                <div class="item">
                    <img src="{{ asset('img/vacc.jpg') }}" class="img-rounded img-responsive" style="width: 295px;height: 240px "/>
                </div>

            </div>

        </div>
<script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 2000
        })
    })
</script>

    </div>
    <div class="col-xs-6">
    <div class="header-mod"><h4>Sign In</h4>
    </div>
    @if(isset($error))
    <div class="alert alert-danger alert-dismissable" style="padding: 5px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ $error }}!</strong>
    </div>
    @endif
    <form method="post" action="{{ url('login') }}" style="" autocomplete="off">
        <div class="body bg-none"> <!-- Kizito's: it was bg-aqua -->
            <div class="form-group">
                <input type="text" name="email" class="form-control transparent-input" placeholder="User ID" />
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control transparent-input" placeholder="Password"/>
            </div>
            <div class="form-group">
                <input type="checkbox" name="keep" title="Save my login information" value="keep"/>
                <span class="text-info">Remember me</span>
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-grey btn-block big-button">Sign In</button>

            <p><a href="#"></a></p>

            <a href="{{ url('password/remind/') }}" class="text-center">Forget password</a>
        </div>
    </form>

    </div>
</div>


<!-- jQuery 2.0.2 -->
{{HTML::script("js/jquery.min.js")}}
<!-- Bootstrap -->
{{HTML::script("bootstrap/js/bootstrap.min.js")}}

</body>
</html>