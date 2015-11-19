<?php // content="text/plain; charset=utf-8"
include"work.php";
print <<<HERE
<h2> REQUIRED FIELDS </h2>
<form id="my form" method="post">
<div>
<label for="year">Year:  </label>
<input type="text" name="year" required="required">
</div>
<div>
<label for="name">Name:  </label>
<input type="text" name="name" required="required">
</div>
<div id="my submit">
<input type="submit" name="submit" value="submit">(()
</div>
</form>
HERE;
include"conn.php";
if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $year=$_POST['year'];

define("__ROOT__", dirname(dirname(__FILE__)));
require_once ("../jpgraph.php");
require_once ("../jpgraph_line.php");
require_once ("../jpgraph_error.php");
 
$x_axis = array();
$y_axis = array();
$i = 0;
$result = @mysqli_query($conn,"SELECT amount FROM baby WHERE given_name=".$name." and year=".$year." LIMIT 10");
 
 
while($row = @mysqli_fetch_array($result)) {
$x_axis[$i] =  $row["data_id"];
$y_axis[$i] = $row["data_val"];
    $i++;
 
}
     
     
 
     
    mysqli_close($conn);
 
 
 
$graph = new Graph(800,500);
$graph->img->SetMargin(40,40,40,40); 
$graph->img->SetAntiAliasing();
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->title->Set("Example of line centered plot");
$graph->title->SetFont(FF_FONT1,FS_BOLD);
 
 
// Use 20% "grace" to get slightly larger scale then min/max of
// data
$graph->yscale->SetGrace(0);
 
 
$p1 = new LinePlot($y_axis);
$p1->mark->SetType(MARK_FILLEDCIRCLE);
$p1->mark->SetFillColor("red");
$p1->mark->SetWidth(4);
$p1->SetColor("blue");
$p1->SetCenter();
$graph->Add($p1);
 
$graph->Stroke();
}
 
?>
