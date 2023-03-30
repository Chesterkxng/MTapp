<script type="text/javascript">
    var defuelings = <?= $defuelings_js ?>;
    //console.log(defuelings);
    function defuelingsFilter(){


        // for collecting filter info to add on the report header
        var filter_str = {}

        // date filter creation
        var date_filter = {};
        if (document.getElementById('defuelings_period').value != ''){
            let selected_period = document.getElementById('defuelings_period').value;
            let min_date = selected_period.substr(0,10); 
            let max_date = selected_period.substr(13,30) 
            date_filter['min_date'] = min_date; 
            date_filter['max_date'] = max_date; 
            filter_str['period'] = selected_period; 
        } 

        var filter = {}; 
        if (document.getElementById('defueled_aeronef').value != ''){
            let selected_aeronef = document.getElementById('defueled_aeronef').value;
            filter['aeronef_id'] = selected_aeronef; 
            filter_str['aeronef'] =  document.getElementById('defueled_aeronef').options[defueled_aeronef.selectedIndex].text

        } else {
            filter_str['aeronef'] = "ALL"
        }
        
        filtered_defueling_1 = defuelings.filter(defueling =>
            defueling.defueling_date >= date_filter.min_date && 
            defueling.defueling_date <= date_filter.max_date
        )
        
        filtered_defuelings= filtered_defueling_1.filter(function(item) {
        for (var key in filter) {
            if (item[key] != filter[key])
            return false;
        }
        return true;
        });

        //console.log(filtered_defuelings)
        localStorage.setItem("filtered_defuelings",JSON.stringify(filtered_defuelings)); 
        localStorage.setItem('filter_str',JSON.stringify(filter_str)); 

        window.open('templates/report/assets/templates/defueling.html','_blank');
    }


</script>