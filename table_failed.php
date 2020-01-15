<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>
<?php include "includes/nav_bar.php"; ?>

<script>

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    td2 = tr[i].getElementsByTagName("td")[3];
    if (td || td2) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>


<div class="container">
    <div class="row">
        <div class="col-sm-12">

        <h2>Failed</h2>

        <div class="col-md-4 offset-md-4 mt-5 border-success pt-0">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search for email..." aria-label="Search" id="myInput" onkeyup="myFunction()">
  <div class="input-group-append">
    <span class="input-group-text"><i class="fa fa-search"></i></span>
  </div>
  </div>
</div>

<?php

$where = '{"status":0}';


$sqlquery = "SELECT * FROM app_log WHERE response = '$where' ORDER BY end DESC";
$queryresult = $connection->query($sqlquery);

if($queryresult->num_rows > 0) {
    echo "<br><table id='myTable' class='table-striped table-bordered tfailed'> <tr><th>id</th>
    <th>function</th>
    <th>email</th>
    <th>problem type</th>
    <th>response</th>
    <th>start_date</th>
    <th>end_date</th>";

    while($rows = $queryresult->fetch_assoc()){
  
      $json =($rows['request']);
      $arr = json_decode($json, true);
      $fields = json_decode($arr['fields'], true);

      $json2 =($rows['request']);
      $arr2 = json_decode($json, true);
      $fields2 = json_decode($arr['fields'], true);


        echo "<tr><td>" . $rows['id'] . "</td>
          <td>" . $rows['function'] ."</td>
          <td>" . $fields2['customerUuid'] .  "</td>
          <td>" . $fields['cancelReason'] .  "</td>
          <td>" . $rows['response'] . "</td>
          <td>" . $rows['start'] . "</td>
          <td>" . $rows['end'] . "</td></tr>";

        //   if ($fields['cancelReason'] = 'null') {
        //     echo "Hello";
        // } else {
        //     echo $fields['cancelReason'];
        // }
    }
    echo "</table><br>";
    echo $queryresult->num_rows . " rows selected";

}

?>

</div>
</div>
</div>

<?php include "includes/footer.php"; ?>