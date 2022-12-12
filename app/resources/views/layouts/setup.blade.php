<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lineblocs setup</title>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    body {
    font-family: "Lato", sans-serif;
}



.main-head{
    height: 150px;
    background: #FFF;
   
}

.nav {
    height: 20%;
    background-color: #f4fdfd;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .nav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .setup-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 0%; 
    }

    .nav{
        width: 100%;
        top: 0;
        left: 0;
    }

    .setup-form{
        width: 500px;
        margin: 30px auto;
    }

    .register-form{
    }
}


.setup-main-text{
    color: #000;
    margin: 0 auto;
    width: 200px;
}

.setup-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #f4fdfd;
    color: #000;
}
</style>

<div class="nav">
        <div class="setup-main-text">
            <div class="row">
                <div class="pull-left">
                    <img src="/img/Logo-Comp_03.png" width="64" />
                </div>
                <div class="pull-left">
                <h2>Setup</h2>
            </div>
        </div>
        </div>
    </div>
@if(Session::has('message'))
<div class="alert alert-{{ Session::get('type', 'info') }}" role="alert">
{{ Session::get('message') }}
</div>
@endif
@yield('content')
</body>
</html>
