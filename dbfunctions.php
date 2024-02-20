<?php
/**
 * Ottaa yhteyden tietokantaan, palauttaa 
 * pdo-olion.
 * 13.2.2023/EM
 */
function connect() {
    $servername = "irysul23.treok.io";
    $username = "irysul23_sasp";
    $password = "saspiDm18&86";
    //$port = 3306;
    $dbname = "irysul23_sasp";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}
// show all classes
function getAllClasses() {
    $pdo = connect();
    $sql = "SELECT * FROM class";
    $stm = $pdo->query($sql);
    $classes = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $classes;
}
// add new class
function insertNewClass($luokka) {
    $pdo = connect();
    $sql = "INSERT INTO class (`name`) VALUES (?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$luokka]);
    return $ok;
}
// delete class
function deleteClass($id) {
    $pdo = connect();
    $sql = "DELETE FROM class WHERE classID=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}
// add new race
function insertNewRace($race) {
    $pdo = connect();
    $sql = "INSERT INTO race (`name`) VALUES (?)";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$race]);
    return $ok;
}
// show all races
function getAllRaces() {
    $pdo = connect();
    $sql = "SELECT * FROM race";
    $stm = $pdo->query($sql);
    $races = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $races;
}
// delete race
function deleteRace($id) {
    $pdo = connect();
    $sql = "DELETE FROM race WHERE raceID=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}
// add new character
function insertNewCharacter($name, $strength, $dexterity, $wisdom, $classID, $raceID) {
    $pdo = connect();

    $sql = "INSERT INTO characters (`name`, `strength`, `dexterity`, `wisdom`, `classID`, `raceID`) VALUES (?,?,?,?,?,?);";

    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$name, $strength, $dexterity, $wisdom, $classID, $raceID]);
    return $ok;
}
// show all characters
function getAllCharacters() {
    $pdo = connect();
    $sql = "SELECT * FROM characters";
    $stm = $pdo->query($sql);
    $characters = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $characters;
}
// edit character
function editCharacter($id) {
    $pdo = connect();
    $sql = "SELECT characters * `race.name` AS raceName, `class.name` AS className 
    FROM characters
    INNER JOIN race ON race.raceID = characters.raceID
    INNER JOIN class ON class.classID = characters.classID;";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}
// SELECT hahmo * 
// rotu.nimi AS rodunNimi,
// luokka.nimi AS LuokanNimi 
// FROM hahmo
// INNER JOIN rotu ON rotu.rotuID = hahmo.rotuID
// INNER JOIN luokka ON luokka.kuokkaID = hahmo.luokkaID 
// update character

function updateCharacter($id) {
    $pdo = connect();
    $sql = "UPDATE FROM characters SET `name`='$name', `strength`='$strength', `dexterity`='$dexterity', `wisdom`='$wisdom', `classID`='$classID', `raceID`='$raceID' WHERE characterID=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}

// delete character
function deleteCharacter($id) {
    $pdo = connect();
    $sql = "DELETE FROM characters WHERE characterID=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}