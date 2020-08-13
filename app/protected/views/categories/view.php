
    <div class="navbar">
      <a class="navbar_place">Feed</a>
      <a href="/" class="navbar_users">Users</a>
	  <a href="/settings" class="navbar_settings">Settings</a>
	  <a href="/autoposting" class="navbar_autoposting">Auto posting</a>
	  <a href="/categories" class="navbar_categories active">Categories</a>
	  <a href="/logs" class="navbar_logs">Logs</a>
	  <a href="/updates" class="navbar_updates">Updates</a>
	  <a href="/shop" class="navbar_shop">Shop</a>
	  <a href="/payments" class="navbar_payments">Payments</a>
    </div>
    <div class="title_block">
      <a href="/categories" class="page_title">Categories</a>
      <div class="page_title lite">&nbsp›&nbsp</div>
      <div class="page_title" >#<?php echo $id?></div>
      <div class="count_block"></div>
    </div>
    <div class="line_block">
      <div class="color_blue color_line_block" style="width:0%"></div>
      <div class="color_red color_line_block" style="width:0%"></div>
    </div>
  </div>
</header>
  <div class="content">
    <div class="center " >
      <div class=" ijs_content" url="<?php echo Yii::app()->params->server_path?>/api/categories/<?php echo $id;?>" action="view" method="GET" model="data" model-id="row_model">
          <div class="order_view_block">
            <div class="order_information_block">
                <div class="user_edit_block order_update">
                  <div class="content_title">Informations</div>
                  <div class="one_line_row">
                      <div class="one_row">
                          <div class="input_title">Title</div>
                          <input class="width_5" data-name="title" name="title">
                      </div>
                  </div>
                </div>
            </div>
          </div>

        </div>
    </div>

    <div class="center">
        <div class="hr"></div>
        <div class="control_block_btn">
            <div class="control_btn green_btn model_categories_save" data-callback="before_save" model-id="order_change" data-event="click"
                model-action='update'>Save</div>
            <div class="control_btn btn_back">Cancel</div>
        </div>
    </div>
  </div>
  <div class="background_fixed_block model_save_popup">
      <div class="popup_block_admin">
          <div class='popup_title'>Change saved</div>
          <div class="popup_block">
            <hr>
            <div class="control_block_btn">
                <div class="control_btn green_btn close_popup">Ok</div>
            </div>
          </div>
      </div>
  </div>
