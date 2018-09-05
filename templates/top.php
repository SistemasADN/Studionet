<!DOCTYPE html>
<html lang='es'>
  <?php include "validation/checkSession.php";?>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
  <style>
    .modal
    {
      position: fixed;
      top: 150px;
    }
</style>
    <?php include 'header.php'; ?>
    <!-- MAIN CONTAINER -->
    <div class="container-fluid main-container">
      <!-- ACTION BAR CONTAINER -->
      <div class="container-fluid actionbar-container col-sm-2 col-md-2 col-lg-2">
        <?php include "actionbar/actionBar.php"; ?>
      </div>
      <!-- PAGE CONTENT CONTAINER -->

      <div class="container-fluid col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-sm-10 col-md-10 col-lg-10 pagecontent-container" style = "position:absolute;">