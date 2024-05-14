<?php
if(isset($_POST['passer'])){
    
    	    ?>
	    <script>
	                    document.location.href="login.php";
	    </script>
	    <?php

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>TOUT LIVRER</title>
    <meta name="description" content="tout livrer! livraison dakar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="fr">

        <link rel="stylesheet"
          href="css/style_toutlivrer.css"
          type="text/css">
          
          <link rel="stylesheet"
          href="css/icofont.css"
          type="text/css">
          
          <link href="css/styleperso1.css" rel="stylesheet">
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
          
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


        


    
        <meta name="rating" content="General">

            </head>
<style>
#pied_page{
    width:2000px;
    margin:0;
    padding:0;
    background-color:blue;
    height: 30px;

    
}

.templatemo-site-header { margin: 25px 30px; }
.templatemo-site-header h1 {
    color: white;
	display: inline-block;
	font-size: 1.8em;
	font-weight: 300;
	letter-spacing: 1.5px;
	margin: 0 5px;	
	text-transform: uppercase;
    vertical-align: middle;

    
}

.hr_top {
    overflow: visible; /* For IE */
    height: 30px;
    border-style: solid;
    border-color: white;
    border-width: 1px 0 0 0;
    border-radius: 20px;
}
.hr_top { /* Not really supposed to work, but does */
    border: 0;
    height: 1px;

    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(255, 255, 255, 0.75), rgba(0, 0, 0, 0));
}

.hr_card { /* Not really supposed to work, but does */
    border: 0;
    height: 1px;

    background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgb(57, 173, 180,0.75), rgba(255, 255, 255, 0));
} 
#connexion{
    float:right; 
    font-size:20px;
}
#connexion:hover{
    color: #39ADB4;
}

@media (min-width:375px){.templatemo-site-header h1{  
    
	font-size: 1.8em;
	font-weight: 300;
	letter-spacing: 1.1px;
	margin: 0 3px;	
	text-transform: uppercase;
    vertical-align: middle;}}
    @media (min-width:375px){.templatemo-site-header{  
    
	margin: 5px 10px;}}
    
@media (min-width:375px){#connexion{
    margin-top:5px;
    margin-left:2px;

    font-size:14px}}
