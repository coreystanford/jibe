<?php 
// content="text/plain; charset=utf-8"
require '../config.php';
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_bar.php');
    require '../errors/errorhandler.php';
    require '../model/autoload.php';
    require_once ('../model/statsDB.php');

session_start();

// current user id
    
if(isset($_GET['id'])){
            $user_id = $_GET['id'];       
}
elseif(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
     
}
else {
            $user_id = 1;
        }    

$views = StatsDB::getAllViews($user_id);
$likes = StatsDB::getAllLikes($user_id);
$comments = StatsDB::getAllComments($user_id);

$data1y = array();
$yaxis_labels = array();

foreach ($views as $view){
    if(is_null($view['num_views'])){
        $data1y[] = 0;
    }
    else {$data1y[] = $view['num_views'];}
    $yaxis_labels[] = $view['proj_title'];
    
}

$max_views = max($data1y);
$max_y = ceil($max_views / 10) * 10;

$tick_array = array();
$halftick_array = array();

for($i = 0; $i <= $max_y; $i += 10){
    $tick_array[] = $i;
    if($i < $max_y) {$halftick_array[] = $i + 5;}
}


$data2y = array();

foreach ($likes as $like){
    $data2y[] = $like['count'];
}

$data3y = array();

foreach ($comments as $comment) {
    $data3y[] = $comment['count'];
}

// Create the graph. These two calls are always required
$graph = new Graph(950,400,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

//$graph->yaxis->SetTickPositions(array(0,10,20,30,40,50), array(5,15,25,35,45));
$graph->yaxis->SetTickPositions($tick_array,$halftick_array);
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
//$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->xaxis->SetTickLabels($yaxis_labels);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b2plot = new BarPlot($data2y);
$b3plot = new BarPlot($data3y);

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
// ...and add it to the graPH
$graph->Add($gbplot);


$b1plot->SetColor("white");
$b1plot->SetFillColor("#cc1111");

$b2plot->SetColor("white");
$b2plot->SetFillColor("#11cccc");

$b3plot->SetColor("white");
$b3plot->SetFillColor("#1111cc");

$graph->title->Set("Views(Red), Likes(Green), Comments(Blue) by Project");

// Display the graph
$graph->Stroke();
?>
