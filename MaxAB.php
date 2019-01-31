<?php 
if(!isset($_GET["load"]))
{
$date=$_GET['startingDate'];
$satrtDate = $date;
$days=$_GET['days'];
$capacity=$_GET['capacity'];
$totalSessionsNeeded =  ceil((30*$capacity));
$count = 0;
$prevDay = 0;
$date = date("Y-m-d",strtotime($date));
$scheduleDays;
$firstDayFlag = false;

if( date("Y-m-d") == $date) // first day match todays date
{
$schedule[0] = $date;
$scheduleDays[0] = date("D",strtotime($date)) ;

$firstDayFlag = true;
$count++;
}

$prevDay = date("N",strtotime($date)) + 2 ;
if ($prevDay >7)
{
    $prevDay = $prevDay - 7;
}
for($i = 0 ; $i < $totalSessionsNeeded ; $i++)
{
    if($count ==  count($days))
    {
    $count = 0;
    }

    if($firstDayFlag == true)
    {
        $i++;
        $date = $schedule[$i];
        $scheduleDays[$i] = date("D",strtotime($schedule[$i])) ;

        $firstDayFlag = false;
       
    }
         $day = $days[$count] - $prevDay ;
         if ($day <= 0)
         $day = $day + 7 ;
          $schedule[$i] = date ("Y-m-d",strtotime($date." + $day days")); // add 1 month to a date
          $scheduleDays[$i] = date("D",strtotime($schedule[$i])) ;
          $date = $schedule[$i];
          $prevDay = $days[$count];
          $count++;
}
$post = array('startingDate'=> $satrtDate, 'days'=> $days, 'capacity'=> $capacity,'schedule'=> $schedule,'scheduleDays'=> $scheduleDays);
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($post));
fclose($fp);
    header('location:./schedule.html');
    exit();
}
else 
{
return './results.json';
}
?> 