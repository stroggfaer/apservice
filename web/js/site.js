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

    // Карусель для контента;
    if($(".js-slider").length) {
        //loadContent('show');
        setTimeout(function(){
            // Карусель
            $(".js-slider .items").slick({
                dots: true,
                autoplay: false,
                autoplaySpeed: 6000,
                mobileFirst: true,
                speed: 1000,
                slidesToShow: 1,
                arrows: false,
                slidesToScroll: 1
            });
            //  loadContent('hide');
        },1000);
    }

    // Карусель для контента;
    if($(".gallery-items").length) {
        //loadContent('show');
        setTimeout(function(){
            // Карусель
            $(".gallery-items .items").slick({
                autoplay: false,
                autoplaySpeed: 6000,
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 6,
                slidesToScroll: 6,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 930,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 630,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                ]
            });
            //  loadContent('hide');
        },1000);
    }

    // Карусель для контента;
    if($(".gallery-info").length) {
        //loadContent('show');
        setTimeout(function(){
            // Карусель
            $(".gallery-info .items").slick({
                dots: true,
                autoplay: true,
                autoplaySpeed: 6000,
                mobileFirst: true,
                speed: 1000,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow: '<i class="fa fa-chevron-circle-left fa-4x" aria-hidden="true"></i>',
                nextArrow: '<i class="fa fa-chevron-circle-right fa-4x" aria-hidden="true"></i>',
                responsive: [
                    {
                        breakpoint: 520,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                ]
            });
            //  loadContent('hide');
        },1000);
    }

    if($(".gallery-info-one").length) {
        //loadContent('show');
        setTimeout(function(){
            // Карусель
            $(".gallery-info-one .items").slick({
                dots: false,
                autoplay: false,
                autoplaySpeed: 6000,
                mobileFirst: true,
                speed: 1000,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow: '<i class="fa fa-chevron-circle-left fa-4x" aria-hidden="true"></i>',
                nextArrow: '<i class="fa fa-chevron-circle-right fa-4x" aria-hidden="true"></i>',
            });
            //  loadContent('hide');
        },1000);
    }

    if($(".devices_carusel").length) {

        //loadContent('show');
        setTimeout(function(){
            // Карусель
            $(".devices_carusel .items").slick({
                dots: false,
                autoplay: false,
                autoplaySpeed: 6000,
                // mobileFirst: true,
                // infinite: false,
                speed: 1000,
                arrows: true,
                slidesToShow: 8,
                slidesToScroll: 8,
                prevArrow: '<i class="fa fa fa-angle-left" aria-hidden="true"></i>',
                nextArrow: '<i class="fa fa fa-angle-right" aria-hidden="true"></i>',
                responsive: [
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 6,
                        }
                    },
                ]
            });
            //  loadContent('hide');
        },1000);
    }

    $('.navbar-toggle').click(function(){
        $(this).children('div').toggleClass('open');
    });

    $("[data-fancybox]").fancybox();

    $('.js-menu').hover(function () {
        clearTimeout($.data(this, 'timer'));
        $('.hidden-slide_menu-module', this).stop(true, true).show();
    }, function () {
        $.data(this, 'timer', setTimeout($.proxy(function () {
            $('.hidden-slide_menu-module', this).stop(true, true).hide();
        }, this), 100));
    });
});

// Выбор девайс;
$(document).on('change','.js-select-devices-form',function () {
    var device_id = parseInt($(this).val());
    if(device_id) {
        loading('show');
        $.post(ajax_path+'/diagnostics',{select_devices_form:true,device_id:device_id},function(response){

            $(".update-select__js").html($(response).find('.update-select__js').html());
            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());

            loading('hide');
        });
    }else{
        loading('show');
        $.post(ajax_path+'/diagnostics',{select_devices_remove:true},function(response){

            $(".update-select__js").html($(response).find('.update-select__js').html());
            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());

            loading('hide');
        });
    }
    return false
});

// Выбор проблемы;
$(document).on('change','.js-select-devices-problems-form',function () {
    var device_problem_id = parseInt($(this).val());
    if(device_problem_id) {
        loading('show');
        $.post(ajax_path+'/diagnostics',{select_devices_problems_form:true,device_problem_id:device_problem_id},function(response){

            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());

            loading('hide');
        });
    }else{
        loading('show');
        $.post(ajax_path+'/diagnostics',{select_devices_problems_remove:true},function(response){

            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());

            loading('hide');
        });
    }
    return false
});

// Таб переключение
$(document).on('click','.js-tab-button',function(){
    var k = $(this).data('key');
    $('.js-tab-button').removeClass('active');
    $(this).addClass('active');
    $(".tab__com .tab").removeClass('active');
    $(".tab__com .tab[data-key="+ k +"]").data('key',k).addClass('active');
    return false;
});

console.log('Scripts Version 3.2.0 ');