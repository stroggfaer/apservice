
$(document).ready(function(){
    map();


});

function map() {
    var myMap,myPlacemark;
    var url = window.location.pathname;
    ymaps.ready(function () {
        var myGeocoder = ymaps.geocode('г. Новосибирск');

        myGeocoder.then(
            function (res) {
                // Кординаты;
                var coords = res.geoObjects.get(0).geometry.getCoordinates();

                myGeocoder.then(
                    function (res) {
                        myMap = new ymaps.Map("map", {
                            center: [55.0215, 82.7891],
                            zoom: 12
                        });
                        //myMap.behaviors.disable('multiTouch');
                      //  myMap.behaviors.disable(['drag']);

                        //Отслеживаем событие перемещения позиция карта;
                        myMap.events.add('boundschange', function (event) {
                            if (event.get('newCenter') != event.get('oldCenter')) {
                                var center = myMap.getCenter();
                                var new_center = [center[0].toFixed(4), center[1].toFixed(4)];
                                console.log(new_center);
                            }
                        });

                        myMap.controls.add('zoomControl');

                        // Массивы метки;
                        var dataMap = [[55.0485764399064, 82.9115400143297], [54.99010939, 82.90324643]],
                            myCollection= [],
                            myAddress = ['Адресс 1','Адресс 2'];

                        // Добавляем метки на карте;
                        for (var i = 0, len = dataMap.length; i < len; i++) {

                                myCollection[i] = balun_map(dataMap[i],myAddress[i]);
                                myMap.geoObjects.add(myCollection[i]);

                                // myCollection[club_id[i]].events.add('mouseenter', function (e) {
                                //     e.get('target').options.set('iconImageHref', '/images/clubs/balun_ex_hover.png');
                                // });
                                // myCollection[club_id[i]].events.add('mouseleave', function (e) {
                                //     e.get('target').options.set('iconImageHref', '/images/clubs/balun_ex.png');
                                // });

                        }

                        // Создать балун;
                        function balun_map(map_lon, myAddress) {
                            myPlacemark = new ymaps.Placemark(map_lon,{
                                balloonContentHeader: myAddress,
                                balloonContentBody: "Содержимое <em>балуна</em> метки",
                               // balloonContentFooter: "Подвал",
                               // hintContent: "Хинт метки",
                            },{
                                preset:'islands#blueIcon',
                                iconLayout: 'default#image',
                               // iconImageHref: '/images/clubs/balun_ex.png',
                               //iconImageSize: [45, 44],
                                //   iconImageHref: (type ? '/images/clubs/ex_marker_active.png' : '/images/clubs/ex_marker.png'),
                                //   iconImageSize: [28, 38],



                                balloonShadow: false
                            });
                            return  myPlacemark;
                             // return myMap.geoObjects.add(myPlacemark);
                        }
                    }
                );
            });
    });
}
