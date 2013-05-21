if (typeof(AudioJwplayer) === 'undefined') {
    var AudioJwplayer = {};
}

/**
 * 
 * @param id
 * @param container
 * @param msg
 */
AudioJwplayer.addNewFile = function( container, msg ) {
    var url = 'index.php?option=com_mediamanager&task=doTaskAjax&format=raw&view=media&element=audio_jwplayer&elementTask=addNewFile';
    Dsc.doTask( url, container, document.adminForm, msg, true, AudioJwplayer.clearAddFileFields );
}

AudioJwplayer.clearAddFileFields = function() {
    document.adminForm.item_remote_new.value = '';
    document.adminForm.item_existing_new.value = '';
    document.adminForm.item_existing_new_name_hidden.value = '';
    document.adminForm.add_type.value = '';
}

AudioJwplayer.deleteFile = function( id, container, msg ) {
    var url = 'index.php?option=com_mediamanager&task=doTaskAjax&format=raw&view=media&element=audio_jwplayer&elementTask=deletefile&delete_id=' + id;
    Dsc.doTask( url, container, document.adminForm, msg, true );
} 