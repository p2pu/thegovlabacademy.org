/*global jQuery, window, document, console, parsley */

var Subscribe = window.Subscribe || {};

(function ($, Subscribe) {

    'use strict';

    var init = function () {
        $(function () {
            var form = $('#ss-form'),
                survey = $('#modal-subscribe-successful');

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

            $('.subscribe-submit').click(function () {
                if (form.parsley('isValid')) {
                    form.submit();
                    $('.modal').removeClass('active');
                }
                $('#overlay').hide();
            });

            $('.subscribe-cancel').click(function () {
                form.parsley('destroy').submit();
                $('.modal').removeClass('active');
            });

            $('.other-toggle').click(function (e) {
                var $this = $(this);
                if ($this.is(':checked')) {
                    $this.siblings('.q-other').removeAttr('disabled');
                } else {
                    $this.siblings('.q-other').attr('disabled', 'true');
                }
            });

            survey.blur(function () {
                console.log('clicked away, you cheeky bastart you');
            });

            form.parsley({
                errors: {
                    container: function (element, isRadioOrCheckbox) {
                        var $container = element.closest(".parsley-container");
                        if ($container.length === 0) {
                            $container = $("<div class='parsley-container'></div>").insertBefore(element);
                        }
                        return $container;
                    },
                    errorsWrapper: '<div></div>',
                    errorElem: '<span></span>'
                }
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