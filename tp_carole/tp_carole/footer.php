
<div class="row row-padding footer">
	<div class="footer-top"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
		</div>
		<div class="row copyright">
			<div class="col-sm-12">
				<span>&copy; 2022 travail pratique | Tous droits réservés</span>
				<p>Presenté par <a href="#">Student Name</a></p>
			</div>
		</div>
	</div>
</div>

</div>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript">

// 
function clearInputs(){
	$("#chat-text").val("");
}


// 
function fetchChat(){

	var fetch_chat = "";
	$.ajax({
		type:"POST",
		url: "db/functions.php",
		data:{fetch_chat:fetch_chat},
		success: function(output){
			$("#display-chat").html("");
			$("#display-chat").html(output);
		}
	})
}


// ENVOYER LE MESSAGE DU CHAT
function sendChat(){

	var submit_chat = "";
	var sender_id = $("#sender-id").val();
	var sender_message = $("#chat-text").val();
	$.ajax({
		type:"POST",
		url: "db/functions.php",
		data:{submit_chat:submit_chat,sender_id:sender_id,sender_message:sender_message},
		success: function(output){
			fetchChat();
			clearInputs();
		}
	})

}


$(document).ready(function(){

    // INITIALIZATION
    $(".owlcarou").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
    });

    fetchChat();

    $("#submit-chat").on("click", function(){
    	sendChat();
    });

});

</script>
</body>
</html>