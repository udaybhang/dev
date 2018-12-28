<?php	
 
		$i=1;
    print_r($user_ans_data); 
		foreach($user_ans_data as $userdata){
		$ques = $userdata['ques_id'];
		echo '<tr>';
		  echo '<td>'.($i).'. </td>';
			    $data=$this->Crud_modal->fetch_single_data('*','mm_crossword',"crossword_id='$ques'");
          echo '<td>';
            echo '<li style="list-style: none">'.$data['crossword_question'].'</li>';
          echo '</td>';
            $hint = explode('||', $data['crossword_hint']);
            $count = count($hint);
             echo '<td>';
             $a=1;
          for($i=0; $i<$count; $i++){      
            echo '<li style="list-style: none"><b>' .$a.".</b> ".$hint[$i].'</li><br/>';
            $a++;
          }
            echo '</td>';
          echo '<td>';
          // dhfjkhdskfhkd
                           
                            $nrow=$data['row_count'];
                            $ncol=$data['column_count'];
                            $arrayword = explode(',', $userdata['user_ans']);
                            $twoarray=array();
                            $a1=0;
                            for($i=0; $i<$nrow; $i++){
                                                                for($j=0; $j<$ncol; $j++){
                                                                     $twoarray[$i][$j] = $arrayword[$a1]; 
                                                                     $a1++;   
                                }
                              }
                            $newwor = array_chunk($arrayword, $ncol, true);
                            $crwd= explode('$$',$data['crossword_position']); 
                            $split=count($crwd);
                            $a2=0;
                              for($m=0; $m<$split; $m++)
                              {
                                                                $s[$m]= explode('||', $crwd[$m]); 
                                                                     
                              }       
                            $counts = count($s); 
                            $fstring = array();
                            for($n=0; $n<$counts; $n++){
                                                             $s1[$n] = explode(',', $s[$n][0]);
                                                             $s2[$n] = explode(',', $s[$n][1]);
                                                             $r1 = $s1[$n][0];
                                                             $c1 = $s1[$n][1];
                                                             $r2 = $s2[$n][0]; 
                                                             $c2 = $s2[$n][1];
                                                             $string_ans='';
                                                             for($o=$r1; $o<=$r2; $o++){
                                                               for($p=$c1; $p<=$c2; $p++){
                                                                $string_ans .=$twoarray[$o][$p];      
                                                              }        
                                                             }
                                                            array_push($fstring, $string_ans);
                            }  
                            
        
                  // dhfjkhdskfhkd
                           $hinttype = explode('||', $data['crossword_hint']);
                            $nrow=$data['row_count'];
                            $ncol=$data['column_count'];
                            $arrayword = explode(',', $data['crossword_array']);
                            $twoarray=array();
                            $a1=0;
                            for($i=0; $i<$nrow; $i++){
                                                                for($j=0; $j<$ncol; $j++){
                                                                     $twoarray[$i][$j] = $arrayword[$a1]; 
                                                                     $a1++;   
                                }
                              }
                            $newwor = array_chunk($arrayword, $ncol, true);
                            $crwd= explode('$$',$data['crossword_position']); 
                            $split=count($crwd);
                            $a2=0;
                              for($m=0; $m<$split; $m++)
                              {
                                                                $s[$m]= explode('||', $crwd[$m]); 
                                                                     
                              }       
                            $counts = count($s); 
                            $nstring = array();
                            for($n=0; $n<$counts; $n++){
                                                             $s1[$n] = explode(',', $s[$n][0]);
                                                             $s2[$n] = explode(',', $s[$n][1]);
                                                             $r1 = $s1[$n][0];
                                                             $c1 = $s1[$n][1];
                                                             $r2 = $s2[$n][0]; 
                                                             $c2 = $s2[$n][1];
                                                             $string_ans='';
                                                             for($o=$r1; $o<=$r2; $o++){
                                                               for($p=$c1; $p<=$c2; $p++){
                                                                $string_ans .=$twoarray[$o][$p];      
                                                              }        
                                                             }
                                                            array_push($nstring, $string_ans);
                            } 
                             for($j=0; $j<$count; $j++){   
                                  if($fstring[$j] !="" || $fstring[$j] != NULL){
                                    $str1 = strtolower($fstring[$j]);
                                    $str2 = strtolower($nstring[$j]);
                                          if(!(strcmp($str1, $str2)))
                                          {
                                              echo '<li style="list-style: none;"><b>' .($j+1).'. </b><font style="color: #4CAF50">'.$fstring[$j].'</font></li><br/>';

                                          }else{
                                            echo '<li style="list-style: none;"><b>' .($j+1).'. </b><font style="color: #ff00bf">'.$fstring[$j].'</font></li><br/>';
                                          }
                                      
                                    
                                  }else{
                                    echo '<li style="list-style: none; color: #ff00bf"><b>' .($j+1).". </b>".' Not Attemped</li><br/>';
                                  }  
                                  
                                  $a++;
                                }
                      ///jfhuyuiwej 
                  //echo '<li style="list-style: none">'.$userdata['user_ans'].'</li>';
           echo '</td>';
          echo '<td>'; 
                             for($k=0; $k<$count; $k++){      
                                  echo '<li style="list-style: none"><b>' .($k+1).". </b>".$nstring[$k].'</li><br/>';
                                  $a++;
                                }
                      ///jfhuyuiwej    
                  
          echo '</td>';
        echo '</tr>';
        $i++;
 }
?> 