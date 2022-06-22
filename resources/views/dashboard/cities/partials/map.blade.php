<input type="hidden" name="boundaries" value="{{$city->boundaries ?? '{}'}}" class="boundaries-input">
<div class="col-12">
    <div class="col-12">
        <span id="delete-all-button" class="btn btn-danger">{{__('Delete boundaries')}}</span>
    </div>

    <div class="col-12">
        <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
</div>
@section('footer')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?region=SA&libraries=geometry,drawing&language=en&key=AIzaSyA9UeezZ2xyNjrwck8SLdh9NxsJp6HhLQc&callback=initMap&v=weekly&channel=2"></script>

    <script>
        let map,
            zone,
            markers = [],
            zones = [],
            coordinates = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: {lat: 25.104512, lng: 47.4570257},
            });

            function deleteAllShape() {

                zone.setMap(null);
                for (let i = 0; i < zones.length; i++) {
                    zones[i].setMap(null);
                }
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
            }
            google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);
        }


        $(function () {
            let polygon = JSON.parse($('#polygon-template').text());
            const drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                        google.maps.drawing.OverlayType.POLYGON,
                    ],
                },
            });
            drawingManager.setMap(map);
            google.maps.event.addListener(drawingManager, 'polygoncomplete', function (_polygon) {
                let _coordinates = JSON.parse(JSON.stringify(_polygon.getPath().getArray()));
                _coordinates.forEach(function (v) {
                    coordinates.push([v.lng, v.lat])
                });
                polygon.features[0].geometry.coordinates.push(coordinates);
                $(".boundaries-input").val(JSON.stringify(polygon));

            });


            @if(isset($model) && ($model->boundaries && $model->boundaries != "{}"))
            drawSelectedArea(JSON.parse(@json($model->boundaries)), map);
            @endif
            @if(isset($model) && (!is_null($model->latitude) && !is_null($model->longitude)))
            setMarkerOnMap({{$model->latitude}}, {{$model->longitude}}, map)
            @endif

        })

    </script>
    <script>
        function drawSelectedArea(areaZone, map) {
            try {
                let coordinates = areaZone.hasOwnProperty("features") ? areaZone.features[0].geometry.coordinates[0] : [];
                let paths = [];
                let bounds = new google.maps.LatLngBounds();
                coordinates.forEach(function (coordinate) {
                    let lat = coordinate[1];
                    let lng = coordinate[0];

                    bounds.extend(new google.maps.LatLng(lat, lng));
                    paths.push({lat: lat, lng: lng});
                });
                let primaryColor = '#000';
                let secondaryColor = '#3c3c3b';
                zone = new google.maps.Polygon({
                    paths: paths,
                    strokeColor: primaryColor,
                    fillColor: secondaryColor,
                    strokeWeight: 2,
                });
                zones.push(zone);
                map.setCenter(bounds.getCenter());
                map.fitBounds(bounds);

                zone.setMap(map);
            } catch (e) {
                console.log(e);
            }

        }

        function setMarkerOnMap(lat, lng, map, zoom = 5) {
            let marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map
            });
            markers.push(marker);
            map.setCenter(new google.maps.LatLng(lat, lng));
            map.setZoom(zoom);
            map.panTo(marker.position);
            // var markerBounds = new google.maps.LatLngBounds();
            // markerBounds.extend(marker.position);
            // map.fitBounds(markerBounds);


        }

        function restMap() {
            for (let i = 0; i < markers.length; i++) {
                zones[i].setMap(null);
            }
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
        }
    </script>
    <script type="application/json" id="polygon-template">
        {
            "type": "FeatureCollection",
            "features": [
            {
                "type": "Feature",
                "properties": {},
                "geometry": {
                    "type": "Polygon",
                    "coordinates": []
                }
            }
         ]
        }



    </script>
    <script>
        $(".country-select").on("change", function () {
            $(".city-select").html("");
            let country = $(this).val();
            let lat = $(this).find("option:selected").data("lat");
            let lng = $(this).find("option:selected").data("lng");
            let zone = $(this).find("option:selected").data("boundaries");
            restMap();
            drawSelectedArea(zone, map);
            setMarkerOnMap(lat, lng, map);
            $.ajax({
                url: route('admin.countries.country.cities', {country}),
                success: function (data) {
                    $(".city-select").html(data).removeAttr("disabled");
                }
            })
        });
        $(".city-select").on("change", function () {
            let lat = $(this).find("option:selected").data("lat");
            let lng = $(this).find("option:selected").data("lng");
            let zone = $(this).find("option:selected").data("boundaries");
            restMap();
            drawSelectedArea(zone, map);
            setMarkerOnMap(lat, lng, map,10);
        });
    </script>
@endsection
