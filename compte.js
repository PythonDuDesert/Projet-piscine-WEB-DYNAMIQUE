$(document).ready(function() {
    $('#container_compte').show();
    $('#container_connexion').hide();
    $('#container_inscription').hide();

    $('#se_connecter').click(function() { //Bouton 'Se connecter'
        $('#container_compte').hide();
        $('#container_connexion').show();
    })

    $('#sinscrire').click(function() { //Bouton 'S'inscrire'
        $('#container_compte').hide();
        $('#container_inscription').show();
    })

    $('.retour').click(function() { //Bouton 'Retour'
        $('#container_compte').show();
        $('#container_connexion').hide();
        $('#container_inscription').hide();
    })
});