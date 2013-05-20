<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<form id="form_tchat" name="form_tchat" method="post" on>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="middle" nowrap="nowrap">
        <input name="message_tchat" type="text" id="message_tchat" class="inputbox tchatTxtr_input" size="60" style="width:100%" />&nbsp;&nbsp;<?php echo html::aide(3); ?>
      </td>
      <td width="500" align="right" valign="middle" nowrap="nowrap">
        <select id="type_tchat" class="inputbox" onchange="change_type_tchat()">
          <option  value="all">Tous</option>
          <option class="violet" value="info">Info</option>
          <option class="vert_gang" value="gang">Gang</option>
          <option class="bleu" value="crier">Crier</option>
          <option class="jaune" value="alert">Alerte</option>
        </select>
        &nbsp;
        <input type="button" class="button effacer_tchat" value=" Effacer " />
        &nbsp;
        <input type="button" onclick="displayMessage('tchat/smiley.html', 450, 490)" class="button" value=" Smiley " />
        &nbsp;
        <input type="button" class="button" accesskey="b" name="addbbcode0" value=" b " onclick="bbstyle(0)" onmouseover="helpline('b')"/>
        <input type="button" class="button" accesskey="i" name="addbbcode2" value=" i " onclick="bbstyle(2)" onmouseover="helpline('i')"/>
        <input type="button" class="button" accesskey="u" name="addbbcode4" value=" u " onclick="bbstyle(4)" onmouseover="helpline('u')"/>
        &nbsp;
        <input type="button" class="button value_tchat" value="gang" />
        <input type="button" class="button value_tchat" value="crier" />
        &nbsp;
        <input type="button" name="envois_tchat" id="envois_tchat" class="button" value=" Envoyer le message " />
        &nbsp; </td>
    </tr>
  </table>
</form>
