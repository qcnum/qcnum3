/*
 * Création de la carte
 */

var directory_theme      = '/wp-content/themes/quebecnumerique';
var map;

var categories           = ['nouvelles', 'articles' ,'organisations','evenements','projets'];
var markers              = [];
var allMarkers           = [];
var markerCluster        = [];

var limitTweets          = 500;

jQuery.each(categories, function( index, value ) {
    markers[value] = [];
});
markers['twitter'] = [];

var stylesCluster        = [];
stylesCluster['nouvelles']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_n.png',
        height: 37,
        width: 37,
        anchor: [16, 0],
        textColor: '#ffffff',
        textSize: 10
      }];
stylesCluster['articles']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_a.png',
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
stylesCluster['twitter']      = [{
        url: directory_theme + '/images/icon_gmap_cluster_t.png',
        height: 38,
        width: 38,
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
];


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

    var isZoomable = false;
    var center = new google.maps.LatLng(46.815256, -71.225401);
    var isDraggable = jQuery(document).width() > 480 ? true : false;
    var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
    var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());

    /* On modifie les propriété de zoom et de drag quand on est en mode plein écran de la carte */
    if ( isiDevice || isAndroid ){ isDraggable = false; }
    if ( jQuery(".map-content").hasClass('full-screen-map') ) { isDraggable = true;}
    if ( jQuery(".map-content").hasClass('full-screen-map') ) { isZoomable = true;}
     
    map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          scrollwheel: isZoomable,
          draggable: isDraggable,
          center: center,
          mapTypeId: google.maps.MapTypeId.ROADMAP
    });
        
    map.setOptions({styles: stylesCarte});
    
    //cas si single
    var lngSingle = '';
    var latSingle = '';
    if(jQuery('#singleMapLat').length && jQuery('#singleMapLat').val() != '' && jQuery('#singleMapLng').length && jQuery('#singleMapLng').val() != '' ){
        latSingle     = jQuery('#singleMapLat').val();
        lngSingle     = jQuery('#singleMapLng').val();
    }
    
    jQuery.each(categories, function( index, value ) {
        if(jQuery('#'+value+':checked').length > 0){
            jQuery.get( directory_theme + "/js/ajax/"+value+".json.php?periode=&limit=", function(data) {
                for (var i = 0; i < data.length; i++) {
                    var latlng     = new google.maps.LatLng(data[i].lat, data[i].long);
                    var iconMarker = directory_theme + '/images/icon_gmap_'+value.substr(0,1)+'.png';
                    
                    //cas si single
                    if(latSingle == data[i].lat && lngSingle == data[i].long){
                        iconMarker = directory_theme + '/images/icon_gmap_single_'+value.substr(0,1)+'.png';
                        createMarker(latlng,data[i].title,data[i].window,iconMarker,value,0);
                    }else{
                        createMarker(latlng,data[i].title,data[i].window,iconMarker,value,1);
                    }
                }
            });
        }
    
        /*.fail(function() {
        });*/
    });
    
    //Twitter
    listMarkersTweets();
}

function createMarker(latlng,name,html,image,category,cluster) {
    var min = .999999;
    var max = 1.000001;
    
    var contentString = html;
    var finalLatLng   = latlng;
    
    if (allMarkers.length > 0) {
            for (i=0; i < allMarkers.length; i++) {
                var existingMarker = allMarkers[i];
                var pos = existingMarker.getPosition();

                //if a marker already exists in the same position as this marker
                if (latlng.equals(pos)) {
                    //update the position of the coincident marker by applying a small multipler to its coordinates
                    var newLat = latlng.lat() * (Math.random() * (max - min) + min);
                    var newLng = latlng.lng() * (Math.random() * (max - min) + min);

                    finalLatLng = new google.maps.LatLng(newLat,newLng);

                }                   
            }
    }
    
    var marker = new google.maps.Marker({
        position: finalLatLng,
        icon: image,
        map: map,
        title: name,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        
        marker.mycategory = category; 
        if(cluster){
            markers[category].push(marker);
        }
        allMarkers.push(marker);

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    
    if(cluster){
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
        
    return marker;
}



function listMarkersTweets(cptReturn,maxID){
    
    var markerCree;
    
    cptReturn   = typeof cptReturn   !== 'undefined' ? cptReturn : 0;
    maxID       = typeof maxID   !== 'undefined' ? maxID : 0;
        
    var value = 'twitter';
    var nocache = new Date().getTime();
    
    if(jQuery('#'+value+':checked').length > 0){
            jQuery.get( directory_theme + "/js/ajax/"+value+".json.php?maxID="+maxID+"periode=&limit=&cache="+nocache, function(data) {
                if(data.statuses.length > 0){
                    var cpt    = cptReturn;
                    var lastID = 0;
                    for (var i = 0; i < data.statuses.length; i++) {
                        
                        /*Quelques variables pour agrémenter les infowindows :
                         * - data.statuses[i].user.profile_image_url photo du profil
                         * - data.statuses[i].user.name nom du profil
                         * - data.statuses[i].user.url
                         */
                        
                        var imgProfil ="";
                        if(data.statuses[i].user.profile_image_url.length > 0){
                            imgProfil = '<img class="img-twitter" src="'+data.statuses[i].user.profile_image_url+'" alt="">';
                        }
                        
                        //if(data.statuses[i].id != maxID){
                            var latlng = new google.maps.LatLng(data.statuses[i].geo.coordinates[0], data.statuses[i].geo.coordinates[1]);
                            /*if(i == 0){
                                 markerCree = createMarker(latlng,'@'+data.statuses[i].user.screen_name,'<div class=twitter-window>' + imgProfil + '<div class="content"><a href="https://twitter.com/@' + data.statuses[i].user.screen_name + '" target="_blank"><h3>@'+ data.statuses[i].user.screen_name +'</h3></a><hr class="clear"><p>'+data.statuses[i].text+'</p></div></div>', directory_theme + '/images/icon_gmap_'+value.substr(0,1)+'.png',value,1);
                            
                                infowindow.setContent('<div class=twitter-window>' + imgProfil + '<div class="content"><a href="https://twitter.com/@' + data.statuses[i].user.screen_name + '" target="_blank"><h3>@'+ data.statuses[i].user.screen_name +'</h3></a><hr class="clear"><p>'+data.statuses[i].text+'</p></div></div>'); 
                                infowindow.open(map,markerCree);
                            }else{*/
                                markerCree = createMarker(latlng,'@'+data.statuses[i].user.screen_name,'<div class=twitter-window>' + imgProfil + '<div class="content"><a href="https://twitter.com/@' + data.statuses[i].user.screen_name + '" target="_blank"><h3>@'+data.statuses[i].user.screen_name+'</h3></a><hr class="clear"><p>'+data.statuses[i].text+'</p></div></div>', directory_theme + '/images/icon_gmap_'+value.substr(0,1)+'.png',value,1);
                               
                            //}
                            
                            lastID = data.statuses[i].id;

                            cpt++;
                        //}
                        
                    }
                    if(cpt < limitTweets && lastID > 0){
                        listMarkersTweets(cpt,lastID)
                    }
                }
            });
        }
}
