/*=====================*****Slide show starts*****====================*/

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
/*function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("myslides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  //setTimeout(, 2000); // Change image every 2 seconds
}*/





/*let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("myslides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}*/

/*=====================*****Slide show ends*****====================*/




/*=====================*****Tippy starts*****====================*/

import tippy, {animateFill} from 'tippy.js';
import 'tippy.js/dist/backdrop.css';
import 'tippy.js/animations/shift-away.css';
import tippy, {roundArrow} from 'tippy.js';
import 'tippy.js/dist/svg-arrow.css';
import tippy, {followCursor} from 'tippy.js';
import tippy, {inlinePositioning} from 'tippy.js';


tippy(document.getElementById('word'), {
	content: 'This is the Word of God.',
});

/*=====================*****Tippy ends*****====================*/
function openIm(){
	document.getElementById("messenger").style.display = "block";
	document.getElementById("open-messenger").style.display = "none";
}



function closeIm(){
	document.getElementById("messenger").style.display = "none";
	document.getElementById("open-messenger").style.display = "block";
}



$("#email").on("blur", function(e){
	let email = $("#email").val();
	//alert(email);

	$.ajax({
		url: "process/get_visitor_id.php",
		data: {email: email},
		method: "POST",
		success: function(result){
			//alert(result);
			$("#visitor_id").html(`
				<input type='hidden' name='visitor_id' value='${result}' id='visit_id' disabled>`);
		},
		error(){}
	})
});



function sendMessage(){
	//get the values...
	let message = $('#message').val();
	let visitor_id = $('#visit_id').val();
	//alert(visitor_id + message);

	//use ajax to send the message...
	if (visitor_id.length > 0) {
		$.ajax({
			url: "process/message_process.php",
			method: "POST",
			data: {message: message, visitor_id: visitor_id},
			success: function(result){
				//alert(result);
				alert("Message sent");
				if (result == true) {
					//alert(result);
					retrieveMessages();
					alert("Message sent");
				}
				//$("#response").html("<small style='color: green;'><span class='fa fa-check'></span>Sent</small>");
			},
			beforeSend(){
				$("#response").html("<small style='color: blue;'>Sending...</small>");
			},
			error(){
				$("#response").html("<small style='color: red;'>There was an error</small>");
			}
		})
	}
	
}




/*$("submit_password").on("click", function(e){
	let password = $("#password").val();
	password = trim(password);

	if (password.length == 0) {
		//there was no inputs...
		alert("Please enter your password");
	}else{
		//there was an input...
		$.ajax({
			url: "process/check_password.php",
			method: "POST",
			data: {password: password},
			success: function(result){
				if (result == true) {
					$("#form").html("");
					$("#r_button").html("<span >Password is correct. <button class='btn btn-md btn-success' onclick='retrieveMessages()'>Retrieve Messages</button></span>")
				}
			},
			beforeSend(){
				$("#response").html("<small style='color: blue;'>Submitting...</small>");
			},
			error(){

			}
		})
	}
})*/



function retrieveMessages(){
	$("#form").html("");
	$("#r_button").html("");
	$.ajax({
		url: "process/retrieve_message.php",
		method: "GET",
		success: function(result){
			//alert(result);
			if (result == false) {
				//there sre no messages...
				alert("You have no messages.")
			}else{
				result = JSON.parse(result);
				//alert(result);

				let container = `<div class='card'>`;

				for(let i = 0; i < result.length; i++){
					let array = result[i].split("/");

					let id = array[0];
					let message = array[1];
					let date = array[2];
					let name = array[3];
					let email = array[4];
					let tel = array[5];
					let m_id = array[6];
					//alert(m_id);

					container += `<div class='card-body'>
									<small style='color: green'><strong>${name}</strong></small> | 
									<small><em>${date}</em></small> | 
									<small><em>${email}</em></small> | 
									<small><em>${tel}</em></small> | 
									<small><button name='delete' onclick='deleteMessage(${m_id})' class='btn btn-sm btn-danger'><span class='fa fa-trash-alt' style='color: white'></span></button></small><br><hr style='width: 300px; margin-left: -0px;'>
									<form method='POST'><input name='m_id' type='hidden' value='${m_id}'></form>
									${message}
									</div><hr>`;
				}
				container += `</div>`;

				

				$(".messages").html(container);
			}
			
		},
		beforeSend(){
			$(".im").html("<span style='color: green;'>Retrieving...</span>");
		},
		error(){

		}
	});
}



function deleteMessage(id){
	let confirm_delete = confirm("Are you sure?");

	//alert(id);
	if (confirm_delete) {
		$.ajax({
			url: "process/delete_message.php",
			method: "POST",
			data: {id: id},
			success: function(result){
				alert(result.status);
				if (result == true) {
					alert("Message deleted");
				}else{
					alert("There was an error");
				}
			},
			error(){
				
			}
		});
	}
}



