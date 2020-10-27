<div class="row mb-5">
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Patient Locations</h5>
            </div>
            <div class="card-body">
                <div id="map-section"></div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">My Note's</h5>
            </div>
            <div class="card-body">
                <form action="/dir/action.php" method="post">
                    <input type="hidden" name="form-notes" value="true" /> 
                    <input type="hidden" name="u_id" value="<?= $payload['userID'] ?>" /> 
                    <div class="form-row">
                        <div class="col-auto">
                            <textarea name="note" required cols="17" placeholder="Write your notes here ... " rows="1" class="form-control"></textarea>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </form>
                <hr/>

                <?php
                if ($data = $database->getNotes($payload['userID'])) {
                    foreach ($data as $row) {
                        ?>
                        <p><?= $row['note'] ?></p>
                        <?php 
                        if ($row['is_completed']) {
                            ?><a href="/dir/action.php?complete=0&note_id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Mark Incompleted</a><?php
                        } else {
                            ?><a href="/dir/action.php?complete=1&note_id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Mark as Done</a><?php
                        } ?>
                        <a href="/dir/action.php?deleted=1&note_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Remove Note</a>
                        <hr/>
                        <?php
                    }
                } ?>           
            </div>
        </div>
    </div>
</div>