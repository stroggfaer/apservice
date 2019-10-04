var ajax_path = '/ajax/';



$(document).ready(function(){

    //
    $(document).on('click','.js-city',function () {
        window_modal('ajax/city','Выбор города',{geo:true},'#window-modal');
        return false;
    });



    // Авто скролл;
    if($('#scroll-1001').length) {
        $('html,body').stop().animate({'scrollTop': $('#scroll-1001').offset().top}, 900, 'swing', function () {
        });
    }


    // Карусель для контента;
    if($(".js-slider").length) {
        //loadContent('show');
        try {
            // Карусель
            $(".js-slider .items").slick({
                dots: true,
                autoplay: false,
                autoplaySpeed: 6000,
                mobileFirst: true,
                speed: 1000,
                slidesToShow: 1,
                arrows: true,
                adaptiveHeight: true,
                slidesToScroll: 1,
                prevArrow: '<i class="fa icon-left-arrow" aria-hidden="true"></i>',
                nextArrow: '<i class="fa icon-right-arrow" aria-hidden="true"></i>',
            });
            //  loadContent('hide');
        }catch (err) {
              console.log('start');
                // обработка ошибки
         }
    }

    // ;
    if($(".address-carousel").length) {
        try {

            // Карусель
            var currentSlide =  $(".address-carousel .items").slick({
                autoplay: false,
                autoplaySpeed: 6000,
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 730,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 440,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });

           // loadContent('hide');
        } catch (err) {
            console.log('start');
            // обработка ошибки
        }
    }

    //
    $(document).on('click','.js-address-next', function(event){
        $(".address-carousel .items").slick('slickNext');
    });

    //
    $(document).on('click','.js-address-prev', function(event){
         $(".address-carousel .items").slick('slickPrev');
    });

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

    //
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
          var countsElements = $(".devices_carusel .items").data('counts'),
              counts = countsElements < 15 ?  countsElements : 8;
// Сплывающий подсказка;
        $(document).on('mouseover','.js-tooltip',function () {
            console.log('js-tooltip');
            $(this).tooltip('toggle');
        });
        try {
            // Карусель
            $(".devices_carusel .items").slick({
                dots: false,
                autoplay: false,
                autoplaySpeed: 6000,
                lazyLoad: 'progressive',
                // mobileFirst: true,
                // infinite: false,
                speed: 1000,
                arrows: true,
                slidesToShow: counts,
                slidesToScroll: counts,
                prevArrow: '<i class="fa fa fa-angle-left" aria-hidden="true"></i>',
                nextArrow: '<i class="fa fa fa-angle-right" aria-hidden="true"></i>',
                responsive: [
                    {
                        breakpoint: 830,
                        settings: {
                            slidesToShow: 8,
                            slidesToScroll: 8,
                        }
                    },
                ]
            });
        }catch (e) {

        }
    }

    // review-carousel
    if($(".review-carousel").length) {
        try {
            // Карусель
          $(".review-carousel .items").slick({
                autoplay: false,
                autoplaySpeed: 6000,
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 730,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ]
            });

            // loadContent('hide');
        } catch (err) {
            console.log('start');
            // обработка ошибки
        }
    }
    //
    $(document).on('click','.js-review-next', function(event){
        $(".review-carousel .items").slick('slickNext');
    });

    //
    $(document).on('click','.js-review-prev', function(event){
        $(".review-carousel .items").slick('slickPrev');
    });

    $('.navbar-toggle').click(function(){
        $(this).children('div').toggleClass('open');
    });
    // Меню;
    $(document).on('click','.js-toggle-menu',function () {
        $(this).toggleClass('active');
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
    $("#menu-mobile .menu-content").fadeToggle();
    $('.bg-show').toggle();
    return false;
});

