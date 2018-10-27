$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: 'http://www.mocky.io/v2/5bd4d5653200004800a3be34',
        success: function(response) {
            $("#replaceThis").html(response);
            $('#loading').remove();
        }
    })
});