function tweetPost()
{
    var tweet = $("#tweet").val();
    $.ajax({
        type:'POST',
        url:'tweetPost.php',
        data: {
            tweet: tweet
        },
        success:function(result){
            $("#resultTweet").html(result)
        }
    })
}

function messagePost()
{
    var message = $("#message").val();
    var followers = $("#followers").val();
    $.ajax({
        type:'POST',
        url:'messagePost.php',
        data: {
            message: message,
            followers: followers
        },
        success:function(result){
            $("#resultMessage").html(result)
        }
    })
}


/*
JALISWALL 0.3
by Pierre Bonnin - @PierreBonninPRO - 2015
*/
(function($){
  $.fn.jaliswall = function(options){
    
    this.each(function(){
      
      var defaults = {
        item : '.wall-item',
        columnClass : '.wall-column',
        resize:true,
        onChange : function(){void(0);}
      }
      
      var prm = $.extend(defaults, options);
      
      var container = $(this);
      var items = container.find(prm.item);
      var elemsDatas = [];
      var columns = [];
      var nbCols = getNbCols();
      
      init();
      
      function init(){
        nbCols = getNbCols();
        recordAndRemove();
        print();
        if(prm.resize){
          $(window).resize(function(){
            if(nbCols != getNbCols()){
              nbCols = getNbCols();
              setColPos();
              print();
            }
          });
        }
      }
      
      function getNbCols(){
        var instanceForCompute = false;
        if(container.find(prm.columnClass).length == 0){
          instanceForCompute = true;
          container.append("<div class='"+parseSelector(prm.columnClass)+"'></div>");
        }
        var colWidth = container.find(prm.columnClass).outerWidth(true);
        var wallWidth = container.innerWidth();
        if(instanceForCompute)container.find(prm.columnClass).remove();
        return Math.round(wallWidth / colWidth);
      }
      
      // save items content and params and removes originals items
      function recordAndRemove(){
        items.each(function(index){
          var item = $(this);
          elemsDatas.push({
            content : item[0].outerHTML,
            colid : index%nbCols
          });
          item.remove();
        });
      }
      
      //determines in which column an item should be
      function setColPos(){
        for (var i in elemsDatas){
          elemsDatas[i].colid = i%nbCols;
        }
      }
      
      // to get a class name without the selector
      function parseSelector(selector){
        return selector.slice(1, selector.length);
      }
      
      //write and append html
      function print(){
        var tree = '';
        //creates columns
        for (var i=0; i<nbCols; i++){
          tree += "<div class='"+parseSelector(prm.columnClass)+"'></div>";
        }
        container.html(tree);
        
        // creates items
        for (var i in elemsDatas){
          var html='';
          
          var content = (elemsDatas[i].content != undefined)?elemsDatas[i].content:'';
          html += content;
          container.children(prm.columnClass).eq(i%nbCols).append(html);
        }
        
        try{
          prm.onChange();
        }catch(e){
          console.log('jaliswall onChange error / '+e);
        }
        
      }
      
      //creates a well-formed attribute
      function getAttr(attr, type){
        return (attr != undefined)?type+"='"+attr+"'":'';
      }
      
    });
    
    return this;
  }
})(jQuery);




function onChange(){
  console.log('cols number changed');
}

$('.wall').jaliswall({item:'.data', onChange:onChange});