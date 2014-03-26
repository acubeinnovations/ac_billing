<?php

if(isset($_POST['subject']) && isset($_POST['exam'])){
$div_content='';
$div_content='<h1>'.$_POST['subject'].'-Exam</h1><br><div class="medium-12 columns "><div class="medium-12 columns ">&nbsp;</div>';

$div_content.='<div class="medium-12 columns ">1. Explain the importance of outsourcing in pharma manufacturing..?<br><br><input type="radio" name="answer1" value="1" ><label>Answer 1</label><br><input type="radio" name="answer1" value="2" ><label>Answer 2</label></div>
<div class="medium-12 columns ">2. What are the requirements for outsourcing in pharmaceutical manufacturing and packaging..?<br><br><input type="radio" name="answer2" value="1" ><label>Answer 1</label><br><input type="radio" name="answer2" value="2" ><label>Answer 2</label></div>
<div class="medium-12 columns ">3. Write notes on Analytical services outsourcing of drugs and cosmetics..?<br><br><input type="radio" name="answer3" value="1" ><label>Answer 1</label><br><input type="radio" name="answer3" value="2" ><label>Answer 2</label></div>
<div class="medium-12 columns ">4. Describe outsourcing in pharma manufacturing and packaging..?<br><br><input type="radio" name="answer4" value="1" ><label>Answer 1</label><br><input type="radio" name="answer4" value="2" ><label>Answer 2</label><br><br><br></div>';

$div_content.='<br><div class="medium-12 columns ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="tiny button success finish_exam" subject="'.$_POST['subject'].'">FINISH</a></div><br><br></div>';
print $div_content;
exit();

}



?>
