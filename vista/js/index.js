
// import SharedTransition from './sharedElement.js';
const validate = async () => {
  let login = 'ck_dbc029e06ebfe7f689b2fe4b8bd78c5a279a7b1b';
  let password = 'cs_488c93c99a9179787587f46b3bb25fdc3fc7ed0c';
  let url = 'https://www.megaplexstars.com/api_MegaplexStar/api/webservice.php/getdiscount';
  // let url="https://www.megaplexstars.com/api_MegaplexStar/api/webservice.php/products";
  const header = { headers: new Headers({ "Authorization": `Basic ${btoa(`${login}:${password}`)}` }) }
  const response = await fetch(url, header);
  if (!response.ok) {
    const message = `La consulta no tuvo resultados : ${response.status}`;
    throw new Error(message);
  }
  const empleado = await response.json();
  return empleado;
}
const loadProducts = async () => {
  try {
    const empleado = await validate();
    console.log('empleado', empleado);
  } catch (error) {
    console.log('ocurrió un error', error.message);
  } finally {
    console.log('finaliza');
  }
}
// loadProducts();
const timeClose=300;
const lazyLoad = () => {
  const options = {
    threshold: 0,
    rootMargin: "0px 0px -100px 0px"
  }
  const targets = document.querySelectorAll('[data-imgbaner]');
  const lazy = target => {
    const io = new IntersectionObserver(entries => {
      let item = entries[0].target;
      if (entries[0].isIntersecting === true) {
        const src = item.getAttribute('data-imgbaner');
        item.setAttribute('src', src);
        item.addEventListener("load", (evt) => {
          item.classList.add("fade-in");

        });
        io.disconnect();
      }
    }, options);
    io.observe(target);
  }
  targets.forEach(lazy);







  const titles = document.querySelectorAll('.anim');
  const options2 = {
    rootMargin: "0px 0px -80px 0px"
  }
  const loadObserver = (target) => {
    const observer = new IntersectionObserver((entries) => {
      const entry = entries[0];
      if (entry.isIntersecting == true) {
        entry.target.classList.add('animated');
        observer.disconnect();
      }//else {entry.target.classList.remove('animated');}
    }, options2);
    observer.observe(target);
  }
  titles.forEach(title => {
    title.style.transition = "opacity 1.2s .2s ease,transform 1s  ease";
    title.style.opacity = "0";
    if (title.dataset.direction === 'horizontalright') title.style.transform = "translateX(180px)";
    else if (title.dataset.direction === 'horizontalleft') title.style.transform = "translateX(-180px)";
    else if (title.dataset.direction === 'vericaldown') title.style.transform = "translateY(-80px)";
    else title.style.transform = "translateY(180px)";
    loadObserver(title);
  });
}
const loadElements = () => {
  const options = {
    rootMargin: '0px 0px -200px 0px'
  }

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const transition = entry.target.dataset.observerTransition;
        const delay = entry.target.dataset.observerDelay;
        if (delay != undefined) entry.target.style.transitionDelay = delay;
        entry.target.classList.add(transition);
        observer.unobserve(entry.target);
      } else {
        return;
      }
    })
  }, options);

  document.querySelectorAll("[data-observer-transition]").forEach(el => observer.observe(el))

}
document.addEventListener("DOMContentLoaded", () => {
  // lazyLoad();
  // ControlVideo();
  // const contacts = Array.from(document.querySelectorAll('.contact'));
  // const pic = document.querySelector('.details');
  // // const shared= new SharedTransition(contacts, pic);
  // const cerrar=()=> document.getElementById("imgClose").click();
  // const close = Array.from(document.querySelectorAll('.close'));
  // close.forEach(i=>i.addEventListener("click",cerrar));
  var swiper2 = new Swiper(".mySwiper2", {
    loop: false,
    // spaceBetween: 5,
    grabCursor: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
    },

  });

  swiper2.on('click', function () {
    // const link= clickSwiper[this.activeIndex];
    // location.href= link;
  });

  swiper2.on('slideChange', function () {
    const index = swiper2.realIndex;
    showLabels(index);

  });

  showLabels(0);
  loadElements();
  // document.getElementById("loader").classList.add("d-none");
  // document.querySelector("body").classList.remove("noscroll");
  // const timeline= gsap.timeline({defaults:{duration:1}});
  // timeline.from(".head-1", {x:"100%", stagger: .6, opacity: 0})
  // .from(".line1", {x:"100%", stagger: .6, opacity: 0}, "-=.5")
  // .from("li",{opacity:1, y:"-30px", stagger:0.1},"-=1")

});
function showLabels(index) {
  const titles = document.querySelectorAll("[data-title]");
  const lines = document.querySelectorAll("[data-line]");
  titles.forEach(l => {
    l.style.transitionDuration = "0s";
    l.style.opacity = "0";
    l.classList.add("left");

  });
  lines.forEach(l => {
    l.style.opacity = "0";
    l.style.transitionDelay = "0s";
    l.style.transitionDuration = "0s";
    l.classList.add("left");
  });

  const title = titles[index];
  const line = lines[index];
  if (title != undefined && line != undefined) {
    line.style.opacity = "1";
    title.style.opacity = "1";
    title.style.transitionDuration = ".4s";
    line.style.transitionDuration = ".4s";
    line.style.transitionDelay = ".4s";
    title.classList.remove("left");
    line.classList.remove("left")
  }



}
const post = {
  gluteosAcero: "post1.html",
  instagram1: "post2.html",
  instagram2: "post3.html",
  instagram3: "post4.html",
  instagram4: "post5.html",
  instagram5: "post6.html",
  instagram6: "post7.html",
  instagram7: "post8.html",
  instagram8: "post9.html"
}
function abrirGluteos() {
  const url = host + "instagram/" + post.gluteosAcero + "?v=" + version;
  const urlBuy = dominio + "services/gluteos24kl";
  Swal.fire({
    html: `<iframe   frameborder="0" style=" height:80vh;width:100%"   src=${url}></iframe>`,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      `<i class="fa fa-thumbs-up"></i> Comprar plan `,
    confirmButtonAriaLabel: 'Comprar plan glúteos de acero',
    cancelButtonText:
      '<i class="fas fa-times"></i> Cerrar',
    cancelButtonAriaLabel: 'cancelar'
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire('Saved!', '', 'success')
      const h = setTimeout(() => {
        clearTimeout(h)
        //  window.open(urlBuy);
        // window.open(mensaje, '_blank');
        location.href = urlBuy;
      }, timeClose);
    }
    // else if (result.isDenied) {
    //   Swal.fire('Changes are not saved', '', 'info')
    // }
  })
}
function abrirEntrenamiento() {
  const url = dominio + "services/plan-entrenamiento-zoom";
  const urlImgXl = host + "img/testimonial/servicio_entreno_zoom_xl.webp";
  const urlImgsm = host + "img/testimonial/servicio_entreno_zoom_sm.webp";
  console.log(url);
  Swal.fire({
    html: `
    <div class="container py-3 modal-servicio">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="ratio ratio1x1">
            <picture>
            <source media="(min-width: 600px)" srcset="${urlImgXl}" type="image/webp">
            <img src="${urlImgsm}" class="ratio_img"  alt="Plan 3x7 mulata.fit">
            </picture>
            </div>
        </div>
        <div class="col-12 mt-3">
            <h2 class="mb-3">💢 ENTRENAMIENTOS PERSONALIZADOS POR ZOOM</h2>
            <ul class="list-group list-group-light list-group-small">
            <li class="list-group-item"> <strong>Valor: </strong>200 USD</li>
            <li class="list-group-item"><strong>Días: </strong> 3 veces por semana</li>
            <li class="list-group-item"><strong>El plan incluye: </strong> Rutina para toda la semana, trabajo de cuerpo completo, cardios y recomendación nutricional. </li>
               </ul>
        </div>
    </div>
</div>
    `,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      `  <i class="fa fa-thumbs-up"></i> Comprar plan `,
    confirmButtonAriaLabel: 'Comprar plan glúteos de acero',
    cancelButtonText:
      '<i class="fas fa-times"></i> Cerrar',
    cancelButtonAriaLabel: 'cancelar'
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire('Saved!', '', 'success')
      // window.open(mensaje, '_blank');

      const h = setTimeout(() => {
        clearTimeout(h)
        // window.open(url);
        location.href = url;
      }, timeClose);

    }
    // else if (result.isDenied) {
    //   Swal.fire('Changes are not saved', '', 'info')
    // }
  })
}
function abrirPlanNutricional() {
  const url = dominio + "services/plan-basico";
  const urlImgXl = host + "img/testimonial/servicio3X7_xl.webp";
  const urlImgsm = host + "img/testimonial/servicio3X7_sm.webp";
  Swal.fire({
    html: `
    <div class="container py-3 modal-servicio">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="ratio ratio1x1">
            <picture>
            <source media="(min-width: 600px)" srcset="${urlImgXl}" type="image/webp">
            <img src="${urlImgsm}" class="ratio_img"  alt="Plan 3x7 mulata.fit">
            </picture>
            </div>
        </div>
        <div class="col-12 mt-3">
            <h2 class="mb-3">💢 ASESORÍAS Y RUTINAS PERSONALIZADAS</h2>
            <ul class="list-group list-group-light list-group-small">
            <li class="list-group-item"> <strong>Valor: </strong>75 USD</li>
            <li class="list-group-item"><strong>Duración: </strong> 30 días.</li>
            <li class="list-group-item"><strong>El plan incluye: </strong> Rutina para toda la semana, trabajo de cuerpo completo, cardios y recomendación nutricional. </li>
            <li class="list-group-item">✅Guía de alimentación basada en objetivo, preferencia alimenticias y los requerimientos  calóricos y nutricionales  asociados a ti. </li>
            <li class="list-group-item">✅Seguimientos con fotos medidas y pesos  manteniéndonos informada de resultado y sensaciones.  </li>
            <li class="list-group-item">✅Guía de suplementación con evidencia científica.  </li>
            <li class="list-group-item">✅Entrenamientos con videos explicativos SEGÚN TU PLAN  (casa o gym) adaptados a tu horario y capacidades físicas.</li>
               </ul>
        </div>
    </div>
</div>
    `,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      `  <i class="fa fa-thumbs-up"></i> Comprar plan `,
    confirmButtonAriaLabel: 'Comprar plan glúteos de acero',
    cancelButtonText:
      '<i class="fas fa-times"></i> Cerrar',
    cancelButtonAriaLabel: 'cancelar'
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire('Saved!', '', 'success')
      // window.open(mensaje, '_blank');

      const h = setTimeout(() => {
        clearTimeout(h)
        // window.open(url);
        location.href = url;
      }, timeClose);

    }
    // else if (result.isDenied) {
    //   Swal.fire('Changes are not saved', '', 'info')
    // }
  })
}
function abrirPlanPremiun() {
  const url = dominio + "services/plan-premiun";
  const urlImgXl = host + "img/testimonial/serviciopromo_xl.webp";
  const urlImgsm = host + "img/testimonial/serviciopromo_sm.webp";
  Swal.fire({
    html: `
    <div class="container py-3 modal-servicio">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="ratio ratio1x1">
            <picture>
            <source media="(min-width: 600px)" srcset="${urlImgXl}" type="image/webp">
            <img src="${urlImgsm}" class="ratio_img"  alt="Plan 3x7 mulata.fit">
            </picture>
            </div>
        </div>
        <div class="col-12 my-3">
            <h2 class="mb-3">💢 PROMO ASESORÍAS Y RUTINAS PERSONALIZADAS</h2>
            <ul class="list-group list-group-light list-group-small">
            <li class="list-group-item"> <strong>Valor: </strong>155 USD</li>
            <li class="list-group-item"><strong>Duración: </strong> 3 meses</li>
            <li class="list-group-item"><strong>El plan incluye: </strong> Rutina para toda la semana, trabajo de cuerpo completo, cardios y recomendación nutricional por 3 meses. </li>
            <li class="list-group-item">✅Guía de alimentación basada en objetivo, preferencia alimenticias y los requerimientos  calóricos y nutricionales  asociados a ti. </li>
            <li class="list-group-item">✅Seguimientos con fotos medidas y pesos  manteniéndonos informada de resultado y sensaciones.  </li>
            <li class="list-group-item">✅Guía de suplementación con evidencia científica.  </li>
            <li class="list-group-item">✅Entrenamientos con videos explicativos SEGÚN TU PLAN  (casa o gym) adaptados a tu horario y capacidades físicas.</li>
               </ul>
        </div>
    </div>
</div>
    `,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      `  <i class="fa fa-thumbs-up"></i> Comprar plan `,
    confirmButtonAriaLabel: 'Comprar plan glúteos de acero',
    cancelButtonText:
      '<i class="fas fa-times"></i> Cerrar',
    cancelButtonAriaLabel: 'cancelar'
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire('Saved!', '', 'success')
      // window.open(mensaje, '_blank');

      const h = setTimeout(() => {
        clearTimeout(h)
        // window.open(url);
        location.href = url;
      }, timeClose);

    }
    // else if (result.isDenied) {
    //   Swal.fire('Changes are not saved', '', 'info')
    // }
  })
}

