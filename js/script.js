const swiper = new Swiper('.swiper', {
  // Optional parameters
 direction: 'horizontal',
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  }
  
});
console.log(swiper); // See if it's being initialized properly

(() => {
  const form = document.querySelector('[data-validate]');
  if (!form) return;                                   // pagina nu are formular

  const rules = {
    email   : v => /^[\w.-]+@[\w.-]+\.[a-z]{2,}$/i.test(v),
    password: v => v.length >= 6,
    name    : v => v.trim().length >= 2,
    message : v => v.trim().length >= 10
  };

  const setError = (inp, txt) => {
    inp.classList.add('is-invalid');
    let s = inp.nextElementSibling;
    if (!s || !s.classList.contains('error')) {
      s = document.createElement('small');
      s.className = 'error';
      inp.after(s);
    }
    s.textContent = txt;
  };

  const clear = () => {
    form.querySelectorAll('.is-invalid').forEach(i => i.classList.remove('is-invalid'));
    form.querySelectorAll('small.error').forEach(e => e.remove());
  };

  form.addEventListener('submit', e => {
    clear();
    let ok = true;
    form.querySelectorAll('[data-rule]').forEach(inp => {
      const r = inp.dataset.rule;
      if (rules[r] && !rules[r](inp.value)) {
        ok = false;
        setError(inp, inp.dataset.msg || 'Ongeldige invoer');
      }
    });
    if (!ok) e.preventDefault();
  });
})();

(() => {
  const root = document.querySelector('[data-price-root]');
  if (!root) return;

  const one   = +root.dataset.price;
  const tax   = +root.dataset.tax || 0;
  const sel   = root.querySelector('#persons');
  const out   = root.querySelector('#totalPrice');
  const fmt   = n => n.toLocaleString('nl-NL', {style:'currency',currency:'EUR',minimumFractionDigits:0});

  const update = () => out.textContent = fmt(one * +sel.value + tax);
  sel.addEventListener('change', update);
  update();
})();

(() => {
  const input = document.querySelector('#searchTo');
  if (!input) return;

  const BOX = document.createElement('ul');
  BOX.className = 'autocomplete-box';
  document.body.append(BOX);

  const DATA = ['Costa Brava','Costa Blanca','Cyprus','Sicilië','Malta','Antalya','Marokko','Turkije','Griekenland'];

  const pos = () => {
    const r = input.getBoundingClientRect();
    BOX.style.cssText = `position:absolute;left:${r.left}px;top:${r.bottom + scrollY}px;width:${r.width}px;z-index:9999`;
  };
  addEventListener('resize', pos); addEventListener('scroll', pos);

  input.addEventListener('input', () => {
    const q = input.value.trim().toLowerCase();
    BOX.innerHTML = '';
    if (!q) return;
    DATA.filter(d=>d.toLowerCase().includes(q)).slice(0,6).forEach(d=>{
      const li=document.createElement('li'); li.textContent=d;
      li.onclick=()=>{ input.value=d; BOX.innerHTML=''; };
      BOX.append(li);
    });
    pos();
  });
  input.addEventListener('blur', () => setTimeout(()=>BOX.innerHTML='',150));
})();

/* ---------- 4. PREVIEW ADMIN (trip-create.php) --------------- */
(() => {
  const pvRoot = document.querySelector('[data-admin-preview]');
  if (!pvRoot) return;

  pvRoot.innerHTML = `
    <div class="aanbieding-card groot" style="max-width:400px;margin:auto">
      <img id="pv-img" src="images/placeholder.jpg" alt="">
      <div class="aanbieding-info">
        <h3 id="pv-title">Titel</h3>
        <p id="pv-price">€0</p>
      </div>
    </div>`;

  const tIn = document.querySelector('input[name="titel"]');
  const pIn = document.querySelector('input[name="prijs"]');
  const iIn = document.querySelector('input[name="afbeelding"]');

  const tEl = pvRoot.querySelector('#pv-title');
  const pEl = pvRoot.querySelector('#pv-price');
  const iEl = pvRoot.querySelector('#pv-img');

  const sync = () => {
    tEl.textContent = tIn.value || 'Titel';
    pEl.textContent = pIn.value ? `€${parseFloat(pIn.value).toFixed(0)}` : '€0';
    iEl.src         = iIn.value ? `images/${iIn.value}` : 'images/placeholder.jpg';
  };
  [tIn,pIn,iIn].forEach(i=>i && i.addEventListener('input', sync));
  sync();
})();

const style = document.createElement('style');
style.textContent = `
.autocomplete-box{background:#fff;border:1px solid #ddd;max-height:180px;
                  overflow-y:auto;list-style:none;margin:0;padding:0}
.autocomplete-box li{padding:6px 10px;cursor:pointer}
.autocomplete-box li:hover{background:#f3f7ff}
.is-invalid{border-color:#d22}
small.error{color:#d22;font-size:12px}
`;
document.head.append(style);
