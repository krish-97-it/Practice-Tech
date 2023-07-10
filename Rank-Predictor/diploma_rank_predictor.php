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
                            <thead id="custom-table-head" class="custom-table-head" load-table-heading>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Code</th>
                                    <th>College Name</th>
                                    <th>College Type</th>
                                    <th>Course Offered</th>
                                    <th>District</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Website</th>
                                    <th>Avg. Tution Fees</th>
                                </tr>
                            </thead>
                            <thead id="filter-table-head" class="filter-table-head" load-table-heading>
                                <tr role="row">
                                    <th rowspan="2" colspan="1" aria-label="Sl No.">Sl No.</th>
                                    <th rowspan="2" colspan="1" aria-label="Institute">Institute</th>
                                    <th rowspan="2" colspan="1" aria-label="Branch">Branch</th>
                                    <th rowspan="2" colspan="1" aria-label="Type">Type</th>
                                    <th rowspan="2" colspan="1" aria-label="Total Available Seats" aria-sort="ascending">Total Available Seats</th>
                                    <th colspan="12" style="text-align: center;" rowspan="1">STATE QUOTA CUT-OFF RANK - 2021<br>(Rank shown below are General Rank)</th>
                                </tr>
                                <tr role="row">
                                    <th rowspan="1" colspan="1" aria-label="GEN">GEN</th>
                                    <th rowspan="1" colspan="1" aria-label="SC">SC</th>
                                    <th rowspan="1" colspan="1" aria-label="ST">ST</th>
                                    <th rowspan="1" colspan="1" aria-label="OBC-">OBC-A</th>
                                    <th rowspan="1" colspan="1" aria-label="OBC-">OBC-B</th>
                                    <th rowspan="1" colspan="1" aria-label="PC">PC</th>
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

            <!-- Rank predictor modal to take input from user -->
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
                                                    <label>College Type</label><span class="required-asterisk"><b>*</b></span>
                                                    <select name="collegeType" class="form-control" onchange="COLLEGE_BRANCH_PREDICTOR.basicRequiredValidation(this,'','College type')" onblur="COLLEGE_BRANCH_PREDICTOR.basicRequiredValidation(this,'','College type')">
                                                        <option value="" default selected>Any</option>
                                                        <option value="GOVERNMENT">Government</option>
                                                        <option value="PRIVATE">Private</option>
                                                        <option value="GOVERNMENT SPONSORED">Government Sponsored</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>District</label>
                                                    <select name="districtList" class="form-control">
                                                        <option value="" default selected>Any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>College Preference</label>
                                                    <select name="collegeList" class="form-control" id='college-list'>
                                                        <option value="" default selected>Any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 expected-percentile-btn" style="text-align:center; margin-top: 20px;">
                                                <button type="button" class="btn" style="background-color:purple; color:white; padding:6px 20px !important;" data-next-btn>View Cut-Off</button>
                                                <button type="button" class="btn" style="background-color:orange; color:white; padding:6px 20px !important;" data-search-college>Search A College</button>
                                            </div>
                                            <div class="col-md-12" style="color:red; text-align: center; font-weight:600;">
                                                <span show-error-msg></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item subject-rank">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rank Type</label><span class="required-asterisk"><b>*</b></span>
                                                    <select name="rank-type" class="form-control" onchange="COLLEGE_BRANCH_PREDICTOR.basicRequiredValidation(this,'','Rank type/category')" onblur="COLLEGE_BRANCH_PREDICTOR.basicRequiredValidation(this,'','Rank type/category')">
                                                        <option value="" default selected>Any</option>
                                                        <option value="GEN">General</option>
                                                        <option value="SC">SC</option>
                                                        <option value="ST">ST</option>
                                                        <option value="OBCA">OBC-A</option>
                                                        <option value="OBCB">OBC-B</option>
                                                        <option value="PC">PC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Enter Your Rank</label><span class="required-asterisk"><b>*</b></span>
                                                    <input class="form-control" type="text" maxlength="5" name="user-rank" onchange="COLLEGE_BRANCH_PREDICTOR.numericValidation(this)" onblur="COLLEGE_BRANCH_PREDICTOR.numericValidation(this)" placeholder="Enter Your Rank" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Select Subject</label>
                                                    <select name="subjectList" class="form-control">
                                                        <option value="" default selected>Any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 expected-percentile-btn" style="text-align:center; margin-top: 20px;">
                                                <button type="button" class="btn" style="background-color:purple; color:white; padding:6px 20px !important;" data-back-btn>Back</button>
                                                <button type="button" class="btn" style="background-color:blue; color:white; padding:6px 20px !important;" data-predict-btn>Next</button>
                                            </div>
                                            <div class="col-md-12" style="color:red; text-align: center; font-weight:600;">
                                                <span error-msg-rank></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item registe-page">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div><label>Full Name</label><span class="required-asterisk">*</span></div>
                                                    <input id="fullName" name="user-name" class="form-control" type="text" placeholder="Name" onchange="COLLEGE_BRANCH_PREDICTOR.nameValidation(this)" onblur="COLLEGE_BRANCH_PREDICTOR.nameValidation(this)" value="" autocomplete="off" maxlength="245"  required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div><label>Phone</label><span class="required-asterisk">*</span></div>
                                                    <input id="userPhone" name="user-phone" class="form-control" type="tel" pattern="[789][0-9]{9}" placeholder="Phone No." onchange="COLLEGE_BRANCH_PREDICTOR.phoneValidation(this)" onblur="COLLEGE_BRANCH_PREDICTOR.phoneValidation(this)" value="" autocomplete="off" maxlength="10" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div><label>Email</label><span class="required-asterisk">*</span></div>
                                                    <input id="email-id" name="user-email" class="form-control" type="text" placeholder="Email-id" onchange="COLLEGE_BRANCH_PREDICTOR.emailValidation(this,'true')" onblur="COLLEGE_BRANCH_PREDICTOR.emailValidation(this,'true')" value="" autocomplete="off" maxlength="245" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group name-form-group" data-name-field="">
                                                    <div><label>Address</label><span class="required-asterisk">*</span></div>
                                                    <input id="address" name="user-address" class="form-control" type="text" placeholder="Address" onchange="COLLEGE_BRANCH_PREDICTOR.basicRequiredValidation(this,'','Address')" onblur="COLLEGE_BRANCH_PREDICTOR.basicRequiredValidation(this,'','Address')" value="" autocomplete="off" maxlength="245" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-12 expected-percentile-btn" style="text-align:center; margin-top: 20px;">
                                                <button type="button" class="btn" style="background-color:purple; color:white; padding:6px 20px !important;" data-back-btn>Back</button>
                                                <button type="button" class="btn" style="background-color:purple; color:white; padding:6px 20px !important;" data-search-btn>Submit</button>
                                            </div>
                                            <div class="col-md-12" style="color:red; text-align: center; font-weight:600;">
                                                <span show-error-msg-two></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn" style="background-color:#0a9f06; color:white; padding:6px 20px !important;" data-view-full-list>College Lists</button>
                        <button type="button" class="btn" style="background-color:red; color:white; padding:6px 20px !important;" data-clear-btn>Clear</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- College Info Modal -->
            <div class="modal fade" id="collegeInfo" role="dialog" data-backdrop="static" data-keyboard="false" modal-content-college-Info>
                <!-- append from js -->
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