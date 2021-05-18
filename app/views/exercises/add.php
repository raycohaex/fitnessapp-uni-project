<?php

require APPROOT . '/views/inc/header.inc.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Voeg oefening toe</h2>
                <form action="<?php
                echo URLROOT; ?>/exercises/save" method="post">

                    <div class="form-group">
                        <label for="name">Oefening naam: <sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-lg <?php
                        echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?= ($data['name']) ? $data['name'] : ''; ?>">
                        <span class="invalid-feedback"><?php
                            echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Beschrijving: <sup>*</sup></label>
                        <textarea name="description"
                                  class="form-control form-control-lg <?= (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?= ($data['description']) ? $data['description'] : ''; ?></textarea>
                        <span class="invalid-feedback"><?php
                            echo $data['description_err']; ?></span>
                    </div>
                    <div class="input-group my-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Selecteer</label>
                        </div>

                        <select <?= ($data['exerciseforms']['error'] !== null) ? 'disabled' : ''; ?>
                                name="exerciseFormOption" class="custom-select" id="inputGroupSelect01">
                            <option selected>Kies een vorm...</option>
                            <?php
                            if ($data['exerciseforms']['error'] == null):
                            foreach ($data['exerciseforms']['exerciseforms'] as $exerciseform) : ?>
                                <option value="<?= $exerciseform->id ?>"><?= $exerciseform->name ?></option>
                            <?php
                            endforeach;
                            endif; ?>
                        </select>
                        <?php
                        if ($data['exerciseforms']['error'] !== null): ?>
                            <span class="invalid-feedback d-block">Er is een fout opgetreden bij het ophalen van de oefening vormen. Probeer het later opnieuw.</span>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="repetitions">Repetitions: </label>
                            <input type="number" name="repetitions" class="form-control form-control-lg <?php
                            echo (!empty($data['repetitions_err'])) ? 'is-invalid' : ''; ?>"><?= ($data['repetitions']) ? $data['repetitions'] : ''; ?>
                            <span class="invalid-feedback"><?php
                                echo $data['repetitions_err']; ?></span>
                        </div>
                        <div class="form-group col-6">
                            <label for="sets">Sets: </label>
                            <input type="number" name="sets" class="form-control form-control-lg <?php
                            echo (!empty($data['sets_err'])) ? 'is-invalid' : ''; ?>"><?= ($data['sets']) ? $data['sets'] : ''; ?>
                            <span class="invalid-feedback"><?php
                                echo $data['sets_err']; ?></span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>

<?php
require APPROOT . '/views/inc/footer.inc.php'; ?>