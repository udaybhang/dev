<!DOCTYPE html> 
<html lang = "en"> 

   <head> 
      <meta charset = "utf-8"> 
      <title>CodeIgniter Email Example</title> 
   </head>
	
   <body> 
     <?php echo "<h1>Contact form</h1>" ;
     echo "<br>";
echo form_open('Email_controller/send_mail');
echo form_label('name');
echo form_input('name');
echo "<br>";
// echo form_label('From');
// echo form_input('form');
echo "<br>";
echo form_label('To');
echo form_input('to');
echo "<br>";
echo form_label('Subject');
echo form_input('subject');
echo "<br>";
echo form_label('Message');
$data=array(
'name'=>'textarea',
'rows'=>5,
'cols'=>32
);
echo form_textarea($data);
echo "<br>";
echo form_submit('submit', 'Send Email');
echo form_close();
echo "<br>";
     ?>
   </body>
	
</html>