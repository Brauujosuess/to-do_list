//funciones requeridas---->>
///1.funcion para agregar la tareas
//funcion para actualizar tareas
///funcion para eliminar las tareas
// funcion para obtener las tareas
//funcion para mostrar las tareas Almacenadas
window.addEventListener("load",obtener_tareas)

function agregar_tarea() {
  const input = document.getElementById("tarea");
  input.innerHTML='';
  const tarea = input.value;
  console.log(tarea);
  if(tarea === ""){
    alert("no se pueden agregar tareas vacias");
  }else{
    fetch('insert.php', {
        method: "POST",
        body: JSON.stringify({ tarea: tarea })
    })
    .then(response => response.json())
    .then(data => {
        if (data.response) {
            console.log('Tarea agregada exitosamente');
              const tarea = obtener_tareas();
              input.value='';
              mostrar_tareas(tarea);
        } else {
            console.log('Error al agregar la tarea: ' + data.msg);
        }
    })
    .catch(error => {
        console.log('Error:' + error);
    });
  }
}
function agregar_local(tarea) {
  let tareas = localStorage.getItem("tareas");
  if (tareas === null) {
    localStorage.setItem("tareas", JSON.stringify([]));
    tareas = localStorage.getItem("tareas");
  }
  tareas = JSON.parse(tareas);
  tareas.push(tarea);
  localStorage.setItem("tareas", JSON.stringify(tareas));
}
 async function actualizar_tarea(id) {
    const input = document.getElementById("tarea");
    const tarea = input.value;
   
}
function actualizar_local(tarea, id) {
  let tareas = JSON.parse(localStorage.getItem("tareas"));
  tareas[id] = tarea;
  localStorage.setItem("tareas", JSON.stringify(tareas));
}
 async function eliminar_tarea() {
    const input = document.getElementById("tarea");
    const tarea = input.value;

 const eliminar = await fetch("elminar.php",{
       method: "POST"
 })
 const datos_elim= await eliminar.json()
 console.log(datos_elim);
}
function eliminar_local(id) {
  let tareas = JSON.parse(localStorage.getItem("tareas"));
  delete tareas[id];
  localStorage.setItem("tareas", tareas);

}
async function obtener_tareas() {
  const datos = await fetch("obtener.php", {
      method: "GET"
  });
  let tareas = null;
  if (datos.ok) {
      tareas = await datos.json();
  } else {
      tareas = JSON.parse(localStorage.getItem("tareas"));
  }
  
}

function mostrar_tareas(tareas) {
  if (tareas === null) {
    console.log("los dtos proporconados no exiten: ");
   } else{

   console.log(tareas);
  const ul = document.getElementById("lista_tareas");
  ul.innerHTML = ''; 
// console.log(tareas);
  tareas.forEach((tarea) => {
      const li = document.createElement("li");
      li.textContent = tarea;
      ul.appendChild(li);
  });
  return ;
  }
}

// Llamar a obtener_tareas cuando la página cargue para mostrar las tareas existentes
// window.onload = obtener_tareas;

//---> promis
//  let promesa1= fetch('https://jsonplaceholder.typicode.com/posts/1');
//  let promesa2= fetch('https://jsonplaceholder.typicode.com/posts/1');
//  let promesa3= fetch('https://jsonplaceholder.typicode.com/posts/1');

//  Promise.all([promesa1, promesa2, promesa3])
//  .then((values) => {
//   console.log(values);
//  })

// function prueba(gatos){
//   return gatos.startsWith("N");
// }

// const animales =["NEGRO","OSO","JAIBA","LEOPARDDO","NENE"];
// const filtrar = animales.filter(prueba);
// console.log(filtrar);




