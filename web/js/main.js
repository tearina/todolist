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
    alert : function(msg) {
        alert(msg);
    },
    html_remove : function(selector) {
        $(selector).remove();
    },
    html_prepend : function(data) {
        $(data.selector).prepend(data.html);
    },
    html_replace: function(data){
        $(data.selector).replaceWith(data.html);
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
    },
    colorBoxes : function(selector) {
        $(selector).colorbox({rel: 'gal', opacity: 0.5, maxWidth: '700px', maxHeight: '700px', 'photo':true});
    }
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
    $("a.gallery").colorbox({rel: 'gal', opacity: 0.5, maxWidth: '700px', maxHeight: '700px', 'photo':true});
});
