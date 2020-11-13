console.log("scripts.js");


// THIS IS JQUERY - we make sure the document has loaded before we do anything
                	$(document).ready(function() {
                	
                		// CKEDITOR 5
                        ClassicEditor
                                .create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                                
                                
                        // REST OF THE CODE

 });
                                
                   });
                   