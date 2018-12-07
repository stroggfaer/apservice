var ajax_path = '/repair/ajax/';
var domain_city = '.apple.pc'; // apple.sc

$(document).ready(function(){

    if($('#is_city_one').length) {
        // Запрос на геолокаций;
        $(window).on('load', function () {
            $('.js-city').click();
        });
    }
    //
    $(document).on('click','.js-city',function () {
        window_modal('repair/ajax/city','Выбор города',{geo:true},'#window-modal');
        return false;
    });

    // Заопмним город;
    $(document).one('click','.js-city-one',function () {
        var domain = $(this).data('domen');
        //
        $.cookie('MCS_CITY_CODE', domain, {
            domain: domain_city // apple.sc
        });
        //console.log('domain',domain);
    });

    // Закрыть модалка;
    $('#window-modal').on('hidden.bs.modal', function (e) {
        if($('#city-modal').length) {
            var domain = $('#city-modal').data('domen');
            $.cookie('MCS_CITY_CODE', domain, {
                domain: domain_city // apple.sc
            });
        }
    });

    // Авто скролл;
    if($('#scroll-1001').length) {
        $('html,body').stop().animate({'scrollTop': $('#scroll-1001').offset().top - 600}, 800, 'swing', function () {
        });
    }


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

       // loadContent('show');
      //  setTimeout(function(){
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
      //  },3000);
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

// Мобильная версия меню;
$(document).on('click','.js-menu-mobile',function () {
    var element = $(this);
    element.find('.slide_menu-btn').toggleClass('open');
    $("#menu").fadeToggle();
    $('.bg-show').toggle();
    return false;
});
$(document).on('click','.bg-show',function () {
    $(this).hide();
    $(".js-menu-mobile .slide_menu-btn").removeClass('open');
    $("#menu").fadeOut();
    return false;
});

// Выбор девайс;
$(document).on('change','.js-select-devices-form',function () {
    var device_id = parseInt($(this).val());
    if(device_id) {
        loading('show');
        $.post(ajax_path+'diagnostics',{select_devices_form:true,device_id:device_id},function(response){

            $(".update-select__js").html($(response).find('.update-select__js').html());
            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());
            $(".text-left h2").html($(response).find('.text-left h2').html());

            loading('hide');
        });
    }else{
        loading('show');
        $.post(ajax_path+'diagnostics',{select_devices_remove:true},function(response){

            $(".update-select__js").html($(response).find('.update-select__js').html());
            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());
            $(".text-left h2").html($(response).find('.text-left h2').html());
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
        $.post(ajax_path+'diagnostics',{select_devices_problems_form:true,device_problem_id:device_problem_id},function(response){

            $(".update-content__js").html($(response).find('.update-content__js').html());
            $(".result-content__js").html($(response).find('.result-content__js').html());

            loading('hide');
        });
    }else{
        loading('show');
        $.post(ajax_path+'diagnostics',{select_devices_problems_remove:true},function(response){

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

// Обработка форма аякс;
$(document).on('beforeSubmit','.js-form-ajax-1', function (event) {
    return false;
}).on('ajaxBeforeSend','.js-form-ajax', function (event, jqXHR, textStatus) {
    $('.loading.btn').button('loading');
}).on('ajaxComplete','.js-form-ajax', function (event, jqXHR, textStatus) {
    $('.loading.btn').button('reset');
    var response = jqXHR.responseJSON;
    console.log(response);
    if(response) {
        $('.alert__js').removeClass('hidden');
        $('.alert__js .name').text(response);
        $(this).hide();

        setTimeout(function() {
            window.location.reload();
        },2000);
        console.log('ASDF');
    }else{

    }
    return false;
});

// Отправить данные;
$(document).on('click','.js-send-call', function(){
    var $form = $(this),
        data = $form.parents('.js-form-ajax').serializeArray();

    $('.loading.btn').button('loading');

    // Оправка данные;
    $.ajax({
        url: ajax_path + 'call-center',
        type: 'POST',
        data: data,
        success: function(response){

            // Если не дубликать заполняем как обычно;
            if(isset(response.success) && response.success == 'ok') {
                $('.alert__js').removeClass('hidden');
                $('.alert__js .name').text(response.message);
                $form.parents('.js-form-ajax').hide();

                setTimeout(function() {
                    window.location.reload();
                },3000);
            }
            // Выводим ошибки;
            if(isset(response)) {
                $form.parents('.js-form-ajax').yiiActiveForm('updateMessages', response, true);
            }

            $('.loading.btn').button('reset');
        },
        error: function(){
            alert('Запрос не выполнен!');
            $('.loading.btn').button('reset');
        }
    });

    return false;
});

// Позвонить к нам;
$(document).on('click','.js-call', function(){
    return window_modal('repair/ajax/call','Позвонить к нам',{call:true,group_id:1001},'#window-modal',1);
});

// Вызвать курьера;
$(document).on('click','.js-call-courier', function(){
    return window_modal('repair/ajax/call','Вызвать курьера',{call:true,group_id:1002},'#window-modal',3);
});

// Вызвать мастера;
$(document).on('click','.js-call-master', function(){
    return window_modal('repair/ajax/call','Вызвать мастера',{call:true,group_id:1003},'#window-modal',3);
});

// Узнать стоимтость;
$(document).on('click','.js-call-buttons', function(){
    return window_modal('repair/ajax/call','Узнать стоимость ремонта',{call:true,group_id:1004},'#window-modal',3);
});

// Позвонить к нам;
$(document).on('click','.js-call-address', function(){
    return window_modal('repair/ajax/call','Позвонить нам',{call:true,group_id:1005},'#window-modal');
});

// У меня другая проблемы
$(document).on('click','.js-call-problems1', function(){
    return window_modal('repair/ajax/call','У меня другая проблемы',{call_problems:true,group_id:1006},'#window-modal',3);
});

// У меня несколько проблем
$(document).on('click','.js-call-problems2', function(){
    return window_modal('repair/ajax/call','У меня несколько проблем',{call_problems:true,group_id:1006},'#window-modal',3);
});

// Списко таблицы девайсов
$(document).on('click','.js-select-devices',function () {
   var id = $(this).data('id'),
       action = $(this).data('action');

    $('.js-select-devices').removeClass('active');
    $(this).addClass('active');
    if(action == 'price-list') {
        select_devices_price_list(id,false,false);
    }else{
        select_devices(id);
    }
   
    return false;
})
$(document).on('change','select.js-select-devices',function () {
    var id = parseInt($(this).val());
    $('.js-select-devices').removeClass('active');
    $(this).addClass('active');
    select_devices(id);
    return false;
});

// Выбор год и диоагналь;
$(document).on('click','.js-device-tags',function () {
    var device_year_id = $(this).data('device-year-id'),
        id = $(this).data('id'),
        index = $(this).data('index'),
        diagonal_id = $(this).data('diagonal-id');

    $('.js-device-tags.tags-' + index).removeClass('active');
    $(this).addClass('active');
    select_devices_price_list(id, device_year_id, diagonal_id);
    return false;
});

//
function select_devices (id) {
    if(!id) return false;
    loading('show');
    $.post(ajax_path + 'select-devices',{id:id},function(response){
        $('div.update_table_content').html($(response).find('div.update_table_content').html());
        loading('hide');
    });
}
//
function select_devices_price_list(id, device_year_id, diagonal_id) {
    if(!id) return false;
    loading('show');
    $.post(ajax_path + 'select-devices-price-list',{id:id, device_year_id:device_year_id, diagonal_id:diagonal_id},function(response){
        $('div.update_table_content').html($(response).find('div.update_table_content').html());
        loading('hide');
    });
}

// Ближайщие салоны;
$(document).on('change','.js-salon-form select',function () {
    var $post = $(this).parents('.js-salon-form').serializeArray();
         console.log($post);
        loading('show');
        $.post(ajax_path+'salon-list',$post,function(response){
         //   $('.update-salon').html(response.salonForm);
            $('.apple-service').html(response.appleServices);
            loading('hide');
        });
});

// Меню;
$(document).on('click','.js-footer-menu-toggle',function () {
    $(this).find('.i').toggle();
    $(this).toggleClass('active');
});


// Ленивая загрузка;
$(document).on('click','.js-limit-devices-problems',function () {
    var element  = $(this),
        device_id = element.data('device-id'),
        devices_problems_id = element.data('devices-problems-id'),
        counts = element.data('counts'),
        limit = parseInt(element.attr('data-limit'));
    console.log(counts);
    loading('show');
    $.post(ajax_path+'limit-device-problems',{'limit':counts,'device_id': device_id,'devices_problems_id': devices_problems_id},function(response){
        $('.update-devices-problems').append(response);
        $('.more').hide();
        loading('hide');
    });
    return false;
});

$(document).on('click','.js-limit-devices-problems-table',function () {
    var element  = $(this),
        device_id = element.data('device-id'),
        counts = element.data('counts');
    loading('show');
    $.post(ajax_path+'limit-device-problems-table-list',{'limit':counts,'id': device_id},function(response){
        if(response.length > 0) {
            $(response).find('div.update_table_content tbody tr.list').not('tr.header').each(function (index, item) {
                $('div.update_table_content tbody').append('<tr class="list">'+ $(item).html()+ '</tr>');
                console.log($(item).html());
            });
            $('.more').hide();
        }
        loading('hide');
    });
    return false;
});

console.log('Scripts Version 3.2.0 ');