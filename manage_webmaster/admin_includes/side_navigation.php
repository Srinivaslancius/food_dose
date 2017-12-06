<?php
    $currentFile = $_SERVER["PHP_SELF"];
    $parts = Explode('/', $currentFile);
    $page_name = $parts[count($parts) - 1];
?>
<div class="site-left-sidebar">
        <div class="sidebar-backdrop"></div>
        <div class="custom-scrollbar">
          <ul class="sidebar-menu">
            <li class="menu-title">Menu</li>
             <li  class="<?php if($page_name == 'dashboard.php') { echo "active"; } ?>">
              <a href="dashboard.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Dashboard</span>
              </a>
            </li>
            <li class="<?php if($page_name == 'site_settings.php') { echo "active"; } ?>">
              <a href="site_settings.php" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-settings zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Site Settings</span>
              </a>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-accounts zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Users</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle">Users</li>
                <li class="<?php if($page_name == 'admin_users.php' || $page_name == 'add_admin_users.php' || $page_name == 'edit_admin_users.php') { echo "active"; } ?>"><a href="admin_users.php">Admin Users</a></li>
                <li class="<?php if($page_name == 'users.php' || $page_name == 'add_users.php' || $page_name == 'edit_users.php') { echo "active"; } ?>"><a href="users.php">Customers</a></li> 
              </ul>
            </li>
            <li class="with-sub">
              <a href="#" aria-haspopup="true">
                <span class="menu-icon">
                  <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Locations</span>
              </a>
              <ul class="sidebar-submenu collapse">
                <li class="menu-subtitle"></li>
                <li  class="<?php if($page_name == 'lkp_states.php' || $page_name == 'add_lkp_states.php' || $page_name == 'edit_lkp_states.php' ) { echo "active"; } ?>">
              <a href="lkp_states.php" aria-haspopup="true">States</a>
              </li>
                <li  class="<?php if($page_name == 'lkp_districts.php' || $page_name == 'add_lkp_districts.php' || $page_name == 'edit_lkp_districts.php' ) { echo "active"; } ?>">
              <a href="lkp_districts.php" aria-haspopup="true">Districts</a>
              </li>
              <li  class="<?php if($page_name == 'lkp_cities.php' || $page_name == 'add_lkp_cities.php' || $page_name == 'edit_lkp_cities.php' ) { echo "active"; } ?>">
              <a href="lkp_cities.php" aria-haspopup="true">Cities</a>
              </li>
              <li  class="<?php if($page_name == 'lkp_locations.php' || $page_name == 'add_lkp_locations.php' || $page_name == 'edit_lkp_locations.php' ) { echo "active"; } ?>">
              <a href="lkp_locations.php" aria-haspopup="true">Locations</a>
              </li>
              </ul>
            </li>
            <li  class="<?php if($page_name == 'banners.php' || $page_name == 'add_banners.php' || $page_name == 'edit_banners.php' ) { echo "active"; } ?>">
              <a href="banners.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Banners</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'promo_codes.php' || $page_name == 'add_promo_codes.php' || $page_name == 'edit_promo_codes.php' ) { echo "active"; } ?>">
              <a href="promo_codes.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-image zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Promo Codes</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'content_pages.php' || $page_name == 'add_content_pages.php' || $page_name == 'edit_content_pages.php') { echo "active"; } ?>">
              <a href="content_pages.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-item  zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Content Pages</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'categories.php' || $page_name == 'add_categories.php' || $page_name == 'edit_categories.php') { echo "active"; } ?>">
              <a href="categories.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-store zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Categories</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'sub_categories.php' || $page_name == 'add_sub_categories.php' || $page_name == 'edit_sub_categories.php') { echo "active"; } ?>">
              <a href="sub_categories.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-store zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Product Type</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'weight.php' || $page_name == 'add_weight.php' || $page_name == 'edit_weight.php') { echo "active"; } ?>">
              <a href="weight.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-store zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Weights</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'products.php' || $page_name == 'add_products.php' || $page_name == 'edit_products.php') { echo "active"; } ?>">
              <a href="products.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-shopping-basket zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Products</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'orders.php') { echo "active"; } ?>">
              <a href="orders.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Orders</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'take_away_orders.php') { echo "active"; } ?>">
              <a href="take_away_orders.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Take Away Orders</span>
              </a>
            </li>
            <!-- <li  class="<?php if($page_name == 'lkp_states.php' || $page_name == 'add_lkp_states.php' || $page_name == 'edit_lkp_states.php' ) { echo "active"; } ?>">
              <a href="lkp_states.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">States</span>
              </a>
            </li> -->
            <!-- <li  class="<?php if($page_name == 'lkp_districts.php' || $page_name == 'add_lkp_districts.php' || $page_name == 'edit_lkp_districts.php' ) { echo "active"; } ?>">
              <a href="lkp_districts.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Districts</span>
              </a>
            </li> -->
            <!-- <li  class="<?php if($page_name == 'lkp_cities.php' || $page_name == 'add_lkp_cities.php' || $page_name == 'edit_lkp_cities.php' ) { echo "active"; } ?>">
              <a href="lkp_cities.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Cities</span>
              </a>
            </li> -->
            <!-- <li  class="<?php if($page_name == 'lkp_locations.php' || $page_name == 'add_lkp_locations.php' || $page_name == 'edit_lkp_locations.php' ) { echo "active"; } ?>">
              <a href="lkp_locations.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-pin zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Locations</span>
              </a>
            </li> -->
            <li  class="<?php if($page_name == 'item_ratings.php') { echo "active"; } ?>">
              <a href="item_ratings.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Product Ratings</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'item_recipes.php') { echo "active"; } ?>">
              <a href="item_recipes.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Item Recipes</span>
              </a>
            </li>
            <!-- <li  class="<?php if($page_name == 'return_orders.php') { echo "active"; } ?>">
              <a href="return_orders.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Return Orders</span>
              </a>
            </li> -->
            <li  class="<?php if($page_name == 'reports.php') { echo "active"; } ?>">
              <a href="reports.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-collection-pdf zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Reports</span>
              </a>
            </li> 
           <li  class="<?php if($page_name == 'terms_and_conditions.php' || $page_name == 'add_terms_and_conditions.php' || $page_name == 'edit_terms_and_conditions.php') { echo "active"; } ?>">
              <a href="terms_and_conditions.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-store zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Terms & Conditions</span>
              </a>
            </li>
            <!-- <li  class="<?php if($page_name == 'promo_codes.php' || $page_name == 'add_promo_codes.php' || $page_name == 'edit_promo_codes.php') { echo "active"; } ?>">
              <a href="promo_codes.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-store zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Promo Codes</span>
              </a>
            </li>
            <li  class="<?php if($page_name == 'faqs.php' || $page_name == 'add_faqs.php' || $page_name == 'edit_faqs.php') { echo "active"; } ?>">
              <a href="faqs.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-store zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Faqs</span>
              </a>
            </li> -->
            <!-- <li  class="<?php if($page_name == 'register_customers.php') { echo "active"; } ?>">
              <a href="register_customers.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-accounts zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Customers</span>
              </a>
            </li>-->
            <li  class="<?php if($page_name == 'mobile_push_notifications.php') { echo "active"; } ?>">
              <a href="mobile_push_notifications.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-account-box-mail zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Mobile Push Notifications</span>
              </a>
            </li>
            
            <li  class="<?php if($page_name == 'customer_enqueries.php') { echo "active"; } ?>">
              <a href="customer_enqueries.php" aria-haspopup="true">
                <span class="menu-icon">
                   <i class="zmdi zmdi-account-box-mail zmdi-hc-fw"></i>
                </span>
                <span class="menu-text">Customer Enqueries</span>
              </a>
            </li>
          </ul>
        </div>
      </div>