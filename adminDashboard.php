<?php
include 'Classes/Admin.php';

$access = new access();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*$access->inactivityDestroy();
$flag = $access->loggedIn();

if (!$flag) {
    header("Location: index.php");
}*/
$admin = new Admin();
    
    if (isset($_POST["upload"])) {
//        echo "waroo";
       echo "waroo".$admin->uploadFile();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AdminPage</title>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="Business-Salary-Website-Files/tableStyle.css" rel="stylesheet" type="text/css">
    <link href="Business-Salary-Website-Files/userDashBoard.css" rel="stylesheet" type="text/css">
    <link href="Business-Salary-Website-Files/uploadImage.css" rel="stylesheet" type="text/css">
    
    <script src="Business-Salary-Website-Files/scripts/script.js"></script>

    <style>
        
        .header-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-basis: 100%;
            margin-left: 60px;
            background-color: rgb(245 240 240);
            box-shadow: rgb(136 160 141 / 44%) 0px 16px 32px 0px;
        }

        .header {
            margin: 14px;
            text-align: center;
        }

        h2 {
            margin-top: 5px;
            text-align: center;
        }

        span.main-color {
            color: #5c9e6d;
            font-size: 0.7em;
        }

        a.navbar-brand {
            font-size: 2.7em;
            color: darkgoldenrod;

        }

    </style>
 
</head>
<body>

<nav class="sidebar-menu">
    <script src="https://kit.fontawesome.com/cfe7fc5fad.js" crossorigin="anonymous"></script>
    <!--    Un-ordered list of sidebar menu (Main Content)    -->
    <ul>
        <li>
            <a id="dashboardIcon" href="#" class="li-box active">
                <!--fa-2x-->
                <i class="fa fa-home "></i>
                <span class="nav-text">
                            Dashboard
                        </span>
            </a>

        </li>
        <li class="has-subnav">
            <a id="psubmissionIcon" href="#" class="li-box">
                <i class="fa fa-laptop "></i>
                <span class="nav-text">
                            Users-Product-Selling
                        </span>
            </a>

        </li>

        <li>
            <a id="uploadPageIcon" href="#" class="li-box">
                <i class="fa fa-upload"></i>
                <span class="nav-text">
                            Upload Pages
                        </span>
            </a>
        </li>

        <li>
            <a id="aboutusIcon" href="#" class="li-box">
                <i class="fa fa-bar-chart-o "></i>
                <span class="nav-text">
                            About Us
                        </span>
            </a>
        </li>

    </ul>

    <!--        Un-ordered list of Logout button-->
    <ul class="logout">
        <li>

            <a href="Classes/logout.php">
                <i class="fa fa-power-off  "></i>
                <span class="nav-text">
                            Logout
                        </span>
            </a>
        </li>
    </ul>


</nav>

<!-- Dashboard section-->
<div id="dashboard" class="main-dashboard-section" style="display: block">

    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">My<span class="main-color">Dashboard</span></a>

        </div>
    </div>
    <div class="welcome">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h2 class="weldb-h2">Welcome to Dashboard</h2>
                        <p class="weldb-p">You can look-into your product-seller detail and other necessary
                            information</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="statistics">
        <div class="container-fluid cont-fl-c2">

            <div class="cont-fluid-boxdata ">
                <div class="cont-fluid-box">

                    <div class="icon-color">
                        <!--                        <i class="fa fa-envelope fa-fw bg-primary "></i>-->
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <div class="info">


                        <h3 class="box-h3"><?php echo $admin->getMonthlyProductsSold() ?></h3>
                        <span>Products Sold</span>
                        <p>contains all the product sold by every user this month </p>
                    </div>
                </div>
            </div>
            <div class="cont-fluid-boxdata cont-fluid-boxdata-c2">
                <div class="cont-fluid-box">

                    <div class="icon-color">
                        <!--                        <i class="fa fa-file fa-fw danger fa-c3"></i>-->
                        <i class="fa fa-hand-holding-usd fa-c3"></i>
                    </div>
                    <div class="info">
                        <h3 class="box-h3"><?php
                            $getMonthlySalarytoPay = (float)$admin->getMonthlySales();

/*                            $arr = str_split($getMonthlySalarytoPay, "3");
                            echo $monthlySalaryPay = implode(",", $arr);*/

                             echo '$'.number_format("$getMonthlySalarytoPay",1)

                            ?></h3> <span>Total Sale</span>
                        <p>contains all sales made by users upto this day.</p>
                    </div>


                </div>
            </div>

            <div class="cont-fluid-boxdata cont-fluid-boxdata-c2">
                <div class="cont-fluid-box">

                    <div class="icon-color">
                        <!--                        <i class="fa fa-users fa-fw success fa-c3"></i>-->
                        <i class="fas fa-wallet fa-c3"></i>
                    </div>
                    <div class="info">
                        <h3 class="box-h3"><?php
                            $monthlySalaryPay = (float)$admin->getMonthlySalarytoPay();

