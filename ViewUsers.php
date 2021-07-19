<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/table.css">
        <title>View Users</title>
    </head>
    <body>
        <?php
        include 'dbconnect.php';
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn,$sql);
        ?>
        <a href="index.php"><button style="color: white;">Home</button></a>
        <div>
            <center style="color:white;"><h1>USERS LIST</h1><center>
        </div>
        <table class="centre">
            <tr>
                <th>Account number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
            </tr>
        <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td><?php echo $rows['accno']?></td>
                        <td><?php echo $rows['name']?></td>
                        <td><?php echo $rows['email']?></td>
                        <td><?php echo $rows['balance']?></td>
                    </tr>
        <?php 
                    }
                ?>   
        </table>
    </body>
</html>
