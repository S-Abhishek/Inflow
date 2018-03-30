
$(function(){

  console.log($("#uid").text());

  id = $("#uid").text();

  function addtag(id,name){

      $(".empty").hide();
      $tag = "<div id='"+id+"' class = 'tag col-md-3 '><span class='glyphicon glyphicon-minus mini' aria-hidden='true'></span><button class='chkclose'><span aria-hidden='true'>&times;</span></button>"+
        "<h3 class='checktitl' contenteditable='true' >"+name+"</h3>"+
        "<input type='text' class='enter' placeholder=' + Add Item'><div class='more'><input type='checkbox' class='chk'><label class='hp' for='checkbox'>Prioritize</label><span class='glyphicon glyphicon-ok sve' aria-hidden='true'></span></div>"+
        "<div class='list high'></div><hr><div class='list low'></div><hr><div class='list done'></div><span title='Clear Completed Items' class='clear'>CLEAR</span></div>";
      
       $("#row").append($tag);
             $("#row").masonry('reloadItems');
                 $("#row").masonry('layout');
    }

    function preptag(tag){
      tag = tag.split(" ");
        tag = $.map(tag, function(value){
          return value.trim();
        });

      ret="";
      $.each(tag,function(index, value){
          ret+=value+"-";
      });

      return ret.slice(0,-1);
    }


    function addcheck(id,title, pri,tag)
       {
        id=id.trim();
          console.log([id,title,pri,tag]);
          p = ["done","low","high"];
          if(pri==-1){
            checked="checked disabled";
            prom='';
          }
          else{
            checked="";
            prom='<span title="Add to Schedule" class="glyphicon glyphicon-time prom"></span>';
          }

          var t = $("#"+tag);
          // t.children("."+p[parseInt(pri)+1]).append("<li class='pck' id='"+id+"'><input type='checkbox' title='Marks as Done' class='item' "+checked+"/><label>"+title+prom+"</label></li>").hide().fadeIn(400);
          t.children("."+p[parseInt(pri)+1]).append("<li class='pck' id='"+id+"'><input type='checkbox' title='Marks as Done' class='item' "+checked+"/><label>"+title+"</label>"+prom+"</li>").hide().fadeIn(400);
          if(pri==-1)
          {
            $("#"+tag+" .clear").show();   
          }

          $("#row").masonry('reloadItems');
          $("#row").masonry('layout');

       }
    var count = 0;
    $("#t1").click(function(){
        console.log("check");
        count++;
        if(count==1)
        {
            $.get("getData.php?data=tags&i="+id,function(data)
          	{
            	TagData = JSON.parse(data);
            	console.log("Tag Loaded");
              if(TagData.length==0)
                $(".empty").show();
            	for(i=0; i<TagData.length; i++ )
              	{
               		 addtag("k"+TagData[i].id,TagData[i].name);
                   if(i==TagData.length-1)
                   {
                     $.get("getData.php?data=check&i="+id,function(data)
                     {
                        CheckData = JSON.parse(data);
                        console.log(CheckData);
                        console.log("check Loaded");
                        for(i=0; i<CheckData.length; i++ )
                           {
                              addcheck("c"+CheckData[i].id, CheckData[i].title, CheckData[i].priority, "k"+CheckData[i].tag );

                           }
                      });
                      
                       
                   }
              	}
           	});
          
               
          
                  $(".row").on('focus', '.checktitl', function(){
                    var old = $(this).parent(".tag").attr('id');
                      $(this).focusout(function(){
                        tag = $(this).text();
                        if(tag.trim().length>0){
                          $.get("editData.php?data=tag&title="+preptag(tag)+"&old="+old.slice(1));
                          console.log("editData.php?data=tag&title="+preptag(tag)+"&old="+old.slice(1));
                        }
                        if(tag=='')
                        {
                          $(this).text("Empty");
                        }
                      });   
                  });
        
        
                  $(".row").on('focus click keydown', '.enter', function(){
                    $(this).next(".more").fadeIn(400);
                  });
        
                  $(".row").on('mouseleave', '.tag', function(){
                    $(this).children(".more").fadeOut(400);
                  });
        
        
                  $(".row").on('change','.high .item', function(){
                    
                    id = $(this).parent('li').attr('id');
                    tag = $(this).parent('li').parent('.high').parent('.tag').attr('id');
                    title = $(this).nextAll('label').text();
                     addcheck(id,title,-1,tag);
                    tag = $(this).parent('li').parent('.high').parent('.tag').attr('id');
                     $.get("switch.php?data=check&id="+id.slice(1));
                    $(this).parent('li').remove();
                     
        
                  });
        
                  $(".row").on('click','.clear', function(){
                      $(this).prevAll(".done").children("li").fadeOut(400);
                      tag = $(this).parent(".tag").attr('id');
                      console.log("delData.php?data=done&tag="+tag);
                      $.get("delData.php?data=done&tag="+tag.slice(1));
                      $(this).fadeOut();
                       $("#row").masonry('reloadItems');
                     $("#row").masonry('layout');
                  });
        
                  $(".row").on('change','.low .item', function(){
                    
                    id = $(this).parent('li').attr('id');
                    tag = $(this).parent('li').parent('.low').parent('.tag').attr('id');
                    title = $(this).nextAll('label').text();
                     addcheck(id,title,-1,tag);
                     $.get("switch.php?data=check&id="+id.slice(1));
                     console.log("switch.php?data=check&id="+id.slice(1));
                    $(this).parent('li').remove();
        
        
                  });
        
        
                  $(".row").on('mouseenter','.tag', function(){
                      var ptag = $(this).children(".checktitl");
                      var tag = $(this);
                      $(this).children('.chkclose').show();
                      $(this).children('.mini').show();
        
                      $(".row").on('click','#'+tag.attr('id')+' .chkclose', function(){
                          $.get("delData.php?data=tag&tag="+tag.attr('id').slice(1));
                          console.log("delData.php?data=tag&tag="+tag.attr('id').slice(1));
                          tag.fadeOut();
        
                          console.log('#'+tag.attr('id')+' .chkclose');
                    });

                       $(".row").on('click','#'+tag.attr('id')+' .mini', function(){
                        tag.children('.list').hide();
                        tag.children('hr').hide();
                        tag.children('input').hide();
                        tag.children('.clear').hide();
                        tag.children('.mini').removeClass('glyphicon-minus').removeClass('mini').addClass('glyphicon-unchecked').addClass('exp');

                       });

                         $(".row").on('click','#'+tag.attr('id')+' .exp', function(){
                         tag.children('.list').show();
                        tag.children('hr').show();
                        tag.children('input').show();
                        tag.children('.clear').show();
                         tag.children('.exp').removeClass('glyphicon-unchecked').removeClass('exp').addClass('glyphicon-minus').addClass('mini');

                   });
        
                  });





        
                  $(".row").on('mouseleave','.tag', function(){
                      $(this).children('.chkclose').hide();
                      $(this).children('.mini').hide();
                    });
        
                  // $(".row").on('mouseenter','.pck', function(){
                  //   $(this).children('label').children('.prom').show();
                  // });
                  // $(".row").on('mouseleave','.pck', function(){
                  //   $(this).children('label').children('.prom').hide();
                  // });

                  $(".row").on('mouseenter','.pck', function(){
                    $(this).children('.prom').show();
                  });
                  $(".row").on('mouseleave','.pck', function(){
                    $(this).children('.prom').hide();
                  });
        
               $(".row").on('keyup','.enter', function(){
                if (event.keyCode === 13) {
                  $(this).nextAll(".more").children('.sve').click();
                  }
                });
        
                $(".row").on('click','.sve', function(){
                 var title = $(this).parent(".more").prev(".enter").val();
                 var pri = $(this).prevAll('.chk').is(":checked");
                 var tag = $(this).parent('.more').parent('.tag').attr('id');
                 if(title.trim().length != 0 ){     
        
                       if(pri)
                          pri=1;
                       else
                          pri=0;
                        
                        $.get("addData.php?data=check&title="+preptag(title)+"&pri="+pri+"&tag="+tag.slice(1),function(data){
                           data=data.trim();
                            console.log(data);
                            addcheck("c"+data,title,pri,tag);
                        });
                        console.log("addData.php?data=check&title="+preptag(title)+"&pri="+pri+"&tag="+tag.slice(1));
                        $(this).parent(".more").prev(".enter").val("");
                        $(this).parent(".more").prev(".enter").attr("placeholder", " + Add Item ");

                   
                   
                        
                     }
              });
        }
    
    });
   
    $(".tagname").keyup(function(){
      if (event.keyCode === 13) 
      {
        $(".entertag").click();
      }
      });

  $(".entertag").click(function(){
      var tag = $(".tagname").val();
        if(tag.trim().length!=0){
            $.get("addData.php?data=tag&tag="+preptag(tag),function(data){
              data=data.trim();
              console.log(data);
              addtag("k"+data,tag);
              $('html, body').animate({
                    scrollTop: $("#k"+data).offset().top
                }, 1000);
              $("#k"+data+" .enter").focus();

            });
            console.log("addData.php?data=tag&tag="+preptag(tag));
            $(".mcheck").modal('hide');

          }
  });

   $("#AddChk").click(function(){
        $("#ChkModal").modal();
    });

setInterval(function () { 
             $("#row").masonry('reloadItems');
                 $("#row").masonry('layout');
             
          },400);
});



