
$(function()
{		

		$("#t3").click(function(){
			$("#counts").hide().fadeIn(400);
		});

		$("#t2").click(function(){
			
		});

		$("#t1").click(function(){
			$(".checkhold").hide().fadeIn(400);
		});


		$("#AddBtn").click(function(){
	        $("#AddModal").modal();
	    });

			
		var initial = $("#counts div");
		$("#counts").sortable({
	         containment: 'parent',
	         revert: 50,
	         tolerance: 'pointer',
	         cursor: 'move',
	         update: function(){
	 					if(done==true) {
	 					$(".save,.reset").fadeIn(400);
	 					console.log("called");
	 						}
	 					}
	    });
	   


		$("#counts").disableSelection();


		$(".reset").click(function(){
			console.log(initial);
			location.reload();
			$(location).attr('href', '#counts');
		});

		
		var cdate = new Date();
	    $('#timepicker').datetimepicker({
	        format: 'hh:mm:ss',
	        language: 'pt-BR',
	        pickDate:false,
	        autoclose : true
	      });

	      $('#datepicker').datetimepicker({
	        format: 'yyyy-MM-dd',
	        language: 'pt-BR',
	        pickTime:false,
	        startDate : cdate,
	        autoclose : true
	      });

	      function assignClass()
	      {	
	     		types = ['light','dark','light','dark'];
	     		cls = 'box-'+types[Math.floor(Math.random()*4)]+'-t0'+ Math.floor(Math.random()*6);
	     		return cls;
	      }

	         

		id = $("#uid").text();
		var done = false;
		$.get("getData.php?data=count&i="+id,function(data)
		{
			countData = JSON.parse(data);
			console.log(countData);

			for(i=0; i<countData.length; i++ )
			{
				addcount(countData[i].id, countData[i].type, countData[i].title,countData[i].deadline)

				if(i==countData.length-1)
		   		done=true;
		   		
			}
			var old = $("#counts").sortable("toArray");

			function getTimeRemaining(endtime)
	    	{
			  	var t = Date.parse(endtime) - Date.parse(new Date());
			  	if(t<0)
			  		return "Event Over";
			  	var seconds = Math.floor( (t/1000) % 60 );
			  	var minutes = Math.floor( (t/1000/60) % 60 );
			  	var hours = Math.floor( (t/(1000*60*60)) % 24 );
			  	var days = Math.floor( t/(1000*60*60*24) );
			  	return {
			    'total': t,
			    'days': ("0" + days).slice(-2),
			    'hours': ("0" + hours).slice(-2),
			    'minutes': ("0" + minutes).slice(-2),
			    'seconds': ("0" + seconds).slice(-2)
		 		 };
		    }

			setInterval(function () { 
			   		for(i=0; i<countData.length; i++ )
			   			{
			   				d = new Date(countData[i].deadline);
			   				t = getTimeRemaining(d);
			   				if(t=="Event Over")
			   				$('#e'+countData[i].id).children(".timer").html(t);
			   				else
				   			$('#e'+countData[i].id).children(".timer").html(t['days']+" "+t['hours']+" "+t['minutes']+" "+t['seconds']);
				   			
			   			}
					},1000);


			$(".save").click(function() {
				$(".save").fadeOut(400);
				$(".reset").fadeOut(400);
				var upd = $("#counts").sortable("toArray");
				for(i in old)
				{
					var o = parseInt(old[i].slice(1)); 
					var n = parseInt(upd[i].slice(1));
					if(o!=n && o<n)
					{
						console.log("switch.php?data=count&s="+o+"&d="+n);
						$.get("switch.php?data=count&s="+o+"&d="+n);
						
					}
				}
				old = $("#counts").sortable("toArray");
			});
			
			function formatAMPM(date) {

				  var hours = date.getHours();
				  var minutes = date.getMinutes();
				  var ampm = hours >= 12 ? 'pm' : 'am';
				  hours = hours % 12;
				  hours = hours ? hours : 12; // the hour '0' should be '12'
				  minutes = minutes < 10 ? '0'+minutes : minutes;
				  var strTime = hours + ':' + minutes + ' ' + ampm;
				  return strTime;
				}

			function addcount(id,type,title,date)
			{		
					var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June",
  					"July", "Aug", "Sep", "Oct", "Nov", "Dec"
					];
					var ndate =  new Date(date);
					console.log(date);
		   			$("<div id='e"+countData[i].id+"' class = '"+countData[i].type+"'>"+
		   			"<h3 class='title'>"+countData[i].title+"</h3>"+
		   			"<h5 class='dday' >"+ndate.getDate() +"-"+ monthNames[ndate.getMonth()] +"-"+ndate.getFullYear() + "      " +formatAMPM(ndate) + "</h5>"+
		   			"<h4 class='dhms'> D H M S</h4>"+
		   			"<h2 class='timer'></h2>"+
		   			"<button class='close'><span aria-hidden='true'>&times;</span></button>").appendTo('#counts').hide().fadeIn(400);

		   			old = $("#counts").sortable("toArray");
		   	}

	   		$("#addevt").click(function(){
	      		var titl = $("#titl").val();
	      		var time = $("#tim").val();
	      		var date = $("#dat").val();
	      		console.log(date+" "+time);
	      		$("#AddModal").modal('hide');
	      		console.log(titl);
	      		var cls = assignClass();
	      		console.log("addData.php?data=count&id="+id+"&titl="+titl+"&d="+date+"&t="+time+"&typ="+cls);
	      		$.get("addData.php?data=count&id="+id+"&titl="+titl+"&d="+date+"&t="+time+"&typ="+cls,function(data){
	      			console.log(data);
	      			data=data.trim();
	      		 cls = cls.split("-");
	      		 cls= cls[0]+" "+cls[1]+" "+cls[2];
	      		 countData.push({id : data, title : titl , deadline : date +" "+ time ,type : cls });
	      		 addcount(data,cls,titl,date+" "+time);
	 		     console.log(countData);
	      		});
	      		 
	      		
	      	});

			   	var uncl = false;

			   	$('#counts').on('mouseenter', '.box', function() {
			   	 	$( this ).children( ".close" ).show();
			   	 });
			   	$('#counts').on('mouseleave', '.box', function() {
			   	 	$( this ).children( ".close" ).hide();
			   	 });

				$('#counts').on('click','.box .close',function(){
						
						var k = $(this).parent();
						k.fadeOut(200);
						
						$(".undo").clearQueue();
						uncl = false;
						var cls = $(this).parent().attr('id');
						var timeout1 = setTimeout(function(){
							$(".undo").fadeOut(400);
						},5000);

						var timeout2 = setTimeout(function(){
							if(!uncl){
							$.get("delData.php?data=count&id="+cls.slice(1));
							k.remove();
							console.log("delData.php?data=count&id="+cls.slice(1));
							}
						},5000);

						$(".close").click(function(){
							clearTimeout(timeout1);
						});

						$(".undo").fadeIn(400);
						$(".undo").click(function(){
							uncl = true; 
							$(".box").clearQueue();	
							k.show();
							$(".undo").fadeOut(400);
						});
			});
		});

});

