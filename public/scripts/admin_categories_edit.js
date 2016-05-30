$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    var PremiumIP = {
        campaign : {
            slides : []
        },
        slideToDelete : null,
        onlyUnique : function(value, index, self){
            return self.indexOf(value) === index;
        }
    };

    var myDropzoneCover = new Dropzone("#coverImageDropzone", {
        url: document.location.origin + '/admin/categoriestips/uploadImage',
        paramName: "coverImageDropzone", // The name that will be used to transfer the file
        maxFiles: 1,
        method: "POST",
        uploadMultiple : false,
        autoProcessQueue: true,
        previewsContainer: "#coverImagePDP",
        //--------
        sending: function(file, xhr, formData) {
            // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
            formData.append("_token", $('[name=_token]').val()); // Laravel expect the token post value to be named _token by default
            formData.append("id", $('#id').val());
            formData.append("icon_path", $('#icon_path').val());
        },
        success: function(file, response) {
            myDropzoneCover.removeFile(file);
            // Adjust Thumbnail based on uploaded File

            var cover = $.parseJSON(response);
            if (cover.success == true){
                $("#coverImagePDP").html('');

                $("#coverImagePDP").css({
                    'background-image' : 'url("' + cover.image + '")',
                    'background-size' : 'cover'
                });
                $("#icon_path").val(cover.image).attr('disable',true);
            }
        },

    });
   

    // Delete Report - Videos or Images, based on ID.
    $("#webEmbedContainer, #printerEmbedContainer").on('click', '.deletePDF', function(){
        var $report_id = $(this).attr('data-report-id');
        var $report_type = $(this).attr('data-report-type');

        PremiumIP.report_type = $report_type;
        $.ajax({
            method: "POST",
            url: document.location.origin + '/admin/campaigns/deleteReport',
            data: {
                report_id: $report_id,
                report_type : $report_type,
                campaign_id: $('#campaign_id').val(), // Not Required
                _token : $('[name=_token]').val()
            }
        }).done(function( response ) {
            if (PremiumIP.report_type == 'web'){
                $('#webEmbedContainer').html('');
            }else{
                $('#printerEmbedContainer').html('');
            }

        });
    });


    // ----------------------------
    // UI Events
    //-----------------------------

    // Delete Media - Videos or Images, based on ID.
    $("#sliderPreview, #videosPreview, #slideSharePreview ,#mobileSliderPreview").on('click', '.deleteSlide', function(){
        var $media_id = $(this).attr('data-campaign-media-id');
        PremiumIP.slideToDelete = $(this).parent();
        $.ajax({
            method: "POST",
            url: document.location.origin + '/admin/campaigns/deleteSlide',
            data: {
                media_id: $media_id,
                campaign_id: $('#campaign_id').val(), // Not Required
                _token : $('[name=_token]').val()
            }
        }).done(function( response ) {
            PremiumIP.slideToDelete.remove();
        });
    });

    // Add Video from VideoID (VIMEO)

    $("#videoForm").on('click', '.addVideo', function(){
        var vimeo_id = $('#vimeo_id').val();
        if (vimeo_id.length > 0 ){
            $.ajax({
                method: "POST",
                url: document.location.origin + '/admin/campaigns/addVideo',
                data: {
                    vimeo_id: vimeo_id,
                    campaign_id: $('#campaign_id').val(), // Not Required
                    _token : $('[name=_token]').val()
                }
            }).done(function( response ) {
                var video = $.parseJSON(response);
                $('#videosPreview').append(video.thumbnail);
            });
        }else{
            alert('Please enter a Vimeo ID');
        }

    });

    // Add SlideShare

    $("#slideShareForm").on('click', '.addSlideShare', function(){
        var slideshare_id = $('#slideshare_id').val();
        if (slideshare_id.length > 0 ){
            $.ajax({
                method: "POST",
                url: document.location.origin + '/admin/campaigns/addSlideShare',
                data: {
                    slideshare_id: slideshare_id,
                    campaign_id: $('#campaign_id').val(), // Not Required
                    _token : $('[name=_token]').val()
                }
            }).done(function( response ) {
                var slide_share = $.parseJSON(response);
                $('#slideSharePreview').append(slide_share.thumbnail);
            });
        }else{
            alert('Please enter a SlideShare ID');
        }

    });

    // -------- WYSIWYG
    CKEDITOR.config.toolbar = [
                                ['Styles','Format','Font','FontSize'],
                                '/',
                                ['Bold','Italic','Underline','Link','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace']
                              ] ;
    CKEDITOR.replace('description');
});
