<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/table.css">
        <title>View History</title>
    </head>
    <body>
        <?php
        include 'dbconnect.php';
        $sql = "SELECT * FROM transaction";
        $result = mysqli_query($conn,$sql);
        ?>
        <a href="index.php"><button style="color: white;">Home</button></a>
           <div>
            <center style="color:white;"><h1>TRANSACTION HISTORY</h1><center>
        </div>
        <table class="centre">
            <tr>
                <th>Account number</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
                <th>Date & Time</th>
            </tr>
        <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td><?php echo $rows['sno']?></td>
                        <td><?php echo $rows['sender']?></td>
                        <td><?php echo $rows['reciever']?></td>
                        <td><?php echo $rows['amount']?></td>
                        <td><?php echo $rows['datetime']?></td>
                    </tr>
        <?php 
                    }
                ?>   
        </table>
    </body>
</html>
