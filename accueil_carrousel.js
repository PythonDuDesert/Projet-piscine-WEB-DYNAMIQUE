$(document).ready(function() {
    let $img = $('#carrousel img'); // on cible les images contenues dans le carrousel 
    let indexImg = $img.length - 1; // on définit l'index du dernier élément 
    let i = 0; // on initialise un compteur 
    let $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant) 
    $img.css('display', 'none'); // on cache les images 
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante
    let transition_in_progress = 0;

    $('#next').click(function(){ // image suivante 
        if (transition_in_progress==1) {
            return;
        }
        transition_in_progress = 1;
        $img.eq(i).fadeOut(300, function() {
            i++;  // on décrémente le compteur
            i = i%$img.length; // modulo pour la boucle
            $img.eq(i).fadeIn(300, function() {
                transition_in_progress = 0;
            });
        });
    });

    $('#previous').click(function(){ // image précédente 
        if (transition_in_progress==1) {
            return;
        }
        transition_in_progress = 1;
        $img.eq(i).fadeOut(300, function() {
            i--;  // on décrémente le compteur
            i = (i+$img.length)%$img.length; // modulo pour la boucle
            $img.eq(i).fadeIn(300, function() {
                transition_in_progress = 0;
            });
        });
    });

    function slideImg(){
        if (transition_in_progress==1) {
            setTimeout(slideImg, 300); // attend qu’on puisse faire la transition
            return;
        }
        transition_in_progress = 1;
        $img.eq(i).fadeOut(300, function() {
            i = i%$img.length; // modulo pour la boucle
            $img.eq(i).fadeIn(300, function() {
                transition_in_progress = 0;
                setTimeout(slideImg, 4000);
            });
        });
    }

    slideImg(); // enfin, on lance la fonction une première fois
})
