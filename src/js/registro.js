document.getElementById("registro").addEventListener("submit" ,function(e){
    e.preventDefault();
 const password = document.getElementById("cnt").value;
 const con_password = document.getElementById("con_cnt").value;
 
 if (password.trim() === '') {
    alert('Por favor ingresa una contrena.');
    return; 
}

if (con_password.trim() === '') {
    alert('Por favor ingresa la confirmcion de la contrasena.');
    return; 
}
 if(password !== con_password){
    alert('las contrasenas no coinsiden');
    return;
 }



 const usuarios = {};
 const formData = new FormData(document.getElementById("registro"));
 formData.forEach(function(value, key) {
     usuarios[key] = value;
 });
console.log(usuarios);
   try {
    fetch('signub.php',{
        method: "POST",
        body: JSON.stringify(usuarios)
    })
       .then(response => response.json())
       .then(data =>{
    
     if(data.response){
        window.location = "http://localhost/TODOLIST/login.php";       
     }
       })
   } catch (error) {
    
   }
});
