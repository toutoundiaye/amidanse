// version avec la bibliothèque Velocity.js pour les animations
// voir http://velocityjs.org/
var slider = document.getElementById("slider");
var pictures = ["image1.jpeg", "image3.jpeg","image2.jpeg", "image4.jpeg",
"image5.jpeg", "image7.jpeg","image6.jpeg", "image8.jpeg",
"image9.jpeg", "image11.jpeg","image10.jpeg", "image12.jpeg",
"image13.jpeg", "image15.jpeg","image14.jpeg"];

pictures.forEach(function(filename){
	var img = document.createElement("img");
	img.src = "/bundles/app/img/" + filename;
	slider.appendChild(img);
});


function changePicture(){
	currentPicture = slider.lastElementChild;

	//1er arg : l'élément à animer
	//2e arg : un objet de propriété css
	//3e arg : la durée totale de l'animation
	//4e arg : la fonction de "easing"
	//5e arg : une fonction qui sera appelée à la fin de l'animation
	Velocity(currentPicture, {left: 960}, 1000, "easeOutQuad", function(){
		slider.insertBefore(currentPicture, slider.firstChild);
		currentPicture.style.left = 0;
		window.setTimeout(changePicture, 1000);
	});
}

window.setTimeout(changePicture, 1000);
