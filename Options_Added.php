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
    <title>Options ajoutées</title>
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
            <th>OPTION</th>
            <th>IDENTIFICATEUR</th>
            <th>AJOUTEE AU SONDAGE</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $requete=$bdd->prepare('SELECT * FROM options where users_idUser=:users_idUser');
            $requete->execute(array('users_idUser'=>$_SESSION['idUser']));
            while($data=$requete->fetch()){
             ?>
            <tr>
            <td> <?php echo($data['OptionName']) ?> </td>
            <td> <?php echo($data['idOption']) ?> </td>
            <td> <?php echo($data['polls_idPoll']) ?> </td>
            </tr>
            <?php 
            }
             ?>
            </tbody>
        </table>
    </div>

</body>
</html>