data = {};
server_path = 'http://www.develop4851.com:5000/';
$( document ).ready(function() {
    window.ijs.listener.add('row_search_search',row_search);
    window.ijs.listener.add('insert_image',insert_image);
    window.ijs.listener.add('insert_review_image',insert_review_image);
    window.ijs.listener.add('insert_review_image_coll',insert_review_image_coll);
    window.ijs.listener.add('insert_review_id',insert_review_id);
    window.ijs.listener.add('blocked_row',blocked_row);
    window.ijs.listener.add('href_row',href_row);
    window.ijs.listener.add('href_row_only',href_row_only);
    window.ijs.listener.add('href_row_poi',href_row_poi);
    window.ijs.listener.add('href_row_user',href_row_user);
    window.ijs.listener.add('recommendation_active',recommendation_active);
    window.ijs.listener.add('select_set',select_set);
    window.ijs.listener.add('mobile_id',mobile_id);
    window.ijs.listener.add('write_create',write_create);
    window.ijs.listener.add('view_portfolio',view_portfolio);
	window.ijs.listener.add('view_portfolio1',view_portfolio1);
	window.ijs.listener.add('view_portfolio2',view_portfolio2);
    window.ijs.listener.add('before_save',before_save);
    window.ijs.listener.add('row_model_view',row_model_view);
    window.ijs.listener.add('view_topic',view_topic);
    window.ijs.listener.add('created_view',created_view);
});
function created_view(params)
{
    var data = params[2].split('T');
    params[1].text(data[0]);
}
function view_topic(params)
{
    for( i in params[3])
    {
       if(params[3][i].name == params[2])
          params[1].text(params[3][i].text);
    }
}
function row_model_view(json)
{
    data = json.data;
}
function before_save(dom)
{
}
function view_object_file(body,file)
{
    var one_profile_block = $('<div></div>')
        .addClass('one_profile_block')
        .appendTo(body);
    var urls = file.url.split('/');
    if(urls[0] == 'files')
    {
        file.url = server_path+file.url;
        file.preview = server_path+file.preview;
    }
    var image_block = $('<div></div>')
        .addClass('image_block')
        .attr('url',file.url)
        .appendTo(one_profile_block);
    if( file.type == "iframe" || file.type == "image" )
    {
        var image = $('<img />')
            .attr('src',file.preview)
            .appendTo(image_block);
    }
    else
    {
        var image = $('<img />')
            .addClass('file_image')
            .attr('src','/media/Input/Icons/file.png')
            .appendTo(image_block);
    }

    var input = $('<input />')
        .attr('name','file[]')
        .attr('type','hidden')
        .attr('value',i)
        .appendTo(image_block);
    var image_control_block = $('<div></div>')
        .addClass('image_control_block')
        .appendTo(one_profile_block);
    var object_type = $('<div></div>')
        .addClass('object_type')
        .appendTo(one_profile_block);
    if(file.type == "iframe")
        object_type.addClass('video_type');
    else if(file.type == "image")
        object_type.addClass('image_type');
    else if(file.type == "video")
        object_type.addClass('video_type');
    // else if(params[2][i].type == "iframe")
    //     object_type.addClass('video_type');
    else
        object_type.addClass('file_type');
    var round_button_deleted = $('<div></div>')
        .addClass('round_button')
        .addClass('round_button_deleted')
        .appendTo(image_control_block);
    var i = $('<i></i>')
        .appendTo(round_button_deleted);
}
function view_portfolio(params)
{
    for( i in params[2])
    {
        view_object_file(params[1],params[2][i]);
    }
}
function view_portfolio1(params)
{
        view_object_file(params[1],params[2][0]);
}
function view_portfolio2(params)
{
        view_object_file(params[1],params[2][1]);
}
function write_create(params)
{
    var time = params[2].split('T');
    params[1].find('[data_f-name=created]').text(time[0]);
    var t = time[1].split('.');
    params[1].find('[data_f-name=created_time]').text(t[0]);
}
function mobile_id(params)
{
    params[1].text('#'+params[2]);
}
function select_set(params)
{
    params[1].find('[value='+params[2]+']').attr('selected','selected');
}
function recommendation_active(params)
{
    if(!params[2])
        return 0;
    params[1].addClass('active');
}
function href_row_user(params)
{
    params[1].attr('href',params[3]['url']+params[2]);
}
function href_row_poi(params)
{
    params[1].attr('href',params[3]['url']+params[2][0]['poi_id']+'/review/'+params[2][0]['id']).text(params[2][0]['poi_id']);
}
function href_row(params)
{
    //console.log(params);
    params[1].attr('href',params[3]['url']+params[2]).text(params[2]);
}
function href_row_only(params)
{
    params[1].attr('href',params[3]['url']+params[2]);
}
function blocked_row(params)
{
    if(params[2])
        params[1].closest('.table_row').addClass('block');
}
function insert_review_id(params)
{
    for(i in params[2])
    {
        var a = $('<a></a>')
            .attr('href',params[3]['url']+params[2][i]['poi_id']+'/review/'+params[2][i].id)
            .attr('target','_blank')
            .text(params[2][i].id)
            .appendTo(params[1]);
        if(params[2].length > 1 && parseInt(i)+1 != params[2].length)
          a.text(params[2][i].id+', ');
    }
}
function insert_review_image_coll(params)
{
  if(params[2] )
    var img = $('<img />')
        .attr('src',params[2])
        .appendTo(params[1]);
}
function insert_review_image(params)
{
    if(params[2][0] && params[2][0].images && params[2][0].images[0] && params[2][0].images[0].url)
      var img = $('<img />')
          .attr('src',params[2][0].images[0].url)
          .appendTo(params[1]);
}
function insert_image(params)
{
    if(params[2])
      var img = $('<img />')
          .attr('src',params[2])
          .appendTo(params[1]);
    else
      var img = $('<img />')
          .attr('src','/media/Table/Avatar_placeholder2x.png')
          .appendTo(params[1]);
}
function row_search(json)
{
    $('.count_block').text(json.count);
    var limit = parseInt($('.page_limit.active').attr('limit'));
    if($('.page_item.active').length > 0)
        var offset = parseInt($('.page_item.active').attr('offset'));
    else
        var offset = 0;
    $('.pagination').find('.page').find('.page_item').remove();
    $('.ijs_search.table_content').find('.ijs_search_row').remove();
    $(window).scrollTop(0);
    if(json.count <= limit)
        return 0;
    for(var i = -2; i <= 2; i++)
    {
        var o = offset + i*limit;
        if(o < 0 || o > json.count)
            continue;
        if(o == 0 && offset != 0)
        {
            var a = $('<div></div>')
                .addClass('page_item')
                .addClass('prev')
                .attr('limit',limit)
                .attr('offset',0)
                .appendTo($('.pagination').find('.page'));
        }
        var page = o / limit + 1;
        var a = $('<div></div>')
                .addClass('page_item')
                .text(page)
                .attr('limit',limit)
                .attr('offset',o)
                .appendTo($('.pagination').find('.page'));
        if(offset == o)
            a.addClass('active');
        if(i > 0 && o + limit >= json.count)
        {
            var a = $('<div></div>')
                  .addClass('next')
                  .addClass('page_item')
                  .attr('limit',limit)
                  .attr('offset',o)
                  .appendTo($('.pagination').find('.page'));
        }
    }
    // if(json.pagination.length < 2)
    //     return 0;
    //
    // for(i in json.pagination)
    //     if(json.pagination[i][2] == 1)
    //         var current = json.pagination[i][0];
    // for(i in json.pagination)
    // {
    //     if(i == 0 && json.pagination[i][2] != 1)
    //     {
    //         var a = $('<div></div>')
    //               .addClass('page_item')
    //               .addClass('prev')
    //               .attr('limit',json.pagination[i][1])
    //               .attr('offset',json.pagination[i][1]*(current-1))
    //               .appendTo($('.pagination').find('.page'));
    //     }
    //     var a = $('<div></div>')
    //             .addClass('page_item')
    //             .text(json.pagination[i][0]+1)
    //             .attr('limit',json.pagination[i][1])
    //             .attr('offset',json.pagination[i][1]*json.pagination[i][0])
    //             .appendTo($('.pagination').find('.page'));
    //     if(json.pagination[i][2] == 1)
    //         a.addClass('active');
    //     if(i == json.pagination.length - 1 && json.pagination[i][2] != 1)
    //     {
    //         var a = $('<div></div>')
    //               .addClass('next')
    //               .addClass('page_item')
    //               .attr('limit',json.pagination[i][1])
    //               .attr('offset',json.pagination[i][1]*(current+1))
    //               .appendTo($('.pagination').find('.page'));
    //     }
    // }
}
var sort_change = {'asc':'desc','desc':'asc'};
$('body')
    // .on('click','.table_row',function(){
    //     if($(this).attr('href'))
    //       window.open($(this).attr('href'));
    // })
    .on('click','.image_block',function(e){
        e = e.target;
        if($(e).is('img'))
        {
            var src = $(this).closest('.image_block').attr('url');
            window.open(src, '_blank');
        }
    })
    .on('click','.ijs_search_row.message_row',function(e){
        e = e.target;
        if(
            $(e).prop('nodeName') == "A"
            || $(e).prop('nodeName') == "I"
            || $(e).hasClass('cell_deleted')
            || $(e).hasClass('cell_banned')
            || $(e).hasClass('cell_new_recommend')
          )
            return 0;
        var id = $(this).find('.model_id[data-name=_id]').text();
        window.open(server_path+id, '_blank');
    })
    .on('click','.ijs_search_row.user_row',function(e){
        e = e.target;
        if(
            $(e).prop('nodeName') == "A"
            || $(e).prop('nodeName') == "I"
            || $(e).hasClass('cell_deleted')
            || $(e).hasClass('cell_banned')
            || $(e).hasClass('cell_new_recommend')
            || $(e).hasClass('select_block')
            || $(e).closest('.select_block').length>0
          )
            return 0;
        var id = $(this).find('.model_id[data-name=_id]').text();
        window.location = '/users/message/'+id;
    })
    .on('click','.cell_deleted',function(){
        var f = $(this).closest('.ijs_search_row').find('[data-name=first_name]').text();
        var l = $(this).closest('.ijs_search_row').find('[data-name=last_name]').text();
        var src = $(this).closest('.ijs_search_row').find('.cell_image').find('img').attr('src');
        $('.background_fixed_block.user_deleted_block').find('[data-name=name]').text(f+' '+l);
        $('.background_fixed_block.user_deleted_block').find('.image_popup_user').find('img').attr('src',src);
        var id = $(this).closest('.ijs_search_row').find('.model_id[data-name=_id]').text();
        if(!f && !l)
            $('.background_fixed_block.user_deleted_block').find('[data-name=name]').text(id);
        $('.background_fixed_block.user_deleted_block').find('.delete_user').attr('data-id',id);

        $('.background_fixed_block.user_deleted_block').show();
    })
    .on('click','.cell_edit',function(){
        var id = $(this).closest('.ijs_search_row').find('.model_id[data-name=_id]').text();
        var url = $(this).attr('url');
        window.location = url+id;
    })
    .on('click','.popup_close_btn,.close_popup_block',function(){
        $('.background_fixed_block.user_deleted_block').hide();
    })
    .on('click','.delete_user',function(){
        var id = $(this).attr('data-id');
        var url = $(this).attr('url');
        $.ajax({
            url:url+id,
            type:'DELETE',
            dataType:'json',
            headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
            success:function(json){
                window.ijs.models['row_search']._search(false);
            }
        });
        $('.background_fixed_block.user_deleted_block').hide();
    })
    .on('click','.cell_recommend',function(){
        $(this).toggleClass('active');
        var src = $(this).attr('url');
        var id = $(this).closest('.table_row').find('[data-name=id]').text();
        var data = {
            new:0
          };
        if($(this).hasClass('active'))
            data.new = 1;
        $.ajax({
            url:src+'/'+id,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(json){
                color_line(json.categories);
            }
          });
    })
    .on('click','.cell_banned',function(){
        $(this).closest('.table_row').toggleClass('block');
        var src = $(this).attr('url');
        var id = $(this).closest('.table_row').find('[data-name=id]').text();
        console.log($(this).closest('.table_row').find('[data-name=id]'));
        var data = {
          blocked : 0
        };
        if($(this).closest('.table_row').hasClass('block'))
          data.blocked = 1;
        $.ajax({
            url:src+'/'+id,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(json){
                color_line(json.categories);
            }
          });
    })
    .on('click','.close_btn',function(){
        $('.search_input').val('');
        $('.title_block').find('input').val('');
        $('.close_btn').removeClass('active');
        $('.select_block').each(function(){
            $(this).find('span:first').text($(this).find('span.name:first').text());
        });
        research();
    })
    .on('keyup','.search_input',function(e){
        if($(this).val())
          $('.close_btn').addClass('active');
        if (e.keyCode == 13)
          research();
    })
    .on('click','.search_button',function(){
        if($('.search_input').val())
          $('.close_btn').addClass('active');
        research();
    })
    .on('click','.one_status:not(.set_role):not(.set_color):not(.set_topic)',function(){
        $('.close_btn').addClass('active');
        var id = $(this).find('.id').text();
        $(this).closest('.select_block').find('input').val(id);
        $(this).closest('.select_block').find('span:first').text($(this).find('.name').text());
        research();
    })
    .on('click','.one_status.set_role',function(){
        $(this).closest('.select_block').find('span:first').text($(this).find('.name').text());
        var id = $(this).closest('.ijs_search_row').find('.hide[data-name=_id]').text();
        var data = {};
        data.role = $(this).find('.id').text();
        $.ajax({
            url:server_path+'api/admin/users/'+id+'/role?role='+data.role,
            type:'POST',
            //data:data,
            headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
          });
    })
    .on('click','.select_block',function(){
        $(this).find('.other_row').toggle();
        $(this).find('.select_block').toggleClass('active');
        $(this).find('.background_click').toggle();
    })
    .on('click','.cell_order',function(){
        if(!$(this).hasClass('active'))
        {
            $('.cell_order').removeClass('active');
            $(this).addClass('active');
        }
        else
            $(this).toggleClass('asc');
        research();
    })
    .on('click','.page_item:not(.current)',function(){
        var limit = $(this).attr('limit');
        var offset = $(this).attr('offset');
        $('.page_item.active').attr('limit',limit);
        $('.page_item.active').attr('offset',offset);
        research();
    })
    .on('click','.page_limit:not(.current)',function(){
        $('.page_limit.active').removeClass('active');
        $(this).addClass('active');
        $('.pagination').find('.page').find('.page_item').remove();
        research();
    })
    .on('change','select[name=role]',function(){
        var id = $(this).closest('.ijs_search_row').find('.hide[data-name=_id]').text();
        var data = {};
        data.role = $(this).val();
        $.ajax({
            url:'/api/users/role/'+id,
            type:'POST',
            data:data,
          });
    })
    .on('click','.set_color',function(){
        $('input[name=color]').val($(this).find('.id').text());
        $(this).closest('.select_block').find('span:first').text($(this).find('.name').text());
    })
    .on('click','.set_topic',function(){
        $('input[name=topic]').val($(this).find('.id').text());
        $(this).closest('.select_block').find('span:first').text($(this).find('.name').text());
    })
    .on('click','.close_popup',function(){
        $(this).closest('.background_fixed_block').hide();
    })
    .on('click','.model_save',function(){
        data.color = $('input[name=color]').val();
        data.topic = $('input[name=topic]').val();
        data.comment = $('textarea[name=comment]').val();
        //data.files = JSON.stringify(data.files);
        delete data.author;
        console.log(data);
        //return 0;
        //delete data.files;
        //delete data.files;
        $.ajax({
          url:server_path+'api/messages',
          type:'POST',
          data:JSON.stringify(data),
          dataType:'json',
          contentType: 'application/json',
          headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
          success:function(json){
              $('.model_save_popup').show();
          }
        })

    })
		.on('click','.model_shop_save',function(){
        data.title = $('input[name=title]').val();
		data.description = $('input[name=description]').val();
		data.price = $('input[name=price]').val();

		data.title_zu=null
		data.title_zh=null
		data.title_yo=null
		data.title_yi=null
		data.title_xh=null
		data.title_vi=null
		data.title_uz=null
		data.title_ur=null
		data.title_uk=null
		data.title_tr=null
		data.title_tl=null
		data.title_th=null
		data.title_tg=null
		data.title_te=null
		data.title_ta=null
		data.title_sw=null
		data.title_sv=null
		data.title_su=null
		data.title_st=null
		data.title_sr=null
		data.title_sq=null
		data.title_so=null
		data.title_sn=null
		data.title_sm=null
		data.title_sl=null
		data.title_sk=null
		data.title_si=null
		data.title_sd=null
		data.title_ru=null
		data.title_ro=null
		data.title_pt=null
		data.title_ps=null
		data.title_pl=null
		data.title_pa=null
		data.title_ny=null
		data.title_no=null
		data.title_nl=null
		data.title_ne=null
		data.title_my=null
		data.title_mt=null
		data.title_ms=null
		data.title_mr=null
		data.title_mn=null
		data.title_ml=null
		data.title_mk=null
		data.title_mi=null
		data.title_mg=null
		data.title_lv=null
		data.title_lt=null
		data.title_lo=null
		data.title_lb=null
		data.title_la=null
		data.title_ky=null
		data.title_ku=null
		data.title_ko=null
		data.title_kn=null
		data.title_km=null
		data.title_kk=null
		data.title_ka=null
		data.title_jw=null
		data.title_ja=null
		data.title_iw=null
		data.title_it=null
		data.title_is=null
		data.title_ig=null
		data.title_id=null
		data.title_hy=null
		data.title_hu=null
		data.title_ht=null
		data.title_hr=null
		data.title_hmn=null
		data.title_hi=null
		data.title_haw=null
		data.title_ha=null
		data.title_gu=null
		data.title_gl=null
		data.title_gd=null
		data.title_ga=null
		data.title_fy=null
		data.title_fr=null
		data.title_fi=null
		data.title_fa=null
		data.title_eu=null
		data.title_et=null
		data.title_es=null
		data.title_eo=null
		data.title_en=null
		data.title_el=null
		data.title_de=null
		data.title_da=null
		data.title_cy=null
		data.title_cs=null
		data.title_co=null
		data.title_ceb=null
		data.title_ca=null
		data.title_bs=null
		data.title_bn=null
		data.title_bg=null
		data.title_be=null
		data.title_az=null
		data.title_ar=null
		data.title_am=null
		data.title_af=null		
		
        $.ajax({
          url:server_path+'api/shop',
          type:'POST',
          data:JSON.stringify(data),
          dataType:'json',
          contentType: 'application/json',
          headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
          success:function(json){
              $('.model_save_popup').show();
          }
        })

    })
	.on('click','.model_categories_save',function(){
        data.title = $('input[name=title]').val();

		data.title_zu=null
		data.title_zh=null
		data.title_yo=null
		data.title_yi=null
		data.title_xh=null
		data.title_vi=null
		data.title_uz=null
		data.title_ur=null
		data.title_uk=null
		data.title_tr=null
		data.title_tl=null
		data.title_th=null
		data.title_tg=null
		data.title_te=null
		data.title_ta=null
		data.title_sw=null
		data.title_sv=null
		data.title_su=null
		data.title_st=null
		data.title_sr=null
		data.title_sq=null
		data.title_so=null
		data.title_sn=null
		data.title_sm=null
		data.title_sl=null
		data.title_sk=null
		data.title_si=null
		data.title_sd=null
		data.title_ru=null
		data.title_ro=null
		data.title_pt=null
		data.title_ps=null
		data.title_pl=null
		data.title_pa=null
		data.title_ny=null
		data.title_no=null
		data.title_nl=null
		data.title_ne=null
		data.title_my=null
		data.title_mt=null
		data.title_ms=null
		data.title_mr=null
		data.title_mn=null
		data.title_ml=null
		data.title_mk=null
		data.title_mi=null
		data.title_mg=null
		data.title_lv=null
		data.title_lt=null
		data.title_lo=null
		data.title_lb=null
		data.title_la=null
		data.title_ky=null
		data.title_ku=null
		data.title_ko=null
		data.title_kn=null
		data.title_km=null
		data.title_kk=null
		data.title_ka=null
		data.title_jw=null
		data.title_ja=null
		data.title_iw=null
		data.title_it=null
		data.title_is=null
		data.title_ig=null
		data.title_id=null
		data.title_hy=null
		data.title_hu=null
		data.title_ht=null
		data.title_hr=null
		data.title_hmn=null
		data.title_hi=null
		data.title_haw=null
		data.title_ha=null
		data.title_gu=null
		data.title_gl=null
		data.title_gd=null
		data.title_ga=null
		data.title_fy=null
		data.title_fr=null
		data.title_fi=null
		data.title_fa=null
		data.title_eu=null
		data.title_et=null
		data.title_es=null
		data.title_eo=null
		data.title_en=null
		data.title_el=null
		data.title_de=null
		data.title_da=null
		data.title_cy=null
		data.title_cs=null
		data.title_co=null
		data.title_ceb=null
		data.title_ca=null
		data.title_bs=null
		data.title_bn=null
		data.title_bg=null
		data.title_be=null
		data.title_az=null
		data.title_ar=null
		data.title_am=null
		data.title_af=null		
		
        console.log(data);
        $.ajax({
          url:server_path+'api/categories/updateones',
          type:'POST',
          data:JSON.stringify(data),
          dataType:'json',
          contentType: 'application/json',
          headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
          success:function(json){
              $('.model_save_popup').show();
          }
        })

    })
	.on('click','.model_settings_save',function(){
        data.title = $('input[name=title]').val();
        data.header = $('input[name=header]').val();
		data.title_site = $('input[name=title_site]').val();
		data.title_size = $('input[name=title_size]').val();
		data.title_fonts = $('input[name=title_fonts]').val();
		data.instagram = $('input[name=instagram]').val();
		data.twitter = $('input[name=twitter]').val();
		data.facebook = $('input[name=facebook]').val();
		
        //data.files = JSON.stringify(data.files);
        delete data.author;
        console.log(data);
        //return 0;
        //delete data.files;
        //delete data.files;
        $.ajax({
          url:server_path+'api/settings',
          type:'POST',
          data:JSON.stringify(data),
          dataType:'json',
          contentType: 'application/json',
          headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
          success:function(json){
              $('.model_save_popup').show();
          }
        })

    })
	.on('click','.model_autoposting_save',function(){
        data.facebook_group = $('input[name=facebook_group]').val();
        data.instagram_group = $('input[name=instagram_group]').val();
		data.telegram_group = $('input[name=telegram_group]').val();
		data.facebook_work = $('input[name=facebook_work]').val();
		data.instagram_work = $('input[name=instagram_work]').val();
		data.telegram_work = $('input[name=telegram_work]').val();
		
        //data.files = JSON.stringify(data.files);
        delete data.author;
        console.log(data);
        //return 0;
        //delete data.files;
        //delete data.files;
        $.ajax({
          url:server_path+'api/settings',
          type:'POST',
          data:JSON.stringify(data),
          dataType:'json',
          contentType: 'application/json',
          headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
          success:function(json){
              $('.model_save_popup').show();
          }
        })

    })
	
	.on('click','.model_categories_save',function(){
		if ($('input[name=title]').val()!='') {
			data.title = $('input[name=title]').val();
			$.ajax({
			  url:server_path+'api/categories',
			  type:'POST',
			  data:JSON.stringify(data),
			  dataType:'json',
			  contentType: 'application/json',
			  headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
			  success:function(json){
				  window.location.href=window.location.href
			  }
			})
		}
    })
	.on('click','.model_shop_save',function(){
		if ($('input[name=title]').val()!='') {
			data.title = $('input[name=title]').val();
			$.ajax({
			  url:server_path+'api/shop',
			  type:'POST',
			  data:JSON.stringify(data),
			  dataType:'json',
			  contentType: 'application/json',
			  headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
			  success:function(json){
				  window.location.href=window.location.href
			  }
			})
		}
    })
    .on('click','.add_profile_block',function(){
        $(this).closest('.profile_block').find('input[dataName=file]').click();
    })
	.on('click','.add_logo_block',function(){
        $(this).closest('.logo_block').find('input[dataName=logo]').click();
    })
	.on('click','.add_background_block',function(){
        $(this).closest('.background_block').find('input[dataName=background]').click();
    })
    .on('change','input[dataName=file]',function(){
        var file = this.files[0];
        if (file) {
          upload_file(file);
        }
        return false;
    })
	 .on('change','input[dataName=logo]',function(){
        var file = this.files[0];
        if (file) {
          upload_file1(file);
        }
        return false;
    })
	 .on('change','input[dataName=background]',function(){
        var file = this.files[0];
        if (file) {
          upload_file2(file);
        }
        return false;
    })
    .on('click','.round_button_deleted',function(){
        var src = $(this).closest('.one_profile_block').find('img').attr('src');
        var files = [];
        var del = -1;
        for(i in data.files)
        {
            if(data.files[i].preview == src)
                del = i;
            else
                files.push(data.files[i]);
        }
        data.files = files;
        console.log(data);
        $(this).closest('.one_profile_block').remove();
    })
    ;
