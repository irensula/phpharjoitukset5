<?php
    require "./dbfunctions.php";
    if (isset($_GET["characterID"])) {
        $id = htmlspecialchars($_GET['characterID']);
        $characterToUpdate = getCharacterById($id);
        
        if($characterToUpdate){
            $raceID = $characterToUpdate['raceID'];
            $classID = $characterToUpdate['classID'];
            $name = $characterToUpdate['name'];
            $strength = $characterToUpdate['strength'];
            $dexterity = $characterToUpdate['dexterity'];
            $wisdom = $characterToUpdate['wisdom'];
            $id = $characterToUpdate['characterID'];
        } 
    } 
    if (isset($_POST["updateCharacterData"])){

        $name = htmlspecialchars($_POST['name']);
        $strength = htmlspecialchars($_POST['strength']);
        $dexterity = htmlspecialchars($_POST['dexterity']);
        $wisdom = htmlspecialchars($_POST['wisdom']);
        $raceID = htmlspecialchars($_POST['raceID']);
        $classID = htmlspecialchars($_POST['classID']);
        $id = htmlspecialchars($_POST['id']);
        updateCharacter($name, $strength, $dexterity, $wisdom, $classID, $raceID, $id); 
        header('Location: index.php');
    }
?>

<!-- edit form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Eagle+Lake&family=MedievalSharp&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Muokka hahmo</title>
</head>
<body>
    <div class="edit-character-container">
        <h2 class="title">Muokka hahmo</h2>
        <form action="/editCharacter.php" method="post">
            <label for="raceID">Rotu</label>
            <select name="raceID" id="raceID">
                <?php
                    $races = getAllRaces(); 
                    foreach($races as $race) { ?>
                        echo "<option value="<?= $race["raceID"] ?>"><?= $race["name"] ?></option>"
                <?php } ?>
            </select><br>

            <label for="classID">Luokka</label>
            <select name="classID" id="classID">
                <?php
                $classes = getAllClasses(); 
                foreach($classes as $class) { ?>
                        echo "<option value="<?= $class["classID"] ?>"><?= $class["name"] ?></option>"
                <?php } ?>
            </select><br>
        
            <label for="name">Nimi</label>
            <input class="text-input" type="text" name="name" id="name" value=<?=$name?>><br>

            <label for="strength">Voima</label>
            <input class="text-input"type="number" name="strength" id="strength" min="1" max="10" value=<?=$strength?>><br>

            <label for="dexterity">Ketteryys</label>
            <input class="text-input"type="number" name="dexterity" id="dexterity" min="1" max="10" value=<?=$dexterity?>><br>

            <label for="wisdom">Viisaus</label>
            <input class="text-input"type="number" name="wisdom" id="wisdom" min="1" max="10" value=<?=$wisdom?>><br>

            
            <input type="hidden" name="id" id="id" min="1" max="10" value=<?=$id?>><br>
            
            <input class="button-68" type="submit" name="updateCharacterData" value="Päivittää">

        </form>
                </div>
</body>
</html>
