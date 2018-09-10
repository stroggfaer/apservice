// Модальная окно;
function window_modal(url,title,objPost,name,type) {
    var modalContainer = $(name);
    // Размер окно;
    modalContainer.modal('show');
    //console.log(title);
    if(title){
        modalContainer.find(".modal-header h4").text(title);
    }
    if(type == 1) {
        modalContainer.find('.modal-dialog').addClass('modal-sm').removeClass('modal-lg modal-xs');
    }else if(type == 2){
        modalContainer.find('.modal-dialog').addClass('modal-lg').removeClass('modal-sm modal-xs');
    }else if(type == 3){
        modalContainer.find('.modal-dialog').addClass('modal-xs').removeClass('modal-sm modal-lg');
    }else{
        modalContainer.find('.modal-dialog').removeClass('modal-lg modal-sm modal-xs');
    }
    //Если нет объекта по умол. пустой;
    if(!isset(objPost)) objPost = {};
    modalContainer.find('.modal-body').html('');
    $.ajax({
        url: '/' + url,
        type: "POST",
        data: objPost,
        async: false,
        success: function (data) {
            //console.log(data);
            modalContainer.find('.modal-body').html(data);
            modalContainer.modal('show');
        }
    }).done(function(data) {
        //
    });

    return false;
}
// Модальная окно отправка объекты данные;
function data_modal(name,objPost,title) {
    var modalContainer = $(name);
    // Размер окно;
    modalContainer.modal('show');
    if(title){
        modalContainer.find(".modal-header h4").text(title);
    }
    //Если нет объекта по умол. пустой;
    if(!isset(objPost)) objPost = {};
    modalContainer.data('json',objPost);
    return false;
}

// Прелоадер;
function loading(name) {

    if(name === 'show') {
        // $(".wrapper").css({'opacity':'0.7'});
        $(".spinner__mod").show();
        // if(size == 'md') $(".spinner__mod").addClass('md');
        // if(size == 'lg') $(".spinner__mod").addClass('lg');
    }else if(name === 'hide') {
        //$(".wrapper").css({'opacity':'100'});
        $(".spinner__mod").hide();
    }
}
function loading_modal(name) {
    if(name === 'show') {
        $(".loading__mod").show();
    }else if(name === 'hide') {
        $(".loading__mod").hide();
    }
}
function loadContent(name) {
    if(name === 'show') {
        $(".load__mod .load").show();
        $(".load__mod .items").addClass('hidden');
    }else if(name === 'hide') {
        $(".load__mod .load").hide();
        $(".load__mod .items").removeClass('hidden');
    }
}
// Число из строки;
function in_number(string) {
    var temp = string.replace(/\D/g,'');
    return parseInt(temp);
}

function isset(variable) {
    return (typeof(variable) != "undefined" && variable !== null);
}

function json_pay(data) {
    try {
        return $.parseJSON(data);
    } catch (e) {
        return false;
    }
}

// Уведомления:
function alert_messages (status,text,options) {
    var status_element,
        status_icon;
    switch (status) {
        case 1:
            status_element = 'alert-success';
            status_icon = 'glyphicon-ok-sign';
            break; // Успех;
        case 2:
            status_element = 'alert-danger';
            status_icon = 'glyphicon-remove-sign';
            break; // Ошибка:
        case 3:
            status_element = 'alert-warning';
            status_icon = 'glyphicon-warning-sign';
            break; // Внимание;
        default :
            status_element = 'alert-info'; // Инфо;
            status_icon = 'glyphicon-info-sign';
    }


    // Показываем увдемоления;
    $(".alert__fix").fadeIn(200).addClass(status_element);
    $(".alert__fix").find('.glyphicon').addClass(status_icon);
    $(".alert__fix .messages").html(text);
    if(options) return false;
    // Закрываем через 3 сек;
    setTimeout(function(){
        $(".alert__fix").fadeOut(600).removeClass(status_element);
        $(".alert__fix").find('.glyphicon').removeClass(status_icon);
        $(".alert__fix .messages").html('');
    },8000);

    return false;
}

// Уведомление алерт;
function modal_alert(text,type,options) {
    var element = $(".js-alert-messages"),
        status_element;
    // Удаляем;
    element.removeClass('alert-success alert-danger alert-warning alert-info');
    element.find('b').text('');

    switch (type) {
        case 1:
            status_element = 'alert-success';
            break; // Успех;
        case 2:
            status_element = 'alert-danger';
            break; // Ошибка:
        case 3:
            status_element = 'alert-warning';
            break; // Внимание;
        default :
            status_element = 'alert-info'; // Инфо;
    }
    //Добавляем статус класс;
    element.addClass(status_element).removeClass('hidden').show();
    element.find('b').text(text);
    if(options) return false;
    // Закрываем alert;
    console.log('modal_alert');
    setTimeout(function(){
        element.alert('close').addClass('hidden');
    },3000);
    return false;
}

console.log('Functions Version 2.1.1');