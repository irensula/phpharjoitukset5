<?php
    require "./dbfunctions.php";
    if(isset($_GET['luokka'])) {
        $luokka = htmlspecialchars($_GET['luokka']);
        $luokat = insertNewClass($luokka);
        
     } else if (isset($_GET["deletedclassid"])) {
        $ok = deleteClass($_GET['deletedclassid']);

    } else if (isset($_GET['hahmon-nimi'], $_GET['hahmon-voima'], $_GET['hahmon-ketteryys'], $_GET['hahmon-viisaus'])) {
        $hahmonNimi = htmlspecialchars($_GET['hahmon-nimi']);
        $hahmonVoima = htmlspecialchars($_GET['hahmon-voima']);
        $hahmonKetteryys = htmlspecialchars($_GET['hahmon-ketteryys']);
        $hahmonViisaus = htmlspecialchars($_GET['hahmon-viisaus']);
        $newCharacter = insertNewCharacter($hahmonNimi, $hahmonVoima, $hahmonKetteryys, $hahmonViisaus);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <!-- LUOKAT -->
    <h2>Luokat</h2>
    <h3>Lisää luokka</h3>

    <form action="index.php" method="get">
        <label for="luokka">Luokan nimi</label>
        <input type="text" name="luokka">
        <input type='submit' value='Lisää'>
    </form>

    <h3>Luokat</h3>

    <ul>
        <?php
            $classes = getAllClasses();
            foreach($classes as $class) {
                echo "<li>" . $class["name"] ?>  
                <form class="delete-link" action='index.php' method='get'>
                
                <input type='hidden' name='deletedclassid' value='<?= $class["classID"] ?>'>
                    <input class="delete-class-button" type='submit' name='submit' value='Poista'>
                </form>

            </li>
            <?php } ?>
    </ul>
    
    <!-- HAHMOT -->
    <h2>Hahmot</h2>
    <h3>Lisää hahmo</h3>

    <form action="index.php" method="get">
        <label for="rotu">Rotu</label>
        <select name="rotu" id="rotu">
            <option value="rotu">Ihminen</option>
            <option value="tonttu">Tonttu</option>
            <option value="keiju">Keiju</option>
            <option value="hiisi">Hiisi</option>
        </select>

        <label for="hahmon-luokka">Luokka</label>
        <select name="hahmon-luokka" id="hahmon-luokka">
        <?php foreach($classes as $class) { ?>
                echo "<option value="hahmon-luokka"><?= $class["name"] ?></option>"
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

        <input type="submit" value="Lisää">
    </form>
    

</body>
</html>