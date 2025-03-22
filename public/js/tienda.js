const list_element = document.getElementById('list');
const pagination_element = document.querySelectorAll('.pagination');
let current_page = 1;
let rows = 12;
var total_p = 0;
const asingCounter = value => {
  const contadores = document.querySelectorAll(".counter");
  contadores.forEach(contador => {
    contador.textContent = value;
  })
}
const clamp = (text, totalChars) => {
  return (text.length > totalChars && IsMobil()) ? text.substring(0, totalChars) + "..." : text;

}
const ordenar = function (a, b) {
  var titleA = a.producto.toLowerCase(), titleB = b.producto.toLowerCase();
  if (titleA < titleB) return -1;
  if (titleA > titleB) return 1;
  return 0;
};

const startCart = () => {
  const btnadd = document.querySelectorAll("[data-add]");
  const btnshop = document.querySelectorAll("[data-shop]");
  const btninfo = document.querySelectorAll("[data-info]");
  const showInfo = (producto) => {
    document.querySelector(".toast-body").textContent = producto;
    let basicInstance = mdb.Toast.getInstance(document.getElementById("basic-primary-example"));
    basicInstance.show();
  }
  const groupByMap = (list, keyGetter) => {
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
  const getValue = (producto) => {
    return Math.round(producto.valor - ((producto.valor * producto.descuento) / 100));
  }
  const addCart = (item) => {
    carrito = getcar();
    carrito.push(item);
    const result = groupByMap(carrito, p => p.producto.producto);
    let List = [];
    result.forEach(p => {
      let cantidad = 0;
      p[1].forEach(element => {
        cantidad += element.cantidad;
      });
      const item = { producto: p[0], cantidad: cantidad, valor: p[1][0].valor, total: (cantidad * p[1][0].valor), img: p[1][0].producto.img };
      List.push(item);
    });
    total = List.reduce((acumulado, item) => acumulado + item.total, 0);
    cantidad = List.reduce((acumulado, item) => acumulado + item.cantidad, 0);
    const save = btoa(JSON.stringify(carrito))
    localStorage.setItem("carrito", save);
    asingCounter(carrito.length)
  }
  if (btnadd) {
    btnadd.forEach(btn => {
      btn.addEventListener("click", e => {
        let codigo = 0;
        if (e.target.nodeName === "I") codigo = e.target.parentNode.dataset.add
        else codigo = e.target.dataset.add;
        const producto = tempProductos.find(p => p.codigo == codigo);
        addCart({ producto: { producto: producto.producto, img: producto.images.small, valor: producto.valor, descuento: producto.descuento }, cantidad: 1, valor: getValue(producto) });
        showInfo(producto.producto);
      });
    })
  }
  if (btnshop) {
    btnshop.forEach(btn => {
      btn.addEventListener("click", e => {
        let codigo = e.target.dataset.shop;
        const producto = tempProductos.find(p => p.codigo == codigo);
        addCart({ producto: { producto: producto.producto, img: producto.images.small, valor: producto.valor, descuento: producto.descuento }, cantidad: 1, valor: getValue(producto) });
        location.href =  host + "ecommerceNutra/checkout/index.html";
      });
    })
  }
  if (btninfo) {
    btninfo.forEach(btn => {
      btn.addEventListener("click", e => {
        let codigo = 0;

       
        console.log(e.target, e.target.parentNode.parentNode );
        if (e.target.nodeName === "I") codigo = e.target.parentNode.dataset.info
        else codigo = e.target.dataset.info;

         if(e.target.classList.contains("mask"))codigo= e.target.parentNode.parentNode.dataset.info;

        console.log(codigo);
        if(codigo==0 || codigo== undefined)return null;
        
        const producto = tempProductos.find(p => p.codigo == codigo);
        const cerrar = () => {
          document.querySelector("body").classList.remove("noscroll")
          document.querySelector(".info-modal").classList.remove("show-info-modal")
        }

        //<img src="${producto.imageswebp.medium}" class="img-flui" alt="${producto.producto}"  >
        const div = `
<div class="container">
<div class="row">
<div class="col-12">

<div
style="--swiper-navigation-color: rgb(0, 102, 255); --swiper-pagination-color: #fff; position: relative;" class="swiper mySwiper3">
<div class="swiper-wrapper" >
<div class="swiper-slide">
<a  href="${producto.imageswebp.bigger}" target="_blank">
<img  data-index="0"  src="${producto.imageswebp.medium}"   alt="${producto.producto}" >
</a>
</div>
<div class="swiper-slide">
<a href="${producto.tablasjpg.bigger}" target="_blank">
<img  style="max-width: 100% !important; height: auto !important;" data-index="1"  src="${producto.tablasjpg.medium}" alt="tabla nutricional de ${producto.producto}"  />
</a>
</div>
</div>


<div thumbsSlider="" class="swiper mySwiper1">
<div class="swiper-wrapper" style="width: 40%;">
  <div class="swiper-slide">
    <img src="${producto.imageswebp.small}"  />
    </div>
  <div class="swiper-slide">
  <img src="${producto.tablasjpg.small}"  />
  </div>
</div>
</div>

</div>
</div>
</div>

<div class="d-flex justify-content-center mt-3 mb-5 mb-md-0 mt-md-5">
<button data-shop="${producto.codigo}" type="button" class="btn btn-card-info-shop me-2 mb-1">
Comprar
</button>
<button data-add="${producto.codigo}"  type="button" class="btn btn-card-info-add  px-3  mb-1">
<i class="fas fa-cart-plus"></i> Añadir
<span class="d-none d-md-inline-block"> al carrito </span>
</button>
</div>
`
        document.getElementById("img-info").innerHTML = div;

        var swiper1 = new Swiper(".mySwiper1", {
          spaceBetween: 5,
          slidesPerView: 4,
          freeMode: true,
          watchSlidesProgress: true,
        });

        var swiper2 = new Swiper(".mySwiper3", {
          loop: false,
          spaceBetween: 5,
          effect: "cube",
          grabCursor: true,
          autoplay: {
            delay: 4500,
            disableOnInteraction: true,
          },
          cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 1,
            shadowScale: 0.54,
          },
          thumbs: {
            swiper: swiper1,
          }
        });

        const btnadd = document.getElementById("img-info").querySelector("[data-add]");
        const btnshop = document.getElementById("img-info").querySelector("[data-shop]");
        btnadd.addEventListener("click", e => {
          let codigo = 0;
          if (e.target.nodeName === "I") codigo = e.target.parentNode.dataset.add
          else codigo = e.target.dataset.add;
          const producto = tempProductos.find(p => p.codigo == codigo);
          addCart({ producto: { producto: producto.producto, img: producto.images.small, valor: producto.valor, descuento: producto.descuento }, cantidad: 1, valor: getValue(producto) });
          showInfo(producto.producto);
          cerrar();
        });
        btnshop.addEventListener("click", e => {
          let codigo = e.target.dataset.shop;
          const producto = tempProductos.find(p => p.codigo == codigo);
          addCart({ producto: { producto: producto.producto, img: producto.images.small, valor: producto.valor, descuento: producto.descuento }, cantidad: 1, valor: getValue(producto) });
          location.href = host+"ecommerceNutra/checkout/index.html";
          cerrar();

        });
        const detail = `
<h4> ${producto.producto}</h4>
<h3> ${formatter.format(getValue(producto)).replace(",", ".")}</h3>
<div>
${producto.description}
</div>

`
        document.getElementById("body-info").innerHTML = detail;
        document.querySelector("body").classList.add("noscroll")
        document.querySelector(".info-modal").classList.add("show-info-modal")
      });
    })
  }




}
const IsMobil = () => {
  if (navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
  ) {
    return true;
  }
  else {
    return false;
  }
}
const loadingfixed = () => {
  if (grid === false) {
    if (IsMobil()) {
      fixedHeigth();
    } else {
      const h = this.setTimeout(() => {
        fixedHeigth();
        clearTimeout(h);
      }, 300);
    }
  }
}
function DisplayList(items, wrapper, rows_per_page, page) {
  wrapper.innerHTML = "";
  page--;
  let start = rows_per_page * page;
  let end = start + rows_per_page;
  let paginatedItems = items.slice(start, end);
  for (let i = 0; i < paginatedItems.length; i++) {
    let item = paginatedItems[i];
    let item_element = document.createElement('div');
    if (grid) {
      item_element.classList.remove('col-12');
      item_element.classList.add('col-lg-4', 'col-6', 'mb-4');
      item_element.innerHTML = ` 
<div class="card h-100">
<div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
​<img class="img-fluid" loading="lazy" height="400" width="400"  src="${item.imageswebp.medium}"       alt="${item.producto}">
<a arial-label="${item.producto}"  data-info="${item.codigo}"  >
<div   class="mask">
<div class="d-flex justify-content-start align-items-end h-100">
${(() => {
          if (item.descuento > 0) {
            return ` <h5><span class="badge bg-danger ms-2">-${item.descuento}%</span></h5>`
          } else return ''
        })()
        }
</div>
</div>
<div class="hover-overlay">
<div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
</div>
</a>
</div>
<div class="card-body">
<div>
<div class="card-title">
<h5 class="">${clamp(item.producto, 15)}</h5>
</div>
<span class="text-reset">
${(() => {
          if (item.descuento == 0) {
            return `<p>${formatter.format(item.valor).replace(",", ".")}</p>`;
          } else return '';
        })()
        }
</span>
${(() => {
          if (item.descuento > 0) {
            return `<h6 class="mb-3">
<s>${formatter.format(item.valor).replace(",", ".")}</s><strong class="ms-2 text-danger">${getValue(item)}</strong>
</h6>`
          } else return ''
        })()
        }
</div>

<div class="d-flex d-md-none justify-content-center">
<button aria-label="comprar" data-shop="${item.codigo}" type="button" class="btn btn-primary me-1 mb-1 btn-sm" >
Comprar
</button>
<button aria-label="añadir al carrito" data-add="${item.codigo}" type="button" class="btn btn-danger px-3 me-1 mb-1 btn-sm" >
<i class="fas fa-cart-plus"></i>
</button>
</div>
<div class="d-none d-md-flex justify-content-center">
<button aria-label="comprar" data-shop="${item.codigo}" type="button" class="btn btn-primary me-1 mb-1">
Comprar
</button>
<button aria-label="añadir al carrito"  data-add="${item.codigo}" type="button" class="btn btn-danger px-3 me-2 mb-1">
<i class="fas fa-cart-plus"></i>
</button>
<button aria-label="vista rápida" data-info="${item.codigo}" type="button" class="btn btn-danger px-3 mb-1">
<i class="fas fa-search"></i>
</button>
</div>

</div>
</div>

`;
    } else {
      item_element.classList.remove('col-lg-4', 'col-6', 'mb-4');
      item_element.classList.add('col-12');
      item_element.innerHTML = `
<div class="flip-card my-3">
<div class="flip-card-inner">
<div class="flip-card-front" >
<div class="card card-body c">
<div class="media d-block d-md-flex">
<a arial-label="${item.producto}" class="ripple" >
​<picture>
<source alt="${item.producto}" srcset="${item.imageswebp.medium}" type="image/webp" >
<img class="d-flex  mb-md-0 mb-3 img-list"  src="${item.images.medium}"      alt="${item.producto}">
</picture>
</a>
<div class="media-body text-left ml-md-3 ml-0 px-3">
<h3 > ${item.producto}  </h3>
<p> ${item.intro}</p>
<a  class="text-reset">
${(() => {
          if (item.descuento == 0) {
            return `<p>${formatter.format(item.valor).replace(",", ".")}</p>`;
          } else return '';
        })()
        }
</a>
${(() => {
          if (item.descuento > 0) {
            return `<h6 class="mb-3">
<s>${formatter.format(item.valor).replace(",", ".")}</s><strong class="ms-2 text-danger">${getValue(item)}</strong>
</h6>`
          } else return ''
        })()
        }
<div class="d-flex d-md-none text-left align-items-center">
<button aria-label="comprar" data-shop="${item.codigo}" type="button" class="btn btn-primary me-1 mb-1 btn-sm" >
Comprar
</button>
<button aria-label="añadir al carrito" data-add="${item.codigo}" type="button" class="btn btn-danger px-3 me-1 mb-1 btn-sm " >
<i class="fas fa-cart-plus"></i>
</button>
<span class="flex-grow-1"> </span>
<span onclick="flip(${i})"> 
<small >Ver Tabla</small><i  class="fas fa-undo ms-1 "></i>
</span>
</div>
<div class="d-none d-md-flex text-left">
<button aria-label="comprar" data-shop="${item.codigo}" type="button" class="btn btn-primary me-1 mb-1">
Comprar
</button>
<button aria-label="añadir al carrito" data-add="${item.codigo}" type="button" class="btn btn-danger px-3 me-1 mb-1">
<i class="fas fa-cart-plus"></i>
</button>
  </div>

</div>
</div>
</div>
</div>
<div class="flip-card-back card" >
<div class="panel-back">
<h3 class="text-center"> Tabla nutricional de ${item.producto}  </h3>
<img  onclick="showDialog('${item.tablasjpg.bigger}')"  src="${item.tablasjpg.medium}"   class="img-flip "  />
<small class="text-center">Toca la imagen para ampliar </small>
</div>
<i onclick="flipReset(${i})" class="fas fa-undo back"></i>
</div>
</div>
</div>

`;
    }


    wrapper.appendChild(item_element);
  }
  startCart();
}
function SetupPagination(items, wrappers, rows_per_page) {
  wrappers.forEach(wrapper => {
    //#region
    wrapper.innerHTML = "";
    let buttonPrev = document.createElement('li');
    buttonPrev.classList.add("page-item");
    let Ap = document.createElement("a");
    Ap.setAttribute("href", "#")
    Ap.classList.add("page-link", "next");
    Ap.innerText = "Anterior";
    buttonPrev.appendChild(Ap);
    buttonPrev.addEventListener('click', function () {
      if (current_page > 1) {
        current_page--;
      }
      console.log(current_page);
      DisplayList(items, list_element, rows, current_page);
      lazyLoad();
      let current_btn = document.querySelectorAll('.page-item.active');
      current_btn.forEach(btn => {
        btn.classList.remove('active');
      })
      pagination_element.forEach(pagination => {
        const btnstart = pagination.querySelectorAll(".page-item");
        btnstart[current_page].classList.add('active');
      });
      loadingfixed()
    });
    wrapper.appendChild(buttonPrev);
    let page_count = Math.ceil(items.length / rows_per_page);
    total_p = page_count;
    // console.log("total page",page_count);
    for (let i = 1; i < page_count + 1; i++) {
      let btn = PaginationButton(i, items);
      wrapper.appendChild(btn);
    }
    let buttonNext = document.createElement('li');
    buttonNext.classList.add("page-item");
    let A = document.createElement("a");
    A.setAttribute("href", "#")
    A.classList.add("page-link", "next");
    A.innerText = "Siguiente";
    buttonNext.appendChild(A);
    buttonNext.addEventListener('click', function () {
      if (current_page < total_p) {
        current_page++;
      }
      console.log(current_page);
      DisplayList(items, list_element, rows, current_page);
      lazyLoad();
      let current_btn = document.querySelectorAll('.page-item');
      current_btn.forEach(btn => {
        btn.classList.remove('active');
      })
      pagination_element.forEach(pagination => {
        const btnstart = pagination.querySelectorAll(".page-item");
        btnstart[current_page].classList.add('active');
      });


      loadingfixed()
    });
    wrapper.appendChild(buttonNext);

    //#endregion  
  });




}
function PaginationButton(page, items) {
  let button = document.createElement('li');
  button.classList.add("page-item");
  let A = document.createElement("a");
  A.setAttribute("href", "#")
  A.classList.add("page-link");
  A.innerText = page;
  button.appendChild(A);
  if (current_page == page) button.classList.add('active');
  button.addEventListener('click', function () {
    current_page = page;
    DisplayList(items, list_element, rows, current_page);
    lazyLoad();
    let current_btn = document.querySelectorAll('.page-item.active');
    current_btn.forEach(btn => {
      btn.classList.remove('active');
    })
    button.classList.add('active');
    loadingfixed();
  });

  return button;
}
const getValue = (item) => {
  return formatter.format(Math.round(item.valor - ((item.valor * item.descuento) / 100))).replace(",", ".")
}
const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 0
})
var grid = true, isLoadZoom = false;
const bestsales = document.getElementById("bestsales");
productos.filter(p => p.bestsale > 0).sort(ordenar).slice(0, 5).forEach(item => {
  bestsales.innerHTML += `
  <li data-info="${item.codigo}"   class="list-group-item media">
                                    <img src="${item.imageswebp.small}" height="64" width="64">
                                    <div class="media-item">
                                        <p>${item.producto} </p>
                                        ${(() => {
      if (item.descuento == 0) {
        return `<p>${formatter.format(item.valor).replace(",", ".")}</p>`;
      } else return '';
    })()
    }
                                </span>
                                ${(() => {
      if (item.descuento > 0) {
        return `<h6 class="mb-3">
                                <s>${formatter.format(item.valor).replace(",", ".")}</s><strong class="ms-2 text-danger">${getValue(item)}</strong>
                                </h6>`
      } else return ''
    })()
    }
                                    </div>
                                </li>
  
  `;


});


