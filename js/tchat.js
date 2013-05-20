var imageTag = false;
var theSelection = false;
var clientPC = navigator.userAgent.toLowerCase();
var clientVer = parseInt(navigator.appVersion);
var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
		&& (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
		&& (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));
var is_moz = 0;
var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);
var bbcode = new Array();
var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[/url]','[li]','[/li]','[email]','[/email]');
var imageTag = false;
var h_help;
var b_help;
var i_help;
var u_help;
var w_help;
var s_help;
var f_help;
var m_help;
var refreshTchat;

function helpline(help) 
{
		$('#helpbox').value = eval(help + "_help");
}

function getarraysize(thearray) 
{
		for (i = 0; i < thearray.length; i++)
		{
				if ((thearray[i] == "undefined") || (thearray[i] == "") || (thearray[i] == null))
						return i;
		}
		return thearray.length;
}

function arraypush(thearray,value) 
{
		thearray[ getarraysize(thearray) ] = value;
}

function arraypop(thearray) 
{
		thearraysize = getarraysize(thearray);
		retval = thearray[thearraysize - 1];
		delete thearray[thearraysize - 1];
		return retval;
}

function bbstyle(bbnumber) 
{
		var txtarea = document.getElementById('message_tchat');
		txtarea.focus();
		donotinsert = false;
		theSelection = false;
		bblast = 0;
		if (bbnumber == -1) { 
				while (bbcode[0]) {
						butnumber = arraypop(bbcode) - 1;
						txtarea.value += bbtags[butnumber + 1];
						buttext = eval('document.postform.addbbcode' + butnumber + '.value');
						eval('document.postform.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
				}
				imageTag = false; 
				txtarea.focus();
				return;
		}
		if ((clientVer >= 4) && is_ie && is_win)
		{
				theSelection = document.selection.createRange().text;
				if (theSelection) {
						document.selection.createRange().text = bbtags[bbnumber] + theSelection + bbtags[bbnumber+1];
						txtarea.focus();
						theSelection = '';
						return;
				}
				else {
						txtarea.focus();
						document.selection.createRange().text = bbtags[bbnumber] + bbtags[bbnumber + 1];
						return;
				}
		}
		else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
		{
				mozWrap(txtarea, bbtags[bbnumber], bbtags[bbnumber+1]);
				return;
		}
		else
		{
				txtarea.value = txtarea.value.substring(0, txtarea.selectionStart) + bbtags[bbnumber] + bbtags[bbnumber + 1] + txtarea.value.substring(txtarea.selectionEnd, txtarea.value.length);
				return;
		}
		for (i = 0; i < bbcode.length; i++) {
				if (bbcode[i] == bbnumber+1) {
						bblast = i;
						donotinsert = true;
				}
		}
		if (donotinsert) {    
				while (bbcode[bblast]) {
						butnumber = arraypop(bbcode) - 1;
						txtarea.value += bbtags[butnumber + 1];
						buttext = eval('document.postform.addbbcode' + butnumber + '.value');
						eval('document.postform.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
						imageTag = false;
				}
				txtarea.focus();
				return;
		} else {
				if (imageTag && (bbnumber != 14)) { 
						txtarea.value += bbtags[15];
						lastValue = arraypop(bbcode) - 1;
						$('addbbcode14').value = "Img";
						imageTag = false;
				}
				txtarea.value += bbtags[bbnumber];
				if ((bbnumber == 14) && (imageTag == false)) imageTag = 1;
				arraypush(bbcode,bbnumber+1);
				eval('document.postform.addbbcode'+bbnumber+'.value += "*"');
				txtarea.focus();
				return;
		}
		storeCaret(txtarea);
}

function mozWrap(txtarea, open, close)
{
		var selLength = txtarea.textLength;
		var selStart = txtarea.selectionStart;
		var selEnd = txtarea.selectionEnd;
		if (selEnd == 1 || selEnd == 2)
				selEnd = selLength;
		var s1 = (txtarea.value).substring(0,selStart);
		var s2 = (txtarea.value).substring(selStart, selEnd)
		var s3 = (txtarea.value).substring(selEnd, selLength);
		txtarea.value = s1 + open + s2 + close + s3;
		return;
}

function storeCaret(textEl) 
{
		if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function bbfontstyle(bbopen, bbclose) 
{
		var txtarea = document.getElementById('message_tchat');
		if ((clientVer >= 4) && is_ie && is_win) {
				theSelection = document.selection.createRange().text;
				txtarea.focus();
				if (!theSelection) {
						document.selection.createRange().text = bbopen + bbclose;
				}
				else {
						document.selection.createRange().text = bbopen + theSelection + bbclose;
				}
				txtarea.focus();
				return;
		}
		else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
		{
				mozWrap(txtarea, bbopen, bbclose);
				return;
		}
		else
		{
				txtarea.value = txtarea.value.substring(0, txtarea.selectionStart) + bbopen + bbclose + txtarea.value.substring(txtarea.selectionEnd, txtarea.value.length);
				txtarea.focus();
		}
		storeCaret(txtarea);
}

function envois_reponse_tchat()
{
		var texte = $('#message_tchat').val();
		var type_tchat = $('#type_tchat').val();
	
		if( texte == '' )
				return false;
	
		$('#tchatTxtr').load(url+'envois_tchat.html?type='+type_tchat, {
				txt: texte
		});
		histo_txt ( 'écriture sur le tchat' );
	
		if( type_tchat == 'all')
				type_tchat = '';
		else
				type_tchat = '/'+type_tchat+' ';
		
		$('#message_tchat').val(type_tchat);
}

function change_type_tchat()
{
		var type_tchat = $('#type_tchat').val()
	
		$('#tchatTxtr').load(url+'tchat.html?type='+type_tchat)
	
		if( type_tchat == 'all')
				type_tchat = '';
		else
				type_tchat = '/'+type_tchat+' ';
		
		$('#message_tchat').val(type_tchat);
		$('#message_tchat').focus(); 
}

$(function() {
	
		$("#envois_tchat").click(function () {
				envois_reponse_tchat();
		});
	
		$("#form_tchat").submit(function() {
				envois_reponse_tchat();
				return false;
		});
	
		$(".name_tchat").live("click", function(){ 
				$('#message_tchat').val('/'+$(this).html()+' ');
				$('#message_tchat').focus(); 
		});
	
		$(".value_tchat").live("click", function(){ 
				$('#message_tchat').val('/'+$(this).val()+' ');
				$('#message_tchat').focus(); 
		});
	
		$(".effacer_tchat").live("click", function(){ 
				$('#message_tchat').val('');
				$('#message_tchat').focus(); 
		});
});



