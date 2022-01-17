<?php
require_once "vue/Vue.php";
class vueAjoutLivre extends Vue {
	function affiche(){
                include "header.html";
                include "menu.php";
?>
                <div class="covered-img">
                        <div class="container">
                                <form method='post' action='index.php?action=validLivre&id="<?php echo $_SESSION['token'] ?>"' required>
                                        <div class='form-group'>
                                                <div class='form-row'>
                                                        <label class='col-md-3' for='titre'>Titre</label>
                                                        <input id="nom" type="text" class="form-control" name="titre" placeholder="Entrer le titre" required>
                                                </div>
                                                <div class='form-row'>
                                                        <label for='auteur'>Auteur</label>
                                                        <input id="auteur" type="text" class="form-control" name="auteur" placeholder="Entrer l'auteur" required>
                                                </div>
                                                <div class='form-row'>
                                                        <label for='edition'>Edition</label>
                                                        <input id="edition" type="text" class="form-control" name="edition" placeholder="Entrer l'édition" required>
                                                </div>
                                                <div class='form-row'>
                                                        <label for='info'>Information</label>
                                                        <input id="info" type="text" class="form-control" name="auteur" placeholder="Entrer les informations du livre">
                                                </div>
                                                <div class='form-group'>
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="ok" >
                                                        <label class="form-check-label" for="ok">Le livre est il en bonne état?</label>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Ajouter</button>
                                        </div>
                                </form>
                        </div>
                </div>
<?php
                include "footer.html";
        }	
}
?>