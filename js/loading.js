var action_general;
var compte_actif;
var delai_hide;
var chargement_ajax = false;
var refresh_carte;

$.ajaxSetup({
		timeout: 15000
});

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
		messageObj.setShadowOffset(5);
	
		messageObj.setSource(url);
		messageObj.setCssClassMessageBox(false);
		messageObj.setSize(x,y);
		messageObj.setShadowDivVisible(true);
		messageObj.setCache(false)
		messageObj.display();
}

function tarif_allopass()
{
		paneSplitter.addContent("center", new DHTMLSuite.paneSplitterContentModel( {
				id:"tarif",
				htmlElementId:"tarif",
				contentUrl:url+"allopass/tarif.html",
				title:"Tarif du système Allopass",
				tabTitle: "Allopass",
				closable:true
		} ) );
		paneSplitter.showContent("tarif");
}

function panelAfficher( position, panel, url, title, tab )
{
		paneSplitter.addContent( position, new DHTMLSuite.paneSplitterContentModel( {
				id:panel,
				htmlElementId:panel,
				contentUrl:url,
				title:title,
				tabTitle:tab
		} ) );
		paneSplitter.showContent( panel );
}

function closeMessage()
{
		messageObj.close();	
}

function openUrl( url )
{
		var docWin = window.open(url);
		docWin.focus();
}

function move ( id )
{
		var temps_restant = parseInt($('#delai').html());
	
		if(temps_restant < 10)
		{
				$('#Ccarte').load(url+'deplacement.html', {
						direction : id
				},function(){ 
						histo_txt ( 'déplacement sur la carte' );
						fermer_carte();
						paneSplitter.showContent("contenu");
				});
		}
}

function fermer_carte()
{
		clearInterval(refresh_carte);
		clearTimeout(compte_actif);
		$('#contenu').load(url+'actions.html', function() {
				reload_partie_auto ();
		});
		histo_txt ( 'fermeture de la carte' );
		closeMessage();
}

