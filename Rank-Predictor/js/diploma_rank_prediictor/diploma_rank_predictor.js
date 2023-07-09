var COLLEGE_BRANCH_PREDICTOR = {
    collegeDetailsJsonURL: "/PRACTICE-TECH/Rank-Predictor/js/diploma_rank_prediictor/college_details.json",
    collegeCutOffJsonURL: "/PRACTICE-TECH/Rank-Predictor/js/diploma_rank_prediictor/cutoff_data_2021.json",
    apiUrl: "/PRACTICE-TECH/Rank-Predictor/custom_api/create_update_user_data.php"
}

jQuery(document).ready(function(){

    var college_type                =   jQuery('[name="collegeType"]');
    var college_list                =   jQuery('[name="collegeList"]')
    var district_list               =   jQuery('[name="districtList"]');
    var subject_list                =   jQuery('[name="subjectList"]');
    var user_name                   =   jQuery('[name="user-name"]');
    var user_email                  =   jQuery('[name="user-email"]');
    var user_phone                  =   jQuery('[name="user-phone"]');
    var user_address                =   jQuery('[name="user-address"]');
    var user_rank                   =   jQuery('[name="user-rank"]');
    var data_search_college         =   jQuery('[data-search-college]')
    var data_submit_btn             =   jQuery('[data-search-btn]');
    var college_predict_btn         =   jQuery('[data-predict-btn]');
    var data_view_full_list         =   jQuery('[data-view-full-list]');
    var data_clear_btn              =   jQuery('[data-clear-btn]');
    var rank_type                   =   jQuery('[name="rank-type"]');
    var view_data_table             =   jQuery('[view-data-table]');
    var error_msg                   =   jQuery('[show-error-msg]');
    var error_msg_rank              =   jQuery('[error-msg-rank]')
    var error_msg_two               =   jQuery('[show-error-msg-two]');
    var scroll_to_top               =   jQuery('[scroll-top-page]');
    var scroll_to_bottom            =   jQuery('[scroll-bottom-page]');
    var modal_content               =   jQuery('[modal-content-college-Info]');

    var college_details_data,collegeListJSON,temp_html='',distListJSON,data_address,college_listData;
    var final_data = new Array(), distListArray = new Array(), subjectArray = new Array(), filtered_data = new Array(), CollegeSubjectArray = new Array();

    jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeDetailsJsonURL).done(function (collegeListData){

        // On click eligibility btn
        jQuery('.eligibility-modal').click(function(){

            // scroll up and down botton hidden initially on modal
            document.getElementById("myBtnTop").style.display="none";
            document.getElementById("myBtnBottom").style.display="none";

            defaultDataLoad();
            onChangeDropdown();
        });

        college_type.on('change',function(){
            onChangeDropdown();
        });

        district_list.on('change', function(){
            onChangeDropdown();
        })

        // To clear all field data of modal
        jQuery(data_clear_btn).click(function(){
            custom_functions.clearFormData();
            onChangeDropdown();
        });

        function defaultDataLoad(){
            // District
            college_list.empty();
            distListArray = [];
            district_list.empty();
            district_list.append('<option value="" default selected>Any</option>')
            distListJSON = collegeListData;
            jQuery.each(distListJSON, function(i ,distList) {
                if (!distListArray.includes(distList.District)) {
                    distListArray.push(distList.District);
                    district_list.append('<option value="' + distList.District + '">' + distList.District + '</option>');
                }
            });

            // Colleges
            college_list.append('<option value="" default selected>Any</option>')
            collegeListJSON = collegeListData;
            collegeListJSON.sort(function(a, b){
                return a.CollegeName.localeCompare(b.CollegeName);
            });
            for(var i =0; i<collegeListJSON.length; i++){
                college_list.append('<option value="' + collegeListData[i].CollegeName + '">' + collegeListData[i].CollegeName + '</option>');
            }
        }

        // on change of college type and district colleges will be load
        function onChangeDropdown(){
            college_list.empty();
            college_list.append('<option value="" default selected>Any</option>')
            college_details_data = collegeListData;
            college_details_data.sort(function(a, b){
                return a.CollegeName.localeCompare(b.CollegeName);
            });
            for(var i =0; i<college_details_data.length; i++){
                if(district_list.val() != '' && college_type.val() == '' && district_list.val() == college_details_data[i].District){
                    college_list.append('<option value="' + college_details_data[i].CollegeName + '">' + college_details_data[i].CollegeName + '</option>');
                }else if(district_list.val() == '' && college_type.val() != '' && college_type.val() == college_details_data[i].CollegeType){
                    college_list.append('<option value="' + college_details_data[i].CollegeName + '">' + college_details_data[i].CollegeName + '</option>');
                }else if(district_list.val() != '' &&  college_type.val() != '' && district_list.val() == college_details_data[i].District && college_type.val() == college_details_data[i].CollegeType){
                    college_list.append('<option value="' + college_details_data[i].CollegeName + '">' + college_details_data[i].CollegeName + '</option>');
                }else if(college_type.val() == '' && district_list.val() == ''){
                    college_list.append('<option value="' + college_details_data[i].CollegeName + '">' + college_details_data[i].CollegeName + '</option>');
                }
            }
        }

        // get list of subjects as per colleges
        function getSubjectList(){
            // Subjects
            subjectArray = [];
            subject_list.empty();
            subject_list.append('<option value="" default selected>Any</option>')
            jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeCutOffJsonURL).done(function (data){
                subjectJSON = data;
                jQuery.each(subjectJSON, function(i ,subject) {
                    var subject_lowercase = (subject.Branch).toLowerCase();
                    if(college_list.val != '' && college_list.val() == subject.Institute){
                        if (!subjectArray.includes(subject_lowercase)) {
                            subjectArray.push(subject_lowercase);
                            subject_list.append('<option value="' + subject.Branch + '">' + subject.Branch + '</option>');
                        }
                    }else if(college_list.val() == ''){
                        if (!subjectArray.includes(subject_lowercase)) {
                            subjectArray.push(subject_lowercase);
                            subject_list.append('<option value="' + subject.Branch + '">' + subject.Branch + '</option>');
                        }
                    }
                });
            })
        }

        function getCollegeData(){
            college_listData = collegeListData;
            filtered_data = [];
            getSubjectList();
            for(var k=0; k<college_listData.length; k++){
                if(college_type.val() == college_listData[k].CollegeType){
                    if(college_list.val() == "" && district_list.val() == ""){
                        filtered_data.push(college_listData[k]);
                    }else if(college_list.val() == "" && district_list.val() != "" && district_list.val() == college_listData[k].District){
                        filtered_data.push(college_listData[k]);
                    }else if(college_list.val() != "" && district_list.val() != "" && college_list.val() == college_listData[k].CollegeName && district_list.val() == college_listData[k].District){
                        filtered_data.push(college_listData[k]);
                    }else if(college_list.val() != "" && district_list.val() == "" && college_list.val() == college_listData[k].CollegeName){
                        filtered_data.push(college_listData[k]);
                    }
                }
            }
        }

        // To dispay all data / when clicked on View Full btn
        jQuery(data_view_full_list).on("click",function(){
            custom_functions.displayAllData(collegeListData);
        });

        // Once clicked on search college Button
        jQuery(data_search_college).click(function(){
            jQuery(error_msg).empty();
            jQuery(error_msg_two).empty();
            jQuery(error_msg_rank).empty();
            if(college_type.val() != '' && college_list.val() != ''){
                getCollegeData();
                custom_functions.displayAllData(filtered_data,);
            }else{
                jQuery(error_msg).append('Please choose the college-type and a particular college to search');
            }
        });

        // Once clicked on next Button
        jQuery('[data-next-btn]').click(function(){
            jQuery(error_msg).empty();
            jQuery(error_msg_two).empty();
            jQuery(error_msg_rank).empty();
            if(college_type.val() != '' && district_list.val() != ''){
                var college_list_length = jQuery('#college-list option').length;
                if(college_list_length > 1){
                    jQuery('#expected-percentile-carousel').carousel('next');
                    getCollegeData();
                }
                else{
                    jQuery(error_msg).append('No college found for that selected college type and district');
                }
            }else if(college_type.val() != ""){
                jQuery('#expected-percentile-carousel').carousel('next');
                getCollegeData();
            }else{
                jQuery(error_msg).append('Please choose the college-type');
            }
        });

        // Once clicked on Predict a College Btn
        jQuery(college_predict_btn).click(function(){
            final_data = [];
            jQuery(error_msg).empty();
            jQuery(error_msg_two).empty();
            jQuery(error_msg_rank).empty()
            jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeCutOffJsonURL).done(function (data){
                cutoffData = data;
                if(user_rank.val() != undefined && user_rank.val() != "" && rank_type.val() != ""){
                    for(var j=0; j<filtered_data.length; j++){
                        for(var k = 0; k<cutoffData.length; k++){
                            if(filtered_data[j].CollegeName == cutoffData[k].Institute){
                                if(subject_list.val() != "" && cutoffData[k].Branch == subject_list.val()){
                                    if(rank_type.val()=="GEN" && cutoffData[k].GEN >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "ST" && cutoffData[k].ST >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "SC" && cutoffData[k].SC >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "OBCA" && cutoffData[k].OBCA >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "OBCB" && cutoffData[k].OBCB >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "PC" && cutoffData[k].PC >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }
                                }else if(subject_list.val() == ""){
                                    if(rank_type.val() ==  "GEN" && cutoffData[k].GEN >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "ST" && cutoffData[k].ST >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "SC" && cutoffData[k].SC >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "OBCA" && cutoffData[k].OBCA >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "OBCB" && cutoffData[k].OBCB >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }else if(rank_type.val() ==  "PC" && cutoffData[k].PC >= user_rank.val()){
                                        final_data.push(cutoffData[k]);
                                    }
                                }
                            }
                        }
                    }
                    if(final_data.length > 0){
                        jQuery('#expected-percentile-carousel').carousel('next');
                    }else{
                        jQuery(error_msg_rank).append('No record found');
                    }
                }else{
                    jQuery(error_msg_rank).append('Rank and Rank type is mandatory');
                }
            })
        })

        // Once clicked on final submit btn
        jQuery(data_submit_btn).click(function(){
            jQuery(error_msg_two).empty();
            if(user_name.val() != "" && user_name.val() != undefined && user_phone.val() != "" && user_phone.val() != undefined){
                jQuery.ajax({
                    type     :   "POST",
                    url      :   COLLEGE_BRANCH_PREDICTOR.apiUrl,
                    data     :   {
                        "Name"    :   user_name.val(),
                        "Phone"   :   user_phone.val(),
                        "Email"   :   user_email.val(),
                        "Address" :   user_address.val()
                    },
                    datatype :   "JSON",
                    success  :   function (response){
                        // var res_data= jQuery.parseJSON(response);
                        if(response.statusCode == '200'){
                            custom_functions.displayFilteredData(final_data);
                            jQuery('#expected-percentile-carousel').carousel(0)
                            custom_functions.clearFormData();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                    }
                }); 
            }else{
                jQuery(error_msg_two).append('Please enter your name and email');
            }
        })
        
        // Once Download btn is clicked a csv of visible table data will be downloaded
        jQuery('[data-download-btn]').click(function(){
            downloadCSVFromJson("collegelist.csv",collegeListData);
        });

        function downloadCSVFromJson(filename, arrayOfJson){
            // convert JSON to CSV
            const replacer = (key, value) => value === null ? '' : value // specify how you want to handle null values here
            const header = Object.keys(arrayOfJson[0])
            let csv = arrayOfJson.map(row => header.map(fieldName => 
            JSON.stringify(row[fieldName], replacer)).join(','))
            csv.unshift(header.join(','));
            csv = csv.join('\r\n');
        
            // Create link and download
            var link = document.createElement('a');
            link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv));
            link.setAttribute('download', filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

    })

    // Once clicked back button
    jQuery('[data-back-btn]').click(function(){
        jQuery('#expected-percentile-carousel').carousel('prev');
    });

    // Quick Scroll To Top
    scroll_to_top.click(function(){
        // Scroll To Top
        custom_functions.topFunction();
    });
    // Quick Scroll To Bottom
    scroll_to_bottom.click(function(){
        // Scroll to bottom
        custom_functions.bottomFunction();
    });
    // Print the data functionality
    jQuery('[data-print-btn]').click(function(){
        custom_functions.printOrSave();
    });

    var custom_functions = {

        clearFormData : function(){
            jQuery('.form-control').val('');
            jQuery(error_msg, error_msg_two, error_msg_rank).empty();
        },

        topFunction : function(){
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            document.getElementById("myBtnTop").style.display="none";
            document.getElementById("myBtnBottom").style.display="block";
        },

        bottomFunction : function (){
            var height = document.body.scrollHeight;
            window.scroll(0 , height);
            document.getElementById("myBtnBottom").style.display="none";
            document.getElementById("myBtnTop").style.display="block";
        },

        printOrSave : function() {
            var divToPrint=document.getElementById("result-table-container-id");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        },

        getSubjectOfACollege : function(collge_name,subjectJson){
             // Subjects
            var data =  subjectJson;
            CollegeSubjectArray = [];
            jQuery.each(data, function(i ,subject) {
                var subject_lowercase = (subject.Branch).toLowerCase();
                if(collge_name!= '' && collge_name == subject.Institute){
                    if (!CollegeSubjectArray.includes(subject_lowercase)) {
                        CollegeSubjectArray.push(subject_lowercase);
                    }
                }
            });
            return CollegeSubjectArray;
        },
    
        displayAllData : function(response){
            jQuery('#myModal').modal("hide");
            jQuery('.result-table-container').removeClass('hidden');
            jQuery('.download-print').removeClass('hidden');
            jQuery('#custom-data-table tr').remove();
            jQuery('.filter-table-head').addClass('hidden');
            jQuery('.custom-table-head').removeClass('hidden');
            custom_functions.createTableHtml(response);
            document.getElementById("myBtnBottom").style.display="block";
        },

        displayFilteredData : function(jsonData){
            jQuery('#myModal').modal("hide");
            jQuery('.result-table-container').removeClass('hidden');
            jQuery('.download-print').removeClass('hidden');

            jQuery('.filter-table-head').removeClass('hidden');
            jQuery('.custom-table-head').addClass('hidden');
            jQuery('#custom-data-table tr').remove();

            custom_functions.createTableFilteredData(jsonData);
            document.getElementById("myBtnBottom").style.display="block";
        },

        createTableHtml : function(inputData){
            jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeCutOffJsonURL).done(function (data){
                var subjectJSON         = data;  
                jQuery.each(inputData, function(i,data){
                    temp_html = '';     // reset the variable
                    var college_name    = data["CollegeName"]
                    var subList         = custom_functions.getSubjectOfACollege(college_name,subjectJSON)
                    
                    // Splitting comma sepetrated cources into array and making a seperate list of course for each entry
                    // var split_cources = data["Cources"].split(',');

                    for(var i=0; i<subList.length; i++){
                        temp_html += '<p style="border-bottom:2px solid aeaeae; margin-bottom:3px !important; padding-bottom:4px !important;">'+(i+1)+' - '+subList[i]+'</p>'        
                    }
    
                    // merging two address field
                    data_address = data["Address1"]+' '+data["Address2"]
                    view_data_table.append(
                        '<tr>'+
                            '<td>'+data["SlNo"]+'.</td>'+
                            '<td>'+data["Code"]+'</td>'+
                            '<td>'+data["CollegeName"]+'</td>'+
                            '<td>'+data["CollegeType"]+'</td>'+
                            '<td>'+temp_html+'</td>'+
                            '<td>'+data["District"]+'</td>'+
                            '<td>'+data_address+'</td>'+
                            '<td>'+data["Phone"]+'</td>'+
                            '<td>'+data["Website"]+'</td>'+
                            '<td>'+data["YearlyAvgFees"]+'</td>'+
                        '</tr>'
                    );
                });
            })
        },

        createTableFilteredData : function(inputData){
            jQuery.each(inputData, function(i,data){
                var c_name = data["Institute"];
                view_data_table.append(
                    '<tr>'+
                        '<td>'+data["SlNo"]+'</td>'+
                        '<td><a class="get-college-info" c_name="'+c_name+'" data-toggle="modal" data-target="#collegeInfo">'+data["Institute"]+'</td>'+
                        '<td>'+data["Type"]+'</td>'+
                        '<td>'+data["Branch"]+'</td>'+
                        '<td>'+data["Total-Available-Seats"]+'</td>'+
                        '<td>'+data["GEN"]+'</td>'+
                        '<td>'+data["ST"]+'</td>'+
                        '<td>'+data["SC"]+'</td>'+
                        '<td>'+data["OBCA"]+'</td>'+
                        '<td>'+data["OBCB"]+'</td>'+
                        '<td>'+data["PC"]+'</td>'+
                    '</tr>'
                );
            });

            jQuery('.get-college-info').on('click', function(){
                var get_data = jQuery(this).attr('c_name');
                modal_content.empty()
                jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeDetailsJsonURL).done(function(collegeListData){
                    jQuery.each(collegeListData, function(i,data){
                        if(get_data == data.CollegeName){
                            // merging two address field
                            data_address = data["Address1"]+' '+data["Address2"]
                            modal_content.append(
                                '<div class="modal-dialog">'+
                                    '<div class="modal-content" modal-content>'+
                                        '<div class="modal-header">'+
                                            '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                                            '<h4 class="modal-title">'+get_data+'</h4>'+
                                        '</div>'+
                                        '<div class="modal-body">'+
                                            '<div class="container">'+
                                                '<div class="row">'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>College Type:</label>'+
                                                        '<p class="college-info-p">'+data["CollegeType"]+'</p>'+
                                                    '</div><br>'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>District:</label>'+
                                                        '<p class="college-info-p">'+data["District"]+'</p>'+
                                                    '</div><br>'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>Full Address:</label>'+
                                                        '<p class="college-info-p">'+data_address+'</p>'+
                                                    '</div><br>'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>Contact Number:</label>'+
                                                        '<p class="college-info-p">'+data["Phone"]+'</p>'+
                                                    '</div><br>'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>Email:</label>'+
                                                        '<p class="college-info-p">'+data["Email"]+'</p>'+
                                                    '</div><br>'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>Website:</label>'+
                                                        '<p class="college-info-p">'+data["Website"]+'</p>'+
                                                    '</div><br>'+
                                                    '<div class="col-sm-12">'+
                                                        '<label>Yearly Avg. Fees:</label>'+
                                                        '<p class="college-info-p">'+data["YearlyAvgFees"]+'</p>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );
                        }
                    })
                })
            })
        }
    }
})