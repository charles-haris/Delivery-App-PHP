<?php
include('connection.php');
$bdd = connect();

$trajet =$bdd->query("select origine,destination,prix_tarif from tarification");
        //decompte 
        $compt1=$trajet->rowCount();
        $tab_t=$trajet->fetchAll();

        
$vehic =$bdd->query("select vehicule,prix from vehicule_tarif ORDER BY prix ASC");
        //decompte 
        $compt2=$vehic->rowCount();
        $tab_v=$vehic->fetchAll();

    

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



      <p><h1 style="color:#39ADB4;" class="text-center">Tableau des prix de livraison</h1></p>
  <input class="form-control text-center" id="myInput" type="text" placeholder="Recherche par trajet (Ex : Dakar - Pikine)">
  <br>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr style="color:#39ADB4;" >
      <th class="th-sm">Trajet

      </th>
      <th class="th-sm">vehicule

      </th>
      <th class="th-sm">Prix

      </th>
     
    </tr>
  </thead>
  <tbody id="myTable" class="text-center">
      
   
        <?php
        
        foreach ($tab_v as $key => $val){ 
                        foreach ($tab_t as $key => $value){  ?>
    <tr>
      <td><?php echo $value['origine']." - ".$value['destination']; ?></td>
      <td><?php echo $val['vehicule']; ?></td>
      <td><?php 
      $prix=$value['prix_tarif']+$val['prix'];
      echo $prix." fcfa";
      ?></td>
      
    </tr>
  <?php
                        }
         }
  ?>

    
  </tbody>
  <tfoot>
    <tr style="color:#39ADB4;" >
      <th>Trajet
      </th>
      <th>vehicule
      </th>
      <th>prix
      </th>
    </tr>
  </tfoot>
</table>
<br>

<center>
    <button class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; "  onclick="goBack()">Retour</button>
</center>



<br>

<script>
// $(document).ready(function () {
//   $('#dtBasicExample').DataTable();
//   $('.dataTables_length').addClass('bs-select');
// });

// Basic example
$(document).ready(function () {
  $('#dtBasicExample').DataTable({
    "paging": false // false to disable pagination (or any other option)
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
function goBack() {
  window.history.back();
}
</script>


