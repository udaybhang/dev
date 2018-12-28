<?php	
 
		$i=1;

		foreach($mcq_data as $mcqdata){
		$ques = explode('comma', $mcqdata['ques_id']);
    $userques_count= count($ques);
		echo '<tr>';
		  echo '<td>'.($i).'. </td>';
      echo '<td>';
      for($k=0; $k<$userques_count; $k++)
      {
        $data=$this->Crud_modal->fetch_single_data('c_answer,question','mcq',"mcq_id='$ques[$k]'");

            echo '<li style="list-style: none">'.($k+1).'. '.$data['question'].'</li><br/>';
          
      }
			    echo '</td>'; 
          $userans = explode('comma', $mcqdata['user_ans']); 
          $userans_count = count($userans);
          echo '<td>';
          for($j=0; $j<$userans_count; $j++)
          {
               $data=$this->Crud_modal->fetch_single_data('c_answer,question','mcq',"mcq_id='$ques[$j]'");
               if(!strcmp($data['c_answer'], $userans[$j])){
                   echo '<li style="list-style: none;">'.($j+1).'. <font style="color: #4CAF50">'.$userans[$j].'</font></li><br/>';
               }else{
                     if($userans[$j]=='Not Attempt' || $userans[$j]=='not attempt'){
                       echo '<li style="list-style: none;">'.($j+1).'. <font style="color: #00bfff">'.$userans[$j].'</font></li><br/>';
                     }else{
                      echo '<li style="list-style: none;">'.($j+1).'. <font style="color: #ff00bf">'.$userans[$j].'</font></li><br/>';
                     }
                   
               }
               
          }     
           echo '</td>';
          echo '<td>';
          for($j=0; $j<$userans_count; $j++)
          { 
               $data=$this->Crud_modal->fetch_single_data('c_answer,question','mcq',"mcq_id='$ques[$j]'");
               echo '<li style="list-style: none;">'.($j+1).'. '.$data['c_answer'].'</li><br/>';
          }   
                  
          echo '</td>';
        echo '</tr>';
        $i++;
 }
// sequence data
// for mcq user answer data for case study
    foreach($sequene_data as $sequencedata){
    $ques = $sequencedata['ques_id'];
    //$userques_count= count($ques);
    echo '<tr>';
      echo '<td>'.($i).'. </td>';
      echo '<td>';
     
             $data=$this->Crud_modal->fetch_single_data('options,question','sequence_questions',"sq_id='$ques'");

            echo '<li style="list-style: none">'.$data['question'].'</li><br/>';
          echo '</td>'; 
          $userans = explode('sohrab', $sequencedata['user_ans']); 
          $userans_count = count($userans);
          echo '<td>';
          //print_r($userans);
          for($j=0; $j<$userans_count; $j++)
          {
               $quesa = explode('sohrab', $data['options']);
               if(!strcmp($quesa[$j], $userans[$j])){
                   echo '<li style="list-style: none;">'.($j+1).'. <font style="color: #4CAF50">'.$userans[$j].'</font></li><br/>';
               }else{
                    if($userans[$j]=='Not Attempt' || $userans[$j]=='not attempt'){
                       echo '<li style="list-style: none;">'.($j+1).'. <font style="color: #ff00bf">'.$userans[$j].'</font></li><br/>';
                     }else{
                      echo '<li style="list-style: none;">'.($j+1).'. <font style="color: #ff00bf">'.$userans[$j].'</font></li><br/>';
                     }
               }
               
          }     
           echo '</td>';
          echo '<td>';
             
              $quesans = explode('sohrab', $data['options']);
              $ucount = count($quesans);
              for($j=0; $j<$ucount; $j++)
              {
               echo '<li style="list-style: none;">'.($j+1).'. '.$quesans[$j].'</li><br/>';
              }
                 
          echo '</td>';
        echo '</tr>';
        $i++;
 } 
 // for case subjective user answer data for case study
    foreach($subjective_data as $subjectivedata){
    $ques = $subjectivedata['ques_id'];
    //$userques_count= count($ques);
    echo '<tr>';
      echo '<td>'.($i).'. </td>';
      echo '<td>';
     
             $data=$this->Crud_modal->fetch_single_data('answer,question','subjective',"subjective_id='$ques'");

            echo '<li style="list-style: none">'.$data['question'].'</li><br/>';
          echo '</td>'; 
          echo '<td>';
              echo '<li style="list-style: none;"><a href="'.base_url().'upload/'.$subjectivedata['u_id'].'/'.$subjectivedata['user_file'].'" download="'.base_url().'upload/'.$subjectivedata['u_id'].'/'.$subjectivedata['user_file'].'">'.$subjectivedata['user_file'].'</a></font></li><br/>';     
           echo '</td>';
          echo '<td>';
               echo '<li style="list-style: none;">'.$data['answer'].'</li><br/>';      
          echo '</td>';
        echo '</tr>';
        $i++;
 } 
?> 