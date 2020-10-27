<div class="card mb-5">
    <div class="card-header">
        <h5>Excersice Data</h5>
    </div>
    <div class="card-body">
        <form action="/dir/action.php" method="post" class="text-left">
            <div class="form-row">
                <input type="hidden" name="u_id" value="<?= $payload['userID'] ?>" required /> 
                <input type="hidden" name="form-excercies" value="true">

                <div class="form-group col-md-4">
                    <label>Excercise Name</label>
                    <input type="text" class="form-control" placeholder="E.g: Abdomilan" name="name" required />
                </div>
                <div class="form-group col-md-4">
                    <label>Session</label>
                    <input type="text" class="form-control" placeholder="E.g: Session 2" name="session" required />
                </div>
                <div class="form-group col-md-4">
                    <label>Duration</label>
                    <input type="text" class="form-control" placeholder="E.g: 2 hours" name="duration" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Choose Pattern</label>
                    <select class="form-control" name="pattern">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Started</label>
                    <input type="date" class="form-control" name="started" required />
                </div>
                <div class="form-group col-md-4">
                    <label>Ended</label>
                    <input type="date" class="form-control" name="ended" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12">
                    <label>Other Information</label>
                    <textarea name="info" cols="30" rows="3" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    
    <?php
    $excerciseData = $database->getExcerciseData($payload['userID']);
    if ($excerciseData) {
        ?>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
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
                    foreach($excerciseData as $row) {
                        ?>
                        <tr>
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
        <?php
    } ?>
</div>