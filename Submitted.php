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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Votes effectués</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<?php include('./includes/header_user.php'); ?>
    <div class="UserInfo">
    	<?php include('./includes/User_informations.php'); ?>
    </div>
    <div>
    	<table>
            <thead>
            <tr>
            <th>IDENTIFICATEUR DU SONDAGE</th>
            <th>OPTION CHOISIE</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $requete=$bdd->prepare('SELECT  * FROM cardPolls WHERE users_idUser=:users_idUser');
			$requete->execute(array('users_idUser'=>$_SESSION['idUser']));
			while($data=$requete->fetch()){
				$requete1=$bdd->prepare('SELECT * FROM votes WHERE cardPolls_idCardPoll=:cardPolls_idCardPoll');
				$requete1->execute(array('cardPolls_idCardPoll'=>$data['idCardPoll']));
				while($data1=$requete1->fetch()){
					$requete2=$bdd->prepare('SELECT * FROM options where idOption=:idOption');
					$requete2->execute(array('idOption'=>$data1['options_idOption']));
					while($data2=$requete2->fetch()){
	             ?>	
		        <tr>
		        <td> <?php echo($data2['polls_idPoll']) ?> </td>
		        <td> <?php echo($data2['idOption']);echo" - ";echo($data2['OptionName']); ?> </td>
		        </tr>
		        <?php
		    } 
		    }
	    	}
	         ?>
	        </tbody>
        </table>
    </div>

</body>
</html>