<?php
require_once "vue/Vue.php";
class vueMonCompte extends Vue {
	function affiche(){
        include "header.html";
        include "menu.php";
?>
        <script src='js/main.js'></script>
		<div class='covered-img'>
            <div class='container'>
                <form method='post' action='index.php?action=moncompte&id="<?php echo $_SESSION['token'] ?>"required'>
                    <div class='form-group'>
                        <div class='form-row'>
                            <label class='col-md-3' for='nom'>Nom</label>
                            <input id="nom" type="text" class='form-control' name='nom' placeholder='Entrer le nom' required>
                        </div>
                        <div class="form-row">
                            <label for="prenom">Prénom</label>
                            <input id="prenom" type='text' class="form-control" name="prenom" placeholder="Entrer le prénom" required>
                        </div>
                        <div class='form-row'>
                            <label for='dateNaiss'>Date de naissance</label>
                            <div class="datepicker date input-group">
                                <input id="dateNaiss" type="text" class="form-control" name="dateNaiss" placeholder="Entrer la date naissance">
                                <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div>
                        <div class='form-row'>
                            <label for="phone">Téléphone</label>
                            <input id="edition" type="text" class="form-control" name="phone" placeholder="Entrer le numéros de téléphone" required>
                        </div>
                        <div class='form-row'>
                            <label for='email'>Email</label>
                            <input id="email" type="text" class="form-control" name="email" placeholder="Entrer l'adresse email">
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