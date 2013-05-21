if (typeof(SlideshowPikachoose) === 'undefined') {
    var SlideshowPikachoose = {};
}

/**
 * 
 * @param id
 * @param container
 * @param msg
 */
SlideshowPikachoose.addNewFile = function( container, msg ) {
    var url = 'index.php?option=com_mediamanager&task=doTaskAjax&format=raw&view=media&element=slideshow_pikachoose&elementTask=addNewFile';
    Dsc.doTask( url, container, document.adminForm, msg, true, SlideshowPikachoose.clearAddFileFields );
}

SlideshowPikachoose.clearAddFileFields = function() {
	document.adminForm.item_local_new.value = '';
	document.adminForm.getElementById('item_local_new_preview_img').style.display = 'none';
    document.adminForm.item_remote_new.value = '';
    document.adminForm.item_existing_new.value = '';
    document.adminForm.item_existing_new_name_hidden.value = '';
    document.adminForm.add_type.value = '';
}

SlideshowPikachoose.deleteFile = function( id, container, msg ) {
    var url = 'index.php?option=com_mediamanager&task=doTaskAjax&format=raw&view=media&element=slideshow_pikachoose&elementTask=deletefile&delete_id=' + id;
    Dsc.doTask( url, container, document.adminForm, msg, true );
} 