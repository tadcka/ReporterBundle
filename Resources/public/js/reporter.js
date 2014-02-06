/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$(document).ready(function () {
    var tadckaReporterLink = {

        speed: 300,
        containerWidth: $('div.tadcka-reporter-panel').outerWidth(),
        containerHeight: $('div.tadcka-reporter-panel').outerHeight(),
        tabWidth: $('.tadcka-reporter-link').outerWidth(),

        init: function () {
            $('div.tadcka-reporter-panel').css('height', tadckaReporterLink.containerHeight + 'px');
            var $container = $('div.tadcka-reporter-form');
            $('a.tadcka-reporter-link').click(function (event) {
                if ($('.tadcka-reporter-panel').hasClass('open')) {
                    $container.html('');
                    $('.tadcka-reporter-panel')
                        .animate({left: '-' + tadckaReporterLink.containerWidth}, tadckaReporterLink.speed)
                        .removeClass('open');
                } else {
                    $container.fadeTo(300, 0.4);
                    var $url = $(this).attr('href');
                    $.ajax({
                        type: 'GET',
                        url: $url,
                        success: function (response) {
                            $container.html(response);
                            $container.fadeTo(0, 1);
                            tadcka_reporter_form();
                        },
                        error: function (request, status, error) {
                            $container.html(request.responseText);
                            $container.fadeTo(0, 1);
                        }
                    });

                    $('div.tadcka-reporter-panel').animate({left: '0'}, tadckaReporterLink.speed)
                        .addClass('open');
                }
                event.preventDefault();
            });
        }
    };

    tadckaReporterLink.init();

    function tadcka_reporter_form() {
        $('.tadcka-reporter-button').click(function (e) {
            e.preventDefault();
            var $container = $('div.tadcka-reporter-form');
            $container.fadeTo(300, 0.4);
            var $form = $(this).closest('form');
            var $url = $form.attr('action');
            $.ajax({
                type: 'POST',
                url: $url,
                data: $form.serialize(),
                success: function (response) {
                    $container.html(response);
                    $container.fadeTo(0, 1);
                    tadcka_reporter_form();
                },
                error: function (request, status, error) {
                    $container.html(request.responseText);
                    $container.fadeTo(0, 1);
                }
            });

        });
    }
});