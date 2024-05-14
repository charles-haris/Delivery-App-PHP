<?php
class GereImg{

	

		public function erreurTransfer($photoError){

			
			if($photoError>0){
				$error='erreur lors du transfert';
			}else{
				$error='';

			}
			return $error;
		}


		public function size($photoSize){
			

			if ($photoSize>2048576){
				$error='le fichier est trop volumineux pour ce que vous devez charger';
			}else{
				$error='';
			}
			return $error;
		}


			public function controlExtension($photoName){
				
			$extensions_valides = array( 'jpg' , 'jpeg'  , 'png' );

			$extension_upload = strtolower(  substr(  strrchr($photoName,'.')  ,1)  );

			if ( in_array($extension_upload,$extensions_valides) ){

				$msg = "";
			}
			else
			{
				$msg = 'Extension incorrecte';
			}
				return $msg;
			}



	
		

}