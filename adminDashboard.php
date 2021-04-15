<?php
include 'Classes/Admin.php';

$access = new access();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$access->inactivityDestroy();
$flag = $access->loggedIn();

if (!$flag) {
    header("Location: index.php");
}
$admin = new Admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AdminPage</title>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="Business-Salary-Website-Files/userDashBoard.css" rel="stylesheet" type="text/css">
    <script src="Business-Salary-Website-Files/scripts/script.js"></script>

    <style>
        .kPGgra{
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            background: rgba(0, 0, 0, 0) linear-gradient(
                    95.84deg
                    , rgb(45, 129, 247) 0%, rgb(8, 189, 128) 100%) repeat scroll 0% 0%;
            display: flex;
            -moz-box-align: center;
            align-items: center;
            border: medium none;
            border-radius: 4px;
        }


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

        .achievementsTable tr:nth-child(even) {
            background: #e8eeef;
        }
        .achievementsTable tr:hover {
            background: rgba(8,8,8,0.28);
            border-bottom: 1px solid #FFF;
            margin-bottom: 5px;
            cursor: pointer;
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

        .achievementsTable td > a {
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

        .achievementsTable td > a:hover {
            background: rgba(0, 0, 0, 0) linear-gradient(
                    95.84deg, rgb(20, 236, 31) 0%, rgb(114, 7, 7) 100%) repeat scroll 0% 0%;
            transition: 0.4s;
            width: 90px;
            display: flex;
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
                            $getMonthlySalarytoPay = (string)$admin->getMonthlySales();

                            $arr = str_split($getMonthlySalarytoPay, "3");
                            echo $monthlySalaryPay = implode(",", $arr);
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
                            $monthlySalaryPay = (string)$admin->getMonthlySalarytoPay();
                            $arr = str_split($monthlySalaryPay, "3");
                            $monthlySalaryPay = implode(",", $arr);
                            echo $monthlySalaryPay ?></h3> <span>Total Salary</span>
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

</div>


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
