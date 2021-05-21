<?php
    include 'Classes/Admin.php';
    include 'Classes/Employee.php';
    
    $access = new access();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // $access->inactivityDestroy();
    /*$flag = $access->loggedIn();
    
    if (!$flag) {
        header("Location: index.php");
    }*/
    
    $admin = new Admin();
    $emp = new Employee();
    $_SESSION['message'] = '';
    if (isset($_POST["productSubmit"])) {
        $emp->submitDetails($_POST['selectID'], $_POST['productPrice'], $_POST['selectID-payment'], $_POST['productInvestment'], $_POST['dateOfSubmit']);
        
        header("Location: userDashboard.php");
    }
    
    if (isset($_POST["contiuneproductsub"])) {
        
        $message = 'Page Request Send By Client.' . "\n";
        $message .= '<strong>Website URL : </strong>' . $_POST['websiteLink'] . "\n" . '<b>Product Information : </b>' . $_POST['info_product'] . "\n" . '<b>Date To Submit : </b>' . $_POST['datetoSubmit'];
        $_SESSION['message'] = $message;
        include "Classes/telmessage.php";
        submitrequest($message);
        header("Location: userDashboard.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        window.history.forward();
    </script>
    <meta charset="utf-8">
    <title>Income-Coltax User-Dashboard</title>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="Business-Salary-Website-Files/tableStyle.css" rel="stylesheet" type="text/css">
    <link href="Business-Salary-Website-Files/userDashBoard.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>


    <script src="https://kit.fontawesome.com/cfe7fc5fad.js" crossorigin="anonymous"></script>
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

<!--side bar section-->
<nav class="sidebar-menu">
    <!--    Un-ordered list of sidebar menu (Main Content)    -->
    <ul>
        <li>
            <a id="dashboardIcon" href="#" class="li-box active">
                <i class="fa fa-home  "></i>
                <span class="nav-text">
                            Dashboard
                        </span>
            </a>

        </li>
        <li class="has-subnav">
            <a id="psubmissionIcon" href="#" class="li-box">
                <i class="fa fa-laptop  "></i>
                <span class="nav-text">
                            Product Submission
                        </span>
            </a>

        </li>
        <li class="has-subnav">
            <a id="requestPageIcon" href="#" class="li-box">
                <i class="fa fa-list  "></i>
                <span class="nav-text">
                            Request-ScumPage
                        </span>
            </a>

        </li>

        <li>
            <a id="uploadPageIcon" href="#" class="li-box">
                <i class="fa fa-upload"></i>
                <span class="nav-text">
                            Pages List
                        </span>
            </a>
        </li>

        <li>
            <a id="aboutusIcon" href="#" class="li-box">
                <i class="fa fa-bar-chart-o  "></i>
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
                <i class="fa fa-power-off "></i>
                <span class="nav-text">
                            Logout
                        </span>
            </a>
        </li>
    </ul>


</nav>

<!--dashboard code-->
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
                        <p class="weldb-p">You can look-into your product selling and other necessary information</p>
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
                        <!--                        <i class="fa fa-envelope fa-fw bg-primary fa-c3"></i>-->
                        <i class="fa fa-hand-holding-usd fa-fw bg-primary fa-c3"></i>
                    </div>
                    <div class="info">
                        <h3 class="box-h3"><?php echo $emp->getEmployeeMonthlySales() ?></h3> <span>Sales</span>
                        <p>contains your monthly sales</p>
                    </div>
                </div>
            </div>

            <div class="cont-fluid-boxdata cont-fluid-boxdata-c2">
                <div class="cont-fluid-box">

                    <div class="icon-color">
                        <!--                        <i class="fa fa-file fa-fw danger fa-c3"></i>-->
                        <i class="fas fa-box-open fa-fw danger fa-c3"></i>
                    </div>
                    <div class="info">
                        <h3 class="box-h3"><?php echo $emp->getEmployeeMonthlySales() ?></h3> <span>Products</span>
                        <p>contains all product sales in month</p>
                    </div>


                </div>
            </div>

            <div class="cont-fluid-boxdata cont-fluid-boxdata-c2">
                <div class="cont-fluid-box">

                    <div class="icon-color">
                        <!--                        <i class="fa fa-users fa-fw success fa-c3"></i>-->
                        <i class="fas fa-hand-holding-usd fa-fw success fa-c3"></i>
                    </div>
                    <div class="info">
                        <h3 class="box-h3"><?php
                                $result = (string)$emp->getEmployeeMonthlyInvestment();
                                echo '$' . number_format("$result", 1)
                            
                            ?></h3> <span>Investment</span>
                        <p>contains your monthly investment.</p>
                    </div>

                </div>
            </div>

            <div class="cont-fluid-boxdata cont-fluid-boxdata-c2">
                <div class="cont-fluid-box">

                    <div class="icon-color">
                        <i class="fa fa-users fa-fw success fa-c3"></i>

                    </div>

                    <div class="info">
                        <h3 class="box-h3"><?php
                                $result = (string)$emp->getEmployeeMonthlySalary();
                                echo '$' . number_format("$result", 1)
                            
                            ?></h3> <span>Monthly Salary</span>
                        <p>Well , you know where this is going.</p>
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

<!--product submission code..-->
<div id="productSub" class="main-product-submission-section" style="display: none">
    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">Product<span class="main-color">Submission</span></a>
        </div>
    </div>

    <div class="formsubmission-c1">
        <form class="form-c1 container-fluid" action=" " method="post" id="contact_form">
            <div class="header">
                <h3 class=" h3cls_txt iTnlHn" style="font-size: 2.7em; color: darkgoldenrod;">
                    Welcome <span class="main-color">Please submit your form according</span>
                </h3>
            </div>
            <div class="flex-image-div">
                <img src="https://static.uacdn.net/production/_next/static/images/goal/girl.svg">
            </div>
            <div style="width: fit-content;display: flex; flex-direction: column">
                <h3 color="#3C4852" class=" h3cls_txt iTnlHn">Please Fill all the fields to continue.</h3>
                <!-- Selector-->
                <div class="select">
                    <select name="selectID" id="selectID" required="">
                        <option selected disabled hidden>Products</option>
                        <!--                        <option value="1">Scampage</option>
                                                <option value="2">Antibot Scampage</option>
                                                <option value="3">Monthly Cpanel</option>
                                                <option value="4">Hacked Cpanel</option>
                                                <option value="5">Amazon Smtp</option>
                                                <option value="6">Amazon Office Smtp</option>
                                                <option value="7">Monthly Rdp</option>
                                                <option value="8">Hacked Rdp</option>
                                                <option value="9">Email Leads</option>-->
                        <?php $admin->getProductsList(); ?>
                    </select>
                </div>

                <div class="group">
                    <input name="productPrice" type="text" required="">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Product Price</label>
                </div>

                <div class="select">
                    <select name="selectID-payment" id="paymentID" required>
                        <option selected disabled hidden>Payment Method</option>
                        <!--                        <option selected>-->
                        <?php //echo $admin->getProductPaymentType()?><!--</option-->
                        <?php $admin->getPaymentTypesList(); ?>
                    </select>
                </div>

                <div class="group">
                    <input name="productInvestment" type="text" required="">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Product Investment</label>
                </div>

                <div class="group">
                    <input id="datepick" type="text" required="" name="dateOfSubmit">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Date Of Submission</label>
                    <script>

                        $(document).ready(function () {
                            $("#datepick").click(function (event) {
                                event.stopPropagation();
                                if (document.getElementById('datepick').type === "text")
                                    document.getElementById('datepick').type = 'date';
                            });

                            $("body").click(function (event) {
                                event.stopPropagation();
                                if (document.getElementById('datepick').type === "date")
                                    document.getElementById('datepick').type = 'text';
                            });
                        });

                    </script>
                </div>

                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i
                            class="glyphicon glyphicon-thumbs-up"></i> Thankyou For contributing , please proceed.
                </div>
                <br>
                <!-- Button -->
                <div class="group">
                    <label class="col-md-4 control-label"></label>

                    <div id="continueButton">
                        <button name="productSubmit" id="continuebtn" type="submit" aria-label="continue"
                                class="Button__StyleButtonHeaderLogin continueButton">
                            Continue
                        </button>
                    </div>
                </div>
            </div>

            </fieldset>
        </form>
        
        <?php
        
        ?>

    </div>


</div>

<!-- Request Page Code -->
<div id="requestPage" class="main-request-page-section" style="display:none ">
    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">Page<span class="main-color">Request</span></a>

        </div>
    </div>


    <div class="formsubmission-c1">
        <form class="form-c1 container-fluid" action=" " method="post" id="page_request_form">
            <div class="header">
                <h3 class=" h3cls_txt iTnlHn" style="font-size: 2.7em; color: darkgoldenrod;">
                    Welcome <span class="main-color">Please submit your form according</span>
                </h3>
            </div>
            <div class="flex-image-div">
                <img class="trust-c1" src="Business-Salary-Website-Files/Pictures/trust.svg" alt="Trust-image">
            </div>
            <div style="width: fit-content;display: flex; flex-direction: column">
                <h3 color="#3C4852" class=" h3cls_<txt iTnlHn sub-head-c3">Complete all fields to generate a request for
                    <strong>Developer's</strong></h3>
                <br>
                <div class="group">
                    <input name="websiteLink" type="text" required="">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Website-URL-Link</label>
                </div>

                <div class="group">
                    <textarea type="text" id="info_product" name="info_product" required></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Product Information</label>
                </div>

                <div class="group">
                    <input id="product_to_submit" type="text" required="" name="datetoSubmit">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Date To Submit</label>
                    <script>

                        $(document).ready(function () {
                            $("#product_to_submit").click(function (event) {
                                event.stopPropagation();
                                if (document.getElementById('product_to_submit').type === "text")
                                    document.getElementById('product_to_submit').type = 'date';
                            });

                            $("body").click(function (event) {
                                event.stopPropagation();
                                if (document.getElementById('product_to_submit').type === "date")
                                    document.getElementById('product_to_submit').type = 'text';
                            });
                        });

                    </script>
                </div>

                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i
                            class="glyphicon glyphicon-thumbs-up"></i> Thankyou For contributing , please proceed.
                </div>
                <br>
                <!-- Button -->
                <div class="group">
                    <label class="col-md-4 control-label"></label>

                    <div id="productRequestButton">
                        <button name="contiuneproductsub" id="productRequestButton" type="submit" aria-label="Login"
                                class="Button__StyleButtonHeaderLogin continueButton">
                            Continue
                        </button>
                    </div>
                </div>
            </div>

            </fieldset>
        </form>

    </div>

</div>

<!-- Pages List-->
<div id="uploadPage" class="main-product-submission-section" style="display: none ">

    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">Pages <span class="main-color">List</span></a>
        </div>
    </div>
    <?php $emp->getListOfUploadedPages(); ?>

</div>

<!-- About Us code-->
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
                    <italic>Mr</italic>
                    .Zero
                </h2>
                <p>My name Mr.Zero , Dedicated and Performance-driven software engineering Intern with pro-active
                    approach and determination to solve and successfully finish all assigned task. capable of showing
                    firm and positive response while working under pressure. Effective team player offering
                    extraordinary analytical skills and the important ability to think critically. Eager to absorb as
                    much knowledge and insight as possible in pursuance of my goals.</p>
                <a href="http://google.com.pk" class="btn">check my work</a>
            </div>


        </div>

    </div>


</div>


</body>
</html>

