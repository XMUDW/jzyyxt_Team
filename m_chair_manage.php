<?php require_once 'CheckSession.php';
?>
<div class="tab_container">
	<div class="tab-group">
		<section id="tab1" title="添加讲座信息">
	
		</section>
		


		<section id="tab2" title="修改讲座信息">
		</section>

	</div>
</div>

<script type="text/javascript" src="jsq/jquery-tab.js"></script>
<script type="text/javascript" src="jsq/prefixfree.min.js"></script>
<script type="text/javascript">

		$(function(){
			// Calling the plugin
			$('.tab-group').tabify();
			$("#tab1").load("m_chair_modify.php");
			$("#tab2").load("m_chair_Pagination.php?page=1");
		    
		    });
	    function checkAll(obj) {
	    	var a = document.getElementsByTagName("input");
	    	if(obj.checked){
	    		for(var i = 0;i<a.length;i++){
	    			if(a[i].type == "checkbox") 
		    			{a[i].checked = true;}
	    		}
	    	}
	    	else{
	    		for(var i = 0;i<a.length;i++){
	    			if(a[i].type == "checkbox") a[i].checked = false;
	    		}
	    	}
	    }

	  
</script>

