<h3>Current readings</h3>
<?php
$readings = Read::all(Read::Begun);

if (count($readings) > 0) {
  include('_readings.php');
} else {
  echo 'No current readings.';
}
?>

<h3>Past readings</h3>

<?php
$readings = Read::all(Read::Done);
if (count($readings) > 0) {
  include('_readings.php');
} else {
  echo 'No current readings.';
}
?>
