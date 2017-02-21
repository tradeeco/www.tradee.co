
var GoogleMap = function () {

    var panorama1, panorama2;

    // Return
    return {

      //Basic Map
      initGoogleMap: function () {

        /* Map */
              // Create a new StyledMapType object, passing it an array of styles,
              // and the name to be displayed on the map type control.
          var styledMapType = new google.maps.StyledMapType(
              [
                  {
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#f5f5f5"
                          }
                      ]
                  },
                  {
                      "elementType": "labels.icon",
                      "stylers": [
                          {
                              "visibility": "off"
                          }
                      ]
                  },
                  {
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#616161"
                          }
                      ]
                  },
                  {
                      "elementType": "labels.text.stroke",
                      "stylers": [
                          {
                              "color": "#f5f5f5"
                          }
                      ]
                  },
                  {
                      "featureType": "administrative.land_parcel",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#bdbdbd"
                          }
                      ]
                  },
                  {
                      "featureType": "poi",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#eeeeee"
                          }
                      ]
                  },
                  {
                      "featureType": "poi",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#757575"
                          }
                      ]
                  },
                  {
                      "featureType": "poi.park",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#e5e5e5"
                          }
                      ]
                  },
                  {
                      "featureType": "poi.park",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#9e9e9e"
                          }
                      ]
                  },
                  {
                      "featureType": "road",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#ffffff"
                          }
                      ]
                  },
                  {
                      "featureType": "road.arterial",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#757575"
                          }
                      ]
                  },
                  {
                      "featureType": "road.highway",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#dadada"
                          }
                      ]
                  },
                  {
                      "featureType": "road.highway",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#616161"
                          }
                      ]
                  },
                  {
                      "featureType": "road.local",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#9e9e9e"
                          }
                      ]
                  },
                  {
                      "featureType": "transit.line",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#e5e5e5"
                          }
                      ]
                  },
                  {
                      "featureType": "transit.station",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#eeeeee"
                          }
                      ]
                  },
                  {
                      "featureType": "water",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "color": "#c9c9c9"
                          }
                      ]
                  },
                  {
                      "featureType": "water",
                      "elementType": "labels.text.fill",
                      "stylers": [
                          {
                              "color": "#9e9e9e"
                          }
                      ]
                  }
              ],
          {name: 'Styled Map'});

              // Create a map object, and include the MapTypeId to add
              // to the map type control.
          var fenway = {lat: -36.7259, lng: 174.6983};

          var map = new google.maps.Map(document.getElementById('map'), {
              center: fenway,
              zoom: 11,
              mapTypeControlOptions: {
                  mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                      'styled_map']
              },
              disableDefaultUI: true
          });

          var image = {
              url: 'img/loading-logo-icon.png',
          };

              var marker = new google.maps.Marker({
                  position: fenway,
                  map: map,
                  title: 'Company, Inc.',
                  icon: image
              });

              //Associate the styled map with the MapTypeId and set it to display.
              map.mapTypes.set('styled_map', styledMapType);
              map.setMapTypeId('styled_map');

      },
      // End Basic Map



      // Basic Panorama Map 1
      initPanorama1: function () {

        panorama = new google.maps.StreetViewPanorama(
          document.getElementById('pano1'),
          {
            position: {lat: 40.748866, lng: -73.988366},
            pov: {heading: 165, pitch: 0},
            zoom: 1
          }
        );

      },
      // End Basic Panorama Map 1


      // Basic Panorama Map 2
      initPanorama2: function () {

        panorama = new google.maps.StreetViewPanorama(
          document.getElementById('pano2'),
          {
            position: {lat: 42.345573, lng: -71.098326},
            pov: {heading: 165, pitch: 0},
            zoom: 1
          }
        );

      },
      // End Basic Panorama Map 2

    };
    // End Return

}();