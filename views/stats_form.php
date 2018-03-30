
		</header>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/stats.css">
		<span class='emptyStats'>Add Items in To-Do to get Statistics<br><span class="glyphicon glyphicon-stats glyst" aria-hidden="true"></span></span>
		<div id="stats">
			<span class="stattitl" style='background: #ff5e62;'>Total Progress</span>
			<div class='totchk row'></div>
			<span class="stattitl" style='background: #0aad92;'>Progress per tag</span>
			<div class="chkstats row"></div>
			<span class="stattitl" style='background: #3366cc;'>Tagwise Distribution</span>
			<div class="chartdiv">
				<div class='col-md-8 gchart'><div  id="chart_div"></div><div  class='foot'><h3>Items per tag</h3></div></div>
			</div>
		<!-- </div> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$(function(){
	$.get("getData.php?data=tags",function(data){
		TagData = JSON.parse(data);
		if(TagData.length>0)
		{
			$("#stats").show();
			$(".emptyStats").hide();
		}

		
		   $.get("getData.php?data=check",function(data1){
		      CheckData = JSON.parse(data1);
		   

		       
		      google.charts.load('current', {'packages':['corechart']});
		      google.charts.setOnLoadCallback(drawChart);

		      function drawChart() {
		         list=[];
		        tag=TagData;
		        check=CheckData;
		        count2=[];
		        console.log(tag);

		        for(i=0;i<tag.length;i++)
		        { count=0;
		          for(j=0;j<check.length;j++)
		          {
		          if(tag[i]["id"]==check[j]["tag"])
		          {
		            count++;
		          }

		        }
		        count2[i]=count;
		        }
		        for(k=0;k<tag.length;k++)
		        {
		          list[k]=[tag[k]['name'],count2[k]];
		        }

		        // Create the data table.
		        var data = new google.visualization.DataTable();
		        data.addColumn('string', 'tagname');
		        data.addColumn('number', 'no of checks');
		        for(l=0;l<list.length;l++)
		        {
		           data.addRows([list[l]]);
		        }
		       

		        // Set chart options
		        var options = {
		                       'width':320,
		                       'height':320,
		                   		'chartArea': {'width': '95%', 'height': '80%'},
               				    'legend': {'position': 'bottom'}};

		        // Instantiate and draw our chart, passing in some options.
		        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		        chart.draw(data, options);
		      }

		       var done=0,undone=0;
		      for(var i=0; i<CheckData.length; i++)
		      {
		      		if(CheckData[i].priority<0)
		      			done++;
		      		else
		      			undone++;
		      }

		       
		      compl=done +"/"+ (done+undone) ;
		      val=Math.floor(done/(done+undone)*100);
		   
		      if(done==0 && undone==0){
		      	compl="No items";
		      	val=0;
		      }

		      $("<div class='col-md-6 grph' id='gtT' ><input class='dial' data-linecap='round'"+
		      	" value="+val+" data-fgColor='#ff5e62' ><div class='foot'><h4>Total</h4><h3> Completed : "+compl+"</h3></div></div>").appendTo(".totchk");

		 for(var j=0; j<TagData.length; j++ ){

		      var done=0,undone=0;
		      for(var i=0; i<CheckData.length; i++)
		      {
		      	if(CheckData[i].tag==TagData[j].id){
		      		if(CheckData[i].priority<0)
		      			done++;
		      		else
		      			undone++;
		      	}

		      }
		      console.log(done,undone);
		      compl=done +"/"+ (done+undone) ;
		      val=Math.floor((done/(done+undone))*100);
		    
		      if(done==0 && undone==0){
		      	compl="No items";
		      	val=0;
		      }

		      $("<div class='col-md-2 grph' id='gt"+TagData[j].id+"' ><input class='dial' data-linecap='round'"+
		      	" value="+val+" data-fgColor='#00aa8d' ><div class='foot'><h4>"+TagData[j].name+"</h4><h3> Completed : "+compl+"</h3></div></div>").appendTo(".chkstats");

		    }

		    $(".dial").knob({
        	'readOnly':true
       	 });
		  });
   		
	});

})
</script>



