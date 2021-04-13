<?php
include "Database Connection.php";

class Admin
{

    private $connection = null;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function verifyAdmin($username, $password): bool
    {
        $sql = /** @lang text */
            "SELECT * FROM admin where username = \"$username\" and password = \"$password\"";
        $result = $this->connection->query($sql);

        if (mysqli_num_rows($result) == 1)
            return true;
        else
            return false;

    }

    public function logout()
    {
        header("Location: index.php");
    }

    public function getProductsList()
    {
        $sql = "SELECT productName FROM products";
        $result = $this->connection->query($sql);
        foreach ($this->connection->query($sql) as $row) {
            $name = $row["productName"];
            echo "<option value = \"$name\">$name</option>";
        }
    }

    public function getPaymentTypesList()
    {
        $sql = "SELECT * FROM paymenttypes";
        $result = $this->connection->query($sql);
        foreach ($this->connection->query($sql) as $row) {
            $name = $row["paymentName"];
            echo "<option value = \"$name\">$name</option>";
        }
    }

    public function getEmployeesDetails($month)
    {
        $sql = "select e.employeeID,e.Name, COUNT(*), SUM(investment), SUM(ea.price), SUM(ea.salary) from employeeachievements ea join employee e on e.employeeID = ea.employeeID where monthname(submitionDate) = '$month' group by ea.employeeID";

        $result = $this->connection->query($sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table class='achievementsTable'>
            <tr>
                <th>Name</th>
                <th>Total Achievements</th>
                <th>Total Price</th>
                <th>Total Investment</th>
                <th>Total Salary</th>
                <th>Actions</th>
            </tr>";

            foreach ($result as $row) {
                echo '<tr>';
                echo '<td>' . $row["Name"] . '</td>';
                echo '<td>' . $row['COUNT(*)'] . '</td>';
                echo '<td>' . $row['SUM(ea.price)'] . '</td>';
                echo '<td>' . $row['SUM(investment)'] . '</td>';
                echo '<td>' . $row['SUM(ea.salary)'] . '</td>';

                echo '<td>

<a href="../Classes/AchievementDetails.php?empID='.$row["employeeID"].'&month='.$_POST['months'].'">Expand</a>

</td>';
                echo '</tr>';
            }
            echo "</table>";
        }

    }

