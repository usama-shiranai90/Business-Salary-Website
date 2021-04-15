<?php
include "Admin.php";
session_start();
$admin = new Admin();
$employeeID = $_POST['empID'];
$month = $_POST['month'];
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
$admin->showEmployeeMonthlyAchievements($employeeID, $month);
?>


<script>
    $(document).ready(function () {
        $('#table1 tr').click(function () {

            $(this).addClass('selected').siblings().removeClass('selected');
            var value = $(this).find('td:eq(0)').html();
            if (value > 0) {
                $.ajax({
                    url: 'Classes/newEditor.php',
                    type: 'POST',
                    data: ({aid: value, empID: <?php echo $employeeID?>}),
                    success: function (data) {
                        $('#summaryDiv').html(data);
                    }
                });
            }
        });

        $('#back').click(function () {
            $.ajax({
                url: 'Classes/Summary.php',
                type: 'POST',
                data: ({month: '<?php echo $month?>'}),
                success: function (data) {
                    $('#summaryDiv').html(data);
                }
            });
        });

    });
</script>
</body>
</html>



