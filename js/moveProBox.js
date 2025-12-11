$(document).ready(function()
{
	let currentPos = 0;
	let boxProLen = document.getElementsByClassName("projectsCardBox")[0].offsetWidth * 0.12;

	$(".buttonProject").on("click", function()
	{
		let lenM = document.getElementsByClassName("textCard")[0].offsetWidth;
		let classList = $(this).attr('class').split(/\s+/);
		console.log(classList[1]);
		if (classList[1] == "left")
			currentPos += -lenM - boxProLen;
		else
			currentPos += lenM + boxProLen;

		if (currentPos < 0)
			currentPos = 0;

		console.log(lenM);
		console.log(document.getElementsByClassName("projectsCardBox")[0].scrollLeft);

		$(".projectsCardBox").animate({ scrollLeft: currentPos});
		

	})

	$(".projectsCardBox").on("scroll", function()
	{
		currentPos = document.getElementsByClassName("projectsCardBox")[0].scrollLeft;	
	})

})