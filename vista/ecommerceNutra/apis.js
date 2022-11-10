import { query, queryPost,  Post} from './fetch.js';
import  { groupByMap } from './utils.js';
const  getProduct= async(producto)=>{
try {
return await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/v2/producto?ruta=${producto}`)
} catch (error) {
throw error;
}
}
const getProductsCategory= async(category,code)=>{
try {
return await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/samecategory/products?categoria=${category}&codigo=${code}`)
} catch (error) {
throw error;
}
}
const  getProductsHome= async()=>{
try {
const productostemp= sessionStorage.getItem("productshome");
if(productostemp)return  JSON.parse(atob( productostemp));
else {
const products = await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/v2/getproducts/home`)
const save= btoa(JSON.stringify(products))
sessionStorage.setItem("productshome", save);
return products;
}
} catch (error) {
throw error;
}
}
/**
 * api que va en la página de productos, carga todos los productos activos
 */
const  getProductsV2= async()=>{
try {
const productostemp= sessionStorage.getItem("productosmegaplex");
if(productostemp)return  JSON.parse(atob( productostemp));
else {
const products = await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/v3/products`)
const save= btoa(JSON.stringify(products));
sessionStorage.setItem("productosmegaplex", save);
return products;
}
} catch (error) {
throw error;
}
}
const  getProductsPromo= async(producto)=>{
try {
return await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/promosinstagram`)
} catch (error) {
throw error;
}
}
const  getProducts= async()=>{
try {
const productostemp= sessionStorage.getItem("productosmegaplex");
if(productostemp)return  JSON.parse(atob( productostemp));
else {
const products = await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/products`)
const save= btoa(JSON.stringify(products));
sessionStorage.setItem("productosmegaplex", save);
return products;
}
} catch (error) {
throw error;
}
}
const  getApiProducts = async()=>{
try {
const products = await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/products`)
const save= btoa(JSON.stringify(products));
sessionStorage.setItem("productosmegaplex", save);
return products;
} catch (error) {
throw error;
}
}
const  apiProductsPromise = async()=>{
try {
const products = await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/v3/products`)
return products;
} catch (error) {
throw error;
}
}
const  checkProducts = async()=>{
try {
const temp= localStorage.getItem("carrito");
let List=[];
if(temp){
const carritoTemp= JSON.parse(atob(temp)); 
const result=groupByMap(carritoTemp, p=>p.producto.producto);
result.forEach(p => {
let cantidad=0;
p[1].forEach(element => {
cantidad+=element.cantidad;
});
const item={producto: p[0], cantidad: cantidad, valor:p[1][0].valor ,total: (cantidad* p[1][0].valor), img:p[1][0].producto.img};
List.push(item);
});
}
const productos= List.map(p=>{ return p.producto});
const link= `https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/check/products`;
// const link= 'http://localhost/servidor/nutramerican/api_MegaplexStar/api/webservice.php/check/products';
const products = await  Post(link, productos)
return products;
} catch (error) {
throw error;
}
}
const  findProducts = async(productos)=>{
try {
const link= `https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/check/products`;
// const link= 'http://localhost/servidor/nutramerican/api_MegaplexStar/api/webservice.php/check/products';
const products = await  Post(link, productos)
return products;
} catch (error) {
throw error;
}
}
const  flete= async(ciudad, departamento)=>{
try {
return await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/fletes?ciudad=${ciudad}&departamento=${departamento}`)
} catch (error) {
throw error;
}
}
const  cupon= async(value)=>{
try {
return await query(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/cupon?cupon=${value}`)
} catch (error) {
throw error;
}
}
const  pedido= async(body)=>{
try {
return await queryPost(`https://www.nutramerican.com/api_MegaplexStar/api/webservice.php/PedidosCallCenter`, body)
} catch (error) {
throw error;
}
}
const  servientrega= async()=>{
try {
return await query(`ciudades/tb_servientrega.json`)
} catch (error) {
throw error;
}
}
const  getClient= async(id_cliente)=>{
try {
const r=await fetch(`https://www.elitenutritiongroup.com/api_eliteN/api/webservice.php/clientes?cliente=${id_cliente}`)
return await r.json();
} catch (error) {
throw error;
}
}



export {
getProduct,
getProductsCategory,
getProductsHome,
getProductsV2,
getProductsPromo,
getProducts,
getApiProducts,
apiProductsPromise,
flete,
cupon,
pedido,
servientrega,
getClient,
checkProducts,
findProducts
}





