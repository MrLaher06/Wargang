<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div class="conteneur_action">
<h2>:: Casino de War City</h2>
<style type="text/css">
<!--
.tableMachinesous {
	margin-left:50px;
	margin-top:20px;
	width:120px;
	height:35px;
}
.buttonmachinesous {
	border:0;
	background-color:inherit;
	margin-right:14px;
	cursor:pointer;
}
.divmisemachinesous {
	color:#ffffff;
	text-align:center;
	margin-left:40px;
	width:150px;
}
-->
</style>
<script language="javascript" type="text/javascript">
var slotitem = new Array('0','1','2','3','4','5','6','7','8','9');
var argent = <?php echo $argent; ?>;

function rollem () 
{
	$('#bet').focus();
	
	if($('#bet').val() < 1 || argent < 1 || $('#bet').val() == "") 
	{
		alert("Vous devez miser au moins 1$."); 
		return;
	}
	else if ($('#bet').val() > 500) 
	{ 
		alert("Vous devez miser moins de 500$."); 
		return;
	}
	else if (Math.floor(argent) < Math.floor($('#bet').val())) 
	{
		alert("votre mise "+$('#bet').val()+" $ est supérieur a ce que vous possédez ( "+argent+" $.  )"); 
		return;
	}
	$('#buttonmachinesous').attr('disabled', true);
	
	$('#banner').html("Mise de "+$('#bet').val()+" $");
	
	counter=0;
	
	spinem(counter);
}

function spinem(counter) 
{
	turns1=10+Math.floor((Math.random() * 10))
	
	for (a=0;a<turns1;a++) { $('#slot1').attr('src','<?php	echo url::base();	?>images/casino/'+slotitem[a % 9]+'.gif'); }
	
	turns2=10+Math.floor((Math.random() * 10))
	
	for (b=0;b<turns2;b++) { $('#slot2').attr('src','<?php	echo url::base();	?>images/casino/'+slotitem[b % 9]+'.gif'); }
	
	turns3=10+Math.floor((Math.random() * 10))
	
	for (c=0;c<turns3;c++) { $('#slot3').attr('src','<?php	echo url::base();	?>images/casino/'+slotitem[c % 9]+'.gif'); }
	
	counter++;
	
	if (counter<25) 
	{
		setTimeout("spinem("+counter+");",80);
	} 
	else 
	{
		if ($('#slot1').attr('src') == $('#slot2').attr('src') && $('#slot1').attr('src') == $('#slot3').attr('src')) 
		{		
			argent=Math.floor(argent)+Math.floor($('#bet').val()*10); 
			var msg = "Vous gagnez "+Math.floor($('#bet').val()*10)+" $";
			histo_txt ( 'Jackpot au casino : '+$('#bet').val()+' $' );
		}
		else if ( $('#slot1').attr('src') == $('#slot2').attr('src') 
						|| $('#slot1').attr('src') == $('#slot3').attr('src') 
						|| $('#slot2').attr('src') == $('#slot3').attr('src'))
	
		{
			argent = Math.floor($('#bet').val()*2) + Math.floor(argent); 
			var msg = "Vous gagnez "+Math.floor($('#bet').val() * 2 )+" $";
			histo_txt ( 'Une Paire au casino : '+$('#bet').val()+' $' );
		}
		else 
		{
			argent = Math.floor(argent) - Math.floor($('#bet').val()); 
			var msg = "Vous perdez "+$('#bet').val()+" $";
			histo_txt ( 'Perdu au casino : '+$('#bet').val()+' $' );
		}
		
		$('#banner').html(msg);
		
		$.post("<?php	echo url::base(TRUE);	?>users/modifier_argent.html", { argent_modif: argent },
		function(){
			$('#user').load('<?php	echo url::base(TRUE);	?>joueur.html');
			$('#buttonmachinesous').attr('disabled', false);
		});
	}
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
      <form name="slots">
        <table width="251" height="275" border=0 align="center" cellpadding="0" cellspacing="0" background="<?php	echo url::base();	?>images/casino/machinesous.jpg" style="margin-left:auto; margin-right:auto;">
          <tr>
            <td height="51" align="left"valign="middle">
              <div class="divmisemachinesous" style="margin-top:10px;">Mise<br />
                <input class="inputbox" autocomplete="off" onblur="if(this.value=='') this.value='100';" type="box" size="10" name="bet" id="bet" value="100">
              </div>
            </td>
          </tr>
          <tr>
            <td height="27" align="right" valign="top">
              <input type="button" onclick="rollem(); return false;" value="&nbsp;" class="buttonmachinesous" id="buttonmachinesous">
            </td>
          </tr>
          <tr>
            <td height="118" valign="top" >
              <table border=0 cellpadding=2 cellspacing=5 class="tableMachinesous">
                <tr>
                  <td width="25" align="center" valign="middle"><img src="<?php echo url::base(); ?>images/casino/1.gif" name="slot1" id="slot1" /></td>
                  <td width="48" align="center" valign="middle"><img src="<?php echo url::base(); ?>images/casino/2.gif" name="slot2" id="slot2" /></td>
                  <td align="center" valign="middle"><img src="<?php echo url::base(); ?>images/casino/3.gif" name="slot3" id="slot3"  /></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td valign="top" >
              <div id="banner" style="margin-right:25px; margin-top:5px;" align="center"></div>
            </td>
          </tr>
        </table>
      </form>
    </td>
    <td valign="top">
      <h3>Explication sur les gains</h3>
      <table border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td class="orange">Trois d'une même sorte :</td>
          <td class="vert"><strong>10</strong> x vos gains</td>
        </tr>
        <tr>
          <td class="orange">Une Paire : </td>
          <td class="vert"><strong>2</strong> x vos gains. </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
