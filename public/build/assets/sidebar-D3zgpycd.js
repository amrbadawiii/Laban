document.addEventListener("DOMContentLoaded",()=>{const s=document.querySelectorAll(".section-toggle"),r=document.querySelectorAll(".sub-item"),i=window.location.href;let t=new URL(i),o=t.pathname.split("/").filter(e=>e);if(o.length>0){const e=o[o.length-1];(/^\d+$/.test(e)||t.search)&&(t.pathname=`/${o.slice(0,-1).join("/")}`)}t.search="",t.hash="";let l=t.toString();r.forEach(e=>{if(console.log(e.href+"_-"+l),e.href===l){e.classList.add("bg-cyan-200","font-bold");const c=e.closest(".sidebar-section");if(c){const n=c.querySelector(".section-toggle");n&&(n.checked=!0)}}e.addEventListener("click",c=>{const n=e.closest(".sidebar-section");n&&(n.querySelector(".section-toggle").checked=!0)})}),s.forEach(e=>{e.addEventListener("change",()=>{e.checked&&s.forEach(c=>{c!==e&&(c.checked=!1)})})})});
