/**
 * JavaScript for PHPMaker 2020
 * @license (C)2002-2020 e.World Technology Ltd.
 */
var _initGridPanelsReq,
  ew = {
    PAGE_ID: "",
    RELATIVE_PATH: "",
    GENERATE_PASSWORD_UPPERCASE: !0,
    GENERATE_PASSWORD_LOWERCASE: !0,
    GENERATE_PASSWORD_NUMBER: !0,
    GENERATE_PASSWORD_SPECIALCHARS: !0,
    CONFIRM_CANCEL: !0,
    ROWTYPE_ADD: 2,
    ROWTYPE_EDIT: 3,
    UNFORMAT_YEAR: 50,
    LAZY_LOAD_RETRIES: 3,
    AJAX_DELAY: 5,
    LOOKUP_DELAY: 250,
    MAX_OPTION_COUNT: 3,
    SHOW_EXPORT_DIALOG: !0,
    USE_OVERLAY_SCROLLBARS: !0,
    language: null,
    vars: null,
    googleMaps: [],
    addOptionDialog: null,
    emailDialog: null,
    importDialog: null,
    modalDialog: null,
    modalLookupDialog: null,
    autoSuggestSettings: {
      highlight: !0,
      hint: !0,
      minLength: 1,
      limit: 10,
      trigger: "click",
      delay: 0,
      templates: {
        footer: '<div class="tt-footer"><a href="#" class="tt-more"></a></div>',
      },
    },
    lightboxSettings: { transition: "none", photo: !0, opacity: 0.5 },
    importUploadOptions: { maxFileSize: 1e7, maxNumberOfFiles: 10 },
    DOMPurifyConfig: {},
    sanitize: function (e) {
      return DOMPurify.sanitize(e, this.DOMPurifyConfig);
    },
    sanitizeFn: null,
    PDFObjectOptions: {},
    chartJsOptions: {},
    toastTemplate:
      '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><strong class="mr-auto"></strong><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="toast-body"></div></div>',
    spinnerClass: "spinner-border text-primary",
    jsRenderHelpers: {
      getTemplate: function (e) {
        return e;
      },
    },
    autoHideSuccessMessage: !0,
    autoHideSuccessMessageDelay: 5e3,
    searchOperatorChanged: function () {},
    setLanguage: function () {},
    addOptionDialogShow: function () {},
    modalLookupShow: function () {},
    importDialogShow: function () {},
    toggleSearchOperator: function () {},
    togglePassword: function () {},
    sort: function () {},
    clickMultiCheckbox: function () {},
    clearForm: function () {},
    export: function () {},
    exportWithCharts: function () {},
    setSearchType: function () {},
    emailDialogShow: function () {},
    selectAll: function () {},
    selectAllKey: function () {},
    submitAction: function () {},
    addGridRow: function () {},
    confirmDelete: function () {
      return !1;
    },
    deleteGridRow: function () {
      return !1;
    },
  };
function _initGridPanels(e) {
  ew.initGridPanels(),
    (_initGridPanelsReq = requestAnimationFrame(_initGridPanels));
}
(ew.addSpinner = function () {
  if (!document.getElementById("ew-page-spinner")) {
    var e = document.createElement("div");
    (e.id = "ew-page-spinner"),
      e.setAttribute("class", ew.spinnerClass),
      e.setAttribute("role", "status"),
      (e.innerHTML =
        '<span class="sr-only">' +
        (ew.language ? ew.language.phrase("Loading") : "Loading...") +
        "</span>"),
      document.body && document.body.appendChild(e);
  }
}),
  (ew.removeSpinner = function () {
    var e = document.getElementById("ew-page-spinner");
    e && e.parentNode.removeChild(e);
  }),
  (ew.initGridPanel = function (e) {
    if (!e.dataset.isset) {
      for (
        var t = "", n = 0;
        n < e.children.length && "" === (t = e.children[n].innerHTML.trim());
        n++
      );
      "" === t && e.classList.add("d-none"), (e.dataset.isset = !0);
    }
  }),
  (ew.initGridPanels = function () {
    Array.prototype.forEach.call(
      document.querySelectorAll(".ew-grid-upper-panel, .ew-grid-lower-panel"),
      this.initGridPanel
    );
  }),
  (_initGridPanelsReq = requestAnimationFrame(_initGridPanels)),
  document.addEventListener("DOMContentLoaded", function (e) {
    ew.addSpinner(),
      ew.initGridPanels(),
      cancelAnimationFrame(_initGridPanelsReq),
      window.loadjs.done("dom");
  }),
  (ew.sidebarScrollbarsOptions = {
    className: "os-theme-light",
    sizeAutoCapable: !0,
    scrollbars: { autoHide: "leave", clickScrolling: !0 },
  }),
  (ew.initSidebarScrollbars = function () {
    var e = jQuery;
    e("body").hasClass("layout-fixed") &&
      (e(".main-sidebar .sidebar").overlayScrollbars(
        ew.sidebarScrollbarsOptions
      ),
      e(".control-sidebar .control-sidebar-content").overlayScrollbars(
        ew.sidebarScrollbarsOptions
      ));
  }),
  (ew.bundleIds = ["dom", "head"]),
  (ew.loadjs = function (e, t, n) {
    t && "load" != t && -1 == ew.bundleIds.indexOf(t) && ew.bundleIds.push(t);
    var a = (e = Array.isArray(e) ? e : [e]).shift();
    void 0 === a
      ? ("function" == typeof n && n(), window.loadjs.done(t))
      : !a || (Array.isArray(a) && !a.length)
      ? ew.loadjs(e, t, n)
      : window.loadjs(a, {
          success: function () {
            ew.loadjs(e, t, n);
          },
          error: function (a) {
            console.log("Path not found: " + a.join(", ")), ew.loadjs(e, t, n);
          },
        });
  }),
  (ew.ready = function (e, t, n, a) {
    window.loadjs.ready(e, function () {
      ew.loadjs(t, n, a);
    });
  }),
  (ew.Language = function (e) {
    (this.obj = e),
      (this.phrase = function (e) {
        return this.obj[e.toLowerCase()];
      });
  }),
  (ew.renderTemplate = function (e, t) {
    var n = jQuery,
      a = e && e.render ? e : n(e);
    if (a.render) {
      var i = { $template: a, data: t };
      n(document).trigger("rendertemplate", [i]);
      var o = a.render(i.data, ew.jsRenderHelpers),
        r = i.$template.data("method"),
        s = i.$template.data("target");
      return (
        o && r && s
          ? n(o)[r](s)
          : o && !r && s
          ? n(s).html(o)
          : !o || r || s || a.parent().append(o),
        o
      );
    }
  }),
  (ew.renderJsTemplates = function (e) {
    var t = jQuery,
      n = e && e.target ? e.target : document;
    t(n)
      .find(".ew-js-template")
      .sort(function (e, n) {
        return (e = parseInt(t(e).data("seq"), 10) || 0) >
          (n = parseInt(t(n).data("seq"), 10) || 0)
          ? 1
          : e < n
          ? -1
          : 0;
      })
      .each(function (e) {
        var n = t(this),
          a = n.data("name"),
          i = n.data("data");
        (i && "string" == typeof i && !(i = ew.vars[i] || window[i])) ||
          (a
            ? t.render[a] || (t.templates(a, n.text()), ew.renderTemplate(n, i))
            : ew.renderTemplate(n, i));
      });
  });
