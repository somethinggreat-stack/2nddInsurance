/* YASSO INSURANCE — Multi-step questionnaire engine (vanilla) */
(function () {
  "use strict";
  var form = document.getElementById("quizForm");
  if (!form) return;

  var steps = Array.prototype.slice.call(form.querySelectorAll(".quiz-step"));
  var bar = form.querySelector(".quiz__bar i");
  var lblCur = form.querySelector("[data-cur]");
  var lblTot = form.querySelector("[data-tot]");
  var lblName = form.querySelector("[data-stepname]");
  var dots = Array.prototype.slice.call(form.querySelectorAll(".quiz__dot"));
  var btnBack = form.querySelector("[data-back]");
  var btnNext = form.querySelector("[data-next]");
  var btnSubmit = form.querySelector("[data-submit]");
  var current = 0;
  var total = steps.length;
  if (lblTot) lblTot.textContent = total;

  function showStep(i, dir) {
    steps.forEach(function (s, idx) { s.classList.toggle("active", idx === i); });
    current = i;
    var pct = ((i + 1) / total) * 100;
    if (bar) bar.style.width = pct + "%";
    if (lblCur) lblCur.textContent = i + 1;
    if (lblName) lblName.textContent = steps[i].getAttribute("data-name") || "";
    dots.forEach(function (d, idx) {
      d.classList.toggle("active", idx === i);
      d.classList.toggle("done", idx < i);
    });
    btnBack.style.display = i === 0 ? "none" : "inline-flex";
    var last = i === total - 1;
    btnNext.style.display = last ? "none" : "inline-flex";
    btnSubmit.style.display = last ? "inline-flex" : "none";
    // focus + scroll (never on initial load, so the hero stays visible)
    if (dir !== "init") {
      var top = form.getBoundingClientRect().top + window.scrollY - 100;
      window.scrollTo({ top: top, behavior: "smooth" });
      var f = steps[i].querySelector("input,select,textarea");
      if (f && dir !== "back") { try { f.focus({ preventScroll: true }); } catch (e) {} }
    }
  }

  function validateStep(i) {
    var ok = true;
    var fields = steps[i].querySelectorAll("[required]");
    Array.prototype.forEach.call(fields, function (el) {
      var valid = true;
      if (el.type === "radio") {
        valid = !!form.querySelector('input[name="' + el.name + '"]:checked');
      } else if (el.type === "email") {
        valid = el.value.trim() !== "" && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value);
      } else if (el.type === "tel") {
        valid = el.value.replace(/\D/g, "").length >= 10;
      } else {
        valid = el.value.trim() !== "";
      }
      el.classList.toggle("is-invalid", !valid);
      var errEl = el.closest(".field") ? el.closest(".field").querySelector(".err") : null;
      if (errEl) errEl.textContent = valid ? "" : (el.getAttribute("data-err") || "This field is required");
      if (!valid && ok) { try { el.focus(); } catch (e) {} }
      if (!valid) ok = false;
    });
    return ok;
  }

  btnNext.addEventListener("click", function () {
    if (!validateStep(current)) return;
    if (current < total - 1) {
      if (steps[current + 1].hasAttribute("data-review")) buildReview();
      showStep(current + 1);
    }
  });
  btnBack.addEventListener("click", function () { if (current > 0) showStep(current - 1, "back"); });

  // Enter key advances (except textarea)
  form.addEventListener("keydown", function (e) {
    if (e.key === "Enter" && e.target.tagName !== "TEXTAREA") {
      e.preventDefault();
      if (current < total - 1) btnNext.click();
    }
  });

  // Choice tiles: auto-advance for single-select steps marked data-autoadvance
  Array.prototype.forEach.call(form.querySelectorAll(".choice input[type=radio]"), function (r) {
    r.addEventListener("change", function () {
      var step = r.closest(".quiz-step");
      if (step && step.hasAttribute("data-autoadvance")) {
        setTimeout(function () { btnNext.click(); }, 280);
      }
    });
  });

  function labelFor(el) {
    if (el.type === "radio") {
      var c = form.querySelector('input[name="' + el.name + '"]:checked');
      if (!c) return null;
      var box = c.parentNode.querySelector(".t");
      return box ? box.textContent.trim() : c.value;
    }
    if (el.tagName === "SELECT") { return el.options[el.selectedIndex] ? el.options[el.selectedIndex].text : el.value; }
    return el.value.trim();
  }

  function buildReview() {
    var box = form.querySelector("[data-review-body]");
    if (!box) return;
    box.innerHTML = "";
    var seenRadio = {};
    steps.forEach(function (step) {
      if (step.hasAttribute("data-review")) return;
      var name = step.getAttribute("data-name");
      var items = [];
      Array.prototype.forEach.call(step.querySelectorAll("input,select,textarea"), function (el) {
        if (!el.name || el.type === "submit" || el.type === "button") return;
        if (el.type === "radio") { if (seenRadio[el.name]) return; seenRadio[el.name] = 1; }
        var val = labelFor(el);
        if (!val) return;
        var lab = el.getAttribute("data-label");
        if (!lab) { var fl = el.closest(".field"); var l = fl ? fl.querySelector("label") : null; lab = l ? l.textContent.replace("*", "").trim() : el.name; }
        items.push({ k: lab, v: val });
      });
      if (!items.length) return;
      var grp = document.createElement("div");
      grp.className = "review-group";
      var h = document.createElement("h3"); h.textContent = name; grp.appendChild(h);
      var list = document.createElement("div"); list.className = "review-list";
      items.forEach(function (it) {
        var row = document.createElement("div"); row.className = "review-item";
        row.innerHTML = '<span class="k"></span><span class="v"></span>';
        row.querySelector(".k").textContent = it.k;
        row.querySelector(".v").textContent = it.v;
        list.appendChild(row);
      });
      grp.appendChild(list); box.appendChild(grp);
    });
  }

  form.addEventListener("submit", function (e) {
    if (!validateStep(current)) { e.preventDefault(); return; }
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = "Submitting…";
  });

  // Simple phone formatter
  Array.prototype.forEach.call(form.querySelectorAll('input[type=tel]'), function (el) {
    el.addEventListener("input", function () {
      var d = el.value.replace(/\D/g, "").slice(0, 10);
      if (d.length > 6) el.value = "(" + d.slice(0, 3) + ") " + d.slice(3, 6) + "-" + d.slice(6);
      else if (d.length > 3) el.value = "(" + d.slice(0, 3) + ") " + d.slice(3);
      else if (d.length > 0) el.value = "(" + d;
    });
  });

  showStep(0, "init");
})();
