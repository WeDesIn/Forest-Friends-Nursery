<footer id="footerwrap" itemscope itemtype="http://schema.org/WPFooter">

  <div class="box">
          <div class="row">
            <aside class="large-8 medium-6 columns"> 
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1')) : ?>
                      
                <?php endif; ?> 
            </aside>
            <aside class="large-4 medium-6 columns"> 
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2')) : ?>
                      
                <?php endif; ?> 
            </aside>
          </div>
  </div>

  <div class="sub-footer">
      
      <div class="row">
    			 
        	<div class="large-3 column">	
        					<p>© Copyright <?php bloginfo( "name" ); echo " ". date('Y');?></p>
        	</div>
        	<div class="large-6 column">	
        		<?php 
              wp_nav_menu ( array( 'theme_location' => 'footer', 'items_wrap' => '<ul class="footer-menu inline-list text-center">%3$s</ul>')); 
            ?>
        	</div>
        	<div class="large-3 column">	
        			<p class="text-right">Website by <a href="http://www.wedesin.cz/en/home" target="_blank" title="Visit WeDesIn">WeDesIn</a></p>				
        	</div>

      </div>

  </div>
  
</footer>