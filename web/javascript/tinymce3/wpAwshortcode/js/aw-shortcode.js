/**
 * @author tparisot
 * @since 1.0
 * @package tinymce
 */

var awShortcode = {
  /**
   * Proxy method to inject a shortcode in TinyMCE Editor
   * 
   * @author oncletom
   * @since 1.0
   * @version 1.0
   * @param {Object} type 
   * @param {Object} el DOM element. Only support form for now
   */
  sendToRte: function(type, form){
    form = form || document.getElementsByTagName('form')[0];

    if (typeof awShortcode.widget[type] == 'undefined')
    {
      throw('Unsupported Widget type. Hm, what are you playing with?');
    }

    return false;
  },
  widget: {
    carrousel: {
      
    },
    product: {
      
    },
    slideshow: {
      
    },
    wishlist: {
      
    }
  }
};
