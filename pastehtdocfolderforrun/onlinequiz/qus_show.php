<?php
include 'class/users.php';
$qus=new users;
$cat= $_POST['cat']; //show the id of category
$qus->qus_show($cat);
//echo "<pre>";
//print_r($qus->qus);// print all array of questions table field
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
    <h3>Online quiz in php</h3>
    <form action="answer.php" method="post">
    <?php 
    $i=1;
    foreach($qus->qus as $questions){
    ?>
<table class="table table-bordered">
    <thead><tr class="danger">

<th><?php echo $i; ?><?php echo $questions['questions']; ?></th>
</tr></thead>
<tbody>
    <tr>
        <?php if(isset($questions['ans1'])) {?>
        <td>&nbsp;1&nbsp;<input type="radio" value="0" name="<?php echo $questions['id'];  ?>">&nbsp;&nbsp;<?php echo $questions['ans1']; ?></td> 
        <?php } ?>
    </tr>
    <tr><?php if(isset($questions['ans2'])) {?><td>&nbsp;2&nbsp;<input type="radio" value="1" name="<?php echo $questions['id'];  ?>">&nbsp;&nbsp;<?php echo $questions['ans2']; ?></td>
    <?php } ?>
    </tr>
          <tr><?php if(isset($questions['ans3'])) {?><td>&nbsp;3&nbsp;<input type="radio" value="2" name="<?php echo $questions['id'];  ?>">&nbsp;&nbsp;<?php echo $questions['ans3']; ?></td>
          <?php } ?>
          </tr>
     <tr><?php if(isset($questions['ans4'])) {?><td>&nbsp;4&nbsp;<input type="radio" value="3" name="<?php echo $questions['id'];  ?>">&nbsp;&nbsp;<?php echo $questions['ans4']; ?></td>
     <?php } ?>
     </tr>
     <tr><td><input type="radio" style="display: none;" value="4" value="no_attempt" checked="checked" name="<?php echo $questions['id'];  ?>"></td></tr>
</tbody>
</table>
    <?php $i++;}?>
    <input type="submit" value="submit Quiz" class="btn btn-success">
    </form>
</div>
    <div class="col-sm-2"></div>
    </div>