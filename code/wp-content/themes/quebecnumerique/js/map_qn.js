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

/* Fonction de vérification pour mobile */
//(function(a){jQuery.browser.mobile=/android.+mobile|avantgo|bada/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)/|plucker|pocket|psp|symbian|treo|up.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw-(n|u)|c55/|capi|ccwa|cdm-|cell|chtm|cldc|cmd-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc-s|devi|dica|dmob|do(c|p)o|ds(12|-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(-|_)|g1 u|g560|gene|gf-5|g-mo|go(.w|od)|gr(ad|un)|haie|hcit|hd-(m|p|t)|hei-|hi(pt|ta)|hp( i|ip)|hs-c|ht(c(-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i-(20|go|ma)|i230|iac( |-|/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |/)|klon|kpt |kwc-|kyo(c|k)|le(no|xi)|lg( g|/(k|l|u)|50|54|e-|e/|-[a-w])|libw|lynx|m1-w|m3ga|m50/|ma(te|ui|xo)|mc(01|21|ca)|m-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|-([1-8]|c))|phil|pire|pl(ay|uc)|pn-2|po(ck|rt|se)|prox|psio|pt-g|qa-a|qc(07|12|21|32|60|-[2-7]|i-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55/|sa(ge|ma|mm|ms|ny|va)|sc(01|h-|oo|p-)|sdk/|se(c(-|0|1)|47|mc|nd|ri)|sgh-|shar|sie(-|m)|sk-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h-|v-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl-|tdg-|tel(i|m)|tim-|t-mo|to(pl|sh)|ts(70|m-|m3|m5)|tx-9|up(.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(-|2|g)|yas-|your|zeto|zte-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

function initialize() {

    var isZoomable = false;
    var isDraggable = true;
    var center = new google.maps.LatLng(46.815256, -71.225401);
    //var isDraggable = jQuery(document).width() > 960 ? true : false;
    var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());

    /* On modifie les propriété de zoom et de drag quand one st en mode plein écran de la carte */
    if (isiPad){isDraggable = false; }
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
    
    if(jQuery('#'+value+':checked').length > 0){
            jQuery.get( directory_theme + "/js/ajax/"+value+".json.php?maxID="+maxID+"periode=&limit=", function(data) {
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
                            imgProfil = '<img src="'+data.statuses[i].user.profile_image_url+'" alt="">';
                        }
                        
                        //if(data.statuses[i].id != maxID){
                            var latlng = new google.maps.LatLng(data.statuses[i].geo.coordinates[0], data.statuses[i].geo.coordinates[1]);
                            if(i == 0){
                                markerCree = createMarker(latlng,'@'+data.statuses[i].user.screen_name,'@'+data.statuses[i].user.screen_name+' : '+data.statuses[i].text+' '+imgProfil,directory_theme + '/images/icon_gmap_'+value.substr(0,1)+'.png',value,0);
                            
                                infowindow.setContent('@'+data.statuses[i].user.screen_name+' : '+data.statuses[i].text+' '+imgProfil); 
                                infowindow.open(map,markerCree);
                            }else{
                                markerCree = createMarker(latlng,'@'+data.statuses[i].user.screen_name,'@'+data.statuses[i].user.screen_name+' : '+data.statuses[i].text+' '+imgProfil,directory_theme + '/images/icon_gmap_'+value.substr(0,1)+'.png',value,1);
                            }
                            
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
