$(document).ready(function () {

    function populateTable(){
        $('#loading').css({"display":""});
        $.ajax({
            type: "GET",
            url: '/dashboard/devices/getAllDevices',
            success: function(response) {
                var str='';
                for(var i=0;i<response.length;i++) {
                    str=str+'<tr>' +
                                '<td>'+response[i].id+'</td>' +
                                '<td>'+response[i].name+'</td>' +
                                '<td><button type="button" class="btn btn-warning remove_device" data-id="'+response[i].id+'">X</button></td>' +
                            '</tr>';
                }
                $("#replaceThis").html(str);
                $('#loading').css({"display":"none"});

                $(".remove_device").click(function () {
                    console.log(this.attributes[2].nodeValue);
                    var id=this.attributes[2].nodeValue;

                    $.ajax({
                        type: "POST",
                        url: '/dashboard/devices/deleteDevice',
                        data: {id:id},
                        success: function(response) {
                            console.log(response);
                            if(response){
                                populateTable();
                            }
                        },
                        error: function (out) {
                            console.log("nu merge");
                            console.log(out);
                        }
                    });
                });
            }
        });
    }
    populateTable();

    $("#AddDevice").click(function () {
        var DeviceName=$("#DeviceName")[0].value;

        $.ajax({
            type: "POST",
            url: '/dashboard/devices/insertDevice',
            data: {name:DeviceName},
            success: function(response) {
                if(response){
                    populateTable();
                }
            }
        });
    });

});