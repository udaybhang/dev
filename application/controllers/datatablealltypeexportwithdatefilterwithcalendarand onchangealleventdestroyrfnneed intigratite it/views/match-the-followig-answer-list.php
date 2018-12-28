<?php	
       print_r($user_ans_data);
		$m=1;
		foreach($user_ans_data as $userdata){
		$ques = $userdata['match_id'];
		echo '<tr>';
		  echo '<td>'.($i).'. </td>';
			    $data=$this->Crud_modal->fetch_single_data('match_question,match_answer','match_the_following',"match_id='$ques'");
          echo '<td>';
                  $matctques=explode('comma', $data['match_question']);
                  $matchcount=count($matctques);
                  for($i=0; $i<$matchcount; $i++)
                  {
                       echo '<li style="list-style: none">'.($i+1).'. '.$matctques[$i].'</li>';
                  }
           
          echo '</td>';
          echo '<td>';
                   
                  $ansset=explode('comma', $userdata['answer_set']);
                  $matctans=explode('comma', $data['match_answer']);
                  //print_r($ansset);
                  $mcount=count($ansset);
                  for($l=0; $l<$mcount; $l++)
                  {
                  	if(!strcmp($ansset[$l], $matctans[$l])){
                          echo '<li style="list-style: none;">'.($l+1).'. <font style="color: #4CAF50">'.$ansset[$l].'</font></li>';
                        }else{
                                   if($userans[$l]=='Not Attempt' || $userans[$l]=='not attempt'){
                                       echo '<li style="list-style: none;">'.($l+1).'. <font style="color: #00bfff">'.$ansset[$l].'</font></li><br/>';
                                   }else{
                                           echo '<li style="list-style: none;">'.($l+1).'. <font style="color: #ff00bf">'.$ansset[$l].'</font></li><br/>';
                                      }
                           //echo '<li style="list-style: none;">'.($l+1).'. <font style="color: #ff00bf">'.$ansset[$l].'</font></li>';
                        }
                 }
           echo '</td>';
          echo '<td>';
                  $matctans=explode('comma', $data['match_answer']);
                  $matchanscount=count($matctans);
                  for($k=0; $k < $matchanscount; $k++)
                  {
                  echo '<li style="list-style: none;">'.($k+1).'. '.$matctans[$k].'</li>';
                 }
          echo '</td>';
        echo '</tr>';
        $m++;
 }
?> 