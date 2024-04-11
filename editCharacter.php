<?php
    require "./dbfunctions.php";
    if(isset($_GET["characterID"])){
        $characterID = $_GET["characterID"];
        $character = getCharacterById($characterID);
         
        echo $character["name"] . "<br>";
    }
    else if (isset($_POST['hahmon-rotu'], $_POST['hahmon-luokka'], $_POST['hahmon-nimi'], $_POST['hahmon-voima'], $_POST['hahmon-ketteryys'], $_POST['hahmon-viisaus'], $_POST['characterID'])) { 
       
        $raceID = htmlspecialchars($_POST['hahmon-rotu']);
        $classID = htmlspecialchars($_POST['hahmon-luokka']);
        $name = htmlspecialchars($_POST['hahmon-nimi']);
        $strength = htmlspecialchars($_POST['hahmon-voima']);
        $dexterity = htmlspecialchars($_POST['hahmon-ketteryys']);
        $wisdom = htmlspecialchars($_POST['hahmon-viisaus']);
        $characterID = htmlspecialchars($_POST['characterID']);
        updateCharacter($name, $strength, $dexterity, $wisdom, $classID, $raceID, $characterID);
        echo "$name";
    }
?>
<?php echo $character["strength"]; ?>
<!-- edit form -->
<form action="/editCharacter.php" method="post">
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
    <input type="text" name="hahmon-nimi" id="hahmon-nimi" >

    <label for="hahmon-voima">Voima</label>
    <input type="number" name="hahmon-voima" id="hahmon-voima" min="1" max="10">

    <label for="hahmon-ketteryys">Ketteryys</label>
    <input type="number" name="hahmon-ketteryys" id="hahmon-ketteryys" min="1" max="10" >

    <label for="hahmon-viisaus">Viisaus</label>
    <input type="number" name="hahmon-viisaus" id="hahmon-viisaus" min="1" max="10" >
    
    <input type="submit" name="update-character-data" value="Päivittää">

</form>

<?php 
// $update = updateCharacter('Johnathan', 9, 4, 3, 2, 2, 23); 
// echo $update;
?>
