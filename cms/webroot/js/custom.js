(function () {
    var themeStorageKey = 'siscarThemeMode';

    function setTheme(themeMode) {
        var html = document.documentElement;

        html.setAttribute('data-theme-mode', themeMode);
        html.setAttribute('data-bs-theme', themeMode);
        html.setAttribute('data-header-styles', themeMode);
        html.setAttribute('data-menu-styles', themeMode);

        if (themeMode === 'light') {
            html.removeAttribute('data-bg-theme');
            html.style.removeProperty('--body-bg-rgb');
            html.style.removeProperty('--body-bg-rgb2');
            html.style.removeProperty('--light-rgb');
            html.style.removeProperty('--form-control-bg');
            html.style.removeProperty('--input-border');
            localStorage.removeItem('menodarktheme');
        } else {
            localStorage.setItem('menodarktheme', 'true');
        }

        localStorage.setItem('menoMenu', themeMode);
        localStorage.setItem('menoHeader', themeMode);
        localStorage.removeItem('bodylightRGB');
        localStorage.removeItem('bodyBgRGB');
        localStorage.setItem(themeStorageKey, themeMode);
    }

    function toggleTheme() {
        var html = document.documentElement;
        var currentTheme = html.getAttribute('data-theme-mode') === 'dark' ? 'dark' : 'light';
        setTheme(currentTheme === 'dark' ? 'light' : 'dark');
    }

    var savedTheme = localStorage.getItem(themeStorageKey);
    if (savedTheme === 'light' || savedTheme === 'dark') {
        setTheme(savedTheme);
    }

    document.addEventListener('click', function (event) {
        var themeToggle = event.target.closest('.layout-setting');
        if (!themeToggle) {
            return;
        }

        event.preventDefault();
        toggleTheme();
    });
})();

window.setTimeout(function () {
    var loader = document.getElementById('loader');
    if (loader) {
        loader.remove();
    }
}, 1500);


