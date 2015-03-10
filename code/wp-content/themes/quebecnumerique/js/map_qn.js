/*
 * Création de la carte
 */

var directory_theme      = '/wp-content/themes/quebecnumerique';
var map;

var categories           = ['nouvelles','organisations','evenements','projets'];
var markers              = [];
var markerCluster        = [];

jQuery.each(categories, function( index, value ) {
    markers[value] = [];
});

var stylesCluster        = [];
stylesCluster['nouvelles']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_n.png',
        height: 37,
        width: 37,
        anchor: [16, 0],
        textColor: '#ffffff',
        textSize: 10
      }];
stylesCluster['organisations']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_o.png',
        height: 37,
        width: 37,
        anchor: [16, 0],
        textColor: '#ffffff',
        textSize: 10
      }];
stylesCluster['evenements']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_e.png',
        height: 38,
        width: 38,
        anchor: [16, 0],
        textColor: '#ffffff',
        textSize: 10
      }];
stylesCluster['projets']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_p.png',
        height: 37,
        width: 37,
        anchor: [16, 0],
        textColor: '#ffffff',
        textSize: 10
      }];


var stylesCarte =[
    {
        "stylers": [
            {
                "hue": "#ff1a00"
            },
            {
                "invert_lightness": true
            },
            {
                "saturation": -100
            },
            {
                "lightness": 28
            },
            {
                "gamma": 0.5
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#2D333C"
            }
        ]
    }
]


var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,50)
  });

jQuery(document).ready(function(){
	initialize();
        
    jQuery('.selection').change(function(){
        markerCluster = [];
        jQuery.each(categories, function( index, value ) {
            markers[value] = [];
        });
        initialize();
    });

});

function initialize() {
    var center = new google.maps.LatLng(46.815256, -71.225401);

    map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          scrollwheel: false,
          center: center,
          mapTypeId: google.maps.MapTypeId.ROADMAP
    });
        
    map.setOptions({styles: stylesCarte});
    
    jQuery.each(categories, function( index, value ) {
        if(jQuery('#'+value+':checked').length > 0){
            jQuery.get( directory_theme + "/js/ajax/"+value+".json.php?periode=&limit=", function(data) {
                for (var i = 0; i < data.length; i++) {
                    var latlng = new google.maps.LatLng(data[i].lat, data[i].long);
                    createMarker(latlng,data[i].title,data[i].window,directory_theme + '/images/icon_gmap_'+value.substr(0,1)+'.png',value);
                }
            });
        }
    
        /*.fail(function() {
        });*/
    });
}

function createMarker(latlng,name,html,image,category) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        icon: image,
        map: map,
        title: name,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        marker.mycategory = category;                                 
        markers[category].push(marker);

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    
    markerCluster[category] = new MarkerClusterer(map, markers[category], {
          styles: stylesCluster[category]
        });

    google.maps.event.addListener(markerCluster[category], "click", function (c) {
          var m = c.getMarkers();
          var p = [];
          for (var i = 0; i < m.length; i++ ){
            p.push(m[i].getPosition());
          }          
        });
}