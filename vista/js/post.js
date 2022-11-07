// const dominio="https://rutinatotal.proteina.fit/blog/"
const link=`${dominio}${path}`;
const popupFacebook=()=>{
const url= `https://www.facebook.com/sharer/sharer.php?u=${link}`;
window.open(url,'facebook-share-dialog', 'width=626,height=436'); 
}
const shareWhatsapp=()=>{
const mensaje=description;
const url=`https://api.whatsapp.com/send?text=${link} ${mensaje}`;
window.open(url); 
}
const shareMobile=()=>{
if ( navigator.share ) {
navigator.share({
url: link,
title: title,
text: description
});
}
}
const popupTwirer=()=>{
const url= `https://twitter.com/intent/tweet?url=${link}&text=${title}`;
window.open(url,'twitter-share-dialog', 'width=626,height=436');
}
const popupLike=()=>{
const url= `https://www.linkedin.com/shareArticle?mini=true&url=${link}&title=${title}`;
window.open(url,'linkedin-share-dialog','width=626,height=436'); 
}

const facebook=document.getElementById("facebook");
if(facebook)
{
facebook.addEventListener("click",(evt)=>{
popupFacebook();
});
}
const twitter=document.getElementById("twitter");
if(twitter){
twitter.addEventListener("click",(evt)=>{
popupTwirer();
});
}
const linkedin=document.getElementById("linkedin"); 
if(linkedin){
linkedin.addEventListener("click",(evt)=>{
popupLike();
});

}
const whatsapp=document.getElementById("whatsapp");
if(whatsapp){
whatsapp.addEventListener("click",(evt)=>{
shareWhatsapp();
});    
}

const share= document.getElementById("share");
if(share){
share.addEventListener("click",(evt)=>{
console.log("se ejecuta");
shareMobile();
});
}
const lazyLoad= ()=>{
const options={
threshold:0,
rootMargin:"0px 0px -100px 0px"
}
const targets = document.querySelectorAll('[data-imgbaner]');
const lazyLoad=target=>{
const io= new IntersectionObserver( entries => {
let item= entries[0].target;
if ( entries[0].isIntersecting === true ) {
const src = item.getAttribute('data-imgbaner');
item.classList.add("fade-in");
item.setAttribute('src', src);
item.addEventListener("load",(evt)=>{});
io.disconnect();
} 
},options);
io.observe(target);
}
targets.forEach(lazyLoad);
}
lazyLoad();
