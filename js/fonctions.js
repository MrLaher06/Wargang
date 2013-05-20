var action_general;
var drogue_general;
var competense_general;
var compte_actif;
var delai_hide;

function openPage(position,id,contentUrl,title,tabTitle,closable,onCompleteJsCode)
{
		var inputArray = new Array();
		inputArray['id'] = id;
		inputArray['position'] = position;
		inputArray['contentUrl'] = contentUrl;
		inputArray['title'] = title;
		inputArray['tabTitle'] = tabTitle;
		inputArray['closable'] = closable;

		paneSplitter.addContent(position, new DHTMLSuite.paneSplitterContentModel( inputArray ),onCompleteJsCode );
		paneSplitter.showContent(id);		
}

function callBackFunctionResizePane(modelObj,action,contentObj)
{
		var size = paneSplitter.getSizeOfPaneInPixels(modelObj.getPosition());
		self.status = 'Panel ' + modelObj.getPosition() + ' a été re dimensionné : ' + size.width + ' x ' + size.height + ' pixels';
}

function callbackFunction(modelObj,action,contentObj)
{
		self.status = contentObj.id;
}

function displayMessage(url,x,y)
{	
		messageObj.setWaitMessage('Chargement en cours.');
		messageObj.setShadowOffset(5);	// Large shadow
	
		messageObj.setSource(url);
		messageObj.setCssClassMessageBox(false);
		messageObj.setSize(x,y);
		messageObj.setShadowDivVisible(true);
		messageObj.setCache(false)
		messageObj.display();
}

function closeMessage()
{
		messageObj.close();	
}

function VerificationEmail(elm)
{
		if( elm.indexOf("@") != "-1" && elm.indexOf(".") != "-1")
				return true;
	
		return false;
}

function erreurFormulaire ( nom )
{
		$('#'+nom).css("border-color","#900");
		$('#'+nom).css("background-color","#FCC");
}

function initFormulaire ( nom )
{
		$('#'+nom).css("border-color","#CCC");
		$('#'+nom).css("background-color","#FFF");
}

function verif_numeric(variable)
{
		var exp = new RegExp("^[0-9]+$","g");
		return exp.test(variable);
}


function Cookie(nom)
{
		var arg=nom+"=";
		var alen=arg.length;
		var clen=document.cookie.length;
		var i=0;
		while (i<clen)
		{
				var j=i+alen;
				if (document.cookie.substring(i, j)==arg) 
						return getCookieVal(j);
				i=document.cookie.indexOf(" ",i)+1;
				if (i==0) 
						break;
		}
		return null;
}

function getCookieVal(offset)
{
		var endstr=document.cookie.indexOf (";", offset);
		if (endstr==-1) 
				endstr=document.cookie.length;
		return unescape(document.cookie.substring(offset, endstr));
}

function createCookie(name,value,days) 
{
		if(days) 
		{
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				var expires = "; expires="+date.toGMTString();
		}
		else expires = "";
	
		document.cookie = name+"="+value+expires+"; path=/";
}

function dieCookie(name)
{
		date=new Date;
		date.setFullYear(date.getFullYear()-1);
		createCookie(name,null,date);
}
function ouverture( url, tire, width, height )
{
		window.open( url, tire, "toolbar=no, status=yes, scrollbars=yes, resizable=no, width="+width+", height="+height);
}