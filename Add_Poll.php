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
        if ($_SESSION['logged']==false) {
        	header('Location:Connexion.php');
        }
        if(isset($_POST['poll_toAdd'])){
        $requete=$bdd->prepare('SELECT FROM polls where PollName=:PollName');
        $requete->execute(array('PollName'=>$_POST['poll_toAdd']));
        if(!$data=$requete->fetch()){
                $requete1=$bdd->prepare('INSERT INTO polls (PollName,users_idUser) VALUES(:PollName,:users_idUser)');
                $requete1->execute(array('PollName'=>$_POST['poll_toAdd'],'users_idUser'=>$_SESSION['idUser']));
                header('location:dashbord.php');
        }
        }
        header('location:dashbord.php');
?>