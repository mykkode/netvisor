$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: 'http://www.mocky.io/v2/5bd4d6363200006800a3be3a',
        success: function(response) {
            $("#replaceThis").html(response);
            $('#loading').remove();
        }
    })
});