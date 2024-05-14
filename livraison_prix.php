<?php

$vehicul=strtolower($_POST["TypeVehicule"]);
$price_comm="";
$prix_veh=0;

if($_POST['zone1']==$_POST['zone2']){
    $price_comm=2000;
}else{

$bdd = connect();
$requeteSql=$bdd->query("select * from tarification");

$requeteSql->bindColumn('id',$id);
$requeteSql->bindColumn('origine',$zoneA);
$requeteSql->bindColumn('destination',$zoneB);
$requeteSql->bindColumn('prix_tarif',$price_command);

while ($requeteSql->fetch()){
    if(($_POST['zone1']==$zoneA && $_POST['zone2']==$zoneB)||($_POST['zone1']==$zoneB && $_POST['zone2']==$zoneA)){
        $price_comm=$price_command;    
    }
}
}

$requeteSql=$bdd->query("select * from vehicule_tarif");

$requeteSql->bindColumn('id',$id);
$requeteSql->bindColumn('vehicule',$vehicule_comm);
$requeteSql->bindColumn('prix',$prix_vehicule);

while ($requeteSql->fetch()){
    if($vehicul==$vehicule_comm){
        $prix_veh=$prix_vehicule;
    }
}



/* if(($_POST['zone1']=='DAKAR' && $_POST['zone2']=='PIKINE')||($_POST['zone1']=='PIKINE' && $_POST['zone2']=='DAKAR')){
    $price_comm=3000;    
}
if(($_POST['zone1']=='DAKAR' && $_POST['zone2']=='GUEDIAWAYE')||($_POST['zone1']=='GUEDIAWAYE' && $_POST['zone2']=='DAKAR')){
    $price_comm=4000;
}
if(($_POST['zone1']=='DAKAR' && $_POST['zone2']=='RUFISQUE')||($_POST['zone1']=='RUFISQUE' && $_POST['zone2']=='DAKAR')){
    $price_comm=5000;    
}
if(($_POST['zone1']=='PIKINE' && $_POST['zone2']=='GUEDIAWAYE')||($_POST['zone1']=='GUEDIAWAYE' && $_POST['zone2']=='PIKINE')){
    $price_comm=3000;
}
if(($_POST['zone1']=='PIKINE' && $_POST['zone2']=='RUFISQUE')||($_POST['zone1']=='RUFISQUE' && $_POST['zone2']=='PIKINE')){
    $price_comm=4000;    
}
if(($_POST['zone1']=='GUEDIAWAYE' && $_POST['zone2']=='RUFISQUE')||($_POST['zone1']=='RUFISQUE' && $_POST['zone2']=='GUEDIAWAYE')){
    $price_comm=4000;
} 

$tab_prix=[
    
    "moto a trois rois"=>"5000",
    "fourgonnette"=>"7000",
    "grand fourgon"=>"9000",
    "camionnette"=>"15000",
    "petit camion"=>"15000",
    "camion poids lourd 5t"=>"35000",
    "camion poids lourd 10t"=>"45000",
    "camion poids lourd (semi-remorque)"=>"65000"
];
// for(int $i=0;$i<strlen($tab_prix);$i++){
//     if($vehicul==$tab_prix[$i]){
//         $prix_veh=$tab_prix[$vehicul]
//     } 
// }

foreach ($tab_prix as $key => $value) {
    if($vehicul==$key){
        $prix_veh=$value;
    } 
}*/

$prix_command=$price_comm+$prix_veh;



?>