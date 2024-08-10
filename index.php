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
    
    } else if (isset($_POST['hahmon-rotu'], $_POST['hahmon-luokka'], $_POST['hahmon-nimi'], $_POST['hahmon-voima'], $_POST['hahmon-ketteryys'], $_POST['hahmon-viisaus'], $_POST['hahmon-kuva'])) {
        $raceID = htmlspecialchars($_POST['hahmon-rotu']);
        $classID = htmlspecialchars($_POST['hahmon-luokka']);
        $name = htmlspecialchars($_POST['hahmon-nimi']);
        $strength = htmlspecialchars($_POST['hahmon-voima']);
        $dexterity = htmlspecialchars($_POST['hahmon-ketteryys']);
        $wisdom = htmlspecialchars($_POST['hahmon-viisaus']);
        $image = htmlspecialchars($_POST['hahmon-kuva']);

        $characters = insertNewCharacter($name, $strength, $dexterity, $wisdom, $classID, $raceID, $image);

    } else if (isset($_GET["id"])) {
        $id = htmlspecialchars($_GET['id']);
        $characterToUpdate = getCharacterById($id);
        
        if($characterToUpdate){
            $raceID = $characterToUpdate['raceID'];
            $classID = $characterToUpdate['classID'];
            $name = $characterToUpdate['name'];
            $strength = $characterToUpdate['strength'];
            $dexterity = $characterToUpdate['dexterity'];
            $wisdom = $characterToUpdate['wisdom'];
            $image = $characterToUpdate['image'];
            $id = $characterToUpdate['characterID'];
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
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.1.0.js"   integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="   crossorigin="anonymous"></script>

    <title>Hahmot</title>
</head>
<body>
    <h1>HAHMOT</h1>
    <!-- LUOKAT -->
    <section class="class-race-section">
        <section class="class-section">
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
        <section class="race-section">
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
    </section>
    <!-- HAHMOT -->
    <section class="characters-section">
        <h2>Hahmot</h2>
        <h3>Lisää hahmo</h3>
                        
        <form action="index.php" method="post">
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
            <input class="text-input" type="text" name="hahmon-nimi" id="hahmon-nimi" required><br>

            <label for="hahmon-voima">Voima</label>
            <input class="text-input" type="text" name="hahmon-voima" id="hahmon-voima" required><br>

            <label for="hahmon-ketteryys">Ketteryys</label>
            <input class="text-input" type="text" name="hahmon-ketteryys" id="hahmon-ketteryys" required><br>

            <label for="hahmon-viisaus">Viisaus</label>
            <input class="text-input" type="text" name="hahmon-viisaus" id="hahmon-viisaus" required><br>

            <label for="hahmon-kuva">Kuva</label>
            <input class="text-input" type="text" name="hahmon-kuva" id="hahmon-kuva" required><br>

            <input type="submit" class="button-68" value="Lisää">
            
        </form>
        <!-- inputs changing -->
        <script>
            $('#hahmon-voima').keyup(function(){
                var strength = parseInt($('#hahmon-voima').val());
                var totalNumber = 16;
                var dexterity = parseInt(Math.ceil((totalNumber - strength) / 2));
                var wisdom = totalNumber - strength - dexterity;
                
                if(isNaN(strength)){
                    $('#hahmon-voima').val('Enter valid number');
                } 
                else if (strength >= 16) {
                    $('#hahmon-voima').val('Whole sum of features must be 16');
                }
                else {
                    $('#hahmon-ketteryys').val(dexterity);
                    $('#hahmon-viisaus').val(wisdom);
                }
                // if(isNaN(dexterity)){
                //     $('#hahmon-ketteryys').val('Enter valid number');
                // } else if ((strength + dexterity) > 16) {
                //     console.log(strength + dexterity)
                //     $('#hahmon-ketteryys').val('Whole sum of features must be 16');
                // } else {
                //     $('#hahmon-ketteryys').val(dexterity);
                //     $('#hahmon-viisaus').val(wisdom);
                // }
            });
        </script>

        <div class="characters-container">
            <?php 
                $characters = getAllCharacters();
                foreach($characters as $character) { 
                    $characterID = $character['characterID'];?>
                <div class="character-card">
                <h3 class="name-title"><?= $character["name"] ?></h3>
                
                <div class="image-container"><img class="character-image" src=<?= $character["image"] ?>></div>

                <p>Luokka: <?= $character["className"] ?></p>

                <p>Rotu: <?= $character["raceName"] ?></p>
                <ul>
                    <li>Voima: <?= $character["strength"] ?></li>
                    <li>Ketteryys: <?= $character["dexterity"] ?></li>
                    <li>Viisaus: <?= $character["wisdom"] ?></li>
                </ul>
                
                <a class="edit-link" href='/editCharacter.php?characterID=<?=$characterID?>'>Päivitä</a>

                <form class="deleted-link" action='index.php' method='get'>
                    <input type='hidden' name='deletedcharacterid' value='<?= $character["characterID"] ?>'>
                    <input class="delete-button" type='submit' name='submit' value='Poista'>
                </form>

                </div>
                <?php } ?>
        </div>
    </section>

    <!-- <div class="form-group">
  <label for="exampleInputPassword1">Rate</label>
  <input type="text" class="form-control" name="rate" placeholder="Enter Rate" id="rate" required>
</div>
<div class="form-group">
  <label>Quantity</label>
  <input type="text" class="form-control" name="quantity" placeholder="quantity" value="2" id="qnty" required readonly>
</div>
<div class="form-group">
  <label for="exampleInputPassword2">Amount</label>
  <input type="text" class="form-control" name="amount" value="" id="amt" placeholder="Amount" required>
</div>
<script src="https://code.jquery.com/jquery-3.1.0.js"   integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="   crossorigin="anonymous"></script>
<script>
  $('#rate').keyup(function(){
    var rate = parseInt($('#rate').val());
    var qnty = parseInt($('#qnty').val());
    var amt = parseInt(rate*qnty);
    if(isNaN(amt)){
      $('#amt').val('Enter valid rate');
    } else {
      $('#amt').val(amt);
    }

  });

</script> -->


    <!-- <label for="strength">Strength</label>
    <input type="text" name="strength" placeholder="strength" id="strength" required>

    <label for="dexterity">Dexterity</label>
    <input type="text" name="dexterity" value="" id="dexterity" placeholder="dexterity" required>

    <label for="wisdom">Wisdom</label>
    <input type="text" name="wisdom" value="" id="wisdom" placeholder="wisdom" required>

    <script>
        $('#strength').keyup(function(){
            var strength = parseInt($('#strength').val());
            var qnty = 16;
            var dexterity = parseInt(Math.floor((qnty - strength) / 2));
            var wisdom = qnty - strength - dexterity;
            console.log(dexterity)
            console.log(wisdom)
            
            if(isNaN(dexterity)){
                $('#dexterity').val('Enter valid rate');
            } else {
                $('#dexterity').val(dexterity);
                $('#wisdom').val(wisdom);
            }
        });
    </script> -->
</body>
</html>