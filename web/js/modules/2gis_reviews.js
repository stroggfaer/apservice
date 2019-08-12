//
$(document).on('beforeSubmit','#parser-form-2gis', function (event) {
    return false;
});

// Запуска импорт;
$(document).on('click','.js-2gis-run',function () {
    var $form = $(this).parents('#parser-form-2gis'),
        $this = $(this);
        $this.prop("disabled", true);
        $('.js-progress-bar-content').find('.alert.alert-success').hide();
        //
        $.ajax({
            url: '/cms/modules/parser-reviews-2gis',
            type: 'POST',
            data: $form.serializeArray(),
            success: function(response){
                if(response && response.form) {
                    //console.log('response.params',response.form);
                    loadTimeOut(response.form);
                }
                // Выводим ошибки;
                try {
                    $form.yiiActiveForm('updateMessages', response, true);
                }catch (e) {
                    console.log('Error yiiActiveForm');
                }
            },
            error: function(){
                alert('Запрос не выполнен!');
                $this.prop("disabled", false);
            }
        });
    return false;

});

/*----Пакетная загрузка-----*/

var  dataObjPost,
     int = 0,
     dataObj= {};

function loadTimeOut(post) {
    setTimeout( function(){
        ++int;
        dataObjPost = $.ajax({
            type: 'POST',
            url: "/cms/modules/parser-reviews-2gis",
            data: post || {},
            dataType: 'json',
            async:false,
            success: function(data) {
                var elements = $('.js-progress-bar-content');
                var result  =  Math.floor(100 / parseInt(data.params.counts)  * (parseInt(data.params.counts) - parseInt(data.params.counter)));
                var resultEl =  ((parseInt(data.params.counts) - data.params.counter));
                elements.find('#counters').text(Math.floor(resultEl));
                elements.find('.progress-bar').attr('aria-valuenow',result);
                elements.find('.progress-bar').css('width',result + '%');
                elements.find('#counts_result').text(data.params.counts_result);
                return data;
            },
            error: function (error) {

            }
        }).responseText;

        dataObj = dataObjPost  ? JSON.parse(dataObjPost) : {};
        console.log('dataObj',dataObj);
        if(dataObj && !dataObj.exit && dataObj.params.counter > 0 && dataObj.params.next_link) {
            console.log('int',int);
            dataObj = Object.assign(dataObj.form,dataObj.params);

            loadTimeOut(dataObj);
        }else{
            int = 0;
            $('.js-2gis-run').prop("disabled", false);
            $('.js-progress-bar-content').find('.alert.alert-success').removeClass('hidden').show();

            return false;
        }
    },2000);
}


console.log('модуль 2gis_reviews 2.0');