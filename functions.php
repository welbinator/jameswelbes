<?php


function confirm($result)
{
  global $connection;
  if (!$result) {

    die("QUERY FAILED" . mysqli_error($connection));
  }
}

function randCol($portfolio_id)
{


  $array = array(0, 8, 4, 3, 6, 3, 6, 6);


  array_push($array, 8, 4, 3, 6, 3, 6, 6);
  echo $array[$portfolio_id];
}






function googleAnalytics()
{
  // global $connection;
  //       $query = "SELECT * FROM analytics";
  //       $select_analytics_id = mysqli_query($connection, $query);

  //       while($row = mysqli_fetch_assoc( $select_analytics_id)) {
  //       $ua_code = $row['ua_code'];

  //       }

  //       echo '<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137915920-1"></script>';
  //       echo '<script>';
  //       echo 'window.dataLayer = window.dataLayer || [];';
  //       echo 'function gtag(){dataLayer.push(arguments);}';
  //       echo "gtag('js', new Date());";
  //       echo "gtag('config', '$ua_code');";
  //       echo "</script>";
}