@media (min-width:675px){#connexion{font-size:17px}}

@media (min-width:475px){#connexion{font-size:15px}}


.section_head{
    
    margin-top:30px;
    padding: 15px;
    background-color: rgba(0,0,0, 0.4);}
    
    .footer{
  background: #152F4F;
  color:white;
  
  .links{
    ul {list-style-type: none;}
    li a{
      color: white;
      transition: color .2s;
      &:hover{
        text-decoration:none;
        color:#4180CB;
        }
    }
  }  
  .about-company{
    i{font-size: 25px;}
    a{
      color:white;
      transition: color .2s;
      &:hover{color:#4180CB}
    }
  } 
  .location{
    i{font-size: 18px;}
  }
  .copyright p{border-top:1px solid rgba(255,255,255,.1);} 
}
</style>

<body class="step1 welcome">
    <header class="main-header main-header--background-cover background-cover__sushi">
        <div class="topbar-container">
    <div class="topbar">
        <div class="topbar__logo">
            <a href="/" class=" js-go-back-button">
                <div class="small-logo"></div>
                <span class="wai_screenreader">Retour</span>
                <div class="large-logo-container">
                <header class="templatemo-site-header">
                     <div class="square"></div>
                     <h1>APP-LIV</h1>
          <div class="square"></div>                     
                     <a id="connexion" href="login.php" class="white-text">Se Connecter ?</a>

                </header>
            </div>
            </a>
        </div>
       
        
    </div>
    </div>
    <div class="header-container">
    <div class="header-top">
        <div class="header">
            <div class="section_head">
                        <br>

                        <h1 class="header__title">Faites-vous livrer!</h1>

                        <hr_top>
                        <br>

                        <h2 class="header__subtitle">Rapidement et en toute sécurité !</h2> 
                        <br>
                        <form method="post">
                        <button type="submit" name="passer" class="templatemo-blue-button ">Demander une livraison</button>
                        </form>
            </div>

            
    </div>
    
    <div class="subheader">
        <div class="subheader__slope"></div>
        <div class="js-random-class subheader__image"
             data-classes="subheader__image--pizza,subheader__image--pizza-light,subheader__image--hamburger,subheader__image--sushi,subheader__image--variety">
        </div>
    </div>
</div>
    </header>

<div id="userpanel" class="userpanel ">
        <div class="inner">
        <div class="modal-wrapper modal" role="dialog" aria-labelledby="modal-title">
            <div class="modal-content">
                <div id="userpanel-wrapper" class="userpanel__wrapper submenu"></div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="benefits">
    <div class="benefits__wrapper">
        <div class="benefits__header">
            Vos avantages avec <span class="benefits__site-name">TOUTLIVRER</span>        </div>

        <div class="box">
            
            <div class="box__icon" data-icon=""><img src="images/delivery-man.png" width="50" height="50">
</div>
            <br/>

            <ul class="box__list">
                                <li data-icon=""><img class="" src="images/tick.png" width="20" height="20">
Prise en charge , suivi, sécurisation de votre livraison</li>

                                <li  data-icon=""><img src="images/tick.png" width="20" height="20"> Prix abordable</li>
                                <li data-icon=""><img src="images/tick.png" width="20" height="20">  Devenir partenaire</li>
                                <li data-icon=""><img src="images/tick.png" width="20" height="20">  Commande directe par téléphone
</li>
                            </ul>
        </div>

        <div class="benefits__faq">
            <a href="/service-clientele"></a>
        </div>
    </div>
</div>


<div class="content-steps">
  <section class="steps-inner">


    <h3 class="steps-subheadline">Comment ça marche ?</h3>
    <h4 class="steps-mainheadline">Demander une livraison</h4>
    <br>
    <div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="images/inscrp_conn.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title text-center" style="color:rgb(57, 173, 180);">1 ère étape</h5>
      <hr class="hr_card">

      <p class="card-text">créez un compte et connectez-vous grâce à votre identifiant et votre mot de passe.
</p>
    </div>
    <div class="card-footer text-center">
    <small class="text-muted"><a href="page_client.php" >je crée mon compte</a></small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="images/livraison_2.jpg" alt="Card image cap">
    <div class="card-body">
        <br>
    <h5 class="card-title text-center" style="color:rgb(57, 173, 180);">2 ème étape</h5>
      <hr class="hr_card">

      <p class="card-text">Renseignez les détails concernant la livraison et lancez votre demande de livraison.
</p>
    </div>
    <!--<div class="card-footer text-center">
    <small class="text-muted"><a href="login.php" >je me connecte</a></small>
    </div>-->
  </div>
  <div class="card">
    <img class="card-img-top" src="images/livraison_paiemen.png" alt="Card image cap">
    <div class="card-body">
        <br>
    <h5 class="card-title text-center" style="color:rgb(57, 173, 180);">3 ème étape</h5>
      <hr class="hr_card">

      <p class="card-text">Payez à la livraison.</p>
    </div>
   
  </div>
    </section>

</div>
    


    <div class="content-steps">
 

  
</div> 
<!--<div class="content-steps">
  <section class="steps-inner">
    <h4 class="steps-mainheadline">Je suis un livreur</h4>
    <br>
    <div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="images/livraison_1.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title text-center" style="color:rgb(57, 173, 180);">créer mon compte</h5>
      <hr class="hr_card">

      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
    <div class="card-footer text-center">
    <small class="text-muted"><a href="page_client.php" >je crée mon compte en tant que livreur</a></small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="images/livraison_1.jpg" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-title text-center" style="color:rgb(57, 173, 180);">Prendre une commande</h5>
      <hr class="hr_card">

      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer text-center">
      <small class="text-muted"><a href="login.php" >je me connecte</a></small>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="images/livraison_1.jpg" alt="Card image cap">
    <div class="card-body">
    <h5 class="card-title text-center" style="color:rgb(57, 173, 180);">livrer et se faire du profit</h5>
      <hr class="hr_card">

      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer text-center">
    <small class="text-muted"><a href="login.php" >je me connecte</a></small>
    </div>
  </div>
  </section>-->
</div>
    


    <div class="content-steps">
  <section class="steps-inner">

 
  </section>

 
</div>







<div class="hidden javascript">
    

       
    </div>
    
    
<div class="mt-1 pt-1 pb-4 footer">
<div class="container ">
  <!--<div class="row">
    <!--<div class="col-lg-5 col-xs-12 about-company">
                       <div class="large-logo-container">
                <header class="templatemo-site-header">
                     <div class="square"></div>
                     <h1>TOUTLIVRER</h1> 
                     
                   

                </header>
            </div>
      
      <p class="pr-5 text-white-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ante mollis quam tristique convallis </p>
      <p><a href="#"><i class="fa fa-facebook-square mr-1"></i></a><a href="#"><i class="fa fa-linkedin-square"></i></a></p>
    </div>
   <!-- <div class="col-lg-3 col-xs-12 links">
      <h4 class="mt-lg-0 mt-sm-3">Links</h4>
        <ul class="m-0 p-0">
          <li>- <a href="#">Lorem ipsum</a></li>
          <li>- <a href="#">Nam mauris velit</a></li>
          <li>- <a href="#">Etiam vitae mauris</a></li>
          <li>- <a href="#">Fusce scelerisque</a></li>
          <li>- <a href="#">Sed faucibus</a></li>
          <li>- <a href="#">Mauris efficitur nulla</a></li>
        </ul>
    </div>-->
    <!--<div class="col-lg-4 col-xs-12 location">
      <h4 class="mt-lg-0 mt-sm-4">Location</h4>
      <p>22, Lorem ipsum dolor, consectetur adipiscing</p>
      <p class="mb-0"><i class="fa fa-phone mr-3"></i>(541) 754-3010</p>
      <p><i class="fa fa-envelope-o mr-3"></i>info@hsdf.com</p>
    </div>--
    Editer par BOUASSE BU KOMBILE Charles-Haris
  </div>-->
  <div class="row mt-4">
    <div class="col copyright">
        <div class="float-left"><header class="templatemo-site-header">
                     <div class="square"></div>
                     <a href="http://toutlivrer.com/"><h1>TOUTLIVRER</h1> </a>
                   

                </header></div>
      <div class="float-right mt-2"><p class=""><small class="text-white-50">            <?php include ("foot.php"); ?>
 </small></p>
      </div>
    </div>
  </div>
</div>
</div>

  





</body>
</html>


