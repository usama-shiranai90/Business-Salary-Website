<?php
include "Classes/Admin.php";
include "Classes/access.php";
require "Classes/Employee.php";
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$manipulate = new Admin();
$emp = new Employee();
$_SESSION["employeeID"] = 0;
$errorNotifcation = '';
$displayType = 'none';
$notify = 'notify -hidden';

if (isset($_POST["signin"])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $employeeAuthenticated = $emp->verifyEmployee($_POST["username"], $_POST["password"]);
        if ($employeeAuthenticated) {
            $_SESSION["loggedIn"] = true;
            header("Location: userDashboard.php");

        } else {
            $adminAuthenticated = $manipulate->verifyAdmin($_POST["username"], $_POST["password"]);
            if ($adminAuthenticated)
            {
                $_SESSION["loggedIn"] = true;
                header("Location: adminDashboard.php");
            }
            else{
                $_SESSION["loggedIn"] = false;
                $errorNotifcation = "Invalid Credentials";
            }

            $notify = 'notify body';
            $displayType = 'float';
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>

    <script>
        window.history.forward();
    </script>
    <meta charset="utf-8">
    <title>Login-Business</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="Business-Salary-Website-Files/stylesheet.css" rel="stylesheet" type="text/css">
    <script src="Business-Salary-Website-Files/scripts/script.js"></script>

    <style>
        .notify {
            background: #323232;
            border-radius: 3px;
            -webkit-box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);
            -moz-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);
            color: #fff;
            display: inline-block;
            /* font-size: 14px; */
            padding: 0.8rem 1.4rem;
            position: absolute;
            top: 0;
            right: 20px;
            transition: all 0.5s ease-in-out;
            transform-origin: left top;
            transform: scaleY(1);
            z-index: 3;
            margin: 32px 44% 0px 44%;
        }

        .notify.-hidden {
            opacity: 0;
            transform: scaleY(0);
        }
    </style>

</head>

<body id="body">

<div style="display: <?php echo $displayType?>" class=<?php echo $notify ?>>
    <?php echo $errorNotifcation ?> <br/>
</div>

<!--	Logo and login and sigin Button -->
<header class="HeaderContainer  hcp2 hcp3">
    <div class="HeaderParent Header__HeaderParent-1 hp_p1 hdkZkG"><a class="Link__Styled logoc1" href="/"><img
                    src="Business-Salary-Website-Files/Pictures/free-logo-abxeqbrivu-cbkkqp7p05.jpg" style=" height: 175%; width: 20%;" alt="Company Logo" class="Logo__c lgimg"></a>
        <button type="button" aria-label="Login" class="Button__StyleButtonHeaderSignIn headerloginc2">Sign-in</button>
        <button id="loginButton" type="button" aria-label="Login" class="Button__StyleButtonHeaderLogin headerloginc2">
            Login
        </button>
    </div>
</header>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#00cba9" fill-opacity="0.8"
          d="M0,0L26.7,42.7C53.3,85,107,171,160,202.7C213.3,235,267,213,320,176C373.3,139,427,85,480,80C533.3,75,587,117,640,117.3C693.3,117,747,75,800,58.7C853.3,43,907,53,960,74.7C1013.3,96,1067,128,1120,122.7C1173.3,117,1227,75,1280,74.7C1333.3,75,1387,117,1413,138.7L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path>
</svg>
<section class="PgHeader_p1 sec1d">
    <button class="PageHead__ActiveButton kPGgra">
        <a href="" target="_blank" rel="noopener noreferrer">
            <p color="#3C4852" class="P2-sc-phactivtbt-0  SLpEn btparaexpview">Expert Views</p>
        </a>
        <svg width="16px" height="16px" viewBox="0 0 80 80" class="">
            <path d="M27.967 59.8c0-0.003 0-0.008 0-0.012 0-0.687 0.28-1.308 0.733-1.755l18.234-18.234-18.233-18.233c-0.416-0.445-0.671-1.045-0.671-1.704 0-1.381 1.119-2.5 2.5-2.5 0.659 0 1.259 0.255 1.706 0.672l-0.001-0.001 20 20c0.452 0.452 0.731 1.077 0.731 1.767s-0.279 1.314-0.731 1.767v0l-20 20c-0.452 0.452-1.077 0.731-1.767 0.731s-1.314-0.279-1.767-0.731v0c-0.453-0.447-0.733-1.068-0.733-1.755 0-0.004 0-0.008 0-0.012v0.001z"
                  fill="#fff" fill-rule="unset" clip-rule="unset" stroke-linecap="butt" stroke-linejoin="miter"></path>
        </svg>
    </button>
    <div class="sec1d_h1cls">
        <h1 color="#3C4852" class="h1welcome kbOZqw">Welcome to Income <br class="kCOPOM">
            Caltax</h1>
    </div>
    <div class="iNbssp">
        <h3 color="#3C4852" class=" h3cls_txt iTnlHn">An Online Tool , develop to provide users with ease to Manange
            their Monthly Salaries and Calculate their sales</h3>
    </div>
