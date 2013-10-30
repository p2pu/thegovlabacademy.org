/*global jQuery, window, document, console, parsley */

var Subscribe = window.Subscribe || {};

(function ($, Subscribe) {

    'use strict';

    var init = function () {
        $(function () {
            $('.subscribe-button').click(function () {
                $('#subscribe').toggleClass('active');
                $('#overlay').show();
            });

            $('#subscribe-submit').click(function () {
                $('#subscribe').removeClass('active');
                $('#modal-subscribe-successful').addClass('active');
            });

            $('.modal .button').click(function () {
                $('.modal').removeClass('active');
                $('#overlay').hide();
            });

            $('.expert-img').click(function (e) {
                e.preventDefault();
                var $this = this;
                $('.expert-img').each(function () {
                    var $that = this;
                    if ($that !== $this) {
                        $($that).siblings('.expert-list-bio').removeClass('active');
                    }
                });
                $($this).siblings('.expert-list-bio').toggleClass('active');
            });
            $('.close').click(function (e) {
                e.preventDefault();
                var $this = $(this);
                $this.parents('.modal').removeClass('active');
            });
            //  Function for the Overlay functionalities
            $('#overlay').click(function () {
                $('#subscribe').removeClass('active');
                $('.modal').removeClass('active');
                $('#overlay').hide();
            });


            // Function for interface color changing
            $('.theme-menu a').click(function () {
                var theme = $(this).attr('class');
                $('body.theme-page').removeClass('data crowd behave history');
                $('body.theme-page').addClass(theme);
            });

            $('.theme-menu a').click(function () {
                var theme = $(this).attr('class');
                $('body.topic-page').removeClass('data crowd behave history');
                $('body.topic-page').addClass(theme);
            });
        });
    };

    Subscribe.Form = {};
    Subscribe.Form.init = init;

}(jQuery, Subscribe));