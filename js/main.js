$(document).on("ready", function(){
	console.log("here");
	$.post('mail.php', $( "#YOURFORMIDHERE" ).serialize()).done(function(data){
    alert('emailed successfully');
}).fail(function(){
    alert('error sending email');
});
})