</section>
<section class="PgHeader_p2sec sec2d">

    <div class="TriangleUp tri-div" style=" left: 886px;"></div>

    <div class="SecondSection__Container-sc-1q57cd9-1 secondsec_con_c2">
        <h2 color="#3C4852" class="H2-s1k28w-0 h2-c2">What you’ll get</h2>
        <div class="SecondSection__CardsContainer-sc-1q57cd9-3 ss_cc_c2">
            <div class="SecondSection__CardWrapper-sc-1q57cd9-4 bJuGiy">
                <div class="SecondSection__CardContentLeft-sc-1q57cd9-5 iNVtBm"><img
                            src="https://static.uacdn.net/production/_next/static/images/goal/benefitchat.svg"
                            alt="Daily Live classes" class="SecondSection__Image-sc-1q57cd9-8 cpWmee"></div>
                <div class="SecondSection__CardContentRight-sc-1q57cd9-6 dcvXfS">
                    <h3 color="#3C4852" class="H3-sc-1rp46r8-0 SecondSection__CardTitle-sc-1q57cd9-10 h3cls_txt nvXhI">
                        Request Page</h3>
                    <h5 color="#3C4852" class="H5-ozdkiq-0 SecondSection__Description-sc-1q57cd9-7 cjMLBh breDDg"> You
                        can request for a page by engaging in discussions , asking your queries and letting our
                        developer know what you want to build. </h5>
                </div>
            </div>
            <div class="SecondSection__CardWrapper-sc-1q57cd9-4 bJuGiy">
                <div class="SecondSection__CardContentLeft-sc-1q57cd9-5 iNVtBm"><img
                            src="https://static.uacdn.net/production/_next/static/images/goal/benefittest.svg"
                            alt="Live tests &amp; quizzes" class="SecondSection__Image-sc-1q57cd9-8 cpWmee"></div>
                <div class="SecondSection__CardContentRight-sc-1q57cd9-6 dcvXfS">
                    <h3 color="#3C4852" class="H3-sc-1rp46r8-0 SecondSection__CardTitle-sc-1q57cd9-10 h3cls_txt nvXhI">
                        Billing Page &amp; quizzes</h3>
                    <h5 color="#3C4852" class="H5-ozdkiq-0 SecondSection__Description-sc-1q57cd9-7 cjMLBh breDDg">
                        Evaluate your preparation with our regular mock pages and get detailed analysis on you sales and
                        information.</h5>
                </div>
            </div>
            <div class="SecondSection__CardWrapper-sc-1q57cd9-4 bJuGiy">
                <div class="SecondSection__CardContentLeft-sc-1q57cd9-5 iNVtBm"><img
                            src="https://static.uacdn.net/production/_next/static/images/goal/benefitaccess.svg"
                            alt="Unlimited access" class="SecondSection__Image-sc-1q57cd9-8 cpWmee"></div>
                <div class="SecondSection__CardContentRight-sc-1q57cd9-6 dcvXfS">
                    <h3 color="#3C4852" class="H3-sc-1rp46r8-0 SecondSection__CardTitle-sc-1q57cd9-10 h3cls_txt nvXhI">
                        Unlimited access</h3>
                    <h5 color="#3C4852" class="H5-ozdkiq-0 SecondSection__Description-sc-1q57cd9-7 cjMLBh breDDg">One
                        subscription gets you access to all our features and directly contact our support team for
                        queries and rerquest.</h5>
                </div>
            </div>
        </div>
        <hr class="MuiDivider-root Divider-sc-1gqd89q-0 SecondSection__UNDivider-sc-1q57cd9-15 eMovTx fhObpz">
    </div>
</section>

<div class="multi-Contact Banner__Container-sc01 multi-contact-c2 multi-contact-c3">
    <h3 color="#3C4852" class="H3-sc-1rp46r8-0 h3cls_txt">Have questions about the Coltax Income?</h3>
    <p color="#3C4852" class="P1-llcrra-0  p-mcbanner-c3 p-mcbanner-c4">Our expert can answer your questions</p>
    <img src="https://static.uacdn.net/production/_next/static/images/ttu_illustration.svg"
         class="Banner__Illustration-sc-1xmy0ec-2 contact-lady-img">
    <button type="button" aria-label="Talk to our expert" class="Button__StyledButton-dg3jck-0 cXSOGp">Talk to our
        expert
    </button>
</div>
<section>
    <div id="myloginNav" class="loginside">
        <form class="frm-c1" method="post">
            <h2 color="#3C4852" class="H2-s1k28w-0 h2-c2">Login</h2>

            <h5 color="#3C4852" class="H5-ozdkiq-0 h5-c2"> Continue your journey by inserting credentials </h5>
            <div class="group">
                <input name="username" type="text" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>UserID</label>
            </div>


            <div class="group">
                <input name="password" type="password" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Password</label>
            </div>
            <a class="forgotpass" href="#">Forgot your password?</a>

            <button name="signin" type="submit" aria-label="Login"
                    class="Button__StyleButtonHeaderSignIn headerloginc2 subt-loginc3">
                Login
            </button>
        </form>


    </div>
</section>


<footer class="Footer__FooterContainer-r2jc87-2 mGxkK">

</footer>

</body>

</html>
