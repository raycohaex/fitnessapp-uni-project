<?php include(APPROOT . '/views/inc/header.inc.php'); ?>
<div class="container">
  <div class="d-flex justify-content-between">
    <h1>Oefeningen</h1>
    <a class="btn btn-primary my-auto" href="<?php echo URLROOT; ?>/exercises/add">Voeg oefening toe</a>
  </div>
</div>
<div class="container">
  <div class="row">
    <?php foreach ($data['exercises'] as $exercise) : ?>

      <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $exercise->name; ?></h5>
            <p class="card-text"><?php echo $exercise->description; ?></p>
            <a href="<?= URLROOT; ?>/exercises/show/<?= $exercise->id; ?>" class="btn btn-primary">Toevoegen aan schema</a>
          </div>
        </div>
      </div>

    <?php endforeach; ?>

  </div>
</div>

<?php include(APPROOT . '/views/inc/footer.inc.php'); ?>