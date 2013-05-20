var paneModel = new DHTMLSuite.paneSplitterModel( {
		collapseButtonsInTitleBars:true
} );
var messageObj = new DHTMLSuite.modalMessage();

DHTMLSuite.commonObj.setCssCacheStatus(true);

var paneNorth = new DHTMLSuite.paneSplitterPaneModel( {
		position:"north", 
		id:"menuTop",
		size:40,
		scrollbars:false,
		resizable:false
} );
paneNorth.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:"menu",
		htmlElementId:'menu'
} ) );

var paneWest = new DHTMLSuite.paneSplitterPaneModel( {
		position:"west", 
		id:"westPane",
		size:210,
		minSize:210,
		maxSize:300,
		callbackOnCollapse:'callbackFunction',
		callbackOnExpand:'callbackFunction',
		callbackOnShow:'callbackFunction',
		callbackOnHide:'callbackFunction',
		callbackOnSlideIn:'callbackFunction',
		callbackOnSlideOut:'callbackFunction',
		callbackOnResize:'callBackFunctionResizePane'
} );

paneWest.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:"user",
		htmlElementId:'user',
		title:'Vos informations <i class="jaune cursor" id="avatar_modifier">modifier avatar</i>', 
		tabTitle:'Info',
		closable:false
} ) );
paneWest.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:"historique",
		htmlElementId:'historique',
		title:'Votre historique',
		tabTitle:'Histo',
		closable:false
} ) );
paneWest.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:"competences",
		htmlElementId:'competences',
		title:'Vos compétences <i class="jaune cursor ajax_button" id="actualiser_competence">Actualiser la page</i>',
		tabTitle:'Compét',
		closable:false
} ) );


var paneSouth = new DHTMLSuite.paneSplitterPaneModel( {
		position:"south", 
		id:"southPane",
		size:180,
		scrollbars:false,
		resizable:false,
		callbackOnCollapse:'callbackFunction'
} );
paneSouth.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:"tchat",
		htmlElementId:'tchat',
		title:'Discuter sur le réseau',
		closable:false
} ) );

var paneCenter = new DHTMLSuite.paneSplitterPaneModel( {
		position:"center", 
		id:"centerPane",
		size:600,
		resizable:false,
		callbackOnCloseContent:'callbackFunction',
		callbackOnTabSwitch:'callbackFunction'
} );
paneCenter.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:'contenu',
		htmlElementId:'contenu',
		tabTitle:'Actions',
		title:'Action(s) de votre personnage <i class="jaune cursor ajax_button" id="actualiser_action">Actualiser la page</i>', 
		closable:false
} ) );
paneCenter.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:'drogues',
		htmlElementId:'drogues',
		tabTitle:'Deal',
		title:'Gestion de vos produits <i class="jaune cursor ajax_button" id="actualiser_drogue">Actualiser la page</i>',
		closable:false
} ) );
paneCenter.addContent( new DHTMLSuite.paneSplitterContentModel( {
		id:'gang',
		htmlElementId:'gang',
		tabTitle:'Gang',
		title:'Espace pour le gang <i class="jaune cursor ajax_button" id="actualiser_gang">Actualiser la page</i>',
		closable:false
} ) );

paneModel.addPane(paneNorth);
paneModel.addPane(paneSouth);
paneModel.addPane(paneWest);
paneModel.addPane(paneCenter);

var paneSplitter = new DHTMLSuite.paneSplitter();
paneSplitter.addModel(paneModel);
paneSplitter.init();

paneSplitter.reloadContent('user');

var menuModel = new DHTMLSuite.menuModel();
menuModel.addItemsFromMarkup('menuModel');
menuModel.setMainMenuGroupWidth(00);	
menuModel.init();

var menuBar = new DHTMLSuite.menuBar();
menuBar.addMenuItems(menuModel);
menuBar.setTarget('innerDiv');
menuBar.init();