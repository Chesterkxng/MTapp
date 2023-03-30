<script type="text/javascript">
    var orders = <?= $orders_js ?>;
    //console.log(orders);

    function ordersFilter(){

         // for collecting filter info to add on the report header
         var filter_str = {}

        // date filter creation
        var date_filter = {};
        if (document.getElementById('orders_period').value != ''){
            let selected_period = document.getElementById('orders_period').value;
            let order_date_min = selected_period.substr(0,10); 
            let order_date_max = selected_period.substr(13,30) 
            date_filter['order_date_min'] = order_date_min; 
            date_filter['order_date_max'] = order_date_max; 
            filter_str['period'] = selected_period; 
        } 
        //console.log(date_filter); 

        // remaining variable filter creation
        var filter = {}; 
        if (document.getElementById('orders_aeronef').value != ''){
            let selected_aeronef = document.getElementById('orders_aeronef').value;
            filter['aeronef_id'] = selected_aeronef; 
            filter_str['aeronef'] =  document.getElementById('orders_aeronef').options[orders_aeronef.selectedIndex].text
        } else {
            filter_str['aeronef'] = "ALL"
        }


        if (document.getElementById('orders_status').value != ''){
            
            let selected_status = document.getElementById('orders_status').value;
            filter['delivery_status'] = selected_status;
            filter_str['status'] =  document.getElementById('orders_status').options[orders_status.selectedIndex].text
        } else {
            filter_str['status'] = "ALL"
        }

        //console.log(filter); 
        // return the array by date filtering before because it was difficult 
        filtered_orders_1 = orders.filter(order =>
            order.order_date >= date_filter.order_date_min && 
            order.order_date <= date_filter.order_date_max
        )

        
        // then filter by the others variable 
        filtered_orders= filtered_orders_1.filter(function(item) {
        for (var key in filter) {
            if (item[key] != filter[key])
            return false;
        }
        return true;
        });

        //console.log(filtered_orders);
        localStorage.setItem("filtered_orders",JSON.stringify(filtered_orders)); 
        localStorage.setItem('filter_str',JSON.stringify(filter_str)); 

        window.open('templates/report/assets/templates/order.html','_blank');
        
    }
    

</script>