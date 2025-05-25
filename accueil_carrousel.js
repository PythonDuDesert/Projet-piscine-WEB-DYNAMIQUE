$(document).ready(function() {
    $img = $('#carrousel img'); // on cible les images contenues dans le carrousel 
    indexImg = $img.length - 1; // on définit l'index du dernier élément 
    i = 0; // on initialise un compteur 
    $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant) 
    $img.css('display', 'none'); // on cache les images 
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante

    $('#next').click(function(){ // image suivante 
        i++; // on incrémente le compteur
        i = i%$img.length; // modulo pour la boucle
        $img.fadeOut(200);
        $currentImg = $img.eq(i);
        $currentImg.fadeIn(200);
    });

    $('#previous').click(function(){ // image précédente 
        i--;  // on décrémente le compteur
        i = i%$img.length; // modulo pour la boucle
        $img.fadeOut(200); 
        $currentImg = $img.eq(i); 
        $currentImg.fadeIn(200); 
    });

    function slideImg(){ 
        $img.eq(i).fadeOut(300, function() {
            i = i%$img.length; // modulo pour la boucle
            $img.eq(i).fadeIn(300, function() {
                setTimeout(slideImg, 4000);
            });
        });
    }

    slideImg(); // enfin, on lance la fonction une première fois
})