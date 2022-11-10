const groupByMap =(list, keyGetter)=> {
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
const loadScript = src => {
return new Promise(function(resolve, reject) {
const s = document.createElement('script');
let r = false;
s.type = 'text/javascript';
s.src = src;
s.defer = true;
s.onerror = function(err) {
reject(err, s);
};
s.onload = s.onreadystatechange = function() {
// console.log(this.readyState); // uncomment this line to see which ready states are called.
if (!r && (!this.readyState || this.readyState == 'complete')) {
r = true;
resolve("ok");
}
};
const t = document.getElementsByTagName('script')[0];
t.parentElement.insertBefore(s, t);
});
}
const fetchStyle = (url) => {
//https://stackoverflow.com/questions/574944/how-to-load-up-css-files-using-javascript
return new Promise((resolve, reject) => {
let link = document.createElement("link");
link.type = "text/css";
link.rel = "stylesheet";
link.onload = function() {
resolve("ok");
console.log("style has loaded");
//Can add setTimeout to attempt to wait for the styles to be applied to DOM
};
link.href = url;
document.getElementsByTagName("head")[0].appendChild(link);
});
    }
const getDate=()=>{
const today = new Date();
const d = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate(); 
const t = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
return {
fecha: d,
hora: t    
};   
}
export { groupByMap, loadScript,fetchStyle,getDate }






//#region
// this.subject.subscribe({
// next: (v) => console.log(`observerA: ${v}`)
// });
// this.subject.subscribe({
// next: (v) => console.log(`observerB: ${v}`)
// });
// this.subject.next(1);
// this.subject.next(2);

//#endregion

