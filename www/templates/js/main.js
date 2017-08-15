$(document).ready(function () {

    //подключение fancybox
    $(".fancybox").fancybox();


    //Проверка какая валюта выбрана
    var sumFlag = false;
    $('input:radio[name=Currency]').change(function () {
        if (this.value == 'RUB') {
            updateSalary(sumFlag);
        }
        else if (this.value == 'USD') {
            updateSalary(sumFlag);
        }
        sumFlag === false ? sumFlag = true : sumFlag = false
    });

    //Получение типа валюты и замена значений. Курс берется из Cookie
    function updateSalary(sumFlag) {
        var sum;
        var curs = getCookie('rbc');
        $(".month").each(function (i) {
            if (!sumFlag) {
                sum = ($(this).text() / curs).toFixed(2);
            } else {
                sum = ($(this).text() * curs).toFixed(0);
            }
            $('.month')[i].innerText = sum;
        });
    }

    //Загрузка изображений и информации на сайт
    $("form#uploadimage").submit(function () {
        var formData = new FormData(this);
        $.ajax({
            url: '/method/addworker/',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
            },
            cache: false,
            contentType: false,
            processData: false,
            success: function (datas) {
                alert('Работник добавлен')
            }
        });
        return false;
    });

    /**
     * Функция для установки премии.
     * @var bonusType - получает текущее значение select.(проценты или сума)
     * @var amount - получает число премиию. Приводится к числу для рассчетов.
     * @var data - формируется асс.массив для передачи на сервер и обработки.
     * @var month - получение текущего месяца. Не нашел способ получить из datapicker "
     *
     * В массиве прогоняются все зарплаты рабочих за месяц. В зависимости от тип или увеличиются "на"
     * или умножаются на процент. Для процентов сделан десятичный вывод. Сделано, чтобы не получать
     * ответ от сервера, а во время запроса обновить значения. TODO
     */
    $("form#bonus").submit(function () {
        var bonusType = $('#chooseBonusType').val();
        var amount = parseInt(($('#bonusNumber').val()));
        var data = {type: bonusType, amount: amount, table: 'payment'};
        var url = '/method/setbonus/';
        var month = parseInt($('.ui-datepicker-month').change().val()) + 1;
        var getInfo = getJsonInfo(url, data, month).responseJSON;
        var sum;

        $(".month").each(function (i) {
            if (bonusType == 'percent') {
                var value = parseInt(($(this).text()));
                var coefficient = value / 100;
                var percent = coefficient * amount;
                sum = (percent + value).toFixed(2);
            } else {
                var value = parseInt(($(this).text()));
                sum = (value + amount).toFixed(0);
            }
            $('.month')[i].innerText = sum;
        });
    });

    /**
     *
     * @param url - куда надо делать запрос
     * @param data - json массив, который потом объединяется с @var info
     * @param month - месяц где надо обновлять инфу
     * @returns {*|{settings}} возвращается объект ajax Для дальнейшей обработки.
     */
    function getJsonInfo(url, data, month) {
        var idx = $.map($('.month'), function (o) {
            return $(o).attr('worker')
        });
        var info = {id: idx, month: month};
        var infoObject = $.extend(info, data);
        return $.ajax({
            type: 'POST',
            url: url,
            async: false,
            data: infoObject,
            dataType: "json"
        });
    }

    /**
     * Включение календаря. Если изменили месяц, то выполянется функция на получение значений. TODO
     */
    $('#calendar').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm',
        inline: true,
        onChangeMonthYear: function (year, month) {
            getIdWorkers(month);
        }
    });

    /**
     * @var получает все id рабочих со страницы.
     * @param month - цифровое знасчение месяца.
     * Если success, то на странице заменяются все зарплаты. Поиск просходит по ID рабочих
     */
    function getIdWorkers(month) {
        var idx = $.map($('.month'), function (o) {
            return $(o).attr('worker')
        });
        $.ajax({
            type: 'POST',
            url: "/method/getpayment/",
            async: false,
            data: {id: idx, month: month},
            dataType: "json",
            success: function (data) {
                for (var i in data) {
                    var salary = data[i]['salary'];
                    var worker_id = data[i]['workers_id'];
                    $('.month[worker=' + worker_id + ']').html(salary)
                }
            }
        });
    }
});

//Получение куки. Взято с learn.javascript.ru
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
