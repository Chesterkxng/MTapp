
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