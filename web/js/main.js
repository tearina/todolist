var myajax = {
    /**
     * string type (control|open_modal)
     *      control is create update or delete task
     *      open_modal is open modal dialog
     */
    type: null,
    request : function myrequest(url, data, type) {
        this.type = type;
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
        if (data.error)
            alert(data.error);
        else
            if (typeof (task[myajax.type]) == 'function')
                task[myajax.type](data.data);
        myajax.type = null;
    },
    error : function() {
        alert('AJAX REQUEST ERROR!');
    }
};

var task = {
    version : 0,
    open_modal : function(data){
        $('.modal').html(data).modal();
    },
    close_modal : function(){
        $('.modal').modal('hide');
    },
    list_reload : function(html){
        $('.task-list').replaceWith(html);
    },
    img_update : function(){
        $('.task img').each(function(){
            var src = this.src.split('?')[0];
            this.src = src + '?' + task.version;
        });
        this.version += 1;
    },
    colorBoxes : function(selector) {
        $('a.gallery').colorbox({rel: 'gal', opacity: 0.5, maxWidth: '700px', maxHeight: '700px', 'photo':true});
    },
    control: function(html){
        this.close_modal();
        this.list_reload(html);
        this.img_update();
        this.colorBoxes();
    }
};

$(document).ready(function() {
    $('.modal').on('submit', '.ajax_form', function(e) {
        var form = $(this);
        var url = form.attr('action');
        var data = new FormData(form[0]);
        myajax.request(url, data, 'control');
        e.isDefaultPrevented();
        return false;
    });
    $(document).on('click', 'a.ajax-link', function(e) {
        var message = $(this).data('message');
        var url = $(this).attr('href');
        var type = $(this).data('type');
        if (!message || confirm(message))
            myajax.request(url, null, type);
        return false;
    });
    task.colorBoxes();
});
