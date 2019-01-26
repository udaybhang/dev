<html>
    <head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="panel panel-danger">            
            <div class="panel-heading"><h4>online quiz</h4></div>
            <div class="panel-body">php quiz</div></div></div></div><br><hr><br>
              <div class="row">
            <div class="col-md-6">
        <div class="panel panel-info">            
            <div class="panel-heading"><h4>Sign In</h4></div>
            <form method="post" action="signin_sub.php">
                <div class="panel-body">
<?php if(isset($_GET['run']) && $_GET['run']== 'failed'){
     echo 'your email or password is incorrect';  
}
 ?>                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                   
                    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    
                </div>
                 <input type="submit" name="submit" value="signin">
                <div class="panel-footer">&copy; copy right reserved 2018-2019</div>
                    
            </form>
            </div>
            </div>
                    <div class="col-md-6"><div class="panel panel-info">            
                            <div class="panel-heading"><h4 style="text-align:center">Sign Up form</h4></div>
            <form method="post" action="signup_sub.php" enctype="multipart/form-data">
                <div class="panel-body">
                    <?php if(isset($_GET['run']) && $_GET['run']=='sucess'){
     echo 'sucessufully sign in';
                    } 
                    else{
                     echo 'fail signup';   
                    }
?>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                   
                    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>file Upload</label>
                        <input type="file" name="upload" class="form-control">
                    </div>
                </div>
                 <input type="submit" name="submit" value="signup">
                <div class="panel-footer">&copy; copy right reserved 2018-2019</div>
                    
            </form>
            </div></div>
                
            
        
        </div>
            </div>
        
    </body>
    
</html>
