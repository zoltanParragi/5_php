
<nav class="nav">
    <div><a href="index.php">Főoldal</a></div>
    <div><a href="tasks.php">Feladatok</a></div>
    <?php
        if(isset($_SESSION["user"])){
    ?>
        <div><a href="profile.php">Profilom</a></div>
        <div><a href="logout.php">Kilépés</a></div>
        <div>Üdvözlünk <?php print($_SESSION["user"]["name"])?>!</div>
    <?php
        } else {
    ?>
        <div><a href="register.php">Regisztráció</a></div>
        <div><a href="login.php">Belépés</a></div>
    <?php
        }
    ?>
</nav>