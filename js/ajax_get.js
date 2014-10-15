function ajax_get_options(url, post_data, target_select) {
    var $tagret = $(target_select);
    $.ajax({
        type: "POST",
        url: url,
        data: post_data
})

.success(function( msg ) {
    if(typeof msg != 'undefined') {
        var data = JSON.parse(msg);
        if(typeof data.status != 'undefined' && data.status == 'OK') {
            $(target_select+' option:not(:first)').remove();
            for(var i=0; i<data.data.length; i++) {
                var option = data.data[i];
                var opt = document.createElement('option');
                $tagret.append(opt);
                var $opt = $(opt);
                $opt.val(option.value);
                $opt.text(option.text);
                if(typeof option.data != 'undefined') {
                    for(var j=0; j<option.data.length; j++) {
                        var o_data = option.data;
                        $opt.data(o_data.key, o_data.value);
                    }
                }
            }
        } else {
            alert('JSON malformat error');
        }
    }
})

    .error(function( msg ) {
            alert('Server error');
    });
}

function ajax_get_data(url, post_data, callback, err_callback){

    $.ajax({
        type: "POST",
        url: url,
        data: post_data
    })

        .success(function( msg ) {
            if(typeof msg != 'undefined') {
                var data = JSON.parse(msg);
                if(typeof data.status != 'undefined' && data.status == 'OK') {
                    callback(data.data);
                } else {
                    alert('Incorrect response');
                    if (typeof err_callback == 'function') {
                        err_callback(msg);
                    }
                }
            }
        })

        .error(function( msg ) {
            alert('Server error');
            if (typeof err_callback == 'function') {
                err_callback(msg);
            }
        });
}

function ajax_shadow() {
    var shadow = $('#ajax_shadow');
    if(typeof shadow.length != 'undefined' && shadow.length) {
        shadow.show();
    } else {
        shadow = document.createElement('div');
        shadow.id = 'ajax_shadow';
        document.body.appendChild(shadow);
        var loader = document.createElement('div');
        loader.id = 'ajax_loader';
        shadow.appendChild(loader);
    }
}

function ajax_remove_shadow() {
    $('#ajax_shadow').hide();
}

function highlight_element($el, additionalClass, timeout) {
    if (typeof timeout != 'undefined') {
        timeout = parseInt(timeout);
    }
    if (!timeout) {
        timeout = 3000;
    }
    $el.addClass('highlight');
    if (typeof additionalClass != 'undefined') {
        $el.addClass(additionalClass);
    }
    setTimeout(function(){
        $el.removeClass('highlight');
        if (typeof additionalClass != 'undefined') {
            $el.removeClass(additionalClass);
        }
    }, timeout);
}
