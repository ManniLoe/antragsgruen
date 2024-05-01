var __awaiter=this&&this.__awaiter||function(t,e,i,a){return new(i||(i=Promise))((function(s,r){function d(t){try{n(a.next(t))}catch(t){r(t)}}function o(t){try{n(a.throw(t))}catch(t){r(t)}}function n(t){var e;t.done?s(t.value):(e=t.value,e instanceof i?e:new i((function(t){t(e)}))).then(d,o)}n((a=a.apply(t,e||[])).next())}))};define(["require","exports","../shared/AntragsgruenEditor"],(function(t,e,i){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.EditorialEdit=void 0;e.EditorialEdit=class{constructor(t,e){this.form=e,this.form.addEventListener("submit",(t=>t.preventDefault())),this.saveRow=this.form.querySelector(".saveRow"),this.textHolder=this.form.querySelector(".textHolder"),this.editCaller=this.form.querySelector(".editCaller"),this.metadataEdit=this.form.querySelector(".metadataEdit"),this.metadataView=this.form.querySelector(".metadataView"),this.editCaller.addEventListener("click",this.editCalled.bind(this)),this.saveRow.querySelector("button").addEventListener("click",this.save.bind(this))}editCalled(t){t.preventDefault(),this.textHolder.setAttribute("contenteditable","true"),this.editor=new i.AntragsgruenEditor(this.textHolder.getAttribute("id")),this.textHolder.focus(),this.editCaller.classList.add("hidden"),this.saveRow.classList.remove("hidden"),this.metadataView.classList.add("hidden"),this.metadataEdit.classList.remove("hidden")}save(t){return __awaiter(this,void 0,void 0,(function*(){t.preventDefault();let e={data:this.editor.getEditor().getData(),author:this.metadataEdit.querySelector(".author").value,updateDate:this.metadataEdit.querySelector(".updateDate").checked?1:0};const a=this.form.querySelector("input[name=_csrf]").value;$.ajax({url:this.form.getAttribute("action"),type:"POST",data:JSON.stringify(e),processData:!1,contentType:"application/json; charset=utf-8",dataType:"json",headers:{"X-CSRF-Token":a},success:t=>{t.success?(window.setTimeout((()=>{i.AntragsgruenEditor.destroyInstanceById(this.textHolder.getAttribute("id"))}),100),this.saveRow.classList.add("hidden"),this.textHolder.setAttribute("contenteditable","false"),this.editCaller.classList.remove("hidden"),this.metadataEdit.classList.add("hidden"),this.metadataView.classList.remove("hidden"),this.textHolder.innerHTML=t.html,this.metadataView.innerHTML=t.metadataFormatted):alert("Something went wrong...")}}).catch((function(t){alert(t.responseText)}))}))}}}));
//# sourceMappingURL=EditorialEdit.js.map