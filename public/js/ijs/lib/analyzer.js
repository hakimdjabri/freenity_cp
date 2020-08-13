function Ijs_Analyzer(dom=null)
{
    this.dom    = dom;
    this.found  = [];
    this.find();
}
Ijs_Analyzer.prototype.find = function()
{
    var analyze = this;
    analyze.dom.find('.ijs_content').each(function(){
        var found       = {};
        found.dom       = $(this);
        found.where     = Ijs_CRUD;
        found.action    = $(this).attr('action');
        found.z_index   = $(this).attr('z-index')?$(this).attr('z-index'):0;
        found.model     = $(this).attr('model');
        found.url       = $(this).attr('url');
        found.method    = $(this).attr('method');
        found.id        = $(this).attr('model-id');
        analyze.found.push(found);
    });
    analyze.dom.find('.ijs_search').each(function(){
        var found       = {};
        found.dom       = $(this);
        found.where     = Ijs_Search;
        found.action    = 'search';
        found.z_index   = $(this).attr('z-index')?$(this).attr('z-index'):0;
        found.model     = $(this).attr('model');
        found.url       = $(this).attr('url');
        found.method    = $(this).attr('method');
        found.id        = $(this).attr('model-id');
        found.data      = $(this).attr('data');
        analyze.found.push(found);
    });
    analyze.dom.find('.ijs_event').each(function(){
        var found           = {};
        found.dom           = $(this);
        found.where         = Ijs_Event;
        found.action        = 'add';
        found.z_index       = $(this).attr('z-index')?$(this).attr('z-index'):0;
        found.model_id      = $(this).attr('model-id');
        found.model_action  = $(this).attr('model-action');
        found.event         = $(this).attr('data-event');
        found.callback      = $(this).attr('data-callback');
        found.id            = 'event_'+Math.floor(Math.random() * 1000);
        analyze.found.push(found);
    });
}
