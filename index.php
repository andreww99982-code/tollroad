<?php
session_start(); $cfg=require __DIR__.'/config.php'; $tolls=require __DIR__.'/data/tolls.php';
$_SESSION['csrf'] ??= bin2hex(random_bytes(16));
?><!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>EuroToll — Vignettes & Toll Roads in Europe</title><link rel="icon" type="image/png" href="assets/favicon.png"><link rel="stylesheet" href="assets/site.css"></head>
<body>
<header class="nav">
<a class="brand" href="#"><img src="assets/favicon.png"><span>EuroToll<small>Travel across Europe</small></span></a>
<nav><a href="#buy">Vignettes</a><a href="#routes">Toll Roads</a><a href="#coverage">Countries</a><a href="#guide">Help & FAQ</a><a href="#updates">News</a></nav>
<div class="navRight"><button id="language">◉ EN⌄</button><button class="round">♙</button><a class="orders" href="#orders">▣ My Orders</a></div>
</header>

<section class="hero">
<img class="heroImg" src="assets/images/hero.jpg">
<div class="heroShade"></div>
<div class="heroText"><h1>Official Vignettes<br>& Toll Roads in Europe</h1><p>Fast. Secure. Official.<br>One purchase for your perfect journey.</p>
<div class="heroBenefits">
<div><img src="assets/images/icon_secure.png"><span><b>Official & Secure</b>We work with official<br>partners in each country.</span></div>
<div><img src="assets/images/icon_instant.png"><span><b>Instant Delivery</b>Your vignette is valid<br>immediately after purchase.</span></div>
<div><img src="assets/images/icon_support.png"><span><b>24/7 Support</b>We are here to help you<br>all the time.</span></div>
</div></div>

<div class="tripCard" id="buy"><h3>Plan your trip</h3>
<label>Select country<select id="country"></select></label>
<label>Vehicle type<select id="vehicle"><option value="car">🚗 Car</option><option value="motorcycle">🏍 Motorcycle</option><option value="camper">🚐 Camper / Motorhome</option><option value="van">🚚 Van</option><option value="truck">🚛 Truck / Bus</option><option value="trailer">🚛 Truck + Trailer</option></select></label>
<label>Start date<input id="start" type="date"></label><button id="show">Show Prices <b>›</b></button></div>

<div class="popular"><h3>Popular Vignettes</h3>
<div class="pop"><i>🇦🇹</i><span>Austria<small>10-Day Vignette</small></span><strong>€10.88</strong></div>
<div class="pop"><i>🇨🇭</i><span>Switzerland<small>Annual Vignette</small></span><strong>CHF 34.00</strong></div>
<div class="pop"><i>🇨🇿</i><span>Czech Republic<small>10-Day Vignette</small></span><strong>CZK 255</strong></div>
<div class="pop"><i>🇸🇰</i><span>Slovakia<small>30-Day Vignette</small></span><strong>€14.54</strong></div>
<div class="pop"><i>🇸🇮</i><span>Slovenia<small>7-Day Vignette</small></span><strong>€13.60</strong></div>
<div class="pop"><i>🇭🇺</i><span>Hungary<small>10-Day D1</small></span><strong>HUF 5,865</strong></div><a href="#coverage">View all countries ›</a></div>
</section>

<section class="trustbar">
<div><img src="assets/images/icon_languages.png"><b>13 Languages<small>Automatic detection</small></b></div>
<div><img src="assets/images/icon_vehicles.png"><b>All Vehicle Types<small>Cars, motorcycles,<br>trucks and more</small></b></div>
<div><img src="assets/images/icon_trusted.png"><b>Trusted Provider<small>Official sources<br>and partners</small></b></div>
<div><img src="assets/images/icon_guarantee.png"><b>Best Price Guarantee<small>No hidden fees</small></b></div>
<div><img src="assets/images/icon_mobile.png"><b>Mobile Friendly<small>Buy on the go</small></b></div>
<div class="secure">♧ <b>SECURE PAYMENT<small>SSL Encrypted</small></b></div><div class="cards">VISA　●●　Pay　G Pay</div>
</section>

