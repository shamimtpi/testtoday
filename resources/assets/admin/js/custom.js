function showDiv(elem){
	
	  
   if(elem.value == "image")
   {
      document.getElementById('mediaurl').style.display = "none";
	  document.getElementById('mediaimg').style.display = "block";
	   document.getElementById('mediamp3').style.display = "none";
   }
   if(elem.value == "video")
   {
      document.getElementById('mediaurl').style.display = "block";
	  document.getElementById('mediaimg').style.display = "none";
	   document.getElementById('mediamp3').style.display = "none";
   }
   if(elem.value == "mp3")
   {
      document.getElementById('mediaurl').style.display = "none";
	  document.getElementById('mediaimg').style.display = "none";
	   document.getElementById('mediamp3').style.display = "block";
   }
   
   
}



