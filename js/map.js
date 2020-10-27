let map;

function initMap() {
    var map = new google.maps.Map(document.getElementById('map-section'), {
        center: new google.maps.LatLng(56.2639, 9.5018),
        zoom: 2
    });
    var infoWindow = new google.maps.InfoWindow;

    downloadUrl('/dir/users.xml', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
            var name = markerElem.getAttribute('name');
            var email = markerElem.getAttribute('email');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));
            
            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            var text = document.createElement('text');

            strong.textContent = name;
            text.textContent = email
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));
            infowincontent.appendChild(text);

            var icon = { label: 'U' };

            var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
            });

            marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
            });
        });
    });
}

function initSearchLocation() {
    // Create the search box and link it to the UI element.
    const input = document.getElementById("location");
    const searchBox = new google.maps.places.SearchBox(input);
    

}

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() {}