(function () {
  "use strict";

  /* page loader */
  function hideLoader() {
    const loader = document.getElementById("loader");
    if (loader) {
      loader.remove();
    }
  }

  window.addEventListener("load", hideLoader);
  document.addEventListener("DOMContentLoaded", hideLoader);
  window.setTimeout(hideLoader, 1500);
  /* page loader */

  if (typeof bootstrap !== "undefined") {
    /* tooltip */
    const tooltipTriggerList = document.querySelectorAll(
      '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
      (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );

    /* popover  */
    const popoverTriggerList = document.querySelectorAll(
      '[data-bs-toggle="popover"]'
    );
    const popoverList = [...popoverTriggerList].map(
      (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
    );
  }

  /* footer year */
  document.getElementById("year").innerHTML = new Date().getFullYear();
  /* footer year */

  /* card with close button */
  let DIV_CARD = ".card";
  let cardRemoveBtn = document.querySelectorAll(
    '[data-bs-toggle="card-remove"]'
  );
  cardRemoveBtn.forEach((ele) => {
    ele.addEventListener("click", function (e) {
      e.preventDefault();
      let $this = this;
      let card = $this.closest(DIV_CARD);
      card.remove();
      return false;
    });
  });
  /* card with close button */

  /* card with fullscreen */
  let cardFullscreenBtn = document.querySelectorAll(
    '[data-bs-toggle="card-fullscreen"]'
  );
  cardFullscreenBtn.forEach((ele) => {
    ele.addEventListener("click", function (e) {
      let $this = this;
      let card = $this.closest(DIV_CARD);
      card.classList.toggle("card-fullscreen");
      card.classList.remove("card-collapsed");
      e.preventDefault();
      return false;
    });
  });
  /* card with fullscreen */

  /* count-up */
  var i = 1;
  setInterval(() => {
    document.querySelectorAll(".count-up").forEach((ele) => {
      if (ele.getAttribute("data-count") >= i) {
        i = i + 1;
        ele.innerText = i;
      }
    });
  }, 10);
  /* count-up */

  /* back to top */
  const scrollToTop = document.querySelector(".scrollToTop");
  const $rootElement = document.documentElement;
  const $body = document.body;
  window.onscroll = () => {
    const scrollTop = window.scrollY || window.pageYOffset;
    const clientHt = $rootElement.scrollHeight - $rootElement.clientHeight;
    if (window.scrollY > 100) {
      scrollToTop.style.display = "flex";
    } else {
      scrollToTop.style.display = "none";
    }
  };
  scrollToTop.onclick = () => {
    window.scrollTo(0, 0);
  };
  /* back to top */

  /* full screen */
  var elem = document.documentElement;
  window.openFullscreen = function() {
    let open = document.querySelector(".full-screen-open");
    let close = document.querySelector(".full-screen-close");

    if (
      !document.fullscreenElement &&
      !document.webkitFullscreenElement &&
      !document.msFullscreenElement
    ) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.webkitRequestFullscreen) {
        /* Safari */
        elem.webkitRequestFullscreen();
      } else if (elem.msRequestFullscreen) {
        /* IE11 */
        elem.msRequestFullscreen();
      }
      close.classList.add("d-block");
      close.classList.remove("d-none");
      open.classList.add("d-none");
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
      }
      close.classList.remove("d-block");
      open.classList.remove("d-none");
      close.classList.add("d-none");
      open.classList.add("d-block");
    }
  }
  /* full screen */

  /* toggle switches */
  let customSwitch = document.querySelectorAll(".toggle");
  customSwitch.forEach((e) =>
    e.addEventListener("click", () => {
      e.classList.toggle("on");
    })
  );
  /* toggle switches */

  /* header dropdown close button */

  /* for cart dropdown */
  const headerbtn = document.querySelectorAll(".dropdown-item-close");
  headerbtn.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      button.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
      document.getElementById("cart-data").innerText = `${document.querySelectorAll(".dropdown-item-close").length
        } Items`;
      document.getElementById("cart-icon-badge").innerText = `${document.querySelectorAll(".dropdown-item-close").length
        }`;
      console.log(
        document.getElementById("header-cart-items-scroll").children.length
      );
      if (document.querySelectorAll(".dropdown-item-close").length == 0) {
        let elementHide = document.querySelector(".empty-header-item");
        let elementShow = document.querySelector(".empty-item");
        elementHide.classList.add("d-none");
        elementShow.classList.remove("d-none");
      }
    });
  });
  /* for cart dropdown */

  /* for notifications dropdown */
  const headerbtn1 = document.querySelectorAll(".dropdown-item-close1");
  headerbtn1.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      button.parentNode.parentNode.parentNode.parentNode.remove();
      document.getElementById("notifiation-data").innerText = `${document.querySelectorAll(".dropdown-item-close1").length
        } Unread`;
      if (document.querySelectorAll(".dropdown-item-close1").length == 0) {
        let elementHide1 = document.querySelector(".empty-header-item1");
        let elementShow1 = document.querySelector(".empty-item1");
        elementHide1.classList.add("d-none");
        elementShow1.classList.remove("d-none");
      }
    });
  });

  const ajaxModalElement = document.getElementById("ajax-modal");
  const ajaxModalContent = document.getElementById("ajax-modal-content");
  const ajaxModal = ajaxModalElement && typeof bootstrap !== "undefined"
    ? new bootstrap.Modal(ajaxModalElement)
    : null;

  function modalLoadingContent() {
    return `
      <div class="modal-body py-5">
        <div class="d-flex align-items-center justify-content-center gap-2">
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span>Carregando...</span>
        </div>
      </div>
    `;
  }

  function modalErrorContent() {
    return `
      <div class="modal-header">
        <h6 class="modal-title">Erro</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Não foi possível carregar o conteúdo solicitado.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
      </div>
    `;
  }

  window.openAjaxModal = async function (trigger, event) {
    if (!trigger || !ajaxModal || !ajaxModalContent) {
      return true;
    }

    if (event) {
      event.preventDefault();
    }

    ajaxModalContent.innerHTML = modalLoadingContent();
    ajaxModal.show();

    try {
      const response = await fetch(trigger.getAttribute("href"), {
        headers: {
          "X-Requested-With": "XMLHttpRequest",
        },
      });

      if (!response.ok) {
        ajaxModalContent.innerHTML = modalErrorContent();
        return;
      }

      ajaxModalContent.innerHTML = await response.text();
    } catch {
      ajaxModalContent.innerHTML = modalErrorContent();
    }
    return false;
  };

  document.addEventListener("click", (event) => {
    const trigger = event.target.closest("[data-ajax-modal]");
    if (!trigger) {
      return;
    }

    window.openAjaxModal(trigger, event);
  });

  document.addEventListener("submit", async (event) => {
    const form = event.target.closest("[data-ajax-modal-form]");
    if (!form || !ajaxModalContent) {
      return;
    }

    event.preventDefault();

    const formData = new FormData(form);
    const csrfToken = formData.get("_csrfToken");
    const headers = {
      "X-Requested-With": "XMLHttpRequest",
    };

    if (csrfToken) {
      headers["X-CSRF-Token"] = csrfToken;
    }

    try {
      const response = await fetch(form.action, {
        method: form.method || "POST",
        body: formData,
        headers,
      });

      if (response.redirected) {
        window.location.href = response.url;
        return;
      }

      const contentType = response.headers.get("content-type") || "";

      if (contentType.includes("application/json")) {
        const data = await response.json();
        window.location.href = data.redirect || window.location.href;
        return;
      }

      ajaxModalContent.innerHTML = await response.text();
    } catch {
      ajaxModalContent.innerHTML = modalErrorContent();
    }
  });
})();
