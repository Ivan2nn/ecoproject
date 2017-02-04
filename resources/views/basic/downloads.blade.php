<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="" />
<meta name="keywords" content=""/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ISPRA</title>

<!-- =========================
 FAV AND TOUCH ICONS  
============================== -->
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="apple-touch-icon" href="images/icons/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-touch-icon-114x114.png">

<!-- =========================
     STYLESHEETS      
============================== -->
<link rel="stylesheet" href="{!! asset('output/main.css') !!}">

<!-- WEBFONT -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic|Montserrat:700,400|Homemade+Apple' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->

<!-- JQUERY -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>


<body>
<!-- =========================
   PRE LOADER       
============================== -->
<div class="preloader">
  <div class="status">&nbsp;</div>
</div>
<!-- =========================
   HOME SECTION       
============================== -->
<header id="home" class="header navbar-no-background">
	
	<!-- TOP BAR -->
	<div id="main-nav" class="navbar navbar-inverse bs-docs-nav" role="banner">
		<div class="container">
			<div class="navbar-header responsive-logo">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<div class="navbar-brand">
				<img src="images/logo.png" alt="Zerif">
				</div>
			</div>
			<nav class="navbar-collapse collapse" role="navigation" id="bs-navbar-collapse">
			<ul class="nav navbar-nav navbar-right responsive-nav main-nav-list">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('context') }}">Contesto di Riferimento</a></li>
				<li><a href="#works">Specie</a></li>
				<li><a href="#aboutus">Habitat</a></li>
				<li><a href="#">Download</a></li>
				<li><a href="#pricingtable">Link</a></li>
			</ul>
			</nav>
		</div>
	</div>
	<!-- / END TOP BAR -->
	
	
	
</header> <!-- / END HOME SECTION  -->

<!-- =========================
   FOCUS SECTION      
============================== -->

<section class="focus" id="focus">
<div class="container">
	
	<!-- 4 FOCUS BOXES -->
	<div class="row">
		
		<!-- FIRST FOCUS BOXES -->
		<div class="col-lg-9 col-sm-12">
			<article class="context-style">
			<h2>Downloads</h2>
			<p>
				<strong>
					Volume Rapporto
				</strong>
			</p>
			<p>
				<ul>
					<li>
						<a href="http://www.sinanet.isprambiente.it/it/Reporting_Dir_Habitat/rapporto/rapporto_2014_194" target="_blank"> Volume del 3° Rapporto Nazionale Direttiva Habitat – Specie e habitat di interesse comunitario in Italia: distribuzione, stato di conservazione e trend. ISPRA, Serie Rapporti, 194/2014</a>
					</li>
				</ul>
			</p>
			<p>
				<strong>
					Manuali di Monitoraggio
				</strong>
			</p>
			<p>
				<ul>
					<li>
						<a href="http://www.isprambiente.gov.it/public_files/direttiva-habitat/Manuale-141-2016.pdf" target="_blank"> Manuali per il monitoraggio di specie e habitat di interesse comunitario (Direttiva 92/43/CEE) in Italia: specie vegetali. ISPRA, Serie Manuali e linee guida, 140/2016.</a>
					</li>
					<li>
						<a href="http://www.isprambiente.gov.it/public_files/direttiva-habitat/Manuale-141-2016.pdf" target="_blank"> Manuali per il monitoraggio di specie e habitat di interesse comunitario (Direttiva 92/43/CEE) in Italia: specie animali. ISPRA, Serie Manuali e linee guida, 141/2016.</a>
					</li>
					<li>
						<a href="http://www.isprambiente.gov.it/public_files/direttiva-habitat/Manuale-141-2016.pdf" target="_blank">Manuali per il monitoraggio di specie e habitat di interesse comunitario (Direttiva 92/43/CEE) in Italia: habitat. ISPRA, Serie Manuali e linee guida, 142/2016.</a>
					</li>
				</ul>
			<p>
			<p>
				<strong>
					Approfondimenti
				</strong>
			</p>
			<p>
				<ul>
					<li>
						Risultati di test di campo (schede e mappe) degli habitat
						<ul>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/91B0_9330_9340-Attorre.zip" target="_blank">91B0_9330_9340 Attorre</a>
							</li>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/2120_2210-Acosta.zip" target="_blank">2120_2210 Acosta</a>
							</li>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/2130-Buffa.zip" target="_blank">2130 Buffa</a>
							</li>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/3150-Bolpagni.zip" target="_blank">3150 Bolpagni</a>
							</li>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/3170-Bagella.zip" target="blank">3170 Bagella</a>
							</li>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/6220-Angiolini.zip" target="_blank">6220 Angiolini</a>
							</li>
							<li>
								<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/9220-Frattaroli.zip" target="_blank">9220 Frattaroli</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/HABITAT-2330-approfondimenti.pdf" target="_blank"> Approfondimenti Habitat 2330</a>
					</li>
					<li>
						<a href="http://www.reportnatura2000.it/wp-content/uploads/2016/12/HABITAT-2330-approfondimenti.pdf" target="_blank"> Documenti e presentazioni delle discussioni in corso degli Expert Group nei meeting ottobre-novembre 2016</a>
					</li>
					<li>
						<a href="www.reportnatura2000.it/wp-content/uploads/2016/12/La-rilevanza-delle-regioni-e-PA-nella-conservazione-degli-habitat.zip" target="_blank">Studio: Indice di rilevanza di una Regione sulla conservazione di un habitat a livello biogeografico (P. Angelini e A. Grignetti)</a>
					</li>
				</ul>
			<p>
			</article>
		</div>
		
	<!-- OTHER FOCUSES -->
</div> <!-- / END CONTAINER -->
</section>  <!-- / END FOCUS SECTION -->




<!-- =========================
   FOOTER             
============================== -->

<footer>
<div class="container">
	
	<!-- COMPANY ADDRESS-->
	<div class="col-md-5 company-details">
		<div class="icon-top red-text">
		    <i class="icon-fontawesome-webfont-302"></i>
		</div>
		PO Box 16122 Collins Street West, Victoria 8007 Australia
	</div>
	
	<!-- COMPANY EMAIL-->
	<div class="col-md-2 company-details">
		<div class="icon-top green-text">
		<i class="icon-fontawesome-webfont-329"></i>
		</div>
		 contact@designlab.co
	</div>
	
	<!-- COMPANY PHONE NUMBER -->
	<div class="col-md-2 company-details">
		<div class="icon-top blue-text">
		<i class="icon-fontawesome-webfont-101"></i>
		</div>
		+613 0000 0000
	</div>
	
	<!-- SOCIAL ICON AND COPYRIGHT -->
	<div class="col-lg-3 col-sm-3 copyright">
		<ul class="social">
			<li><a href=""><i class="icon-facebook"></i></a></li>
			<li><a href=""><i class="icon-twitter-alt"></i></a></li>
			<li><a href=""><i class="icon-linkedin"></i></a></li>
			<li><a href=""><i class="icon-behance"></i></a></li>
			<li><a href=""><i class="icon-dribbble"></i></a></li>
		</ul>
		 ©2013 Zerif LLC
	</div>
</div> <!-- / END CONTAINER -->
</footer> <!-- / END FOOOTER  -->

<!-- SCRIPTS -->
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/wow.min.js"></script>
<script src="js/vendor/jquery.nav.js"></script>
<script src="js/vendor/jquery.knob.js"></script>
<script src="js/vendor/owl.carousel.min.js"></script>
<script src="js/vendor/smoothscroll.js"></script>
<script src="js/vendor/jquery.vegas.min.js"></script>
<script src="js/vendor/zerif.js"></script>

</body>
</html>