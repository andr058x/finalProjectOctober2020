<?php
if ((int) $payload['Role_IDrole'] === 3 || (int) $payload['Role_IDrole'] === 4) {
    include __DIR__ . '/researcher.php';
} ?>

<div class="row">
    <div class="col-9">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h5 class="text-center">Patient Data</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Name</th>
                                <th>Session</th>
                                <th>Duration</th>
                                <th>Pattern</th>
                                <th>Started</th>
                                <th>Ended</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $excerciseData = $database->getAllExcerciseData();
                            foreach($excerciseData as $row) {
                                ?>
                                <tr>
                                    <td><?= $row['patient'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['session'] ?></td>
                                    <td><?= $row['duration'] ?></td>
                                    <td><?= $row['pattern'] ?></td>
                                    <td><?= $row['started_at'] ?></td>
                                    <td><?= $row['ended_at'] ?></td>
                                </tr>
                                <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">CSVs Files</h5>
            </div>
            <div class="card-body">
                <?php
                $findData = $database->getFilesData();

                foreach ($findData as $data) {
                    ?>
                    <a href="/read-csv.php?file=<?= $data['DataURL'] ?>" class="btn btn-block btn-file"><?= $data['DataURL'] ?></a>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>
