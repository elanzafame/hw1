function jsonCheckUsername(json){
    if(form.username = !json.exists){
        document.querySelector('.username').classList.remove('errorj');
         } else {
        document.querySelector('.username span').textContent = "Nome utente non disponibile";
        document.querySelector('.username').classList.add('errorj');
    }
    checkForm();
}
function jsonCheckEmail(json){
    if(form.email = !json.exists){
        document.querySelector('.email').classList.remove('errorj');
         } else {
        document.querySelector('.email span').textContent = "E-mail già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
    checkForm();
}
function fetchResponse(response){
    return response.json();
}
function checkName(event){
    const name=event.currentTarget;
    if(!/^[a-zA-Z]+$/.test(name.value)){
        name.parentNode.parentNode.classList.add('errorj');
    }else{
        name.parentNode.parentNode.classList.remove('errorj');
    }
    checkForm();
}

function checkSurname(event){
    const surname=event.currentTarget;
    if(!/^[a-zA-Z]+$/.test(surname.value)){
        surname.parentNode.parentNode.classList.add('errorj');
    }else{
        surname.parentNode.parentNode.classList.remove('errorj');
    }
     checkForm();
}
function checkUsername(event){
    const username= document.querySelector('.username input');
    if(!/^[a-zA-Z0-9_]+$/.test(username.value)){
        username.parentNode.parentNode.querySelector('span').textContent= "Errore durante l'inserimento dell'username";
        username.parentNode.parentNode.classList.add('errorj');
        form.username=false;
    }else{
        fetch("check_username.php?q="+encodeURIComponent(username.value)).then(fetchResponse).then(jsonCheckUsername);
    }
   
}
function checkEmail(event){
     const email = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(email.value).toLowerCase())) {
        document.querySelector('.email').classList.add('errorj');
        form.email = false;
        checkForm();
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(email.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }

}
function checkPassword(event){
    const input_password= document.querySelector('.password input');
    if(!/^[a-zA-Z0-9_]{8,50}$/.test(input_password.value)){
        document.querySelector('.password').classList.add('errorj');
    }else{
        document.querySelector('.password').classList.remove('errorj');
    }
}
function checkConfirmPassword(event){
    const cPassword = document.querySelector('.confirm_password input');
    if( form.confirm_password=cPassword.value!==document.querySelector('.password input').value){
        document.querySelector('.confirm_password').classList.add('errorj');
    }else{
        document.querySelector('.confirm_password').classList.remove('errorj');
    }
}
function checkForm(event){
    Object.keys(form).length !== 7 || 
    Object.values(form).includes(false);
}

const form= {'upload':true};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);


if (document.querySelector('.error') !== null) {
    checkUsername(); checkPassword(); checkConfirmPassword(); checkEmail();
    document.querySelector('.name input').dispatchEvent(new Event('blur'));
    document.querySelector('.surname input').dispatchEvent(new Event('blur'));
}