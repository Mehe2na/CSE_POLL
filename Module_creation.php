<?php
        try
        {
         $bdd = new PDO('mysql:host=localhost;dbname=poll', 'root', '');
        }
        catch(Exception $e)
        {
         die('Erreur : '.$e->getMessage());
        }
	    if(isset($_POST['nom']) && isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['passwd1'])){    
		    $requete=$bdd->prepare('SELECT * FROM users where Login=:Login');
			$requete->execute(array('Login'=>$_POST['login']));
			if($donnee=$requete->fetch() ){
				echo"<h1>Compte existant déjà</h1><br>";
				?>
			<form method="POST" action="Register.php">
				<button class="btn" type="submit"> Corriger </button>
			</form>
			<?php
			}
			else{
				if($_POST['passwd']==$_POST['passwd1']){
				$requete1=$bdd->prepare('INSERT INTO users (Login,Password,FullName) VALUES (:Login,:Password,:FullName)');
				$requete1->execute(array('Login'=>$_POST['login'],'Password'=>$_POST['passwd'],'FullName'=>$_POST['nom']));
				header('location:Connexion.php');
			}
			}
		}
		else{	
			header('location:Register.php');
		}
?>