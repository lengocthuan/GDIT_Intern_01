/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'kcfinder' ) + 'browse.php?type=files' );
    config.filebrowserImageBrowseUrl = CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'kcfinder' ) + 'browse.php?type=images' );
    config.filebrowserFlashBrowseUrl = CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'kcfinder' ) + 'browse.php?type=flash' );
    config.filebrowserUploadUrl = CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'kcfinder' ) + 'upload.php?type=files' );
    config.filebrowserImageUploadUrl = CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'kcfinder' ) + 'upload.php?type=images' );
    config.filebrowserFlashUploadUrl = CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'kcfinder' ) + 'upload.php?type=flash' );
};
