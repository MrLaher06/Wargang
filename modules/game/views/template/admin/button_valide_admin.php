<?php if( !isset($add) ) : ?>
<div class="button_valide_icon" id="annuler"> <span class="titre_menu rouge">Annuler</span> <img src="<?php echo url::base(); ?>images/buttons/delete.png" align="middle" height="30" title="Annuler" alt="annuler" /> </div>
<div class="button_valide_icon" id="validation"> <span class="titre_menu vert">Enregistrer</span> <img src="<?php echo url::base(); ?>images/buttons/arrow_return_down_right.png" height="30" title="Valider" alt="valider" /> </div>
<div class="button_valide_icon" id="sauvegarde"> <span class="titre_menu vert">Sauvegarder</span> <img src="<?php echo url::base(); ?>images/buttons/arrow_refresh_small.png" height="30" title="Sauvegarder" alt="Sauvegarder" /> </div>
<div class="button_valide_icon" id="trash"> <span class="titre_menu vert">Supprimer</span> <img src="<?php echo url::base(); ?>images/buttons/trash.png" height="30" title="Corbeille" alt="trash" /> </div>
<?php elseif( isset($add) ) : ?>
<a href="<?php echo $add; ?>">
<div class="button_valide_icon"><span class="titre_menu vert">Ajouter</span> <img src="<?php echo url::base(); ?>images/buttons/add.png" height="30" title="Ajouter" alt="ajouter" /> </div>
</a>
<?php endif ?>
