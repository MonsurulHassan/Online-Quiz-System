$(document).ready(function(){
  //REGISTRATION	
  $("#regsubmit").click(function(){
	 var name 	  = $("#name").val(); 
	 var username = $("#username").val(); 
	 var password = $("#password").val(); 
	 var email 	  = $("#email").val(); 
	 //var dataString = 'name='+name+'&username='+username+'&password='+password+'&email='+email;
	 $.ajax({
		url:"getregister.php",
		type:"post",
		data:{name:name, username:username, password:password, email:email},
		success:function(data){
			$("#state").html(data);
		}	
	 });
	 return false;
  });
  
  
  //LOGIN
  $("#login").click(function(){ 
	 var email 	  = $("#email").val(); 
	 var password = $("#password").val(); 
	 var dataString = 'email='+email+'&password='+password;
	 $.ajax({
		url:"getlogin.php",
		type:"post",
		data:dataString,
		success:function(data){
			if(data == "empty"){
				$(".empty").show();
				setTimeout(function(){
					$(".empty").fadeOut();
				}, 3000);
				$(".disabled").hide();
				$(".unmatched").hide();
			}
			else if(data == "disabled"){
				$(".disabled").show();
				setTimeout(function(){
					$(".disabled").fadeOut();
				}, 3000);
				$(".empty").hide();
				$(".unmatched").hide();
			}
			else if(data == "unmatched"){
				$(".unmatched").show();
				setTimeout(function(){
					$(".unmatched").fadeOut();
				}, 3000);
				$(".disabled").hide();
				$(".empty").hide();
			}
			else{
				window.location = "exam.php";
			}
		}	
	 });
	 return false;
  });
});