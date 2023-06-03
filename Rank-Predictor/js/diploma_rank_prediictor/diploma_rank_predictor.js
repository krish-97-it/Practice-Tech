var COLLEGE_BRANCH_PREDICTOR = {
    collegeDetailsJsonURL: "/PRACTICE-TECH/Rank-Predictor/js/diploma_rank_prediictor/college_details.json"
}

jQuery(document).ready(function(){

    var college_type                =   jQuery('[name="collegeType"]');
    var college_list                =   jQuery('[name="collegeList"]')
    var district_list               =   jQuery('[name="districtList"]');
    var user_rank                   =   jQuery('[name="user-rank"]');
    var data_search_btn             =   jQuery('[data-search-btn]');
    var data_view_full_list         =   jQuery('[data-view-full-list]');
    var data_clear_btn              =   jQuery('[data-clear-btn]');
    var view_data_table             =   jQuery('[view-data-table]');
    var scroll_to_top               =   jQuery('[scroll-top-page]');
    var scroll_to_bottom            =   jQuery('[scroll-bottom-page]');

    var college_details_data,collegeListJSON,temp_html='',distListJSON,data_address;
    var collegeListarray = new Array(), distListArray = new Array(), temp_data_array = new Array();

    jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeDetailsJsonURL).done(function (collegeListData){

        // On click eligibility btn
        jQuery('.eligibility-modal').click(function(){

            // scroll up and down botton hidden initially on modal
            document.getElementById("myBtnTop").style.display="none";
            document.getElementById("myBtnBottom").style.display="none";

            defaultDataLoad();
        });

        college_type.on('change',function(){
            onChangeCollegeType()
        });

        // To clear all field data of modal
        jQuery(data_clear_btn).click(function(){
            custom_functions.clearFormData();
            onChangeCollegeType();
        });
        
        // Once Download btn is clicked
        jQuery('[data-download-btn]').click(function(){
            downloadCSVFromJson("collegelist.csv",collegeListData);
        });

        function defaultDataLoad(){
            distListJSON = collegeListData;
            jQuery.each(distListJSON, function(i ,distList) {
                if (!distListArray.includes(distList.District)) {
                    distListArray.push(distList.District);
                    district_list.append('<option value="' + distList.District + '">' + distList.District + '</option>');
                }
            });

            collegeListJSON = collegeListData;
            collegeListJSON.sort(function(a, b){
                return a.CollegeName.localeCompare(b.CollegeName);
            });
            for(var i =0; i<collegeListJSON.length; i++){
                college_list.append('<option value="' + collegeListData[i].CollegeName + '">' + collegeListData[i].CollegeName + '</option>');
            }
        }

        function onChangeCollegeType(){
            college_list.empty();
            college_list.append('<option value="" default selected>Any</option>')
            college_details_data = collegeListData;
            college_details_data.sort(function(a, b){
                return a.CollegeName.localeCompare(b.CollegeName);
            });
            console.log(college_details_data);
            for(var i =0; i<college_details_data.length; i++){
                if(college_type.val() == college_details_data[i].CollegeType){
                    console.log("hello")
                    // if(!temp_data_array.includes(college_details_data[i].CollegeName)){
                        // temp_data_array.push(college_details_data[i].CollegeName);
                        college_list.append('<option value="' + college_details_data[i].CollegeName + '">' + college_details_data[i].CollegeName + '</option>');
                    // }
                }else if(college_type.val() == ''){
                    college_list.append('<option value="' + college_details_data[i].CollegeName + '">' + college_details_data[i].CollegeName + '</option>');
                }
            }
        }

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

    // To dispay all data / when clicked on View Full btn
    jQuery(data_view_full_list).on("click",function(){
        
        jQuery('#myModal').modal("hide");
        jQuery('.result-table-container').removeClass('hidden');
        jQuery('.download-print').removeClass('hidden');

        jQuery.getJSON(COLLEGE_BRANCH_PREDICTOR.collegeDetailsJsonURL,function(response,index) {
            var jsonData = response;
            jQuery('#custom-data-table tr').remove();
            jQuery.each(jsonData, function(i,data){
                temp_html = '';     // reset the variable
                
                // Splitting comma sepetrated cources into array and making a seperate list of course for each entry
                var split_cources = data["Cources"].split(',');
                for(var i=0; i<split_cources.length; i++){
                    temp_html += '<p style="border-bottom:2px solid aeaeae; margin-bottom:3px !important; padding-bottom:4px !important;">'+(i+1)+' - '+split_cources[i]+'</p>'        
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
                        '<td>'+data["CutOff"]+'</td>'+
                        '<td>'+data["District"]+'</td>'+
                        '<td>'+data_address+'</td>'+
                        '<td>'+data["Phone"]+'</td>'+
                        '<td>'+data["Website"]+'</td>'+
                        '<td>'+data["YearlyAvgFees"]+'</td>'+
                    '</tr>'
                );
            });
            
        });
        document.getElementById("myBtnBottom").style.display="block";
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

    }

})