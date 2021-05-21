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

window.onload = function () {

//  ids of Forms
    const dashboard_form_ID = document.getElementById("dashboard");
    const productSubmission_form_ID = document.getElementById("productSub");
    const requestPage_form_ID = document.getElementById("requestPage");
    const aboutUs_form_ID = document.getElementById("aboutUs");

    const uploadPage_form_ID = document.getElementById("uploadPage");
    $(document).ready(function () {

        var iconSection_array = ['#dashboardIcon', '#psubmissionIcon', '#requestPageIcon'
            , '#uploadPageIcon', '#aboutusIcon'];

        $('#dashboardIcon').click(function () {
            $("#dashboard").show();
            $("#productSub").hide();
            $("#requestPage").hide();
            $("#uploadPage").hide();
            $("#aboutUs").hide();

            for (var i = 0; i < 5; i++) {
                if ('#dashboardIcon' === iconSection_array[i]) {
                    $(iconSection_array[i].concat(' ')).addClass('active');
                } else
                    $(iconSection_array[i].concat(' ')).removeClass("active");
            }

            requestPage_form_ID.style.display = "none";
            productSubmission_form_ID.style.display = "none";
            dashboard_form_ID.style.display = "block";
            aboutUs_form_ID.style.display = "none";
            uploadPage_form_ID.style.display = "none";
        });

        $("#psubmissionIcon").click(function () {
            $("#dashboard").hide();
            $("#productSub").show();
            $("#requestPage").hide();
            $("#aboutUs").hide();
            $("#uploadPage").hide();

            for (var i = 0; i < 5; i++) {
                if ('#psubmissionIcon' === iconSection_array[i]) {
                    $(iconSection_array[i].concat(' ')).addClass('active');
                } else
                    $(iconSection_array[i].concat(' ')).removeClass("active");
            }

            requestPage_form_ID.style.display = "none";
            productSubmission_form_ID.style.display = "block";
            dashboard_form_ID.style.display = "none";
            aboutUs_form_ID.style.display = "none";
            uploadPage_form_ID.style.display = "none";
        });

        $("#requestPageIcon").click(function () {
            $("#dashboard").hide();
            $("#productSub").hide();
            $("#requestPage").show();
            $("#aboutUs").hide();
            $("#uploadPage").hide();

            for (var i = 0; i < 5; i++) {
                if ('#requestPageIcon' === iconSection_array[i]) {
                    $(iconSection_array[i].concat(' ')).addClass('active');
                } else
                    $(iconSection_array[i].concat(' ')).removeClass("active");
            }

            requestPage_form_ID.style.display = "block";
            productSubmission_form_ID.style.display = "none";
            dashboard_form_ID.style.display = "none";
            aboutUs_form_ID.style.display = "none";
            uploadPage_form_ID.style.display = "none";
        });

        $("#aboutusIcon").click(function () {
            $("#dashboard").hide();
            $("#productSub").hide();
            $("#requestPage").hide();
            $("#aboutUs").show();
            $("#uploadPage").hide();

            for (var i = 0; i < 5; i++) {
                if ('#aboutusIcon' === iconSection_array[i]) {
                    $(iconSection_array[i].concat(' ')).addClass('active');
                } else
                    $(iconSection_array[i].concat(' ')).removeClass("active");
            }

            requestPage_form_ID.style.display = "none";
            productSubmission_form_ID.style.display = "none";
            dashboard_form_ID.style.display = "none";
            aboutUs_form_ID.style.display = "block";
            uploadPage_form_ID.style.display = "none";
        });


        $("#uploadPageIcon").click(function () {
            $("#uploadPage").show();
            $("#dashboard").hide();
            $("#productSub").hide();
            $("#requestPage").hide();
            $("#aboutUs").hide();

            for (var i = 0; i < 5; i++) {
                if ('#uploadPageIcon' === iconSection_array[i]) {
                    $(iconSection_array[i].concat(' ')).addClass('active');
                } else
                    $(iconSection_array[i].concat(' ')).removeClass("active");
            }

            uploadPage_form_ID.style.display = "block";
            requestPage_form_ID.style.display = "none";
            productSubmission_form_ID.style.display = "none";
            dashboard_form_ID.style.display = "none";
            aboutUs_form_ID.style.display = "none";
        });


    })

    // HannanS Image Upload Section
    function initImageUpload(box) {
        let uploadField = box.querySelector('.imageInput');

        uploadField.addEventListener('change', getFile);

        function getFile(e) {
            let file = e.currentTarget.files[0];
            checkType(file);
        }

        function previewImage(file) {
            let thumb = box.querySelector('.js--image-preview'),
                reader = new FileReader();

            reader.onload = function () {
                thumb.style.backgroundImage = 'url(' + reader.result + ')';
            }
            reader.readAsDataURL(file);
            thumb.className += ' js--no-default';
        }

        function checkType(file) {
            let imageType = /image.*/;
            if (!file.type.match(imageType)) {
                throw 'Please Select an Image';
            } else if (!file) {
                throw 'No Picture Selected';
            } else {
                previewImage(file);
            }
        }

    }

    // initialize box-scope
    var boxes = document.querySelectorAll('.box');

    for (let i = 0; i < boxes.length; i++) {
        let box = boxes[i];
        initDropEffect(box);
        initImageUpload(box);
    }


    /// drop-effect
    function initDropEffect(box) {
        let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

        // get clickable area for drop effect
        area = box.querySelector('.js--image-preview');
        area.addEventListener('click', fireRipple);

        function fireRipple(e) {
            area = e.currentTarget
            // create drop
            if (!drop) {
                drop = document.createElement('span');
                drop.className = 'drop';
                this.appendChild(drop);
            }
            // reset animate class
            drop.className = 'drop';

            // calculate dimensions of area (longest side)
            areaWidth = getComputedStyle(this, null).getPropertyValue("width");
            areaHeight = getComputedStyle(this, null).getPropertyValue("height");
            maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

            // set drop dimensions to fill area
            drop.style.width = maxDistance + 'px';
            drop.style.height = maxDistance + 'px';

            // calculate dimensions of drop
            dropWidth = getComputedStyle(this, null).getPropertyValue("width");
            dropHeight = getComputedStyle(this, null).getPropertyValue("height");

            // calculate relative coordinates of click
            // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
            x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10) / 2);
            y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10) / 2) - 30;

            // position drop and animate
            drop.style.top = y + 'px';
            drop.style.left = x + 'px';
            drop.className += ' animate';
            e.stopPropagation();

        }
    }


}

// upload file transition and add classes.
$(document).ready(function () {
    $('#upload-file').change(function () {
        var filename = $(this).val();
        $('#file-upload-name').html(filename);
        if (filename != "") {
            setTimeout(function () {
                $('.upload-wrapper').addClass("uploaded");
            }, 600);
            setTimeout(function () {
                $('.upload-wrapper').removeClass("uploaded");
                $('.upload-wrapper').addClass("success");
            }, 1600);
        }
    });
});


