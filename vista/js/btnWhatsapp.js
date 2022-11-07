const starWhatsapp = () => {
    const message = () => {
        const message = `Hola, le escribo desde su sitio web  `;
        window.open(`https://api.whatsapp.com/send?phone=573013422308&text=${message.replace(/ /g, "%20")}`, '_blank');
    }
    let mql = window.matchMedia('(min-width: 760px)');
    const btnWhatsapp = document.createElement("img");
    const span = document.createElement("span");
    const style = document.createElement("style");
    btnWhatsapp.setAttribute("src", "/img/iconwhatsapp.webp");
    btnWhatsapp.setAttribute("height", 64);
    btnWhatsapp.setAttribute("width", 64);
    btnWhatsapp.setAttribute("loading", "lazy");
    btnWhatsapp.setAttribute("alt", "mensaje whatsapp");
    span.setAttribute("id", "btn-whatsapp")
    span.style.position = "fixed";
    span.style.right = "3%";
    span.style.bottom = "7%";
    span.style.zIndex = 3;

    btnWhatsapp.style.height = "auto";
    btnWhatsapp.style.maxWidth = "100%";
    btnWhatsapp.style.filter = "drop-shadow(rgba(0, 0, 0, .7) 5px 5px 8px)";
    btnWhatsapp.style.cursor = "pointer";
    btnWhatsapp.onclick = message;

    span.appendChild(btnWhatsapp);
    style.innerHTML = `
    @media screen and (min-width: 600px){#btn-whatsapp{cursor:pointer}#btn-whatsapp::before{content:'¿En qué podemos ayudarte?';-webkit-transition:opacity .3s ease, -webkit-clip-path .2s ease;transition:opacity .3s ease, -webkit-clip-path .2s ease;transition:clip-path .2s ease, opacity .3s ease;transition:clip-path .2s ease, opacity .3s ease, -webkit-clip-path .2s ease;position:absolute;top:50%;left:-385%;-webkit-transform:translateY(-50%);transform:translateY(-50%);background-color:rgba(0,0,0,0.938);color:white;padding:.5rem;opacity:0;border-radius:6px;z-index:-5;-webkit-clip-path:polygon(100% 0, 100% 0%, 100% 100%, 100% 100%);clip-path:polygon(100% 0, 100% 0%, 100% 100%, 100% 100%)}#btn-whatsapp::after{content:'';-webkit-transition:opacity .4s ease;transition:opacity .4s ease;position:absolute;top:50%;-webkit-transform:translateY(-50%) rotate(180deg);transform:translateY(-50%) rotate(180deg);right:60px;border-style:solid;border-color:transparent rgba(0,0,0,0.938) transparent transparent;border-width:5px 5px 5px 0px;opacity:0;z-index:-5}#btn-whatsapp:hover::after{z-index:3;opacity:1}#btn-whatsapp:hover::before{z-index:3;opacity:1;-webkit-clip-path:polygon(0 0, 100% 0%, 100% 100%, 0% 100%);clip-path:polygon(0 0, 100% 0%, 100% 100%, 0% 100%)}}
`;
    document.querySelector("head").appendChild(style);
    document.querySelector("body").appendChild(span);
}

starWhatsapp();