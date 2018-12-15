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
    <title>Sondages ajoutés</title>
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
            <th>SONDAGE</th>
            <th>IDENTIFICATEUR</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $requete=$bdd->prepare('SELECT * FROM polls where users_idUser=:users_idUser');
            $requete->execute(array('users_idUser'=>$_SESSION['idUser']));
            while($data=$requete->fetch()){
             ?>
            <tr>
            <td> <?php echo($data['PollName']) ?> </td>
            <td> <?php echo($data['idPoll']) ?> </td>
            </tr>
            <?php 
            }
             ?>
            </tbody>
        </table>
    </div>

</body>
</html>