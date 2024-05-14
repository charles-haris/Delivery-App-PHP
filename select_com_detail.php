<?php  
//select.php  
if(isset($_POST["employee_id"]))
{
 $output = '';
 include 'connection.php';
 $query = "SELECT * FROM livraison WHERE IDCOLIS = '".$_POST["employee_id"]."'";
 $result = $connect->query($query);
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
    while($row = $result->fetch())
    {
     $output .= '
     <tr>  
            <td width="30%"><label>TYPE DE COLIS</label></td>  
            <td width="70%">'.$row["typescolis"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>POIDS</label></td>  
            <td width="70%">'.$row["poids"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>VOLUME</label></td>  
            <td width="70%">'.$row["volume"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>ORIGINE</label></td>  
            <td width="70%">'.$row["adresseOrig"].'</td>  
        </tr>
        <tr>  
            <td width="30%"><label>DESTINATION</label></td>  
            <td width="70%">'.$row["adresseLivraison"].'</td>  
        </tr>
         <tr>  
            <td width="30%"><label>NOMBRE DE COLIS</label></td>  
            <td width="70%">'.$row["nbColis"].'</td>  
        </tr>
         <tr>  
            <td width="30%"><label>DESCRIPTION</label></td>  
            <td width="70%">'.$row["Description"].'</td>  
        </tr>
         <tr>  
            <td width="30%"><label>PRIX</label></td>  
            <td width="70%">1000</td>  
        </tr>
     ';
    }
    $output .= '</table></div>';
    echo $output;
}
?>