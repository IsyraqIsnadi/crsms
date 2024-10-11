<style>
#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
  height: 50px;
  margin-top: 20px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}

</style>    
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pick Up') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('pick_up.store') }}" method="POST">
                            @csrf
                            <input type="text" name="service_request_id" placeholder="Service Request ID" class="input input-bordered" value="{{ $service_request->id }}" hidden>
                            <label class="label text-bold" for="device_description">Pick Up Address</label>   
                            <input
                              id="pac-input"
                              name="address"
                              class="controls"
                              type="text"
                              placeholder="Enter pickup address"
                              style="width: 80%"
                            />

                            <div id="map" style="width:100%;height:400px;"></div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="latitude">
                              </div>
                              <div class="form-group">
                                <input type="hidden" class="form-control" id="longitude">
                              </div>

                              
                            <br><input class="btn mt-3" type="submit">
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.min.js?features=default"></script>

<script>
   
    function initMap() {

      var pin_marker;

      // Get the user's current location
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        // Center the map on the user's current location
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: pos
        });

        // Add a marker for the user's current location
        pin_marker = new google.maps.Marker({
          position: pos,
          map: map,
          title: 'Pinned location',
          draggable: true
        });

        // Add a dragend event listener to the marker
        google.maps.event.addListener(pin_marker, 'dragend', function(event) {
          // Update the values of the input fields with the marker's latitude and longitude
          document.getElementById('latitude').value = event.latLng.lat();
          document.getElementById('longitude').value = event.latLng.lng();
        });


        // Initialize the Autocomplete feature
        // Create the search box and link it to the UI element.
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
        });

        let markers = [];

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            
          const places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach((marker) => {
            marker.setMap(null);
          });

          markers = [];

          // For each place, get the icon, name and location.
          const bounds = new google.maps.LatLngBounds();

          places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
              console.log("Returned place contains no geometry");
              return;
            }

            const icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25),
            };

            // Create a marker for each place.
            markers.push(
              new google.maps.Marker({
                map,
                icon,
                title: place.name,
                position: place.geometry.location,
              })
            );

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }

          });

          map.fitBounds(bounds);

          // Get the first place in the search results
        var place = places[0];

        // Update the marker's position
        pin_marker.setPosition(place.geometry.location);

        pin_marker.setDraggable(true);

        //update fields
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();

        });//end of place changed listener

      });

    // Initialize the map when the page loads
    google.maps.event.addDomListener(window, 'load', initMap);

    }

  </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiyf0K2SL3k9iXh7cKB4mB7eo3g4jd39k&callback=initMap&libraries=places"></script>

