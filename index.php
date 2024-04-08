<?php
    require "./dbfunctions.php";
    
    if(isset($_GET['luokka'])) {
        $luokka = htmlspecialchars($_GET['luokka']);
        $luokat = insertNewClass($luokka);  
     
    } else if (isset($_GET["deletedclassid"])) {
        $ok = deleteClass($_GET['deletedclassid']);

    } else if(isset($_GET['rotu'])) {
        $rotu = htmlspecialchars($_GET['rotu']);
        $rodut = insertNewRace($rotu);  

    } else if (isset($_GET["deletedraceid"])) {
        $deleteRace = deleteRace($_GET['deletedraceid']);
    
    } else if (isset($_GET['hahmon-rotu'], $_GET['hahmon-luokka'], $_GET['hahmon-nimi'], $_GET['hahmon-voima'], $_GET['hahmon-ketteryys'], $_GET['hahmon-viisaus'])) {
        $raceID = htmlspecialchars($_GET['hahmon-rotu']);
        $classID = htmlspecialchars($_GET['hahmon-luokka']);
        $name = htmlspecialchars($_GET['hahmon-nimi']);
        $strength = htmlspecialchars($_GET['hahmon-voima']);
        $dexterity = htmlspecialchars($_GET['hahmon-ketteryys']);
        $wisdom = htmlspecialchars($_GET['hahmon-viisaus']);

        $characters = insertNewCharacter($name, $strength, $dexterity, $wisdom, $classID, $raceID);

    } else if (isset($_GET["characterID"])) {
        $characterID = htmlspecialchars($_GET['characterID']);
        $characterToUpdate = getCharacterById($characterID);
        
        if($characterToUpdate){
            $raceID = $characterToUpdate['hahmon-rotu'];
            $classID = $characterToUpdate['hahmon-luokka'];
            $name = $characterToUpdate['hahmon-nimi'];
            $strength = $characterToUpdate['hahmon-voima'];
            $dexterity = $characterToUpdate['hahmon-ketteryys'];
            $wisdom = $characterToUpdate['hahmon-viisaus'];
            $characterID = $characterToUpdate['characterID'];
            require "/editCharacter.php";
    } 

    } else if (isset($_GET["deletedcharacterid"])) {
        $deletedCharacter = deleteCharacter($_GET['deletedcharacterid']);
    }
?>

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
    <title>Document</title>
</head>
<body>
    <h1>HAHMOT</h1>
    <!-- LUOKAT -->
    <section>
        <h2>Luokat</h2>
        <h3>Lisää luokka</h3>

        <form action="index.php" method="get">
            <label for="luokka">Luokan nimi</label>
            <input class="text-input" type="text" name="luokka">
            <input type='submit' class="button-68" value='Lisää'>
        </form>

        <h3>Luokat</h3>

        <ul>
            <?php
                $classes = getAllClasses();
                foreach($classes as $class) {
                    echo "<li>" . $class["name"] ?>  
                    <form class="delete-link" action='index.php' method='get'>
                    
                        <input type='hidden' name='deletedclassid' value='<?= $class["classID"] ?>'>
                        <input class="delete-button" type='submit' name='submit' value='Poista'>

                    </form>
                </li>
                <?php } ?>
        </ul>
    </section>
    <!-- RODUT -->
    <section>
        <h2>Rodut</h2>
        <h3>Lisää rotu</h3>

        <form action="index.php" method="get">
            <label for="rotu">Luokan nimi</label>
            <input class="text-input" type="text" name="rotu">
            <input class="button-68" type='submit' value='Lisää'>
        </form>

        <h3>Rodut</h3>

        <ul>
            <?php
                $races = getAllRaces();
                foreach($races as $race) {
                    echo "<li>" . $race["name"] ?>  
                    <form class="delete-link" action='index.php' method='get'>

                        <input type='hidden' name='deletedraceid' value='<?= $race["raceID"] ?>'>
                        <input class="delete-button" type='submit' name='submit' value='Poista'>

                    </form>

                </li>
                <?php } ?>
        </ul>
    </section>
    <!-- HAHMOT -->
    <section class="characters-section">
        <h2>Hahmot</h2>
        <h3>Lisää hahmo</h3>

        <form action="index.php" method="get">
            <label for="hahmon-rotu">Rotu</label>
            
            <select name="hahmon-rotu" id="hahmon-rotu">
                <?php foreach($races as $race) { ?>
                        echo "<option value="<?= $race["raceID"] ?>"><?= $race["name"] ?></option>"
                <?php } ?>
            </select><br>

            <label for="hahmon-luokka">Luokka</label>
            <select name="hahmon-luokka" id="hahmon-luokka">
                <?php foreach($classes as $class) { ?>
                        echo "<option value="<?= $class["classID"] ?>"><?= $class["name"] ?></option>"
                <?php } ?>
            </select><br>

            <label for="hahmon-nimi">Nimi</label>
            <input class="text-input" type="text" name="hahmon-nimi" id="hahmon-nimi"><br>

            <label for="hahmon-voima">Voima</label>
            <input class="text-input" type="number" name="hahmon-voima" id="hahmon-voima" min="1" max="10"><br>

            <label for="hahmon-ketteryys">Ketteryys</label>
            <input class="text-input" type="number" name="hahmon-ketteryys" id="hahmon-ketteryys" min="1" max="10"><br>

            <label for="hahmon-viisaus">Viisaus</label>
            <input class="text-input" type="number" name="hahmon-viisaus" id="hahmon-viisaus" min="1" max="10"><br>

            <input type="submit" class="button-68" value="Lisää">
        </form>

        <div class="characters-container">
            <div class="character">

                <?php 
                $characters = getAllCharacters();
                foreach($characters as $character) { ?>
                <div class="character-card">
                <h3 class="name-title"><?= $character["name"] ?></h3>
                
                <p>Luokka: <?= $character["className"] ?></p>

                <p>Rotu: <?= $character["raceName"] ?></p>
                    <ul>
                        <li>Voima: <?= $character["strength"] ?></li>
                        <li>Ketteryys: <?= $character["dexterity"] ?></li>
                        <li>Viisaus: <?= $character["wisdom"] ?></li>
                    </ul>

                    <form class="edit-link" action='/editCharacter.php' method='get'>
                        <input type='hidden' name='characterID' value='<?= $character["characterID"] ?>'>
                        <button class="delete-button" type="submit">Muokkaa</button>
                    </form>
                    <!-- <a href='/editCharacter.php?id=<?=$character["characterID"]?>'>Päivitä</a> -->

                    <form class="deleted-link" action='index.php' method='get'>
                        <input type='hidden' name='deletedcharacterid' value='<?= $character["characterID"] ?>'>
                        <input class="delete-button" type='submit' name='submit' value='Poista'>
                    </form>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </section>
</body>
</html>