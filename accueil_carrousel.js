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
        setTimeout(function(){ // on utilise une fonction anonyme 
            i++;
            i = i%$img.length; // modulo pour la boucle
            $img.fadeOut(1000);
            $currentImg = $img.eq(i); 
            $currentImg.fadeIn(1000); 
            slideImg(); // on oublie pas de relancer la fonction à la fin 
        }, 4000); // on définit l'intervalle à 4000 millisecondes (4s) 
    } 

    //slideImg(); // enfin, on lance la fonction une première fois
})