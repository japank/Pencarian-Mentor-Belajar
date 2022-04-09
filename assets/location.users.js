var map, infoWindow,geocoder,marker,accuracyStatus;
var output = document.getElementById("output");

function initMap(){
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: 0.3439242, lng:102.3072246}
});

infowindow = new google.maps.InfoWindow();
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
    if(position.coords.accuracy<100){
        accuracyStatus = "Akurasi : "+position.coords.accuracy.toFixed(2)+"Bagus";
        document.getElementById("lat2").value = position.coords.latitude;
        document.getElementById("long2").value = position.coords.longitude;
    }
    else{
        accuracyStatus = `Akurasi : ${position.coords.accuracy.toFixed(2)}Lemah`;
    }
    var pos = {
        lat: position.coords.latitude, lng: position.coords.longitude
    };
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': pos}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setZoom(15);
            map.setCenter(pos);
            marker = new google.maps.Marker({
                position: pos,
                map: map,
                animation: google.maps.Animation.BOUNCE,
            });

            var infowindowText = "<div class='text-center'><strong>Posisi Saat Ini</strong>"+results[3].formatted_address+ "Lat : " + pos.lat.toFixed(5)+ " |  Long : " + pos.lng.toFixed(5)+ "" + accuracyStatus+""+ '</strong></div>';
            infowindow.setContent(infowindowText);
            infowindow.open(map, marker);
            marker.addListener('click',function() {
                infowindow.open(map,marker);
            });
            output.innerHTML = results[0].formatted_address+"<br>Latitude : <span id='latitude'>"+pos.lat+"</span>Longitude : <span id='longitude'>"+pos.lng+"</span>";

        }
    });
    }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
    });
} else {
    handleLocationError(false, infoWindow, map.getCenter());
}
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
infoWindow.setPosition(pos);
infoWindow.setContent(browserHasGeolocation ?
'<span class="alert alert-danger">Error: The Geolocation service failed.</span>' :
'<span class="alert alert-danger">Error: Your browser doesnt support geolocation.</span>');
infoWindow.open(map);
}