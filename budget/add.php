<?php
$con=mysqli_connect("localhost","root","","budget");
if(!$con){
    echo "not connected";
}
if(isset($_POST['sub'])){
    $sign=$_POST['sign'];
    if($sign=='inc'){
        $dis=$_POST['dis'];
        $val=$_POST['val'];
        $i=mysqli_query($con,"insert into income(discription , value) values('$dis','$val')");
        if($i){
            echo "<script>window.open('index.php','_self');</script>";
        }
    }else{
        $dis=$_POST['dis'];
        $val=$_POST['val'];
        $i=mysqli_query($con,"insert into expense(discription , value) values('$dis','$val')");
        if($i){
            echo "<script>window.open('index.php','_self');</script>";
        }

    }
}
?>