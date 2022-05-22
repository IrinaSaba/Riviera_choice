function deleted(){
    
    //demander à l'admin s'il est sûr de lui ?
      //si oui, alors on stoppe le comportement par défaut du lien
    if (confirm("Are you sure you want to delete ?"))
    {
        event.preventDefault();
       //envoie une requête ajax fetch -->index.php en lui disant qu'on veut supprimer une art/photo/comment et celle qui a l'id 
        fetch(this.dataset.url)
        //.then --> supprimer
        .then(response=>response.text())
        .then(response=>{
            this.parentNode.parentNode.remove();
        });
        
    }
}

document.addEventListener("DOMContentLoaded",function(){
    
     let buttons = document.querySelectorAll('.js-confirm-button');
     //boucle
     for (let i=0; i<buttons.length; i++){
         buttons[i].addEventListener('click',deleted);
     }
})
