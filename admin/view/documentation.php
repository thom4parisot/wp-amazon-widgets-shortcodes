<div id="awshortcode-documentation" class="postbox closed">
  <h3><?php _e('Amazon Widgets Shortcodes documentation', 'awshortcode') ?></h3>

  <div class="inside">
 * **Shortcode**: [amazon-carrousel][/amazon-carrousel]
 * **CSS Class**: `awshortcode-carrousel`
 * **Options**:
  * *align* [left, right, center]: align the widget on the desired way
  * *bgcolor* (CSS hexa or code value): customize the background color of the widget
  * *height* (value in pixels): height of the animation
  * *width* (value in pixel): width of the animation
 * **Content**:
  * URI provided in the code to paste, usually starting by `http://ws.amazon.com/widgets/`
 * **Example**: `[amazon-carrousel]http://ws.amazon.fr/widgets/q?ServiceVersion=20070822&MarketPlace=FR&ID=V20070822%2FFR%2Fonctom-21%2F8010%2Ffc64116b-6b59-444b-b4ee-074a4adecf57&Operation=NoScript[/amazon-carrousel]`

= Amazon Product =
For now, it only handles this widget in the "Text + picture" version.

 * **Shortcode**: [amazon-product][/amazon-product]
 * **CSS Class**: `awshortcode-product`
 * **Options**:
  * *align* [left, right, center]: align the widget on the desired way
  * *alink* (CSS hexa or code value): hypertext link color
  * *bgcolor* (CSS hexa or code value): customize the background color of the widget
  * *bordercolor* (CSS hexa or code value): border color of the widget
  * *height* (value in pixels): height of the frame
  * *small* [0, 1]: display a small picture or a big one (0 by default)
  * *target* (string): window name to open the link in (_blank by default)
  * *width* (value in pixel): width of the frame
 * **Content**:
  * ASIN code of the product 
 * **Example**: `[amazon-product]0596529309[/amazon-product]`
  </div>
</div>
