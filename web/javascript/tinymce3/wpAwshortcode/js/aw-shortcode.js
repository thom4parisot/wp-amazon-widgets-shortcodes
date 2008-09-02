/**
* @author oncletom
* @since 1.0
* @package tinymce
*/

var awShortcode = {
  /**
   * Form manipulation
   * 
   * @author oncletom
   * @since 1.1
   */
  form: {
    /**
     * Extend a form object with getter and setter methods
     * 
     * @author oncletom
     * @since 1.1
     * @param {Object} form DOM reference to the form
     */
    extend: function(form){
      tinymce.each(this._extend, function(value, key){
        form[key] = value;
      });
    },
    /**
     * Populate a form with a shortcode object
     * 
     * @param {Object} form DOM reference to the form
     * @param {Object} shortcode Shortcode object {atts, type, value}
     */
    populate: function(form, shortcode){
      awShortcode.form.extend(form);

      /*
       * Populating shortcode value
       */
      if (form['widget_id'])
      {
        form.setValue('widget_id', shortcode.value);
      }

      /*
       * Populating attributes
       */
      tinymce.each(shortcode.atts, function(value, key){
        form.setValue(key, value);
      });
    },
    _extend: {
      getValue: function(field_name, alt_value)
      {
        var field = this[field_name];
        alt_value = alt_value || '';
      
        if (typeof field == 'undefined')
        {
          return '';
        }
      
        return field.value ? field.value : alt_value;
      },
      setValue: function(field_name, value){
        var field = this[field_name];
        var inArray = tinymce.inArray;

        /*
         * Checkbox/selectbox
         * @todo : test if functionnal
         */
        if (field.tagName === 'INPUT' && inArray(['checkbox', 'radio'], field.type) > -1)
        {
          field.value = value || '';
        }
        /*
         * Selectbox
         */
        else if (field.tagName === 'SELECT')
        {
          field.value = value || '';
        }
        /*
         * Input field
         */
        else
        {
          field.value = value || '';
        }
      }
    }
    
  },
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
    each(attr, function(value, key)
    {
      /*
       * No value ? No need to save it
       */
      if (!value)
      {
        return '';
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
   * @param {Object} tinyMCE Selection
   */
  parse: function(fe){
    var dom = tinyMCEPopup.editor.dom;
    var node = fe.getNode();
    var shortcode = {
      atts: {},
      type: '',
      value: ''
    };

    /*
     * No content or no selection
     */
    if (!dom.hasClass(node, 'awshortcode'))
    {
      return shortcode;
    }

    /*
     * Parsing type
     */
    shortcode.type = /(amazon-[0-9a-z]+)( |$)/.exec(dom.getAttrib(node, 'class'))[1];

    /*
     * Parsing value 
     */
    shortcode.value = /\](.*)\[\//.exec(node.innerHTML)[1]

    /*
     * Parsing attributes
     */
    node.innerHTML.replace(/ ([a-z0-9]+)="([^"]*)"/g, function(match, key, value){
      shortcode.atts[key] = value;
    });

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
    awShortcode.form.extend(form);
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
        var shortcode = awShortcode.generate(name, form.getValue('widget_id'), {
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