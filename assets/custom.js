(function ($) {

    $('#ilg-vendor-form').on('submit', function (evt) {


        evt.preventDefault();

        var ilg_vendor_data = $('#ilg-vendor-form').serialize();

        $.post(ilg.ajax_url, ilg_vendor_data,
            function (data) {

                $('#ilg-vendor-form')[0].reset();

                $('#ilg-vendor-success-message').html('<h3 class=" alert alert-success" >The Vendor entry is added successfully into the system.</h3>');

            }
        );

    });

    $('#ilg_product_form_submit').on('click', function () {
        if ($('#ilg_image_upload').val() == '') {
            $('#ilg_image_upload_button').html('Please upload an Image');
            $('#ilg_image_upload_button').addClass('btn-danger');
        }
    })


    $('#ilg-product-form').on('submit', function (evt) {
        evt.preventDefault();
        var materials = $('#materials').val();

        var ilg_product_data = new FormData();

        ilg_product_data.append('image_file', $('#ilg_image_upload').prop('files')[0]);

        ilg_product_data.append('product_name', $('[name=product_name]').val());

        ilg_product_data.append('product_type', $('[name=product_type]').val());

        ilg_product_data.append('materials', materials);

        ilg_product_data.append('built_type', $('[name=built_type]').val());

        ilg_product_data.append('sold_by', $('[name=sold_by]').val());

        ilg_product_data.append('vendor', $('[name=vendor]').val());

        ilg_product_data.append('brand_name', $('[name=brand_name]').val());

        ilg_product_data.append('tags', $('[name=tags]').val());

        ilg_product_data.append('action', 'send_ilg_product_form');

        ilg_product_data.append('price_range', $('#product_range').val());

        ilg_product_data.append('_wpnonce', $('#_wpnonce_product').val());

        ilg_product_data.append('_wp_http_referer', $('[name=_wp_http_referer]').val());

        $.ajax({
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: ilg_product_data,
            enctype: 'multipart/form-data',
            url: ilg.ajax_url,
            success: function (response) {
                if(response['status'] == 1)
                {

                    $('#ilg-product-form')[0].reset();

                    $('#ilg-product-success-message').html('<h3 class=" alert alert-success" >The Product entry is added successfully into the system.</h3>');
             
                }
                else
                {
  $('#ilg-product-success-message').html('<h3 class=" alert alert-danger" >There has been an error in the system.</h3>');
                }
            }
        });

    })

    $('.selectpicker').selectpicker();

    $('#ilg_image_upload_button').on('click', function (evt) {
        evt.preventDefault();

        $('#ilg_image_upload').trigger('click');

    })

    $('#ilg_image_upload').on('change', function () {
        $('#ilg_image_upload_button').html('Image Uploaded');
        $('#ilg_image_upload_button').removeClass('btn-danger');
    })

    $('#vendor-product-search-form').on('submit', function (evt) {
        evt.preventDefault();

        initiate_search(false);

    })

    function initiate_search( by_vendor){

        var data = {
            vendor_product_search_query: $('#vendor-product-search').val(),
            search_type: $('#search-type').val(),
            action: 'vendor_product_search',
            by_vendor: by_vendor,
            _wpnonce: $('#_wpnonce_search').val(),
            _wp_http_referer: $('[name=_wp_http_referer]').val()
        }

        $.get(ilg.ajax_url, data,
            function (response) {
                if( '0' === response['status'])
                {

                    $('#search-results').html('<h3 class=" alert alert-danger" >There has been an error, please contact the site administrator.</h3>')
                }
                else
                {

                    $('#search-results').html(response);


                    $('.vendor_name_search').on('click', function () { 
                        $('#vendor-product-search').val($(this).data('name'));
                
                        $('#search-type option[value="Product"]').prop('selected', true);
                        initiate_search(true);
                
                     })
                

                }
            }
        );
    }

    $('#view_all').on('click', function () { 
        
        var data = {
            action: 'show_all_search',
            search_type: $('#search-type').val(),
            _wpnonce: $('#_wpnonce_search').val(),
            _wp_http_referer: $('[name=_wp_http_referer]').val()
          }

        $.get(ilg.ajax_url, data,
            function (response) {
                if( '0' === response['status'])
                {

                    $('#search-results').html('<h3 class=" alert alert-danger" >There has been an error, please contact the site administrator.</h3>')
                }
                else
                {

                    $('#search-results').html(response);

                    $('.vendor_name_search').on('click', function () { 
                        $('#vendor-product-search').val($(this).data('name'));
                
                        $('#search-type option[value="Product"]').prop('selected', true);
                        initiate_search(true);
                
                     })
                
                }
            }
        );
     })

     $('#manual-entry-button').on('click', function () { 
        
        var data = {
            action: 'manual_entry_material',
            manual_entry : $('#manual-entry').val()
          }
          
          $.post(ilg.ajax_url, data,
              function (data) {
                  if(data !== '0' || data !== 0)
                  {
                      $('#material_used_div').html(data);
                      $('#manual-entry').val('');
    $('.selectpicker').selectpicker();

                  }
              }
          );



      })

})(jQuery);