$(document).on('click','.bg-show',function () {
    $(this).hide();
    $(".js-menu-mobile .slide_menu-btn").removeClass('open');
    $("#menu-mobile .menu-content").fadeOut();
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
    var device_problem_id = parseInt($(this).val()),
        device_id = $(this).parent().find('option:selected').data('device-id');

    console.log('device_id',device_id);

    if(device_problem_id) {
        loading('show');
        $.post(ajax_path+'diagnostics',{select_devices_problems_form:true,device_problem_id:device_problem_id,'device_id':device_id},function(response){

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

                try{
                    // Вызвать курьера (0)
                    if(response.group_id && response.group_id === 1001) {
                        yaCounter54017833.reachGoal(' ');
                    }
                    // Вызвать курьера (0)
                    if(response.group_id && response.group_id === 1002) {
                        yaCounter54017833.reachGoal('ya_send_1002');
                    }
                    // 	Вызвать мастера (0)
                    if(response.group_id && response.group_id === 1003) {
                        yaCounter54017833.reachGoal('ya_send_1003');
                    }
                    //	Узнать стоимость ремонта (0)
                    if(response.group_id && response.group_id === 1004) {
                        yaCounter54017833.reachGoal('ya_send_1004');
                    }
                    // Позвоните нам (0)
                    if(response.group_id && response.group_id === 1005) {
                        yaCounter54017833.reachGoal('ya_send_1005');
                    }
                    // 	Записаться на диагностику (0)
                    if(response.group_id && response.group_id === 1006) {
                        yaCounter54017833.reachGoal('ya_send_1006');
                    }


                }catch (e){
                    console.log('цель не работае');
                }

                setTimeout(function() {
                    window.location.reload();
                },3000);
                console.log('group_id', response.group_id);
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
// Записаться на диагностику
$(document).on('click','.js-sign-up', function(){
    return window_modal('ajax/call','Записаться на диагностику',{call:true,group_id:1006},'#window-modal',3);
});
// Позвонить к нам;
$(document).on('click','.js-call', function(){
    return window_modal('ajax/call','Позвонить к нам',{call:true,group_id:1001},'#window-modal',1);
});

// Вызвать курьера;
$(document).on('click','.js-call-courier', function(){
    return window_modal('ajax/call','Вызвать курьера',{call:true,group_id:1002},'#window-modal',3);
});

// Вызвать мастера;
$(document).on('click','.js-call-master', function(){
    return window_modal('ajax/call','Вызвать мастера',{call_problems:true,group_id:1003},'#window-modal',2);
});

// Узнать стоимтость;
$(document).on('click','.js-call-buttons', function(){
    return window_modal('ajax/call','Узнать стоимость ремонта',{call:true,group_id:1004},'#window-modal',3);
});

// Позвонить к нам;
$(document).on('click','.js-call-address', function(){
    try{
        yaCounter54017833.reachGoal('ya_call');
    }catch (e){
        console.log('цель не работае');
    }

    return window_modal('ajax/call','Позвонить нам',{call:true,group_id:1005},'#window-modal');
});

// У меня другая проблемы
$(document).on('click','.js-call-problems1', function(){
    return window_modal('ajax/call','У меня другая проблемы',{call_problems:true,group_id:1006},'#window-modal',3);
});

// У меня несколько проблем
$(document).on('click','.js-call-problems2', function(){
    return window_modal('ajax/call','У меня несколько проблем',{call_problems:true,group_id:1006},'#window-modal',3);
});

// Списко таблицы девайсов
$(document).on('click','.js-select-devices',function () {
   var id = $(this).data('id'),
       action = $(this).data('action');
     console.log(action);
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
            $(response).find('div.update_table_content .list-items .list').each(function (index, item) {
                $('div.update_table_content .list-items').append('<div class="list">'+ $(item).html()+ '</div>');
                console.log($(item).html());
            });
            // $(response).find('div.update_table_content tbody tr.list').not('tr.header').each(function (index, item) {
            //     $('div.update_table_content tbody').append('<tr class="list">'+ $(item).html()+ '</tr>');
            //     console.log($(item).html());
            // });
            $('.more').hide();
        }
        loading('hide');
    });
    return false;
});

/*----МОДАЛКА----*/
// Выбор устройства;
$(document).on('change','.js-call-select-form-repair',function () {
    var element  = $(this),
        repair_id = parseInt($(this).val());
    loading('show');
    $.post('/ajax/call',{
        call_problems: true,
        group_id:1003,
        repair_id: repair_id,
    },function(response){
        $('.call-form .content_update').html($(response).find('.content_update').html());
        $('.js-send-call').prop('disabled',false);
        loading('hide');
    });
    return false;
});
$(document).ajaxError(function() {
    loading('hide');
    alert('Ошибка сервер');
});
// Выбор модели;
$(document).on('change','.js-call-select-form-devices',function () {
    var element  = $(this),
        repair_id =  $(this).data('repair-id'),
        device_id = parseInt($(this).val());

    $('.js-call-select-form-problems-list').attr('data-device-id',device_id).attr('data-device-id',repair_id);

    loading('show');
      console.log(repair_id + ' ' + device_id);
     $.post('/ajax/call',{
        call_problems: true,
        group_id:1003,
        repair_id: repair_id,
        device_id: device_id,
    },function(response){
        $('.call-form .content_update').html($(response).find('.content_update').html());
        loading('hide');
    });
    return false;
});

// Выбор проблемы;
$(document).on('change','.js-call-select-form-problems-list',function () {
    var element  = $(this),
        problem_id = parseInt($(this).val());
    loading('show');
    $.post('/ajax/call-problems-result',{
        call_problems_result: true,
        problem_id: problem_id,
    },function(response){
        $('.call-form .content_result').html(response);
        loading('hide');
    });
    return false;
});


/*-----Новости-----*/
$(document).on('click','.js-type-news .item',function () {
    var element  = $(this),
        type = parseInt($(this).data('type'));
    loading('show');
     $('.js-type-news .item').removeClass('active');
     $(this).addClass('active');
    //
    $.post('/ajax/news-list',{
        typeNews: true,
        type: type,
    },function(response){
        $('.news__com .upadate').html(response);
        loading('hide');
    });
    return false;
});



console.log('Scripts Version 3.2.0 ');