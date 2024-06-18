document.getElementById("login").addEventListener("submit" ,function(p){
    p.preventDefault();
const formData = new FormData(document.getElementById("login"));
    const usuario = {};
    formData.forEach(function(value, key) {
        usuario[key] = value;
    });
console.log(usuario);

try {
  fetch("login1.php",{
    method: "POST",
    body: JSON.stringify(usuario)
})
.then(response => response.json())
.then(data =>{
    if(data.response){
        window.location = "http://localhost/TODOLIST/index.php";     
     }
}) 
} catch (error) {
    console.log("surgio un proleblema al realizar la location");
}



});