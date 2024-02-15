<?php

require_once "dbfunctions.php";

if (isset($_POST["txtinsertclass"])) {
    // lue tieto, kutsu funktiota joka lisää uuden luokan
}
else if (isset($_GET["deletedraceid"])) {

}
// hae tiedot funktioiden avulla
$races = getAllRaces();

?>

<h1>Harjoitus 5</h1>
<ul>
    <?php
    foreach ($races as $r) {
        echo "<li>" . $r["name"] . "</li>";
    }
    ?>
</ul>

<form action="" method="post">
    <!-- formi luokan lisämisesti -->
</form>