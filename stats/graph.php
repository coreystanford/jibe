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

// get lists of views, likes comments and project titles (within views array)        
        
$views = StatsDB::getAllViews($user_id);
$likes = StatsDB::getAllLikes($user_id);
$comments = StatsDB::getAllComments($user_id);

$data1y = array();
$yaxis_labels = array();

// asign values to graph labels, and views array

foreach ($views as $view){
    if(is_null($view['num_views'])){
        $data1y[] = 0;
    }
    else {$data1y[] = $view['num_views'];}
    $yaxis_labels[] = $view['proj_title'];
    
}

//  declare arrays for full and half Y-axis ticks

$tick_array = array();
$halftick_array = array();

//  make grid Yaxis dynamic height to accomodate any veiws number

$max_views = max($data1y);
$max_y = ceil($max_views / 10) * 10;

//  if views number is really low, we create a graph with ticks every 2

if($max_y <= 10){
    for($i = 0; $i <= $max_y; $i += 4){
        $tick_array[] = $i;
        if($i < $max_y) {$halftick_array[] = $i + 2;}
    }
    
}

//  for more views we create a grid with tick every

else{
    for($i = 0; $i <= $max_y; $i += 10){
        $tick_array[] = $i;
        if($i < $max_y) {$halftick_array[] = $i + 5;}
    }
}

//  populating array for likes

$data2y = array();

foreach ($likes as $like){
    $data2y[] = $like['count'];
}

//   populating array for comments

$data3y = array();

foreach ($comments as $comment) {
    $data3y[] = $comment['count'];
}


// Create the graph. These two calls are always required
$graph = new Graph(950,400,'auto');
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

//$graph->yaxis->
$graph->yaxis->SetTickPositions($tick_array,$halftick_array);
$graph->SetBox(false);

$graph->ygrid->SetFill(false);

// assigning array of project titles to create graph labels

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
