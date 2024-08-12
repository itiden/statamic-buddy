(()=>{"use strict";function t(t,e,s,n,i,o,a,l){var c,r="function"==typeof t?t.options:t;if(e&&(r.render=e,r.staticRenderFns=s,r._compiled=!0),n&&(r.functional=!0),o&&(r._scopeId="data-v-"+o),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},r._ssrRegister=c):i&&(c=l?function(){i.call(this,(r.functional?this.parent:this).$root.$options.shadowRoot)}:i),c)if(r.functional){r._injectStyles=c;var d=r.render;r.render=function(t,e){return c.call(e),d(t,e)}}else{var u=r.beforeCreate;r.beforeCreate=u?[].concat(u,c):[c]}return{exports:t,options:r}}const e=t({props:{disabled:Boolean,route:String},data:function(){return{confirming:!1,show:!1,loading:!1,value:""}},computed:{},methods:{open:function(){this.show=!0},close:function(){this.show=!1},confirm:function(){this.confirming=!0},handleChange:function(t){this.value=t},submit:function(){var t=this;this.loading=!0,this.confirming=!1,this.$axios.post(this.route,{comment:this.value}).then((function(e){t.loading=!1,t.show=!1,t.$toast.success(__("Site is now being deployed.")),t.$emit("onDeployed")})).catch((function(t){console.log(t)}))}}},(function(){var t=this,e=t._self._c;return e("div",[e("button",{staticClass:"btn-primary",class:{"btn-disabled":t.disabled},attrs:{disabled:t.disabled},on:{click:t.open}},[t._v("\n    Deploy\n  ")]),t._v(" "),t.show?e("stack",{attrs:{narrow:"",name:"buddy-deploy"}},[e("div",{staticClass:"bg-white h-full"},[e("div",{staticClass:"bg-grey-20 px-3 py-1 border-b border-grey-30 text-lg font-medium flex items-center justify-between"},[e("h2",{staticClass:"text-lg font-medium"},[t._v("Deploy")]),t._v(" "),e("button",{staticClass:"btn-close",attrs:{type:"button"},domProps:{innerHTML:t._s("&times")},on:{click:t.close}})]),t._v(" "),e("form",{on:{submit:t.confirm}},[e("div",{staticClass:"p-3"},[e("label",{staticClass:"font-bold mb-1",attrs:{for:"buddy-comment"}},[t._v(t._s(t.__("Comment")))]),t._v(" "),e("textarea-input",{attrs:{id:t.buddy-t.comment,name:t.comment,focus:!0,disabled:t.loading},on:{input:t.handleChange}})],1)]),t._v(" "),t.loading?t._e():e("div",{staticClass:"p-3"},[e("button",{staticClass:"btn-primary w-full",class:{"btn-disabled":t.loading},attrs:{disabled:t.loading},on:{click:t.confirm}},[t._v("\n          "+t._s(t.__("Submit"))+"\n        ")])]),t._v(" "),t.loading?e("div",{staticClass:"p-3 flex justify-center"},[e("loading-graphic",{attrs:{size:14,inline:!0,color:t.white,text:"Deploying"}})],1):t._e()])]):t._e(),t._v(" "),t.confirming?e("confirmation-modal",{attrs:{title:"Deploy your site",bodyText:"Are you sure you want to deploy your site?",buttonText:"Deploy"},on:{confirm:function(e){return t.submit()},cancel:function(e){t.confirming=!1}}}):t._e()],1)}),[],!1,null,null,null).exports;const s=t({props:["fetchRoute","deployRoute"],data:function(){return{hasLoaded:!1,logs:[]}},computed:{},mounted:function(){this.fetch()},methods:{fetch:function(){var t=this;this.$axios.get(this.fetchRoute).then((function(e){t.logs=e.data.logs,t.hasLoaded=!0})).catch((function(t){console.log(t)}))},onDeployed:function(){this.fetch()}}},(function(){var t=this,e=t._self._c;return e("div",[e("header",{staticClass:"mb-6"},[e("div",{staticClass:"flex items-center"},[e("h1",{staticClass:"flex-1"},[t._v("Deploy with Buddy")]),t._v(" "),e("div",{staticClass:"btn-group mr-4"},[e("buddy-deploy",{attrs:{route:t.deployRoute},on:{onDeployed:t.onDeployed}})],1)])]),t._v(" "),t.hasLoaded?e("div",{staticClass:"gap-2 flex flex-col"},t._l(t.logs,(function(s){var n=s.title,i=s.items;return e("div",{key:n,staticClass:"card overflow-hidden p-0"},[e("div",{staticClass:"flex justify-between items-center p-4"},[e("h2",[e("span",[t._v(t._s(n))])])]),t._v(" "),e("ol",t._l(i,(function(s){return e("li",{key:s.id,staticClass:"flex items-center py-2 px-4 border-b"},[e("div",{staticClass:"text-grey-80"},[e("b",{staticClass:"mr-2 text-grey-100"},[t._v("Run #"+t._s(s.id))]),t._v("\n            "+t._s(s.comment)+"\n          ")]),t._v(" "),e("div",{staticClass:"ml-auto flex gap-2 text-grey-70 text-"},[e("time",{attrs:{datetime:s.date}},[t._v(t._s(s.time))]),t._v(" "),e("span",{staticClass:"flex items-center justify-center w-6 h-6 rounded-full"},[e("span",{staticClass:"flex items-center justify-center w-6 h-6 rounded-full text-white",class:{"bg-green":"SUCCESSFUL"===s.status,"bg-yellow-dark":"INPROGRESS"===s.status,"bg-red":"FAILED"===s.status},staticStyle:{padding:"6px"}},["SUCCESSFUL"===s.status?e("svg-icon",{staticClass:"icon",attrs:{name:"check"}}):t._e(),t._v(" "),"FAILED"===s.status?e("svg-icon",{staticClass:"icon",attrs:{name:"close"}}):t._e(),t._v(" "),"INPROGRESS"===s.status?e("loading-graphic",{attrs:{inline:!0,size:22,text:""}}):t._e()],1)])])])})),0)])})),0):e("div",{staticClass:"flex justify-center"},[e("loading-graphic",{attrs:{inline:!0,size:22}})],1)])}),[],!1,null,null,null).exports;Statamic.booting((function(){Statamic.$components.register("buddy-log",s),Statamic.$components.register("buddy-deploy",e)}))})();