<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lokasi Siswa "<?= $name ?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()">></button>
            </div>
            <img src="" alt="">
            <div id="map" style="border-radius: 8px; width: 100%; height: 400px"></div>

        </div>
    </div>
</div>

<script>
    var map = L.map("map").setView([<?= $lat ?>, <?= $long ?>], 16);

    L.esri.Vector.vectorBasemapLayer("ArcGIS:Streets", {
        apikey: 'AAPK40a9b84e145248348faf7141af6f0a8cwEBJEVkfL6c19d8pfqMcvaDZ3TFGulklEN0ZJw2cuTUCG6cBH3MHx6weyhHZRpH4'
    }).addTo(map);
    L.marker([<?= $lat ?>, <?= $long ?>])
        .addTo(map)
        .bindPopup("<b>Lokasi <?= $name; ?></b><br> <?= $address ?>").openPopup();

    setTimeout(function() {
        window.dispatchEvent(new Event("resize"));
    }, 500);

    function closeModal() {
        $(".modal-backdrop").remove();
    }
</script>