DisplayList(productos, list_element, rows, current_page);
SetupPagination(productos, pagination_element, rows);
const listToogle = document.querySelectorAll(".list");
listToogle.forEach(e => {
  e.addEventListener("click", () => {
    // if(IsMobil())    document.querySelector(".background").classList.remove("d-none");
    grid = false;
    DisplayList(productos, list_element, rows, current_page);
    // lazyLoad();
    loadingfixed();
    if (!isLoadZoom) loadZoom();


  })
});
const gridToogle = document.querySelectorAll(".grid");
gridToogle.forEach(e => {
  e.addEventListener("click", () => {
    // if(IsMobil())    document.querySelector(".background").classList.remove("d-none");
    grid = true;
    DisplayList(productos, list_element, rows, current_page);
    lazyLoad();
    // const h= this.setTimeout(() => {
    //   if(IsMobil())  document.querySelector(".background").classList.add("d-none");
    //   clearTimeout(h);
    //   }, 200);
  })
});
const flip = (index) => {
  const flipCards = document.querySelectorAll(".flip-card-inner");
  const card = flipCards[index];
  card.style.transform = "rotateY(180deg)";
}
const flipReset = (index) => {
  const flipCards = document.querySelectorAll(".flip-card-inner");
  const card = flipCards[index];
  card.style.transform = "rotateY(0deg)";
}
const fixedHeigth = () => {
  const flipCards = document.querySelectorAll(".flip-card-inner");
  const flipFront = document.querySelectorAll(".c");
  const flipBack = document.querySelectorAll(".flip-card-back");
  for (let j = 0; j < flipFront.length; j++) {
    const front = flipFront[j];
    const height = front.offsetHeight;
    const back = height;
    flipCards[j].style.height = `${height}px`;
    flipBack[j].style.height = `${back}px`;
  }
}
const showDialog = (i) => {
  // console.log(i);
  const el = document.querySelector(".img-dialog");
  el.classList.remove("d-none");
  const div = document.querySelector(".content-img");
  document.getElementById("zoom").setAttribute("src", i);

}
const lazyLoad = () => {
  const options = {
    threshold: 0,
    rootMargin: "0px 0px -100px 0px"
  }
  const targets = document.querySelectorAll('[data-imgbaner]');
  const lazyLoad = target => {
    const io = new IntersectionObserver(entries => {
      let item = entries[0].target;
      if (entries[0].isIntersecting === true) {
        const src = item.getAttribute('data-imgbaner');
        item.setAttribute('src', src);
        item.addEventListener("load", (evt) => {
          item.classList.add("fadeIn");
        });
        io.disconnect();
      }
    }, options);
    io.observe(target);
  }
  targets.forEach(lazyLoad);
}
const findModulosProteicos = () => {
  productos = tempProductos.filter(p => p.category == "MÓDULOS PROTEICOS");
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findperderpeso = () => {
  productos = tempProductos.filter(p => p.category == "PÉRDIDA DE GRASA");
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findhipercaloricos = () => {
  productos = tempProductos.filter(p => p.category == "HIPERCALÓRICOS");
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findnutriciong = () => {
  productos = tempProductos.filter(p => p.category == "NUTRICIÓN GENERAL");
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findenergia = () => {
  productos = tempProductos.filter(p => p.category == "AMINOÁCIDOS Y ENERGÍA");
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findsnacks = () => {
  productos = tempProductos.filter(p => p.category == "SNACKS");
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const bipro = () => {
  const exp = new RegExp("bipro", "gi");
  productos = tempProductos.filter(p => p.producto.match(exp));
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findall = () => {
  productos = tempProductos;
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findobjperdergrasa = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 10202612 ||
      item.codigo == 100505 ||
      item.codigo == 100520 ||
      item.codigo == 100542 ||
      item.codigo == 101505 ||
      item.codigo == 101515 ||
      item.codigo == 102007 ||
      item.codigo == 103023 ||
      item.codigo == 103022 ||
      item.codigo == 100540 ||
      item.codigo == 100514 ||
      item.codigo == 100517

  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findobjwomen = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 100517 || item.codigo == 103030 ||
      item.codigo == 10202612 ||
      item.codigo == 102033 ||
      item.codigo == 102060 ||
      item.codigo == 100520 ||
      item.codigo == 102061

  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findctgmodulos = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 100520 ||
      item.codigo == 100518 ||
      item.codigo == 100505 ||
      item.codigo == 100507 ||
      item.codigo == 100542 ||
      item.codigo == 102060 ||
      item.codigo == 102007 ||
      item.codigo == 102011 ||
      item.codigo == 102061 ||
      item.codigo == 102021 ||
      item.codigo == 102033
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findctghiper = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 101070 ||
      item.codigo == 101075 ||
      item.codigo == 101005 ||
      item.codigo == 101010 ||
      item.codigo == 101015 ||
      item.codigo == 100542 ||
      item.codigo == 102060 ||
      item.codigo == 102011 ||
      item.codigo == 102012 ||
      item.codigo == 100518
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findobjdefinicion = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 10202612 ||
      item.codigo == 100520 ||
      item.codigo == 100514 ||
      item.codigo == 100510 ||
      item.codigo == 100512 ||
      item.codigo == 100542 ||
      item.codigo == 102061 ||
      item.codigo == 102033
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findobjmantenimiento = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 103022 ||
      item.codigo == 103023 ||
      item.codigo == 102007 ||
      item.codigo == 103040 ||
      item.codigo == 102061 ||
      item.codigo == 100510 ||
      item.codigo == 100505 ||
      item.codigo == 100507 ||
      item.codigo == 100542
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findcrossfit = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 102060 ||
      item.codigo == 102021 ||
      item.codigo == 102033 ||
      item.codigo == 100518 ||
      item.codigo == 101075 ||
      item.codigo == 100514 ||
      item.codigo == 100542 ||
      item.codigo == 102061
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const findpesas = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 102060 ||
      item.codigo == 100522 ||
      item.codigo == 100520 ||
      item.codigo == 100505 ||
      item.codigo == 100507 ||
      item.codigo == 100510 ||
      item.codigo == 100512 ||
      item.codigo == 100518 ||
      item.codigo == 100514 ||
      item.codigo == 100542 ||
      item.codigo == 102033 ||
      item.codigo == 102021 ||
      item.codigo == 100540 ||
      item.codigo == 103040 ||
      item.codigo == 102061 ||
      item.codigo == 102007


  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();

}
const findbailoterapia = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 102060 ||
      item.codigo == 102033 ||
      item.codigo == 102061 ||
      item.codigo == 102007 ||
      item.codigo == 102033 ||
      item.codigo == 102011 ||
      item.codigo == 102012 ||
      item.codigo == 101515 ||
      item.codigo == 101505 ||
      item.codigo == 10202612
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();

}
const findpilates = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 100522 ||
      item.codigo == 100520 ||
      item.codigo == 100507 ||
      item.codigo == 100510 ||
      item.codigo == 103040 ||
      item.codigo == 103040 ||
      item.codigo == 100540214 ||
      item.codigo == 1005402 ||
      item.codigo == 102061 ||
      item.codigo == 103022 ||
      item.codigo == 100512
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();


}
const findresistencia = () => {
  productos = tempProductos.filter(item => {
    return item.codigo == 101015 ||
      item.codigo == 100507 ||
      item.codigo == 102060 ||
      item.codigo == 100542 ||
      item.codigo == 102011 ||
      item.codigo == 102012 ||
      item.codigo == 102033 ||
      item.codigo == 102061 ||
      item.codigo == 102021 ||
      item.codigo == 101075
  });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();

}
const findValue = (value) => {
  const exp = new RegExp(value, "gi");
  productos = tempProductos.filter(p => p.producto.match(exp));
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
  return productos.length;
}
const all = document.querySelectorAll(".all");
all.forEach(item => {
  item.addEventListener("click", () => {
    reset();
    findall();
    ocultar();
  })
});
document.getElementById("ctgmodulos").addEventListener("click", () => {
  reset();
  findModulosProteicos();
  ocultar();
})
document.getElementById("ctgpederpeso").addEventListener("click", () => {
  reset();
  findperderpeso();
  ocultar();
})
document.getElementById("ctghiper").addEventListener("click", () => {
  reset();
  findhipercaloricos();
  ocultar();
})
document.getElementById("ctgpenergia").addEventListener("click", () => {
  reset();
  findenergia();
  ocultar();
})
document.getElementById("ctgsnacks").addEventListener("click", () => {
  reset();
  findsnacks();
  ocultar();
})
document.getElementById("ctgnutricion").addEventListener("click", () => {
  reset();
  findnutriciong();
  ocultar();
})
// document.getElementById("objmantenimiento").addEventListener("click",()=>{
//   reset();
// findobjmantenimiento();
// ocultar();
// });
// document.getElementById("objtsubirpeso").addEventListener("click",()=>{
//   reset();
//   findctghiper();
//   ocultar();
// });
// document.getElementById("objperdergrasa").addEventListener("click",()=>{
//   reset();
// findobjperdergrasa();
// ocultar();
// });
// document.getElementById("objaumentom").addEventListener("click",()=>{
//   reset();
// findctgmodulos();
// ocultar();
// });
// document.getElementById("objdefinicion").addEventListener("click",()=>{
//   reset();
// findobjdefinicion();
// ocultar();
// });
document.getElementById("crossfit").addEventListener("click", () => {
  reset();
  findcrossfit();
  ocultar();
});
document.getElementById("resistencia").addEventListener("click", () => {
  reset();
  findresistencia();
  ocultar();
});
document.getElementById("pesas").addEventListener("click", () => {
  reset();
  findpesas();
  ocultar();
});
document.getElementById("autocarga").addEventListener("click", () => {
  reset();
  findobjdefinicion();
  ocultar();
});
document.getElementById("bailoterapia").addEventListener("click", () => {
  reset();
  findbailoterapia();
  ocultar();
});
document.getElementById("pilates").addEventListener("click", () => {
  reset();
  findpilates();
  ocultar();
});
const reset = () => {
  window.scrollTo(0, 0);
  grid = true;
  current_page = 1;
}
const show = () => {
  const panel = document.querySelector(".fondo");
  if (panel) {
    panel.classList.remove("d-none");
    document.querySelector(".filtermobile").style.left = "0px";
    document.querySelector("body").classList.add("noscroll");

    const resultados = document.querySelector(".resultados");
    const totalr = document.getElementById("totalr");
    if (resultados) resultados.classList.add("d-none")
    if (totalr) totalr.textContent = "";
  }

}
const ocultar = () => {
  const panel = document.querySelector(".filtermobile");
  if (panel) {
    panel.style.left = "-100%";
    document.querySelector(".fondo").classList.add("d-none");
    document.querySelector("body").classList.remove("noscroll");
    document.getElementById("search").value = "";
  }
}
const filterbyexpensive = () => {
  productos = tempProductos.sort(function (a, b) { return a.valor - b.valor; });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const filterbycheap = () => {
  productos = tempProductos.sort(function (a, b) { return b.valor - a.valor; });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const filterpromos = () => {
  productos = tempProductos.sort(function (a, b) { return b.promo - a.promo; });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}
const filterbydefault = () => {
  productos = tempProductos.sort(function (a, b) { return a.orden - b.orden; });
  DisplayList(productos, list_element, rows, current_page);
  SetupPagination(productos, pagination_element, rows);
  lazyLoad();
}


var carrito = [];
let total = 0, cantidad = 0;
const getcar = () => {
  const localcart = localStorage.getItem("carrito");
  return localcart ? JSON.parse(atob(localcart)) : [];
}

window.addEventListener("orientationchange", function (event) {
  console.log("the orientation of the device is now xx" + event.target.screen.orientation.angle);
  const angle = event.target.screen.orientation.angle;
  if (angle == 90) {
    console.log("landscape");

  }
  const h = this.setTimeout(() => {
    fixedHeigth();
    clearTimeout(h);
  }, 100);
});
window.addEventListener("DOMContentLoaded", () => {
  lazyLoad();
  const background = document.querySelector(".background");
  background.classList.add("clip-path");
  document.querySelector("body").classList.remove("noscroll");
  background.addEventListener("transitionend", function (event) { background.classList.add("d-none"); }, false);
  let mql = window.matchMedia('(max-width: 760px)');
  function myFunction(x) {
    if (x.matches) { // If media query matches
      var swiper2 = new Swiper(".mySwiper2", {
        loop: false,
        // spaceBetween: 5,
        grabCursor: true,
        autoplay: {
          delay: 4500,
          disableOnInteraction: true,
        },
        cubeEffect: {
          shadow: true,
          slideShadows: true,
          shadowOffset: 1,
          shadowScale: 0.54,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }
      });
    } else {
      var swiper = new Swiper(".mySwiper", {
        loop: false,
        autoplay: {
          delay: 4500,
          disableOnInteraction: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        }, pagination: {
          el: ".swiper-pagination",
          clickable: true,
        }, grabCursor: true,
        effect: "creative",
        creativeEffect: {
          prev: {
            shadow: true,
            translate: [0, 0, -400],
          },
          next: {
            translate: ["100%", 0, 0],
          },
        },
      });
    }
    x.onchange = () => {
      console.log("cambia");
      myFunction(x);
    }
  }
  // myFunction(mql);
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
    effect: 'creative',
    creativeEffect: {
      prev: {
        // will set `translateZ(-400px)` on previous slides
        translate: [0, 0, -400],
      },
      next: {
        // will set `translateX(100%)` on next slides
        translate: ['100%', 0, 0],
      },
    },
  });

  swiper2.on('click', function () {
    const link = clickSwiper[this.activeIndex];
    location.href = link;
  });

  // cargarAsesoria();

  // Carrito
  // carrito= getcar();
  // asingCounter(carrito.length)
})
document.getElementById("btnfilter").addEventListener("click", () => {
  show()
})
document.querySelector(".fondo").addEventListener("click", () => {
  ocultar()
})
const options = {
  "Mayor precio": filterbycheap,
  "Más económico": filterbyexpensive,
  "Promociones": filterpromos,
  "Por defecto": filterbydefault
}
const selectElement = document.querySelectorAll('.select');
selectElement.forEach(option => {
  option.addEventListener('change', (event) => {
    reset();
    options[event.target.value]();
  });
})
document.getElementById("search").addEventListener("keyup", (e) => {
  const value = document.getElementById("search").value;
  grid = true;
  current_page = 1;
  const resultados = document.querySelector(".resultados");
  const totalr = document.getElementById("totalr");

  if (value.length > 0) {
    const total = findValue(value);
    if (resultados) resultados.classList.remove("d-none")
    if (totalr) totalr.textContent = total;
    //
  } else {
    findall();
    if (resultados) resultados.classList.add("d-none")
    if (totalr) totalr.textContent = "";
    ocultar();
  }


});
const getUrlParameter = (name) => {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};
const filterQueryParam = {
  modulosproteicos: findModulosProteicos,
  perdidapeso: findperderpeso,
  hipercaloricos: findhipercaloricos,
  nutriciongeneral: findnutriciong,
  energiarecuperacion: findenergia,
  snacks: findsnacks,
  bipro: bipro,
  women: findobjwomen
}
var category = getUrlParameter('category');
if (category) filterQueryParam[category]();



const cerrarInfo = () => {
  document.querySelector("body").classList.remove("noscroll")
  document.querySelector(".info-modal").classList.remove("show-info-modal");
}

// chat asesoría
const loadScript = src => {
  return new Promise(function (resolve, reject) {
    const s = document.createElement('script');
    let r = false;
    s.type = 'text/javascript';
    s.src = src;
    s.defer = true;
    s.onerror = function (err) {
      reject(err, s);
    };
    s.onload = s.onreadystatechange = function () {
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
    link.onload = function () {
      resolve("ok");
      console.log("style has loaded");
      //Can add setTimeout to attempt to wait for the styles to be applied to DOM
    };
    link.href = url;
    document.getElementsByTagName("head")[0].appendChild(link);
  });
}
const cargarAsesoria = () => {
  fetch("../asesoriaModal.html?v=3")
    .then(r => r.text())
    .then(body => {
      document.getElementById("chat").innerHTML += body;
      fetchStyle("../css/chatAsesoriaModal.css?v=1");
      loadScript("../js/chatAsesoriaModal.js?v=1");
      const btnAsesoria = document.getElementById("btn-asesoria");
      const closeChat = document.getElementById("closechat");
      const chatModal = document.querySelector(".chat-modal");
      closeChat.addEventListener("click", () => {
        document.querySelector("body").classList.remove("noscroll");
        chatModal.classList.remove("show-chat-modal");
        clearChat();
      });
      btnAsesoria.addEventListener("click", () => {
        chatModal.classList.add("show-chat-modal")
        document.querySelector("body").classList.add("noscroll");
      });
      const closeModal = document.querySelectorAll(".close-modal");
      closeModal.forEach(btn => {
        btn.addEventListener("click", (e) => {
          document.querySelector("body").classList.remove("noscroll");
          chatModal.classList.remove("show-chat-modal")
          clearChat();
        });
      })
    });
}


const loadZoom = () => {
  loadScript("https://nutramerican.com/js/pinch-zoom.umd.min.js").then(r => {
    isLoadZoom = true;
    console.log("c..");
    const div = document.querySelector(".content-img");
    new PinchZoom.default(div, {});
    const dialogSearch = document.querySelector(".pinch-zoom-container");
    if (dialogSearch) {
      dialogSearch.addEventListener("click", function (e) {
        if (e.target !== this) return;
        document.querySelector(".img-dialog").classList.add("d-none");
      });
    }
  })
}



const clickSwiper = {
  0: "https://nutramerican.com/producto/biproclassic_pinacolada3l",
  1: "https://nutramerican.com/producto/burnerstacklata",
  2: "https://nutramerican.com/producto/myth"
}





// 

