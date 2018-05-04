<footer>
	<p class="ul">Contents</p>
	<div class="container">
  
  	<nav class="nav1 clearfix">
			<?php if($page_dir == 'top'): ?>
      <div class="fb-page pc" data-href="https://www.facebook.com/bois-de-gui-398269033614623/" data-tabs="timeline" data-width="340" data-height="520" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bois-de-gui-398269033614623/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bois-de-gui-398269033614623/">bois de gui</a></blockquote></div>
      <div class="fb-page pad" data-href="https://www.facebook.com/bois-de-gui-398269033614623/" data-tabs="timeline" data-width="290" data-height="440" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bois-de-gui-398269033614623/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bois-de-gui-398269033614623/">bois de gui</a></blockquote></div>
      <?php endif; //https://developers.facebook.com/docs/plugins/page-plugin/?>
      
      <a class="whats_new" href="<?php echo ROOT ?>whats_new/">What's new</a><a class="wedding" href="<?php echo ROOT ?>wedding/">Wedding</a><a class="works" href="<?php echo ROOT ?>works/">Works</a><a class="lesson" href="<?php echo ROOT ?>lesson/">Lesson</a><a class="order <?php if($page_dir == 'top'){ echo 'half';}else{ echo 'full';}; ?>" href="<?php echo ROOT ?>order/">Order</a>
      
    </nav>

	</div>
  
  <nav class="nav2">
    <a href="<?php echo ROOT ?>shop/">Shop</a>
    <a href="<?php echo ROOT ?>contact/">Contact</a>
  </nav>
  
	<div class="sns">
  	<a href="https://www.facebook.com/bois-de-gui-398269033614623/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
    <a href="https://www.instagram.com/boisdegui/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
  </div>
  
  <a class="logo" href="<?php echo ROOT ?>">
    <img src="<?php echo ROOT.'img/'.$logo_sp ?>" alt="<?php echo $logo_alt ?>">
  </a>
 
  <a href="#page_top" data-scroll></a>
  <small>&copy; 2017 bond Inc.</small>

</footer>


<div class="loading"></div>
</body>
</html>