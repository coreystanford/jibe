$(document).ready(function () {

    $('.home-project').each(function () {

    	var id = $(this).find('a').attr('rel');

        $(this).on('click', 'a', function (e) {

        	e.preventDefault();

        	modal.open(id);

        });

    });

}());