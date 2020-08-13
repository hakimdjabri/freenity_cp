function Ijs_CRUD()
{
    this.data_blocks = {};
    this.update_data = {};
    this.create_data = {};
    this.delete_data = {};
    this.view_data = {};
    this.model = {};
}
Ijs_CRUD.prototype.delete = function(data)
{
    var _this = this;
    _this.delete_data = data;

}
Ijs_CRUD.prototype._delete = function()
{
  var _this = this;
  $.ajax({
      url:_this.delete_data.url,
      type:_this.delete_data.method,
      dataType:'json',
      headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
      success:function(json){
          window.ijs.listener.call(_this.delete_data.id+'_'+_this.delete_data.action);
      }
  });
}
Ijs_CRUD.prototype.create = function(data)
{
    var _this = this;
    _this.create_data = data;
}
Ijs_CRUD.prototype._create = function()
{
    var _this = this;
    var data = {};
    _this.create_data.dom.find('input[name],textarea[name]').each(function(){
        if($(this).attr('type') != 'radio' && $(this).attr('type') != 'checkbox')
            data[$(this).attr('name')] = $(this).val();
        else if($(this).prop("checked"))
            data[$(this).attr('name')] = $(this).val();
    });
    _this.create_data.dom.find('select[name]').each(function(){
        data[$(this).attr('name')] = $(this).val();
    });
    $.ajax({
        url:_this.create_data.url,
        type:_this.create_data.method,
        dataType:'json',
        data:data,
        success:function(json){
            window.ijs.listener.call(_this.create_data.id+'_'+_this.create_data.action);
        }
    });
}
Ijs_CRUD.prototype.update = function(data)
{
    var _this = this;
    _this.update_data = data;
}
Ijs_CRUD.prototype._update = function()
{
    var _this = this;
    var data = {};
    _this.update_data.dom.find('input[name],textarea[name]').each(function(){
        if($(this).attr('type') != 'radio' && $(this).attr('type') != 'checkbox')
            data[$(this).attr('name')] = $(this).val();
        else if($(this).prop("checked"))
            data[$(this).attr('name')] = $(this).val();
    });
    _this.update_data.dom.find('select[name]').each(function(){
        data[$(this).attr('name')] = $(this).val();
    });
    $.ajax({
        url:_this.update_data.url,
        type:_this.update_data.method,
        dataType:'json',
        data:data,
        success:function(json){
            window.ijs.listener.call(_this.update_data.id+'_'+_this.update_data.action);
        }
    });
}
Ijs_CRUD.prototype.view = function(data)
{
    var _this = this;
    _this.view_data = data;
    $.ajax({
        url:data.url,
        type:data.method,
        dataType:'json',
        headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
        success:function(json)
        {
            _this.model = json[data.model];
            window.ijs.view.find_replase(data.dom,json[data.model]);
            window.ijs.listener.call(data.id+'_'+data.action,json);
        }
    });
}
