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
        <!-- <div class="container">
            <div class="modal-with-js">
                <h2>Activate Modal with JavaScript</h2>
                <button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button> -->
                <!-- Modal -->
                <!-- <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog"> -->
                    <!-- Modal content-->
                    <!-- <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                        <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">.col-md-4</div>
                                <div class="col-md-4 ml-auto">.col-md-4 .ml-auto</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 ml-auto">.col-md-3 .ml-auto</div>
                                <div class="col-md-2 ml-auto">.col-md-2 .ml-auto</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ml-auto">.col-md-6 .ml-auto</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    Level 1: .col-sm-9
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                            Level 2: .col-8 .col-sm-6
                                        </div>
                                        <div class="col-4 col-sm-6">
                                            Level 2: .col-4 .col-sm-6
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/form-modal.js"></script>