<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://cdn1.byjus.com/byjusweb/css/custom-bootstrap.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="css/diploma_rank_predictor.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <section>
            <div class="container" style="width:auto;">
                <div class="row">
                    <div class="col-md-12">
                        <br><br><br><br><br>
                        <div class="su-box su-box-style-default" style="border:2px solid black;border-radius:3px">
                            <div class="su-box-title" style="background-color:#7960A0;color:#FFFFFF;border-top-left-radius:1px;border-top-right-radius:1px; padding:.5em 1em; font-weight:700; font-size:1.1em;">
                                <b>Diploma College/Branch Predictor</b>
                            </div>
                            <div class="su-box-content su-u-clearfix su-u-trim" style="border-bottom-left-radius:1px;border-bottom-right-radius:1px; padding:16px 16px 8px">
                                <span style="font-weight: 400;">
                                    College/Branch Prediction by Score
                                </span>
                                <P></P>
                                <button type="button" class="btn btn-primary eligibility-modal" data-toggle="modal" data-target="#myModal" style="background-color: #2B3F84 !important; border: none; color: white;">
                                    <span style="font-weight: 500;">
                                        Check Eligibilty
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:20px; margin-bottom:10px !important; text-align:end;">
                        <button class="btn primary-btn download-print hidden" data-download-btn>Download</button>
                        <button class="btn primary-btn download-print hidden" data-print-btn>Print</button>
                    </div>
                </div>
            </div>

            <!-- Starting Result table -->
            <div class="container result-table-container hidden" id="result-table-container-id" style="width:auto;">
                <h2>Detailed List Of Colleges as per WBSCTE Website</h2>
                <p>(You can download or print the list as per need)</p>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table border="1" cellpadding="6" class="table table-bordered table-striped w-auto">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Code</th>
                                    <th>College Name</th>
                                    <th>College Type</th>
                                    <th>Course Offered</th>
                                    <th>Cut Off</th>
                                    <th>District</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Website</th>
                                    <th>Avg. Tution Fees</th>
                                </tr>
                            </thead>
                            <tbody id="custom-data-table" view-data-table>
                                <!-- append from Js -->
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
            <!-- Closing Result Table -->

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">

                        <!-- Modal header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">College And Course Details</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div id="expected-percentile-carousel" data-expected-percentile-carousel class="carousel slide"
                                data-ride="" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <div class="required-asterisk"><span>*</span></div> -->
                                                    <label>Expected Rank</label>
                                                    <input class="form-control" type="text" maxlength="3"
                                                        name="expectedRank" placeholder="Expected Score upto 300">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>College Type</label>
                                                    <select name="collegeType" class="form-control">
                                                        <option value="" default selected>Any</option>
                                                        <option value="Government">Government</option>
                                                        <option value="private">Private</option>
                                                        <option value="Govt-Sponsored">Govt. Sponsered</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>College Preference</label>
                                                    <select name="collegeList" class="form-control">
                                                        <option value="" default selected>Any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>District</label>
                                                    <select name="district" class="form-control">
                                                        <option value="" default selected>Any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 expected-percentile-btn" style="text-align:center; margin-top: 20px;">
                                                <button type="button" class="btn" style="background-color:purple; color:white; padding:6px 20px !important;" data-search-btn>Search</button>
                                                <button type="button" class="btn" style="background-color:#0a9f06; color:white; padding:6px 20px !important;" data-view-full-list>View All</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item register page">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div class="required-asterisk"><span>*</span></div>
                                                    <input id="fullName" name="name" class="form-control" type="text"
                                                        placeholder="Name" value="" autocomplete="off" size="30"
                                                        maxlength="245" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div class="required-asterisk"><span>*</span></div>
                                                    <input id="fullName" name="name" class="form-control" type="text"
                                                        placeholder="Name" value="" autocomplete="off" size="30"
                                                        maxlength="245" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div class="required-asterisk"><span>*</span></div>
                                                    <input id="fullName" name="name" class="form-control" type="text"
                                                        placeholder="Name" value="" autocomplete="off" size="30"
                                                        maxlength="245" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="required-asterisk"><span>*</span></div>
                                                    <div class="select-input-box">
                                                        <select class="form-control grade-dropdown" name="grade" data-state="" required="">
                                                            <option value="" disabled selected>Grade</option>
                                                            <option value="1">Class 1</option>
                                                            <option value="2">Class 2</option>
                                                            <option value="3">Class 3</option>
                                                            <option value="4">Class 4</option>
                                                            <option value="5">Class 5</option>
                                                            <option value="6">Class 6</option>
                                                            <option value="7">Class 7</option>
                                                            <option value="8">Class 8</option>
                                                            <option value="9">Class 9</option>
                                                            <option value="10">Class 10</option>
                                                            <option value="11">Class 11</option>
                                                            <option value="12">Class 12</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item item-result-page">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-clear-btn>Clear</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- fixed floater btn -->
            <div>
                <button class="myBtn" id="myBtnTop" title="Go top" scroll-top-page style="opacity:0.5; font-size:12px; padding: 15px 20px 15px 20px;">Go<br>Up</button>
                <button class="myBtn" id="myBtnBottom" title="Go bottom" scroll-bottom-page style="opacity:0.5; font-size:12px; padding: 15px 15px 15px 15px;">Go<br>Down</button>
            </div>
        </section>
    </body>
</html>
<!-- END HTML -->

<!-- Include bootstrap script/externel js file -->
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/diploma_rank_prediictor/diploma_rank_predictor.js"></script>
<!--Rend of bootstrap script/externel js file -->
