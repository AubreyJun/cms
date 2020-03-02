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
    doConfirm = function (message,doAction) {
        swal({
            title: '提示',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
                cancel: {
                    text: "取消",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "确定",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true,
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                doAction();
            }
        });
    };
})(jQuery);
