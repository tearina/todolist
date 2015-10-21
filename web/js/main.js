var myajax = {
    request : function myrequest(url, data) {
        $.ajax({
            type : "POST",
            dataType : 'json',
            contentType: false,
            processData: false,
            cache: false,
            url : url,
            data : data,
            success : myajax.success,
            error : myajax.error
        });
    },

    success : function(data) {
        for ( var key in data) {
            event_id = key;
            params = data[key];
            if (typeof (myanswer[event_id]) == 'function')
                myanswer[event_id](params);
        }
    },
    error : function() {
        alert('AJAX REQUEST ERROR!');
    }
};

var myanswer = {
    html_remove : function(selector) {
        $(selector).remove();
    },
    html_prepend : function(data) {
        $(data.selector).prepend(data.html);
    },
    reload : function(data){
        location.reload(); 
    },
    replace : function(href){
        document.location.replace(href);
    },
    open_modal : function(data){
        $('.modal').html(data).modal();
    },
    close_modal : function(data){
        $('.modal').modal('hide');
    }
        /*lightBoxes : function(selector) {
            $(selector).lightBox();
        }*/
};

$(document).ready(function() {
    $('.modal').on('submit', '.ajax_form', function(e) {
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData(form[0]);
        myajax.request(url, data);
        e.isDefaultPrevented();
        return false;
    });
    $(document).on('click', 'a.ajax-link', function() {
        var url = $(this).attr('href');
        myajax.request(url, null);
        return false;
    });
});
