$(function()
{
		$(window).resize(function () 
		{
	
		$(".mypopover").popover('show');
		});
		

		
		
		var schData;
		 $("#AddSch").click(function()
     	{
        	$("#SchModal").modal();
    	});

     $('#timepicker1').datetimepicker({
        format: 'hh:mm:ss',
        language: 'pt-BR',
        pickDate:false,
        use24hours: true
      });

      $('#datepicker1').datetimepicker({
        format: 'yyyy-MM-dd',
        language: 'pt-BR',
        pickTime:false
      });
			

		
		id = $("#uid1").text();
		console.log(id);
		var done = false;
		$.get("getData.php?data=checkd&i="+id,function(data)
		{
				setInterval(function () { 
			   		
			   				dataper = new Date();
			   				var x1=(dataper.getHours())*60*60 + (dataper.getMinutes())*60 + (dataper.getSeconds());
							var y1=Math.ceil(((x1)/864));
							

				   			$('#ey').html('<div class="progress progress-bar-vertical"><div  class="progress-bar" role="progressbar" aria-valuenow="'+y1+'" aria-valuemin="0" aria-valuemax="100" style="height:'+y1+'%;"></div></div>');
				   			
			   			
					},1000);
				schData=JSON.parse(data);
				for(i=0; i<schData.length; i++ )
				{
					console.log(schData[i].id+" "+schData[i].title+" "+schData[i].datee+" "+schData[i].timee);
					addcount(schData[i].id,schData[i].title,schData[i].datee,schData[i].timee);
					$('.mypopover').popover('show');	
				if(i==schData.length-1)
		   		done=true;
		   		$('.mypopover').popover('show');
		   		
				}
			

		
		});
		function checkdat(id,title,date,time)
		{
			console.log("getData.php?data=checkd&i="+id);
			$.get("getData.php?data=checkd&i="+id,function(data)
			{
				var dateper =  new Date();
				
				

				schData=JSON.parse(data);
				for(i=0; i<schData.length; i++ )
				{
					console.log(schData[i].id+" "+schData[i].title+" "+schData[i].datee+" "+schData[i].timee)
					addcount(schData[i].id,schData[i].title,schData[i].datee,schData[i].timee);


				if(i==schData.length-1)
		   		done=true;

		   		
				}
				$('.mypopover').popover('show');

			});
		}

		

		function addcount(id,title,date,time)
		{		
				
				var ndate =  new Date(date+" "+time);
				timeo=ndate.getHours()+":"+ndate.getMinutes()+":"+ndate.getSeconds();
				console.log(ndate);
				console.log(ndate.getHours()+" "+ndate.getMinutes()+" "+ndate.getSeconds());
				var x=(ndate.getHours())*60*60 + (ndate.getMinutes())*60 + (ndate.getSeconds());
				var y=Math.ceil(((x)/864));
				console.log(y);
				$("<li class='mypopover' id=s"+schData[i].id+" data-placement='right' style='top:"+y+"%' data-content="+schData[i].title+"></li>"+"<button class='close'><span aria-hidden='true'>&times;</span></button>").appendTo('#horizontal-style');
				//topalter(y,schData[i].id);
				$('.mypopover').popover({
    						html: true,
    						title:timeo,
    						content: schData[i].title
    					
						});
				$('.popover-content').append('<a class="close" style="position: absolute; top: 0; right: 6px;">&times;</a>');
				$('.mypopover').popover('show');		
		}
		


      $('#adds').click(function(){

      			var titl = $("#schtitl").val();
	      		var tim = $("#schtim").val();
	      		var dat = $("#schdat").val();
	      		console.log(dat+" "+tim);
	      		$("#SchModal").modal('hide');
	      		console.log(schtitl);
	      		console.log("addData.php?data=count&id="+id+"&titl="+titl+"&d="+dat+"&t="+tim);
	      		
	      		$.get("addData.php?data=count1&id="+id+"&titl="+titl+"&d="+dat+"&t="+tim,function(data)
	      		{

	      			console.log(data);
	      		 
	      		 	schData.push({id : data, title : titl , date : dat ,time: tim});

	      		 	checkdat(data,titl,dat,tim);
	      		 
	      		});


      });
        $('#timepicker1').datetimepicker({
        format: 'hh:mm:ss',
        language: 'pt-BR',
        pickDate:false
      });

      $('#datepicker1').datetimepicker({
        format: 'yyyy-MM-dd',
        language: 'pt-BR',
        pickTime:false
      });

	

    
});