function showModalPopUp() {
  popUpObj = window.open("http://localhost/mulata.fit/vista/js/post1.html",
    "ModalPopUp",
    "width=" + screen.availWidth / 2 + ",height=" + screen.availHeight);
}
function openPost(evt) {
  const p = evt.target.dataset.post;
  const instagram = post[p];
  const url = host + "instagram/" + instagram + "?v=" + version;

  Swal.fire({
    html: `<iframe   frameborder="0" style="height:80vh;width:100%"   src=${url}></iframe>`,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<i class="fa fa-thumbs-up"></i>',
    confirmButtonAriaLabel: 'post',
    cancelButtonText:
      '<i class="fas fa-times"></i> Cerrar',
    cancelButtonAriaLabel: 'cancelar'
  });


}
function openInfo() {
  // const url = host + "videos/preguntas.mp4" + "?v=" + version;
  // const urlPoster = host + "videos/preguntasposter.webp" + "?v=" + version;
  const url = host + "instagram/presentation.html" + "?v=" + version;
  Swal.fire({
    html: `
<div class="container py-3">
    <div class="row">
        <div class="col-12  ">

        <div class="aspec-ratio ratio16x9 rounded shadow-5-strong mb-5">
        <iframe   class="iframe-float rounded shadow-5-strong mb-5"   frameborder="0"     src=${url}></iframe>
     </div>

      

        </div>
        <div class="col-12 text-left">
            <p>
                Creo firmemente en el balance y lo disfruto al máximo con mis hijos,familia y amigos.Olvídate de los numero en la basculas no importa tu trayectoria deportiva juntas podemos lograr nuevos progresos, avances en tu vida mente y cuerpo sin  dietas restrictivas y entrenamientos acordé a tu nivel que disfrutaras al máximo.

            </p>
            <p>


✅<strong> Guía de alimentación basada en objetivo </strong>, preferencia alimenticias y los requerimientos  calóricos y nutricionales  asociados a ti.
<br><br>
✅<strong>seguimientos con fotos medidas y pesos</strong>  manteniéndonos informada de resultado y sensaciones. 
<br><br>
✅<strong>Guía de suplementación con evidencia científica</strong>.
<br> <br>
✅<strong>Entrenamientos con videos explicativos.</strong> SEGÚN TU PLAN  (casa o gym) adaptados a tu horio y capacidades físicas.
<br><br>
✅<strong>#gluteos24kilates</strong> acompañamiento diario grupo privado en  telegram (solo para miembros) donde estaremos  siempre motivándonos y aclarando dudas
<br><br>
✅<strong>#gluteos24kilstes</strong> entrenamientos en vivo todos los sábados (rutina grabada  con vínculo privado para los que no pueden asistir )para que podamos subir de nivel y quemar juntas.
            </p>
        </div>
    </div>
</div>

`,
    showCloseButton: false,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<i class="fa fa-thumbs-up"></i>',
    confirmButtonAriaLabel: 'post',
    cancelButtonText:
      '<i class="fas fa-times"></i> Cerrar',
    cancelButtonAriaLabel: 'cancelar'
  });


}
document.getElementById("btngluteos").addEventListener("click", abrirGluteos);
document.getElementById("asesoria1").addEventListener("click", abrirPlanNutricional);
document.getElementById("btnEntrenamiento").addEventListener("click", abrirEntrenamiento);
document.getElementById("btnPlanPremiun").addEventListener("click", abrirPlanPremiun);
const btnsGrid = document.querySelectorAll("[data-post]");
btnsGrid.forEach(btn => btn.addEventListener("click", openPost))
const btnMulata = document.getElementById("sobremulata");
btnMulata.addEventListener("click", openInfo);

