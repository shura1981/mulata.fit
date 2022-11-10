"use strict";
class Revelar{
revelarScroll(pos){
const targetList = document.querySelectorAll(".parallax-container");
targetList.forEach(target => {
target.style.overflow = "hidden";
var top = target.offsetTop;
var height = target.clientHeight;
const offset = ('offset' in target.dataset) ? Number(target.dataset.offset) : 0;
const max = (height + top) - window.outerHeight + offset;
var porcent = ((pos * 100 / max)).toFixed(1);
var point = porcent / 100;
// console.log("pos",pos,"top",top, "height",height, "max",max, "porcent: post*100/max",porcent, "point",point);
const childList = target.querySelectorAll(".parallax-child");
childList.forEach(child => {
let transform = "";    
if (point > 1) {point=1; porcent=100;}
if ('revelarOpacity' in child.dataset){
var opacity=((pos * 100 / max)/100+Number(child.dataset.revelarOpacity)+0.02).toFixed(2);
// console.log("opacity",opacity+Number(child.dataset.revelarOpacity), "point",opacity);
child.style.opacity = `${opacity}`;
}
if ('revelarRotate' in child.dataset){
let angle= (100- porcent+ Number(child.dataset.revelarRotate))<0 ? 0 : (100- porcent+ Number(child.dataset.revelarRotate));
transform += `rotate(${angle}deg) `;
} 
if ('revelarX' in child.dataset){
const direction= Number(child.dataset.revelarX);
let width=0;
if(direction<0) width= direction +  Number(porcent);
else width= direction -  Number(porcent);
transform+=`translateX(${width}%) `;
}
if ('revelarY' in child.dataset){
const direction= Number(child.dataset.revelarY);
let width=0;
if(direction<0) width= direction +  Number(porcent);
else width= direction -  Number(porcent);
transform+=`translateY(${width}%) `;
}
if ('revelarScale' in child.dataset) {
const scale= Number(child.dataset.revelarScale);
if(scale>1)transform += `scale(${scale-point}) `;
else transform += `scale(${Number(child.dataset.revelarScale) +point}) `;
}
if ('ratioY' in child.dataset) {
const ratioY = Number(child.dataset.ratioY);
var yPos = -(pos * ratioY / 100);
// console.log(yPos);
transform += `translate3d(0px,${yPos}px,0px)`;
}
if ('bgY' in child.dataset) {
const ratiobgY = Number(child.dataset.bgY)==0 ? 0.7 : Number(child.dataset.bgY);
var yPos = -(pos * ratiobgY / 100);
console.log(yPos);
child.style.backgroundPositionY = `${yPos}px`;
// child.style.transition= 'background-position 0.5s ease 0.1s';
}
if(transform) child.style.transform= transform;
});
});
}
/**
 *  example
 *  const width= window.scrollX + child.getBoundingClientRect().left // X
 *  const posX= width*porcent/100;
 *  @param {String} el elemento a obtener la posición del scroll 
 */
getOffset(el) {
const rect = el.getBoundingClientRect();
return {
left: rect.left + window.scrollX,
top: rect.top + window.scrollY
};
}
resetScroll() {
window.scrollTo(0, 0);
}
/**
 * Observador de animaciones para imágenes lazy load y elementos del doom
 * @param {String} marginBottom límite en el borde inferior % o px 
 * @param {Boolean} reset si se establece en true solo se ejecuta una vez, por defecto es false
 */
revelarLoad(marginBottom='0px', reset=false){
const options = {
threshold: 0,
rootMargin: `0px 0px ${marginBottom} 0px`
}
const targets = document.querySelectorAll('[data-class-transition]');
const Load = target => {
const io = new IntersectionObserver(entries => {
let item = entries[0].target;
if (entries[0].isIntersecting === true) {
const delay= ('delay' in item.dataset) ?  item.dataset.delay : '0s';
const duration= ('duration' in item.dataset) ?  item.dataset.duration : '0.4s';
const timing= ('timing' in item.dataset) ?  item.dataset.timing : 'ease';
item.style.transitionDelay= delay;
item.style.transitionDuration= duration;
item.style.transitionTimingFunction= timing;
if (item.nodeName === "IMG") {
const src = item.getAttribute('data-img');
item.addEventListener("load", (evt) => item.classList.add(item.dataset.classTransition));
item.setAttribute('src', src);
}
else item.classList.add(item.dataset.classTransition);    
if(reset)io.disconnect();
} else  {
item.style.transitionDelay= '0s';
item.style.transitionTimingFunction= 'ease-out';
item.classList.remove(item.dataset.classTransition)
}
}, options);
io.observe(target);
}
targets.forEach(Load);
}
listenElement(el,style,increment=0){
const target= document.querySelector(el);
var top = target.offsetTop;
var height= target.clientHeight
window.addEventListener('scroll', function (e) {
const value= (top+height+increment)<this.pageYOffset ? true: false;
if(value) target.classList.add(style);
else target.classList.remove(style);
// console.log(value);
});
}
loadIframe(marginBottom="0px") {
const options = {
threshold: 0,
rootMargin: `0px 0px ${marginBottom} 0px`
}
const targets = document.querySelectorAll('[data-src]');
const lazyLoad = target => {
const io = new IntersectionObserver(entries => {
let video = entries[0].target;
if (entries[0].isIntersecting === true) {
video.setAttribute("src",video.dataset.src);
io.disconnect();
}
}, options
);
io.observe(target);
}
targets.forEach(lazyLoad);
}
constructor(){
window.onbeforeunload =this.resetScroll
}
listenScroll(){
const revelar= this;
window.addEventListener('scroll', function (e) {
revelar.revelarScroll(this.pageYOffset);
} );
}
iframeVideo(){
const options = {
threshold: 0,
rootMargin: "0px 0px 200px 0px"
}
const targets = document.querySelectorAll('[data-src]');
const lazyLoad = target => {
const io = new IntersectionObserver(entries => {
let video = entries[0].target;
if (entries[0].isIntersecting === true) {
video.setAttribute("src",video.dataset.src);
console.log('carga...');
io.disconnect();
}
}, options
);
io.observe(target);
}
targets.forEach(lazyLoad);
}

scrollVideo(marginBottom="0px"){
const options = {
threshold: 0,
rootMargin: `0px 0px ${marginBottom} 0px`
}
const targets = document.querySelectorAll('[data-video]');
const lazyLoad = target => {
const io = new IntersectionObserver(entries => {
let video = entries[0].target;
if (entries[0].isIntersecting === true) {
// video.innerHTML=`<source src="${video.dataset.video}" type="video/mp4">`;  
// console.log(video.dataset.video);
if (video.dataset.load === 'false') video.src = video.dataset.video;
video.muted = true;
const playPromise = video.play();
if (playPromise !== undefined) {
playPromise.then(_ => {
// Automatic playback started!
// Show playing UI.
// We can now safely pause video...
video.dataset.load = 'true';
video.dataset.canpause = 'true';
if ('poster' in video.dataset) {
const poster = video.dataset.poster;  // console.log(poster);
video.style.zIndex = "1";
const img = document.querySelector(`.play-video[data-preload="${video.dataset.preload}"]`);
if(img) img.classList.add("active");
}
}) .catch(error =>console.log(error));
}
}
else {
if (video.dataset.canpause == 'true') video.pause();
}
}, options
);
io.observe(target);
}
targets.forEach(lazyLoad);
}
playVideo(){
const containerVideos= document.querySelectorAll(".play-video");
containerVideos.forEach(v=>{
v.addEventListener("click",e=>{
e.stopPropagation();
if(e.target.nodeName==="DIV"){
const id= e.target.dataset;
e.target.classList.add("active");
const video = document.querySelector(`video[data-preload="${id.preload}"]`);
video.src= video.dataset.video;
video.muted=false;
video.controls=true;
video.play();
video.style.zIndex="2";
}
});  
});
}
}

// const revelar= new Revelar()
// revelar.listenScroll();
// revelar.revelarLoad("-100px")
// revelar.listenElement("nav","show",300);
// revelar.loadIframe();
// revelar.scrollVideo();
// revelar.playVideo();