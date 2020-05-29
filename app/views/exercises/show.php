<?php include(APPROOT . '/views/inc/header.inc.php'); ?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="card-title"><?php echo $data['exercise']->name; ?></h1>
      <p><?php echo $data['exercise']->description; ?></p>
    </div>
  </div>
</div>

<?php include(APPROOT . '/views/inc/footer.inc.php'); ?>