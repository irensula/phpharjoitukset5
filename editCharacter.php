<?php
    require "./dbfunctions.php";

    if (isset($_GET["updatecharacterid"])) {
        
        

        $raceID = htmlspecialchars($_GET['hahmon-rotu']);
        $classID = htmlspecialchars($_GET['hahmon-luokka']);
        $name = htmlspecialchars($_GET['hahmon-nimi']);
        $strength = htmlspecialchars($_GET['hahmon-voima']);
        $dexterity = htmlspecialchars($_GET['hahmon-ketteryys']);
        $wisdom = htmlspecialchars($_GET['hahmon-viisaus']);
        $updateCharacter = updateCharacter($_GET['updatecharacterid']);
    }
?>
<!-- edit form -->
<form action="index.php" method="get">
    <label for="hahmon-rotu">Rotu</label>
    <select name="hahmon-rotu" id="hahmon-rotu">
        <?php
            $races = getAllRaces(); 
            foreach($races as $race) { ?>
                echo "<option value="<?= $race["raceID"] ?>"><?= $race["name"] ?></option>"
        <?php } ?>
    </select>

    <label for="hahmon-luokka">Luokka</label>
    <select name="hahmon-luokka" id="hahmon-luokka">
        <?php
        $classes = getAllClasses(); 
        foreach($classes as $class) { ?>
                echo "<option value="<?= $class["classID"] ?>"><?= $class["name"] ?></option>"
        <?php } ?>
    </select>

    <label for="hahmon-nimi">Nimi</label>
    <input type="text" name="hahmon-nimi" id="hahmon-nimi">

    <label for="hahmon-voima">Voima</label>
    <input type="number" name="hahmon-voima" id="hahmon-voima" min="1" max="10">

    <label for="hahmon-ketteryys">Ketteryys</label>
    <input type="number" name="hahmon-ketteryys" id="hahmon-ketteryys" min="1" max="10">

    <label for="hahmon-viisaus">Viisaus</label>
    <input type="number" name="hahmon-viisaus" id="hahmon-viisaus" min="1" max="10">

    <input type="submit" name="update-caharacter-data" value="Päivittää">
</form>