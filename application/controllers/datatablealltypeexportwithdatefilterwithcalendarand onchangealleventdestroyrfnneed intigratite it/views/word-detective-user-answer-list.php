<?php	
 
		$i=1;
		foreach($user_ans_data as $userdata){
		$ques = $userdata['ques_id'];
		echo '<tr>';
		  echo '<td>'.($i).'. </td>';
			    $data=$this->Crud_modal->fetch_single_data('word_detective_question,word_detective_answer','mm_word_detective'," word_detective_id='$ques'");
          echo '<td>';
            echo '<li style="list-style: none">'.$data['word_detective_question'].'</li>';
          echo '</td>';
                              $str1=$userdata['user_ans'];
                              $str2=$data['word_detective_answer'];
                               if(!(strcmp($str1, $str2))){
                                          $color = "#4CAF50";
                        }
                      else if($userdata['user_ans']=='Not Attempt' || $userdata['user_ans']=='not attempt'){
                      $color = "#00bfff";
                       }else{
                       $color = "#ff00bf";
                       }
          echo '<td>';
                  echo '<li style="list-style: none; color: '.$color.'">'.$userdata['user_ans'].'</li>';
           echo '</td>';
          echo '<td>';
                  echo '<li style="list-style: none;">'.$data['word_detective_answer'].'</li>';
          echo '</td>';
        echo '</tr>';
        $i++;
 }
?> 