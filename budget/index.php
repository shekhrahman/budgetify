<?php
$con=mysqli_connect("localhost","root","","budget");
if(!$con){
    echo "not connected";
}
$s=mysqli_query($con,"select  sum(value) as type from income");
$i=mysqli_fetch_array($s);
$in=$i['type'];
$se=mysqli_query($con,"select  sum(value) as type from expense");
$e=mysqli_fetch_array($se);
$ex=$e['type'];
$b=$in-$ex;
$tp=$ex/$in*100;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <link type="text/css" rel="stylesheet" href="style.css">
        <title>Budgety</title>
    </head>
    <body>
        
        <div class="top">
            <div class="budget">
                <div class="budget__title">
                    Available Budget in <span class="budget__title--month"> <script>document.write(date();)</script> </span>:
                </div>
                <div class="budget__value"><?php if($b > 0){ echo "+ ".$b;}else{ echo $b;}?></div>
                
                <div class="budget__income clearfix">
                    <div class="budget__income--text">Income</div>
                    <div class="right">
                        <div class="budget__income--value"><?php echo "+".$in?></div>
                        <div class="budget__income--percentage">&nbsp;</div>
                    </div>
                </div>
                
                <div class="budget__expenses clearfix">
                    <div class="budget__expenses--text">Expenses</div>
                    <div class="right clearfix">
                        <div class="budget__expenses--value"><?php  echo "-". $ex ?></div>
                        <div class="budget__expenses--percentage"><?php echo round($tp)."%"; ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="bottom">
            <form action="add.php" method="POST">
                <div class="add">
                
                    <div class="add__container">
                        <select name="sign" class="add__type" required>
                            <option value="inc" selected>+</option>
                            <option value="exp">-</option>
                        </select>
                        <input type="text" name="dis" class="add__description" placeholder="Add description" required>
                        <input type="float" name="val" class="add__value" placeholder="Value" required> 
                        <button class="add__btn" type="submit" name="sub"><i class="ion-ios-checkmark-outline"></i></button>
                    </div>
                </div>
            </form>
            <div class="container clearfix">
                <div class="income">
                    <h2 class="icome__title">Income</h2>
                        <?php
                        $select=mysqli_query($con,"select * from income");
                        ?>  
                    <div class="income__list">  
                        <?php while($q=mysqli_fetch_assoc($select)){?> 
                        <div class="item clearfix" id="income-1">
                            <div class="item__description"><?php echo $q['discription']?></div>
                            <div class="right clearfix">
                                <div class="item__value">+ <?php echo $q['value']?></div>
                                <div class="item__delete">
                                    <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button>
                                </div>
                            </div>
                            
                        </div>
                        <?php }?>   
                    </div>
                </div>
                
                
                
                <div class="expenses">
                    <h2 class="expenses__title">Expenses</h2>
                    <?php
                        $select=mysqli_query($con,"select * from expense");
                        ?> 
                    <div class="expenses__list">
                    <?php while($r=mysqli_fetch_assoc($select)){
                        $p=$r['value']/$in*100; ?>
                        
                        
                        <div class="item clearfix" id="expense-0">
                            <div class="item__description"><?php echo $r['discription']?></div>
                            <div class="right clearfix">
                                <div class="item__value">-<?php echo $r['value']?></div>
                                <div class="item__percentage"><?php echo round($p)." %";  ?></div>
                                <div class="item__delete">
                                    <button class="item__delete--btn"><i ></i></button>
                                </div>
                            </div>
                        </div>
                        <?php }?>  
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>
