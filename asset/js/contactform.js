jQuery(document).ready(function($) {
//console.log($(".contactus-main"));
$(".contactus-main").submit(function(event) {
event.preventDefault();    
let str = $(this).serialize();

$.ajax({
type: "POST",
url: "https://irinasabaliauskiene.sites.3wa.io/Riviera_choice_pro/contact",
data: str,
success: function(msg) {
if(msg == 'OK') {
result = '<p>Your email have been send, we would contact you soon.</p>';
$(".fields").hide();
} else {
result = msg;
}
$('.note').html(result);
}
});
return false;
});
});