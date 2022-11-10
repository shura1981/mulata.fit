const find= document.querySelector(".autocomplete");
if(find){
find.innerHTML=`
<input id="myInput" autocomplete="off" type="text" name="myCountry"  class="searchinput" placeholder="Buscar Producto" required>
`;

function autocomplete(inp, arr) {
  const check= (value)=> value!=null ? value : '';
/*the autocomplete function takes two arguments,
the text field element and an array of possible autocompleted values:*/
var currentFocus;
/*execute a function when someone writes in the text field:*/
inp.addEventListener("input", function(e) {
var a, b, i, val = this.value;
/*close any already open lists of autocompleted values*/
closeAllLists();
if (!val) { return false;}
currentFocus = -1;
/*create a DIV element that will contain the items (values):*/
a = document.createElement("DIV");
a.setAttribute("id", this.id + "autocomplete-list");
a.setAttribute("class", "autocomplete-items");
/*append the DIV element as a child of the autocomplete container:*/
this.parentNode.appendChild(a);
const exp=new RegExp(val, "gi");
/*check if the item starts with the same letters as the text field value:*/
const response = arr.filter(p=>p.producto.match(exp) || check(p.keyfind).includes(val.toLowerCase()));
response.forEach( k => {
/*create a DIV element for each matching element:*/
b = document.createElement("DIV");
b.style="display: flex; justify-content:flex-start; align-items: center;";
/*make the matching letters bold:*/
let li= `
<img src="${k.images.small}" height="36px" style="margin-right: 4px;">
<span>
<strong> ${k.producto.substr(0, val.length)} </strong>${ k.producto.substr(val.length)}
`;
b.innerHTML =li;
// b.innerHTML += arr[i].producto.substr(val.length);
/*insert a input field that will hold the current array item's value:*/
b.innerHTML += "<input type='hidden' value='" + k.producto + "'> </span>";
/*execute a function when someone clicks on the item value (DIV element):*/
b.addEventListener("click", function(e) {
/*insert the value for the autocomplete text field:*/
inp.value = this.getElementsByTagName("input")[0].value;
const item= arr.find(p=>p.producto===inp.value);
if(item)window.location=  `https://nutramerican.com/producto/${item.ruta}` ;
/*close the list of autocompleted values,
(or any other open lists of autocompleted values:*/
closeAllLists();
});
a.appendChild(b);
});







});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
var x = document.getElementById(this.id + "autocomplete-list");
if (x) x = x.getElementsByTagName("div");
if (e.keyCode == 40) {
/*If the arrow DOWN key is pressed,
increase the currentFocus variable:*/
currentFocus++;
/*and and make the current item more visible:*/
addActive(x);
} else if (e.keyCode == 38) { //up
/*If the arrow UP key is pressed,
decrease the currentFocus variable:*/
currentFocus--;
/*and and make the current item more visible:*/
addActive(x);
} else if (e.keyCode == 13) {
/*If the ENTER key is pressed, prevent the form from being submitted,*/
e.preventDefault();
if (currentFocus > -1) {
/*and simulate a click on the "active" item:*/
if (x) x[currentFocus].click();
}
}
});
function addActive(x) {
/*a function to classify an item as "active":*/
if (!x) return false;
/*start by removing the "active" class on all items:*/
removeActive(x);
if (currentFocus >= x.length) currentFocus = 0;
if (currentFocus < 0) currentFocus = (x.length - 1);
/*add class "autocomplete-active":*/
x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
/*a function to remove the "active" class from all autocomplete items:*/
for (var i = 0; i < x.length; i++) {
  x[i].classList.remove("autocomplete-active");
}
}
function closeAllLists(elmnt) {
/*close all autocomplete lists in the document,
except the one passed as an argument:*/
var x = document.getElementsByClassName("autocomplete-items");
for (var i = 0; i < x.length; i++) {
  if (elmnt != x[i] && elmnt != inp) {
  x[i].parentNode.removeChild(x[i]);
}
}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
closeAllLists(e.target);
});
}
const query=async(url)=>{
const res= await fetch(url, {
method: "GET",
headers: {
'Content-Type': 'application/json',
"Authorization": "Basic " + btoa("ck_dbc029e06ebfe7f689b2fe4b8bd78c5a279a7b1b:cs_488c93c99a9179787587f46b3bb25fdc3fc7ed0c")
}});
if(!res.ok) {
const {status, ok} = res;
const msg= await res.json()
return {status, ok, msg};
}
return await res.json();
}
(async()=>{
var response= await query("https://nutramerican.com/api_MegaplexStar/api/webservice.php/v2/findProducts?user=ck_dbc029e06ebfe7f689b2fe4b8bd78c5a279a7b1b&pass=cs_488c93c99a9179787587f46b3bb25fdc3fc7ed0c");
var productos= await response;
autocomplete(document.getElementById("myInput"), productos);

const automobile= document.querySelector(".autocompletamobile");
if(automobile){
  automobile.innerHTML=`<input id="myInput2" class="searchinput" type="text" name="myCountry" placeholder="Buscar Producto" required>`
  autocomplete(document.getElementById("myInput2"), productos);
}

}
)()

}








