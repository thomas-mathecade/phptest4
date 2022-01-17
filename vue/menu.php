<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav mr-auto justify-content-center">
                <li class="nav-item active"><a class="nav-link" href="index.php?action=accueil&id=<?php echo $_SESSION["token"] ?>">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=ajoutLivre&id=<?php echo $_SESSION["token"] ?>">Ajouter un livre</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=allLivre&id=<?php echo $_SESSION["token"] ?>">Liste des livres</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=gestionLivre&id=<?php echo $_SESSION["token"] ?>">Gestion des livres</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=moncompte&id=<?php echo $_SESSION["token"] ?>">Mon Compte</a></li>
                <li class="nav-item"><a class="nav-link " href="index.php">Déconnexion</a></li>
            </ul>
        </div>
    </nav>
</div>