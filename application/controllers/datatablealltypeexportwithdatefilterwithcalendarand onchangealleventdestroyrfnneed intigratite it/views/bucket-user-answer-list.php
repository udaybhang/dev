<?php	

		$i=1;
		foreach($user_ans_data as $userdata){
		$ques = $userdata['ques_id'];
		$ans = explode('@|',$userdata['user_ans']);
		$ans_count = count($ans);
		echo '<tr>';
		  echo '<td>'.($i).'. </td>';
			$data=$this->Crud_modal->fetch_single_data('bucket_question,bucket_answer,order_level','mm_bucket',"bucket_id='$ques'");

			
          echo '<td>';
            echo '<li style="list-style: none">'.$data['bucket_question'].'</li>';
          echo '</td>';
          echo '<td>';
          $level = explode('@|', $data['order_level']);
          for($i=0; $i<$ans_count; $i++)
          {
                              
                                    $answer = explode('@|', $data['bucket_answer']);
                                    $user_ans_count = count($answer);
                                    $banswer = explode('|', $answer[$i]);
                                    $uanswer = explode('|', $ans[$i]);
                                    $useraanscount = count($uanswer);
                                    if($ans[$i]=='Not Attempt'){
                                        $color = "#00bfff";
                                        echo '<li style="list-style: none; color: '.$color.'">'.$ans[$i].'</li>';
                                     }else{
                                   echo '<li style="list-style: none"><b>'.$level[$i].' :- </b>';

                                   for($n=0; $n<$useraanscount; $n++)
                                   {
                                      if(in_array($uanswer[$n], $banswer)){
                                          echo '<font style="color: #4CAF50">'.$uanswer[$n].'</font>|';
                                      }else{
                                        echo '<font style="color: #ff00bf">'.$uanswer[$n].'</font>|';
                                      }
                                   }
                                   echo '</li>';
                                    }       
         
          }
           echo '</td>';
           echo '<td>';
                  $answer = explode('@|', $data['bucket_answer']);
                  $ans_count = count($answer);
                  for($i=0; $i<$ans_count; $i++){

                           echo '<li style="list-style: none"><b>'.$level[$i]." :- </b>".$answer[$i].'</li>';
			         }
                  
          echo '</td>';
        echo '</tr>';
        $i++;
 }
?> 