
    <div class="navbar">
      <a href="/messages" class="navbar_place ">Feed</a>
      <a class="navbar_users active">Users</a>
	  <a href="/settings" class="navbar_settings">Settings</a>
	  <a href="/autoposting" class="navbar_autoposting">Auto posting</a>
	  <a href="/categories" class="navbar_categories">Categories</a>
	  <a href="/logs" class="navbar_logs">Logs</a>
	  <a href="/updates" class="navbar_updates">Updates</a>
	  <a href="/shop" class="navbar_shop">Shop</a>
	  <a href="/payments" class="navbar_payments">Payments</a>
    </div>
    <div class="title_block">
      <div class="search_filter right">
        <div class="close_btn right"></div>
        <div class="select_block right">
            <span>All users</span>
            <input type="hidden" name="role" value="0">
            <div class="background_click"></div>
            <div class="other_row">
                <div sid="0" class="one_status">
                  <span class="id" data-name="id" style="display:none">0</span>
                  <span class="name" data-name="name_ru">All users</span>
                </div>
                <div sid="1" class="one_status">
                  <span class="id" data-name="id" style="display:none">user</span>
                  <span class="name" data-name="name_ru">User</span>
                </div>
                <div sid="2" class="one_status">
                  <span class="id" data-name="id" style="display:none">author</span>
                  <span class="name" data-name="name_ru">Author</span>
                </div>
                <div sid="2" class="one_status">
                  <span class="id" data-name="id" style="display:none">editor</span>
                  <span class="name" data-name="name_ru">Editor</span>
                </div>
				<div sid="2" class="one_status">
                  <span class="id" data-name="id" style="display:none">creator</span>
                  <span class="name" data-name="name_ru">Creator</span>
                </div>
				<div sid="2" class="one_status">
                  <span class="id" data-name="id" style="display:none">seller</span>
                  <span class="name" data-name="name_ru">Seller</span>
                </div>
            </div>
        </div>
        <input class="search_input right" name="name" placeholder="Search"/>
        <div class="search_button"></div>
      </div>
      <div class="page_title">Users</div>
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
      <div class="table_content table_users ijs_search" url="<?php echo Yii::app()->params->server_path?>/api/admin/users" method="GET" model="users"
          model-id="row_search" data='{"limit":10,"order":"created_at DESC","query":[]}'>
        <div class="table_header">
          <div class="table_cell cell_image"></div>
          <div class="table_cell cell_id hide">ID</div>
          <div class="table_cell cell_login" style="width:327px;">Login</div>
          <div class="table_cell cell_last_sign " style="width:436px;">Role</div>
          <div class="table_cell cell_reg_date cell_order active" row="created_at">Registration</div>
        </div>

        <div class="table_row ijs_search_row user_row">
          <div class="hide" data-name="_id" ></div>
          <span class="model_id" style="display:none" data-name="_id"></span>
          <div class="table_cell cell_image"></div>
          <div class="table_cell cell_date mobile"><span data-name="created_at" data-callback="created_view" data-params='{}'></span></div>
          <div class="table_cell cell_id mobile" ><span data-name="_id" data-callback="mobile_id" data-params="{}"></span></div>
          <div class="table_cell cell_last_sign mobile">
              <div class="select_block ">
                  <span data-name="role">user</span>
                  <div class="background_click"></div>
                  <div class="other_row">
                      <div sid="1" class="one_status set_role">
                        <span class="id" style="display:none">user</span>
                        <span class="name" >user</span>
                      </div>
                      <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">author</span>
                        <span class="name" >Author</span>
                      </div>
                      <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">editor</span>
                        <span class="name" >Editor</span>
                      </div>
					  <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">creator</span>
                        <span class="name" >Creator</span>
                      </div>
					   <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">seller</span>
                        <span class="name" >Seller</span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="table_cell cell_login mobile" data-name="login"></div>
          <div class="table_cell cell_login" data-name="login" style="width:327px;">Login</div>
          <div class="table_cell cell_last_sign" style="width:436px;">
              <div class="select_block ">
                  <span data-name="role">user</span>
                  <div class="background_click"></div>
                  <div class="other_row">
                      <div sid="1" class="one_status set_role">
                        <span class="id" style="display:none">user</span>
                        <span class="name" >user</span>
                      </div>
                      <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">author</span>
                        <span class="name" >Author</span>
                      </div>
                      <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">editor</span>
                        <span class="name" >Editor</span>
                      </div>
					  <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">creator</span>
                        <span class="name" >Creator</span>
                      </div>
					 <div sid="2" class="one_status set_role">
                        <span class="id" style="display:none">seller</span>
                        <span class="name" >Seller</span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="table_cell cell_reg_date" style="width:230px;" data-name="created_at" data-callback='write_create' data-params='{}'>
              <div data_f-name="created"></div>
              <span data_f-name="created_time"></span>
          </div>
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
              <div class="popup_title">Delete user?</div>
          </div>
          <div class="popup_btn_block">
              <div class="red_btn popup_btn delete_user" url="<?php echo Yii::app()->params->server_path?>/api/admin/users/">Delete</div>
              <div class="popup_btn close_popup_block">Cancel</div>
          </div>
      </div>
  </div>
