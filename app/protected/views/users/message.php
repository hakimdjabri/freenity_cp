
    <div class="navbar">
      <a href="/messages" class="navbar_place">Feed</a>
      <a href="/" class="navbar_users active">Users</a>
	  <a href="/settings" class="navbar_settings">Settings</a>
	  <a href="/autoposting" class="navbar_autoposting">Auto posting</a>
	  <a href="/categories" class="navbar_categories">Categories</a>
	  <a href="/logs" class="navbar_logs">Logs</a>
	  <a href="/updates" class="navbar_updates">Updates</a>
	  <a href="/shop" class="navbar_shop">Shop</a>
	  <a href="/payments" class="navbar_payments">Payments</a>
    </div>
    <div class="title_block ijs_content" url="<?php echo Yii::app()->params->server_path?>/api/admin/users/<?php echo $id;?>" action="view" method="GET" model="user" model-id="row_model">
      <div class="search_filter right">
        <div class="close_btn right"></div>
        <input class="search_input message_search_mobile right" name="name" placeholder="Search"/>
        <input type="hidden" name="user_id" value="<?php echo $id?>" placeholder="Search"/>
        <div class="search_button message_search_mobile"></div>
      </div>
      <a href="/" class="page_title">Users</a>
      <div class="page_title lite">&nbsp›&nbsp</div>
      <div class="page_title" data-name="login"></div>
      <div class="count_block"></div>
    </div>
    <div class="line_block">
      <div class="color_blue color_line_block" style="width:0%"></div>
      <div class="color_red color_line_block" style="width:0%"></div>
    </div>
  </div>
</header>
  <div class="content">
    <div class="center">
      <div class="table_content table_content_page ijs_search" url="<?php echo Yii::app()->params->server_path?>/api/admin/messages/search" method="GET" model="messages"
          model-id="row_search" data='{"limit":10,"user_id":"<?php echo $id;?>","query":[]}'>
          <div class="table_header">
            <div class="table_cell cell_image" style="width:15px;"></div>
            <div class="table_cell cell_id">ID</div>
            <div class="table_cell cell_name" style="width:188px;">Title</div>
            <div class="table_cell cell_desc" style="width:276px;">Description</div>
            <div class="table_cell cell_reg_address" style="width:154px;">Comment</div>
            <div class="table_cell cell_user_id">Author</div>
            <div class="table_cell cell_user_id">Views</div>
            <div class="table_cell cell_date cell_order active" row="created_at">Date</div>
          </div>

          <div class="table_row ijs_search_row message_row">
            <div class="hide" data-name="blocked" data-callback="blocked_row" data-params="{}"></div>
            <span class="model_id" style="display:none" data-name="_id"></span>
            <div class="table_cell cell_date mobile"><span data-name="created_at" data-callback="created_view" data-params='{}'></span></div>
            <div class="table_cell cell_id mobile" ><a data-name="_id" data-callback="href_row" data-params='{"url":"/messages/"}'>111</a></div>
            <div class="table_cell cell_name mobile" data-name="title"></div>
            <div class="table_cell cell_desc mobile" data-name="description"></div>
            <div class="table_cell cell_comm mobile" >Comment:</div>
            <div class="table_cell cell_reg_address mobile" data-name="comment"></div>
            <div class="table_cell cell_views mobile" data-name="views"></div>
            <div class="table_cell cell_author mobile" data-name="author.name"></div>
            <div class="table_cell cell_control_block mobile">
                <div class="one_control_block">
                    <a class="table_cell cell_edit mobile" data-name="_id" data-callback="href_row_only" data-params='{"url":"/messages/"}'><i></i></a>
                </div>
                <div class="one_control_block">
                    <div class="table_cell cell_deleted mobile" style="" url="/api/messages/" method='DELETE'><i></i></div>
                </div>
            </div>
            <div class="table_cell cell_image " style="width:0px;"></div>
            <div class="table_cell cell_id" ><a data-name="_id" data-callback="href_row" data-params='{"url":"/messages/"}'>111</a></div>
            <div class="table_cell cell_name" style="width:188px;" data-name="title"></div>
            <div class="table_cell cell_desc" style="width:276px;" data-name="description"></div>
            <div class="table_cell cell_reg_address" style="width:154px;" data-name="comment">
            </div>
            <div class="table_cell cell_user_id" data-name="author.name">
            </div>
            <div class="table_cell cell_user_id" data-name="views"></div>
            <div class="table_cell cell_date" data-name="created_at" data-callback='write_create' data-params='{}'>
                <div data_f-name="created"></div>
                <span data_f-name="created_time"></span>
            </div>
            <div class="table_cell cell_edit" style="" url="/messages/"><i></i></div>
            <div class="table_cell cell_deleted" style="" url="/api/messages/" method='DELETE'><i></i></div>
          </div>
        </div>
          <div class="pagination_bar">
              <div class="pagination">
                  <div class="page">
                  </div>

                  <div class="limit">
                      <div class="active page_limit" limit="10">10</div>
                      <div class="page_limit" limit="50">50</div>
                      <div class="page_limit" limit="100">100</div>
                  </div>
              </div>
          </div>
    </div>
  </div>
  <div class="background_fixed_block user_deleted_block message_deleted_block">
      <div class="popup">
          <div class="popup_close_btn"></div>
          <div class="user_popup_block">
              <div class="popup_title">Delete message?</div>
          </div>
          <div class="popup_btn_block">
              <div class="red_btn popup_btn delete_user" url="<?php echo Yii::app()->params->server_path?>/api/admin/messages/">Delete</div>
              <div class="popup_btn close_popup_block">Cancel</div>
          </div>
      </div>
  </div>
