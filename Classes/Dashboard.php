<?php
include 'Admin.php';
session_cache_limiter('private, must-revalidate');
//session_cache_expire(60);
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="../Business-Salary-Website-Files/userDashBoard.css" rel="stylesheet">
</head>
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

    .achievementsTable td > a:hover {
        background: rgba(0, 0, 0, 0) linear-gradient(
                95.84deg
                , rgb(45, 129, 247) 0%, rgb(8, 189, 128) 100%) repeat scroll 0% 0%;
        transition: 0.4s;
        width: 90px;
        display: flex;
    }

</style>
<body>


<div class="formsubmission-c1">
    <form class="form-c1 container-fluid" action=" " method="post" id="contact_form">
        <div class="header">
            <br>
            <br>
            <h3 class=" h3cls_txt iTnlHn" style="font-size: 2.7em; color: darkgoldenrod;">
                      <span class="main-color"> </span>
            </h3>
        </div>

        <div style="    align-content: center; text-align: -webkit-center;">
            <h3 color="#3C4852" class=" h3cls_txt iTnlHn">Select month to see sales.</h3>
            <!-- Selector-->
            <div class="select month-select">
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

                .achievementsTable td > a:hover {
                    background: rgba(0, 0, 0, 0) linear-gradient(
                            95.84deg
                            , rgb(45, 129, 247) 0%, rgb(8, 189, 128) 100%) repeat scroll 0% 0%;
                    transition: 0.4s;
                    width: 90px;
                    display: flex;
                }

            </style>

            <!--            table information-->
            <div class="group">
                <!-- CSS Code: Place this code in the document's head (between the 'head' tags) -->
                <style>
                    table.GeneratedTable {
                        font-family: ;
                        width: 100%;
                        background-color: #ffffff;
                        border-collapse: collapse;
                        border-width: 2px;
                        border-color: #e6d389;
                        border-style: solid;
                        color: #000000;
                    }

                    table.GeneratedTable td, table.GeneratedTable th {
                        border-width: 2px;
                        border-color: #e6d389;
                        border-style: solid;
                        padding: 3px;
                    }

                    table.GeneratedTable thead {
                        background-color: #e4cb67;
                    }
                </style>


                <script type="text/javascript">
                    document.getElementById('monthSelector').value = "<?php echo $_POST['months'];?>";
                </script>


                <div id="summaryDiv" style="display: block; height: auto">
                    <?php
                    if (isset($_POST["submit"])){
                        $admin = new Admin();
                        $_SESSION['month'] = $_POST['months'];
                        $admin->getEmployeesDetails($_POST['months']);
                    }
                    ?>
                </div>

            </div>

            <!-- Success message -->
            <div class="alert alert-success" role="alert" id="success_message">
            </div>
            <br>
            <button name="submit" type="submit" CLASS="kPGgra">Submit</button>
        </div>

        </fieldset>
    </form>

</div>


</body>
</html>
