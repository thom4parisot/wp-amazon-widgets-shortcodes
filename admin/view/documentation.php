<div id="awshortcode-documentation" class="postbox closed">
  <h3><?php _e('Amazon Widgets Shortcodes documentation', 'awshortcode') ?></h3>

  <div class="inside">
    <h4><?php _e('Amazon Carrousel', 'awshortcode') ?></h4>
    <ul>
      <li>
        <strong><?php _e('Shortcode:', 'awshortcode') ?></strong>
        <code>[amazon-carrousel][/amazon-carrousel]</code>
      </li>
      <li>
        <strong><?php _e('Example:', 'awshortcode') ?></strong>
        <code>[amazon-carrousel align="right"]fc64116b-6b59-444b-b4ee-074a4adecf57[/amazon-carrousel]</code>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?></strong>
        <ul>
          <li>
            <code>align</code>:
            {left, right, center}
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>bgcolor</code>:
            [<?php _e('CSS hexa or code value', 'awshortcode') ?>]
            <?php _e('customize the background color of the widget', 'awshortcode') ?>
          </li>
          <li>
            <code>height</code>:
            [<?php _e('value in pixels', 'awshortcode') ?>]
            <?php _e('height of the animation', 'awshortcode') ?>
          </li>
          <li>
            <code>width</code>:
            [<?php _e('value in pixels', 'awshortcode') ?>]
            <?php _e('width of the animation', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Content:', 'awshortcode') ?></strong>
        <?php _e('Widget ID, contained in HTML parameter value like this:', 'awshortcode') ?>
        <code>Player_<span style="background: #ffc">fc64116b-6b59-444b-b4ee-074a4adecf57</span></code>.
      </li>
    </ul>

    <h4><?php _e('Amazon My Favorites', 'awshortcode') ?></h4>
    <ul>
      <li>
        <strong><?php _e('Shortcode:', 'awshortcode') ?></strong>
        <code>[amazon-wishlist][/amazon-wishlist]</code>
      </li>
      <li>
        <strong><?php _e('Example:', 'awshortcode') ?></strong>
        <code>[amazon-wishlist align="right"]e048ac07-8b5b-4b38-abd0-49a92574494d[/amazon-wishlist]</code>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?></strong>
        <ul>
          <li>
            <code>align</code>:
            {left, right, center}
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>alt</code>:
            [<?php _e('string', 'awshortcode') ?>]
            <?php _e('alternative text if Flash or JavaScript is not available on visitor\'s browser', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Content:', 'awshortcode') ?></strong>
        <?php _e('Widget ID, contained in HTML parameter value like this:', 'awshortcode') ?>
        <code>ID=V20070822/FR/onctom-21/8001/<span style="background: #ffc">e048ac07-8b5b-4b38-abd0-49a92574494d</span></code>.
      </li>
    </ul>

    <h4><?php _e('Amazon Product', 'awshortcode') ?></h4>
    <ul>
      <li>
        <strong><?php _e('Shortcode:', 'awshortcode') ?></strong>
        <code>[amazon-product][/amazon-product]</code>
      </li>
      <li>
        <strong><?php _e('Example:', 'awshortcode') ?></strong>
        <code>[amazon-product align="right"]0596529309[/amazon-product]</code>,
        <code>[amazon-product type="text" text="High Performance Websites"]0596529309[/amazon-product]</code>,
        <code>[amazon-product type="image" image="41W8EhCQu-L._SL160_SL120_.jpg"]0596529309[/amazon-product]</code>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?> (<?php _e('Image and Text', 'awshortcode') ?>)</strong>
        <ul>
          <li>
            <code>align</code>:
            {left, right, center}
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>alink</code>:
            [<?php _e('CSS hexa or code value', 'awshortcode') ?>]
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>bgcolor</code>:
            [<?php _e('CSS hexa or code value', 'awshortcode') ?>]
            <?php _e('customize the background color of the widget', 'awshortcode') ?>
          </li>
          <li>
            <code>bordercolor</code>:
            [<?php _e('CSS hexa or code value', 'awshortcode') ?>]
            <?php _e('border color of the widget', 'awshortcode') ?>
          </li>
          <li>
            <code>height</code>:
            [<?php _e('value in pixels', 'awshortcode') ?>]
            <?php _e('height of the frame', 'awshortcode') ?>
          </li>
          <li>
            <code>small</code>:
            {0, 1}
            <?php _e('display a small picture or a big one (0 by default)', 'awshortcode') ?>
          </li>
          <li>
            <code>target</code>:
            [<?php _e('string', 'awshortcode') ?>]
            <?php _e('window name to open the link in (_blank by default)', 'awshortcode') ?>
          </li>
          <li>
            <code>width</code>:
            [<?php _e('value in pixels', 'awshortcode') ?>]
            <?php _e('width of the frame', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?> (<?php _e('Image only', 'awshortcode') ?>)</strong>
        <ul>
          <li>
            <code>image</code>:
            [<?php _e('image name or Amazon OR full image URL', 'awshortcode') ?>]
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>type</code>:
            {image}
            <?php _e('display the widget as image', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?> (<?php _e('Text only', 'awshortcode') ?>)</strong>
        <ul>
          <li>
            <code>text</code>:
            [<?php _e('string', 'awshortcode') ?>]
            <?php _e('text of the hyperlink', 'awshortcode') ?>
          </li>
          <li>
            <code>type</code>:
            {text}
            <?php _e('display the widget as hypertext link', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Content:', 'awshortcode') ?></strong>
        <?php _e('ASIN code of the product.', 'awshortcode') ?>
      </li>
    </ul>

    <h4><?php _e('Amazon Product Cloud', 'awshortcode') ?></h4>
    <ul>
      <li>
        <strong><?php _e('Shortcode:', 'awshortcode') ?></strong>
        <code>[amazon-wishlist][/amazon-wishlist]</code>
      </li>
      <li>
        <strong><?php _e('Example:', 'awshortcode') ?></strong>
        <code>[amazon-wishlist align="right"]e048ac07-8b5b-4b38-abd0-49a92574494d[/amazon-wishlist]</code>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?></strong>
        <ul>
          <li>
            <code>align</code>:
            {left, right, center}
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>alt</code>:
            [<?php _e('string', 'awshortcode') ?>]
            <?php _e('alternative text if Flash or JavaScript is not available on visitor\'s browser', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Content:', 'awshortcode') ?></strong>
        <?php _e('Widget ID, contained in HTML parameter value like this:', 'awshortcode') ?>
        <code>ID=V20070822/FR/onctom-21/8006/<span style="background: #ffc">e048ac07-8b5b-4b38-abd0-49a92574494d</span></code>.
      </li>
    </ul>

    <h4><?php _e('Amazon Slideshow', 'awshortcode') ?></h4>
    <ul>
      <li>
        <strong><?php _e('Shortcode:', 'awshortcode') ?></strong>
        <code>[amazon-slideshow][/amazon-slideshow]</code>
      </li>
      <li>
        <strong><?php _e('Example:', 'awshortcode') ?></strong>
        <code>[amazon-slideshow align="right"]4aa00f5e-1828-4fac-ac94-8596bd8d6803[/amazon-slideshow]</code>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?></strong>
        <ul>
          <li>
            <code>align</code>:
            {left, right, center}
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>bgcolor</code>:
            [<?php _e('CSS hexa or code value', 'awshortcode') ?>]
            <?php _e('customize the background color of the widget', 'awshortcode') ?>
          </li>
          <li>
            <code>height</code>:
            [<?php _e('value in pixels', 'awshortcode') ?>]
            <?php _e('height of the animation', 'awshortcode') ?>
          </li>
          <li>
            <code>width</code>:
            [<?php _e('value in pixels', 'awshortcode') ?>]
            <?php _e('width of the animation', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Content:', 'awshortcode') ?></strong>
        <?php _e('Widget ID, contained in HTML parameter value like this:', 'awshortcode') ?>
        <code>Player_<span style="background: #ffc">4aa00f5e-1828-4fac-ac94-8596bd8d6803</span></code>.
      </li>
    </ul>

    <h4><?php _e('Amazon Wishlist', 'awshortcode') ?></h4>
    <ul>
      <li>
        <strong><?php _e('Shortcode:', 'awshortcode') ?></strong>
        <code>[amazon-wishlist][/amazon-wishlist]</code>
      </li>
      <li>
        <strong><?php _e('Example:', 'awshortcode') ?></strong>
        <code>[amazon-wishlist align="right"]e048ac07-8b5b-4b38-abd0-49a92574494d[/amazon-wishlist]</code>
      </li>
      <li>
        <strong><?php _e('Options:', 'awshortcode') ?></strong>
        <ul>
          <li>
            <code>align</code>:
            {left, right, center}
            <?php _e('align the widget on the desired way', 'awshortcode') ?>
          </li>
          <li>
            <code>alt</code>:
            [<?php _e('string', 'awshortcode') ?>]
            <?php _e('alternative text if Flash or JavaScript is not available on visitor\'s browser', 'awshortcode') ?>
          </li>
        </ul>
      </li>
      <li>
        <strong><?php _e('Content:', 'awshortcode') ?></strong>
        <?php _e('Widget ID, contained in HTML parameter value like this:', 'awshortcode') ?>
        <code>ID=V20070822/FR/onctom-21/8004/<span style="background: #ffc">e048ac07-8b5b-4b38-abd0-49a92574494d</span></code>.
      </li>
    </ul>
  </div>
</div>