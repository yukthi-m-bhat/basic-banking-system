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
        <title>Perform Transaction</title>
        <style>
            .btn{ 
                    width: 200px;
                    color: #000;
                    font-size: 12px;
                    padding: 12px 0;
                    background: transparent;
                    border: 1px solid white;
                    border-radius: 20px;
                    outline: none;
                    color: white;
                    cursor: pointer;
                    font-weight: bold;	
		}
	    .btn:hover{
                    background: white;
                    color: #9b59b6;
		}
        </style>
    </head>
    <body>
        <a href="index.php"><button style="color:white;">Home</button></a>
        <div style="color: white;"><center><h1>PERFORM TRANSACTION</h1></center></div>
        <table class="centre">
            <tr>
                <th>Account number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Operation</th>
            </tr>
        <?php 
                include 'dbconnect.php';
                $sql = "SELECT * FROM user";
                $result=mysqli_query($conn,$sql);
                while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td><?php echo $rows['accno']?></td>
                        <td><?php echo $rows['name']?></td>
                        <td><?php echo $rows['email']?></td>
                        <td><?php echo $rows['balance']?></td>
                        <td><a href="transact.php?id= <?php echo $rows['accno'] ;?>"> <button type="button" class="btn">Transact</button></a></td> 
                    </tr>
        <?php 
                    }
                ?> 
    </body>
</html>
