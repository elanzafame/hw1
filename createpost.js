function search(event){
    event.preventDefault();
    const movie = document.querySelector('#searchbox');
    const movie_title=encodeURIComponent(movie.value);
    fetch('searchContent.php?q='+movie_title).then(onResponse).then(onJsonMovie);
    
}
function onResponse(response){
    return response.json();
}

function onJsonMovie(json){
    console.log(json);
    const library = document.querySelector('#results');
    library.innerHTML='';
    const results= json.results;
    for ( let result of results){    
        const image = result.image;
        const description = result.title;
        const id =result.id;
        const movie = document.createElement('div');
        movie.classList.add('movie');
        const img = document.createElement('img');
        img.src = image;
        const title= document.createElement('span');
        title.textContent= description;
        movie.appendChild(img);
        movie.appendChild(title);
        library.appendChild(movie);
        img.addEventListener('click', apriModale);
        const id_movie= document.createElement('p');
        id_movie.classList.add('hidden');
        id_movie.textContent=id;
        movie.appendChild(id_movie);
    }
}
function apriModale(event){
    const images = document.createElement('img');
    images.id='immagine_post';
    images.src=event.currentTarget.src;
    const title= document.createElement('span');
    title.classList.add('hidden');
    title.textContent=document.querySelector('#results').parentNode.querySelector('span').textContent;
    const id= document.createElement('p');
    id.classList.add('hidden');
    id.textContent=document.querySelector('#results').parentNode.querySelector('p').textContent;
    modale.appendChild(images);
    modale.appendChild(title);
    modale.appendChild(id);
    modale.classList.remove('hidden');
    document.body.classList.add('no-scroll');
    document.querySelector("#modale form").addEventListener('submit',add);
}
function add(event){
    event.preventDefault();
    const add = document.querySelector('#modale form');
    const form = new FormData();
    form.append('id',add.parentNode.querySelector('p').innerText);
    form.append('image',add.parentNode.querySelector('img').src);
    form.append('title', add.parentNode.querySelector('span').innerText)
    
    fetch("add.php",{method:'post', body: form}).then(onResponse).then(onAdd);
    chiudiModale();
}
function onAdd(json) {
    console.log(json);
}
function chiudiModale(event){
    
    modale.classList.add('hidden');
    img=modale.querySelector('img');
    img.remove();
    document.body.classList.remove('no-scroll');
    
}
document.querySelector('#newpost form').addEventListener('submit',search);
