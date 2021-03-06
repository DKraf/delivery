"use strict"
$('#user_start_testing').fadeOut();

$(document).ready(function () {
    /**
     * Таймер
     */
    $('#button_test_starting').on( "click",function () {
        console.log($('#time_for_testing_view').text())

        $('#test_start_button_div').fadeOut()
        $('#user_start_testing').fadeIn()
        var min = $('#time_for_testing').val(),
            min_end = min,
            _Seconds = min * 60,
            int,
            sec = 60;
        min--
        int = setInterval(function () { // запускаем интервал
            if (_Seconds > 0) {
                if (sec == 0) {
                    sec = 60;
                    min--
                }
                sec--
                _Seconds--;
                $('.seconds').text(_Seconds);
                $('#time_for_testing_view').text('До окончания теста осталось: ' + min + 'мин ' + sec + 'сек')
                $('#time_for_testing').val(min_end - min)
                console.log(sec)

            } else {
                $("#end_test_for_end_time" ).submit();
            }
        }, 1000);
    });


    /**
     * сайтбар
     * @type {Element}
     */
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    /**
     * скрываем notification если активен
     */
    if ($('.alert').css('display', 'flex')) {
        setTimeout(function (){
            $('.alert').fadeOut(300);
        },4000)
    }

    /**
     * toasts notification
     * @param message
     * @returns {string}
     */
    function toasts(message, color) {
        return (
            `<div class="toast toast-notification-top align-items-center text-white bg-${color} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body text-center">
                  ${message}
                </div>
            </div>`
        )
    }

    /**
     * таймер закрытия блока toasts
     * @param block
     * @param time
     */
    function timeClose(block, time) {
        setTimeout(()=> {
            $(block).fadeOut("slow", function () {
                $(this).remove();
            })
        }, time)
    }

    /**
     * validation step edit
     * @param step
     * @returns {boolean}
     */
    function validationEditStep(step) {
        let message;
        let isValid = true;
        let checkboxes;
        if (step == '3') {
            checkboxes = $('.material:checkbox:checked')
            if (!checkboxes.length) {
                message = 'Не установлен чекбокс';
                if ($('.toast-notification-top').length) {
                    $('.toast-notification-top').remove()
                    $('body').append(toasts(message, 'danger'));
                } else {
                    $('body').append(toasts(message, 'danger'));
                }
                timeClose($('.toast-notification-top'),4000)
                isValid = false
            }
        }
        $(`.edit-step-${step}`).find(`[data-valid='true']`).each(function (i, item) {
            if (item.value === '') {
                message = 'Поля отмеченные (*) обязательны';
                if ($('.toast-notification-top').length) {
                    $('.toast-notification-top').remove()
                    $('body').append(toasts(message, 'danger'));
                } else {
                    $('body').append(toasts(message, 'danger'));
                }
                timeClose($('.toast-notification-top'),4000)
                isValid = false
            }
        })
        return isValid;
    }

    $('#login_input').focusin(function() {
        let first = $('#firstname_input').val()
        let last = $('#lastname_input').val()
        let rand = (Math.floor(Math.random() * 100) + 1) + (Math.floor(Math.random() * 100) + 1);
        let login = transliterate(first) + '.' + transliterate(last) + rand
        $('#login_input').val(login)
    })

    function transliterate(word) {
        var answer = ""
            , a = {};

        a["Ё"] = "YO";
        a["Й"] = "I";
        a["Ц"] = "TS";
        a["У"] = "U";
        a["К"] = "K";
        a["Е"] = "E";
        a["Н"] = "N";
        a["Г"] = "G";
        a["Ш"] = "SH";
        a["Щ"] = "SCH";
        a["З"] = "Z";
        a["Х"] = "H";
        a["Ъ"] = "'";
        a["ё"] = "yo";
        a["й"] = "i";
        a["ц"] = "ts";
        a["у"] = "u";
        a["к"] = "k";
        a["е"] = "e";
        a["н"] = "n";
        a["г"] = "g";
        a["ш"] = "sh";
        a["щ"] = "sch";
        a["з"] = "z";
        a["х"] = "h";
        a["ъ"] = "'";
        a["Ф"] = "F";
        a["Ы"] = "I";
        a["В"] = "V";
        a["А"] = "a";
        a["П"] = "P";
        a["Р"] = "R";
        a["О"] = "O";
        a["Л"] = "L";
        a["Д"] = "D";
        a["Ж"] = "ZH";
        a["Э"] = "E";
        a["ф"] = "f";
        a["ы"] = "i";
        a["в"] = "v";
        a["а"] = "a";
        a["п"] = "p";
        a["р"] = "r";
        a["о"] = "o";
        a["л"] = "l";
        a["д"] = "d";
        a["ж"] = "zh";
        a["э"] = "e";
        a["Я"] = "Ya";
        a["Ч"] = "CH";
        a["С"] = "S";
        a["М"] = "M";
        a["И"] = "I";
        a["Т"] = "T";
        a["Ь"] = "'";
        a["Б"] = "B";
        a["Ю"] = "YU";
        a["я"] = "ya";
        a["ч"] = "ch";
        a["с"] = "s";
        a["м"] = "m";
        a["и"] = "i";
        a["т"] = "t";
        a["ь"] = "'";
        a["б"] = "b";
        a["ю"] = "yu";

        for (let i in word) {
            if (word.hasOwnProperty(i)) {
                if (a[word[i]] === undefined) {
                    answer += word[i];
                } else {
                    answer += a[word[i]];
                }
            }
        }
        return answer;
    }

    $('select[name="country_id_from"]').on('change', function () {
        $("#hiden-select-city-from").removeAttr('hidden');
        let id = $('select[name="country_id_from"]').val();
        $.ajax({
            url: "/get-cities-by-country/" + id,
            type: "GET",
            dataType: "json",
            success: function(msg){
                $("#city_id_from").find('option').remove();
                $("#city_id_from").append(`<option selected>Укажите город отправки</option>`);
                $.each(msg, function(key, value) {
                    $("#city_id_from").append(`<option value="${value.id}">${value.name}</option>`);
                });
            }
        });
    })

        $('select[name="country_id_to"]').on('change', function () {
            $("#hiden-select-city-to").removeAttr('hidden');
            let id = $('select[name="country_id_to"]').val();
            $.ajax({
                url: "/get-cities-by-country/" + id,
                type: "GET",
                dataType: "json",
                success: function(msg){
                    $("#city_id_to").find('option').remove();
                    $("#city_id_to").append(`<option selected>Укажите город отправки</option>`);
                    $.each(msg, function(key, value) {
                        $("#city_id_to").append(`<option value="${value.id}">${value.name}</option>`);
                    });
                }
            });
        })

    $("#city_id_to").on('change', function () {

        let city_id = $("#city_id_to").val()
console.log(city_id)
        if ($.isNumeric(city_id)) {
            if (city_id == 1) {

                $("#hiden-select-address-to").removeAttr('hidden');
                $("#hiden-input-address-to").attr('hidden', true);

                $.ajax({
                    url: "/get-all-addresses/" + city_id,
                    type: "GET",
                    dataType: "json",
                    success: function(msg){
                        $("#select-address-to").find('option').remove();
                        $("#select-address-to").append(`<option selected>Выберите из списка удобный для вас пункт</option>`);
                        $.each(msg, function(key, value) {
                            $("#select-address-to").append(`<option value="${value.id}">${value.address}, ${value.type}:"${value.name}"</option>`);
                        });
                    }
                });
            } else {
                $("#hiden-input-address-to").removeAttr('hidden');
                $("#hiden-select-address-to").attr('hidden', true);
            }
        }
    })

    $("#city_id_from").on('change', function () {
        let city_id = $("#city_id_from").val();
        if ($.isNumeric(city_id)) {
            if (city_id == 1) {
                $("#hiden-input-address-from").attr('hidden', 'true');
                $("#hiden-select-address-from").removeAttr('hidden');
                $.ajax({
                    url: "/get-all-addresses/" + city_id,
                    type: "GET",
                    dataType: "json",
                    success: function(msg){
                        $("#select-address-from").find('option').remove();
                        $("#select-address-from").append(`<option selected>Выберите адрес</option>`);
                        $.each(msg, function(key, value) {
                            $("#select-address-from").append(`<option value="${value.id}">${value.address}, ${value.type}:"${value.name}"</option>`);
                        });
                    }
                });
            } else {
                $("#hiden-input-address-from").removeAttr('hidden');
                $("#hiden-select-address-from").attr('hidden', 'true');
            }
        }
    })

    $('input[name="S"]').blur(function(){getValue()})
    $('input[name="H"]').blur(function(){getValue()})
    $('input[name="L"]').blur(function(){getValue()})

    function getValue()
    {
        let S =  $('input[name="S"]').val()
        let H =  $('input[name="H"]').val()
        let L =  $('input[name="L"]').val()
console.log(S)
        if ( S != '' && L != '' && H != ''){
            $('input[name="V"]').val(S * H * L)
        }
    }
})


