<!-- adding Popup -->
<script type="text/javascript">
  function addingSuccessAlert()
  {
    swal({
      title: "Order Message!",
      text: "Order added successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=ordersList";
   } else {
    window.location.href = "index.php?action=ordersList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function addingErrorAlert()
  {
    swal({
      title: "Order Message!",
      text: "Unknown error",
      icon: "error",
    } )
  }
</script>


<script type="text/javascript">
  function addingErrorAlert2()
  {
    swal({
      title: "Order Message!",
      text: "The delivery date cannot be empty when the order had been delivered",
      icon: "error",
    } )
  }
</script>


<!-- Update Popup -->
<script type="text/javascript">
  function updateSuccessAlert()
  {
    swal({
      title: "Order Message!",
      text: "Order updated successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=ordersList";
   } else {
    window.location.href = "index.php?action=ordersList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Order Message!",
      text: "Unknown error",
      icon: "error",
    } )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert2()
  {
    swal({
      title: "Order Message!",
      text: "The delivery date cannot be empty when the order had been delivered",
      icon: "error",
    } )
  }
</script>

<!-- delete Popup-->
<script type="text/javascript">
  function deletingConfirmAlert()
  {
    swal({
      title: "Order Message!",
      text: "are you sure ?",
      icon: "warning",
      buttons: true
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=deleteOrder&order_id=<?= $order_id ?>";
   } else {
    window.location.href = "index.php?action=ordersList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function deletingSuccessAlert()
  {
    swal({
      title: "Order Message!",
      text: "Order deleted successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=ordersList";
   } else {
    window.location.href = "index.php?action=ordersList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function deletingErrorAlert()
  {
    swal({
      title: "Order Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>
