<?php
class Fck_Core
{
	function editeur ( $name, $value = '', $height = '500px', $width = '100%', $type = 'Default'  )
	{
		require_once DOCROOT.'js/fckeditor/fckeditor.php';
		$oFCKeditor = new FCKeditor( $name );
		
		$oFCKeditor->BasePath = url::base().'/js/fckeditor/';
		$oFCKeditor->Value = $value;
		$oFCKeditor->Config['EnterMode'] = 'br';
		$oFCKeditor->Config['AutoDetectLanguage'] = false;
		$oFCKeditor->Config['DefaultLanguage'] = 'fr';
		$oFCKeditor->Config["UserFilesAbsolutePath"] = url::base().'/images/';
		$oFCKeditor->Config["UserFilesPath"] = url::base().'/images/';
		$oFCKeditor->SmileyPath = $oFCKeditor->BasePath + 'images/smiley/msn/';
		$oFCKeditor->Height = $height;
		$oFCKeditor->Width = $width;
		$oFCKeditor->FormatOutput = true;
		$oFCKeditor->FormatSource = true;
		$oFCKeditor->ToolbarSet = $type;
		$oFCKeditor->Create();
	}
}
?>