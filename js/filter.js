$(document).ready(function() {

    $('.gender-button').click(function() {
        var $this =  $(this);
        $('.gender-button').removeClass('active');
        $this.addClass('active');
        var expr = new RegExp('gender\\[(.*)\\]');
        var value = $this.attr('name').replace(expr, '$1');
        $('#gender').val(value);
    });

    $('#filters input[type=range]').each(function(i, el) {
        $(el).ionRangeSlider({
            min: 0,                        // минимальное значение
            max: 20000,                       // максимальное значение
            from: 0,                       // предустановленное значение ОТ
            to: 20000,                         // предустановленное значение ДО
            type: "double",                 // тип слайдера
            step: 1000,                       // шаг слайдера
//            prefix: "$",                    // префикс значение
//            postfix: " руб.",                  // постфикс значение
//            maxPostfix: "+",                // постфикс для максимального значения
            hasGrid: true,                  // показать сетку
            gridMargin: 5,                  // отсуп от края сетки до края слайдера
            hideMinMax: true,               // спрятать поля Min и Max
            hideFromTo: true,               // спрятать поля From и To
            prettify: true,                 // разделять цифры пробелами 10 000
            disable: false,                 // заблокировать слайдер
//            values: ["a", "b", "c"],        // массив предустановленных значений
            onLoad: function (obj) {        // callback, вызывается при запуске и обновлении
                $('.irs', obj.slider).append('<span class="prepoint">&nbsp;</span>');
                var curfrom = $('input[name=PriceMin]').val();
                var curto = $('input[name=PriceMax]').val();
                if((curfrom && obj.fromNumber != curfrom) && (curto && obj.toNumber != curto)) {
                    $(el).ionRangeSlider('update', {
                        'from' : curfrom,
                        'to' : curto
                    });
                } else if((curfrom && obj.fromNumber != curfrom)) {
                    $(el).ionRangeSlider('update', {
                        'from' : curfrom
                    });
                } else if((curto && obj.toNumber != curto)) {
                    $(el).ionRangeSlider('update', {
                        'to' : curto
                    });
                }
//                obj.fromNumber = $('input[name=PriceMin]').val();
//                obj.toNumber = $('input[name=PriceMax]').val();
            },
            onChange: function (obj) {      // callback, вызывается при каждом изменении состояния
                var $point = $('.irs-slider.single', obj.slider);
                $('input[name=PriceMin]').val(obj.fromNumber);
                $('input[name=PriceMax]').val(obj.toNumber);
            },
            onFinish: function (obj) {      // callback, вызывается один раз в конце использования
                var $point = $('.irs-slider.single', obj.slider);
                $('input[name=PriceMin]').val(obj.fromNumber);
                $('input[name=PriceMax]').val(obj.toNumber);

            }
        });
    });
    $('#filters input[type=number]').each(function(i, el) {
        $(el).ionRangeSlider({
            min: 1,                        // минимальное значение
            max: 9,                       // максимальное значение
            from: 1,                       // предустановленное значение ОТ
            to: 1,                         // предустановленное значение ДО
            type: "single",                 // тип слайдера
            step: 1,                       // шаг слайдера
//            prefix: "$",                    // префикс значение
//            postfix: " руб.",                  // постфикс значение
//            maxPostfix: "+",                // постфикс для максимального значения
            hasGrid: false,                  // показать сетку
            gridMargin: 5,                  // отсуп от края сетки до края слайдера
            hideMinMax: true,               // спрятать поля Min и Max
            hideFromTo: true,               // спрятать поля From и To
            prettify: false,                 // разделять цифры пробелами 10 000
            disable: false,                 // заблокировать слайдер
//            values: ["a", "b", "c"],        // массив предустановленных значений
            onLoad: function (obj) {        // callback, вызывается при запуске и обновлении
                $('.irs', obj.slider).append('<span class="prepoint">&nbsp;</span>');
                var curfrom = el.defaultValue; //$(el).val();
                if (obj.fromNumber != curfrom) {
                    $(el).ionRangeSlider('update', {
                        'from' : curfrom
                    });
                }
            },
            onChange: function (obj) {      // callback, вызывается при каждом изменении состояния
                var $point = $('.irs-slider.single', obj.slider);
                var $prepoint = $('.prepoint', obj.slider);
                var difX = obj.fromX;
                $point.prop('style', "left: "+difX+"px;  ");
                var prepoint_style = 'width: ' + (difX+2)+ 'px; left: 0px; background: url("/js/ion.RangeSlider/img/sprite-skin-simple.png") repeat-x scroll 0px -4px transparent;             display: block; background-position: 0px -56px; position: absolute;';
                $prepoint.prop('style', prepoint_style );
            },
            onFinish: function (obj) {      // callback, вызывается один раз в конце использования
                var $point = $('.irs-slider.single', obj.slider);
                var $prepoint = $('.prepoint', obj.slider);
                var difX = obj.fromX;
                $point.prop('style', "left: "+difX+"px;  ");
                var prepoint_style = 'width: ' + (difX+2)+ 'px; left: 0px; background: url("/js/ion.RangeSlider/img/sprite-skin-simple.png") repeat-x scroll 0px -4px transparent;             display: block; background-position: 0px -56px;';
                $prepoint.prop('style', prepoint_style );

            }
        });
    });

});
