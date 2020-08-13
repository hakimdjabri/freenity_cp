function Ijs_Event(){}
Ijs_Event.prototype.add = function(data)
{
    this.event = data.event;
    this.model_id = data.model_id;
    this.dom = data.dom;
    this.callback = data.callback;
    this.model_action = data.model_action;
    this.wait(this.dom,this.event,data.callback);
}
Ijs_Event.prototype.wait = function(element,event,before_event,after_event=null)
{
    var _this = this;
    element.on(event,function(){
        window.ijs.listener.call(before_event,$(this));
        window.ijs.models[_this.model_id]['_'+_this.model_action]();
    });
}
