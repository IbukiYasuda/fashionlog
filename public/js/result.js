let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 35.669049, lng: 139.712035 },
    zoom: 13,
  });
  codeAddress();
}

function codeAddress(){
  let inputAddress = document.getElementById('address').innerHTML;
console.log(inputAddress);
let geocoder = new google.maps.Geocoder();
  geocoder.geocode( { 'address': inputAddress}, function(results, status) {
    if (status == 'OK') {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('該当する結果がありませんでした：' + status);
    }
  });   
}