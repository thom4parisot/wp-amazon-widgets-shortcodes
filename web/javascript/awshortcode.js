/**
 * @author oncletom
 * @since 1.0 beta 1
 * @version 1.0
 */
(function($){
  /*
   * Main execution
   */
  $(function(){
    /*
     * Add tabs for options page
     */
    $('#awshortcode #awshortcode-navigation').tabs({
      fxFade: true,
      select: 0
    });

    $('#awshortcode div.awshortcode-documentation').removeClass('closed');

    /*
     * Open links in a new page
     */
    $('#awshortcode a.new-window').click(function(){
      window.open(this.href, '_blank');
      $(this).attr('rel', 'external');
      return false;
    });
  });
})(jQuery);
