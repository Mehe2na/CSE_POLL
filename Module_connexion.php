<?php
		session_start(); 
        try
        {
         $bdd = new PDO('mysql:host=localhost;dbname=poll', 'root', '');
        }
        catch(Exception $e)
        {
         die('Erreur : '.$e->getMessage());
        }
	    if(isset($_POST['login']) && isset($_POST['passwd'])){    
		    $requete=$bdd->prepare('SELECT * FROM users where Login=:Login && Password=:Password');
			$requete->execute(array('Login'=>$_POST['login'],'Password'=>$_POST['passwd']));
			while($donnee=$requete->fetch()){
				session_start();
				$_SESSION['logged']=true;
				$_SESSION['idUser']=$donnee['idUser'];
				$_SESSION['login']=$_POST['login'];
				$_SESSION['FullName']=$donnee['FullName'];
				$requete->closeCursor();
				header('location:dashbord.php');
			}
		}
		else{	
			header('location:Connexion.php');
		}
?>