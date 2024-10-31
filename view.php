<div class="wrap poppi-chat">
    <h2><?php echo $this->plugin->displayName; ?> </h2>
    <?php
      if (isset($this->message)) {?><div class="update fade"><p><?php echo $this->message; ?></p></div><?php }
      if (isset($this->errorMessage)) {?><div class="error fade"><p><?php echo $this->errorMessage; ?></p></div><?php }
    ?>
    <div class="poppi-chat-content">
        <h3 class="poppi-chat-title"><?php _e('Settings', $this->plugin->name); ?> &raquo; Poppi-Chat</h3>
        <div class="poppi-chat-form">
          <form action="options-general.php?page=<?php echo $this->plugin->name; ?>" method="post">
          	<p>
              <label for="url_footer"><strong><?php _e('Poppi Site ID'); ?></strong></label>
              <input type="text" name="site_poppi_id" id="site_poppi_id" value="<?php echo $this->settings['site_poppi_id']; ?>" placeholder="Site Poppi ID"/>
          		<label for="url_footer"><strong><?php _e('Poppi url', $this->plugin->name); ?></strong></label>
          		<input type="text" name="url_footer" id="url_footer" value="<?php echo $this->settings['url_footer']; ?>" placeholder="http://poppi.vn/api/"/>
          		<span><?php _e('These scripts will be append above the <strong>body</strong> tag.', $this->plugin->name); ?></span></p>
              <?php wp_nonce_field($this->plugin->name, $this->plugin->name.'_nonce'); ?>
              <span>Do you have account ? <a href="http://poppi.vn" target="_blank">Create new account</a></span>
              <p><input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php _e('Save', $this->plugin->name); ?>" /></p>
          </form>
        </div>
    </div>
</div>
