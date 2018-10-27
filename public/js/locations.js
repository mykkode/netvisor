$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: 'http://www.mocky.io/v2/5bd4d5da3200007000a3be38',
        success: function(response) {
            $("#replaceThis").html(response);
            $('#loading').remove();
        }
    })

});