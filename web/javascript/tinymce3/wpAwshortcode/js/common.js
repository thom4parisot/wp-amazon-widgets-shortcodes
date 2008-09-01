/**
 * @author oncletom
 * @since 1.0
 * @package tinymce
 */

(function(tinyMCEPopup){
  tinyMCEPopup.requireLangPack();

  /*
   * Main init function
   * Later called by tinyMCEPopup.onInit.add() method
   */
  function init()
  {
    var p = tinyMCEPopup, ed = p.editor, fe = ed.selection.getNode();
    p.resizeToInnerSize();

    /*
     * Form populating
     */
    var shortcode = awShortcode.parse(fe);
    console.log(shortcode);
  }

  /*
   * Event registration
   */
  tinyMCEPopup.onInit.add(init);
})(tinyMCEPopup);