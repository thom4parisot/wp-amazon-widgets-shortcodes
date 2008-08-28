/**
 * Initial bootstrap to load tinymce and all needed dependencies
 * 
 * @author oncletom
 * @since 1.0
 * @package tinymce
 */

(function(){
  /*
   * Matching TinyMCE Url and loading it
   */
  var matches = /tinymce=(.+)(&|$)/.exec(window.location.href);
  var tinymce_baseUrl = matches[1] || '';

  if (tinymce_baseUrl)
  {
    document.write('<script type="text/javascript" src="'+unescape(tinymce_baseUrl)+'/tiny_mce_popup.js"></'+'script>');
  }
})();