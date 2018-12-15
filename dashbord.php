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
	<title>Votes</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
    <?php include('./includes/header_user.php'); ?>
    <div class="UserInfo">
    	<?php include('./includes/User_informations.php'); ?>
    </div>
    <div class="ConnexionForm">
        <form method="post" action="Vote.php">
            <p>Voter</p>
            <div>
            <label>Identificateur du sondage ( numéro )</label>
            <input type="text" name="poll_Vote">
            </div>
            <div>
            <label>Option à choisir (numéro)</label>
            <input type="text" name="option_Vote">
            </div>
            <button class="btn" type="submit">Voter</button>
        </form>   
    </div>
    <?php 
        $requete=$bdd->query('SELECT * FROM polls');
        while($data=$requete->fetch()){
    ?>
    <div class='Poll'>
    	<p> <?php echo($data['idPoll']); echo" - ";echo($data['PollName']); ?> </p>
        <?php  
            $requete1=$bdd->prepare('SELECT * FROM options');
            //$requete1->execute(array('polls_idPoll'=>intval($data['idPoll'])));
            $requete1->execute(array());
            while($data1=$requete1->fetch()){
            if(intval($data['idPoll'])-$data1['polls_idPoll']==0){
        ?>
    	<li class="Option"><?php echo($data1['idOption']); echo" - "; echo($data1['OptionName']); ?></li>
        <?php 
        }
        }
        ?>
    </div>
    <?php 
    }
    ?>

    <div>
        <div class="ConnexionForm">
            <form method="post" action="Add_Poll.php">
                <div>
                    <label>Sondage à ajouter</label>
                    <input type="text" name="poll_toAdd">
                    <button class="btn" type="submit">Ajouter</button>
                </div>
            </form>
        </div>
        <div class="ConnexionForm">
            <form method="post" action="Add_Option.php">
                <div>  
                <label>Ajouter une Option</label>
                <input type="text" name="option_toAdd">
                </div>
                <div>
                <label>Identificateur du sondage</label>
                <input type="text" name="poll_id">
                </div>
                <br>
                <button class="btn" type="submit">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>