/**
 * Global setUp of _token (doesn't work)
 */
/*$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});*/

$('button#add_perm_exp').on('click', function (e) {
    e.preventDefault();

    var formData = {
        title: $('input[name=title]').val(),
        amount: $('input[name=amount]').val(),
        _token: $('input[name=_token]').val() // local setUp of _token
    };

    $.ajax({
        url: $(this).attr('action'),
        type: 'post',
        data: formData,
        cache: false,
        success: function (data) {
            add_perm_exps(data.title, data.amount, data.success)
        },
        error: function (jqXHR) { // jqXHR, textStatus, errorThrown
            if (jqXHR.status == 500) {
                var gen = window.open('', '_self', '');
                gen.document.write(jqXHR.responseText);
                gen.document.close();
            } else if (jqXHR.status == 400) {
                /*alert(jqXHR.responseJSON.errors.title + '\n' + jqXHR.responseJSON.errors.amount);*/
                showError('#errors', jqXHR.responseJSON.errors.title, jqXHR.responseJSON.errors.amount);
            } else {
                alert('Internal error ' + jqXHR.status)
            }

            return false;
        }
    }, 'json');

    return false;
});

function add_perm_exps(title, amount) {
    /*var html = '<tr>' +
        '<td>' + title + '</td>' +
        '<td>' + amount + '</td>' +
        '</tr>';
    $('#append_perm_exps').append(html);*/

    $('body').fadeOut(1).load(window.location.href, 'body').fadeIn(500);
}

// FOR REMOVING object
/*$('#append_perm_exps tr').last().animate({
    width: "toggle",
    height: "toggle",
    opacity: "toggle"
}, 5000);*/

function showError(element, title, amount) {
    var success = 'alert alert-success';
    var danger = 'alert alert-danger';
    if (title == null) {
        $(element).fadeIn(1000);
        $('#title_error').removeClass(danger).addClass(success).html('Ok');
        $('#amount_error').removeClass(success).addClass(danger).html(amount);
    } else if (amount == null) {
        $(element).fadeIn(1000);
        $('#amount_error').removeClass(danger).addClass(success).html('Ok');
        $('#title_error').removeClass(success).addClass(danger).html(title);
    } else {
        $(element).fadeIn(1000);
        $('#title_error').removeClass(success).addClass(danger).html(title);
        $('#amount_error').removeClass(success).addClass(danger).html(amount);
    }

    return false;
}