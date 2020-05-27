
$(function () {

	'use strict';

// Masquer le PlaceHolder quand la zone reçoie le focus

		$('[placeholder]').focus(function () {
			$(this).attr('data-text', $(this).attr('placeholder'));

			$(this).attr('placeholder', '');

		}).blur(function () {

			$(this).attr('placeholder', $(this).attr('data-text'));

		});

// Afficher l'étoile rouge dans les champs obligatoires

		$('input').each(function () {
			if ($(this).attr('required') === 'required') {
				$(this).after('<span class="etoile">*</span>');
			}
		});
	
//Afficher le mot de passe au passage de la souris sur l'icone de la zone oldpwd
		
	 var oldpwdField=$('.oldpwd');
	    $('.show-oldpwd').hover(
	        function () { oldpwdField.attr('type', 'text'); },
	        function () { oldpwdField.attr('type', 'password'); }
	    );
	  
//Afficher le mot de passe au passage de la souris sur l'icone  de la zone newpwd
		
	 var newpwdField=$('.newpwd');
	    $('.show-newpwd').hover(
	        function () { newpwdField.attr('type', 'text'); },
	        function () { newpwdField.attr('type', 'password'); }
	    );

// Afficher la boite du dialogue confirm
		$('.confirm').click(function () {
			return confirm("Etes Vous sûr?")
		});
});