<?php
include '../Classes/Admin.php';

$admin = new Admin();
if(isset($_POST["submit"])){
    $admin -> uploadFile();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>

        .achievementsTable {
            font-family: 'Nunito', sans-serif;
            width: 90%;
            margin: 3% auto;
        }

        .achievementsTable th {
            font-weight: 400;
            background: #8a97a0;
            color: #FFF;
        }

        .achievementsTable tr {
            background: #f4f7f8;
            border-bottom: 1px solid #FFF;
            margin-bottom: 5px;
        }

        .achievementsTable tr:hover {
            background: rgba(8,8,8,0.28);
            border-bottom: 1px solid #FFF;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .achievementsTable tr:nth-child(even) {
            background: #e8eeef;
        }

        .achievementsTable tr:nth-child(even):hover {
            background: rgba(8,8,8,0.28);
        }

        .achievementsTable th, td {
            padding: 20px;
            position: center;
            font-weight: 300;
            text-align: center;
            width: border-box;
        }

        .achievementsTable td > a{
            position: center;
            margin: -1px auto;
            text-decoration: none;
            display: flex;
            /*align-self: center;*/
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            -webkit-box-align: center;
            align-items: center;
            cursor: pointer;
            width: 80px;
            height: 30px;
            min-height: 30px;
            color: rgb(255, 255, 255);
            -webkit-user-drag: none;
            user-select: none;
            background-color: rgb(8, 189, 128);
            border-radius: 4px;
        }


    </style>


    <style>
        @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
        @import url("https://fonts.googleapis.com/css?family=Raleway");
        #imageDiv {
            font-family: "Raleway", sans-serif;
            width: 50%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .wrapper {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-family: inherit;
            margin: 0 0 0.75em 0;
            color: #728c8d;
            text-align: center;
        }

        .box {
            display: block;
            min-width: 300px;
            height: 300px;
            margin: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
        }

        .upload-options {
            position: relative;
            height: 75px;
            background-color: cadetblue;
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            transition: background-color ease-in-out 150ms;
        }
        .upload-options:hover {
            background-color: #7fb1b3;
        }
        .upload-options input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload-options label {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            font-weight: 400;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            overflow: hidden;
        }
        .upload-options label::after {
            content: "add";
            font-family: "Material Icons";
            position: absolute;
            font-size: 2.5rem;
            color: #e6e6e6;
            top: calc(50% - 1.2rem);
            left: calc(50% - 1.25rem);
            z-index: 0;
        }
        .upload-options label span {
            display: inline-block;
            width: 50%;
            height: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: middle;
            text-align: center;
        }
        .upload-options label span:hover i.material-icons {
            color: lightgray;
        }

        .js--image-preview {
            height: 225px;
            width: 100%;
            position: relative;
            overflow: hidden;
            background-image: url("");
            background-color: white;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .js--image-preview::after {
            content: "photo_size_select_actual";
            font-family: "Material Icons";
            position: relative;
            font-size: 4.5em;
            color: #e6e6e6;
            top: calc(50% - 2.2rem);
            left: calc(50% - 2.25rem);
            z-index: 0;
        }
        .js--image-preview.js--no-default::after {
            display: none;
        }
        .js--image-preview:nth-child(2) {
            background-image: url("http://bastianandre.at/giphy.gif");
        }

        @-webkit-keyframes ripple {
            100% {
                opacity: 0;
                transform: scale(2.5);
            }
        }

        @keyframes ripple {
            100% {
                opacity: 0;
                transform: scale(2.5);
            }
        }
    </style>
    <script>
        window.onload = function (){
            function initImageUpload(box) {
                let uploadField = box.querySelector('.image-upload');

                uploadField.addEventListener('change', getFile);

                function getFile(e){
                    let file = e.currentTarget.files[0];
                    checkType(file);
                }

                function previewImage(file){
                    let thumb = box.querySelector('.js--image-preview'),
                            reader = new FileReader();

                    reader.onload = function() {
                        thumb.style.backgroundImage = 'url(' + reader.result + ')';
                    }
                    reader.readAsDataURL(file);
                    thumb.className += ' js--no-default';
                }

                function checkType(file){
                    let imageType = /image.*/;
                    if (!file.type.match(imageType)) {
                        throw 'Please Select an Image';
                    } else if (!file){
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
            function initDropEffect(box){
                let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

                // get clickable area for drop effect
                area = box.querySelector('.js--image-preview');
                area.addEventListener('click', fireRipple);

                function fireRipple(e){
                    area = e.currentTarget
                    // create drop
                    if(!drop){
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
                    x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10)/2);
                    y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10)/2) - 30;

                    // position drop and animate
                    drop.style.top = y + 'px';
                    drop.style.left = x + 'px';
                    drop.className += ' animate';
                    e.stopPropagation();

                }
            }
        }

    </script>
</head>
<body>

<form  method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" accept=".zip,.rar,.7zip">
    <!--        <input type="file" name="imageToUpload" accept=".jpeg, .png, .eps, .gif, .jpg">-->
    <div id="imageDiv">
        <div class="wrapper">
            <div class="box">
                <div class="js--image-preview"></div>
                <div class="upload-options">
                    <label>
                        <input type="file" name="imageToUpload" class="image-upload" accept="image/*" onclose="()"/>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" value="Upload Page" name="submit"/>
</form>

<table class="achievementsTable">

</table>
</body>



