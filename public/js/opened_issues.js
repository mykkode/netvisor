$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: 'http://www.mocky.io/v2/5bd4d46f3200006a00a3be33',
        success: function(response) {
            $("#replaceThis").html(response);
            $('#loading').remove();
        }
    })
});