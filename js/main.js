$(document).ready(main);
function main()
{
	$('.submenu1').click(function()
	{
		$(this).children('.children').slideToggle();
		$('.arrow1').rotate(
		{
		    angle:180
		});
	});
	$('.submenu2').click(function()
	{
		$(this).children('.children').slideToggle();
	});
}