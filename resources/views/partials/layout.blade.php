<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ecology Project</title>
    <link href="{!! asset('output/final.css') !!}" media="all" rel="stylesheet" type="text/css" />

</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Project LOGO</strong>
                             </span> <span class="text-muted text-xs block">User active <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="#">Logout</a></li>
                            </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="active">
                    <a href="{{ route('api.species.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Search by Species</span></a>
                </li>
                <li>
                    <a href="{{ route('api.cellcodes.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Search by Cell</span> </a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <!-- <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div> -->
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="#">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            @yield('content')
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> mimi eDesign &copy; 2014-2017
            </div>
        </div>

    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWmknJ23y9FJ6i3EUXhZHGUDB2QEbSPXE"
    async defer></script> 
<script src="{!! asset('output/final.js') !!}"></script>
@yield('added-scripts')


</body>

</html>