import  Ecommerce from '../../index.js?v=20';
const formatter = new Intl.NumberFormat('en-US', {style: 'currency',currency: 'USD', minimumFractionDigits: 0 })
var eco= new Ecommerce();
(async()=>{
await eco.startCheckout();
// await eco.startStore();
// await eco.startproducts(["isoclean vainilla 2lb","ISOCLEAN 5LB"]);
eco.getCart().subscribe(carrito=>{
updateTable(carrito);
});
const ciudades= await eco.ciudades();
const cmbciudad= document.getElementById("cmbciudad");
if(cmbciudad){
let options='';
ciudades.forEach(option=>{
options+=`
<option value="${option.value}"> ${option.label} </option>
`;
});
cmbciudad.innerHTML= options;
cmbciudad.addEventListener('change', (event) => {
const place=event.target.value;
eco.placeSelected(place);
});
}
const cmbclocalidad= document.getElementById("cmbclocalidad");
if(cmbclocalidad){
let options='';
eco.options.forEach(option=>{
options+=`
<option value="${option.value}"> ${option.label} </option>
`;
});
cmbclocalidad.innerHTML= options;
cmbclocalidad.addEventListener('change', (event) => {
const selectedValue={
value: event.target.value,
label: eco.options[event.target.value].label
}
const localeBogota={
isBogota: true,
locale: selectedValue
}
localStorage.setItem("locale", JSON.stringify(localeBogota));

if(event.target.value !=0)document.getElementById("rlocalidad").classList.add("d-none");



});

}
const  blurs= document.querySelectorAll("[data-blur]");
blurs.forEach(input=>{
const id= Number(input.dataset.blur);  
input.onblur= (event)=>{
eco.validate(event, id);
}
});
eco.pagar(); 
load();
})();
const updateTable= (carrito)=>{
let tr='';
for (let i = 0; i < carrito.data.length; i++) {
    const item = carrito.data[i];
    tr+=`
<tr class="fadeInRows">
<th scope="row"> ${i+1}  </th>
<td>
<div class="media-cart">
<img   src="${item.img}" alt="${item.producto}" height="36" width="36"  style="height: 36px;" class="mr-2">
<div class="media-body">
${item.producto}
</div>
</div>
</td>
<td> x ${item.cantidad} </td>
<td> ${formatter.format(item.total)} </td>
<td class="text-center" >
<a data-add="${i}" class=" btn btn-primary btn-sm">
<i class="fas fa-plus"></i>
</a>
</td>
<td class="text-center " >
<a data-remove="${i}"  class=" btn btn-danger btn-sm">
<i class="fas fa-minus"></i>
</a>
</td>
</tr>
`;
}
tr+=`<tr class="total fadeInRows">
<th  colspan="3" class="font-weight-bold" >SUB TOTAL </th>
<td   colspan="3" style="font-weight: 800;"> ${formatter.format(carrito.total)} </td>
</tr>`;
document.getElementById("tbcarrito").innerHTML= tr;
const btnremove= document.getElementById("tbcarrito").querySelectorAll("[data-remove]");
const btnadd= document.getElementById("tbcarrito").querySelectorAll("[data-add]");
btnadd.forEach(btn=>{
btn.addEventListener("click",(event)=>{
let index=0;
if(event.target.nodeName=="A"){
index= event.target.dataset.add;
}else{
index= event.target.nextSibling.parentNode.dataset.add;
}
const producto= carrito.data[index];
eco.plusCart(producto);
})
});
btnremove.forEach(btn=>{
btn.addEventListener("click",(event)=>{
let index=0;
if(event.target.nodeName=="A"){
index= event.target.dataset.remove;
}else{
index= event.target.nextSibling.parentNode.dataset.remove;
}
eco.removerProducto(index,1);
})
});


const filaindex= document.getElementById("rows");
const tbbody= document.getElementById("tbtotal");
const clearRows= document.querySelectorAll("[data-row]")
for (let index = 0; index < clearRows.length; index++) { clearRows[index].remove()}
for (let i = 0; i < carrito.data.length; i++) {
const item = carrito.data[i];
const trtotal=`
<td class="mayus"> ${item.producto}  x ${item.cantidad}</td>
<td class="mayus"> ${formatter.format(item.total)}   </td>
`;
const row= document.createElement("tr");
row.setAttribute("data-row", i);
row.innerHTML= trtotal;
tbbody.insertBefore(row, filaindex)
}
document.getElementById("rowsubtotal").querySelector("td").innerText=formatter.format(eco.total);
if(eco.cupon>0){
document.getElementById("rowdescuento").querySelector("td").innerText="-"+formatter.format(eco.getDes());
document.getElementById("rowdescuento").classList.remove("d-none");
}else document.getElementById("rowdescuento").classList.add("d-none");
if(eco.data_send.value>0){
document.getElementById("rowflete").querySelector("td").innerText=formatter.format(eco.data_send.value);    
document.getElementById("rowflete").classList.remove("d-none")
}else document.getElementById("rowflete").classList.add("d-none")
document.getElementById("rowtotal").querySelector("td").innerText=formatter.format(eco.getTotal());
}
document.getElementById("button-addon2").addEventListener("click",()=>{
eco.getCupon();
});
document.getElementById("btnfinalizarcomprar").addEventListener("click",()=>{
const check= document.getElementById("terminos").checked;
const msg= document.getElementById("messagevalidatedata");
if(validarCiudad(eco.ciudad)) {
alert(`Lo sentimos, por el momento no tenemos envío a ${eco.ciudad}`)
return;
}

if(check)eco.finalizarCompra();
else{
if(msg){
msg.classList.remove("d-none");
msg.innerHTML="<span style='color: #ff3547;'>Debes aceptar nuestros términos y condiciones </span>" ;

}    
}
});
document.getElementById("message").addEventListener("click",()=>{
eco.message();
});
const load = ()=>{
const background= document.querySelector(".background");
background.classList.add("clip-path");
document.querySelector("body").classList.remove("noscroll");   
background.addEventListener("transitionend", function(event) {background.classList.add("d-none");}, false);
}
const validarCiudad= (place)=> place=="San Andrés";
//#region test
// document.onkeypress = (e)=>{
// e= e || window.event;
// console.log(e.keyCode);
// if(e.keyCode===13){
// let producto= eco.products[0];
// if(producto){
// producto.descuento=20;
// eco.add(producto);    
// }

// }
// if(e.keyCode===32){
// console.log(eco.carrito);
// // eco.removerProducto(0,1);
// }
// if(e.keyCode===127){
// eco.pagar();
// // eco.finalizarCompra();
// eco.testPay();
// eco.uploadV2();
// }
// }
//#endregion


