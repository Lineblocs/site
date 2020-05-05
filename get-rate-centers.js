var centers = [];
var trs = $("tbody tr");
trs.each(function() {
    var tds = $( this ).find("td");
    var value = tds[1].innerText;
    if ( !centers.includes( value )) {
        centers.push( value ); 
    }
});

centers.forEach(function(value) {
    console.log(value+",\r\n");
});