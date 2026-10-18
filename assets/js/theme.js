/* SCIRCO 主题切换（与主站保持一致） */
(function () {
  var stored = null;
  try { stored = localStorage.getItem("scirco-theme"); } catch (e) {}
  var theme = stored || "light";
  document.documentElement.setAttribute("data-theme", theme);

  document.addEventListener("DOMContentLoaded", function () {
    var btn = document.getElementById("theme-toggle");
    if (!btn) return;
    var sync = function () {
      var cur = document.documentElement.getAttribute("data-theme");
      btn.textContent = cur === "dark" ? "☀️ 浅色模式" : "🌙 深色模式";
    };
    sync();
    btn.addEventListener("click", function () {
      var cur = document.documentElement.getAttribute("data-theme");
      var next = cur === "dark" ? "light" : "dark";
      document.documentElement.setAttribute("data-theme", next);
      try { localStorage.setItem("scirco-theme", next); } catch (e) {}
      sync();
    });
  });
})();
