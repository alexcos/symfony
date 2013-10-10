function(doc) {
    if (doc.type == 'G4.UtilBundle.CouchDocument.Persister') {
        emit(doc.hash, doc.contents);
    }
}
