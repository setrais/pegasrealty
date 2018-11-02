var md={
        /**
         * All settings recursive initialization
         * (adds parentScope() method to each scope)
         * 
         * @param object $
         * @param object scope
         * @return void
         */
        init: function($, scope){
                var bind=function(fn,context){
                        return function(){
                                var ret=fn.apply(context,arguments);
                                return (undefined===ret)?context:ret;
                        };
                }, fnScope=function(){
                        return scope;
                }, callee=arguments.callee;

                $.each(scope, function(name, context){
                        // delegation & recursion
                        if('object'===typeof(context) && context && !$.isArray(context))
                                callee($,$.extend(context,{parentScope:fnScope}));
                        else if($.isFunction(context))
                                scope[name]=bind(context,scope);
                        if($.isFunction(context.init))
                                context.init();
                });
        },
        /**
         * Additional to application.clientScript
         * @var object
         */
        clientScript: {
                /**
                 * Default collection of already included scripts/css
                 * @var array
                 */
                scripts: ['jquery.js'],
                /**
                 * ClientScript initialization
                 */
                init: function(){
                        this.initMap().fixAjax().fixAjaxSetup();
                },
                /**
                 * Collect already loaded scripts
                 */
                initMap:function(){
                        this.scriptMap.apply(this,$('script[src!=],link[rel=stylesheet][href!=]').map(function(i,item){
                                return encodeURIComponent((item=$(item)).attr(item.is('script')?'src':'href').replace(/.*?\/([^\/]+)$/,'$1'));
                        }).toArray());
                },
                /**
                 * @param string argument
                 * @return null|array
                 */
                scriptMap:function(){
                        var scope=this,
                                args=arguments;

                        if(args.length>0)
                                scope.scripts=scope.scripts.concat($.map(args,function(script){
                                        if(-1===$.inArray(script,scope.scripts))
                                                return script;
                                }));
                        else
                                return scope.scripts||[];
                },
                fixAjax: function(){
                        var ajax=$.ajax,
                                scriptMap=this.scriptMap;

                        $.ajax=function(options){
                                if(!options.data)
                                     options.data='scriptMap='+scriptMap().join(",");
                                else //if( -1===options.data.indexOf('scriptMap')) 
                                     options.data+='&scriptMap='+scriptMap().join(",");
                                     

                                return ajax.apply(this,arguments);
                        };
                },
                /**
                 * Add complete function to AjaxSetup to extract used scripts/css for scriptMap object
                 * @return void
                 */
                fixAjaxSetup: function(){
                        var scriptMap=this.scriptMap;
                        $.ajaxSetup({
                                success:function(data){
                                        if(data)
                                                $.map(data.match(/<(script|link)[^<>]*?(src|href)[^<>]*?>/g)||[],function(tag){
                                                        scriptMap(tag.match(/(src|href)=(["']).*?\/([^\/]+)\2/)[3]);
                                                });
                                },
                                complete:function(xhr,text){
                                        if(xhr.responseText)
                                                $.map(xhr.responseText.match(/<(script|link)[^<>]*?(src|href)[^<>]*?>/g)||[],function(tag){
                                                        scriptMap(tag.match(/(src|href)=(["']).*?\/([^\/]+)\2/)[3]);
                                                });
                                }
                        });
                }
        }
};


$(function(){
        md.init($, md);
});