function change_image( valeur, id_image, dossier )
{
		$('#'+id_image).attr('src',url+'images/'+dossier+'/'+valeur);
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

function reload_partie_auto() 
{
		$.ajax({
				url: url+'joueur.html',
				timeout: 1000,
				success: function(data) 
				{ 
						$('#user').html(data); 
						$.ajax({
								url: url+'tchat.html?type='+$('#type_tchat').val(),
								timeout: 1000,
								success: function(data) {
										$('#tchatTxtr').html(data);
								}
						});
				}
		});
}

function reload_action ()
{
		action_general = setInterval( function() {
				reload_partie_auto();
		}, 4000);
}

function hide_msg ()
{
		$("#msg").delay(5000).hide(function(){
				$("#msg").html(' ');
				$("#msg").show();
		});
}

function modification_user ()
{
		$.post(url+"users/enregistrement.html", $("#form_modif_user").serialize(), function() {
				closeMessage();
		});
}

function creation_gang ()
{
		$.post(url+"gang/enregistrement_creation.html", $("#form_crea_gang").serialize(), function() {
				closeMessage();
		});
}

function creation_article ()
{
		if( $('#titre').val() == '')
		{
				alert('Veuillez indiquer un titre');
				return false;
		}
		if( $('#texte_article').val() == '')
		{
				alert('Veuillez indiquer un texte');
				return false;
		}
		
		$.post(url+"journal/enregistrement_proposition.html", $("#form_proposer_article").serialize(), function() {
				histo_txt ( 'article envoyé' );
				closeMessage();
		});
}

function change_stat ( type )
{
		if(type=='')
				return false;
		
		$('#contenu_statistique').load(url+'statistiques/detail/'+type+'/'+$('#choix_stat_user').val()+'.html', function() {
				histo_txt ( 'voir détail statistique' );
		});
}

function change_stat_user ( user )
{
		if(user=='')
				return false;
		
		$('#contenu_statistique').load(url+'statistiques/detail/'+$('#choix_stat').val()+'/'+user+'.html', function() {
				histo_txt ( 'voir détail statistique gangster' );
		});
}

function histo_txt ( txt )
{
		date = new Date();
		heure = date.getHours();
		minute = date.getMinutes();
		seconde = date.getSeconds();
	
		if( heure < 10)
				heure = '0'+heure;
	
		if( minute < 10)
				minute = '0'+minute;
	
		if( seconde < 10)
				seconde = '0'+seconde;

		$('#historique').prepend('['+heure+'h'+minute+':'+seconde+'] '+txt+'<br/>');
		$('#msg').html(txt);
		$('title').html(txt); 
		hide_msg ();
}

function refresh_bloc( id, page )
{
		if( chargement_ajax == false )
		{
				chargement_ajax = true;
		
				$('.ajax_button').attr('class', 'rouge ajax_button_false');
				$('.ajax_button_false').html('En cours de chargement...'); 
			
				$(id).load(page, function() { 
						$('.ajax_button_false').attr('class', 'jaune cursor ajax_button'); 
						chargement_ajax = false; 
						$('.ajax_button').html('Actualiser la page'); 
				} );
		}
}

(function () {
    
		function log(){
				if (typeof(console) != 'undefined' && typeof(console.log) == 'function'){            
						Array.prototype.unshift.call(arguments, '[Ajax Upload]');
						console.log( Array.prototype.join.call(arguments, ' '));
				}
		} 

		function addEvent(el, type, fn){
				if (el.addEventListener) {
						el.addEventListener(type, fn, false);
				} else if (el.attachEvent) {
						el.attachEvent('on' + type, function(){
								fn.call(el);
						});
				} else {
						throw new Error('not supported or DOM not loaded');
				}
		}   
    
		function addResizeEvent(fn){
				var timeout;
               
				addEvent(window, 'resize', function(){
						if (timeout){
								clearTimeout(timeout);
						}
						timeout = setTimeout(fn, 100);                        
				});
		}    
    
		if (document.documentElement.getBoundingClientRect){
				var getOffset = function(el){
						var box = el.getBoundingClientRect();
						var doc = el.ownerDocument;
						var body = doc.body;
						var docElem = doc.documentElement; 
						var clientTop = docElem.clientTop || body.clientTop || 0;
						var clientLeft = docElem.clientLeft || body.clientLeft || 0;
						var zoom = 1;            
						if (body.getBoundingClientRect) {
								var bound = body.getBoundingClientRect();
								zoom = (bound.right - bound.left) / body.clientWidth;
						}
            
						if (zoom > 1) {
								clientTop = 0;
								clientLeft = 0;
						}
            
						var top = box.top / zoom + (window.pageYOffset || docElem && docElem.scrollTop / zoom || body.scrollTop / zoom) - clientTop, left = box.left / zoom + (window.pageXOffset || docElem && docElem.scrollLeft / zoom || body.scrollLeft / zoom) - clientLeft;
            
						return {
								top: top,
								left: left
						};
				};        
		} else {
				var getOffset = function(el){
						var top = 0, left = 0;
						do {
								top += el.offsetTop || 0;
								left += el.offsetLeft || 0;
								el = el.offsetParent;
						} while (el);
            
						return {
								left: left,
								top: top
						};
				};
		}
    
		function getBox(el){
				var left, right, top, bottom;
				var offset = getOffset(el);
				left = offset.left;
				top = offset.top;
        
				right = left + el.offsetWidth;
				bottom = top + el.offsetHeight;
        
				return {
						left: left,
						right: right,
						top: top,
						bottom: bottom
				};
		}
    
		function addStyles(el, styles){
				for (var name in styles) {
						if (styles.hasOwnProperty(name)) {
								el.style[name] = styles[name];
						}
				}
		}
        
		function copyLayout(from, to){
				var box = getBox(from);
        
				addStyles(to, {
						position: 'absolute',                    
						left : box.left + 'px',
						top : box.top + 'px',
						width : from.offsetWidth + 'px',
						height : from.offsetHeight + 'px'
				});        
		}

		var toElement = (function(){
				var div = document.createElement('div');
				return function(html){
						div.innerHTML = html;
						var el = div.firstChild;
						return div.removeChild(el);
				};
		})();
            
		var getUID = (function(){
				var id = 0;
				return function(){
						return 'ValumsAjaxUpload' + id++;
				};
		})();        
 
		function fileFromPath(file){
				return file.replace(/.*(\/|\\)/, "");
		}
    
		function getExt(file){
				return (-1 !== file.indexOf('.')) ? file.replace(/.*[.]/, '') : '';
		}

		function hasClass(el, name){        
				var re = new RegExp('\\b' + name + '\\b');        
				return re.test(el.className);
		}    
		function addClass(el, name){
				if ( ! hasClass(el, name)){   
						el.className += ' ' + name;
				}
		}    
		function removeClass(el, name){
				var re = new RegExp('\\b' + name + '\\b');                
				el.className = el.className.replace(re, '');        
		}
    
		function removeNode(el){
				el.parentNode.removeChild(el);
		}

		window.AjaxUpload = function(button, options){
				this._settings = {
						action: url+'upload.php',
						name: 'userfile',
						data: {},
						autoSubmit: true,
						responseType: false,
						hoverClass: 'hover',
						disabledClass: 'disabled',            
						onChange: function(file, extension){
						},
						onSubmit: function(file, extension){
						},
						onComplete: function(file, response){
						}
				};
                        
				for (var i in options) {
						if (options.hasOwnProperty(i)){
								this._settings[i] = options[i];
						}
				}
                
				if (button.jquery){
						button = button[0];
				} else if (typeof button == "string") {
						if (/^#.*/.test(button)){
								button = button.slice(1);                
						}
            
						button = document.getElementById(button);
				}
        
				if ( ! button || button.nodeType !== 1){
						throw new Error("Please make sure that you're passing a valid element"); 
				}
                
				if ( button.nodeName.toUpperCase() == 'A'){
						addEvent(button, 'click', function(e){
								if (e && e.preventDefault){
										e.preventDefault();
								} else if (window.event){
										window.event.returnValue = false;
								}
						});
				}
                    
				this._button = button;        
				this._input = null;
				this._disabled = false;
        
				this.enable();        
        
				this._rerouteClicks();
		};
    
		AjaxUpload.prototype = {
				setData: function(data){
						this._settings.data = data;
				},
				disable: function(){            
						addClass(this._button, this._settings.disabledClass);
						this._disabled = true;
            
						var nodeName = this._button.nodeName.toUpperCase();            
						if (nodeName == 'INPUT' || nodeName == 'BUTTON'){
								this._button.setAttribute('disabled', 'disabled');
						}            
            
						if (this._input){
								this._input.parentNode.style.visibility = 'hidden';
						}
				},
				enable: function(){
						removeClass(this._button, this._settings.disabledClass);
						this._button.removeAttribute('disabled');
						this._disabled = false;
            
				},
        
				_createInput: function(){ 
						var self = this;
                        
						var input = document.createElement("input");
						input.setAttribute('type', 'file');
						input.setAttribute('name', this._settings.name);
            
						addStyles(input, {
								'position' : 'absolute',
								'right' : 0,
								'margin' : 0,
								'padding' : 0,
								'fontSize' : '480px',                
								'cursor' : 'pointer'
						});            

						var div = document.createElement("div");                        
						addStyles(div, {
								'display' : 'block',
								'position' : 'absolute',
								'overflow' : 'hidden',
								'margin' : 0,
								'padding' : 0,                
								'opacity' : 0,
								'direction' : 'ltr',
								'zIndex': 2147483583
						});
            
						if ( div.style.opacity !== "0") {
								if (typeof(div.filters) == 'undefined'){
										throw new Error('Opacity not supported by the browser');
								}
								div.style.filter = "alpha(opacity=0)";
						}            
            
						addEvent(input, 'change', function(){
                 
								if ( ! input || input.value === ''){                
										return;                
								}
                            
								var file = fileFromPath(input.value);
                                
								if (false === self._settings.onChange.call(self, file, getExt(file))){
										self._clearInput();                
										return;
								}
                
								if (self._settings.autoSubmit) {
										self.submit();
								}
						});            

						addEvent(input, 'mouseover', function(){
								addClass(self._button, self._settings.hoverClass);
						});
            
						addEvent(input, 'mouseout', function(){
								removeClass(self._button, self._settings.hoverClass);
                
								input.parentNode.style.visibility = 'hidden';

						});   
                        
						div.appendChild(input);
						document.body.appendChild(div);
              
						this._input = input;
				},
				_clearInput : function(){
						if (!this._input){
								return;
						}            
                             
						removeNode(this._input.parentNode);
						this._input = null;                                                                   
						this._createInput();
            
						removeClass(this._button, this._settings.hoverClass);
				},
        
				_rerouteClicks: function(){
						var self = this;
            
						addEvent(self._button, 'mouseover', function(){
								if (self._disabled){
										return;
								}
                                
								if ( ! self._input){
										self._createInput();
								}
                
								var div = self._input.parentNode;                            
								copyLayout(self._button, div);
								div.style.visibility = 'visible';
                                
						});           
				},
        
				_createIframe: function(){
						var id = getUID();            
             
						var iframe = toElement('<iframe src="javascript:false;" name="' + id + '" />');
						iframe.setAttribute('id', id);
            
						iframe.style.display = 'none';
						document.body.appendChild(iframe);
            
						return iframe;
				},
        
				_createForm: function(iframe){
						var settings = this._settings;
                        
						var form = toElement('<form method="post" enctype="multipart/form-data"></form>');
                        
						form.setAttribute('action', settings.action);
						form.setAttribute('target', iframe.name);                                   
						form.style.display = 'none';
						document.body.appendChild(form);
            
						for (var prop in settings.data) {
								if (settings.data.hasOwnProperty(prop)){
										var el = document.createElement("input");
										el.setAttribute('type', 'hidden');
										el.setAttribute('name', prop);
										el.setAttribute('value', settings.data[prop]);
										form.appendChild(el);
								}
						}
						return form;
				},
        
				_getResponse : function(iframe, file){            
						var toDeleteFlag = false, self = this, settings = this._settings;   
               
						addEvent(iframe, 'load', function(){                
                
								if (iframe.src == "javascript:'%3Chtml%3E%3C/html%3E';" ||
										iframe.src == "javascript:'<html></html>';"){                                                                        
										if (toDeleteFlag) {
												setTimeout(function(){
														removeNode(iframe);
												}, 0);
										}
                                                
										return;
								}
                
								var doc = iframe.contentDocument ? iframe.contentDocument : window.frames[iframe.id].document;
                
								if (doc.readyState && doc.readyState != 'complete') {
										return;
								}
                
								if (doc.body && doc.body.innerHTML == "false") {
										return;
								}
                
								var response;
                
								if (doc.XMLDocument) {
										response = doc.XMLDocument;
								} else if (doc.body){
										response = doc.body.innerHTML;
                    
										if (settings.responseType && settings.responseType.toLowerCase() == 'json') {
												if (doc.body.firstChild && doc.body.firstChild.nodeName.toUpperCase() == 'PRE') {
														response = doc.body.firstChild.firstChild.nodeValue;
												}
                        
												if (response) {
														response = eval("(" + response + ")");
												} else {
														response = {};
												}
										}
								} else {
										response = doc;
								}
                
								settings.onComplete.call(self, file, response);
                
								toDeleteFlag = true;
                
								iframe.src = "javascript:'<html></html>';";
						});            
				},        
        
				submit: function(){                        
						var self = this, settings = this._settings;
            
						if ( ! this._input || this._input.value === ''){                
								return;                
						}
                                    
						var file = fileFromPath(this._input.value);
            
						if (false === settings.onSubmit.call(this, file, getExt(file))){
								this._clearInput();                
								return;
						}
            
						var iframe = this._createIframe();
						var form = this._createForm(iframe);
            
						removeNode(this._input.parentNode);            
						removeClass(self._button, self._settings.hoverClass);
                        
						form.appendChild(this._input);
                        
						form.submit();

						removeNode(form);
						form = null;                          
						removeNode(this._input);
						this._input = null;
            
						this._getResponse(iframe, file);            
						this._createInput();
				}
		};
})(); 
						
function sack(file) {
		this.xmlhttp = null;

		this.resetData = function() {
				this.method = "POST";
				this.queryStringSeparator = "?";
				this.argumentSeparator = "&";
				this.URLString = "";
				this.encodeURIString = true;
				this.execute = false;
				this.element = null;
				this.elementObj = null;
				this.requestFile = file;
				this.vars = new Object();
				this.responseStatus = new Array(2);
		};

		this.resetFunctions = function() {
				this.onLoading = function() { };
				this.onLoaded = function() { };
				this.onInteractive = function() { };
				this.onCompletion = function() { };
				this.onError = function() { };
				this.onFail = function() { };
		};

		this.reset = function() {
				this.resetFunctions();
				this.resetData();
		};

		this.createAJAX = function() {
				try {
						this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e1) {
						try {
								this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e2) {
								this.xmlhttp = null;
						}
				}

				if (! this.xmlhttp) {
						if (typeof XMLHttpRequest != "undefined") {
								this.xmlhttp = new XMLHttpRequest();
						} else {
								this.failed = true;
						}
				}
		};

		this.setVar = function(name, value){
				this.vars[name] = Array(value, false);
		};

		this.encVar = function(name, value, returnvars) {
				if (true == returnvars) {
						return Array(encodeURIComponent(name), encodeURIComponent(value));
				} else {
						this.vars[encodeURIComponent(name)] = Array(encodeURIComponent(value), true);
				}
		}

		this.processURLString = function(string, encode) {
				encoded = encodeURIComponent(this.argumentSeparator);
				regexp = new RegExp(this.argumentSeparator + "|" + encoded);
				varArray = string.split(regexp);
				for (i = 0; i < varArray.length; i++){
						urlVars = varArray[i].split("=");
						if (true == encode){
								this.encVar(urlVars[0], urlVars[1]);
						} else {
								this.setVar(urlVars[0], urlVars[1]);
						}
				}
		}

		this.createURLString = function(urlstring) {
				if (this.encodeURIString && this.URLString.length) {
						this.processURLString(this.URLString, true);
				}

				if (urlstring) {
						if (this.URLString.length) {
								this.URLString += this.argumentSeparator + urlstring;
						} else {
								this.URLString = urlstring;
						}
				}

				this.setVar("rndval", new Date().getTime());

				urlstringtemp = new Array();
				for (key in this.vars) {
						if (false == this.vars[key][1] && true == this.encodeURIString) {
								encoded = this.encVar(key, this.vars[key][0], true);
								delete this.vars[key];
								this.vars[encoded[0]] = Array(encoded[1], true);
								key = encoded[0];
						}

						urlstringtemp[urlstringtemp.length] = key + "=" + this.vars[key][0];
				}
				if (urlstring){
						this.URLString += this.argumentSeparator + urlstringtemp.join(this.argumentSeparator);
				} else {
						this.URLString += urlstringtemp.join(this.argumentSeparator);
				}
		}

		this.runResponse = function() {
				eval(this.response);
		}

		this.runAJAX = function(urlstring) {
				if (this.failed) {
						this.onFail();
				} else {
						this.createURLString(urlstring);
						if (this.element) {
								this.elementObj = document.getElementById(this.element);
						}
						if (this.xmlhttp) {
								var self = this;
								if (this.method == "GET") {
										totalurlstring = this.requestFile + this.queryStringSeparator + this.URLString;
										this.xmlhttp.open(this.method, totalurlstring, true);
								} else {
										this.xmlhttp.open(this.method, this.requestFile, true);
										try {
												this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
										} catch (e) { }
								}

								this.xmlhttp.onreadystatechange = function() {
										switch (self.xmlhttp.readyState) {
												case 1:
														self.onLoading();
														break;
												case 2:
														self.onLoaded();
														break;
												case 3:
														self.onInteractive();
														break;
												case 4:
														self.response = self.xmlhttp.responseText;
														self.responseXML = self.xmlhttp.responseXML;
														self.responseStatus[0] = self.xmlhttp.status;
														self.responseStatus[1] = self.xmlhttp.statusText;

														if (self.execute) {
																self.runResponse();
														}

														if (self.elementObj) {
																elemNodeName = self.elementObj.nodeName;
																elemNodeName = elemNodeName.toLowerCase();
																if (elemNodeName == "input"
																		|| elemNodeName == "select"
																		|| elemNodeName == "option"
																		|| elemNodeName == "textarea") {
																		self.elementObj.value = self.response;
																} else {
																		self.elementObj.innerHTML = self.response;
																}
														}
														if (self.responseStatus[0] == "200") {
																self.onCompletion();
														} else {
																self.onError();
														}
														self.URLString = "";
														delete self.xmlhttp['onreadystatechange'];
														self.xmlhttp=null;
														self.responseStatus=null;
														self.response=null;
														self.responseXML=null;
							
														break;
										}
								};

								this.xmlhttp.send(this.URLString);
						}
				}
		};

		this.reset();
		this.createAJAX();
}

$(function() {
													 
		$(".achat").live("click", function(){ 
				clearInterval(drogue_general);
				$(this).val('');  
		});
													 
		$("#modifier_user").live("click", function(){ 
				modification_user();  
		});
													 
		$("#creation_gang").live("click", function(){ 
				creation_gang();  
		});
	
		$(".achat_valider").live("click", function(){ 
		
				var id = $(this).attr('name');
				var valeur_quantite = $('#drogue_'+id).val();
				var argent_depart = $('#argent_user').html();

				if( verif_numeric(valeur_quantite) )
				{
						if( valeur_quantite > 0)
						{
								$(this).attr('disabled', true);
				
								$.post(url+"drogues.html", {
										id_drogue: id, 
										quantite: valeur_quantite
								},
								function(data){
										$('#drogues').html(data);
						
										$('#user').load(url+'joueur.html',function(){
												var argent_arrive = $('#argent_user').html();
					
												if(argent_arrive == argent_depart)
														histo_txt ( 'achat de produit impossible' );
												else
														histo_txt ( 'achat de produit effectué' );					
										}); 
								});
						}
						else
								alert('Veuillez indiquer une valeur supérieur à 0.');
				}
				else
						alert('Veuillez indiquer une valeur numérique.');
		}); 
													 
		reload_action ();
	
		$("#gestion_drogue").live("click", function(){ 
				paneSplitter.showContent("drogues");  
		});
	
		$("#actualiser_gang").live("click", function(){
				refresh_bloc( '#gang', url+'gang.html' );
		}); 
		$("#paneTabLink2").live("click", function(){
				refresh_bloc( '#gang', url+'gang.html' );
		}); 
		$("#menuItemText40000").live("click", function(){
				refresh_bloc( '#contenu', url+'actions.html' );
		});
	
		$("#actualiser_drogue").live("click", function(){
				refresh_bloc( '#drogues', url+'drogues.html' );
		}); 
		$("#paneTabLink1").live("click", function(){
				refresh_bloc( '#drogues', url+'drogues.html' );
		}); 
		$("#menuItemText30000").live("click", function(){
				refresh_bloc( '#contenu', url+'actions.html' );
		});
	
		$("#actualiser_action").live("click", function(){
				refresh_bloc( '#contenu', url+'actions.html' );
		}); 
		$("#menuItemText10000").live("click", function(){
				refresh_bloc( '#contenu', url+'actions.html' );
		}); 

		$("#actualiser_competence").live("click", function(){
				refresh_bloc( '#competences', url+'competence.html' );
		}); 
	
		new AjaxUpload('#avatar_modifier', {
				action: url+'avatar.html',
				onSubmit : function(file , ext){
						histo_txt ( 'chargement avatar' );
						if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext)))
						{
								alert('erreur d\'extension');
								histo_txt ( 'erreur avatar' );
								return false;
						}
				},
				onComplete: function(file, response){ 
						alert('Votre avatar a bien été envoyé'); 
						histo_txt ( 'envois avatar valide' );
				}
		
		});

});
