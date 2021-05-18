<?php include(APPROOT . '/views/inc/header.inc.php'); ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
        <?php if($data['title']): ?>
            <h1><?= $data['title']; ?></h1>
        <?php endif; ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if($data['description']): ?>
                    <p><?= $data['description']; ?></p>
                <?php endif; ?>
                <a class="btn btn-primary rounded-0" href="<?= URLROOT . '/exercises'; ?>">Ga terug</a>
            </div>
        </div>
    </div>

<?php include(APPROOT . '/views/inc/footer.inc.php'); ?>