(function(e){function t(t){for(var a,r,s=t[0],c=t[1],u=t[2],l=0,d=[];l<s.length;l++)r=s[l],o[r]&&d.push(o[r][0]),o[r]=0;for(a in c)Object.prototype.hasOwnProperty.call(c,a)&&(e[a]=c[a]);f&&f(t);while(d.length)d.shift()();return i.push.apply(i,u||[]),n()}function n(){for(var e,t=0;t<i.length;t++){for(var n=i[t],a=!0,r=1;r<n.length;r++){var s=n[r];0!==o[s]&&(a=!1)}a&&(i.splice(t--,1),e=c(c.s=n[0]))}return e}var a={},r={app:0},o={app:0},i=[];function s(e){return c.p+"js/"+({}[e]||e)+"."+{"chunk-40ed732c":"ae71f829","chunk-b965895e":"e424ad56"}[e]+".js"}function c(t){if(a[t])return a[t].exports;var n=a[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.e=function(e){var t=[],n={"chunk-40ed732c":1};r[e]?t.push(r[e]):0!==r[e]&&n[e]&&t.push(r[e]=new Promise(function(t,n){for(var a="css/"+({}[e]||e)+"."+{"chunk-40ed732c":"9a828fd2","chunk-b965895e":"31d6cfe0"}[e]+".css",o=c.p+a,i=document.getElementsByTagName("link"),s=0;s<i.length;s++){var u=i[s],l=u.getAttribute("data-href")||u.getAttribute("href");if("stylesheet"===u.rel&&(l===a||l===o))return t()}var d=document.getElementsByTagName("style");for(s=0;s<d.length;s++){u=d[s],l=u.getAttribute("data-href");if(l===a||l===o)return t()}var f=document.createElement("link");f.rel="stylesheet",f.type="text/css",f.onload=t,f.onerror=function(t){var a=t&&t.target&&t.target.src||o,i=new Error("Loading CSS chunk "+e+" failed.\n("+a+")");i.request=a,delete r[e],f.parentNode.removeChild(f),n(i)},f.href=o;var p=document.getElementsByTagName("head")[0];p.appendChild(f)}).then(function(){r[e]=0}));var a=o[e];if(0!==a)if(a)t.push(a[2]);else{var i=new Promise(function(t,n){a=o[e]=[t,n]});t.push(a[2]=i);var u,l=document.createElement("script");l.charset="utf-8",l.timeout=120,c.nc&&l.setAttribute("nonce",c.nc),l.src=s(e),u=function(t){l.onerror=l.onload=null,clearTimeout(d);var n=o[e];if(0!==n){if(n){var a=t&&("load"===t.type?"missing":t.type),r=t&&t.target&&t.target.src,i=new Error("Loading chunk "+e+" failed.\n("+a+": "+r+")");i.type=a,i.request=r,n[1](i)}o[e]=void 0}};var d=setTimeout(function(){u({type:"timeout",target:l})},12e4);l.onerror=l.onload=u,document.head.appendChild(l)}return Promise.all(t)},c.m=e,c.c=a,c.d=function(e,t,n){c.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},c.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,t){if(1&t&&(e=c(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)c.d(n,a,function(t){return e[t]}.bind(null,a));return n},c.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return c.d(t,"a",t),t},c.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},c.p="/",c.oe=function(e){throw console.error(e),e};var u=window["webpackJsonp"]=window["webpackJsonp"]||[],l=u.push.bind(u);u.push=t,u=u.slice();for(var d=0;d<u.length;d++)t(u[d]);var f=l;i.push([0,"chunk-vendors"]),n()})({0:function(e,t,n){e.exports=n("56d7")},"0361":function(e,t,n){},"105d":function(e,t,n){},"56d7":function(e,t,n){"use strict";n.r(t);n("cadf"),n("551c"),n("f751"),n("097d"),n("7e6a");var a=n("7487");n("98d6"),n("2411");a["a"].defaults.styling="bootstrap4",a["a"].defaults.icons="fontawesome5",window.PNotify=a["a"],window._=n("2ef0");try{window.Popper=n("cb7e").default,window.$=window.jQuery=n("a881"),n("4989")}catch(D){}window.axios=n("bc3a"),window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";var r=n("2b0e"),o=n("8c4f"),i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return e.authenticated?n("div",{class:{"show-sidebar":e.showSidebar,"h-100":!0}},[n("MainNavbar",{attrs:{user:e.user,handleLogout:e.handleLogout}}),n("Sidebar",{attrs:{user:e.user,handleLogout:e.handleLogout,showSidebar:e.showSidebar,menu:e.menu}}),n("main",{staticClass:"h-100",attrs:{id:"content-wrapper"}},[n("div",{staticClass:"py-4"},[n("router-view",{attrs:{id:"main-wrapper"}})],1)])],1):e._e()},s=[],c=(n("a481"),n("cebc")),u=(n("96cf"),n("3b8d")),l=n("2f62"),d=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("nav",{staticClass:"navbar navbar-expand-md navbar-light navbar-laravel fixed-top"},[a("div",{staticClass:"container-fluid"},[a("router-link",{staticClass:"navbar-brand",attrs:{to:{path:"/"}}},[e._v("\n      Textiles Hernandez\n      "),a("img",{staticClass:"logo",attrs:{src:n("8d1b"),alt:"Logo"}})]),a("button",{staticClass:"navbar-toggler",attrs:{type:"button"},on:{click:e.toggleSidebar}},[a("span",{staticClass:"navbar-toggler-icon"})]),a("div",{staticClass:"collapse navbar-collapse",attrs:{id:"navbarSupportedContent"}},[a("div",{staticClass:"navbar-nav mr-auto"},[e.offices.length>1?a("div",{staticClass:"dropdown"},[a("a",{staticClass:"btn dropdown-toggle text-dark",attrs:{href:"#",role:"button",id:"dropdownMenuLink","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[e._v(e._s(e.selectedOffice.name||"Sucursales"))]),a("div",{staticClass:"dropdown-menu",attrs:{"aria-labelledby":"dropdownMenuLink"}},e._l(e.offices,function(t){return a("button",{key:"office-list-"+t.id,staticClass:"dropdown-item pointer",class:{active:e.selectedOffice.id==t.id},on:{click:function(n){return e.selectOffice(t)}}},[e._v(e._s(t.name))])}),0)]):e._e(),a("div",{staticClass:"btn-group",attrs:{role:"group"}},[a("button",{staticClass:"btn btn-secondary",on:{click:e.toggleSidebar}},[a("i",{staticClass:"fas fa-bars"})]),a("button",{staticClass:"btn btn-dark",on:{click:function(){return e.$router.go(-1)}}},[a("i",{staticClass:"fas fa-arrow-left"})])])]),a("div",{staticClass:"navbar-nav ml-auto"},[a("div",{staticClass:"dropdown"},[a("a",{staticClass:"btn dropdown-toggle text-dark",attrs:{href:"#",role:"button",id:"dropdownMenuLink","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[e._v("Hola, "+e._s(e.user.name))]),a("div",{staticClass:"dropdown-menu",attrs:{"aria-labelledby":"dropdownMenuLink"}},[a("router-link",{staticClass:"dropdown-item",attrs:{to:{path:"/ajustes"}}},[e._v("Ajustes")]),a("button",{staticClass:"dropdown-item pointer",on:{click:e.handleLogout}},[e._v("Cerrar Sesion")])],1)])])])],1)])},f=[],p={props:{user:{required:!0},handleLogout:{required:!0}},methods:Object(c["a"])({},Object(l["b"])("app",["toggleSidebar","setOffices","selectOffice"])),computed:Object(c["a"])({},Object(l["c"])("app",["offices","selectedOffice"])),mounted:function(){var e=Object(u["a"])(regeneratorRuntime.mark(function e(){return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.setOffices();case 2:this.offices.length&&this.selectOffice(this.offices[0]);case 3:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}()},h=p,b=(n("db67"),n("2877")),g=Object(b["a"])(h,d,f,!1,null,"2594a3b3",null),m=g.exports,v=(n("7f7f"),n("bc17"),{props:{item:{required:!0}},data:function(){return{show:!1}},methods:Object(c["a"])({toggleChildrenMenu:function(){this.show=!this.show},shouldToggleSidebar:function(){window.innerWidth<992&&this.toggleSidebar()}},Object(l["b"])("app",["toggleSidebar"])),render:function(e){return this.item.children?e("div",[e("a",{class:"nav-link pointer",on:{click:this.toggleChildrenMenu}},[this.item.name,this.show?e("i",{class:"fas fa-arrow-up float-right"}):e("i",{class:"fas fa-arrow-down float-right"})]),this.show?this.item.children.map(function(t){return e(v,{attrs:{item:t},class:"pl-5"})}):null]):e("router-link",{attrs:{to:this.item.to},class:"nav-link",nativeOn:{click:this.shouldToggleSidebar}},[this.item.name])}}),w={props:{user:{required:!0},handleLogout:{required:!0},showSidebar:{default:!1},menu:{default:function(){return[]}}},render:function(e){return e("div",{attrs:{id:"sidebar-wrapper"},class:{"show-sidebar":this.showSidebar}},[e("div",{class:"h-100 sidebar-component"},[e("nav",{class:"nav flex-column"},[this.menu.map(function(t){return e(v,{attrs:{item:t}})}),e("a",{class:"nav-link",on:{click:this.handleLogout}},["Cerrar Sesión",e("i",{class:"fas fa-sign-out-alt float-right"})])])])])}},k=w,O={components:{MainNavbar:m,Sidebar:k},created:function(){var e=Object(u["a"])(regeneratorRuntime.mark(function e(){return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.isAuthenticated();case 2:if(e.sent){e.next=4;break}this.logout({callback:this.redirectToLogin});case 4:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}(),methods:Object(c["a"])({redirectToLogin:function(){this.$router.replace("/login")},handleLogout:function(){this.logout({callback:this.redirectToLogin})}},Object(l["b"])("auth",["isAuthenticated","logout"])),computed:Object(c["a"])({},Object(l["c"])("auth",["authenticated","user"]),Object(l["c"])("app",["showSidebar","menu"]))},S=O,y=(n("b0d6"),Object(b["a"])(S,i,s,!1,null,"3528a062",null)),j=y.exports;r["a"].use(o["a"]);var C={functional:!0,render:function(e){return e("div")}},_=[{path:"/",component:j,children:[{path:"",component:C},{path:"/home",component:C,display_name:"Inicio"}]},{path:"/login",name:"login",component:function(){return n.e("chunk-40ed732c").then(n.bind(null,"a55b"))}},{path:"/about",name:"about",component:function(){return n.e("chunk-b965895e").then(n.bind(null,"f820"))}}],x=new o["a"]({mode:"history",routes:_}),L=n("bd86"),N=n("a4bb"),T=n.n(N),E=(n("ac6a"),n("ed08")),M={authenticated:localStorage.getItem("authenticated")?JSON.parse(localStorage.authenticated):null,user:localStorage.getItem("user")?JSON.parse(localStorage.user):null,user_id:localStorage.getItem("user_id")?JSON.parse(localStorage.user_id):null,token:localStorage.getItem("token")||null},P={},A={isAuthenticated:function(e){var t=e.state;return!!(t.authenticated&&t.user&&t.user_id&&t.token)},login:function(e,t){var n=e.commit,a=t.user,r=t.token,o=t.callback;n("login",{user:a,token:r}),o&&o()},logout:function(e,t){var n=e.commit,a=t.callback;n("logout"),a&&a()},setState:function(e,t){var n=e.commit;T()(t).forEach(function(e){n("setState",Object(L["a"])({},e,t[e]))})}},q={setState:function(e,t){Object(E["b"])(e,t)},login:function(e,t){var n=t.user,a=t.token;Object(E["b"])(e,{authenticated:!0,user_id:n.id,token:a,user:n})},logout:function(e){Object(E["b"])(e,{authenticated:!1,user_id:null,token:null,user:null}),localStorage.clear()}},R={namespaced:!0,state:M,getters:P,actions:A,mutations:q},$=n("768b"),I=function e(t){var n=[];return t.forEach(function(t){if(t.children&&t.display_name){var a=e(t.children);a.length&&n.push({name:t.display_name,children:a})}else if(t.display_name)n.push({to:t.path,name:t.display_name});else if(t.children){var r=e(t.children);r.length&&(n=n.concat(r))}}),n},J={showSidebar:window.innerWidth>991,selectedOffice:{},offices:[],menu:I(_)},B={},H={setOffices:function(){var e=Object(u["a"])(regeneratorRuntime.mark(function e(t){var n,a,r,o,i;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return n=t.commit,e.next=3,Object(E["a"])({url:"/api/offices"});case 3:a=e.sent,r=Object($["a"])(a,2),o=r[0],i=r[1],o||n("setOffices",{offices:i});case 8:case"end":return e.stop()}},e)}));function t(t){return e.apply(this,arguments)}return t}(),selectOffice:function(e,t){var n=e.commit;n("selectOffice",t)},toggleSidebar:function(e){var t=e.commit;t("toggleSidebar")}},W={selectOffice:function(e,t){e.selectedOffice=t},setOffices:function(e,t){var n=t.offices;e.offices=n},toggleSidebar:function(e){e.showSidebar=!e.showSidebar}},F={namespaced:!0,state:J,getters:B,actions:H,mutations:W};r["a"].use(l["a"]);var X={modules:{auth:R,app:F}},z=new l["a"].Store(X),Q=n("9483");Object(Q["a"])("".concat("/","service-worker.js"),{ready:function(){console.log("App is being served from cache by a service worker.\nFor more details, visit https://goo.gl/AFskqB")},registered:function(){console.log("Service worker has been registered.")},cached:function(){console.log("Content has been cached for offline use.")},updatefound:function(){console.log("New content is downloading.")},updated:function(){console.log("New content is available; please refresh.")},offline:function(){console.log("No internet connection found. App is running in offline mode.")},error:function(e){console.error("Error during service worker registration:",e)}}),r["a"].config.productionTip=!1,new r["a"]({router:x,store:z,render:function(e){return e("router-view")}}).$mount("#app")},"7e6a":function(e,t,n){},"8d1b":function(e,t,n){e.exports=n.p+"img/logo-144.74ea420c.png"},b0d6:function(e,t,n){"use strict";var a=n("0361"),r=n.n(a);r.a},bc17:function(e,t,n){},db67:function(e,t,n){"use strict";var a=n("105d"),r=n.n(a);r.a},ed08:function(e,t,n){"use strict";n.d(t,"a",function(){return f}),n.d(t,"b",function(){return p});var a=n("f499"),r=n.n(a),o=n("5176"),i=n.n(o),s=n("7618"),c=n("a4bb"),u=n.n(c),l=(n("ac6a"),0),d=!1,f=function e(t){var n=t.method,a=void 0===n?"get":n,r=t.url,o=t.data,i=void 0===o?{}:o,s=t.params,c=void 0===s?null:s;return axios({method:a,url:r,data:i,params:c}).then(function(e){return d&&(d=!1,PNotify.success("Conexiòn restablecida")),[null,e.data]}).catch(function(t){if(t.response){var n=t.response.status;if(l<3&&500==n)return l++,e({method:a,url:r,data:i,params:c});l=0}else d=!0,PNotify.error("Ocurrio un problema en la red... Reintenta en unos segundos");return[t]})},p=function(e,t){u()(t).forEach(function(n){"object"===Object(s["a"])(t[n])?(e[n]=i()({},t[n]),localStorage[n]=r()(t[n])):(e[n]=t[n],localStorage[n]=t[n])})}}});
//# sourceMappingURL=app.4f5c64c5.js.map