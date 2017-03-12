<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>EcoProjct</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html" charset="utf-8">
        <meta content="" name="species - habitat in Italy" />
        <meta content="" name="Ivan Bernabucci" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp; subset=all' rel='stylesheet' type='text/css'>
             
        <link href="{!! asset('output/final.css') !!}" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>

    <body class="c-layout-header-fixed c-layout-header-mobile-fixed">
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
        <!-- BEGIN: HEADER -->
        <header class="c-layout-header c-layout-header-4 c-layout-header-default-mobile" data-minimize-offset="80">
            <div class="c-navbar">
                <div class="container">
                    <!-- BEGIN: BRAND -->
                    <div class="c-navbar-wrapper clearfix">
                        <div class="c-brand c-pull-left">
                            <a href="index.html" class="c-logo">
                                <img src="{!! asset('images/logoNaturaItaliaHome_medium.png') !!}" alt="JANGO" class="c-desktop-logo">
                                <img src="{!! asset('images/logoNaturaItaliaHome_medium.png') !!}" alt="JANGO" class="c-desktop-logo-inverse">
                                <img src="{!! asset('images/logoNaturaItaliaHome_medium.png') !!}" alt="JANGO" class="c-mobile-logo"> </a>
                            <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                            </button>
                            <button class="c-topbar-toggler" type="button">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <!-- END: BRAND -->
                        <!-- BEGIN: QUICK SEARCH -->
                        <form class="c-quick-search" action="#">
                            <input type="text" name="query" placeholder="Type to search..." value="" class="form-control" autocomplete="off">
                            <span class="c-theme-link">&times;</span>
                        </form>
                        <!-- END: QUICK SEARCH -->
                        <!-- BEGIN: HOR NAV -->
                        <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
                        <!-- BEGIN: MEGA MENU -->
                        <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
                        <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
                            <ul class="nav navbar-nav c-theme-nav">
                                <li class="c-active">
                                    <a href="{{ route('home') }}" class="c-link dropdown-toggle">Home</a>                
                                </li>
                                <li>
                                    <a href="{{ route('contesto-riferimento') }}" class="c-link dropdown-toggle">Contesto di Riferimento</a>                
                                </li>
                                <li class="c-menu-type-classic">
                                    <a href="javascript:;" class="c-link dropdown-toggle">Specie
                                        <span class="c-arrow c-toggler"></span>
                                    </a>
                                    <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                                        <li>
                                            <a href="species-basic-search.html">Ricerca Base</a>
                                        </li>
                                        <li>
                                            <a href="home-header-1-ext.html">Ricerca Avanzata</a>
                                        </li>
                                        <li>
                                            <a href="home-header-2.html">Ricerca Cartografica</a>
                                        </li>                                      
                                    </ul>
                                </li>
                                <li class="c-menu-type-classic">
                                    <a href="javascript:;" class="c-link dropdown-toggle">Habitat
                                        <span class="c-arrow c-toggler"></span>
                                    </a>
                                    <ul class="dropdown-menu c-menu-type-classic c-pull-left">
                                        <li>
                                            <a href="species-basic-search.html">Ricerca Base</a>
                                        </li>
                                        <li>
                                            <a href="home-header-1-ext.html">Ricerca Avanzata</a>
                                        </li>
                                        <li>
                                            <a href="home-header-2.html">Ricerca Cartografica</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('downloads') }}" class="c-link">Download</a>                
                                </li>
                                <li>
                                    <a href="{{ route('links') }}" class="c-link">Link</a>                
                                </li>
                            </ul>
                        </nav>
                        <!-- END: MEGA MENU -->
                        <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
                        <!-- END: HOR NAV -->
                    </div>
                    <!-- BEGIN: LAYOUT/HEADERS/QUICK-CART -->
                    <!-- BEGIN: CART MENU -->
                    
                    <!-- END: LAYOUT/HEADERS/QUICK-CART -->
                </div>
            </div>
        </header>
        <!-- END: HEADER -->
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->
        
        
        <!-- BEGIN: PAGE CONTAINER -->
        <div class="c-layout-page">
            <!-- BEGIN: PAGE CONTENT -->
            <!-- BEGIN: LAYOUT/SLIDERS/REVO-SLIDER-4 -->
            @yield('content')
            
            <!-- END: CONTENT/TABS/TAB-1 -->
            
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-6 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-6 c-bg-grey-1">
            <div class="c-postfooter c-bg-dark-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 c-col">
                            <p class="c-copyright c-font-grey">2015 &copy; JANGO
                                <span class="c-font-grey-3">All Rights Reserved.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-6 -->
        <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END: LAYOUT/FOOTERS/GO2TOP -->
        <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
        <!-- BEGIN: CORE PLUGINS -->
        <!--[if lt IE 9]>
  <script src="../assets/global/plugins/excanvas.min.js') !!}"></script> 
  <![endif]-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWmknJ23y9FJ6i3EUXhZHGUDB2QEbSPXE"></script> 
        <script src="{!! asset('output/final.js') !!}" type="text/javascript"></script>
        
        <script>
            $(document).ready(function()
            {
                App.init(); // init core    
            });
        </script>
        <!-- END: THEME SCRIPTS -->
       @yield('added-scripts')
        <!-- END: LAYOUT/BASE/BOTTOM -->
    </body>

</html>