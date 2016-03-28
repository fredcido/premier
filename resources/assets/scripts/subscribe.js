jQuery(document).ready(
    function()
    {
        
    }
);

 var box = document.getElementById("chx");
    var alrt = document.getElementById("pls");

function check_the_box(){  
    if(!box.checked) {
        alrt.setAttribute("style","display: inline");
            return false
}
else {  
    return true
}
}