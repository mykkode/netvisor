$(document).ready(function () {
    $('#loading').css({"display":""});
    $.ajax({
        type: "POST",
        url: '/dashboard/users/getAllUsers',
        success: function(response) {
            console.log(response);
            var str='';
            for(var i=0;i<response.length;i++) {
                str=str+'<tr>' +
                    '<td>'+response[i].id+'</td>' +
                    '<td>'+response[i].username+'</td>' +
                    '<td>'+response[i].roles[0]+'</td>' +
                    '<td></td>' +
                    '</tr>';
            }
            $("#replaceThis").html(str);
            $('#loading').css({"display":"none"});
        }
    })
});