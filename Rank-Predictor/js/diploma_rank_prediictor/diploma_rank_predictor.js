var COLLEGE_BRANCH_PREDICTOR = {
    collegeDetailsJsonURL: "/PRACTICE-TECH/Rank-Predictor/js/diploma_rank_prediictor/college_details.json"
}

jQuery(document).ready(function(){

    var college_type                =   jQuery('[name="college-type"]');
    var course_name                 =   jQuery('[name="college-name"]');
    var user_rank                   =   jQuery('[name="user-rank"]');
    var district_name               =   jQuery('[name="college-type"]');
    var data_search_btn             =   jQuery('[data-search-btn]');
    var data_view_full_list         =   jQuery('[data-view-full-list]');
    var data_clear_btn              =   jQuery('[data-clear-btn]');
    var view_data_table             =   jQuery('[view-data-table]');
    var scroll_to_top               =   jQuery('[scroll-top-page]');
    var scroll_to_bottom            =   jQuery('[scroll-bottom-page]');

    var college_details_data,temp_html='',isCollegeType,data_address;

    jQuery.get(COLLEGE_BRANCH_PREDICTOR.collegeDetailsJsonURL).done(function (collegeBranchList){
        college_details_data = collegeBranchList;
    })

    // To dispay all data
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

        jQuery('[data-download-btn]').click(function(){
            downloadCSVFromJson("collegelist.csv",college_details_data);
        })
    });

    // To clear all field data of modal
    jQuery(data_clear_btn).click(function(){
        jQuery('.form-control').val('');
    });

    // 
    jQuery('.eligibility-modal').click(function(){
        document.getElementById("myBtnTop").style.display="none";
        document.getElementById("myBtnBottom").style.display="none";
    })

    // Scoll to top and buttom btn
    scroll_to_top.click(function(){
        topFunction();
    });
    scroll_to_bottom.click(function(){
        bottomFunction();
    });
    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        document.getElementById("myBtnTop").style.display="none";
        document.getElementById("myBtnBottom").style.display="block";
    }
    function bottomFunction()
    {
        var height = document.body.scrollHeight;
        window.scroll(0 , height);
        document.getElementById("myBtnBottom").style.display="none";
        document.getElementById("myBtnTop").style.display="block";
    }


    // Print the data functionality
    jQuery('[data-print-btn]').click(function(){
        printOrSave()
    })
    function printOrSave() {
        var divToPrint=document.getElementById("result-table-container-id");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    // Download table data as CSV function
    function downloadCSVFromJson(filename, arrayOfJson){
        // convert JSON to CSV
        const replacer = (key, value) => value === null ? '' : value // specify how you want to handle null values here
        const header = Object.keys(arrayOfJson[0])
        let csv = arrayOfJson.map(row => header.map(fieldName => 
        JSON.stringify(row[fieldName], replacer)).join(','))
        csv.unshift(header.join(','))
        csv = csv.join('\r\n')
      
        // Create link and download
        var link = document.createElement('a');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv));
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };
})