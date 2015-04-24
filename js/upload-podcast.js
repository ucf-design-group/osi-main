// Run all functions within this context when the document is ready.
jQuery(document).ready(function($){
 
    // console.log('my-admin-scripts loaded successfully!');
 
 
    var podcast_upload_frame;
 
 
<<<<<<< HEAD
    jQuery('#upload-podcast-button').click(function(e) {
=======
    jQuery('#upload_podcast_button').click(function(e) {
>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (podcast_upload_frame) {
            podcast_upload_frame.open();
            return;
        }
 
        //Extend the wp.media object
        podcast_upload_frame = wp.media.frames.file_frame = wp.media({
            title: 'Upload Podcast',
            button: {
                text: 'Choose Podcast'
            },
            multiple: false,
            library: {
                type: 'audio' // limits the availiable library to only audio media
            }
        });
 
        // If an audio file is inserted into the media uplaoder (drag & drop), grab it's url
        // and set it as the text field's value
        podcast_upload_frame.on('insert', function(){
            attachment = podcast_upload_frame.state().get('selection').first().toJSON();
<<<<<<< HEAD
            $('#podcast-attachment').val(attachment.url);
=======
            $('#upload_podcast').val(attachment.url);
>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b
        });

        //When a file is selected, grab the URL and set it as the text field's value
        podcast_upload_frame.on('select', function() {
            attachment = podcast_upload_frame.state().get('selection').first().toJSON();
<<<<<<< HEAD
            $('#podcast-attachment').val(attachment.url);
=======
            $('#upload_podcast').val(attachment.url);
>>>>>>> 5e8fa4629aaf03dacf465ce40b827551f32a085b
        });
 
        //Open the uploader dialog
        podcast_upload_frame.open();
 
    });
 
}); // End document ready functionality 
