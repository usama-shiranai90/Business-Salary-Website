function openNav() {
  document.getElementById("myloginNav").style.width = "400px";
}

function closeNav(child){
    var parent = document.querySelector("#myloginNav");
    if(!parent.contains(child)){
        document.getElementById("myloginNav").style.width = "0";
    }
    
}

$(document).ready(function(){
    $("#loginButton").click(function(){
        event.stopPropagation();
        openNav();
    });
    
    $("#body").click(function(){
        event.stopPropagation();
        if(document.getElementById("myloginNav").style.width == "400px")
            closeNav(event.target);
    });
    
});



