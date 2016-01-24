(function ($) { //an IIFE so safely alias jQuery to $
    $.App = function (lang) {
        this.lang = lang;
    };

    $.App.prototype = {

        basic_function: function (element) {
            $("#" + element).doSomething();
        },

        dual_list: function(element) {
            console.log("pop");
            console.log(element);
            $("#" + element).bootstrapDualListbox(); // j'ai tout revert et laissé quelque chose de SIMPLE.

            $("#" + element).change(function () {

            });

        }

    };
    return $.App;
}(jQuery));