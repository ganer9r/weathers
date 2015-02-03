<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My AngularJS App</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <script src="assets/bower_components/angular/angular.js"></script>
    <script src="assets/bower_components/angular-animate/angular-animate.min.js"></script>
    <script src="assets/bower_components/angular-aria/angular-aria.min.js"></script>
    <script src="assets/bower_components/angular-route/angular-route.js"></script>

    <script src="assets/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="assets/bower_components/angular-sanitize/angular-sanitize.min.js"></script>
    <script src="assets/bower_components/ng-table/ng-table.min.js"></script>
    <script src="assets/bower_components/ng-file-upload/angular-file-upload.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link media="all" type="text/css" rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- link media="all" type="text/css" rel="stylesheet" href="http://class.iamclass.net/bootstrap/css/animate.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://class.iamclass.net/bootstrap/css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://class.iamclass.net/bootstrap/css/font.css">
    <link media="all" type="text/css" rel="stylesheet" href="http://class.iamclass.net/bootstrap/css/plugin.css" -->
    <link media="all" type="text/css" rel="stylesheet" href="assets/style.css">
    <style>
        nav a {color: #aaa;}
        body > .header .logos {
            float: left;
            font-size: 20px;
            line-height: 50px;
            text-align: center;
            padding: 0 10px;
            width: 220px;
            font-weight: 500;
            height: 50px;
            display: block;
            color:#fff;
            background:#333;
        }
        aside .sidebar-menu a{color:#555;}
        aside .sidebar-menu li.active{background:#aaaab7; font-weight: bold;}
        aside .sidebar-menu li:hover{background:#ccccd5; font-weight: bold;}
        body > .header .navbar .sidebar-toggle .icon-bar {
            background: #aaa;
        }
        body > .header .navbar .sidebar-toggle:hover .icon-bar {
            background: #f6f6f6;
        }

        header.header, .left-side {position:fixed;}
        header.header {width:100%;}


        .right-side > .content-header {
            position: relative;
            padding: 15px 15px 10px 20px;
            margin-top:50px;
        }
        nav.navbar.navbar-default{background:#dde5dd;}
        .right-side > .content-header h1 {
            margin: 10px;
            font-size: 24px;
        }
        .right-side > .content-header h1 > small {
            font-size: 15px;
            display: inline-block;
            padding-left: 4px;
            font-weight: 300;
        }
        .right-side > .content-header .breadcrumb {
            float: right;
            background: transparent;
            margin-top: 0px;
            margin-bottom: 0;
            font-size: 12px;
            padding: 7px 5px;
            position: absolute;
            top: 15px;
            right: 10px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }
        .right-side > .content-header .breadcrumb > li > a {
            color: #444;
            text-decoration: none;
        }
        .right-side > .content-header .breadcrumb > li > a > .fa,
        .right-side > .content-header .breadcrumb > li > a > .glyphicon,
        .right-side > .content-header .breadcrumb > li > a > .ion {
            margin-right: 5px;
        }
        .right-side > .content-header .breadcrumb > li + li:before {
            content: '>\00a0';
        }
        @media screen and (max-width: 767px) {
            .right-side > .content-header > .breadcrumb {
                position: relative;
                margin-top: 5px;
                top: 0;
                right: 0;
                float: none;
                background: #efefef;
            }
        }
    </style>

</head>
<body  layout="row">
    <header class="header">
        <div ng-include="'apps/views/header.html'"></div>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left" id="main" ui-view></div>


@foreach ($scripts as $js)
    <script src="{{ $js }}"></script>
@endforeach
</body>
</html>