function validateForm() {
  let isDataValid = true;
  let statusMessage = '';

  const name = document.getElementById('name').value;
  if (name == "") {
    statusMessage += `<p class="note note-danger"><strong>Name</strong> cannot be empty</p>`;
    isDataValid = false;
  };

  const email = document.getElementById('email').value;
  if (email == "") {
    statusMessage += `<p class="note note-danger"><strong>Email</strong> cannot be empty</p>`;
    isDataValid = false;
  } else {
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<p>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!re.test(email)) {
      statusMessage += `<p class="note note-danger"><strong>Email</strong> is invalid</p>`;
      isDataValid = false;
    }
  }

  const subject = document.getElementById('subject').value;
  if (subject == "") {
    statusMessage += `<p class="note note-danger"><strong>Subject</strong> cannot be empty</p>`;
    isDataValid = false;
  }
  const message = document.getElementById('message').value;
  if (message == "") {
    statusMessage += `<p class="note note-danger"><strong>Subject</strong> cannot be empty</p>`;
    isDataValid = false;
  }

  return {
    isDataValid,
    statusMessage
  };
}

const form = document.querySelector('form');

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const formData = new FormData(e.target);

  const {
    isDataValid,
    statusMessage
  } = validateForm();

  if (!isDataValid) {
    document.getElementById('status').innerHTML = statusMessage;
    return;
  } else {
    document.getElementById('status').innerHTML = `<p class="note note-light">Sending mail...</p>`;
  }

  const url = `${dominio}mail.php`;
  console.log(url);
  fetch(url, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(response => {
      if (response.code) {
        // If mail was sent successfully, reset the form;
        const values = document.querySelectorAll('.form-control');
        values.forEach(value => {
          value.textContent = '';
        });

        document.getElementById('status').innerHTML =
          `<p class="note note-success">${response.message}</p>`;
        setTimeout(() => {
          document.getElementById('status').innerHTML = '';
        }, 5000)
      } else {
        document.getElementById('status').innerHTML =
          `<p class="note note-danger">${response.message}</p>`;
      }
    })
    .catch((err) => {
      console.log(err.message);
    });
});


