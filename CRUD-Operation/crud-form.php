<?php

$conn       =   mysqli_connect("localhost", "root", "",  "kn_web_dev");
	
$fetch_data = "select `user_id` from wp_crud";
// $result = mysqli_query($conn, $fetch_data);
$result = $conn->query($fetch_data);
while($row = mysqli_fetch_assoc($result)) {
    $get_data[] = $row;
}
$conn->close();
// foreach($get_data as $value){
// echo "id: " . $value["id"]. " - Name: " . $value["name"]. " " . $value["address"]. "<br>";
// print_r($value);
// }
?>

<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
<link href="https://cdn1.byjus.com/byjusweb/css/custom-bootstrap.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- Start HTML -->
<body>
    <div class="container">
        <h1>CRUD OPERATION</h1>
        <section class="display-record hidden">
            <div class="row">
                <div class="col-sm-12">
                    <table  class="table table-striped table-condensed" id="tblData">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Address</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td><span class="col-name"></span></td>
                              <td><span class="col-phone"></span></td>
                              <td><span class="col-email"></span></td>
                              <td><span class="col-address"></span></td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <Section class="crud-operation">
            <div class="row">
                <div class="col-sm-12">
                    <form method="post" enctype="multipart/form-data" class="userClass" data-user-bio-single-upload name="user-single-upload">
                        
                        <div class="form-group search-user-id">
                          <label for="userId">Exsisting User Id :</label><br>
                          <div class="row">
                            <div class="col-sm-10">
                              <select class="user-bio-field form-control username-dropdown-section form-control" name="searchuserId" id="username_dropdown" required>
                                  <option value="" selected>Select user id</option>
                                  <?php
                                  foreach ($get_data as $user) { ?>
                                      <option value="<?= $user["user_id"] ?>"><?= $user["user_id"] ?></option>
                                  <?php } ?>
                                  ?>
                              </select>
                            </div>
                            <div class="col-sm-2">
                              <button type="button" value="search" class="search-btn btn btn-default">Search</button><br>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="Name">Name :</label><br>
                          <input type="text" class="user-bio-field form-control name-form-field" id="user-name" name="Name" size="60" placeholder="Name"><br>
                        </div>
                        <div class="form-group">
                            <label for="Phone">Phone No. :</label><br>
                            <input type="text" class="user-bio-field form-control phone-form-field" id="user-phone" name="Phone" size="60" placeholder="Phone no."><br>
                        </div>
                        <!-- <div class="form-group">
                            <label for="userImage">user Image Url :</label><br>
                            <input type="text" class="user-bio-field form-control image-form-field" id="user_img" name="userImage" size="60" placeholder="user Image"><br>
                        </div><br> -->
                        <div class="form-group">
                            <label for="Email">Email :</label><br>
                            <input type="text" class="user-bio-field form-control image-form-field" id="user-email" name="Email" size="60" placeholder="Email"><br>
                        </div>
                        <div class="form-group">
                            <label for="Address">Address :</label><br>
                            <textarea name="Address"  class="user-bio-field form-control address-form-field" id="user-address" placeholder="Address" cols="55" rows="8"></textarea>
                        </div>
                        <div class="form-group update-user-id">
                            <label for="userId">User Id :</label><br>
                            <input type="text" class="user-bio-field form-control userid-form-field" id="user-id" name="UpdateUserId" size="60" placeholder="User id"><br>
                        </div><br>

                        <div class="dropdown">
                            <select class="user-bio-dropdown-section user-bio-field form-control" name="crud-dropdown-section" id="user-bio-dropdown" style="width:240px" required>
                                <option value="" selected>Choose an Option</option>
                                <option name="Insert" value="insert">Insert</option>
                                <option name="Update" value="update">Update</option>
                                <option name="Delete" value="delete">Delete</option>
                            </select>
                        </div>
                        <br>
                        <button type="button" value="Submit" class="submit-btn btn btn-default">Submit</button>
                        <button type="button" value="Reset" class="btn btn-default reset-btn">Reset</button><br><br>
                    </form>
                </div>
            </div>
        </section>
    </div><br>


<!-- END HTML -->

<!-- Include Internal Css -->
<style>
  .search-btn{
    width:100%
  }
  .user-bio-field{
    width: 100%;
  }
  .form-group{
    padding-bottom:8px !important;
  }
  option[disabled] {
    color: rgb(128, 128, 128);
  }
  option{
    color: black;
  }
  select:invalid {
    color: rgb(128, 128, 128);
  }
</style>

<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdn1.byjus.com/byjusweb/lib/bootstrap/js/bootstrap.min.js"></script>

<!-- Include Internel Script -->
<script type="text/javascript">

  var baseUrl               =   window.location.origin;
  var user_details_form     =   jQuery('[data-user-bio-single-upload]');
  var searchuserId          =   user_details_form.find('[name="searchuserId"]');
  var oType                 =   user_details_form.find('[name="crud-dropdown-section"]');

  //Search Record
  jQuery('.search-btn').click(function(e) {
    if((jQuery('#username_dropdown').val()!='')){
      e.preventDefault();
      var user_id = searchuserId.val();
      var o_type  = "find";
      jQuery.ajax({
        type: "POST",
        url: "search_api.php",
        data: {
          "searchuserId" : user_id,
          "oType" : o_type
        },
        datatype: "JSON",
        success: function (response){
          console.log(response);
          var data= jQuery.parseJSON(response);
          console.log(data.name);
          if(response){
            jQuery('.display-record').removeClass('hidden');
            jQuery('.col-name').text(data.name);
            jQuery('.col-phone').text(data.phone);
            jQuery('.col-email').text(data.email);
            jQuery('.col-address').text(data.address);
            jQuery('#user-name').val(data.name);
            jQuery('#user-phone').val(data.phone);
            jQuery('#user-email').val(data.email);
            jQuery('#user-address').val(data.address);
            jQuery('#user-id').val(data.userid);
          } else {
            alert('No record found.');
            jQuery('#user-name').val('');
            jQuery('#user-phone').val('');
            jQuery('#user-email').val('');
            jQuery('#user-address').val('');
            jQuery('#user-id').val('');
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
        }
      }); 
    }
  });

  //Insert Update Delete
  jQuery('.submit-btn').click(function(e) {
    if((jQuery('#user-bio-dropdown').val() == 'update')){
      if((jQuery('#username_dropdown').val()!='')){
        var formData = jQuery('[data-user-bio-single-upload]').serialize();
        jQuery.ajax({
          type: "POST",
          url:  "crud_api.php",
          data: formData,
          success: function (response) {
            var response_data = jQuery.parseJSON(response);
            alert(response_data.text);
            // jQuery('.form-control').val('');
            // jQuery('.display-record').addClass('hidden');
            location.reload(true);
          }
        });
      }
      else{
        alert("Please Select a exsisting user Id and Update existing record");
        jQuery('#username_dropdown').scrollTop();
      }
    }
    else if((jQuery('#user-bio-dropdown').val() == 'insert') || (jQuery('#user-bio-dropdown').val() == 'delete')){  
      var formData = jQuery('[data-user-bio-single-upload]').serialize();
      jQuery.ajax({
        type: "POST",
        url:  "crud_api.php",
        data: formData,
        success: function (response) {
          var response_data = jQuery.parseJSON(response);
          alert(response_data.text);
          // jQuery('.form-control').val('');
          // jQuery('.display-record').addClass('hidden');
          location.reload(true);
        }
      }); 
    }
  });

  jQuery('.reset-btn').click(function(){
    jQuery('.form-control').val('');
  });

</script>