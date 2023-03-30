<script type="text/javascript">
    var aeronefs = <?= $aeronefs_js ?>;

    //console.log(aeronefs);

    // for collecting filter info to add on the report header
    var filter_str = {}

    function aeronefsFilter(){

       
        var filter = {}; 
        if (document.getElementById('aeronef_availability').value != ''){
            let selected_availability = document.getElementById('aeronef_availability').value;
            filter['availability_status'] = selected_availability; 
            filter_str['availability'] =  document.getElementById('aeronef_availability').options[aeronef_availability.selectedIndex].text
        } else {
            filter_str['availability'] = "ALL"
        }

        
        filtered_aeronefs= aeronefs.filter(function(item) {
        for (var key in filter) {
            if (item[key] != filter[key])
            return false;
        }
        return true;
        });

        //console.log(filtered_aeronefs)
        localStorage.setItem("filtered_aeronefs",JSON.stringify(filtered_aeronefs)); 
        localStorage.setItem('filter_str',JSON.stringify(filter_str)); 

        window.open('templates/report/assets/templates/aeronef.html','_blank');
    
    }


</script>