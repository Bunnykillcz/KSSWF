/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
CKEDITOR.editorConfig = function( config ) {
	config.toolbar = [
		{ name: 'document', items: [ 'Source', '-', '-', 'Undo', 'Redo', '-'/*, 'Save', 'NewPage', 'Preview'*/, 'Print', '-', /*'Templates'*/ ] },
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord' ] },
		{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
		{ name: 'insert', items: [ 'EasyImageUpload', 'Flash', 'Table', 'HorizontalRule', /*'Smiley',*/ 'SpecialChar', /*'PageBreak',*/ 'Iframe' ] },
		{ name: 'about', items: [ 'About' ] },
		'/',
		{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', /*'Outdent', 'Indent', '-',*/ 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',/* '-', 'BidiLtr', 'BidiRtl', 'Language'*/ ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [  'ShowBlocks', 'Maximize', '-'] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] }
	];
	
	config.language = 'en';
	config.uiColor = '#607d8b';/*'#F7B42C';*/
	config.height = 500;
	config.toolbarCanCollapse = true;
};
