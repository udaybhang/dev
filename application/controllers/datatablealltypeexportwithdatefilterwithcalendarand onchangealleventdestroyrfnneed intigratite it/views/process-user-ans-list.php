<?php	

		$i=1;
		foreach($user_ans_data as $userdata){
		$ques = $userdata['ques_id'];
	  $uans = $userdata['user_ans'];
		echo '<tr>';
		echo '<td>'.($i).'. </td>';
		$data=$this->Crud_modal->fetch_single_data('process_question,answer_array,row_count,column_count','mm_process_generator',"process_id='$ques'");
    echo '<td>';
      echo $data['process_question'];
    echo '</td>';
    echo '<td><table><tbody>';
        $r=$data['row_count']; $c=$data['column_count'];
        $uansArr=explode(',', $uans);
        $utemp1=0;
        for($uir=0;$uir<$r;$uir++){
          echo  '<tr>';
          for($ujc=0;$ujc<$c;$ujc++){
            $uval=$uansArr[$utemp1]; 
            if($uval=="a0"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-right"></span>'."</td>";
            }elseif($uval=="a1"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-down"></span>'."</td>";
            }elseif($uval=="a2"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-left"></span>'."</td>";
            }elseif($uval=="a3"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-up"></span>'."</td>";
            }elseif($uval=="-" || $uval=="X" || $uval=="x"){
              echo "<td>&nbsp;</td>";
            }else{
              echo "<td>".$uval."</td>";
            }
           $utemp1++;
          }
          echo '</tr>';
      }
    echo  '</tbody> </table></td>';
    echo '<td><table><tbody>';
        $r=$data['row_count']; $c=$data['column_count'];
        $ansArr=explode(',', $data['answer_array']);
        $temp1=0;
        for($ir=0;$ir<$r;$ir++){
          echo  '<tr>';
          for($jc=0;$jc<$c;$jc++){
            $val=$ansArr[$temp1]; 
            if($val=="a0"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-right"></span>'."</td>";
            }elseif($val=="a1"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-down"></span>'."</td>";
            }elseif($val=="a2"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-left"></span>'."</td>";
            }elseif($val=="a3"){
              echo "<td>".'<span class="glyphicon glyphicon-arrow-up"></span>'."</td>";
            }elseif($val=="-" || $val=="X" || $val=="x"){
              echo "<td>&nbsp;</td>";
            }else{
              echo "<td>".$val."</td>";
            }
           $temp1++;
          }
          echo '</tr>';
      }
    echo  '</tbody> </table></td>';
    echo '</tr>';
    $i++;
 }
?> 