/*                            if ($monthlySalaryPay)
                            $arr = str_split($monthlySalaryPay, "3");
                            $monthlySalaryPay = implode(",", $arr);*/


                          echo '$'.number_format("$monthlySalaryPay",1)  ?></h3> <span>Total Salary</span>
                        <p>contains overall salary to pay</p>
                    </div>

                </div>
            </div>


        </div>
    </section>

    <article>
        <h1>Quote of the Day</h1>
        <p>"As you get older three things happen. The first is your memory goes, and I can't remember the other two.</p>
        <p><span class="name">Norman Wisdom</span></p>
    </article>
</div>

<!-- User Product Sold Section -->
<div id="productSub" class="main-product-submission-section" style="display: none ">
    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">Sales S<span class="main-color">ummary</span> </a>
        </div>
    </div>

    <!--        <iframe class="if-c1" src="Classes/Dashboard.php" style=" width:99%">
            <?php
    /*            if (isset($_POST["submit"])){

                    $admin = new Admin();
                    $_SESSION['month'] = $_POST['months'];
                    $admin->getEmployeesDetails($_POST['months']);
                }
                */ ?>
        </iframe>-->


    <div id="summaryDiv" class="formsubmission-c1">
        <div class="select" style="margin: 3% 38% 5% 38%">
            <select id="monthSelector" name="months" required>
                <option value="none" selected disabled hidden>
                    Month
                </option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $("#monthSelector").click(function () {
            thisMonth = document.getElementById('monthSelector').value;
            if (thisMonth !== "none") {
                $.ajax({
                    url: 'Classes/Summary.php',
                    type: 'POST',
                    data: ({month: thisMonth}),

                    success: function (data) {
                        // $("#summaryDiv").html(data);
                        if (!data.includes("<table")) {
                            alert("Session expired due to inactivity.")
                            window.location.replace("index.php");
                        } else {
                            $("#summaryDiv").html(data);
                        }
                    }
                });
            }
        });
    });
</script>

