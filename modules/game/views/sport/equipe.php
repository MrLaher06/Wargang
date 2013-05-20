<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
  <div align="right" class="time_action"><a href="javascript:;" id="visite_batiment" >Revenir dans le bar</a>&nbsp;&nbsp;<?php echo html::aide(16); ?></div>
  <h2>:: Détail de l'équipe</h2>
   <img src="<?php echo url::base(); ?>images/football/<?php echo $equipe->image ? $equipe->image : 'frlarge.gif'; ?>" height="100" align="left" style="margin:0 20px 5px 10px;"/>
  <div style="margin-bottom:5px;"><strong class="orange">Nom de l'équipe</strong> : <?php echo $equipe->name; ?> (<?php echo $equipe->name_us; ?>)</div>
  <div style="margin-bottom:5px;"><strong class="orange">Nombre de joueur(s)</strong> : <?php echo $equipe->nbr_joueur; ?></div>
  <div style="margin-bottom:5px;"><strong class="orange">Nombre de victoire</strong> : <?php echo $equipe->victoire; ?></div>
  <div style="margin-bottom:5px;"><strong class="orange">Nombre de défaite</strong> : <?php echo $equipe->defaite; ?></div>
  <div style="margin-bottom:5px;"><strong class="orange">Nombre de match nul</strong> : <?php echo $equipe->egalite; ?></div>
  <div class="spacer"></div>
  <h2>:: Statistiques de l'équipe</h2>
  <div style="width:50%; float:left;">
    <div style="margin: 0 10px 10px 10px;"> <?php echo graphisme::barre( $equipe->attaque, 'Attaque de l\'équipe :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin: 0 10px 10px 10px;"> <?php echo graphisme::barre( $equipe->defense, 'Défense de l\'équipe :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->equilibre, 'Equilibre de l\'équipe :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->mentalite, 'Mentalité de l\'équipe :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->regularite, 'Régularité de l\'équipe :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->jeu_equipe, 'Jeu d\'équipe :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->endurance, 'Endurance des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->physique, 'Etat physique des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->vitesse, 'Vitesse des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->acceleration, 'Accélération des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->reaction, 'Réaction des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->agilite, 'Agilités des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->detente, 'Détente des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->technique, 'Techniques des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->agressivite, 'Agressivité des joueurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->precision_dribble, 'Précision sur les dribbes :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->vitesse_dribble, 'Vitesse sur les dribbes :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->precision_passe_court, 'Précision sur les passes courtes :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->vitesse_passe_court, 'Vitesse sur les passes courtes :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->precision_passe_long, 'Précision sur les passes longues :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->vitesse_passe_long, 'Vitesse sur les passes longues :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->precision_tir, 'Précision des buteurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->puissance_tir, 'Puissance des buteurs :' ); ?> </div>
  </div>
  <div style="width:50%; float:left;">
    <div style="margin:10px;"> <?php echo graphisme::barre( $equipe->technique_tir, 'Technique des buteurs :' ); ?> </div>
  </div>
</div>
