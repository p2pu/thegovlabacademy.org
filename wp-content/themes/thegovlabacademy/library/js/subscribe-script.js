/*global jQuery, window, document, console, parsley */

var Subscribe = window.Subscribe || {};

(function ($, Subscribe) {

    'use strict';

    var init = function () {
        $(function () {
            var survey = $('#modal-subscribe-successful');
            $('.subscribe-button').click(function () {
                $('#subscribe, .subscribe-email').toggleClass('active');
                if (survey.hasClass('active')) {
                    survey.removeClass('active');
                }
                $('#subscribe').css('position', 'relative');


            });

            $('.subscribe-email-action').click(function () {
                if ($('#entry_1925900036').parsley('isValid')) {
                    $('#subscribe, .subscribe-email').removeClass('active');
                    survey.addClass('active');
                    $('#subscribe').css('position', 'initial');
                }
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