<?php

include_once "Database Connection.php";

class Employee{

    private $connection = null;
    private $employeeID = null;

    public function __construct(){
        $this->connection = Database::getConnection();
    }

    public function getEmployeeID(){
        return $this->employeeID;
    }

    public function verifyEmployee($username, $password): bool{
        $sql = /** @lang text */
            "SELECT * FROM employee where username = \"$username\" and password = \"$password\"";
        $result = $this->connection -> query($sql);

        if(mysqli_num_rows($result) == 1) {
            foreach ($result as $row) {
//                session variable is used to store empID in database in the submitDetails function
                $this->employeeID = $row['employeeID'];
                $_SESSION["employeeID"] = $this->employeeID;
                return true;
            }
        }
        else
            return false;
    }

    public function logout(){
        header("Location: index.php");
    }

    public function getProductsList(){
        $sql = "SELECT productName FROM products";
        $result = $this->connection -> query($sql);
        foreach ($this->connection -> query($sql) as $row) {
            $name = $row["productName"];
            echo "<option value = \"$name\">$name</option>";
        }
    }

    public function getPaymentTypesList(){
        $sql = "SELECT * FROM paymenttypes";
        $result = $this->connection -> query($sql);
        foreach ($this->connection -> query($sql) as $row) {
            $name = $row["paymentName"];
            echo "<option value = \"$name\">$name</option>";
        }
    }

    public function submitDetails($selectedProduct, $productPrice, $paymentType, $productInvestment, $submitionDate){
        $sql1 =/** @lang text */
            "SELECT productID FROM products where productName = \"$selectedProduct\"";
        $result1 = $this->connection -> query($sql1);
        $productID = 0;
        foreach ($result1 as $row) {
            $productID = $row["productID"];
        }
        $employeeID = $_SESSION["employeeID"];

        $sql2 =/** @lang text */
            "SELECT typeID FROM paymenttypes where paymentName = \"$paymentType\"";
        $result2 = $this->connection -> query($sql2);
        $paymentTypeID = 0;
        foreach ($result2 as $row) {
            $paymentTypeID = $row["typeID"];
        }

        if($productPrice > $productInvestment)
            $salary = ($productPrice - $productInvestment)/2;
        else
            $salary = 0;

        $sql3 = "insert into employeeachievements (employeeID, productID, price, investment,salary, paymentTypeID, submitionDate)
                    values ('$employeeID', '$productID', '$productPrice', '$productInvestment', '$salary', '$paymentTypeID', '$submitionDate')";

        if ($this->connection->query($sql3) === TRUE) {
            echo "New record created successfully";
        }
        else {
            echo "Error: " . $sql3 . "<br>" . $this->connection->error;
        }
    }

    public function getTotalInvestments(): int{
        $employeeID = $_SESSION["employeeID"];
        $sql = "Select investment from employeeachievements where employeeID = '$employeeID'";
        $result = $this->connection->query($sql);
        $totalInvestments = 0;

        foreach ($result as $row) {
            $totalInvestments += $row['investment'];
        }
        return $totalInvestments;
    }

    public function getTotalAchievements(){
        $employeeID = $_SESSION["employeeID"];
        $sql = "Select investment from employeeachievements where employeeID = '$employeeID'";
        $result = $this->connection->query($sql);
        $totalInvestments = 0;

        foreach ($result as $row) {
            $totalInvestments += $row['investment'];
        }
    }

}



?>