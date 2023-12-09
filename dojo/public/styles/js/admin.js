var base = location.protocol+'//'+location.host;

document.addEventListener('DOMContentLoaded', function(){
    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search');
    if(btn_search){
        btn_search.addEventListener('click', function(e){
            e.preventDefault();
            if(form_search.style.display === 'block'){
                form_search.style.display = 'none'
            }
            else{
                form_search.style.display = 'block'
            }
        })
    }

    btn_destroy = document.getElementsByClassName('btn-destroy')
    for(i=0; i < btn_destroy.length; i++){
        btn_destroy[i].addEventListener('click', destroy_object)
    }
});

function destroy_object(e){
    e.preventDefault()
    var object = this.getAttribute('data-object')
    var action = this.getAttribute('data-action')
    var path = this.getAttribute('data-path')
    var url = base + '/' + path + '/' + object + '/' + action
    var title, text, icon
    if(action == "destroy"){
        title = "¿Estas seguro de realizar esta acción?"
        text = "Este elemento será borrado de la lista "
        icon = "warning"
    }
    if(action == "restore"){
        title = "¿Estas seguro de realizar esta acción?"
        text = "Este elemento será restaurado"
        icon = "warning"
    }
    swal({
        title: title,
        text: text,
        icon: icon,
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href = url
        }
      });
}
