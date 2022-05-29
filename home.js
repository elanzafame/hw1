function onMovieJson(json){
    console.log(json);
    const movie= document.querySelector('#movies')
    for(let i in json){
        const image= json[i].image
        const title= json[i].title
        const id= json[i].movie_id
        const add=document.createElement('div');
        add.classList.add('movie');
        const img= document.createElement('img');
        img.src=image;
        const movie_title=document.createElement('span');
        movie_title.innerText=title;
        const id_movie=document.createElement('p');
        id_movie.classList.add('hidden');
        id_movie.textContent=id;
        add.appendChild(img);
        add.appendChild(movie_title);
        add.appendChild(id_movie);
        movie.appendChild(add);
        const remove = document.createElement('a');
        remove.textContent='Rimuovi';
        remove.addEventListener('click', removePreferito);
        add.appendChild(remove);
    }
}
function removePreferito(){
    const remove = document.querySelector('#movies').parentNode.querySelector('p');
    const form= new FormData();
    form.append('id', remove.textContent);
    fetch('remove.php', {method: 'post', body: form}).then(onResponse).then(onJsonRemove);
}
function onJsonRemove(json){
    if(json.result==true){
        const result=document.querySelector('#movies');
        result.innerHTML='';
        fetchMovie();
    }
}
function fetchMovie(){
    fetch("fetchMovie.php").then(onResponse).then(onMovieJson);
}
function onResponse(response){
    return response.json();
}

fetchMovie();

