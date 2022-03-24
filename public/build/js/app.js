let paso=1;const pasoInicial=1,pasoFinal=3,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaAnterior(),paginaSiguiente(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(t.classList.add("ocultar"),e.classList.remove("ocultar"),mostrarResumen()):(t.classList.remove("ocultar"),e.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent="$"+a;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(n),r.appendChild(c),document.querySelector("#servicios").appendChild(r)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado"))}function idCliente(){cita.id=document.querySelector("#id").value}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Los Sabados y Domingos no Abrimos","errores",".formulario")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>18?(e.target.value="",mostrarAlerta("Hora no valida","errores",".formulario")):cita.hora=e.target.value}))}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta"),c.classList.add(t);document.querySelector(o).appendChild(c),a&&setTimeout(()=>{c.remove()},3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de Servicio o Fecha u Hora","errores",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:n}=cita,c=document.createElement("H3");c.textContent="Resumen de Servicios",e.appendChild(c),n.forEach(t=>{const{id:o,nombre:a,precio:n}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicios");const r=document.createElement("P");r.textContent=a;const i=document.createElement("P");i.innerHTML="<span>Precio:</span> $"+n,c.appendChild(r),c.appendChild(i),e.appendChild(c)});const r=new Date(o),i=r.getMonth(),s=r.getDate()+2,d=r.getFullYear(),l=new Date(Date.UTC(d,i,s)).toLocaleDateString("es-CO",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),u=document.createElement("H3");u.textContent="Resumen de Cita",e.appendChild(u);const m=document.createElement("P");m.innerHTML="<span>Nombre:</span> "+t;const p=document.createElement("p");p.innerHTML="<span>Fecha:</span> "+l;const v=document.createElement("P");v.innerHTML="<span>Hora:</span> "+a;const h=document.createElement("BUTTON");h.classList.add("boton"),h.textContent="Reservar Cita",h.onclick=reservarCita,e.appendChild(m),e.appendChild(p),e.appendChild(v),e.appendChild(h)}async function reservarCita(){const{id:e,nombre:t,fecha:o,hora:a,servicios:n}=cita,c=n.map(e=>e.id),r=new FormData;r.append("usuarioid",e),r.append("fecha",o),r.append("hora",a),r.append("servicios",c);try{const e="http://localhost:3000/api/citas",t=await fetch(e,{method:"POST",body:r}),o=await t.json();console.log(o.resultado),o.resultado&&swal({title:"Cita creada!",text:"Tu Cita fue creada correctamente",icon:"success",button:"Ok!"}).then(()=>{window.location.reload()})}catch(e){swal({title:"Algo salió mal!",text:"Estamos trabajando para solucionarlo",icon:"error",button:"bueh..."}).then(()=>{window.location.reload()})}}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));