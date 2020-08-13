
    <div class="navbar">
      <a class="navbar_place active">Feed</a>
      <a href="/" class="navbar_users">Users</a>
	  <a href="/settings" class="navbar_settings">Settings</a>
	  <a href="/autoposting" class="navbar_autoposting">Auto posting</a>
	  <a href="/categories" class="navbar_categories">Categories</a>
	  <a href="/logs" class="navbar_logs">Logs</a>
	  <a href="/updates" class="navbar_updates">Updates</a>
	  <a href="/shop" class="navbar_shop">Shop</a>
	  <a href="/payments" class="navbar_payments">Payments</a>
    </div>
    <div class="title_block">
      <a href="/messages" class="page_title">Messages</a>
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
      <div class=" ijs_content" url="<?php echo Yii::app()->params->server_path?>/api/messages/<?php echo $id;?>" action="view" method="GET" model="data" model-id="row_model">
          <div class="order_view_block">
            <div class="order_information_block">
                <div class="user_edit_block order_update">
                  <div class="content_title">Informations</div>
                  <div class="one_line_row" style="display:none;">
                      <div class="one_row">
                          <div class="input_title">Color</div>
                          <div class="input_search_block width_4">
                              <div class="select_block ">
                                  <span class="first_up" data-name="color"></span>
                                  <div class="background_click"></div>
                                  <div class="other_row">
                                      <div sid="ocean" class="one_status set_color">
                                        <span class="id" style="display:none">ocean</span>
                                        <span class="name" >Ocean</span>
                                      </div>
                                      <div sid="red" class="one_status set_color">
                                        <span class="id" style="display:none">red</span>
                                        <span class="name" >Red</span>
                                      </div>
                                      <div sid="blue" class="one_status set_color">
                                        <span class="id" style="display:none">blue</span>
                                        <span class="name" >Blue</span>
                                      </div>
                                      <div sid="green" class="one_status set_color">
                                        <span class="id" style="display:none">green</span>
                                        <span class="name" >Green</span>
                                      </div>
                                      <div sid="yellow" class="one_status set_color">
                                        <span class="id" style="display:none">yellow</span>
                                        <span class="name" >Yellow</span>
                                      </div>
                                  </div>
                              </div>
                              <input class="input_for_search hide" name="color" data-name="color" placeholder="Color"/>
                          </div>
                      </div>
                  </div>
                  <div class="one_line_row" style="display:none;">
                      <div class="one_row">
                          <div class="input_title">Topic</div>
                          <div class="input_search_block width_4">
                              <div class="select_block ">
                                  <span data-name="topic" data-callback="view_topic" data-params='[{"name": "dont_lie", "text": "Don`t lie"},{"name": "dont_steal", "text": "Don`t steal"},{"name": "dont_demean", "text": "Don`t demean"},{"name": "dont_limit the freedom", "text": "Don`t limit the freedom"}]'></span>
                                  <div class="background_click"></div>
                                  <div class="other_row">
                                      <div sid="ocean" class="one_status set_topic">
                                        <span class="id" style="display:none">dont_lie</span>
                                        <span class="name" >Don`t lie</span>
                                      </div>
                                      <div sid="red" class="one_status set_topic">
                                        <span class="id" style="display:none">dont_steal</span>
                                        <span class="name" >Don`t steal</span>
                                      </div>
                                      <div sid="blue" class="one_status set_topic">
                                        <span class="id" style="display:none">dont_demean</span>
                                        <span class="name" >Don`t demean</span>
                                      </div>
                                      <div sid="green" class="one_status set_topic">
                                        <span class="id" style="display:none">dont_limit the freedom</span>
                                        <span class="name" >Don`t limit the freedom</span>
                                      </div>
                                  </div>
                              </div>
                              <input class="input_for_search hide" name="topic" data-name="topic" placeholder="Topic"/>
                          </div>
                      </div>
                  </div>
                  <div class="one_line_row">
                      <div class="one_row">
                          <div class="input_title">Comment</div>
                          <textarea class="width_5" data-name="comment" name="comment"></textarea>
                      </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="user_edit_block">
              <div class="content_title">Photos</div>
              <div class="profile_block" data-name="files" data-callback="view_portfolio" data-params='{}'>
                  <input type="file" dataName="file" style="display: none;"/>
                  <input  type="hidden" dataName="base64p"/>
                  <div class="add_profile_block"><i></i></div>
              </div>
          </div>
        </div>
    </div>

    <div class="center">
        <div class="hr"></div>
        <div class="control_block_btn">
            <div class="control_btn green_btn model_save" data-callback="before_save" model-id="order_change" data-event="click"
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
