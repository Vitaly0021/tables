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

$(() => {
  var clicked = false, clickY;
  $(document).on({
      'mousemove': function(e) {
          clicked && updateScrollPos(e);
      },
      'mousedown': function(e) {
          clicked = true;
          clickY = e.pageY;
      },
      'mouseup': function() {
          clicked = false;
          $('html').css('cursor', 'auto');
      }
  });

  var updateScrollPos = function(e) {
      $('html').css('cursor', 'grab');
      $(window).scrollTop($(window).scrollTop() + (clickY - e.pageY));
  }

  let el = document.querySelector("table");
  let x = 0, y = 0, _tableTop = 0, left = 0;

  let draggingFunction = (e) => {
      document.addEventListener('mouseup', () => {
          document.removeEventListener("mousemove", draggingFunction);
      });

      el.scrollLeft = left - e.pageX + x;
      el.scrollTop = _tableTop - e.pageY + y;
  };

  el.addEventListener('mousedown', (e) => {
      e.preventDefault();

      y = e.pageY;
      x = e.pageX;
      _tableTop = el.scrollTop;
      left = el.scrollLeft;

      document.addEventListener('mousemove', draggingFunction);
  });
});


</script>

<div class="container">
    <div class="row">
        <div class="col-sm-12">

        <h2>Customers</h2>

        <div class="col-md-4 offset-md-4 mt-5 border-success pt-0">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search for name or email..." aria-label="Search" id="myInput" onkeyup="myFunction()">
  <div class="input-group-append">
    <span class="input-group-text"><i class="fa fa-search"></i></span>
  </div>
  </div>
</div>

<?php

$sqlquery = "SELECT * FROM customers GROUP BY updated_at DESC"; 
$queryresult = $connection->query($sqlquery);

$count = 0;

$test = [];

if($queryresult->num_rows > 0) {
    echo "<br><table id='myTable' class='table-responsive table-striped table-bordered'>
    <th>id</th>
    <th>uuid</th>
    <th>email</th>
    <th>first_name</th>
    <th>middle_name</th>
    <th>last_name</th>
    <th>dob</th>
    <th>address</th>
    <th>document_type</th>
    <th>document_id</th>
    <th>document</th>
    <th>phone</th>
    <th>address_proof_document</th>
    <th>product</th>
    <th>created_at</th>
    <th>updated_at</th>";

    while($rows = $queryresult->fetch_assoc()){
        $test []= $rows['first_name'];
   echo "<tr><td>" . $rows['id'] .
        "</td><td>" . $rows['uuid'] .
        "</td><td>" . $rows['email'] . 
        "</td><td>" . $rows['first_name'] .
        "</td><td>" . $rows['middle_name'] . 
        "</td><td>" . $rows['last_name'] .  
        "</td><td>" . $rows['dob'] . 
        "</td><td>" . $rows['address'] .
        "</td><td>" . $rows['document_type'] .  
        "</td><td>" . $rows['document_id'] .  
        "</td><td>" . $rows['document'] . 
        "</td><td>" . $rows['phone'] .  
        "</td><td>" . $rows['address_proof_document'] . 
        "</td><td>" . $rows['product'] .  
        "</td><td>" . $rows['created_at'] . 
        "</td><td>" . $rows['updated_at'] .
        "</td></tr>";

        $count ++;
    }
    echo "</table><br>";
    echo $count . " rows selected";

}

?>

</div>
</div>
</div>

<?php include "includes/footer.php"; ?>

