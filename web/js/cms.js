$(document).ready(function(){

    // Меню;
    $('.js-mounts').hover(function () {
        clearTimeout($.data(this, 'timer'));
        $('.dropdown-menu', this).stop(true, true).show();
        return false;
    }, function () {
        $.data(this, 'timer', setTimeout($.proxy(function () {
            $('.dropdown-menu', this).stop(true, true).hide();
        }, this), 100));
        return false;
    });
});

// Чекбокс пометить;
$(document).on('click','.js-checkbox-column',function(){
    loading('show');
    $.post(window.location.href,{checkboxColumn:true,id:$(this).val(),status: $(this).filter(':checked').length},function(html){
        $('.checkbox-column').html($(html).find('.checkbox-column').html());
        loading('hide');
    });
    return false;
});
$(document).on('click','.js-call-delete',function(){
    loading('show');
    $.post(window.location.href,{delete:true, id:$(this).data('id')},function(html){
        $('.checkbox-column').html($(html).find('.checkbox-column').html());
        loading('hide');
    });
    return false;
});
// Удалить избражения;
$(document).on('click','.js-delete-image-file',function () {
    var file_name = $(this).data('file-name');
    var file_min = $(this).data('file-min') ? $(this).data('file-min') : null;
    var element = $(this);
    if (!confirm("Удалить?")) return false;
    $.post('/cms/ajax-backend/images-delete',{delete_image_file:true,'file_name':file_name,'file_min':file_min},function(response){
        $(".form-content-images").html(response);
       // loading('hide');
    });
});

// Удалить проблема;
$(document).on('click','.js-device-problems-delete',function(){
    var id = $(this).data('id');
    var element = $(this);
    loading('show');
    $.post(window.location.href,{delete:true, id:id},function(html){
        window.location.reload();
        element.parents('.item').remove();
        //$('.table__com').html($(html).find('.table__com').html());
        loading('hide');
    });
    return false;
});

// Отправка данные;
$(document).on('click','.js-run-email-parser',function () {
    loading('show');
    var max_counts = $("#maxCounts").val();
    if(max_counts > 0) {

        $.ajax({
            url: '/cms/ajax-backend/run-export-email',
            type: 'POST',
            data: {runExportEmail: true,  max_counts: max_counts},
            success: function(response){

                if(isset(response) && response.status == 'ok') {
                    console.log(response);
                    console.log(response.data);
                    alert('Успешно импортирован (' + response.counts + ')');
                    window.location.reload();
                }
                loading('hide');
            },
            error: function(){
                alert('Запрос не выполнен!');
                loading('hide');
            }
        });

    }else{
        alert('Не может больше 0');
        loading('hide');
        return false;
    }
    return false;
});

var $modal = $('#window-modal-add-diagonal');
$modal.on('show.bs.modal', function(e) {
    var device_year_id = $(e.relatedTarget).data('device-year-id'),
        device_id = $(e.relatedTarget).data('device-id');
    $(this).find('.modal-body')
        .html('Загрузка...')
        .load('/cms/devices/add-device-diagonal?id=' + device_year_id,{add_diagonal:true,device_id:device_id},function() {
            $modal.modal('handleUpdate');
        });
});


/*
$(document).on('mouseover','.js-mounts .dropdown-toggle',function () {
   console.log('Success');
   $(this).siblings('.dropdown-menu').show();
  // $(this)
}).on('mouseout',this,function () {
    $(this).siblings('.dropdown-menu').hide();
}); */
function table_all() {
    $('.table__com .content').css({'height':'100%'});
    $('.table__com .more').hide();
    return false;
}


console.log('Users');