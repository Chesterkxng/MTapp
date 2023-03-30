<!-- adding Popup -->

<script type="text/javascript">
  function addingSuccessAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "Breakdown added successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=breakdownList";
   } else {
    window.location.href = "index.php?action=breakdownList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function addingErrorAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "Unknown error",
      icon: "error",
    } )
  }
</script>

<!-- Update Popup -->

<script type="text/javascript">
  function updateSuccessAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "Breakdown updated successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=breakdownList";
   } else {
    window.location.href = "index.php?action=breakdownList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "Unknown error",
      icon: "error",
    } )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert2()
  {
    swal({
      title: "Breakdown Message!",
      text: "The repair end date cannot be empty when the breakdown had been repaired",
      icon: "error",
    } )
  }
</script>


<!-- delete Popup-->
<script type="text/javascript">
  function deletingConfirmAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "are you sure ?",
      icon: "warning",
      buttons: true
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=deleteBreakdown&breakdown_id=<?= $breakdown->breakdown_id ?>";
   } else {
    window.location.href = "index.php?action=breakdownList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function deletingSuccessAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "Breakdown deleted successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=breakdownList";
   } else {
    window.location.href = "index.php?action=breakdownList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function deletingErrorAlert()
  {
    swal({
      title: "Breakdown Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>