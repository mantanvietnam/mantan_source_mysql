/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.filebrowserBrowseUrl = '/webroot/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/webroot/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/webroot/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/webroot/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/webroot/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/webroot/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

	//config.extraPlugins = 'video,html5video,widget,widgetselection,clipboard,lineutils';
	config.extraPlugins = 'ckeditor_wiris';

	config.height = '500px';
	config.width = '100%';
	config.toolbar = 'Full';

	config.htmlEncodeOutput = false;
    config.entities = false;
    config.entities_latin = false;
    config.ForceSimpleAmpersand = true;
};
