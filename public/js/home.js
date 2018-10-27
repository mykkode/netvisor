$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: 'http://www.mocky.io/v2/5bd4c7ba3200005d00a3be31',
        success: function(response) {
            $("#replaceThis").html(response);
            $('#loading').remove();
        }
    })
});