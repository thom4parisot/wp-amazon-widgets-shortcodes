/**
* @author oncletom
* @since 1.0
* @package tinymce
*/

var awShortcode = {
  /**
   * Assembling shortcode to send it to the editor
   * 
   * @author oncletom
   * @param {String} name
   * @param {String} value
   * @param {Object} attr
   * @return {String} shortcode
   */
  generate: function(name, value, attr){
    var each = tinymce.each;
    value = value || '';
    attr  = attr || [];

    /*
     * Nothing ? Don't give up yet !
     */
    if (!value)
    {
      return false;
    }

    var shortcode = '['+name;
    each(attr, function(value, key){

      /*
       * No value ? No need to save it
       */
      if (!value)
      {
        return false;
      }

      shortcode += ' ';
      shortcode += jsEncode(key);
      shortcode += '="';
      shortcode += jsEncode(value);
      shortcode += '"';
    });

    shortcode += ']';
    shortcode += value;
    shortcode += '[/'+name+']';

    return shortcode;
  },
  /**
   * Parse a shortcode from its HTML DOM node
   * 
   * @author oncletom
   * @since 1.1
   * @version 1.0
   * @param {Object} node HTML DOM node
   */
  parse: function(node){
    var dom = tinyMCEPopup.editor.dom;
    var shortcode_tag = node.textContent;
    var shortcode = {
      atts: {},
      type: '',
      value: ''
    };

    /*
     * Parsing type
     */
    shortcode.type = /(amazon-[0-9a-z]+)( |$)/.exec(node.className)[1];

    /*
     * Parsing value 
     */
    shortcode.value = /\](.*)\[\//.exec(shortcode_tag)[1]

    /*
     * Parsing attributes
     */
    console.log(node);

    return shortcode;
  },
  /**
   * Proxy method to inject a shortcode in TinyMCE Editor
   * 
   * @author oncletom
   * @since 1.1
   * @version 1.0
   * @param {Object} type 
   * @param {Object} el DOM element. Only support form for now
   */
  sendToRte: function(type, form){
    form = form || document.getElementsByTagName('form')[0];
    var p = tinyMCEPopup, ed = p.editor, fe = ed.selection.getNode();

    if (typeof awShortcode.widget[type] == 'undefined')
    {
      throw('Unsupported Widget type. Hm, what are you playing with?');
    }

    p.restoreSelection();
    form.getValue = formGetValue;
    var shortcode = awShortcode.widget[type].generate(form, 'amazon-'+type);

    /*
     * No shortcode ? Hm, don't want to insert anything in the editor I guess
     */
    if (!shortcode)
    {
      p.close();
      return false;
    }

    /*
     * Updating a selection
     */
    if (fe && /(^| )awshortcode( |$)/.test(ed.dom.getAttrib(fe, 'class')))
    {
     console.log(ed.dom.getAttrib(fe, 'class')); 
      ed.dom.setAttrib(fe, 'class', '');
      ed.dom.addClass(fe, 'awshortcode');
      ed.dom.addClass(fe, 'amazon-'+type);
      ed.dom.setHTML(fe, shortcode);
    }
    /*
     * Inserting in the editor
     */
    else
    {
      p.execCommand(
        'mceInsertContent',
        false,
        '<span class="awshortcode amazon-'+type+'">'+shortcode+'</span>'
      );
    }

    p.close();
    return false;
  },
  /**
   * Widgets settings and callbacks
   */
  widget: {
    carrousel: {
      /**
       * Generate shortcode from forms value
       * @param {Object} form
       * @param {Object} name
       */
      generate: function(form, name){
        var shortcode = awShortcode.generate(name, form.widget_id.value, {
          align:    form.getValue('align'),
          bgcolor:  form.getValue('bgcolor'),
          height:   form.getValue('height'),
          width:    form.getValue('width')
        });

        return shortcode;
      }
    },
    product: {
      generate: function(form, name){
        
      }
    },
    slideshow: {
      generate: function(form, name){
        
      }
    },
    wishlist: {
      generate: function(form, name){
        
      }
    }
  }
};

/*
 * Custom and internal functions
 */

function formGetValue(field_name, alt_value)
{
  if (!this.nodeName || this.nodeName != 'FORM')
  {
    return '';
  }

  return this.field_name ? this.field_name : alt_value;
}

/**
 * Encode a value and assume it can be an HTML attribute value
 * 
 * @author oncletom
 * @param {String} val Initial value to clean
 * @return {String} val Sanitized value
 */
function jsEncode(val)
{
  val = val.replace(/\\\\/, '\\\\');
  val = val.replace(/["']/, '');

  return val;
}