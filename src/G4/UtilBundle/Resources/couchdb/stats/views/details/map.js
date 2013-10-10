/**
 * Obtain the details about the logged data
 *
 * When making changes below, don't forget to execute
 *      ./app/console doctrine:couchdb:update-design-doc stats
 */
function(doc) {
    if (doc.type == 'G4.UtilBundle.CouchDocument.Put') {
        emit(doc._id + '_' + 0, doc.timestamp);
    } else if (doc.type == 'G4.UtilBundle.CouchDocument.Search' ) {
        emit(doc.logId + '_' + 1, doc.responseCode, doc.responseBody);
    } else if (doc.type == 'G4.UtilBundle.CouchDocument.Error') {
        emit(doc.logId + '_' + 2, doc.errorType);
    }
}
