
<header>
  <div class = "header">
    <div class = "headerlogin">
    <div class = "headerheader">
    <!-- Source: https://emojipedia.org/potted-plant/ -->
    <img src="/public/images/potted_plant.png" alt="potted plant" />
    <a href="/"><h1> Playful Plants </h1></a>
    <img src="/public/images/potted_plant.png" alt="potted plant" />
    </div>
    <?php
    if (!is_user_logged_in()){ ?>
      <button id = 'login'><a href = "/login">Sign In </a></button>
    <?php } else {?>
      <button id = 'logout'><a href="<?php echo logout_url(); ?>">Sign Out </a></button>
    <?php }?>
    </div>
    <nav>
      Source: <cite><a href="https://emojipedia.org/potted-plant/">Potted Plant Emoji</a></cite>
      <?php if (is_user_logged_in() && $is_admin){ ?>
        <div class = "nav">
            <a class="<?php echo $nav_form_class; ?>" href="/add-plant"> Add Form (Admin Only)</a>
        </div>
      <?php } ?>
    </nav>
  </div>
  <br></br>
</header>
