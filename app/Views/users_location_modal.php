<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lokasi Mentor "<?= $name ?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()">></button>
            </div>
            <img src="" alt="">
            <div id="map" style="border-radius: 8px; width: 100%; height: 400px"></div>

        </div>
    </div>
</div>

<script>
    var map = L.map("map").setView([<?= $lat ?>, <?= $long ?>], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([<?= $lat ?>, <?= $long ?>])
        .addTo(map)
        .bindPopup("<strong>Lokasi <?= $name; ?></strong><br> <?= $address ?>")
        .openPopup();


    setTimeout(function() {
        window.dispatchEvent(new Event("resize"));
    }, 500);

    function closeModal() {
        $(".modal-backdrop").remove();
    }
</script>