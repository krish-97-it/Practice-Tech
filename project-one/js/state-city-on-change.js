window.onload = function () {
    jQuery.getJSON(
        'https://localwww.byjusweb.com/wp-content/themes/html5blank-stable/js/blc_revamp/center_locator.json',
        function(data) {
            var locationObject = data.locationObject;
            stateSel = document.getElementById("stateSel"),
            citySel = document.getElementById("citySel");
            for (var i=0; i<locationObject.length; i++) {
                stateSel.options[stateSel.options.length] = new Option(locationObject[i].State, locationObject[i].State);
            }
        }
    )
    stateSel.onchange = function () {
        citySel.length = 1; // remove all options bar first
        if (this.selectedIndex < 1) return; // done
        var state_name = stateSel.value;
        jQuery.getJSON(
        'wp-content/themes/html5blank-stable/js/blc_revamp/center_locator.json',
        function(response) {
            var locationObject = response.locationObject;
            for (var i = 0; i <locationObject.length; i++) {
                if(locationObject[i].State == state_name){
                    var temp = locationObject[i].CityList;
                    var temp_len = temp.length;
                    for (var j = 0; j <temp_len; j++) {
                        citySel.options[citySel.options.length] = new Option(locationObject[i].CityList[j], locationObject[i].CityList[j]);
                    }
                }
            }
        });
    }
    stateSel.onchange(); // reset in case page is reloaded
    citySel.onchange = function (){
        if(citySel.value){
            jQuery.getJSON(
                'wp-content/themes/html5blank-stable/js/blc_revamp/center_details.json',
                function(data) {
                    var center_details = data;
                    for(var k=0; k<center_details.length; k++){
                        if(citySel.value == center_details[k].CityName){
                            jQuery('#map').empty();
                            jQuery('#byjus-center').empty();
                            var div_data = '<iframe src="'+ center_details[k].IframeLink +'" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="Fast" class="map-in-iframe"></iframe>';
                            jQuery(div_data).appendTo('#map');
                            var learning_centers = center_details[k].CenterInfo;
                            var count=1;
                            for(var a=0; a<learning_centers.length; a++){
                                var center_data   = '<div class="learning-center learning-center'+count+'"><div class="row">'+
                                                        '<div class="col-sm-12"><div class="row">'+
                                                            '<img src="'+learning_centers[a].CenterImg+'" class="office-img">'+
                                                            '<div class="center-name-section">'+
                                                                '<div class="col-sm-8 col-xs-8 center-name-txt">'+
                                                                    '<p class="center-name">'+count+'. '+ learning_centers[a].CenterName+'</p>'+
                                                                '</div>'+
                                                                '<div class="col-sm-4 col-xs-4 center-pos-right center-directions">'+
                                                                    '<a href="'+learning_centers[a].MapAddress+'"><i class="material-icons purple-direction-icon"style="font-size:42px;color:purple">&#xe52e;</i></a>'+
                                                                '</div>'+
                                                            '</div>'+
                                                            '<div class="col-sm-7 col-xs-7 center-address">'+
                                                                '<div class="address-one">'+learning_centers[a].Addressone+'</div>'+
                                                                '<div class="address-one"></div>'+
                                                            '</div>'+
                                                            '<div class="col-sm-5 col-xs-5 center-pos-right center-redirect-btn">'+
                                                                '<button class="get-to-center-btn">Get to the Center</button>+'
                                                            '</div>'+
                                                        '</div></div>'+
                                                    '</div></div>br>'
                                jQuery(center_data).appendTo('#byjus-center');
                                count++;
                            }
                        }
                    }
                }
            )
        }
    }
    citySel.onchange();
}