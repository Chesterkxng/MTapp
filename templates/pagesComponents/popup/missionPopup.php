<!-- adding Popup-->

<script type="text/javascript">
  function addingSuccessAlert()
  {
    swal({
      title: "Mission Message!",
      text: "Mission added successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=missionList";
   } else {
    window.location.href = "index.php?action=missionList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function addingErrorAlert()
  {
    swal({
      title: "Mission Message!",
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
      title: "Mission Message!",
      text: "Mission updated successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=missionList";
   } else {
    window.location.href = "index.php?action=missionList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function updateErrorAlert()
  {
    swal({
      title: "Mission Message!",
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
      title: "Mission Message!",
      text: "are you sure ?",
      icon: "warning",
      buttons: true
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=deleteMission&mission_id=<?= $mission_id ?>";
   } else {
    window.location.href = "index.php?action=missionList";
   }
  }
    )
  }
</script>



<script type="text/javascript">
  function deletingSuccessAlert()
  {
    swal({
      title: "Mission Message!",
      text: "Mission deleted successfully!",
      icon: "success",
    } ).then(okay => {
   if (okay) {
    window.location.href = "index.php?action=missionList";
   } else {
    window.location.href = "index.php?action=missionnList";
   }
  }
    )
  }
</script>


<script type="text/javascript">
  function deletingErrorAlert()
  {
    swal({
      title: "Mission Message!",
      text: "Unknown error!",
      icon: "error",
    } );

  }
</script>