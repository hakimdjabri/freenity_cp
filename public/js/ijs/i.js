function Ijs(conf) {
    this.conf = {
      path:conf.path?conf.path:'/js/ijs/',
      dom:conf.dom?conf.dom:$('body')
    };
    this.models = {};
    this.listener = new Ijs_listener();
    this.loader = new Ijs_load(this.conf.path);
    document.addEventListener("DOMContentLoaded", this.Run);
}
Ijs.prototype.Run = function() {
    var _this = window.ijs;
    var scripts = [
        _this.conf.path+'lib/crud.js?1',
        _this.conf.path+'lib/search.js',
        _this.conf.path+'lib/analyzer.js',
        _this.conf.path+'lib/view.js',
        _this.conf.path+'lib/event.js'
    ];
    _this.loader.add(scripts, 'ijs_first_load');
    _this.listener.add('ijs_first_load',_this.load);
}
Ijs.prototype.load = function() {
    var _this = window.ijs;
    _this.view = new Ijs_View();
    _this.event = new Ijs_Event();
    _this.analyzer = new Ijs_Analyzer(_this.conf.dom);
    for( i in _this.analyzer.found )
    {
        if(!_this.models[_this.analyzer.found[i].id])
            _this.models[_this.analyzer.found[i].id] = new _this.analyzer.found[i].where();
        if(_this.models[_this.analyzer.found[i].id][_this.analyzer.found[i].action])
            _this.models[_this.analyzer.found[i].id][_this.analyzer.found[i].action](_this.analyzer.found[i]);
    }
}
//Listener
function Ijs_listener()
{
    this.wait = {};
}
Ijs_listener.prototype.add = function(from,callback)
{
    if(!this.wait[from])
        this.wait[from] = [];
    this.wait[from].push(callback);
}
Ijs_listener.prototype.call = function(from,what=null)
{
    if(this.wait[from])
    {
        for(i in this.wait[from])
            if(arguments.length < 3)
                var data = this.wait[from][i](what);
            else
                var data = this.wait[from][i](arguments);
    }
    return data;
}
//Loaders
function Ijs_load(path)
{
    $.ajaxSetup({
        cache: true
    });
    this.callbacks = {};
    this.path = path;
    this.scripts = {};
}
Ijs_load.prototype.add = function(scripts, add_from)
{
    this.callbacks[add_from] = add_from;
    for(i in scripts)
    {
        if(!this.scripts[scripts[i]])
            this.scripts[scripts[i]] = new Ijs_script(scripts[i],add_from);
        else
            this.scripts[scripts[i]].add_callback(add_from);
    }
    this.load();
}
Ijs_load.prototype.load = function()
{
    var load = this;
    for(var script in load.scripts)
        load.scripts[script].load(load.success);
}
Ijs_load.prototype.success = function()
{
    var callbacks = {};
    var load = window.ijs.loader;
    for(var script in load.scripts)
    {
        for(var key in load.scripts[script].callbacks)
        {
            var callback = load.scripts[script].callbacks[key];
            if(!callbacks[callback])
                callbacks[callback] = load.scripts[script].status;
            callbacks[callback] = callbacks[callback] > load.scripts[script].status ? load.scripts[script].status : callbacks[callback];
        }
    }
    for(var callback in callbacks)
    {
        if(callbacks[callback] == STATUS.DONE && load.callbacks[callback])
        {
            window.ijs.listener.call(callback);
            delete load.callbacks[callback];
        }
    }
}
//Scripts
function Ijs_script(name,add_from)
{
    this.status = STATUS.WAIT;
    this.name = name;
    this.callbacks = [add_from];
}
Ijs_script.prototype.add_callback = function(add_from)
{
    this.callbacks.push(add_from);
}
Ijs_script.prototype.load = function(callback)
{
    var script = this;
    if(script.status == STATUS.WAIT)
    {
        script.status = STATUS.LOAD;
        script.cachedScript(script.name).done(function(script_ajax, textStatus) {
            script.status = STATUS.DONE;
            callback();
        });
    }
}
Ijs_script.prototype.cachedScript = function(url, options) {
   options = $.extend(options || {}, {
       dataType: "script",
       cache: true,
       url: url
   });
   return jQuery.ajax(options);
};

var STATUS = {
  WAIT:1,
  LOAD:2,
  DONE:3
};
