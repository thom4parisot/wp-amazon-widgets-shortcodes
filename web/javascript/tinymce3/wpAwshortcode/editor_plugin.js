(function() {
  tinymce.PluginManager.requireLangPack('wpAwshortcode');

  tinymce.create('tinymce.plugins.wpAwshortcodePlugin', {
    /**
     * Initializes the plugin, this will be executed after the plugin has been created.
     * This call is done before the editor instance has finished it's initialization so use the onInit event
     * of the editor instance to intercept that event.
     *
     * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
     * @param {string} url Absolute URL to where the plugin is located.
     */
    init : function(ed, url) {
      var t = this;

      ed.addCommand('wpAwshortcodeSelector', function(ui, val) {
        /*
         * Popup arguments
         */
        var popupArgs = [];
        popupArgs.push('tinymce='+escape(tinymce.baseURL));

        ed.windowManager.open({
          file : url + '/shortcode-'+val+'.html?'+popupArgs.join('&'),
          width : 450 + 'px',
          height : 450 + 'px',
          inline : 1
        }, {
          plugin_url : url,
          shortcode: val
        });
      });

      /*
       * Load additional CSS
       */
      ed.onInit.add(function() {
        if (ed.settings.content_css !== false)
        {
          dom = ed.windowManager.createInstance('tinymce.dom.DOMUtils', document);
          /*
           * Load first for the viewport
           * And then, inside the RTE frame
           */
          dom.loadCSS(url + '/css/content.css');
          ed.dom.loadCSS(url + '/css/content.css');
        }
      });

      /*
       * Select the item on node change
       * 
       * @todo replace it with t._selectMenu call
       */
      ed.onNodeChange.add(function(ed){
        t._selectMenu(ed);
      });

      /*
       * From Editor to saved content (in database)
       * 
       * We basically remove span element
       */
      ed.onSetContent.add(function(ed, o){
        o.content = o.content.replace(/<span[^>]+>([^<]*)<\/span>/g, "$1");
      });

      /*

        ed.selection.onSetContent.add(function() {
          t._spansToImgs(ed.getBody());
        });

        ed.selection.onBeforeSetContent.add(t._objectsToSpans, t);
       */

      /*
       * From database to Editor
       * 
       * We encapsulate shortcode in span elements
       */
      ed.onBeforeSetContent.add(function(ed, o){
        o.content = o.content.replace(
          /(\[amazon-[a-z0-9]+[^\]]*\][^\[]+\[\/(amazon-[a-z0-9]+)\])/g,
          "<span class=\"awshortcode $2\">$1</span>"
        );
      });

      /*

      ed.onBeforeSetContent.add(t._objectsToSpans, t);

      ed.onSetContent.add(function() {
        t._spansToImgs(ed.getBody());
      });
       */
    },

    /**
     * Creates control instances based in the incomming name. This method is normally not
     * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
     * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
     * method can be used to create those.
     *
     * @param {String} n Name of the control to create.
     * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
     * @return {tinymce.ui.Control} New control instance or null if no control was created.
     */
    createControl : function(n, cm) {
      var t = this, menu = t._cache.menu, c, ed = tinyMCE.activeEditor, each = tinymce.each;

      if (n != 'awshortcode-selector')
      {
        return null;
      }

      c = cm.createSplitButton(n, {
        cmd:    '',
        scope : t,
        title : 'wpAwshortcode.desc'
      });

      c.onRenderMenu.add(function(c, m) {
        m.add({
          'class': 'mceMenuItemTitle',
          title:   'wpAwshortcode.desc'
        }).setDisabled(1);

        each(t.shortcodes, function(value, key) {
          var o = {icon : 0}, mi;

          o.onclick = function() {
            ed.execCommand('wpAwshortcodeSelector', true, key);
          };

          o.title = value;
          mi = m.add(o);
          menu[key] = mi;
        });

        t._selectMenu(ed);
      });

      return c;
    },
    /**
     * Shortcodes list
     * 
     * @since 1.1
     */
    shortcodes: {
      'amazon-carrousel': 'wpAwshortcode.amazon_carrousel',
      'amazon-product':   'wpAwshortcode.amazon_product',
      'amazon-slideshow': 'wpAwshortcode.amazon_slideshow'
    },
    /**
     * Returns information about the plugin as a name/value array.
     * The current keys are longname, author, authorurl, infourl and version.
     *
     * @return {Object} Name/value array containing information about the plugin.
     */
    getInfo : function() {
      return {
        longname:  'Amazon Widgets Shortcodes',
        author:    'Oncle Tom',
        authorurl: 'http://oncle-tom.net',
        infourl:   'http://wordpress.org/extend/plugins/amazon-widgets-shortcodes/',
        version:   '1.0'
      };
    },
    /*
     * Private controls
     */
    /*
     * Cache references
     */
    _cache: {
      menu: {}
    },
    /**
     * Select an item menu based on its classname
     * 
     * @since 1.1
     * @version 1.0
     * @param {Object} ed TinyMCE Editor reference
     */
    _selectMenu: function(ed){
      var fe  =  ed.selection.getNode(), each = tinymce.each, menu = this._cache.menu;

      each(this.shortcodes, function(value, key){
        if (typeof menu[key] == 'undefined' || !menu[key])
        {
          return;
        }

        menu[key].setSelected(ed.dom.hasClass(fe, key));
      });
    }
  });

  // Register plugin
  tinymce.PluginManager.add('wpAwshortcode', tinymce.plugins.wpAwshortcodePlugin);
})();