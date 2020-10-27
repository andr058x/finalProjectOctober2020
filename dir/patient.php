<div class="row">
    <div class="col-12">
        
        <?php
        include_once __DIR__ . '/patient-form.php'; ?>

        <div class="card">
            <div class="card-body text-center">

                <div class="row">
                    <div class="col-6 my-3">
                        <iframe src="//www.youtube.com/embed/MsXlZ_phGNY" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="col-6 my-3">
                        <iframe src="//www.youtube.com/embed/wkDiOCIX_xA" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="col-6 my-3">
                        <iframe src="//www.youtube.com/embed/JtZ4pO0AzbM" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="col-6 my-3">
                        <iframe src="//www.youtube.com/embed/Ez2GeaMa4c8" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    if ((int) $payload['Role_IDrole'] === 3 || (int) $payload['Role_IDrole'] === 4) {
        include __DIR__ . '/research-sidebar.php';
    } ?>
</div>