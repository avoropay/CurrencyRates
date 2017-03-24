<?php // content="text/plain; charset=utf-8"
require_once ("vendor/jpgraph/jpgraph.php");
require_once ('vendor/jpgraph/jpgraph_line.php');

$theme_class=new \UniversalTheme;

$graph = new \Graph($graphSize[0], $graphSize[1]);

$graph->SetScale('textlin');
//$graph->SetScale('datlin');
$graph->SetTheme($theme_class);



$graph->img->SetAntiAliasing(false);
//$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);
//$graph->SetMargin(40,30,40,120);
$graph->legend->SetShadow('gray@0.4',5);
$graph->legend->SetPos(0.1,0.1,'right','top');

$graph->img->SetAntiAliasing();

$graph->xaxis->SetTickSide(SIDE_BOTTOM);
$graph->yaxis->SetTickSide(SIDE_LEFT);
$graph->xaxis->SetLabelAngle(90);
$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($dates['USD']);
//$graph->xaxis->SetTextLabelInterval(30);
$graph->xaxis->SetTextTickInterval(30);

$lineplot = new \LinePlot($ydata['USD']);
$graph->Add($lineplot);
$lineplot->SetColor('blue');
$lineplot->SetLegend('USD');

$lineplotEUR = new \LinePlot($ydata['EUR']);
$graph->Add($lineplotEUR);
$lineplotEUR->SetColor('green');
$lineplotEUR->SetLegend('EUR');

$lineplotRUR = new \LinePlot($ydata['GBP']);
$graph->Add($lineplotRUR);
$lineplotRUR->SetColor('black');
$lineplotRUR->SetLegend('GBP');


$graph->legend->SetFrameWeight(1);
$graph->legend->SetColumns(6);


$graph->Stroke($filename);
