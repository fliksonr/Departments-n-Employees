<?php

/** @var $this yii\web\View
 * @var $departments
 * @var $employees
 */

$this->title = 'My Yii Application';
?>

<div class="col-8  col-12-narrower imp-narrower">
    <div id="content">

        <!-- Content -->

        <h2>Сетка сотрудники-отделы</h2>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th></th>
                <?php foreach($departments as $key => $val): ?>
                    <th><?= $val->name ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($employees as $val => $key):?>
                <tr>
                    <th><?= $key->first_name . " " . $key->last_name ?></th>

                    <?php foreach ($departments as $val_dep => $key_dep): ?>

                        <?php $count = 0 ?>

                        <?php foreach ($key->departments as $val_emp_dep => $key_emp_dep): ?>
                            <?php if ($key_emp_dep['name'] == $key_dep->name): ?>
                                <th>V</th>
                                <?php $count++ ?>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <?php if($count == 0):?>
                            <td> </td>
                        <?php endif; ?>

                    <?php endforeach; ?>


                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>



    </div>
</div>

