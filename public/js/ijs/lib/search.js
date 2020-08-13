function Ijs_Search(data)
{
    this.dom = $('body');
    this.url = '/models';
    this.model = 'models';
    this.method = 'GET';
}
Ijs_Search.prototype.search = function(data)
{
    this.dom = data.dom;
    this.url = data.url;
    this.model = data.model;
    this.id = data.id;
    this.method = data.method;
    this.data = JSON.parse(data.data);
    this.data_row = this.dom.find('.ijs_search_row').clone();
    this.dom.find('.ijs_search_row').remove();
    this._search();
}
Ijs_Search.prototype._search = function()
{
    var _this = this;
    $.ajax({
        url:_this.url,
        method:_this.method,
        dataType:'json',
        data:_this.data,
        headers: {"Authorization": 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1YmU2MTU3ZTY0MzMxNzAwM2FhN2U4MGIiLCJpYXQiOjE1NDI0NTIyNjF9.e6DK9jUvVjJAqUjZUvNztZyRyhdA1LQOrNQrHXELwM4'},
        success:function(json)
        {
            window.ijs.listener.call(_this.id+'_search',json);
            _this.view(json[_this.model]);
        }
    });
}
Ijs_Search.prototype.view = function(models)
{
    var _this = this;
    for(i in models)
    {
        var new_row = _this.data_row.clone();
        window.ijs.view.find_replase(new_row,models[i]);
        new_row.appendTo(_this.dom);
    }
}
