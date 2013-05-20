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