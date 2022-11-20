class Carrito{
constructor(){
this.formatter = new Intl.NumberFormat('en-US', {style: 'currency',currency: 'USD', minimumFractionDigits: 0 })
const div= document.createElement("div");
div.innerHTML= this.carrito();
div.classList.add("cart-overlay");
document.querySelector("body").appendChild(div);
const modalCart= document.querySelector(".cart-overlay");
modalCart.addEventListener("click", e=>{
if((e.target.className==="cart-overlay opened") || (e.target.className==="btn-close")){ 
// document.querySelector("body").classList.remove("hide-scroll");    
modalCart.classList.remove("opened");
}
if(e.target.className==="fas fa-times")this.eliminarItem(e.target.dataset.id);
if(e.target.className==="btn btn-link btn-close ripple-surface"){
const id=e.target.firstElementChild.dataset.id;
this.eliminarItem(id)
}
}) ;  
const showCard= document.getElementById("showCard");
const shopcarts= document.querySelectorAll(".shopcart");
if(showCard){
showCard.addEventListener("click",()=>{
const c= this.getcar();
if(c.cantidad>0){
this.actualizarCarrito();
if(modalCart){
// document.querySelector("body").classList.add("hide-scroll"); 
modalCart.classList.add("opened")
}
}
})
}
shopcarts.forEach(btn=>{
btn.addEventListener("click",()=>{
const c= this.getcar();
if(c.cantidad>0){
this.actualizarCarrito();
if(modalCart){
// document.querySelector("body").classList.add("hide-scroll"); 
modalCart.classList.add("opened")
}
}
})
})
const btnPagar= document.getElementById("pagar");
btnPagar.addEventListener("click",()=>{
const c= this.getcar();
if(c.cantidad>0){
    modalCart.classList.remove("opened");
    window.location= host+"ecommerceNutra/checkout/index.html";
}
})
const loadLabelsCartButtons=()=>{
const localcart= localStorage.getItem("carrito");
const value=  localcart ?  JSON.parse(atob(localcart)) : [];
const contadores= document.querySelectorAll(".counter");
contadores.forEach(contador=>{
contador.textContent= value.length;  
})
}
loadLabelsCartButtons();
}
removeCart(param){
const localcart= localStorage.getItem("carrito");
const carritoTemp=JSON.parse(atob(localcart));
const producto= param.producto;
for (let index = 0; index < carritoTemp.length; index++) {
const e = carritoTemp[index];
if(e.producto.producto.match(producto)){
carritoTemp.splice(index, 1);
index--
}
}
const save= btoa(JSON.stringify(carritoTemp))
localStorage.setItem("carrito",save);
this.actualizarCarrito();
}
getcar(){
const localcart= localStorage.getItem("carrito");
let List=[];
if(localcart){
const carritoTemp=JSON.parse(atob(localcart))
const result=this.groupBy(carritoTemp, p=>p.producto.producto);
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
const total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
const cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
return {data:List, total:total, cantidad:cantidad}
}else return {data:List, total:0, cantidad:0}
}
groupBy =(list, keyGetter)=> {
const map = new Map();
list.forEach((item) => {
const key = keyGetter(item);
const collection = map.get(key);
if (!collection) {
map.set(key, [item]);
} else {
collection.push(item);
}
});
return Array.from(map);
} 
eliminarItem(id){
const producto= this.getcar().data[id];
this.removeCart(producto);
}
carrito() {
const c= this.getcar();
return `
<div class="dropdown cart-dropdown cart-offcanvas me-0 me-lg-2">
<div class="dropdown-box">
<div class="bg-square"></div>
<div class="cart-header">
<span>Carrito de compras</span>
<a  href="#" aria-label="cerrar menu" class="btn-close"></a>
</div>
<div id="cart293" class="products">
${c.data.map((item, i) => `
<div class="product product-cart">
<div class="product-detail">
<a class="product-name">${item.producto}</a>
<div class="price-box">
<span class="product-quantity">${item.cantidad}X</span>
<span class="product-price">${this.formatter.format(item.valor)}</span>
</div>
</div>
<figure class="product-media">
<a>
<img src="${item.img}" alt="product" height="64" >
</a>
<button class="btn btn-link btn-close" aria-label="button">
<i data-id="${i}" class="fas fa-times"></i>
</button>
</figure>
</div>
`).join('')}
</div>
<div class="cart-total">
<label>Subtotal:</label>
<span id="price293" class="price">${this.formatter.format(c.total)}</span>
</div>
<div class="cart-action">
<a id="pagar"  href="#!"  class="btn btn-primary  btn-rounded">Realizar Pago</a>
</div>
</div>
</div>
`
};
actualizarCarrito(){
const c= this.getcar();
const lista= document.getElementById("cart293");
let temp="";
c.data.forEach((item, i) =>{
temp+=` 
<div class="product product-cart">
<div class="product-detail">
<a  class="product-name">${item.producto}</a>
<div class="price-box">
<span class="product-quantity">${item.cantidad}X</span>
<span class="product-price">${this.formatter.format(item.valor)}</span>
</div>
</div>
<figure class="product-media">
<a >
<img src="${item.img}" alt="product" height="64" >
</a>
<button  class="btn btn-link btn-close" aria-label="button">
<i data-id="${i}" class="fas fa-times"></i>
</button>
</figure>
</div>
`;
});
lista.innerHTML= temp;
document.getElementById("price293").innerText=this.formatter.format(c.total);
const counter= document.getElementById("counter");
if(counter) counter.textContent= c.cantidad;
if(c.cantidad==0){
const lista= document.getElementById("cart293");
if(lista) lista.textContent="Sin productos."    
}
const contadores= document.querySelectorAll(".counter");
contadores.forEach(contador=>{
contador.textContent=  c.cantidad; 
})
}
}

new Carrito();
