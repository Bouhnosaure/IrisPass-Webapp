(function ($) { //an IIFE so safely alias jQuery to $
    $.App = function (lang) {
        this.lang = lang;
    };

    $.App.prototype = {

        basic_function: function (element) {
            $("#" + element).doSomething();
        },
        mutliselect: function (element) {
            $("#" + element).multiSelect();
        },
        track_and_submit: function (form, element) {
            var form = $("#" + form);

            $("#" + element).change(function (e) {
                form.submit();
                e.preventDefault();
            });
        },
        ajax_on_submit: function (form) {
            var form = $("#" + form);
            jQuery.ajax({
                url: form.action,
                method: form.method,
                data: form.serialize()
            }).done(function (response) {
                // Do something with the response
            }).fail(function () {
                // Whoops; show an error.
            });

        }

    };
    return $.App;
}(jQuery));