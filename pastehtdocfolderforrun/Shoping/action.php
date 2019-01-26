<?php
error_reporting(0);
include 'db.php';
if(isset($_POST['category'])){
$cateory_query="select * from categories";
$run_query=mysqli_query($con, $cateory_query);
echo ' <div class="nav nav-pills nav-stacked">
<li><a href="#"><h2 style="background-color: pink; text-align:center;">Category</h2></a></li>';
if(mysqli_num_rows($run_query)>0){
while($row=mysqli_fetch_array($run_query)){
$cid=$row['cat_id'];
$cat_name=$row['cat_title'];
echo "<li><a href='#' cid='$cid' class='category'>$cat_name</a></li>";

}
echo '</div>';   
}

}
if(isset($_POST['brand'])){
$brand_query="select * from brands";
$run_query=mysqli_query($con, $brand_query);
echo ' <div class="nav nav-pills nav-stacked">
<li><a href="#"><h2 style="background-color: red; text-align:center;">Brands</h2></a></li>';
if(mysqli_num_rows($run_query)>0){
while($row=mysqli_fetch_array($run_query)){
$brand_id=$row['brand_id'];
$brand_name=$row['brand_title'];
echo "<li><a href='#' bid='$brand_id' class='selectBrand'>$brand_name</a></li>";

}
echo '</div>';   
}

}
if(isset($_POST['getproduct'])){
$product_query="select * from products order by RAND() LIMIT 0, 9";
$run_query=mysqli_query($con,  $product_query);

if(mysqli_num_rows($run_query)>0){
while($row=mysqli_fetch_array($run_query)){
$pro_id=$row['product_id'];
$pro_cat=$row['product_cat'];
$pro_brand=$row['product_brand'];
$pro_title=$row['product_title'];
$pro_price=$row['product_price'];
$pro_image=$row['product_image'];
echo "<div class='col-md-4'>
<div class='panel panel-danger'>
<div class='panel-heading'>$pro_title</div>
<div class='panel-body'>
<img src='product_images/$pro_image' height='230px' width='180px'>
</div>
<div class='panel-footer'>$.$pro_price.00
<button pid='$pro_id' id='product' style='float:right;' class='btn btn-danger btn-xs'>Add To Cart</button></div> 
</div>
</div>

</div>";

}
echo '</div>';   
}

}
if(isset($_POST['get_selected_category']) || isset($_POST['selectBrand']) || isset($_POST['search']) )
    {
if(isset($_POST['get_selected_category']))
{
$id=$_POST['cat_id']; 
$sql="select * from products where product_cat='$id' ";
}
else if(isset($_POST['selectBrand'])){
$id=$_POST['brand_id']; 
$sql="select * from products where product_brand='$id' ";
}
else{
$keyword=$_POST['keyword']; 
$sql="select * from products where product_keywords LIKE '%$keyword%' ";
}
$run_query=mysqli_query($con,  $sql);


while($row=mysqli_fetch_array($run_query)){

$pro_id=$row['product_id'];
$pro_cat=$row['product_cat'];
$pro_brand=$row['product_brand'];
$pro_title=$row['product_title'];
$pro_price=$row['product_price'];
$pro_image=$row['product_image'];
echo "<div class='col-md-4'>
<div class='panel panel-info'>
<div class='panel-heading'>$pro_title
<div class='panel-body'>
<img src='product_images/$pro_image' height='230px' width='180px'>
</div>
<div class='panel-heading'>$.$pro_price.00
<button keyword='$pro_id' id='product' style='float:right;' class='btn btn-danger btn-xs'>Add To Cart</button></div> 
</div>
</div>

</div>";

}
}
if(isset($_POST['addToproduct']))
{
$P_id=$_POST['proId'];
$user_id=$_POST['uid'];
$sql="SELECT * FROM `cart` WHERE `p_id`='$P_id' AND` user_id`='$user_id'";
$run_query=mysqli_query($con, $sql);
$count=mysqli_num_rows($run_query);
if(($count)>0)
{
echo 'product is already added to the cart cuntinue soping';
}
else{
$sql="SELECT * FROM `products` WHERE `product_id`='$P_id'";
$run_query=mysqli_query($con, $sql);
$row= mysqli_fetch_assoc($run_query);
$pro_id=$row['product_id'];


$pro_title=$row['product_title'];
$pro_image=$row['product_image'];
$pro_price=$row['product_price'];

$sql="INSERT INTO `cart` (`p_id`, `ip_add`, `user_id`, `product_title`, `product_image`, `qty`, `price`, `total_amount`) VALUES ('$pro_id', '0', '$user_id', '$pro_title', '$pro_image', '1', '$pro_price', '$pro_price')";
if(mysqli_query($con, $sql))   {
echo "product is added";
}          
}

}
if(isset($_POST["get_cart_product"]) || isset($_POST["cart_checkout"])){
$uid=$_SESSION['uid'];
$sql="select * from cart where user_id='$uid'";
$run_query=mysqli_query($con, $sql);
$count=mysqli_num_rows($run_query);
if($count>0){
$no=1;
$total_amt=0;
while ($row=mysqli_fetch_array($run_query)){
$id=$row['id'];
$pro_id=$row['p_id'];
$pro_name=$row['product_title'];
$pro_image=$row['product_image'];
$qty=$row['qty'];
$total=$row['total_amount'];
$pro_price=$row['price'];
$price_array=array($total);
$total_sum= array_sum($price_array);
$total_amt=$total_amt+$total_sum;
if(isset($_POST['get_cart_product']))
{
echo "<div class='row'>
<div class='col-md-3'> $no</div>
<div class='col-md-3'> <img src='product_images/$pro_image' width='50px' height='60px;'></div>
<div class='col-md-3'> $pro_name</div>
<div class='col-md-3'> $. $pro_price .00</div>
</div>";
$no=$no+1; 
}
else {
echo " <div class='row'>
<div class='col-md-2'>
<div class='btn-group'>
<a href='#' remove_id='$pro_id' class='btn btn-danger remove'><span class='glyphicon glyphicon-trash'></span></a>
<a href='#' delete_id='$pro_id' class='btn btn-primary delete'><span class='glyphicon glyphicon-ok-sign'></span></a>
</div>
</div>
</div>
<div class='row'>
<div class='col-md-2'>Action</div>
<div class='col-md-2'><img src='product_images/$pro_image' height='100px' width='100px'></div>
<div class='col-md-2'>$pro_name</div>
<div class='col-md-2'><input type='text' class='form-control' value='$pro_price'></div>
<div class='col-md-2'><input type='text' class='form-control' value='$qty' disabled=''></div>
<div class='col-md-2'><input type='text' class='form-control' value='$total' disabled=''></div>
</div>";
}

}
if(isset($_POST["cart_checkout"])){
                                echo"<div class='row'>
                                <div class='col-md-8'> </div>                           
                                <div class='col-md-4'> <b>Total  $$total_amt</b></div>
                               </div>"; 
}
}
}
if(isset($_POST['cart_count'])){
            $uid=$_SESSION['uid'];
           $sql="select * from cart where user_id='$uid'"; 
           $run_query=mysqli_query($con, $sql);
           echo $count=mysqli_num_rows($run_query);
}
if(isset($_POST['removeFromCart'])){
    $pid=$_POST['removeId'];
            $uid=$_SESSION['uid'];
            $sql="delete from cart where user_id='$uid' AND p_id='$pid'";
            $run_query=mysqli_query($con, $sql);
            if($run_query){
                echo 'removed item from cart';
            }
}

?>
