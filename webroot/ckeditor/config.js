/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.filebrowserBrowseUrl = '/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

	//config.extraPlugins = 'video,html5video,widget,widgetselection,clipboard,lineutils';

	config.height = '500px';
	config.width = '100%';
	config.toolbar = 'Full';

	config.htmlEncodeOutput = false;
    config.entities = false;
    config.entities_latin = false;
    config.ForceSimpleAmpersand = true;
};
