export default class SharedTransition{
	/**
	 * 
	 * @param {string} container contenedor de la imagen de origen
	 * @param {string} details contenedor de la imagen de destino
	 */
constructor(container, details){
this.container= container;
this.details= details;	
this.container.forEach(x => x.addEventListener('click', this.sharedImageTransition));
this.details.addEventListener('click', this.sharedImageTransition);
}
sharedImageTransition() {

const body = document.querySelector('body');
const states = Array.from(document.querySelectorAll('.state'));

body.classList.toggle("noscroll");
// source coordinates
const source = this.querySelector('.shared');
const sourceCoords = source.getBoundingClientRect();
const sourceRadius = getComputedStyle(source).borderRadius;

// creating the dummy node
const dummy = source.cloneNode();
delete dummy.dataset.imgbaner;
dummy.className = 'dummy';

for (let attrb in sourceCoords) {
dummy.style.setProperty(`${attrb}`, `${sourceCoords[attrb]}px`);
}



dummy.style.position = 'fixed';
dummy.style.zIndex='99999';
dummy.style.borderRadius = sourceRadius;
dummy.style.transition = 'all .3s ease-out';

body.appendChild(dummy);

// destination coordinates
let dest;
if (source.dataset.dest) {
dest = document.querySelector(`[data-source='${source.dataset.dest}']`);
} else {
dest = document.querySelector('.next.state .shared');
dest.dataset.dest = source.dataset.source;
// const title = this.querySelector('h4').textContent;
// document.querySelector(`.next.state .name`).textContent = title;
}

const destCoords = dest.getBoundingClientRect();
const destRadius = getComputedStyle(dest).borderRadius;



// swap state
states.forEach( x => {
x.classList.toggle('next');
x.classList.toggle('present');
});

// removing the dummy node after transition
dummy.addEventListener('transitionend', function(e){
dest.src = this.src;
if (body.contains(this)) body.removeChild(this);
});

// move
for (let attrb in destCoords) {
dummy.style.setProperty(`${attrb}`, `${destCoords[attrb]}px`);
}
dummy.style.borderRadius = destRadius;
}
}

