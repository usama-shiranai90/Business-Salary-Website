<?php
session_start();
include "Admin.php";
$month = $_POST['month'];
$admin = new Admin();
?>


<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$flag = $admin->getEmployeesDetails($month);

?>

<script>
    $(document).ready(function () {
        $('#table tr').click(function () {

            $(this).addClass('selected').siblings().removeClass('selected');
            var value = $(this).find('td:eq(0)').html();
            if (value > 0) {
                $.ajax({
                    url: 'Classes/monthlyAch.php',
                    type: 'POST',
                    data: ({empID: value, month: thisMonth}),
                    success: function (data) {
                        if(!data.includes("<table")){
                            alert("Session expired due to inactivity.")
                            window.location.replace("index.php");
                        }else {
                            $("#summaryDiv").html(data);
                        }
                    }
                });
            }
        });

        $('#back').click(function () {
            $.ajax({
                url: 'Classes/MonthSelector.html',
                type: 'POST',
                success: function (data) {
                    $('#summaryDiv').html(data);
                }
            });
        });

    });
</script>
</body>
</html>

