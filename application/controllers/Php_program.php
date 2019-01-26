<?php
class Php_program extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}
	public function add_string_char_by_car()
	{


  $n1 = "uday";
  $n2 = "bhan";

  //count length fo both string 
  $count1 = strlen($n1);
  $count2 = strlen($n2);
  $finalcount = 0;

  if($count1 > $count2) {
    $finalcount = $count1;
  } elseif ($count1 < $count2) {
    $finalcount = $count2;
  } else {
    $finalcount = $count1;
  }

  //convert string to array
  $n1 = str_split($n1);
  // print_r($n1); die;
  $n2 = str_split($n2);

  $i = 0;
  $result = "";
  for($i = 0;$i < $finalcount  ; $i++) {
    $result = $result .$n1[$i] . $n2[$i];
  }

  echo $result;

	}
	public function string_to_array()
	{

$data="How, to, split, a, string, using, explode";
$splittedstring=explode(",",$data);
print_r($splittedstring);
foreach ($splittedstring as $key => $value) {
echo "splittedstring[".$key."] = ".$value."<br>";
}
}
public function array_flips()
{
	$fruit=array('mango', 'apple', 'banana', 'pear');
$fruit= array_flip($fruit);
print_r($fruit);// exchange all key with associative value
}

	public function min_max()
	{
		$array=array(1,2,3,4,5);
 echo $this->getMax($array); //5
echo $this->getMin($array); // 1
	}
public	function getMax($array)  
{ 
   $n = count($array);  
   $max = $array[0]; 
   for ($i = 1; $i < $n; $i++)  
       if ($max < $array[$i]) 
           $max = $array[$i]; 
    return $max;        
} 
  
// Returns maximum in array 
public function getMin($array)  
{ 
   $n = count($array);  
   $min = $array[0]; 
   for ($i = 1; $i < $n; $i++)  
       if ($min > $array[$i]) 
           $min = $array[$i]; 
    return $min;        
} 
	
}
?>