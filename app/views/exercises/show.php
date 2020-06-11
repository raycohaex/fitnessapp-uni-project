<?php
include(APPROOT . '/views/inc/header.inc.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex border-bottom pb-3 mt-4">
                    <div class="d-flex align-center">
                        <h1 class="card-title"><?= $data['exercise']->name ?></h1>
                        <ul class="list-unstyled d-flex ml-3">
                        <?php foreach($data['exerciseform'] as $exerciseform) : ?>
                            <li class="d-flex align-center"><a class="text-secondary my-auto" href="#selected=<?=$exerciseform->id?>"><?=$exerciseform->name?></a></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="<?= URLROOT; ?>/exercises/edit/<?= $data['exercise']->id; ?>" class="btn btn-warning my-auto ml-auto d-block">Bewerk</a>
                </div>

                <h2>Beschrijving</h2>
                <p><?=$data['exercise']->description ?></p>

                <h2>Uitvoering</h2>
                <div class="container">
                    <?php
                    if ($data['exercise']->repetitions): ?>
                        <dl class="row">
                            <dt class="col-sm-3">repetitions</dt>
                            <dd class="col-sm-9"><?= $data['exercise']->repetitions ?></dd>
                        </dl>
                    <?php
                    endif; ?>
                    <?php
                    if ($data['exercise']->repetitions): ?>
                        <dl class="row">
                            <dt class="col-sm-3">sets</dt>
                            <dd class="col-sm-9"><?= $data['exercise']->sets ?></dd>
                        </dl>
                    <?php
                    endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php
include(APPROOT . '/views/inc/footer.inc.php'); ?>