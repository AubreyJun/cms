(function ($) {
    toastError = function(text){
        'use strict';
        $.toast({
            heading: '错误信息',
            text: text,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f2a654',
            position: 'top-center'
        })
    };
    toastSuccess = function(text){
        'use strict';
        $.toast({
            heading: '成功信息',
            text: text,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-center'
        })
    };
})(jQuery);