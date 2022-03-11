<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DEMO PAGE</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://cdn1.byjus.com/byjusweb/css/custom-bootstrap.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/index-page.css"/>
    </head>

    <body>
<!-- Map Section -->
        <section class="map-section blc-section full-width">
            <div class="col-md-12">
                <div class="blc-container">
                    <div class="row">
                        <div class="col-sm-12 map-heading-section">
                            <div class=row>
                                <div class="col-sm-12">
                                    <h2 class="blc-section-heading faq-heading"><a name="find-a-center"></a>Find a centre near you</h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="blc-section-heading-border"></div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="below-heading-text map-heading-txt">
                                        Look for your nearest centre to provide your child with an all-inclusive classroom experience 
                                        Use my current location  OR  Search 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="blc-map-section">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="map" class="map">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d24820906.349476207!2d82.23764155786013!3d23.619282615018175!3m2!1i1024!2i768!4f13.1!2m1!1sByjus%20Learning%20Centers%20in%20India!5e0!3m2!1sen!2sin!4v1643970893628!5m2!1sen!2sin" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="Fast"></iframe>
                                            <!-- <iframe src="https://maps.google.com/maps?q=19.0760° N, 72.8777° E&z=15&output=embed" width="100%" height="auto" frameborder="0" style="border:0"></iframe> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 city-select-details">
                                        <div class="map-city-selector">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-6 state-col">
                                                    <select name="state" id="stateSel" size="1" class="state-city state-list" required>
                                                        <option value="" disabled selected>Select State</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 col-xs-6 city-col">
                                                    <select name="city" id="citySel" size="1" class="state-city city-list" required>
                                                        <option value="" disabled selected>Select City</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 current-location">
                                                    <div class="location-icon"><i class="material-icons">&#xe55c;</i></div>
                                                    <div class="location-txt">Current Location</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="location-intro">
                                            <div class="row location-intro-row">
                                                <div class="col-sm-12 byjus-center-info-section" id="byjus-center">
                                                    <p class="default-details-txt">Please Select Your State And City To Find Our Centers Near You</p>
                                                    <!-- append from js -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index-page.js"></script>