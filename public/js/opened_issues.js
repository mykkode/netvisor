$(document).ready(function () {
    function populateTable(){
        $('#loading').css({"display":""});
        $.ajax({
            type: "POST",
            url: '/dashboard/get-issues',
            success: function(response) {
                console.log(response);
                // var str='';
                // for(var i=0;i<response.length;i++) {
                //     str=str+'<tr>' +
                //         '<td>'+response[i].id+'</td>' +
                //         '<td>'+response[i].name+'</td>' +
                //         '<td>0</td>' +
                //         '<td><button type="button" class="btn btn-warning remove_location" data-id="'+response[i].id+'">X</button></td>' +
                //         '</tr>';
                // }
                // $("#replaceThis").html(str);
                $('#loading').css({"display":"none"});

            }
        });
    }
    populateTable();
});