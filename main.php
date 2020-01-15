<?php include "includes/db.php";?>
<?php include "includes/header.php"; ?>
<?php include "includes/nav_bar.php"; ?>

<script>

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

<section id='tables'>
<div class="container">
    <div class="row">
        <div class="col-sm-12">

        <h2> Customers </h2> 

 <div class="col-md-4 offset-md-4 mt-5 border-success pt-0">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search for name or email..." aria-label="Search" id="myInput" onkeyup="myFunction()">
  <div class="input-group-append">
    <span class="input-group-text"><i class="fa fa-search"></i></span>
  </div>
  </div>
</div>

<?php


$sqlquery = "SELECT * FROM user_details";     //GROUP BY .... DESC;
$queryresult = $connection->query($sqlquery);

$count = 0;


if($queryresult->num_rows > 0) {
    echo "<br><table id='myTable' class='table table-striped table-bordered'>
    <th>user_id</th>
    <th>username</th>
    <th>first_name</th>
    <th>last_name</th>
    <th>gender</th>
    <th>password</th>
    <th>status</th>";

    while($rows = $queryresult->fetch_assoc()){
   echo "<tr>
            <td>" . $rows['user_id'] ."</td>
            <td>" . $rows['username'] ."</td>
            <td>" . $rows['first_name'] . "</td>
            <td>" . $rows['last_name'] ."</td>
            <td>" . $rows['gender'] . "</td>
            <td>" . $rows['password'] . "</td>
            <td>" . $rows['status'] . "</td>

        </tr>";

       
        $count ++;
    }
    echo "</table><br>";
    echo $count . " rows selected";

}

?> <br> <hr>



</div>
</div>


<!-- TEMPLATE SEARCH CONTINUE -->

<div class="row">
        <div class="col-sm-12" id="result">
        </div>
</div>

</div>
  </section>


<?php include "includes/footer.php"; ?>


