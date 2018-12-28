<center>
	<h2>hello  <?php echo $this->session->userdata['name'];  ?></h2>
	<p><b>User Profile Data</b></p>
</center>
<div class="container">
  <h2>Striped Rows</h2>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Email</th>
        <th>Edit</th>
        <th>delete</th>
      </tr>
    </thead>
    <tbody>
   <?php
   // print_r($user);
    	foreach($user as $row)
    		{


        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        
        ?>
        <td><a href="<?php  echo base_url().'update/'.$row['id'];  ?>">edit</a></td>
        <td><a href="<?php  echo base_url().'delete/'.$row['id'];  ?>">delete</a></td>
        <?php

        // echo "<td>";
        // echo "<a href='$row[id]'>";
        // echo "Edit";
        // echo "</a>";
        // echo "</td>";
        
     
  }
    		?>
    </tbody>
  </table>
</div>