<!-- Upload Page Section -->
<div id="uploadPage" class="main-product-submission-section" style="display: none ">

    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">Upload <span class="main-color">Page</span></a>
        </div>
    </div>
    
    <div class="formsubmission-c1">
        <form class="" method="post" enctype="multipart/form-data">
            <div class="header">
                <h3 class=" h3cls_txt iTnlHn" style="font-size: 2.7em; color: darkgoldenrod;">
                    Welcome <span class="main-color">Please complete the required fields according to proceed.</span>
                </h3>
            </div>
            <div class="flex-image-div">
                <img src="https://static.uacdn.net/production/_next/static/images/goal/girl.svg">
            </div>


            <!--            Upload Section -->
            <div style="width: fit-content;display: flex;margin: 0 5%;">
                <!-- upload section div-->
                <div class="groupsection">
                    <h3 style="margin-bottom: -10%;text-align: center;">Upload File </h3>
                    <div class="main-wrapper">
                        <div class="upload-main-wrapper">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <!--                                      <label>File Upload</label>-->

                            <div class="upload-wrapper">
                                <input type="file" id="upload-file" name="fileToUpload" accept=".zip,.rar,.7zip" required>

                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet"
                                     viewBox="224.3881704980842 176.8527621722847 221.13266283524905 178.8472378277154"
                                     width="221.13" height="178.85">
                                    <defs>
                                        <path d="M357.38 176.85C386.18 176.85 409.53 204.24 409.53 238.02C409.53 239.29 409.5 240.56 409.42 241.81C430.23 246.95 445.52 264.16 445.52 284.59C445.52 284.59 445.52 284.59 445.52 284.59C445.52 309.08 423.56 328.94 396.47 328.94C384.17 328.94 285.74 328.94 273.44 328.94C246.35 328.94 224.39 309.08 224.39 284.59C224.39 284.59 224.39 284.59 224.39 284.59C224.39 263.24 241.08 245.41 263.31 241.2C265.3 218.05 281.96 199.98 302.22 199.98C306.67 199.98 310.94 200.85 314.93 202.46C324.4 186.96 339.88 176.85 357.38 176.85Z"
                                              id="b1aO7LLtdW"></path>
                                        <path d="M306.46 297.6L339.79 297.6L373.13 297.6L339.79 255.94L306.46 297.6Z"
                                              id="c4SXvvMdYD"></path>
                                        <path d="M350.79 293.05L328.79 293.05L328.79 355.7L350.79 355.7L350.79 293.05Z"
                                              id="b11si2zUk"></path>
                                    </defs>
                                    <g>
                                        <g>
                                            <g>
                                                <use xlink:href="#b1aO7LLtdW" opacity="1" fill="#ffffff"
                                                     fill-opacity="1"></use>
                                            </g>
                                            <g>
                                                <g>
                                                    <use xlink:href="#c4SXvvMdYD" opacity="1" fill="#363535"
                                                         fill-opacity="1"></use>
                                                </g>
                                                <g>
                                                    <use xlink:href="#b11si2zUk" opacity="1" fill="#363535"
                                                         fill-opacity="1"></use>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="file-upload-text" style="margin-left: 14px;">Upload!</span>
                                <div class="file-success-text">
                                    <svg version="1.1" id="check" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 100 100" xml:space="preserve">
                          <circle style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-miterlimit:10;"
                                  cx="49.799" cy="49.746" r="44.757"></circle>
                                        <polyline
                                                style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                points="
                              27.114,51 41.402,65.288 72.485,34.205 "></polyline>
                          </svg>
                                    <span>Successfully</span></div>
                            </div>
                            <p id="file-upload-name"></p>
                        </div>
                    </div>

                </div>

                <!--            image section Div-->
                <!--

                                <div class="groupsection">
                    <h3 style="text-align: center;">Image Upload</h3>
                    <div id="imageDiv">
                        <div class="wrapper">
                            <div class="box">
                                <div class="js--image-preview"></div>
                                <div class="upload-options">
                                    <label class="lb">
                                        <input class="imageInput" type="file" name="imageToUpload" onclose="initImageUpload()" accept=".jpeg, .png, .eps, .gif, .jpg">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                <div class="group groupsection" style="top: 50px;">
                    <input name="previewLink" type="text" required="" >
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Upload Image URL</label>
                </div>
            </div>


            <div class="alert alert-success" role="alert" id="success_message"
                 style=" margin-top: 15px;    margin-left: 4%;">
                Success
                <i class="glyphicon glyphicon-thumbs-up"></i> Thank you for Contributing, please continue.
            </div>
            <br>

            <button name="upload" id="uploadbtn" type="submit" aria-label="continue"
                    class="Button__StyleButtonHeaderLogin continueButton" style="margin: auto;">Submit
            </button>

            <!--            message box-->
            <span></span>

            <!-- Button -->
            <div class="groupsection">
                <label class="col-md-4 control-label"></label>
            </div>
        </form>


    </div>

</div>

<!-- About Us Section -->
<div id="aboutUs" class="main-about-us-section" style="display: none">
    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">About<span class="main-color">Us!</span></a>
        </div>
    </div>

    <div class="aboutUsSection aus-c2">

        <div class="card-owl">

            <div class="card-header">

                <div class="waves-container">
                    <div class="wave wave1"></div>
                    <div class="wave wave2"></div>
                    <div class="wave wave3"></div>
                </div>
                <img class="profile-img" src="Business-Salary-Website-Files/Pictures/pp.jpg" alt="my picture profile.">
            </div>

            <div class="card-body">
                <h2>OneEyedOwl</h2>
                <p>My name OneEyedOwl , Dedicated and Performance-driven software engineering Intern with pro-active
                    approach and determination to solve and successfully finish all assigned task. capable of showing
                    firm and positive response while working under pressure. Effective team player offering
                    extraordinary analytical skills and the important ability to think critically. Eager to absorb as
                    much knowledge and insight as possible in pursuance of my goals.</p>
                <a href="http://google.com.pk" class="btn">check my work</a>
            </div>

        </div>
        <div class="card-zero">

            <div class="card-header">
                <div class="waves-container">
                    <div class="wave wave1"></div>
                    <div class="wave wave2"></div>
                    <div class="wave wave3"></div>
                </div>
                <img class="profile-img" src="Business-Salary-Website-Files/Pictures/zero.jpeg"
                     alt="my picture profile.">
            </div>
            <div class="card-body">
                <h2>
                    Zero
                </h2>
                <p>My name Zero , Dedicated and Performance-driven software engineering Intern with pro-active approach
                    and determination to solve and successfully finish all assigned task. capable of showing firm and
                    positive response while working under pressure. Effective team player offering extraordinary
                    analytical skills and the important ability to think critically. Eager to absorb as much knowledge
                    and insight as possible in pursuance of my goals.</p>
                <a href="http://google.com.pk" class="btn">check my work</a>
            </div>


        </div>

    </div>


</div>

</body>
</html>
