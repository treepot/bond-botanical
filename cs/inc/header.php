  <header id="header">
    <nav>
    	<a href="<?php echo ROOT ?>" class="logo"><img src="<?php echo ROOT.'img/'.$logo_pc ?>" alt="<?php echo $logo_alt ?>" class="pc"><img src="<?php echo ROOT.'img/'.$logo_sp ?>" alt="<?php echo $logo_alt ?>" class="sp pad"></a>
      <div>
        <a href="<?php echo ROOT ?>whats_new/" <?php if($page==1){echo 'class="active"';} ?>>What's new</a><!--
     --><a href="<?php echo ROOT ?>order/" <?php if($page==2){echo 'class="active"';} ?>>Order</a><!--
     --><a href="<?php echo ROOT ?>wedding/" <?php if($page==3){echo 'class="active"';} ?>>Wedding</a><!--
     --><a href="<?php echo ROOT ?>works/" <?php if($page==4){echo 'class="active"';} ?>>Works</a><!--
     --><a href="<?php echo ROOT ?>lesson/" <?php if($page==5){echo 'class="active"';} ?>>Lesson</a><!--
     --><a href="<?php echo ROOT ?>shop/" <?php if($page==6){echo 'class="active"';} ?>>Shop</a><!--
     --><a href="<?php echo ROOT ?>contact/" <?php if($page==7){echo 'class="active"';} ?>>Contact</a>
    	</div>
    </nav>
    <div id="navbtn" class="sp pad"><i class="fa fa-bars" aria-hidden="true"></i><i class="fa fa-times" aria-hidden="true"></i><span class="menu">MENU</span><span class="close">CLOSE</span><!--<span class="n1"></span><span class="n2"></span>--></div>
    <div class="navCover" style="display:none;"></div>
  </header>