    </main>

    <footer class="footer">
      <div class="container">
        <div class="grid">
          <div class="col">
            <a href="/">
              <?php
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        if (!isset($image)) :
                            echo '<img src="'.$image[0].'" class="logo mb-20"/>';
                        else :
                            echo '<img src="https://via.placeholder.com/120" alt="" class="logo mb-20">';
                        endif;
                    ?>
            </a>
            <a href="/" class="site-name"><?php bloginfo('name') ?></a>
          </div>
          <div class="col">

            <?php wp_nav_menu( array(
                  'menu'            => 'main',
                  'theme_location'  => 'main',
                  'container'       => 'ul',
                  'echo'            => true,
                  'menu_class'      => 'nav__menu',
                  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ) ); ?>
          </div>
        </div>

        <div class="text-center mt-40">
          <span class="footer-copyright">

            © <?php echo date('Y'); ?> Copyright. All rights reserved.

          </span>

          <a href="//rkastor.com" class="footer__author text-right">rkastor production</a>
        </div>

      </div>
    </footer>

    <div class="modal__shadow modal__shadow--main"></div>



    <?php wp_footer(); ?>

    </div>

    </body>

    <!-- *** rkastor production *** -->

    </html>