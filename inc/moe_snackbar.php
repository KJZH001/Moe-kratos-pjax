<!--
用于为动画减弱模式弹出提示
项目地址 https://github.com/KJZH001/Moe-kratos-pjax
by 晓空 2026.2.25
-->

<style>
/* ===== moe-snack-toast- (scoped) ===== */
#moe-snack-toast-root{
  position:fixed; left:0; right:0; bottom:16px;
  display:flex; justify-content:center;
  pointer-events:none; z-index:9999;
  padding:0 12px;
  font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Noto Sans",sans-serif;
}

.moe-snack-toast{
  pointer-events:auto;
  max-width:min(520px, 100%);
  background:rgba(20,20,20,.92);
  color:#fff;
  border-radius:12px;
  padding:10px 12px;
  box-shadow:0 10px 24px rgba(0,0,0,.25);
  display:flex; gap:10px; align-items:flex-start;

  /* tiny motion */
  transform:translateY(6px);
  opacity:0;
  transition:160ms ease;
}

.moe-snack-toast.moe-snack-toast--in{
  transform:translateY(0);
  opacity:1;
}

.moe-snack-toast__msg{ line-height:1.35; font-size:14px;padding:4px; }
.moe-snack-toast__btn{
  border:0; background:transparent; color:#fff;
  opacity:.85; cursor:pointer; padding:0 4px; font-size:16px;
}
.moe-snack-toast__btn:hover{ opacity:1; }

@media (prefers-reduced-motion: reduce){
  .moe-snack-toast{ transition:none; transform:none; }
}
</style>

<div id="moe-snack-toast-root" aria-atomic="true"></div>

<script>
(function(){
  var ROOT_ID = "moe-snack-toast-root";
  var root = document.getElementById(ROOT_ID);
  if(!root) return;

  // 避免污染全局：只挂一个命名空间对象
  if(!window.moeSnackToast) window.moeSnackToast = {};

  var timer = null;

  function close(){
    if(timer){ clearTimeout(timer); timer = null; }
    var el = root.firstElementChild;
    if(!el) return;

    var reduce = false;
    try{
      reduce = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    }catch(e){}

    if(reduce){
      root.innerHTML = "";
      return;
    }
    el.classList.remove("moe-snack-toast--in");
    setTimeout(function(){ root.innerHTML = ""; }, 180);
  }

  function show(message, opts){
    opts = opts || {};
    var duration = (opts.duration == null ? 4500 : opts.duration);
    // var dismissText = (opts.dismissText == null ? "×" : opts.dismissText);

    if(timer){ clearTimeout(timer); timer = null; }
    root.innerHTML = "";

    var el = document.createElement("div");
    el.className = "moe-snack-toast";
    el.setAttribute("role", "status"); // status => polite live region 语义更合适 :contentReference[oaicite:2]{index=2}
    el.setAttribute("aria-live", "polite");

    var msg = document.createElement("div");
    msg.className = "moe-snack-toast__msg";
    msg.textContent = message;

    // var btn = document.createElement("button");
    // btn.className = "moe-snack-toast__btn";
    // btn.type = "button";
    // btn.setAttribute("aria-label", "关闭提示");
    // btn.textContent = dismissText;

    // btn.onclick = close;
    el.appendChild(msg);
    // el.appendChild(btn);
    root.appendChild(el);

    // 让 DOM 先挂载再进入态，读屏/动画表现更稳定 :contentReference[oaicite:3]{index=3}
    requestAnimationFrame(function(){ el.classList.add("moe-snack-toast--in"); });

    if(duration > 0) timer = setTimeout(close, duration);
  }

  window.moeSnackToast.show = show;
  window.moeSnackToast.close = close;

  // —— 已经是“服务端判断后才输出整段”，所以直接自动弹一次即可：
  show("动画减弱模式已启用", { duration: 5000 });
})();
</script>