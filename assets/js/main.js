"use strict";

/* ===== Smooth scrolling ====== */
/*  Note: You need to include smoothscroll.min.js (smooth scroll behavior polyfill) on the page to cover some browsers */
/* Ref: https://github.com/iamdustan/smoothscroll */

const pageNavLinks = document.querySelectorAll('.scrollto');

pageNavLinks.forEach((pageNavLink) => {
	
	pageNavLink.addEventListener('click', (e) => {
		
		e.preventDefault();
		
		var target = pageNavLink.getAttribute("href").replace('#', '');
		
		//console.log(target);
		
        document.getElementById(target).scrollIntoView({ behavior: 'smooth' });

		
    });
	
});

  AOS.init();

  jQuery('#contato').submit(function () {
    event.preventDefault();
    var dados = jQuery(this).serialize();
    $("#btnContato").prop("disabled", true);
  $(".spinner-border").removeClass("d-none"); // Mostrar o spinner
  $(".btn-text").addClass("d-none"); // Ocultar o texto do botão

  jQuery.ajax({
    type: "POST",
    url: "private/functions/email.php",
    data: dados,
    success: function (data) {
      $("#linkResultado").html(data);
      setTimeout(function () {
        $("#btnContato").prop("disabled", false);
        $(".spinner-border").addClass("d-none"); // Ocultar o spinner
        $(".btn-text").removeClass("d-none"); // Mostrar o texto do botão
      }, 2500);
    }
  });
  return false;
});