<?php
include '../Classes/Admin.php';
session_start();
$id = null;
$month = null;
if (!empty($_GET['empID']) and  !empty($_GET['month'])) {
    $id = $_REQUEST['empID'];
    $month = $_REQUEST['month'];
}
$admin = new Admin();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../Business-Salary-Website-Files/userDashBoard.css" rel="stylesheet" type="text/css">
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

        .achievementsTable td  > a {
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
            width: 100px;
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

</head>
<body>


<div class="formsubmission-c1">
    <div class="header">
        <h3 class=" h3cls_txt iTnlHn" style="font-size: 2.7em; color: darkgoldenrod;">
            <span class="main-color"><?php echo $admin->getEmployeeName($id)?></span>
        </h3>
    </div>
    <?php
    $admin->showEmployeeMonthlyAchievements($id,$month);
    ?>

</div>

<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "Editor.php?empID=<?php echo $id?>&month=<?php echo $month?>";
    };
</script>
</body>
</html>
