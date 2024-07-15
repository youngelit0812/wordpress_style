<div class="hd_nav_box">
  <ul>
    <?php if (has_nav_menu('primary')): ?>
      <?php
      wp_nav_menu(
          array(
              'theme_location' => 'primary',
              'menu_class' => 'navbar-nav',
              'container' => false,
              //'items_wrap' => '<ul class="%2$s">%3$s</ul>',
              'items_wrap' => '%3$s',
              'fallback_cb' => false,
              'add_a_class' => 'mn_link ',
          )
      );
      ?>
    <li class="burger_li ">
      <button class="menu_trigger" data-traget="master_menu">
        <span class="top_"></span>
        <span class="med_"></span>
        <span class="bottom_"></span>
      </button>
    </li>
  <?php endif; ?>
    
  </ul>
  <ul class="search_ul">
    <li class="search_li">
      <?php get_template_part('template-parts/header/site-search');?>
    </li>
  </ul>
</div>
<div class="nav_box_wrapper" id="master_menu">
  <nav class="navbar-inner">
    <ul class="navbar-nav ">
      <?php 
      $primary_menu_id = get_menu_id( 'primary' );
      $header_menus   = wp_get_nav_menu_items( $primary_menu_id );
            foreach ( $header_menus as $menu_item ) {
              //var_dump($menu_item);die;
                  if ( ! $menu_item->menu_item_parent ) {

                    $child_menu_items   = get_child_menu_items( $header_menus, $menu_item->ID );
                    $has_children       = ! empty( $child_menu_items ) && is_array( $child_menu_items );
                    $has_sub_menu_class = ! empty( $has_children ) ? 'has-submenu' : '';
                    $link_target        = ! empty( $menu_item->target ) && '_blank' === $menu_item->target ? '_blank' : '_self';
                    $current = ( $menu_item->object_id == get_queried_object_id() ) ? 'current' : '';
                    // Note_: Similar to $menu_item->target, there are other keys available in the $menu_item, such as classes. You can more key values if you need.

                    if ( ! $has_children ) {
                      ?>
                      <li class="nav-item">
                        <?php $child_class = 'nav-link scroll'; ?>
                        <a class="<?php echo $child_class; ?> <?php echo $current; ?>" href="<?php echo esc_url( $menu_item->url ); ?>"  data-href="#<?php echo esc_html( $menu_item->attr_title ); ?>">
                          <?php echo esc_html( $menu_item->title ); ?>
                        </a>
                      </li>
                      <?php
                    } else {
                      ?>
                      <li>
                        <a class="nav-link scroll <?php echo $current; ?>" href="<?php echo esc_url( $menu_item->url ); ?>" data-href="#<?php echo esc_html( $menu_item->attr_title ); ?>"><?php echo esc_html( $menu_item->title ); ?></a>
                        <ul class="nav_drop_ul">
                          <?php
                          foreach ( $child_menu_items as $child_menu_item ) {
                            $link_target = ! empty( $child_menu_item->target ) && '_blank' === $child_menu_item->target ? '_blank' : '_self';
                            ?>
                            <li>
                              <a class="mn_link" href="<?php echo esc_url( $child_menu_item->url ); ?>"
                                 target="<?php echo esc_attr( $link_target ); ?>" data-href="#<?php echo esc_html( $menu_item->attr_title ); ?>" >
                                <?php echo esc_html( $child_menu_item->title ); ?>
                              </a>
                            </li>
                            <?php
                          }
                          ?>
                        </ul>
                      </li>
                      <?php
                    }
                  }
                } 
          ?>

    </ul>
  </nav>

</div>

