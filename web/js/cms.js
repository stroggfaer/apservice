$(document).ready(function(){

    // Меню;
    $('.js-mounts').hover(function () {
        clearTimeout($.data(this, 'timer'));
        $('.dropdown-menu', this).stop(true, true).show();
    }, function () {
        $.data(this, 'timer', setTimeout($.proxy(function () {
            $('.dropdown-menu', this).stop(true, true).hide();
        }, this), 100));
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
    var path = $(this).data('path');
    var element = $(this);
    if (!confirm("Удалить?")) return false;
    $.post('/repair/cms/ajax-backend/images-delete',{delete_image_file:true,'path':path},function(response){
        $(".form-content-images").html(response);
       // loading('hide');
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



console.log('Users');