<main>
<section class="columns" id="guide">
<div class="how panel"><h2>How it works</h2><div class="steps">
<article><img src="assets/images/how_country.jpg"><em>1</em><b>Choose your country</b><p>Select the country you are travelling to.</p></article>
<article><img src="assets/images/how_vehicle.jpg"><em>2</em><b>Select your vehicle</b><p>Enter vehicle details and choose validity.</p></article>
<article><img src="assets/images/how_pay.jpg"><em>3</em><b>Pay securely</b><p>We accept multiple secure payment methods.</p></article>
<article><img src="assets/images/how_drive.jpg"><em>4</em><b>Receive & drive</b><p>Get your vignette by email. You are all set!</p></article>
</div></div>
<div class="why panel"><h2>Why choose EuroToll?</h2><div class="whybody"><div class="reasons">
<p>◉ <span><b>Official Vignettes</b>Only from authorized partners</span></p>
<p>◉ <span><b>Wide Coverage</b>All major European countries</span></p>
<p>◉ <span><b>Save Time & Money</b>No queues, no paperwork</span></p>
<p>◉ <span><b>Instant Email Delivery</b>Ready to use in minutes</span></p>
<p>◉ <span><b>Environment Friendly</b>Go paperless, travel green</span></p></div><img src="assets/images/map.jpg"></div></div>
<div class="updates panel" id="updates"><h2>News & Updates <a>View all</a></h2>
<article><img src="assets/images/news_switzerland.jpg"><span><b>New toll rates in Switzerland</b><small>Jan 1, 2026</small><p>Annual vignette price remains CHF 40.00 before our 15% offer.</p></span></article>
<article><img src="assets/images/news_czech.jpg"><span><b>Changes in Czech Republic</b><small>Dec 15, 2025</small><p>Review eco-friendly vehicle categories for 2026.</p></span></article>
<article><img src="assets/images/news_hungary.jpg"><span><b>Hungary toll system update</b><small>Nov 30, 2025</small><p>Check the latest e-vignette categories.</p></span></article></div>
</section>

<section class="route panel" id="routes"><div><h2>Route-Based Tolls</h2><p>Plan your route and calculate toll costs for countries with route-based toll systems.</p><button onclick="routeInfo()">Calculate Route</button></div><img src="assets/images/route.jpg"></section>

<section class="vehicles" id="coverage"><h2>All vehicle types</h2><div class="vehicleRow">
<?php foreach([['Motorcycle','From €3.23','vehicle_motorcycle.jpg'],['Car','From €8.16','vehicle_car.jpg'],['Camper / Motorhome','From €13.60','vehicle_camper.jpg'],['Van','From €10.88','vehicle_van.jpg'],['Truck / Bus','From €14.54','vehicle_truck.jpg'],['Truck + Trailer','Route based','vehicle_trailer.jpg']] as $v):?>
<article><small><?=$v[0]?></small><b><?=$v[1]?></b><img src="assets/images/<?=$v[2]?>"></article><?php endforeach;?>
</div></section>

<section class="help panel"><div><h2>Need help?</h2><p>Our support team is here for you 24/7.</p><button onclick="alert('Configure your support address/helpdesk in the production deployment.')">Contact Support　♧</button></div><img src="assets/images/support.jpg"></section>
</main>
<footer><b>EuroToll</b><span>Independent toll information & purchase interface. Not affiliated with national road authorities.</span><span>© 2026 EuroToll. All rights reserved.</span></footer>

<script>window.TOLLS=<?=json_encode($tolls,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)?>;window.CSRF=<?=json_encode($_SESSION['csrf'])?>;window.DISCOUNT=<?=json_encode($cfg['discount_percent'])?>;</script>
<script src="assets/app.js"></script>
</body></html>