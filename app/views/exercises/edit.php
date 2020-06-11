<?php require APPROOT . '/views/inc/header.inc.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h2>Voeg oefening toe</h2>
      <form action="<?php echo URLROOT; ?>/exercises/patch/<?php echo $data['id'] ?>" method="post">
        <div class="form-group">
          <label for="name">Oefening naam: <sup>*</sup></label>
          <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
          <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
          <label for="description">Beschrijving: <sup>*</sup></label>
          <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description']; ?></textarea>
          <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
        </div>
          <div class="form-group">
              <label for="repetitions">Repetitions: <sup>*</sup></label>
              <textarea name="repetitions" class="form-control form-control-lg <?php echo (!empty($data['repetitions_err'])) ? 'is-invalid' : ''; ?>"><?=($data['repetitions']) ? $data['repetitions'] : ''; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['repetitions_err']; ?></span>
          </div>
          <div class="form-group">
              <label for="sets">Sets: <sup>*</sup></label>
              <textarea name="sets" class="form-control form-control-lg <?php echo (!empty($data['sets_err'])) ? 'is-invalid' : ''; ?>"><?=($data['sets']) ? $data['sets'] : ''; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['sets_err']; ?></span>
          </div>
        <input type="submit" class="btn btn-success" value="Submit">
      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.inc.php'; ?>