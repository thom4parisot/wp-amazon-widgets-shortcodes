<?php
/**
 * Admin functions
 * 
 * @author oncletom
 * @version 1.0
 * @since 1.0 alpha 2
 */
class AmazonWidgetsShortcodesAdmin
{
  function displayOptions()
  {
    include AWS_PLUGIN_BASEPATH.'/admin/form/options.php';
    include AWS_PLUGIN_BASEPATH.'/admin/view/options.php';
  }
}