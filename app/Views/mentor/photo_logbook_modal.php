<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Mentoring <?= strftime("%a, %d %b %Y", strtotime($date_mentoring)) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()">></button>
            </div>
            <img src="<?= base_url() ?>/file/logbook/<?= $activity_photo ?>" alt="">
            <!-- <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> -->

        </div>
    </div>
</div>

<script>
    function closeModal() {
        $(".modal-backdrop").remove();
    }
</script>