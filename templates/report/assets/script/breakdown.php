<script type="text/javascript">
    var breakdowns = <?= $breakdowns_js ?>;
    //console.log(breakdowns);


    function breakdownsFilter(){

        // for collecting filter info to add on the report header
        var filter_str = {}

        // date filter creation
        var date_filter = {};
        if (document.getElementById('breakdowns_period').value != ''){
            let selected_period = document.getElementById('breakdowns_period').value;
            let finding_date_min = selected_period.substr(0,10); 
            let finding_date_max = selected_period.substr(13,30) 
            date_filter['finding_date_min'] = finding_date_min; 
            date_filter['finding_date_max'] = finding_date_max; 
            filter_str['period'] = selected_period; 
        } 
        //console.log(date_filter); 

        // remaining variable filter creation
        var filter = {}; 
        if (document.getElementById('broken_aeronef').value != ''){
            let selected_aeronef = document.getElementById('broken_aeronef').value;
            filter['aeronef_id'] = selected_aeronef; 
            filter_str['aeronef'] =  document.getElementById('broken_aeronef').options[broken_aeronef.selectedIndex].text
        } else {
            filter_str['aeronef'] = "ALL"
        }


        if (document.getElementById('repairing_status').value != ''){
            
            let selected_status = document.getElementById('repairing_status').value;
            filter['repairing_status'] = selected_status;
            filter_str['status'] =  document.getElementById('repairing_status').options[repairing_status.selectedIndex].text
        } else {
            filter_str['status'] = "ALL"
        }

        //console.log(filter); 
        // return the array by date filtering before because it was difficult 
        filtered_breakdowns_1 = breakdowns.filter(breakdown =>
            breakdown.finding_date >= date_filter.finding_date_min && 
            breakdown.finding_date <= date_filter.finding_date_max
        )

        
        // then filter by the others variable 
        filtered_breakdowns= filtered_breakdowns_1.filter(function(item) {
        for (var key in filter) {
            if (item[key] != filter[key])
            return false;
        }
        return true;
        });

        //console.log(filtered_breakdowns);
        localStorage.setItem("filtered_breakdowns",JSON.stringify(filtered_breakdowns)); 
        localStorage.setItem('filter_str',JSON.stringify(filter_str)); 

        window.open('templates/report/assets/templates/breakdown.html','_blank');
        
    }
    

</script>