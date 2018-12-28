<?php	
 
		$i=1;//print_r($user_ans_data); echo "hai";die;
		foreach($user_ans_data as $userdata){

		$ques = $userdata['ques_id'];
		echo '<tr>';
		  echo '<td>'.($i).'. </td>';
			    $data=$this->Crud_modal->fetch_single_data('fib_answer,fib_question','mm_grid_fib'," fib_id='$ques'");
          echo '<td>';
            echo '<li style="list-style: none">'.$data['fib_question'].'</li>';
          echo '</td>';
                              $str1=$userdata['user_ans'];
                              $str2=$data['fib_answer'];
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
                  echo '<li style="list-style: none;">'.$data['fib_answer'].'</li>';
          echo '</td>';
        echo '</tr>';
        $i++;
 }
?> 