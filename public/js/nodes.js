$(document).ready(function () {

    function populateTable(){
        $('#loading').css({"display":""});
        $.ajax({
            type: "POST",
            url: '/dashboard/nodes/getAllNodes',
            success: function(response) {

                var str='';
                for(var i=0;i<response.length;i++) {
                    str=str+'<tr>' +
                        '<td>'+response[i].id+'</td>' +
                        '<td>'+response[i].device.name+'</td>' +
                        '<td>'+response[i].location.name+'</td>' +
                        '<td><button type="button" class="btn btn-warning remove_location" data-id="'+response[i].id+'">X</button>' +
                            '<button type="button" class="btn btn-primary qr_code_button" data-id="'+response[i].id+'" data-toggle="modal" data-target="#qrModal">\n' +
                            'QR Code\n' +
                            '</button>' +
                        '</td>' +
                        '</tr>';
                }
                $("#replaceThis").html(str);
                $('#loading').css({"display":"none"});

                $(".remove_location").click(function () {
                    console.log(this.attributes[2].nodeValue);
                    var id=this.attributes[2].nodeValue;

                    $.ajax({
                        type: "POST",
                        url: '/dashboard/nodes/deleteNode',
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
                $(".qr_code_button").click(function () {
                    var id=this.attributes[2].nodeValue;

                    var url="http://trifu-netvisor.eastus.cloudapp.azure.com/auth/add-issue/"+id;
                    makeCode(url);
                });
            }
        });
    }
    populateTable();

    $("#AddNode").click(function () {

        var type=$("#TypeNod")[0].value;
        var location=$("#LocationNod")[0].value;

        $.ajax({
            type: "POST",
            url: '/dashboard/nodes/addNod',
            data:{
                nameDevice: type,
                nameLocation: location,
            },
            success: function(response) {
                populateTable();
            }
        });
    });
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 100,
        height : 100
    });
    function makeCode (url) {
        qrcode.makeCode(url);
    }

});