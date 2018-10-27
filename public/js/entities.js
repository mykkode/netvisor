$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: 'http://www.mocky.io/v2/5bd4d8eb3200006700a3be3c',
        success: function(response) {
            $("#replaceThis").html(response);
            $('#loading').remove();
        }
    })
});