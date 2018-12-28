<?php			
					$ques = explode('ravi',$user_ans_data['ques_id']);
					$ans = explode('ravi',$user_ans_data['options']);
					$uid = $user_ans_data['u_id'];
					$count = count($ques);
					$count1 = count($ans);
					if($count>1){
							for($i=0; $i<$count; $i++)
							{ 
									echo '<tr>';
									  echo '<td>'.($i+1).'. </td>';
										$data=$this->Crud_modal->fetch_single_data('question,c_answer','mcq',"mcq_id='$ques[$i]'");
				                      echo '<td>';
				                        echo '<li style="list-style: none">'.$data['question'].'</li>';
				                      echo '</td>';
				                      $str1=$ans[$i];
				                      $str2=$data['c_answer'];
				                       if(!(strcmp($str1, $str2))){
                                          $color = "#4CAF50";
								        }
								      else if($ans[$i]=='Not Attempt' || $ans[$i]=='not attempt'){
								    	$color = "#00bfff";
								       }else{
								    	 $color = "#ff00bf";
								       }
				                      echo '<td>';
				                              echo '<li style="list-style: none; color: '.$color.'">'.$ans[$i].'</li>';
				                      echo '</td>';
				                      echo '<td>';
				                              echo '<li style="list-style: none">'.$data['c_answer'].'</li>';
				                      echo '</td>';
				                    echo '</tr>';
							}} ?> 