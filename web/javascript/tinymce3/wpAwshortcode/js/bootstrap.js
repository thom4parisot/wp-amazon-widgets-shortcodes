/**
 * Initial bootstrap to load tinymce and all needed dependencies
 * 
 * Its main magic consists to load everything without hard links. Bulletproof!
 * 
 * @author oncletom
 * @since 1.1
 * @package tinymce
 */

(function(){
  /*
   * Matching TinyMCE Url and loading it
   */
    var matches = /tinymce=([^$&]+)/.exec(window.location.href);
    var tinymce_baseUrl = matches[1] || '';

    document.write('<script type="text/javascript" src="'+unescape(tinymce_baseUrl)+'/tiny_mce_popup.js"></'+'script>');
    document.write('<script type="text/javascript" src="'+unescape(tinymce_baseUrl)+'/utils/mctabs.js"></'+'script>');
    document.write('<script type="text/javascript" src="'+unescape(tinymce_baseUrl)+'/utils/form_utils.js"></'+'script>');
    document.write('<script type="text/javascript" src="'+unescape(tinymce_baseUrl)+'/utils/validate.js"></'+'script>');
})();
