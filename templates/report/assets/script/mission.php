<script type="text/javascript">
    var missions = <?= $missions_js ?>;
    //console.log(missions);
    function missionsFilter(){


        // for collecting filter info to add on the report header
        var filter_str = {}

        // date filter creation
        var date_filter = {};
        if (document.getElementById('missions_period').value != ''){
            let selected_period = document.getElementById('missions_period').value;
            let departure_date = selected_period.substr(0,10); 
            let return_date = selected_period.substr(13,30) 
            date_filter['departure_date'] = departure_date; 
            date_filter['return_date'] = return_date; 
            filter_str['period'] = selected_period; 
        } 

        // remaining variable filter creation
        var filter = {}; 
        
        if (document.getElementById('missions_aeronef').value != ''){
            let selected_aeronef = document.getElementById('missions_aeronef').value;
            filter['aeronef_id'] = selected_aeronef;
            filter_str['aeronef'] =  document.getElementById('missions_aeronef').options[missions_aeronef.selectedIndex].text
            
        } else {
            filter_str['aeronef'] = "ALL"
        }

        if (document.getElementById('type').value != ''){
            let selected_type = document.getElementById('type').value;
            filter['type_id'] = selected_type; 

            filter_str['type'] =  document.getElementById('type').options[type.selectedIndex].text

        } else {
            filter_str['type'] = "ALL"
        }

        if (document.getElementById('mission_status').value != ''){
            
            let selected_status = document.getElementById('mission_status').value;
            filter['status'] = selected_status;
            filter_str['status'] =  document.getElementById('mission_status').options[mission_status.selectedIndex].text

        } else {
            filter_str['status'] = "ALL"
        }

        //console.log(filter_str); 

        // return the array by date filtering before because it was difficult 
        filtered_missions_1 = missions.filter(mission =>
            mission.departure_date >= date_filter.departure_date && 
            mission.return_date <= date_filter.return_date
        )

        
        // then filter by the others variable 
        filtered_missions= filtered_missions_1.filter(function(item) {
        for (var key in filter) {
            if (item[key] != filter[key])
            return false;
        }
        return true;
        });

        //console.log(filtered_missions);
        localStorage.setItem("filtered_missions",JSON.stringify(filtered_missions)); 
        localStorage.setItem('filter_str',JSON.stringify(filter_str)); 

        window.open('templates/report/assets/templates/mission.html','_blank'); 
         

    }
    

</script>