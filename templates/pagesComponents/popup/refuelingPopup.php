<!-- adding Popup -->
<script type="text/javascript">
  function addingSuccessAlert()
  {
    swal({
      title: "Refueling Message!",
      text: "Refueling added successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=refuelingsList";
   } else {
    window.location.href = "index.php?action=refuelingsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function addingErrorAlert()
  {
    swal({
      title: "Refueling Message!",
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
      title: "Refueling Message!",
      text: "Refueling updated successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=refuelingsList";
   } else {
    window.location.href = "index.php?action=refuelingsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Refueling Message!",
      text: "Unknown error",
      icon: "error",
    } )
  }
</script>


<!-- delete Popup-->
<script type="text/javascript">
  function deletingConfirmAlert()
  {
    swal({
      title: "Refueling Message!",
      text: "are you sure ?",
      icon: "warning",
      buttons: true
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=deleteRefueling&refueling_id=<?= $refueling_id ?>";
   } else {
    window.location.href = "index.php?action=refuelingsList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function deletingSuccessAlert()
  {
    swal({
      title: "Refueling Message!",
      text: "Refueling deleted successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=refuelingsList";
   } else {
    window.location.href = "index.php?action=refuelingsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function deletingErrorAlert()
  {
    swal({
      title: "Refueling Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>
