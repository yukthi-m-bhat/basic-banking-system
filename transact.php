<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            *{
                color: white;
            }
        </style>
        <title>Transaction</title>
    </head>
    <body>
<?php
include 'dbconnect.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from user where accno=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from user where accno=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE user set balance=$newbalance where accno=$from";
                mysqli_query($conn,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE user set balance=$newbalance where accno=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sno`,`sender`, `reciever`, `amount`) VALUES ($from,'$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='ViewHistory.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" type="text/css" href="css/table.css">

    <style type="text/css">
    	
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

	<div>
            <a href="index.php"><button>Home</button></a>
            <center><h1 style="color:white;">TRANSACT</h1></center>
            <?php
                include 'dbconnect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  user where accno=$sid;";
                $res=mysqli_query($conn,$sql);
                if(!$res)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($res);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <center>
        <div>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>
                <tr>
                    <td><?php echo $rows['accno'] ?></td>
                    <td><?php echo $rows['name'] ?></td>
                    <td><?php echo $rows['email'] ?></td>
                    <td><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        </center>
        <br>
        <center>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
        <?php
        $s="SELECT * FROM USER WHERE accno!=$sid";
        $result=mysqli_query($conn,$s);
        if(!$result)
                {
                    echo "Error ".$s."<br>".mysqli_error($conn);
                }
        while($rows = mysqli_fetch_assoc($result)) {
        ?>
            <option class="tab" value="<?php echo $rows['accno'];?>" >
                <?php echo $rows['name'] ;?> (Balance: 
                <?php echo $rows['balance'] ;?> ) 
            </option>
            <?php 
                } 
            ?>
        </select>
        <div>
        <br>
        <br>
        <label>Amount:</label>
        <input type="number" class="form-control" name="amount" style="border-color:white;" required>   
            <br><br>
                <div class="text-center" >
                    <button class="btn mt-3" name="submit" type="submit" id="myBtn" class="btn">Transfer</button>
                </div>
        </form>
    </div>
    </center>
    </body>
</html>