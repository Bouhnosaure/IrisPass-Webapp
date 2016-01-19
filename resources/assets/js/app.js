(function ($) { //an IIFE so safely alias jQuery to $
    $.App = function (lang) {
        this.lang = lang;
    };

    $.App.prototype = {
        basic_function: function (element) {
            $("#" + element).doSomething();
        }
    };

    return $.App;
}(jQuery));