//Ext.onReady = function(){
    Ext.select('h3.code a').each(function(obj){
        obj.on('click', function(evt, obj){
        	console.log(obj)
            evt.preventDefault();
            var parent = Ext.get(obj).findParentNode('div.codeContainer', 10, true);
            var pre = parent.select('div.syntaxhighlighter');
            console.log(pre);
            pre.toggleClass('expanded');
            
            return false;
        });
    });
    
    SyntaxHighlighter.all()
     
//}


//alert("foo");