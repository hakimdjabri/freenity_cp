
    <div class="navbar">
      <a href="/messages" class="navbar_place ">Feed</a>
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
      <div class="page_title">Categories</div>
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
      <div class=" ijs_content" action="view" method="GET" model="data" model-id="row_model">
          <div class="order_view_block" style="width: 300px;float: left;">
            <div class="order_information_block">
                <div class="user_edit_block order_update">
                  <div class="one_line_row">
                      <div class="one_row">
                          <div class="input_title">Title</div>
						  <input type="text" data-name="title" name="title">
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
  
  
  
  
  
  
    <div class="center">
      <div class="table_content table_users ijs_search" url="<?php echo Yii::app()->params->server_path?>/api/categories" method="GET" model="categories"
          model-id="row_search" data='{"limit":10,"order":"_id DESC","query":[]}'>
        <div class="table_header">
          <div class="table_cell cell_image"></div>
          <div class="table_cell cell_login" style="width:327px;">Title</div>
        </div>

        <div class="table_row ijs_search_row">
          <div class="hide" data-name="_id" ></div>
		  <span class="model_id" style="display:none" data-name="_id"></span>
          <div class="table_cell cell_login" data-name="title" style="width:327px;">title</div>
		  <div class="table_cell cell_edit" style="" url="/categories/"><i></i></div>
          <div class="table_cell cell_deleted" style="" url="/api/categories/" method='DELETE'><i></i></div>
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
              <div class="popup_title">Delete categories?</div>
          </div>
          <div class="popup_btn_block">
              <div class="red_btn popup_btn delete_user" url="<?php echo Yii::app()->params->server_path?>/api/categories/">Delete</div>
              <div class="popup_btn close_popup_block">Cancel</div>
          </div>
      </div>
  </div>
