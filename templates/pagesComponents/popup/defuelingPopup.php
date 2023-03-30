<!-- adding Popup -->
<script type="text/javascript">
  function addingSuccessAlert()
  {
    swal({
      title: "Defueling Message!",
      text: "defueling added successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=defuelingsList";
   } else {
    window.location.href = "index.php?action=defuelingsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function addingErrorAlert()
  {
    swal({
      title: "Defueling Message!",
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
      title: "Defueling Message!",
      text: "Defueling updated successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=defuelingsList";
   } else {
    window.location.href = "index.php?action=defuelingsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Defueling Message!",
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
      title: "Defueling Message!",
      text: "are you sure ?",
      icon: "warning",
      buttons: true
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=deleteDefueling&defueling_id=<?= $defueling_id ?>";
   } else {
    window.location.href = "index.php?action=defuelingsList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function deletingSuccessAlert()
  {
    swal({
      title: "Defueling Message!",
      text: "Defueling deleted successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=defuelingsList";
   } else {
    window.location.href = "index.php?action=defuelingsList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function deletingErrorAlert()
  {
    swal({
      title: "Defueling Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>
