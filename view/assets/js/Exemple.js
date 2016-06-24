function Exemple(){
    
    this.functionLoader(function(){
        
        exampleFunction( Exemple.prototype );
    });
}Exemple.prototype = new Main();


exampleFunction = function( prototype ){
    
    console.log( prototype );
};
