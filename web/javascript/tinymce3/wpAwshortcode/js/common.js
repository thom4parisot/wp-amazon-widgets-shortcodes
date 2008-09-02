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
    var p = tinyMCEPopup, ed = p.editor, fe = ed.selection, dom = ed.dom;
    p.resizeToInnerSize();

    /*
     * Color picker
     */
    tinymce.each(dom.select('div', document), function(el){
      if (!dom.hasClass(el, 'colorpicker'))
      {
        return;
      }

      var elinfos = el.id.split(/_/);
      getById(el.id).innerHTML = getColorPickerHTML(elinfos[0]+'_'+elinfos[1], elinfos[0]);
      getById(elinfos[0]).onchange();
      
    });

    /*
     * Form populating
     */
    var shortcode = awShortcode.parse(fe);
    awShortcode.form.populate(document.getElementById('widget-form'), shortcode);

    if (shortcode.type)
    {
      getById('insert').value = ed.getLang('update', 'Insert', true);
    }
  }

  function getById(id, scope)
  {
    scope = scope || document;
    return scope.getElementById(id) || '';
  }

  /*
   * Event registration
   */
  tinyMCEPopup.onInit.add(init);
})(tinyMCEPopup);