<?php
    session_start();
?>

<main>
    <?php 
        if (isset($_SESSION['userid'])) {
           echo  '<p>Logged in</p>';

           echo  '<form action="../config/login.inc.php?sair=true" method="post">
           <button type="submit" name="logout">Logout</button>
           </form>';

        }
        else {
            echo  '<p>Logged out</p>';
        }
    ?>
    <a href="/StoriesBr/"><button>Voltar</button></a>
</main>
