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
        if(isset($_POST['option_toAdd']) && isset($_POST['poll_id'])){
        $option=$_POST['option_toAdd'];
        $pollid=intval($_POST['poll_id']);
        $requete=$bdd->prepare('SELECT FROM polls where idPoll=:idPoll');
        $requete->execute(array('idPoll'=>$pollid));
        if(!$data=$requete->fetch()){
            $requete1=$bdd->prepare('SELECT FROM options where OptionName=:OptionName');
            $requete1->execute(array('OptionName'=>$_POST['option_toAdd']));
            if(!$data1=$requete1->fetch()){
                $requete2=$bdd->prepare('INSERT INTO options (OptionName,polls_idPoll,users_idUser) VALUES(:OptionName,:polls_idPoll,:users_idUser)');
                $requete2->execute(array('OptionName'=>$_POST['option_toAdd'],'polls_idPoll'=>$_POST['poll_id'],'users_idUser'=>$_SESSION['idUser']));
                header('location:dashbord.php');
            }
        }
        }
        header('location:dashbord.php');
?>