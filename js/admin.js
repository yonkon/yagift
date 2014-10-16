$(document).ready(function(){
   $('table.gift-list input').each(function(i, el) {
       var $el = $(el);
       $el.blur(function() {
           var val = $el.val();
           var initial = $el.data('initial');
           if (val == initial) {
               return;
           }
           $el.data('initial', val);
           var id = $el.parent().parent().data('id');
           var attr = $el.attr('name');
           changeProduct(id, attr, val);
       });
   });
    $('table.gift-list .gift_actions button').each(function(i, el) {
        var $el = $(el);
        $el.click(function() {
            var action = $el.data('action');
            var id = $el.parent().parent().data('id');
//            var attr = 'status';
            if (action == 'enable') {
                enableProduct(id, $el);
            } else if (action == 'disable') {
                disableProduct(id, $el)
            }
        });
    });
});

function changeProduct(id, attr, val) {
    var $cur_row = $('#gift_'+id);
    var $cur_input = $('input.gift_'+attr, $cur_row );
    if(typeof $cur_input.length == 'undefined' || !$cur_input.length) {
        $cur_input = $cur_row;
    }
    var data = {
        'ajax': 'ajax',
        'id' : id
    };
    data[attr] = val;
    var url = '/ajax/product';
    ajax_shadow();
    ajax_get_data(
        url,
        data,
        function() {
            highlight_element($cur_input, 'success');
            ajax_remove_shadow();
        },
        function() {
            highlight_element($cur_input, 'error');
            ajax_remove_shadow();
        }
    );


//    $.ajax({
//        url : url,
//        data : data
//    })
//        .error(function(res) {
//        alert(res);
//    })
//        .success(function(res) {
//            alert(res);
//        });

}


function enableProduct(id, $el) {
    var $cur_row = $('#gift_'+id);
    var data = {
        'ajax': 'ajax',
        'id' : id,
        'status' : 1
    };
    var url = '/ajax/product';
    ajax_shadow();
    ajax_get_data(
        url,
        data,
        function() {
            $cur_row.removeClass('disabled-product');
            $el.addClass('hidden');
            $('button.gift-disable', $cur_row).removeClass('hidden');
            ajax_remove_shadow();
        },
        function() {
            ajax_remove_shadow();
        }
    );
}

function disableProduct(id, $el) {
    var $cur_row = $('#gift_'+id);
    var data = {
        'ajax': 'ajax',
        'id' : id,
        'status' : 0
    };
    var url = '/ajax/product';
    ajax_shadow();
    ajax_get_data(
        url,
        data,
        function() {
            $cur_row.addClass('disabled-product');
            $el.addClass('hidden');
            $('button.gift-enable', $cur_row).removeClass('hidden');
            ajax_remove_shadow();
        },
        function() {
            ajax_remove_shadow();
        }
    );
}
