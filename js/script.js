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

//  ids of Forms
const dashboard_form_ID = document.getElementById("dashboard");
const productSubmission_form_ID = document.getElementById("productSub");
const requestPage_form_ID = document.getElementById("requestPage");
const aboutUs_form_ID = document.getElementById("aboutUs");


$(document).ready(function () {

    var iconSection_array = ['#dashboardIcon', '#psubmissionIcon', 'requestPageIcon',
        '#aboutusIcon'];

    $('#dashboardIcon').click(function () {
        $("#dashboard").show();
        $("#productSub").hide();
        $("#requestPage").hide();
        $("#aboutUs").hide();

        for (var i = 0; i < 4; i++) {
            if ('#dashboardIcon' === iconSection_array[i]) {
                $(iconSection_array[i].concat(' ')).addClass('active');
            } else
                $(iconSection_array[i].concat(' ')).removeClass("active");
        }

        requestPage_form_ID.style.display = "none";
        productSubmission_form_ID.style.display = "none";
        dashboard_form_ID.style.display = "block";
        aboutUs_form_ID.style.display = "none";
    });

    $("#psubmissionIcon").click(function () {
        $("#dashboard").hide();
        $("#productSub").show();
        $("#requestPage").hide();
        $("#aboutUs").hide();

        for (var i = 0; i < 4; i++) {
            if ('#psubmissionIcon' === iconSection_array[i]) {
                $(iconSection_array[i].concat(' ')).addClass('active');
            } else
                $(iconSection_array[i].concat(' ')).removeClass("active");
        }

        requestPage_form_ID.style.display = "none";
        productSubmission_form_ID.style.display = "block";
        dashboard_form_ID.style.display = "none";
        aboutUs_form_ID.style.display = "none";

    });

    $("#requestPageIcon").click(function () {
        $("#dashboard").hide();
        $("#productSub").hide();
        $("#requestPage").show();
        $("#aboutUs").hide();

        for (var i = 0; i < 4; i++) {
            if ('#requestPageIcon' === iconSection_array[i]) {
                $(iconSection_array[i].concat(' ')).addClass('active');
            } else
                $(iconSection_array[i].concat(' ')).removeClass("active");
        }

        requestPage_form_ID.style.display = "block";
        productSubmission_form_ID.style.display = "none";
        dashboard_form_ID.style.display = "none";
        aboutUs_form_ID.style.display = "none";
    });

    $("#aboutusIcon").click(function () {
        $("#dashboard").hide();
        $("#productSub").hide();
        $("#requestPage").hide();
        $("#aboutUs").show();

        for (var i = 0; i < 4; i++) {
            if ('#aboutusIcon' === iconSection_array[i]) {
                $(iconSection_array[i].concat(' ')).addClass('active');
            } else
                $(iconSection_array[i].concat(' ')).removeClass("active");
        }

        requestPage_form_ID.style.display = "none";
        productSubmission_form_ID.style.display = "none";
        dashboard_form_ID.style.display = "none";
        aboutUs_form_ID.style.display = "block";
    });


})




