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
        function MAX_ID(){
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=poll', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
            $requete=$bdd->query('SELECT * FROM cardPolls');
            $i=0;
            while($res=$requete->fetch()){
                $i++;
            }
            return $i;     
        }
    if(isset($_POST['poll_Vote']) && isset($_POST['option_Vote'])){
        $requete=$bdd->prepare('SELECT * FROM votes WHERE users_idUser=:users_idUser && polls_idPoll=:polls_idPoll');
        $requete->execute(array('users_idUser'=>intval($_SESSION['idUser']),'polls_idPoll'=>intval($_POST['poll_Vote'])));
        if(!$data=$requete->fetch()){
            $requete1=$bdd->prepare('SELECT * FROM options where idOption=:idOption && polls_idPoll=:polls_idPoll');
            $requete1->execute(array('idOption'=>intval($_POST['option_Vote']),'polls_idPoll'=>intval($_POST['poll_Vote'])));
            if($data1=$requete1->fetch()){
                $requete2=$bdd->prepare('SELECT * FROM cardPolls WHERE users_idUser=:users_idUser');
                $requete2->execute(array('users_idUser'=>intval($_SESSION['idUser'])));
                if(!$data2=$requete2->fetch()){
                    $requete3=$bdd->prepare('INSERT INTO cardPolls (users_idUser) VALUES(:users_idUser)');
                    $requete3->execute(array('users_idUser'=>$_SESSION['idUser']));
                }
                else{
                    $MAX_IDENTIFIANT=MAX_ID();
                    $requete4=$bdd->prepare('INSERT INTO votes (users_idUser,options_idOption,cardPolls_idCardPoll,polls_idPoll) VALUES (:users_idUser,:options_idOption,:cardPolls_idCardPoll,:polls_idPoll)');
                    $requete4->execute(array('users_idUser'=>$_SESSION['idUser'],'options_idOption'=>intval($_POST['option_Vote']),'cardPolls_idCardPoll'=>$MAX_IDENTIFIANT,'polls_idPoll'=>intval($_POST['poll_Vote'])));
                }
            }
        }
        }
        header('location:dashbord.php');
?>