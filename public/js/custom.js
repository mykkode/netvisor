$.getJSON( "http://www.mocky.io/v2/5bd4b3f13200002a00a3be0e", function( data ) {
    var items = [];
    $.each( data, function( key, val ) {
        items.push( "<li id='" + key + "'>" + val + "</li>" );
    });

    $( "<ul/>", {
        "class": "my-new-list",
        html: items.join( "" )
    }).appendTo( "body" );
});

response = $.parseJSON(response);

$(function() {
    console.log($tr.wrap('<p>').html());
});