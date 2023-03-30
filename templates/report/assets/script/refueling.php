<script type="text/javascript">
    var refuelings = <?= $refuelings_js ?>;
    //console.log(refuelings);
    function refuelingsFilter(){

        // for collecting filter info to add on the report header
        var filter_str = {}

        // date filter creation
        var date_filter = {};
        if (document.getElementById('refuelings_period').value != ''){
            let selected_period = document.getElementById('refuelings_period').value;
            let min_date = selected_period.substr(0,10); 
            let max_date = selected_period.substr(13,30);
            date_filter['min_date'] = min_date; 
            date_filter['max_date'] = max_date; 
            filter_str['period'] = selected_period; 
        } 

        var filter = {}; 
        if (document.getElementById('refueled_aeronef').value != ''){
            let selected_aeronef = document.getElementById('refueled_aeronef').value;
            filter['aeronef_id'] = selected_aeronef; 
            filter_str['aeronef'] =  document.getElementById('refueled_aeronef').options[refueled_aeronef.selectedIndex].text
        } else {
            filter_str['aeronef'] = "ALL"
        }
        
        filtered_refueling_1 = refuelings.filter(refueling =>
            refueling.refueling_date >= date_filter.min_date && 
            refueling.refueling_date <= date_filter.max_date
        )
        
        filtered_refuelings= filtered_refueling_1.filter(function(item) {
        for (var key in filter) {
            if (item[key] != filter[key])
            return false;
        }
        return true;
        });

        //console.log(filtered_refuelings)
        localStorage.setItem("filtered_refuelings",JSON.stringify(filtered_refuelings)); 
        localStorage.setItem('filter_str',JSON.stringify(filter_str)); 

        window.open('templates/report/assets/templates/refueling.html','_blank');
    }


</script>