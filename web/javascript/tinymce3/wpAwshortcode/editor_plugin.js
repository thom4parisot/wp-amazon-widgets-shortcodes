(function() {
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
      ed.addCommand('wpAwshortcodeSelector', function() {
        ed.windowManager.open({
          file : url + '/dialog.html',
          width : 320 + ed.getLang('example.delta_width', 0),
          height : 120 + ed.getLang('example.delta_height', 0),
          inline : 1
        }, {
          plugin_url : url
        });
      });

      /*
       * Load additional CSS
       */
      ed.onInit.add(function() {
        if (ed.settings.content_css !== false)
        {
          ed.dom.loadCSS(url + '/css/content.css');
        }
      });

      // Add a node change handler, selects the button in the UI when a image is selected
      //ed.onNodeChange.add(function(ed, cm, n) {
      //cm.setActive('awshortcode-selector', n.nodeName == 'IMG');
      //});
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
      var t = this, c, ed = t.editor, each = tinymce.each;

      if (n != 'awshortcode-selector')
      {
        return null;
      }

      c = cm.createSplitButton(n, {
        scope : t,
        title : 'awshortcode-selector.desc'
      });

      c.onRenderMenu.add(function(c, m) {
        var shortcodes = {
          'amazon-carrousel': 'amazon.carrousel',
          'amazon-product':   'amazon.product',
          'amazon-slideshow': 'amazon.slideshow'
        };

        each(shortcodes, function(value, key) {
          var o = {icon : 0}, mi;

          o.onclick = function() {
            tinyMCE.activeEditor.execCommand('wpAwshortcodeSelector', true, key);
          };

          o.title = value;
          mi = m.add(o);
        })
      });

      return c;
    },

    /**
     * Returns information about the plugin as a name/value array.
     * The current keys are longname, author, authorurl, infourl and version.
     *
     * @return {Object} Name/value array containing information about the plugin.
     */
    getInfo : function() {
      return {
        longname : 'Amazon Widgets Shortcodes',
        author : 'Oncle Tom',
        authorurl : 'http://oncle-tom.net',
        infourl : 'http://wordpress.org/extend/plugins/amazon-widgets-shortcodes/',
        version : '1.0'
      };
    }
  });

  // Register plugin
  tinymce.PluginManager.add('wpAwshortcode', tinymce.plugins.wpAwshortcodePlugin);
})();