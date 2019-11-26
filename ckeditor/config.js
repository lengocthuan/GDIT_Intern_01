/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = 'http://managementpage.gdit.vn/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = 'http://managementpage.gdit.vn/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = 'http://managementpage.gdit.vn/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
    // config.filebrowserUploadUrl = '/var/www/html/GDIT/app/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
    // config.filebrowserImageUploadUrl = 'http://localhost/GDIT/app/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = 'http://managementpage.gdit.vn/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

    config.extraPlugins = 'filebrowser';
    config.extraPlugins = 'attach';
    config.filebrowserBrowseUrl = 'http://managementpage.gdit.vn/ckeditor/kcfinder/browse.php';
    // config.filebrowserUploadUrl = 'http://localhost/GDIT/app/ckeditor/kcfinder/upload.php';
    config.language = 'en';
    // config.removePlugins = 'forms';
    // config.height: '100';
    // config.width: '100%';
    // config.removeButtons = 'Form';
    // config.skin = 'bootstrapck'

    config.toolbar = [
        { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        { name: 'about', items: [ 'About' ] }
    ];
};
