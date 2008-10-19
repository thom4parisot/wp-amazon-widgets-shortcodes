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
      form.setValue('widget_value', shortcode.value);

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
        var field = this[field_name], inArray = tinymce.inArray;
        alt_value = alt_value || '';
      
        if (typeof field == 'undefined')
        {
          return '';
        }

        if (field.tagName === 'INPUT' && inArray(['checkbox', 'radio'], field.type) > -1)
        {
          field.value = field.checked ? 1 : '';
        }

        return field.value ? field.value : alt_value;
      },
      setValue: function(field_name, value){
        var field = this[field_name], inArray = tinymce.inArray;

        /*
         * Checkbox/selectbox
         * @todo : test if functionnal
         */
        if (field.tagName === 'INPUT' && inArray(['checkbox', 'radio'], field.type) > -1)
        {
          field.checked = value == field.value ? true : false;
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
   * Proxy method to extract widget settings from HTML code
   * 
   * @author oncletom
   * @param {String} widget_type
   * @param {String} value_tag_name
   * @param {String} form_id
   */
  fromHtmlToForm: function(widget_type, value_tag_name, form_id){
    var widgets = this.widget;

    if (typeof widgets[widget_type] != 'object')
    {
      throw Exception('Undefined widget, what are you playing with?');
    }

    var form = document.getElementById(form_id) || document.getElementsByTagName('form')[0];
    awShortcode.form.extend(form);
    if (widgets[widget_type].fromHtmlToForm(form.getValue(value_tag_name), form))
    {
      mcTabs.displayTab('general_tab','general_panel');
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

    /*
     * Form validating
     * 
     * Note : tinyMCEPopup.alert() is only available since v3.1.0
     */
    if (!AutoValidator.validate(form))
    {
      ed.windowManager.alert(ed.getLang('invalid_data'));
      return false;
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
    /*
     * Subelements
     */
    carrousel: {
      /**
       * Populate the form from HTML code provided by Amazon
       * 
       * @param {String} html HTML code
       * @param {Object} form form to inject values in
       */
      fromHtmlToForm: function(html, form){
        form.setValue('widget_value', /id="Player_([^"]+)"/i.execAndGet(html));
        form.setValue('height', /HEIGHT="([0-9]+)px"/i.execAndGet(html));
        form.setValue('width', /WIDTH="([0-9]+)px"/i.execAndGet(html));

        return form.getValue('widget_value');
      },
      /**
       * Generate shortcode from forms value
       * 
       * @param {Object} form
       * @param {Object} name
       */
      generate: function(form, name){
        var shortcode = awShortcode.generate(name, form.getValue('widget_value'), {
          align:    form.getValue('align'),
          bgcolor:  form.getValue('bgcolor'),
          height:   form.getValue('height'),
          width:    form.getValue('width')
        });

        return shortcode;
      }
    },
    product: {
      /**
       * Populate the form from HTML code provided by Amazon
       * 
       * @param {String} html HTML code
       * @param {Object} form form to inject values in
       */
      fromHtmlToForm: function(html, form){

        /*
         * Text + images
         */
        if (/<iframe src/i.test(html))
        {
          form.setValue('widget_value', /asins=([0-9]+)&/i.execAndGet(html));
          form.setValue('alink', /lc1=([0-9a-f]+)&/i.execAndGet(html));
          form.setValue('bordercolor', /bc1=([0-9a-f]+)&/i.execAndGet(html));
          form.setValue('height', /height:([0-9]+)px/i.execAndGet(html));
          form.setValue('small', /IS2=1&/i.test(html) ? 0 : 1);
          form.setValue('target', /lt1=([^&])+&/i.execAndGet(html));
          form.setValue('width', /width:([0-9]+)px"/i.execAndGet(html));
        }

        return form.getValue('widget_value');
      },
      /**
       * Generate shortcode from forms value
       * 
       * @param {Object} form
       * @param {Object} name
       */
      generate: function(form, name){
        var shortcode = awShortcode.generate(name, form.getValue('widget_value'), {
          align:        form.getValue('align'),
          alink:        form.getValue('alink'),
          bgcolor:      form.getValue('bgcolor'),
          bordercolor:  form.getValue('bordercolor'),
          height:       form.getValue('height'),
          small:        form.getValue('small'),
          target:       form.getValue('target'),
          width:        form.getValue('width')
        });

        return shortcode;
      }
    },
    productcloud: {
      /**
       * Populate the form from HTML code provided by Amazon
       * 
       * @param {String} html HTML code
       * @param {Object} form form to inject values in
       */
      fromHtmlToForm: function(html, form){
        var widget_value = /<SCRIPT.+([a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12})"/i.execAndGet(html);

        form.setValue('widget_value', widget_value);

        return form.getValue('widget_value');
      },
      generate: function(form, name){
        var shortcode = awShortcode.generate(name, form.getValue('widget_value'), {
          align:    form.getValue('align'),
          alt:      form.getValue('alt')
        });

        return shortcode;
      }
    },
    slideshow: {
      /**
       * Populate the form from HTML code provided by Amazon
       * 
       * @param {String} html HTML code
       * @param {Object} form form to inject values in
       */
      fromHtmlToForm: function(html, form){
        form.setValue('widget_value', /id="Player_([^"]+)"/i.execAndGet(html));
        form.setValue('height', /HEIGHT="([0-9]+)px"/i.execAndGet(html));
        form.setValue('width', /WIDTH="([0-9]+)px"/i.execAndGet(html));

        return form.getValue('widget_value');
      },
      generate: function(form, name){
        var shortcode = awShortcode.generate(name, form.getValue('widget_value'), {
          align:    form.getValue('align'),
          bgcolor:  form.getValue('bgcolor'),
          height:   form.getValue('height'),
          width:    form.getValue('width')
        });

        return shortcode;
      }
    },
    wishlist: {
      /**
       * Populate the form from HTML code provided by Amazon
       * 
       * @param {String} html HTML code
       * @param {Object} form form to inject values in
       */
      fromHtmlToForm: function(html, form){
        var widget_value = /<SCRIPT.+([a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12})"/i.execAndGet(html);

        form.setValue('widget_value', widget_value);

        return form.getValue('widget_value');
      },
      generate: function(form, name){
        var shortcode = awShortcode.generate(name, form.getValue('widget_value'), {
          align:    form.getValue('align'),
          alt:      form.getValue('alt')
        });

        return shortcode;
      }
    }
  }
};

/*
 * Custom and internal functions
 */

/**
 * Execute a RegExp and extract a result by index
 * 
 * @author tparisot
 * @param {String} haystack String to apply the regular expression on
 * @param {Integer} index Index of the regexp result to return, if not empty
 */
RegExp.prototype.execAndGet = function(haystack, index){
  index = index || 1;

  var result = this.exec(haystack) || '';
  return result ? result[index] : '';
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