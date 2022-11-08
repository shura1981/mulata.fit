import {getProduct,getProductsCategory,getProductsHome,getProductsV2,flete, cupon,getClient,checkProducts,
getProductsPromo,getProducts,getApiProducts,apiProductsPromise, pedido, servientrega, findProducts} from './apis.js'
import  { groupByMap, loadScript,getDate } from './utils.js';
export default class Ecommerce{
constructor(){
this.urlConfirmation="https://www.nutramerican.com/api_MegaplexStar/api/confirmation.php";  
this.urlResponse= "https://mulata.fit/vista/ecommerceNutra/response/index.html";  
this.carrito=[];
this.carritoTemp=[];
this.products=[];
this.total=0;
this.cantidad=0;
this.isBogota=false;
this.isPlaceSelected=false;
this.cupon=0;
this.descuentos=0;
this.days='';
this.tax=0;
this.searchId=false;
this.gps=false;
this.selectedValue =  {value:'0', label:'Por favor selecciona la localidad'};
this.data_send={
ciudad:"CALI",
days:0,
type:0,
value:0
}
this.validate_registrer={
email:false,
user:false,
pass:false
}
this.data_user={
id:false,
name:false,
cell:false,
place:false,
dir:false,
email:false
}
}
startCheckout(){
loadScript("rs/checkout.js");    
return new Promise(async (resolve, reject)=>{
try {
const res = await loadScript("rs/Rx.js");
this.subject = new Rx.Subject();// creamos nuestro subject    
this.productos = new Rx.Subject();
this._initCheckOut();
resolve(res);
} catch (error) {
reject(error);
}
});
}
startproducts(listproducts){
loadScript("rs/checkout.js");    
return new Promise(async (resolve, reject)=>{
try {
const res = await loadScript("rs/Rx.js");
this.subject = new Rx.Subject();// creamos nuestro subject    
this.productos = new Rx.Subject();
this._initproducts(listproducts);
resolve(res);
} catch (error) {
reject(error);
}
});
}
startStore(){
loadScript("rs/checkout.js");    
return new Promise(async (resolve, reject)=>{
try {
const res = await loadScript("rs/Rx.js");
this.subject = new Rx.Subject();// creamos nuestro subject    
this.productos = new Rx.Subject();
this._init();
resolve(res);
} catch (error) {
reject(error);
}
});
}
pay_user={
id: 0,
usuario:"",
cell: 0,
email: "",
coment:"",
dir: "",
ciudad: ""
}
async _init(){
this.clearSessionStore();
//#region obtener productos y carrito
try {
const list = await this.ProductsPromise();    
this.products=list.products;
this.carrito= list.cart.data;
this.total= list.cart.total;
this.cantidad= list.cart.cantidad;
this.subject.next({data: list.cart.data, total:this.total, cantidad:this.cantidad});
} catch (error) {console.log('error', error);}
//#endregion
}
async _initCheckOut(){
//#region obtener productos y carrito
try {
const list = await this.ProductsPromiseCheckOut();    
this.products=list.products;
this.carrito= list.cart.data;
this.total= list.cart.total;
this.cantidad= list.cart.cantidad;
this.subject.next({data: list.cart.data, total:this.total, cantidad:this.cantidad});
} catch (error) {console.log('error', error);}
//#endregion
}
async _initproducts(products){
//#region obtener productos y carrito
try {
const list = await this.ProductsPromiselist(products);    
this.products=list.products;
this.carrito= list.cart.data;
this.total= list.cart.total;
this.cantidad= list.cart.cantidad;
this.subject.next({data: list.cart.data, total:this.total, cantidad:this.cantidad});
} catch (error) {console.log('error', error);}
//#endregion
}
getCart(){
return this.subject;
}
addCart(item){
this.carritoTemp.push(item);
const result=groupByMap(this.carritoTemp, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});

this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
const save= btoa(JSON.stringify(this.carritoTemp))
localStorage.setItem("carrito",save);
this.subject.next({data:List, total:this.total, cantidad:this.cantidad});
this.showInfo();
}
Carrito(){
const localcart= localStorage.getItem("carrito");
if(localcart){
this.carritoTemp=JSON.parse(atob(localcart))
const result=groupByMap(this.carritoTemp, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
this.carrito= List;
this.subject.next({data:List, total:this.total, cantidad:this.cantidad});
}
}
addCartList(item,mostrar){
this.carrito.push(item);
const result=groupByMap(this.carrito, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
const save= btoa(JSON.stringify(this.carrito))
localStorage.setItem("carrito",save);
this.subject.next({data:List, total:this.total, cantidad:this.cantidad});
if(mostrar)this.showInfo();
}
addCartNotNotification(carrito){
this.carrito.push(item);
const result=groupByMap(this.carrito, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
const save= btoa(JSON.stringify(this.carrito))
localStorage.setItem("carrito",save);
this.subject.next({data:List, total:this.total, cantidad:this.cantidad});
}
removeCart(producto){
for (let index = 0; index < this.carritoTemp.length; index++) {
const e = this.carritoTemp[index];
if(e.producto.producto.match(producto)){
this.carritoTemp.splice(index, 1);
index=this.carritoTemp.length-1;
}
}
const save= btoa(JSON.stringify(this.carritoTemp))
localStorage.setItem("carrito",save);
const result=groupByMap(this.carritoTemp, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
this.carrito= List;
this.subject.next({data:List, total:this.total, cantidad:this.cantidad});
}
clearCart(){
localStorage.removeItem("carrito");
this.subject.next({data:[], total:0, cantidad:0});
}
plusCart(producto){
for (let index = 0; index < this.carritoTemp.length; index++) {
const e = this.carritoTemp[index];
if(e.producto.producto.match(producto)){
this.carritoTemp.push(e);
index=this.carritoTemp.length-1;
}
}
const save= btoa(JSON.stringify(this.carritoTemp))
localStorage.setItem("carrito",save);
const result=groupByMap(this.carritoTemp, p=>p.producto.producto);
let List=[];
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
this.carrito= List;
this.subject.next({data:List, total:this.total, cantidad:this.cantidad});
this.searchTax(this.ciudad,this.departamento);
this.cupon=0;
this.descuentos=0;
const mcupon= document.getElementById("messagecupon");
if(mcupon)mcupon.classList.add("d-none");
}
validateCart(productos){
const temp= localStorage.getItem("carrito");
let List=[];
if(temp){
this.carritoTemp= JSON.parse(atob(temp)); 
let deletedItems=[];
for (let index = 0; index < this.carritoTemp.length; index++) {
const c = this.carritoTemp[index];
const p= productos.find(item=>item.producto==c.producto.producto);
if(p){
c.producto.descuento= p.descuento;
c.valor= p.valor-((p.valor*p.descuento)/100);    
}else {
const deleted =   this.carritoTemp.splice(index,1);
deletedItems.push(deleted[0])
index--;
}
}
deletedItems= groupByMap(deletedItems, p=>p.producto.producto);
if(deletedItems.length>0){
const save= btoa(JSON.stringify(this.carritoTemp))
localStorage.setItem("carrito",save);
const alerta= `Los siguientes productos fueron removidos del carrito porque ya no están disponibles ${deletedItems.map(r=>r[0]).toString()}`;    
alert(alerta);  
}

const result=groupByMap(this.carritoTemp, p=>p.producto.producto);
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
}else this.carritoTemp=[];
return {data:List, total:this.total, cantidad:this.cantidad};
}
validateproducts(productos){
const temp= localStorage.getItem("carrito");
let List=[];
if(temp){
this.carritoTemp= JSON.parse(atob(temp)); 
for (let index = 0; index < this.carritoTemp.length; index++) {
const c = this.carritoTemp[index];
const p= productos.find(item=>item.producto==c.producto.producto);
if(p){
c.producto.descuento= p.descuento;
c.valor= p.valor-((p.valor*p.descuento)/100);    
}
}
const result=groupByMap(this.carritoTemp, p=>p.producto.producto);
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
this.total= List.reduce((acumulado, item)=>  acumulado + item.total,0);
this.cantidad= List.reduce((acumulado, item)=>  acumulado + item.cantidad,0);
}else this.carritoTemp=[];
return {data:List, total:this.total, cantidad:this.cantidad};
}
ProductsPromise(){
return new Promise(async(resolve, reject)=>{
try {   
const list= await apiProductsPromise();   
const cart= this.validateCart(list);
resolve({products: list , cart: cart});
} catch (error) {reject('ocurrió un error'+ error)}
});
}
ProductsPromiseCheckOut(){
return new Promise(async(resolve, reject)=>{
try {   
const list= await checkProducts();   
const cart= this.validateCart(list);
resolve({products: list , cart: cart});
} catch (error) {reject('ocurrió un error'+ error)}
});
}
ProductsPromiselist(productos){
return new Promise(async(resolve, reject)=>{
try {   
const list= await findProducts(productos);   
const cart= this.validateproducts(list);
resolve({products: list , cart: cart});
} catch (error) {reject('ocurrió un error'+ error)}
});
}
closeTimer(){
const cart= document.getElementById("modal-cart");
if(cart) cart.style.display="none"; 
}
pagar(){
this.terminos=false;
this.cupon=0;
this.descuentos=0;
const mcupon= document.getElementById("messagecupon");
if(mcupon)mcupon.classList.add("d-none");
this.closeTimer();
// let panel= document.querySelector(".checkout");
// if(panel)panel.classList.toggle("d-none");
this.loadData();
}
loadData(){
const c= this.queryClient();
const h= setTimeout(()=>{
if(c){
const id_= document.getElementById('id_') ;  
if(id_)id_.value= c.id;
const name_user= document.getElementById('name_user');
if(name_user)name_user.value= c.nombres;
const cell_user= document.getElementById('cell_user')
if(cell_user)cell_user.value=c.celular;
const correo_user= document.getElementById('correo_user')
if(correo_user)correo_user.value=c.e_mail;
const dir_user= document.getElementById('dir_user')
if(dir_user)dir_user.value=c.direccion;
const place= this.findPlace(c.ciudad);
this.ciudad=place.ciudad;
// this.selectP.value= place.ciudad
this.dir=c.direccion;
this.isPlaceSelected=true;
this.departamento= place.departamento ? place.departamento : "";
this.searchTax(this.ciudad,this.departamento);
this.selectElement('cmbciudad', this.ciudad)
this.isNew=false;
this.validatorPlace=true;
this.validatorDep=true;
const messageisNew= document.getElementById("messageisNew");
if(messageisNew) messageisNew.classList.remove("d-none");
}
clearTimeout(h);
},100);
}
queryClient(){
const query= localStorage.getItem("xd");
if(query)return  JSON.parse(atob( query));
else return null;
}
findPlace(ciudad){
const exp=new RegExp(ciudad, "gi");
const place= this.regiones.find(c=>c.ciudad.match(exp));
return place ? place : null;
}
findPlaceFull(ciudad,dep){
const exp1=new RegExp(ciudad, "gi");
const exp2=new RegExp(dep, "gi");
const place= this.regiones.find(c=>c.ciudad.match(exp1) && c.departamento.match(exp2));
return place ? place : null;
}

placeSelected(option){
this.isPlaceSelected=true;
const place= this.regiones.find(c=>c.ciudad==option);
console.log("place",place, "opción", option);
this.ciudad= place.ciudad;
this.departamento= place.departamento ? place.departamento : "";
this.searchTax(this.ciudad,this.departamento);
}
getRegExp(place){
return new RegExp(place, "gi");
}
findPlace(ciudad){
const exp=new RegExp(ciudad, "gi");
const place= this.regiones.find(c=>c.ciudad.match(exp));
return place ? place : null;
}
showBogota(){
this.isBogota=true;
const bogota= document.getElementById("isBogota");
if(bogota) bogota.classList.remove("d-none") ; 
}
hideBogota(){
this.isBogota=false
const bogota= document.getElementById("isBogota");
if(bogota) bogota.classList.add("d-none") ; 
}
updateTotal (){
const formatter = new Intl.NumberFormat('en-US', {style: 'currency',currency: 'USD', minimumFractionDigits: 0 })
const rowdescuento= document.getElementById("rowdescuento");
// console.log(this.getDes(),this.data_send.value , this.getTotal());
if(rowdescuento){
if(this.cupon>0){
document.getElementById("rowdescuento").querySelector("td").innerText="-"+formatter.format(this.getDes());
document.getElementById("rowdescuento").classList.remove("d-none");
}else document.getElementById("rowdescuento").classList.add("d-none");
if(this.data_send.value>0){
document.getElementById("rowflete").querySelector("td").innerText=formatter.format(this.data_send.value);    
document.getElementById("rowflete").classList.remove("d-none")
}else document.getElementById("rowflete").classList.add("d-none")
document.getElementById("rowtotal").querySelector("td").innerText=formatter.format(this.getTotal());
}
}
searchTax(ciudad, departamento){
const m= document.getElementById("messageubication");
if(m)m.classList.add("d-none")
if(ciudad!=undefined && departamento!=undefined){
 flete(ciudad, departamento).then(l=>{
const c=l[0];
this.data_send= c;
if(ciudad.match(this.getRegExp("MEDELLIN")) ||  ciudad.match(this.getRegExp("BOGOTA")) || ciudad.match(this.getRegExp("CALI")) || ciudad.match(this.getRegExp("CUCUTA")) || ciudad.match(this.getRegExp("BARRANQUILLA")) || ciudad.match(this.getRegExp("BUCARAMANGA")))
{
if(this.getSubTotal()>=59900)this.data_send.value=0;
else this.data_send.value=4900;
}else if(ciudad.match(this.getRegExp("Medellín") || ciudad.match(this.getRegExp("Bogotá")) || ciudad.match(this.getRegExp("Cali")) || ciudad.match(this.getRegExp("Cúcuta")) || ciudad.match(this.getRegExp("Barranquilla")) || ciudad.match(this.getRegExp("Bucaramanga")))){
if(this.getSubTotal()>=59900)this.data_send.value=0;
else this.data_send.value=4900;
}
if(ciudad.match(this.getRegExp("Bogotá")) || ciudad.match(this.getRegExp("BOGOTA"))){this.showBogota(); }
else this.hideBogota();

if(this.isBogota && this.checkLocalidad()){
this.selectElement('cmbclocalidad', this.checkLocalidad().locale.value);
}

// console.log('isbogotá', this.isBogota);
// console.log('valor del flete',this.data_send.value);
const desc=this.descuento_flete(this.getSubTotal(),this.data_send.value);
// console.log('valor del pedido',this.getSubTotal(),'valor del flete con descuento',desc);
this.data_send.value= desc;
const m= document.getElementById("messagetax");
if(m)m.classList.remove("d-none");
let mdy="día hábil.";
if(this.data_send.days>1)mdy="días hábiles.";
let message="";
if(this.data_send.value<=0)message="Gratis";
else message=`de $${this.data_send.value.toLocaleString('en-IN')}`;
if(m)m.innerHTML=`<small class='days'>El costo de envío es ${message} y el tiempo aproximado de entrega es de <strong>2 a 3 días hábiles </strong> <small>`;
// m.innerHTML=`<small class='days'>El costo de envío es ${message} y el tiempo aproximado de entrega en condiciones normales es de <strong>${this.data_send.days} ${mdy} </strong> El tiempo de entrega en promociones es de <strong> 1 a 10 días hábiles </strong> dependiendo del lugar de destino.<small>`;
this.updateTotal();
}).catch(e=>{
console.log(e);
const m= document.getElementById("messageubication");
if(m){
m.classList.remove("d-none");
m.innerHTML="<small style='color: red; font-size: 1rem'>No se pudo encontrar la ubicación, por favor selecciona la ciudad. <small>"   
}
});

   
}


}
descuento_flete(total_venta, valor_flete) {
if(valor_flete===0 ||  total_venta===0)return 0;
else {
if(total_venta>=100000){
const porcentaje= Math.round(valor_flete*100/total_venta);
// console.log('porcentaje', porcentaje);
if(porcentaje<=10) return 0;
else return valor_flete - Math.round(total_venta*10/100);
} else return valor_flete;
}
}
options = [
{value:'0', label:'Por favor selecciona la localidad', disabled: true },
{value:'1', label:'Usaquén'},
{value:'2', label:'Chapinero'},
{value:'3', label:'SantaFe'},
{value:'4', label:'SanCristóbal'},
{value:'5', label:'Usme'},
{value:'6', label:'Tunjuelito'},
{value:'7', label:'Bosa'},
{value:'8', label:'Kennedy'},
{value:'9', label:'Fontibón'},
{value:'10', label:'Engativá'},
{value:'11', label:'Suba'},
{value:'12', label:'BarriosUnidos'},
{value:'13', label:'Teusaquillo'},
{value:'14', label:'LosMártires'},
{value:'15', label:'AntonioNariño'},
{value:'16', label:'PuenteAranda'},
{value:'17', label:'LaCandelaria'},
{value:'18', label:'RafaelUribeUribe'},
{value:'19', label:'CiudadBolivar'},
{value:'20', label:'Sumapaz'}
];
getValue(item){
return item.valor-((item.valor*item.descuento)/100)
}
getCupon(){
let validar=true;
let value=document.getElementById('cupon').value;
if(!value)return;
const mcupon= document.getElementById("messagecupon");
if(mcupon){
mcupon.classList.remove("d-none");
mcupon.innerHTML="<span style='color: rgb(41, 41, 41);'>Validando cupón...  </span>";
}
cupon(value)
.then(l=>{
const c=l[0];
this.dataCupon=c;
if(c.estado==1){
this.cupon=c.descuento;
this.descuentos=0;
// #region validar valores 
const productosModificados=[];
this.carrito.forEach(item => {
let pro= item.producto;
const exp=new RegExp(pro, "gi");
const r=this.products.find(p=>p.producto.match(exp));
let descuento=0;
if(r!=undefined ){
if(r.descuento>0 || r.promo==1){
validar=false;  
productosModificados.push(item.producto);
}  
else{
descuento= (((r.valor*item.cantidad)*this.cupon)/100);
this.descuentos+=descuento;
}
}
});  
if(!validar){
this.total= this.carrito.reduce((acumulado, item)=>  acumulado + item.total,0); 
// console.log('modificados', productosModificados);
if(mcupon)mcupon.innerHTML=`<small > <strong>Se aplicó el descuento del ${c.descuento}%</strong>. El cupón no aplica para productos en promoción o combos según nuestros <strong>términos y condiciones</strong></small>`;
}else { if(mcupon)mcupon.innerHTML=`<small >Descuento del ${c.descuento}%  </small>`;}
this.updateTotal();
// #endregion  
} else {mcupon.innerHTML=`<small ><strong> El cupón está vencido. <strong></small>`; this.cupon=0;}
}).
catch(e=>{
if(mcupon)mcupon.innerHTML="<small ><strong>El cupón no es válido <strong></small> ";
}).finally(()=>{
this.searchId=false; 
document.getElementById('cupon').value="";
});
}
addP(){
this.api.addCart({producto: {producto: this.item.producto, img:this.item.thumbnails, valor: this.item.valor, descuento:this.item.descuento}, cantidad:1,valor: this.getValue(this.item) });
const c= this.ciudad;
// console.log('ciudad', c);
if (typeof c === 'string' || c instanceof String)this.searchTax(c,"");
else this.searchTax(c.ciudad,"");
}
/**
 * añade un producto al carrito
 * @param {producto} item  
 */
add(item){
let producto= {producto: {producto: item.producto, img:item.images.small, valor: item.valor, descuento:item.descuento}, cantidad:1,valor: this.getValue(item) };
this.addCart(producto);
}
comprar(item){
this.add(item);
const hilo= setTimeout(()=>{
this.pagar();
clearTimeout(hilo);
},500);

}   
// remove(item){
// if(item.cantidad>1)  item.cantidad-=1;
// }
increment(item){
item.cantidad+=1;
}
addCartMsg(producto){
let mostrar=false;  
for (let index = 0; index < producto.cantidad; index++) {
if(index===(producto.cantidad-1))mostrar=true;
this.api.addCartList({producto: {producto: producto.producto, img:producto.thumbnails, valor: producto.valor, descuento:producto.descuento}, cantidad:1,valor: this.getValue(producto) },mostrar);
}
}
getSelectedValue(event){
this.selectedValue={
value: event,
label:this.options.find(item=>item.value===event).label
}
const localeBogota={
isBogota: this.isBogota,
locale: this.selectedValue
}
localStorage.setItem("locale", JSON.stringify(localeBogota));
}
queryClient(){
const query= localStorage.getItem("xd");
if(query)return  JSON.parse(atob( query));
else return null;
}
getValue(item){
return item.valor-((item.valor*item.descuento)/100)
}
finalizarCompra(){
let validar= this.validardatos();
const msg= document.getElementById("messagevalidatedata");
if(validar){ 
if(!this.validarListaNegra()){
if(msg)msg.classList.add("d-none"); 
this.uploadV2();
}
else document.location.href="https://www.policia.gov.co/";
}
else {
if(msg){
    msg.classList.remove("d-none");
msg.innerHTML="<span style='color: #ff3547;'>Por favor ingresa los datos para realizar tu compra. </span> ";
}

}
}
testPay(){
this.pay_user.id= 63948880;
this.pay_user.usuario="STEVEN REALPE";
this.pay_user.cell= 3175346352;
this.pay_user.email= "realpelee@gmail.com";
this.pay_user.coment="hola";
this.pay_user.dir= "calle 32b #4ae-23";
this.pay_user.ciudad= "PALMIRA";


}
uploadV2(){
this.listProductos=[];
this.carrito.forEach(p=>{
this.listProductos.push({producto:p.producto, valor:p.total, cantidad:p.cantidad });
});
if(this.data_send.value>0)this.listProductos.push({producto:"FLETE", valor:this.data_send.value, cantidad:1 });
if(this.cupon>0)this.listProductos.push({producto:"CUPÓN DE DESCUENTO "+this.dataCupon.valor+" "+this.dataCupon.descuento+"%", valor:-this.getDes(), cantidad:1 });
const detailsend= `Datos del flete\n Ciudad: ${this.data_send.ciudad}, Valor: ${this.data_send.value}, Días: ${this.data_send.days}`;
let Observaciones=this.pay_user.coment+"\n"+detailsend;
let packageProductos=this.listProductos;
let correo= this.pay_user.email;
correo= correo.replace(/ /g, "");
const date= getDate();

let data={
id_cliente: this.pay_user.id,
fecha:  date.fecha,
hora:  date.hora ,
latitud: 0,
longitud: 0,
ciudad: this.pay_user.ciudad,
presencial:0, 
cliente: this.pay_user.usuario,
dirección: this.pay_user.dir, 
teléfono: this.pay_user.cell,
celular: this.pay_user.cell ,
vendedor: "MEGAPLEX STARS WEB",
nivel: 1,
forma_pago: "LINK DE PAGO",
correo:correo
}
const name_user= this.pay_user.usuario.split(" ");
let nombre= "";
let apellido="";
for (let index = 0; index <name_user.length; index++) {
nombre = name_user[0];
if(index>0)apellido += name_user[index]+" ";
}
const json={
flt_total_con_iva: this.getTotal() ,
flt_valor_iva: 0,
str_id_pago: this.id_visita,
str_descripcion_pago: "PAGO DEL PEDIDO Nº "+ this.id_visita,
str_email: this.pay_user.email,
str_id_cliente: this.pay_user.id,
str_tipo_id: "1",
str_nombre_cliente: nombre,
str_apellido_cliente: apellido,
str_telefono_cliente: this.pay_user.cell,
str_opcional1: "opcion 11",
str_opcional2: "opcion 12",
str_opcional3: "opcion 13",
str_opcional4: "opcion 14",
str_opcional5: "opcion 15"
}

const dataEpayco={
data: json,
fecha:  date.fecha,
hora:  date.hora ,
agente: {
"usuario": "MEGAPLEX STARS",
"foto": "https://www.nutramerican.com/api_MegaplexStar/assets/icons/favicon-96x96.png",
"id_usuario": 116
}
}
const paquete={
json_productos: packageProductos,
tipology:'CLIENTE FINAL',
json_values:data,
observaciones: Observaciones,
vendedor:116,
epayco: dataEpayco
}

if( this.listProductos.length>0)
{
const fileUpload= document.getElementById("fileUpload");
if(fileUpload)fileUpload.classList.remove("d-none");
// console.log(paquete);

pedido(paquete)
.then(response=>{
console.log('response', response);
const r= response;
this.pagarEpayco(r.datos_pagador);
}).catch(error=>{
    console.log(error);
    if(fileUpload)fileUpload.classList.add("d-none");
const code=error.status;
const msg= document.getElementById("messagevalidatedata");
if(msg)msg.classList.remove("d-none");
if(code==0){
if(msg)msg.innerHTML="<span style='color: #ff3547;'>No se puede establecer conexión con el servidor, por favor<span class='strongError'> revisa tu conexión a internet.</span> </span> "; 
}else if(code>399 && code <500){
if(msg)msg.innerHTML=`<span style='color: #ff3547;'>Ocurrió un error: <span class='strongError'>${error.error.message}</span> </span> `;  
}else{
if(msg)msg.innerHTML=`<span style='color: #ff3547;'>Ofrecemos disculpas, nuestro servidor presenta inconvenientes,  <span class='strongError' id="error500"> por favor siguel el link para realizar el pedido</span> </span> `; 
document.getElementById("error500").addEventListener("click",()=>{
let sendP=""; 
this.listProductos.forEach(i=>{
sendP+=`${i.cantidad} ${i.producto} valor:${i.valor}\t\t\t.`;
});
const message= `Hola, deseo realizar el siguiente pedido `+sendP;
const h= setTimeout(()=>{
window.open(`https://api.whatsapp.com/send?phone=573013422308&text=${message.replace(/ /g, "%20")}`, '_blank'); 
clearTimeout(h);
},500);
})
}
console.log('error', error);
});
}
}
listaNegra=[
"10376630171", "santiagoloaiza25@yahoo.com1", "3045715137",
"8341602","CONRADO ANTONIO ALVAREZ RAMIREZ","3003285346","conradoalvarez25@hotmail.com",
"1037663019","juanmejia281@outlook.es"
]
validarListaNegra(){
let value= false;
this.listaNegra.forEach(item=>{
if(parseInt(this.pay_user.cell) === parseInt(item))  value= true;
if((parseInt(this.pay_user.id) === parseInt(item))) value= true;
else if(this.pay_user.email.match(item)) value= true;
});
return value;
}
pagarEpayco(p){
const handler = ePayco.checkout.configure({
key: '20640513092cb2130d3e11a61a0c41c2',
test: false
});
const name= "Orden "+ p.str_id_pago;
const data={
//Parametros compra (obligatorio)
name: name,
description: p.str_descripcion_pago,
invoice: p.str_id_pago,
currency: "cop",
amount: p.flt_total_con_iva,
tax_base: "0",
tax: "0",
country: "co",
lang: "es",
//Onpage="false" - Standard="true"
external: "true",
//Atributos opcionales
extra1: this.version,
extra2: "extra2",
extra3: "extra3",
confirmation: this.urlConfirmation,
response: this.urlResponse,
//Atributos cliente
name_billing: p.str_nombre_cliente+" "+p.str_apellido_cliente,
address_billing: "Carrera 19 numero 14 91",
type_doc_billing: "cc",
mobilephone_billing: p.str_telefono_cliente,
number_doc_billing: p.str_id_cliente,
email_billing: p.str_email,
//atributo deshabilitación metodo de pago "TDC","SP","CASH","DP"
methodsDisable: []
}
handler.onLoadCheckout= ()=>{
const fileUpload= document.getElementById("fileUpload");
if(fileUpload)fileUpload.classList.add("d-none");
}
// console.log('handler', handler);
handler.open(data);
}
clearSessionStore() {
sessionStorage.removeItem("productosmegaplex");
sessionStorage.removeItem("productshome");
}
ciudades(){
return new Promise(async(resolve, reject)=>{
try {
const response= await servientrega();
this.regiones= response;
this.options2=[];
this.regiones.forEach(p=>this.options2.push({value: p.ciudad, label: p.ciudad}));  
resolve(this.options2);
} catch (error) { reject(error);}
});
}
getDes(){
return this.descuentos;
}
getTotal(){
return  (this.total+this.data_send.value)-this.descuentos;
}
getSubTotal(){
const r= this.total*this.cupon/100;
return  this.total-r;
}
getRegExp(place){
return new RegExp(place, "gi");
}
selectElement(id, valueToSelect) {    
const singleSelectA = document.querySelector(`#${id}`);
const singleSelectInstanceA = mdb.Select.getInstance(singleSelectA);
singleSelectInstanceA.setValue(valueToSelect);
}
clear(){
const rid_= document.getElementById("rid_"); 
if(rid_)rid_.classList.add("d-none");
const rdir_user= document.getElementById("rdir_user")
if(rdir_user)rdir_user.classList.add("d-none");
const rcorreo_user=document.getElementById("rcorreo_user");
if(rcorreo_user) rcorreo_user.classList.add("d-none");
const rcell_user=document.getElementById("rcell_user")
if(rcell_user)rcell_user.classList.add("d-none");
const rname_user= document.getElementById("rname_user")
if(rname_user)rname_user.classList.add("d-none");
}
validateDep(departamento){
if(departamento=="N. DE SANTANDER") return "NORTE DE SANTANDER";
if(departamento=="NARI¥O") return "NARIÑO";
return departamento;
}
searchClient(id_cliente){
const searchId= document.getElementById("searchId");
if(searchId)searchId.classList.remove("d-none");
getClient(id_cliente)
.then(l=>{
if(l.length>0){
    const c=l[0];
     c.departamento= this.validateDep(c.departamento);
    //   console.log(c);
    const nameUser= document.getElementById('name_user')
    if(nameUser)nameUser.value= c.nombres;
    const cell_user= document.getElementById('cell_user')
    if(cell_user)cell_user.value=c.celular;
    const correo_user = document.getElementById('correo_user')
    if(correo_user)correo_user.value=c.e_mail;
    const dir_user= document.getElementById('dir_user')
    if(dir_user)dir_user.value=c.dirección;
    this.dir=c.dirección;
    this.isPlaceSelected=true;
    const place= this.findPlaceFull(c.ciudad, c.departamento);
    // console.log(place);
    this.ciudad= place.ciudad;
    this.departamento=  place.departamento;
    this.selectElement('cmbciudad', this.ciudad)
    this.searchTax(this.ciudad, this.departamento);
    this.clear();
    this.isNew=false;
    this.validatorPlace=true;
    this.validatorDep=true;
    const id= c.id_cliente.split("C");
    const cliente={
    id:id[1],   
    nombres: c.nombres,
    celular: c.celular,
    e_mail: c.e_mail,
    ciudad: c.ciudad,
    direccion: c.dirección,
    departamento: this.departamento,
    new: false
    }
    const save= btoa(JSON.stringify(cliente))
    // console.log(save);
    localStorage.setItem("xd",save);
    const messageisNew= document.getElementById("messageisNew");
    if(messageisNew)messageisNew.classList.remove("d-none");
}else throw Error("no encontrado");
}).catch(e=>{
    console.log(e);
this.isNew=true;
const messageisNew= document.getElementById("messageisNew");
if(messageisNew)messageisNew.classList.add("d-none");
}).finally(()=>{if(searchId)searchId.classList.add("d-none");});
}
validardatos(){
let id_=(document.getElementById('id_')).value;
let name_user=(document.getElementById('name_user')).value;
let cell_user=(document.getElementById('cell_user')).value;
let correo_user=(document.getElementById('correo_user')).value;
let dir_user=(document.getElementById('dir_user')).value;
let comentarios=(document.getElementById('textadd')).value;
if(this.isBogota)
{
if(!this.checkLocalidad()){
document.getElementById("rlocalidad").classList.remove("d-none");
return false;
}else{
dir_user+=". Localidad= "+this.checkLocalidad().locale.label;      
document.getElementById("rlocalidad").classList.add("d-none");
}
}

this.pay_user.id= id_;
this.pay_user.usuario=name_user;
this.pay_user.cell= cell_user;
this.pay_user.email= correo_user;
this.pay_user.coment=comentarios;
this.pay_user.dir= dir_user;
this.pay_user.ciudad= this.ciudad;
// console.log('datos del pagador', this.pay_user);
if(id_.length>3){
document.getElementById("rid_").classList.add("d-none");
this.data_user.id=true;
}
else {
document.getElementById("rid_").classList.remove("d-none");
this.data_user.id=false;
}
if(name_user.length>3){
document.getElementById("rname_user").classList.add("d-none");
this.data_user.name=true;
}
else {
document.getElementById("rname_user").classList.remove("d-none");
this.data_user.name=false;
}
if(this.validateCell(cell_user)){
document.getElementById("rcell_user").classList.add("d-none");
this.data_user.cell=true;
}
else {
document.getElementById("rcell_user").classList.remove("d-none");
this.data_user.cell=false;
}
const v2=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo_user);
if(v2){
document.getElementById("rcorreo_user").classList.add("d-none");
this.data_user.email=true;
}
else {
document.getElementById("rcorreo_user").classList.remove("d-none");
this.data_user.email=false;
}
if(dir_user.length>4){
document.getElementById("rdir_user").classList.add("d-none");
this.data_user.dir=true;
}
else {
document.getElementById("rdir_user").classList.remove("d-none");
this.data_user.dir=false;
}
if(!this.isPlaceSelected)
{
this.dep=null;
this.ci=null;
this.ciudades=[];
const m= document.getElementById("messageubication");
m.classList.remove("d-none");
m.innerHTML="<small style='color: #E91E63; font-size: 1rem'>Por favor selecciona la ciudad.<small>"   
}else{
const m= document.getElementById("messageubication");
m.innerHTML=""  
m.classList.add("d-none");
}
if(this.data_user.email){document.getElementById("rcorreo_user").classList.add("d-none");}
else {document.getElementById("rcorreo_user").classList.remove("d-none");}
if(this.data_user.cell){document.getElementById("rcell_user").classList.add("d-none");}
else {document.getElementById("rcell_user").classList.remove("d-none");}
if(this.data_user.name){document.getElementById("rname_user").classList.add("d-none");}
else {document.getElementById("rname_user").classList.remove("d-none");}
if(this.data_user.id){document.getElementById("rid_").classList.add("d-none");}
else {document.getElementById("rid_").classList.remove("d-none");}
if(dir_user.length>4){document.getElementById("rdir_user").classList.add("d-none");}
else {document.getElementById("rdir_user").classList.remove("d-none");}
if(this.getSubTotal()>20000 && this.isPlaceSelected && dir_user.length>4 && this.data_user.name && this.data_user.cell
&& this.data_user.email && this.data_user.id )return true;
else return false;
}
checkLocalidad(){
return JSON.parse(localStorage.getItem("locale"));
}

/**
 * Disminuye la cantidad de un producto del carrito o lo elimina
 * @param {*} i índice del producto que está en el carrito
 * @param {*} option opción
 */
removerProducto(i,option=0){
const producto= this.carrito[i];
this.removeCart(producto.producto)
if(option==1){
// console.log('ciudad',this.ciudad,'departamento',this.departamento);
this.updateTax();
this.searchTax(this.ciudad,this.departamento);
}
}
updateTax(){
    this.cupon=0;
this.descuentos=0;
const mcupon= document.getElementById("messagecupon");
if(mcupon)mcupon.innerHTML=`<small > Vuelve a ingresar el cupón </small>`;
}
showInfo() {
const formatter = new Intl.NumberFormat('en-US', {
style: 'currency',
currency: 'USD',
minimumFractionDigits: 0
})
const money=formatter.format(this.total);  
const options = { opacity: 1 ,'progressBar': true };
// this.toastrService.info(`¡Producto Añadido! Sub Total ${money}`,'MEGAPLEX STARS' , options);

const msg= `¡Producto Añadido! Sub Total ${money}`;
alert(msg);

}
loadProducts(p,option){
this.productos=p;
this.categorys=[];
// this.productos.forEach(p=>p.qr=1);
// this.productos.forEach(p=>p.descuento=25); 
const grupos= groupByMap(this.productos, p=>p.category);
for (let index = 0; index < grupos.length; index++) {
const c = grupos[index];
this.categorys.push({nombre: c[0], total:c[1].length})
}
this.categorys.push({nombre: "TODAS", "total":this.productos.length});


const list=  this.productos.filter(function(item){
    return item.descuento > 0
    || item.promo==1
    });


for (let index = 0; index < list.length; index++) {
if(index<9)this.promos.push(list[index]);
else this.promos= []
}


this.bestsale= this.productos.filter(function(item){
    return item.bestsale==1
    });
    
this.productosTemp= this.productos;
this.max= this.productos.reduce((a, b)=> a.valor > b.valor ? a: b).valor;
this.min= this.productos.reduce((a, b)=> a.valor < b.valor ? a: b).valor;
if(option){
switch (option) {
case "1":
this.selectCategory('PÉRDIDA DE GRASA');
break;
case "2":
this.selectCategory('MÓDULOS PROTEICOS');
break;
case "3":
this.selectCategory('AMINOÁCIDOS Y ENERGÍA');
break;
case "4":
this.selectCategory('HIPERCALÓRICOS');
break;
case "5":
this.selectCategory('SNACKS');
break;
case "6":
this.findProduct("NITRO SHOCK");
break;
case "7":
this.findProduct("FIT");
break;
case "8":
this.selectCategory("ACCESORIOS");
break;
case "10":
this.findProduct("MEGAPLEX MASS");
break;
case "12":
this.selectCategory('NUTRICIÓN GENERAL');
break;
default:
this.findProduct("BIPRO");
break;
}
}else{
// #region <name of my region> 
const h= setTimeout(()=>{
const targets = document.querySelectorAll('[data-img]');
const lazyLoad=target=>{
const io= new IntersectionObserver( entries => {
let item= entries[0].target;
if ( entries[0].isIntersecting === true ) {
const src = item.getAttribute('data-img');
item.classList.add('fadeIn');
item.setAttribute('src', src);
// io.disconnect();
} 
}
);
io.observe(target);
}
targets.forEach(lazyLoad);
clearTimeout(h);
},10);
// #endregion  
}
} 
validateCell(celular) {
const v= new String(celular);
if(v.length==10 && v.startsWith('3')) return true;
else return false;
}
    
validate(event, field){
let value=event.target.value;
// console.log(value);
switch(field){
case 2:
const v=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
if(v){
//
document.getElementById("remail").classList.add("d-none");
this.validate_registrer.email=true;
}
else {
document.getElementById("remail").classList.remove("d-none");
value="";
this.validate_registrer.email=false;
}
break;
case 3:
if(value.length>5){
//
document.getElementById("rpass").classList.add("d-none");
}
else {
document.getElementById("rpass").classList.remove("d-none");
value="";
}
break;
case 4:
const pass= document.getElementById('contraseña').value;
if(value.match(pass)){
//
document.getElementById("rpassg").classList.add("d-none");
this.validate_registrer.pass=true;
}
else {
document.getElementById("rpassg").classList.remove("d-none");
value="";
this.validate_registrer.pass=false;
}
break;
case 11:
if(value.length>3){
//
document.getElementById("rid_").classList.add("d-none");
this.data_user.id=true;
this.searchClient(value);
}
else {
document.getElementById("rid_").classList.remove("d-none");
value="";
this.data_user.id=false;
}
break;
case 12:
if(value.length>3){
//
document.getElementById("rname_user").classList.add("d-none");
this.data_user.name=true;
}
else {
document.getElementById("rname_user").classList.remove("d-none");
value="";
this.data_user.name=false;
}
break;
case 13:
if(this.validateCell(value)){
//
document.getElementById("rcell_user").classList.add("d-none");
this.data_user.cell=true;
}
else {
document.getElementById("rcell_user").classList.remove("d-none");
value="";
this.data_user.cell=false;
}
break;
case 14:
const v2=/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
if(v2){
//
document.getElementById("rcorreo_user").classList.add("d-none");
this.data_user.email=true;
}
else {
document.getElementById("rcorreo_user").classList.remove("d-none");
value="";
this.data_user.email=false;
}
break;
case 15:
if(value.length>3){
//
document.getElementById("rdir_user").classList.add("d-none");
this.data_user.dir=true;
}
else {
document.getElementById("rdir_user").classList.remove("d-none");
value="";
this.data_user.dir=false;
}
break;
}
}
message(){
this.listProductos=[];
this.carrito.forEach(p=>{
this.listProductos.push({producto:p.producto, valor:p.total, cantidad:p.cantidad });
});
this.validardatos();
if(this.data_send.value>0)this.listProductos.push({producto:"FLETE", valor:this.data_send.value, cantidad:1 });
if(this.cupon>0)this.listProductos.push({producto:"CUPÓN DE DESCUENTO "+this.dataCupon.valor+" "+this.dataCupon.descuento+"%", valor:-this.getDes(), cantidad:1 });
const message= `Hola soy ${this.pay_user.usuario}, mi número de documento es  ${this.pay_user.id}, deseo realizar el siguiente pedido ` +this.listProductos.map(p=>{
return ` ${p.cantidad} ${p.producto} \n`;}).toString();
const h= setTimeout(()=>{
window.open(`https://api.whatsapp.com/send?phone=573013422308&text=${message.replace(/ /g, "%20")}`, '_blank'); 
clearTimeout(h);
},500);
}


}