function upload_file(file){
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    formData.append("file", file);
    // обработчик для закачки
    xhr.upload.onprogress = function(event) {
      //log(event.loaded + ' / ' + event.total);
    }

    // обработчики успеха и ошибки
    // если status == 200, то это успех, иначе ошибка
    xhr.onload = xhr.onerror = function() {
      if (this.status == 200) {
        view_file(JSON.parse(this.response));
        //log("success");
      } else {
        //log("error " + this.status);
      }
    };

    xhr.open("POST", server_path+"api/upload", true);
    xhr.setRequestHeader("Authorization", 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4');
    xhr.send(formData);
}
function view_file(json)
{
    var file = json.data;
    var i = data.files.length;
    //data.files = [];
    //file.url = 'http://138.197.190.250:3000/'+file.url;
    //file.preview = 'http://138.197.190.250:3000/'+file.preview;
    data.files.push(file);
    //delete file.name;
    view_object_file($('.profile_block'),file);
}


function upload_file1(file){
	
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    formData.append("file", file);
    // обработчик для закачки
    xhr.upload.onprogress = function(event) {
      //log(event.loaded + ' / ' + event.total);
    }

    // обработчики успеха и ошибки
    // если status == 200, то это успех, иначе ошибка
    xhr.onload = xhr.onerror = function() {
      if (this.status == 200) {
        view_file1(JSON.parse(this.response));
        //log("success");
      } else {
        //log("error " + this.status);
      }
    };

    xhr.open("POST", server_path+"api/upload", true);
    xhr.setRequestHeader("Authorization", 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4');
    xhr.send(formData);
}
function view_file1(json)
{
    var file = json.data;
    var i = data.files.length;
    //data.files = [];
    //file.url = 'http://138.197.190.250:3000/'+file.url;
    //file.preview = 'http://138.197.190.250:3000/'+file.preview;
    data.files.push(file);
    //delete file.name;
    view_object_file($('.logo_block'),file);
}


function upload_file2(file){
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    formData.append("file", file);
    // обработчик для закачки
    xhr.upload.onprogress = function(event) {
      //log(event.loaded + ' / ' + event.total);
    }

    // обработчики успеха и ошибки
    // если status == 200, то это успех, иначе ошибка
    xhr.onload = xhr.onerror = function() {
      if (this.status == 200) {
        view_file2(JSON.parse(this.response));
        //log("success");
      } else {
        //log("error " + this.status);
      }
    };

    xhr.open("POST", server_path+"api/upload", true);
    xhr.setRequestHeader("Authorization", 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4');
    xhr.send(formData);
}
function view_file2(json)
{
    var file = json.data;
    var i = data.files.length;
    //data.files = [];
    //file.url = 'http://138.197.190.250:3000/'+file.url;
    //file.preview = 'http://138.197.190.250:3000/'+file.preview;
    data.files.push(file);
    //delete file.name;
    view_object_file($('.add_background_block'),file);
}


function research()
{
    if($('.page_item.active').length > 0)
    {
        var limit = $('.page_item.active').attr('limit');
        var offset = $('.page_item.active').attr('offset');
    }
    else
    {
        var limit = $('.page_limit.active').attr('limit');
        var offset = 0;
    }
    var data = {
        "limit":limit,
        "offset":offset,
        "order":get_order(),
        "name":get_query("name"),
        "role":get_query("role"),
        "user_id":get_query("user_id"),
    };
    if(data.role == 0)
        data.role = '';
    var href = $('.href').text()+'?';
    for(i in data)
    {
        if(i == 'query')
          href += i+'='+JSON.stringify(data[i])+'&';
        else
          href += i+'='+data[i]+'&';
    }
    //history.pushState('', '',href);
    window.ijs.models['row_search'].data = data;
    window.ijs.models['row_search']._search();
}
function get_query(n)
{
    var params = [];
    var name = '';
    $('.title_block').find('input').each(function(){
          if($(this).val())
          {
              params.push([$(this).attr('name'),$(this).val(),'=']);
              if($(this).attr('name') == n)
                  name = $(this).val();
          }
      });

    return name;
    return params;
}
function get_order()
{
    var row = $('.cell_order.active').attr('row');
    if($('.cell_order.active').hasClass('asc'))
      var order = 'ASC';
    else
      var order = 'DESC';
    return row+' '+order;
}
