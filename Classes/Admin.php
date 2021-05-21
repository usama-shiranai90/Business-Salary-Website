<?php
include "Database Connection.php";
include "access.php";


class Admin
{
    private $connection = null;
    private $access = null;

    public function __construct()
    {
        $this->connection = Database::getConnection();
        $this->access =  new access();
    }

    public function verifyAdmin($username, $password)
    {
        //  $sql =  "SELECT * FROM admin where username = '$username' and password = '$password'";
      
      $sql = /** @lang text */
            "SELECT * FROM admin where username = '$username' and password = '$password'";
        $result = $this->connection->query($sql);

        if(mysqli_num_rows($result) == 1)
        {
           foreach ($result as $row) {
                return true;
            }
        }
            return false;


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

    public function getEmployeesDetails($month): bool
    {
        if ($this->access->inactivityDestroyDiff()) {
            return false;
        } else {
            $backButton = "<button id='back' class='kPGgra' value='Back'>Back</button>";

            $sql = "select e.employeeID,e.Name, COUNT(*), SUM(investment), SUM(ea.price), SUM(ea.salary) from employeeachievements ea join employee e on e.employeeID = ea.employeeID where monthname(submitionDate) = '$month' group by ea.employeeID";



            $result = $this->connection->query($sql);

            if (mysqli_num_rows($result) > 0) {
                $output = "<table id='table' class='achievementsTable'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Total Achievements</th>
                <th>Total Price</th>
                <th>Total Investment</th>
                <th>Total Salary</th>
            </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $output .= '<tr>';
                    $output .= '<td>' . $row["employeeID"] . '</td>';
                    $output .= '<td>' . $row["Name"] . '</td>';
                    $output .= '<td>' . $row['COUNT(*)'] . '</td>';
                    $output .= '<td>' . $row['SUM(ea.price)'] . '</td>';
                    $output .= '<td>' . $row['SUM(investment)'] . '</td>';
                    $output .= '<td>' . $row['SUM(ea.salary)'] . '</td>';
                    $output .= '</tr>';
                }
                $output .= "</table>";
                echo $backButton;
                echo $output;
            }
            else{
                $output = "<div style='text-align: center; align-content: center'>
                            <br>
                            <br>
                            <br>
                            No Records Found
                            <br>
                            <br>
                            <br>
                         </div>";
                echo $backButton;
                echo $output;
            }
            return true;
        }
    }

    public function showEmployeeMonthlyAchievements($employeeID, $month)
    {
        if ($this->access->inactivityDestroyDiff()) {
            return false;
        } else {
            $sql = /** @lang text */
                "select e.achievementID, p.productName, e.price, p2.paymentName, e.investment, e.salary, e.submitionDate from products p 
            join employeeachievements e on p.productID = e.productID join paymenttypes p2 on
            p2.typeID = e.paymentTypeID where employeeID = '$employeeID' and monthname(submitionDate) = '$month'
            order by submitionDate ASC";

            $result = $this->connection->query($sql);
            $nameHeader = '<div class="header">
                        <h3 class=" h3cls_txt iTnlHn" style="color: darkgoldenrod; text-align: center">
                            <span style="font-size: 2.2em;" class="main-color">' . $this->getEmployeeName($employeeID) . '</span>
                        </h3>
                  </div>';
            $backButton = "<button id='back' class='kPGgra'  value='Back'>Back</button>";
            $output = "<table id='table1' class = 'achievementsTable'>
            <tr>
                <th>Achievement ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Payment Type</th>              
                <th>Investment</th>
                <th>Salary</th>
                <th>Submission Date</th>
            </tr>";

            foreach ($result as $row) {
                $output .= '<tr>';
                $output .= '<td>' . $row["achievementID"] . '</td>';
                $output .= '<td>' . $row["productName"] . '</td>';
                $output .= '<td>' . $row["price"] . '</td>';
                $output .= '<td>' . $row["paymentName"] . '</td>';
                $output .= '<td>' . $row['investment'] . '</td>';
                $output .= '<td>' . $row['salary'] . '</td>';
                $output .= '<td>' . $row['submitionDate'] . '</td>';
                $output .= '</tr>';
            }
            $output .= "</table>";

            echo $backButton;
            echo $nameHeader;
            echo $output;
            return false;
        }
    }

    public function editEmployeeMonthlyAchievements($productName, $price, $paymentName, $investment, $submitionDate, $achievementID)
    {
        if ($this->access->inactivityDestroyDiff()) {
            return false;
        }
        $_SESSION["login_time_stamp"] = time();
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
    

    
    public function uploadFile(){
        $target_path = "D:/TestingPath/";
        $fileName = null;
        $result = "";
//    If the destination file already exists, it will be overwritten.
//    using tmp_name because file is stored in temporary location at first with a temporary name
        if($_FILES['fileToUpload']['name'] != null){
            $target_path_file = $target_path.basename( $_FILES['fileToUpload']['name']);
            $path_parts = pathinfo($target_path_file);
            $fileName = $path_parts['filename'];
            $link = $_POST['previewLink'];
            
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path_file)) {
                echo "===========================================";
                $findingQuery= "select zipfilename from pagezips where zipfilename = '$fileName';";
                
                $res = $this->connection->query($findingQuery);
                foreach ($res as $row) {
                    $deleteQuery = "delete from pagezips where zipfilename = '$fileName';";
                    $this->connection->query($deleteQuery);
                }
                
                $sql = "insert into pagezips (zipfilename, previewLink) values ('$fileName','$link');";
                
                if ($this->connection->query($sql) === TRUE) {
                    $result.="File uploaded successfully!\n";
                }
                else {
                    $result.= "There was an error, in updating the database";
                    $result.= $this->connection->error;
                }
            }
            else {
                $result.="Sorry, file not uploaded, please try again!\n";
            }
        }

        
        return $result;
    }
    
    
}

?>