    public function showEmployeeMonthlyAchievements($employeeID, $month)
    {
        $sql = /** @lang text */
            "select e.achievementID, p.productName, e.price, p2.paymentName, e.investment, e.salary, e.submitionDate from products p 
            join employeeachievements e on p.productID = e.productID join paymenttypes p2 on
            p2.typeID = e.paymentTypeID where employeeID = '$employeeID' and monthname(submitionDate) = '$month'
            order by submitionDate ASC";

        $result = $this->connection->query($sql);
        echo "<table class = 'achievementsTable'>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Payment Type</th>              
                <th>Investment</th>
                <th>Salary</th>
                <th>Submission Date</th>
                <th>Action</th>
            </tr>";

        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $row["productName"] . '</td>';
            echo '<td>' . $row["price"] . '</td>';
            echo '<td>' . $row["paymentName"] . '</td>';
            echo '<td>' . $row['investment'] . '</td>';
            echo '<td>' . $row['salary'] . '</td>';
            echo '<td>' . $row['submitionDate'] . '</td>';
            echo '<td><a href="Editor.php?empID=' . $employeeID . '&month=' . $month . '&aid=' . $row['achievementID'] . '">Edit</a></td>';
            echo '</tr>';
        }
        echo "</table>";
    }

    public function editEmployeeMonthlyAchievements($productName, $price, $paymentName, $investment, $submitionDate, $achievementID)
    {

        $sql1 = /** @lang text */
            "select productID from products where productName = '$productName'";

        $result = $this->connection->query($sql1);
        $productID = null;
        foreach ($result as $row) {
            $productID = $row['productID'];
        }

        $sql2 = /** @lang text */
            "select typeID from paymenttypes where paymentName = '$paymentName'";

        $result2 = $this->connection->query($sql2);
        $paymentTypeID = null;
        foreach ($result2 as $row) {
            $paymentTypeID = $row['typeID'];
        }

        if ($price > $investment)
            $salary = ($price - $investment) / 2;
        else
            $salary = 0;

        $sql = "update employeeachievements set productID = '$productID', price = '$price', paymentTypeID = '$paymentTypeID',
                investment = '$investment',salary = '$salary', submitionDate = '$submitionDate' where achievementID = '$achievementID'";

        if ($this->connection->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->connection->error;
        }
    }

    public function getProductName($aid)
    {
        $sql = /** @lang text */
            "select productName from products join employeeachievements e on products.productID = e.productID where achievementID = '$aid'";
        $result = $this->connection->query($sql);
        $productName = 0;
        foreach ($result as $row) {
            $productName = $row["productName"];
        }
        return $productName;
    }

    public function getProductsListExcept($except)
    {
        $sql = "SELECT productName FROM products where productName != '$except'";
        $result = $this->connection->query($sql);
        foreach ($this->connection->query($sql) as $row) {
            $name = $row["productName"];
            echo "<option value = \"$name\">$name</option>";
        }
    }

    public function getPaymentTypesListExcept($except)
    {
        echo $except;
        $sql = "SELECT * FROM paymenttypes where paymentName != '$except'";
        $result = $this->connection->query($sql);
        foreach ($this->connection->query($sql) as $row) {
            $name = $row["paymentName"];
            echo "<option value = \"$name\">$name</option>";
        }
    }

    public function getProductPrice($aid)
    {
        $sql = /** @lang text */
            "select price from employeeachievements where achievementID = '$aid'";
        $result = $this->connection->query($sql);
        $productPrice = 0;
        foreach ($result as $row) {
            $productPrice = $row["price"];
        }
        return $productPrice;
    }

    public function getProductPaymentType($aid)
    {
        $sql = /** @lang text */
            "select paymentName from paymenttypes join employeeachievements e on paymenttypes.typeID = e.paymentTypeID where achievementID = '$aid'";
        $result = $this->connection->query($sql);
        $productPaymentType = 0;
        foreach ($result as $row) {
            $productPaymentType = $row["paymentName"];
        }
        return $productPaymentType;
    }

    public function getProductInvestment($aid)
    {
        $sql = /** @lang text */
            "select investment from employeeachievements where achievementID = '$aid'";
        $result = $this->connection->query($sql);
        $investment = 0;
        foreach ($result as $row) {
            $investment = $row["investment"];
        }
        return $investment;
    }

    public function getProductSubmitionDate($aid)
    {
        $sql = /** @lang text */
            "select submitionDate from employeeachievements where achievementID = '$aid'";
        $result = $this->connection->query($sql);
        $submitionDate = 0;
        foreach ($result as $row) {
            $submitionDate = $row["submitionDate"];
        }
        return $submitionDate;
    }

    public function getEmployeeName($employeeID)
    {
        $sql = /** @lang text */
            "select Name from employee where employeeID = '$employeeID'";
        $result = $this->connection->query($sql);
        $name = null;
        foreach ($result as $row) {
            $name = $row['Name'];
        }
        return $name;
    }


    public function getMonthlyProductsSold()
    {
        $sql = "select COUNT(achievementID) from employeeachievements where month(submitionDate) = month(now())";
        $result = $this->connection->query($sql);
        $productsSold = 0;
        foreach ($result as $row) {
            $productsSold = $row["COUNT(achievementID)"];
        }
        return $productsSold;
    }

    public function getMonthlySales()
    {
        $sql = "select SUM(price) from employeeachievements where month(submitionDate) = month(now())";
        $result = $this->connection->query($sql);
        $productsSales = 0;
        foreach ($result as $row) {
            $productsSales = $row["SUM(price)"];
        }
        return $productsSales;
    }

    public function getMonthlySalarytoPay()
    {
        $sql = "select SUM(salary) from employeeachievements where month(submitionDate) = month(now())";
        $result = $this->connection->query($sql);
        $salaryToPay = 0;
        foreach ($result as $row) {
            $salaryToPay = $row["SUM(salary)"];
        }
        return $salaryToPay;
    }

}

?>
