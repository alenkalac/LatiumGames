<script>
alert("Payment Cancelled"); 
 // add relevant message above or remove the line if not required
window.onload = function(){
	 if(window.opener){
		 window.close();
	} 
	 else{
		 if(top.dg.isOpen() == true){
              top.dg.closeFlow();
              return true;
          }
     }                              
};                             
</script>