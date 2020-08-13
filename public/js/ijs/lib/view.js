function Ijs_View(){}
Ijs_View.prototype.find_replase = function(dom,model)
{
    var _this = this;
    if(!dom.attr('data-name'))
      dom.find('[data-name]').each(function(){
          _this.write($(this),model);
      });
    else
      _this.write(dom,model);
}
Ijs_View.prototype.write = function(dom,model)
{
    var _this = this;
    var col_name = dom.attr('data-name').split('?');
    var action = dom.attr('data-action');
    var col = _this.read_path(model,col_name[0]);
    if(!col && col_name.length == 2)
        col = _this.read_path(model,col_name[1]);
    var callback = dom.attr('data-callback');
    if(callback)
    {
        var params = JSON.parse(dom.attr('data-params'));
        window.ijs.listener.call(callback,dom,col,params);
        return 0;
    }
    if(action)
    {
      if(col)
      {
        action = action.split(':');
        if(action.length == 1)
          dom[action[0]](col);
        else if(action.length == 2)
          dom[action[0]](action[1],col);
        else if(action.length == 3)
          dom[action[0]](action[1],action[2]);
      }
    }
    else
    {
        if(col)
            dom.html(col).val(col);
        else
            dom.html('-');
    }
}
Ijs_View.prototype.read_path = function(model,name)
{
    var path = name.split('.');
    for(var i in path)
    {
        if(isFinite(model))
            model = parseFloat(model);
        if(model == path[i])
            return true;
        else if(model[path[i]] || model[path[i]] == 0)
            model = model[path[i]];
        else
            return false;
    }
    return model;
}
