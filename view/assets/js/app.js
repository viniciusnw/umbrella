function Main(){};

/*
 * 
 * @param {string} url
 * @param {string} method
 * @param {Json} parans
 * @returns {Function ajax}
 * 
 * * Ajax herdado por todos os objetos jS
 */
Main.prototype.ajax = function( url, method, parans ){

    return $.ajax({
            type: method,
            url: url,
            data: parans,
            success: function (data, textStatus, jqXHR) {
                console.log( 'Done: ' + textStatus );
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log( 'Done: ' + textStatus );
            }
        });
};

/*
 * 
 * @param {Function} func
 * @returns {null}
 * 
 * * Carrega por padrão algumas funções que seram usadas por mais de 1 view
 * Caso a view tenha uma função especifica, deve ser passada pelo parametro "func()"
 */
Main.prototype.functionLoader = function( func ){
    
    /*
     * Executa funções que cada view precisa
     */
    if( func instanceof Function ){
        
        func();
    };
};


/*
 * Sempre que um ajax for solicitado
 */
$(document).ajaxSend(function(event, request, settings) {
    
    $('.loading-container').fadeIn();
});

$(document).ajaxComplete(function(event, request, settings) {
    
    $('.loading-container').fadeOut();
});