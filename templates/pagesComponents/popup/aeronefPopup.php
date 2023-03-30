
<!-- Update Popup -->
<script type="text/javascript">
  function updateSuccessAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Aeronef Infos modified successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=aeronefsList";
   } else {
    window.location.href = "index.php?action=aeronefsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>


<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>


<!-- adding popup-->

<script type="text/javascript">
  function addingSuccessAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Aeronef added successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=aeronefsList";
   } else {
    window.location.href = "index.php?action=aeronefsList";
   }
  }
    )
  }
</script>




<script type="text/javascript">
  function addingErrorAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>

<!-- end of adding popup-->

<!-- deleting popup-->

<script type="text/javascript">
  function deletingSuccessAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Aeronef deleted successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=aeronefsList";
   } else {
    window.location.href = "index.php?action=aeronefsList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function deletingConfirmAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "are you sure ?",
      icon: "warning",
      buttons: true
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=deleteAeronef&aeronef_id=<?= $aeronef->aeronef_id ?>";
   } else {
    window.location.href = "index.php?action=aeronefsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function deletingErrorAlert()
  {
    swal({
      title: "Aeronef Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>
