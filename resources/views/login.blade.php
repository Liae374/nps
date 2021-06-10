<?php
$currentPageClient = ' ';
$currentPageAdmin = ' ';
$search = ' ';

if (empty($_SESSION['login'])) {
    $log = ' ';
} else {
    ob_start();
    ?>

    <li class='nav-item dropdown' style='position: relative;'>
        <a class='nav-link dropdown-toggle' id='navbarDropdownMenuLink' role='button'  data-bs-toggle='dropdown' aria-expanded='false'>
            Compte
        </a>
            <ul class='dropdown-menu dropdown-menu-dark' aria-labelledby='navbarDropdownMenuLink'>
            <li><a class='dropdown-item' href='/index.php?action=logout'>Déconnexion</a></li>
        </ul>
    </li>

    <?php 
    $log = ob_get_clean();
}

ob_start();
$logError = '';
if (isset($_POST)) {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        if (($_POST['login'] == AD_LOGIN) && ($_POST['password'] == AD_PASSWORD) ) {
            session_start();
            $_SESSION['login'] = AD_LOGIN;
            header('Location: /index.php?action=admin');
            exit();
        } else {
            $logError = ' is-invalid';
        }
    } 
}
?>

<h2 style='margin-bottom: 1.5rem;margin-top: 1.5rem;'>Se connecter</h2>
<form action='' method='post'>
    <div class='input-group mb-3'>
        <input type='text' name='login' class='form-control<?=$logError?>' placeholder='Identifiant'>
    </div>
    <div class='input-group mb-3'>
        <input type='password' name='password' class='form-control<?=$logError?>' placeholder='Mot de passe'>
    </div>
    <button type='submit' class='btn btn-primary'>Connexion</button>
</form>

<?php 
$average = round($client->average());
$NPS = round($client->NPS());
$content = ob_get_clean(); 
require('template.php'); 
?>
