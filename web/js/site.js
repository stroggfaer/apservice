var ajax_path = '/repair/ajax/';

$(document).ready(function(){

    if(!$('#is_city_one').length) {
        // Запрос на геолокация;
        $(window).on('load', function () {
          //  window_modal('#modal-windows','repair/ajax/city/', {geo: true}, 'Выбор города');
        });
    }
    //
    $(document).on('click','.js-city',function () {
        window_modal('#modal-windows','repair/ajax/city/', {geo: true}, 'Выбор города');
        return false;
    });

    // Выбор город;
    $(document).one('click','.js-city-one',function () {
        var city_id = $(this).data('city-id');
        $.post('/repair/ajax/city-one',{city_id:city_id},function(response){

        });
    })
});