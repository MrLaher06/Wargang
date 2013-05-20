<ul class="topnav">
  <li><?php echo html::anchor('admin','Accueil'); ?></li>
  <li><?php echo html::anchor('admin/users','Utilisateurs'); ?></li>
  <li><a href="#">Elements du jeu</a>
    <ul class="subnav">
      <li><?php echo html::anchor('admin/carte','Bâtiments'); ?></li>
      <li><?php echo html::anchor('admin/armes','Armes'); ?></li>
      <li><?php echo html::anchor('admin/protections','Protections'); ?></li>
      <li><?php echo html::anchor('admin/vehicules','Vehicules'); ?></li>
      <li><?php echo html::anchor('admin/drogues','Drogues'); ?></li>
      <li><?php echo html::anchor('admin/bots','Bots'); ?></li>
      <li><?php echo html::anchor('admin/football','Equipe de Foot'); ?></li>
    </ul>
  </li>
  <li><a href="#">Gestion du jeu</a>
    <ul class="subnav">
      <li><?php echo html::anchor('admin/missions','Missions'); ?></li>
      <li><?php echo html::anchor('admin/combat','Combats'); ?></li>
      <li><?php echo html::anchor('admin/partie','Parties'); ?></li>
      <li><?php echo html::anchor('admin/match','Match de Foot'); ?></li>
    </ul>
  </li>
  <li><?php echo html::anchor('admin/gangs','Gangs'); ?></li>
  <li><a href="#">Articles</a>
    <ul class="subnav">
      <li><?php echo html::anchor('admin/journal','Articles du journal'); ?></li>
      <li><?php echo html::anchor('admin/regles','Règles du jeu'); ?></li>
    </ul>
  </li>
  <li><a href="#">Surveillance</a>
    <ul class="subnav">
      <li><?php echo html::anchor('admin/ip','IP utilisées'); ?></li>
      <li><?php echo html::anchor('admin/tchat','Tchat'); ?></li>
    </ul>
  </li>
</ul>
