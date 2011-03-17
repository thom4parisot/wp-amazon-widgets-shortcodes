<?php
/**
 * @author oncletom
 */

class AmazonWidgetsShortcodeDummy extends AmazonWidgetsShortcodeBase
{
  /**
   * @see AmazonWidgetsShortcode::displayAsHtml()
   * @see AmazonWidgetsShortcodeBase::displayAsHtml()
   */
  function displayAsHtml($attributes, $value = null)
  {
    return '';
  }

  /**
   * @see AmazonWidgetsShortcode::shortcodeToHtml()
   */
  function shortcodeToHtml($attributes, $value = null)
  {
    return '';
  }
}
