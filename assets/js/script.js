window.addEventListener("load", function(){
    let tabs = document.querySelectorAll('ul.nav-tabs > li');

    for(i=0; i < tabs.length; i++){
        tabs[i].addEventListener("click", switchTab);
    }

    function switchTab(event){
        event.preventDefault();

        document.querySelector("ul.nav-tabs li.active").classList.remove("active");
        document.querySelector(".tab-pane.active").classList.remove("active");

        let clickedTab = event.currentTarget;
        let anchor = event.target;
        let activePaneID = anchor.getAttribute("href");

        clickedTab.classList.add("active");
        document.querySelector(activePaneID).classList.add("active");
    }


});

jQuery(document).ready( function($) {
    let myprefix_media_manager = [
        'input#myprefix_media_manager',
        'input#myprefix_media_manager_2',
        'input#myprefix_media_manager_3',
        'input#myprefix_media_manager_4'
    ];

    let myprefix_image_id = [
        'input#myprefix_image_id',
        'input#myprefix_image_id_2',
        'input#myprefix_image_id_3',
        'input#myprefix_image_id_4'
    ];

    for ( let i = 0; i < myprefix_media_manager.length; i++ ) {
        jQuery(myprefix_media_manager[i]).click(function(e) {
    
                e.preventDefault();
                var image_frame;
                if(image_frame){
                    image_frame.open();
                }
                // Define image_frame as wp.media object
                image_frame = wp.media.frames.file_frame = wp.media({
                            title: 'Sélectioner une image',
                            multiple : false,
                            library : {
                                type : 'image',
                            },
                            button: {
                                text: 'Enregistrer'//marche pas bordel
                            }
                        });
    
                image_frame.on('select',function() {
                    // On close, get selections and save to the hidden input
                    // plus other AJAX stuff to refresh the image preview
                    var selection =  image_frame.state().get('selection');
                    var gallery_ids = new Array();
                    var my_index = 0;
                    selection.each(function(attachment) {
                        gallery_ids[my_index] = attachment['id'];
                        my_index++;
                    });
                    var ids = gallery_ids.join(",");
                    jQuery(myprefix_image_id[i]).val(ids);
                    Refresh_Image(ids);
                });
    
                image_frame.on('open',function() {
                // On open, get the id from the hidden input
                // and select the appropiate images in the media manager
                var selection =  image_frame.state().get('selection');
                var ids = jQuery(myprefix_image_id[i]).val().split(',');
                ids.forEach(function(id) {
                    var attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add( attachment ? [ attachment ] : [] );
                });
    
                });
    
            image_frame.open();
        });
        
    }
    function Refresh_Image(the_id){
        var data = {
            action: 'myprefix_get_image',
            id: the_id
        };
    
        jQuery.get(ajaxurl, data, function(response) {
    
            if(response.success === true) {
                jQuery('#myprefix-preview-image').replaceWith( response.data.image );
            }
        });
    }


});


