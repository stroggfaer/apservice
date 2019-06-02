
$(document).ready(function(){

   var optionsMap = $("#map-service"),
       $zoom = optionsMap.data('zoom'),
       $geo = optionsMap.data('geo'),
       $addGeo = [$geo.lat ? $geo.lat  :0, $geo.lon ? $geo.lon : 0],
       map =  optionsMap.geoMap({ draggable: true, center: $addGeo, zoom: ($zoom ? $zoom  : 12),mapTypeControl:false});
       console.log('geo',$addGeo);


    map.on("click", function (event) {
        var marker = event.target;
        console.log('event',event.location);
        $.geocode(marker.prop("position"), function(data) {
            console.log('text',data);
        });

    });

    //Настраиваем
    $('.map-content-pointer').each(function(i, item) {
        var $geo = $(this).data('geo'),
            contentString = $(this).find('.content-data').html(),
            lat = $geo.lat ? $geo.lat  : null,
            lon = $geo.lon ? $geo.lon : null;
           if(lat && lon) {
               map.add("markers", [[lat,lon]], { icon: "/images/marker.png",content: '<div class="balloon__mod">'+contentString+'</div>'});
           }
    });

    var markers = map.find("marker");
    var balloon = map.add("infowindow").find("infowindow:last");

    //
    markers.each(function(i, item) {
       if(item) {
           item.on("click", function (event) {
               var marker = event.target, text = marker.prop("content");
               balloon.attr({content: text}).show(map, marker);
           });
       }
    });
});