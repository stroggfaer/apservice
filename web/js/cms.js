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

/*
$(document).on('mouseover','.js-mounts .dropdown-toggle',function () {
   console.log('Success');
   $(this).siblings('.dropdown-menu').show();
  // $(this)
}).on('mouseout',this,function () {
    $(this).siblings('.dropdown-menu').hide();
}); */



console.log('Users');