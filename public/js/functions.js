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
        error: function (xhr) { // jqXHR, textStatus, errorThrown
            /*if (jqXHR.status == 500) {
                alert('Internal error 500: ' + jqXHR.responseText);
                *//*var gen = window.open('', 'Internal error 500', 'height=400px,width=auto');
                gen.document.write(jqXHR.responseText);
                gen.document.close();*//*
            } else if (jqXHR.status == 400) {
                alert(textStatus + '! ' + errorThrown + ': ' + jqXHR.responseText);
            }*/
            alert(xhr.responseJSON.errors.title + '\n' + xhr.responseJSON.errors.amount);

            return false;
        }
    }, 'json');

    return false;
});

function add_perm_exps(title, amount) {
    $('#append_perm_exps').append('' +
    '<tr class="perm_exps">' +
    '<td>'+title+'</td>' +
    '<td>'+amount+'</td>' +
    '</tr>');

    $('.perm_exps').css('display', 'none')
        .fadeIn('slow')
        .removeAttr('class');

    $('body').load(window.location.href,'body');

    //$('input[type=text]').val('');

    return false;
}