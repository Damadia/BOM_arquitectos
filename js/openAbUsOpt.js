$(document).ready(function()
{
	let texts = {"Sobre 'BOM arquitectos'": "Somos un grupo de colaboradores que conforman arquitectos, supervisores, carpinteros, herreros, contratistas y profesionales de la edificación con años de experiencia en el negocio.",
				 "Misión": "Nuestro objetivo es llevar calidad, estética y un ambiente diferente a sus espacios, ofreciéndoles lugares únicos dependiendo de sus necesidades y dándoles siempre la mejor opción conforme a su situación particular. Ofrecemos un diseño con propósito.",
				 "Visión": "Tenemos el pensamiento que todos merecen el acceso a una arquitectura de calidad en su vida.",
				 "Q&A": "Ofrecenos trabajos de interiorismo, construcción, remodelación, visualización de los espacios, levantamientos y elaboración de planos, asimismo como carpintería y diseño de muebles." +
				         "- El tiempo dependerá de sus espacios, la complejidad y compendio del diseño, así como también el costo de elaboración. Estas dudas quedan aclaradas en la entrevista inicial." + 
				     	 "- Puedes mandarnos un correo electrónico o llamarnos a nuestro teléfono en la parte de 'contacto' de este sitio." + 
				     	 "- Hemos podido trabajar a distancia en el pasado sin que esto repercuta en los diseños, la ejecución puede ser vista personalmente por el cliente si así lo desea."};

	$(".auItem").on("click", function(){
		let boxText = texts[$(this).text()];

		$(".title").text($(this).text())
		$(".normalText").text(boxText);
		$(".layoutAuItem").toggle(500);
		$(".auItem").toggle(500);
		console.log(boxText)
	})

	$(".iconBox").on("click", function(){
		$(".layoutAuItem").toggle(500);
		$(".auItem").toggle(500);

	})




})