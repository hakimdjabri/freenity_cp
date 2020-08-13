
    <div class="navbar">
      <a href="/messages" class="navbar_place ">Feed</a>
      <a href="/" class="navbar_users">Users</a>
	  <a href="/settings" class="navbar_settings">Settings</a>
	  <a href="/autoposting" class="navbar_autoposting">Auto posting</a>
	  <a href="/categories" class="navbar_categories">Categories</a>
	  <a href="/logs" class="navbar_logs">Logs</a>
	  <a href="/updates" class="navbar_updates">Updates</a>
	  <a href="/shop" class="navbar_shop active">Shop</a>
	  <a href="/payments" class="navbar_payments">Payments</a>
    </div>
     <div class="title_block">
      <div class="page_title">Shop</div>
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
      <div class="table_content table_users ijs_search" url="<?php echo Yii::app()->params->server_path?>/api/shop" method="GET" model="data"
          model-id="row_search" data='{"limit":10,"order":"_id DESC","query":[]}'>
        <div class="table_header">
          <div class="table_cell cell_image"></div>
		  <div class="table_cell cell_login" style="width:327px;">ID</div>
          <div class="table_cell cell_login" style="width:327px;">Title</div>
		  <div class="table_cell cell_login" style="width:327px;">Description</div>
		  <div class="table_cell cell_login" style="width:327px;">Price</div>
        </div>

        <div class="table_row ijs_search_row">
          <div class="hide" data-name="_id" ></div>
		  <span class="model_id" style="display:none" data-name="_id"></span>
		  <div class="table_cell cell_login" data-name="_id" style="width:327px;">_id</div>
          <div class="table_cell cell_login" data-name="title" style="width:327px;">title</div>
		  <div class="table_cell cell_login" data-name="description" style="width:327px;">description</div>
		  <div class="table_cell cell_login" data-name="price" style="width:327px;">price</div>
		  <div class="table_cell cell_edit" style="" url="/shop/"><i></i></div>
          <div class="table_cell cell_deleted" style="" url="/api/shop/" method='DELETE'><i></i></div>
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
              <div class="popup_title">Delete shop?</div>
          </div>
          <div class="popup_btn_block">
              <div class="red_btn popup_btn delete_user" url="<?php echo Yii::app()->params->server_path?>/api/shop/">Delete</div>
              <div class="popup_btn close_popup_block">Cancel</div>
          </div>
      </div>
  </div>
