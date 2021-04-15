<?php
include 'Admin.php';
session_start();
$admin = new Admin();
$employeeID = $_POST['empID'];
$achievementID = $_POST['aid'];
$_SESSION['achievementID'] = $achievementID;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Income-Coltax User-Dashboard</title>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="../Business-Salary-Website-Files/userDashBoard.css" rel="stylesheet" type="text/css">
<!--    <script src="js/script.js"></script>-->
    <style>

        .header-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-basis: 100%;
            margin-left: 60px;
            background-color: rgb(245 240 240);
            /*box-shadow: rgb(136 160 141/44%) 0px 16px 32px 0px;*/
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

<div id="productSub" class="main-product-submission-section" style="display: block">
    <div class="header-content">
        <div class="header">
            <a class="navbar-brand" href="#">Employee Achievement<span class="main-color">Editor</span></a>
        </div>
    </div>

<!--    <div class="formsubmission-c1">-->
        <form class="form-c1 container-fluid" action=" " method="post" id="contact_form">

            <div class="header">
                <h3 class=" h3cls_txt iTnlHn" style="font-size: 2.7em; color: darkgoldenrod;">
                    <span class="main-color"><?php echo $admin->getEmployeeName($employeeID)?></span>
                </h3>
            </div>
            <div class="flex-image-div" >
                <img src="https://static.uacdn.net/production/_next/static/images/goal/girl.svg">
            </div>

            <div style="width: fit-content;display: flex; flex-direction: column">
                <h3 color="#3C4852" class=" h3cls_txt iTnlHn">Please Fill all the fields to continue.</h3>
                <!-- Selector-->
                <div class="select">
                    <select name="products" id="products">
                        <option selected> <?php echo $admin->getProductName($achievementID)?></option>
                        <?php $admin->getProductsListExcept($admin->getProductName($achievementID));?>
                    </select>
                </div>

                <div class="group">
                    <input id="productPrice" name="productPrice" type="text" required="" value="<?php echo $admin->getProductPrice($achievementID)?>">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Product Price</label>
                </div>

                <div class="select">
                    <select name="paymentype" id="paymentType">
                        <option selected><?php echo $admin->getProductPaymentType($achievementID)?></option>
                        <?php $admin->getPaymentTypesListExcept($admin->getProductPaymentType($achievementID));?>
                    </select>
                </div>


                <div class="group">
                    <input id="investment" name="investment" type="text" required="" value="<?php echo $admin->getProductInvestment($achievementID)?>">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Product Investment</label>
                </div>

                <div class="group">
                    <input id="datepick" type="text" required="" name="date" value="<?php echo $admin->getProductSubmitionDate($achievementID)?>">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Date Of Submission</label>
                    <script>
                        $(document).ready(function(){
                            $("#datepick").click(function(event){
                                event.stopPropagation();
                                if(document.getElementById('datepick').type == "text")
                                    document.getElementById('datepick').type = 'date';
                            });

                            $("body").click(function(event){
                                event.stopPropagation();
                                if(document.getElementById('datepick').type == "date")
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
                        <button name="submit" id="loginButton" type="submit" aria-label="Login"
                                class="Button__StyleButtonHeaderLogin continueButton">
                            Continue
                        </button>
                    </div>
                </div>
            </div>

            </fieldset>
        </form>

<!--    </div>-->


</div>
<script>

    $(document).ready(function () {
        $("form").submit(function (event) {
            var formData = {
                productName: $("#products").val(),
                price: $("#productPrice").val(),
                paymentName: $("#paymentType").val(),
                investment: $("#investment").val(),
                submitionDate: $("#datepick").val(),
            };

            $.ajax({
                url: "Classes/EDIT.php",
                type: "POST",
                data: (formData),
                success: function () {
                    $.ajax({
                        url: 'Classes/monthlyAch.php',
                        type: 'POST',
                        data: ({empID: <?php echo $employeeID?>, month: thisMonth}),
                        success: function (data) {
                            $('#summaryDiv').html(data);
                        }
                    })
                }
            })
            event.preventDefault(); //prevents default function of submit which is refreshing the page
        });
    });

</script>

</body>
</html>
