<script type="text/javascript">

// Get the ul that holds the collection of tags
var collectionHolder = $('ul.placas');
var col=$('#hnr_sircimbundle_estudioradiologicotype_placas')
// setup an "add a tag" link
var $addTagLink = $('<a href="#" class="add_placa_link">Agregar placa</a>');
var $removeTagLink = $('<a href="#" class="remove_placa_link">Borrar placa</a>');
var $newLinkLi = $('<li></li>').append($addTagLink);
var $delLinkLi = $('#hnr_sircimbundle_estudioradiologicotype_placas.required').append($removeTagLink);



jQuery(document).ready(function() {

    col.children('div').each(function() {
        addTagFormDeleteLink($(this));
    });
    collectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    collectionHolder.data('index', collectionHolder.find(':input').length);



    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm(collectionHolder, $newLinkLi);
    });



$(document).on('click', '.close', function(){
        alert('del');
    $(this).closest('#hnr_sircimbundle_estudioradiologicotype_placas').fadeOut(500, function() {
        $(this).remove();
    });
});

    
});




function addTagForm(collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = collectionHolder.data('prototype');

    // get the new index
    var index = collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#">Borrar placa</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}



</script>