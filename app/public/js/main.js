const documentos = document.getElementById('documentos');

if(documentos){
    documentos.addEventListener('click',e=>{
        if(e.target.className === 'btn btn-danger delete-documento'){
            if(confirm('Are you sure?')){
                const id=e.target.getAttribute('data-id');
                fetch(`/documents/delete/${id}`,{
                    method: 'DELETE'
                }).then(res=>window.location.reload());
            }
        }
    })
}