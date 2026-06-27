/* YASSO INSURANCE — site interactions (vanilla, no build step) */
(function () {
  "use strict";
  var $ = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  /* ---- Sticky header shadow ---- */
  var header = $(".site-header");
  function onScroll() {
    if (header) header.classList.toggle("scrolled", window.scrollY > 8);
    // sticky CTA after hero
    var sticky = $(".sticky-cta");
    if (sticky) sticky.classList.toggle("show", window.scrollY > 620);
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  /* ---- Mobile nav ---- */
  var mnav = $(".mobile-nav");
  function openNav() { if (mnav) { mnav.classList.add("open"); document.body.style.overflow = "hidden"; } }
  function closeNav() { if (mnav) { mnav.classList.remove("open"); document.body.style.overflow = ""; } }
  var t = $(".nav-toggle"); if (t) t.addEventListener("click", openNav);
  $$("[data-close-nav]").forEach(function (el) { el.addEventListener("click", closeNav); });
  if (mnav) mnav.addEventListener("click", function (e) { if (e.target === mnav || e.target.classList.contains("mobile-nav__scrim")) closeNav(); });

  /* ---- Scroll reveal ---- */
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add("in"); io.unobserve(e.target); } });
    }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });
    $$(".reveal").forEach(function (el) { io.observe(el); });
  } else {
    $$(".reveal").forEach(function (el) { el.classList.add("in"); });
  }

  /* ---- Animated counters ---- */
  function animateCount(el) {
    var target = parseFloat(el.getAttribute("data-count"));
    var suffix = el.getAttribute("data-suffix") || "";
    var dec = (target % 1 !== 0) ? 1 : 0;
    var dur = 1400, start = null;
    function step(ts) {
      if (!start) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      var eased = 1 - Math.pow(1 - p, 3);
      el.textContent = (target * eased).toFixed(dec) + suffix;
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }
  if ("IntersectionObserver" in window) {
    var co = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) { if (e.isIntersecting) { animateCount(e.target); co.unobserve(e.target); } });
    }, { threshold: 0.5 });
    $$("[data-count]").forEach(function (el) { co.observe(el); });
  }

  /* ---- Floating action button ---- */
  var fab = $(".fab");
  if (fab) {
    var fmain = $(".fab__main", fab);
    fmain.addEventListener("click", function () { fab.classList.toggle("open"); });
    document.addEventListener("click", function (e) { if (!fab.contains(e.target)) fab.classList.remove("open"); });
  }

  /* ---- Exit intent modal (desktop) + delayed mobile ---- */
  var modal = $("#exitModal");
  if (modal) {
    var shown = false;
    function showModal() {
      if (shown || sessionStorage.getItem("exitShown")) return;
      shown = true; sessionStorage.setItem("exitShown", "1");
      modal.classList.add("open"); document.body.style.overflow = "hidden";
    }
    function hideModal() { modal.classList.remove("open"); document.body.style.overflow = ""; }
    document.addEventListener("mouseout", function (e) {
      if (e.clientY <= 0 && !e.relatedTarget) showModal();
    });
    // mobile / fallback: after 35s
    setTimeout(function () { if (window.matchMedia("(max-width:1000px)").matches) showModal(); }, 35000);
    $$("[data-close-modal]", modal).forEach(function (el) { el.addEventListener("click", hideModal); });
    modal.addEventListener("click", function (e) { if (e.target.classList.contains("modal__scrim")) hideModal(); });
    document.addEventListener("keydown", function (e) { if (e.key === "Escape") hideModal(); });
  }

  /* ---- Smooth in-page anchor offset for sticky header ---- */
  $$('a[href^="#"]').forEach(function (a) {
    a.addEventListener("click", function (e) {
      var id = a.getAttribute("href");
      if (id.length > 1) {
        var tgt = document.querySelector(id);
        if (tgt) { e.preventDefault(); var y = tgt.getBoundingClientRect().top + window.scrollY - 80; window.scrollTo({ top: y, behavior: "smooth" }); }
      }
    });
  });

  /* ---- Current year ---- */
  $$("[data-year]").forEach(function (el) { el.textContent = new Date().getFullYear(); });
})();
