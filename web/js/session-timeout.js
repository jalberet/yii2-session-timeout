(function ($) {
    $.fn.sessionWarning = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist');
            return false;
        }
    };
    
    var defaultSettings = {
        loginUrl: null,
        alert: null,
        authTimeout: null,
        web: null
    };
    var settings = {};

    var methods = {
        init: function (options) {
            return this.each(function () {
                var $e = $(this);
                settings = $.extend({}, defaultSettings, $e.data(), options || {});
                settings.authTimeout = parseInt(settings.authTimeout);
                setInterval(function () {
                    methods._verifyLogout.apply($e);
                }, (settings.authTimeout + 2) * 1000);
            });
        },
        
        _watch: function () {
            if (settings.alert) {
                $('#session-warning-modal').modal('show');
                return;
            }else{
                window.location.reload();
            }
        },
        
        _verifyLogout: function ($e) {
            let obj = null;
            $.post(settings.web + "/site/check-login")
            .done(function( data ) {                
                obj = JSON.parse(data);
                if(obj.login){
                     methods._watch.apply($e);
                }
            });
        }        
    }
})(jQuery);