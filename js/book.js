jQuery(document).ready(function( $ ) {

    var scannedIsbn = jQuery("#scanned-isbn");
    var listTable = jQuery("#oxfam-list-table");
    var listTableBody = jQuery("#oxfam-list-table tbody");

    var titleInputField = jQuery("#oxfam-title");
    var subtitleInputField = jQuery("#oxfam-subtitle");
    var authorsInputField = jQuery("#oxfam-authors");
    var descriptionTextArea = jQuery("#oxfam-description");
    var languageInputField = jQuery("#oxfam-language");
    var pageCountInputField = jQuery("#oxfam-pagecount");
    var maturityRatingInputField = jQuery("#oxfam-maturityrating");
    var categoriesInputField = jQuery("#oxfam-categories");
    var publishedDateInputField = jQuery("#oxfam-publisheddate");
    var priceInputField = jQuery("#oxfam-price");

    jQuery("#oxfam-confirm").on( 'click', function() {
        var data =
        jQuery.post( 'http://localhost:8000/wp-admin/admin-ajax.php?action=addtostock', data, function() {

        } );
    });


    listTable.on('click', 'tr.oxfam-row', function() {
        var selectedRow = jQuery(this).attr('id').substr(11);

        titleInputField.val( jQuery('#oxfam-r' + selectedRow + '-title').text() );
        subtitleInputField.val( jQuery('#oxfam-r' + selectedRow + '-subtitle').text() );
        authorsInputField.val( jQuery('#oxfam-r' + selectedRow + '-authors').text() );
        descriptionTextArea.val( jQuery('#oxfam-r' + selectedRow + '-description').text() );
        languageInputField.val( jQuery('#oxfam-r' + selectedRow + '-language').text() );
        pageCountInputField.val( jQuery('#oxfam-r' + selectedRow + '-pageCount').text() );
        maturityRatingInputField.val( jQuery('#oxfam-r' + selectedRow + '-maturityRating').text() );
        categoriesInputField.val( jQuery('#oxfam-r' + selectedRow + '-categories').text() );
        publishedDateInputField.val( jQuery('#oxfam-r' + selectedRow + '-publishedDate').text() );
        priceInputField.val( jQuery('#oxfam-r' + selectedRow + '-price').text() );
    });

    scannedIsbn.change(function(){
        var results = jQuery.get(
            'http://localhost:8000/wp-admin/admin-ajax.php?action=searchbookbyisbn&isbn=' + scannedIsbn.val(),
            function(result){
                listTableBody.empty();

                var counter = 0;
                result.data.forEach( function(element) {
                    var title = element['title'] ? element['title'] : '';
                    var subtitle = element['subtitle'] ? element['subtitle'] : '';
                    var authors = element['authors'] ? element['authors'].toString() : '';
                    var description = element['description'] ? element['description'] : '';
                    var language = element['language'] ? element['language'] : '';
                    var pageCount = element['pageCount'] ? element['pageCount'] : '';
                    var maturityRating = element['maturityRating'] ? element['maturityRating'] : '';
                    var categories = element['categories'] ? element['categories'].toString() : '';
                    var publishedDate = element['publishedDate'] ? element['publishedDate'] : '';
                    var price = element['price'] ? element['price'] : '';


                    var newRow = '<tr id="oxfam-list-' + counter + '" class="oxfam-row" >';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-title">' + title + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-subtitle">' + subtitle + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-authors">' + authors + '</td>';
                    newRow = newRow + '<td class="oxfam-col"><div class="oxfam-col-truncated" id="oxfam-r' + counter + '-description">' + description + '</div></td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-language">' + language + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-pageCount">' + pageCount + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-maturityRating">' + maturityRating + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-categories">' + categories + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r' + counter + '-publishedDate">' + publishedDate + '</td>';
                    newRow = newRow + '<td class="oxfam-col" id="oxfam-r\' + counter + \'-price">' + price + '</td>';
                    newRow = newRow + '</tr>';

                    listTable.append( newRow );
                    counter++;
                } );
            }
        );

    });
});


